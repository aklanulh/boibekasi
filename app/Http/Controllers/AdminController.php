<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use App\Models\Event;
use App\Models\Member;
use App\Models\Merchandise;
use App\Models\Documentation;
use App\Models\Holiday;

class AdminController extends Controller
{
    private $adminPassword = 'admin123'; // Change this to a secure password

    public function showLogin()
    {
        if (Session::get('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);

        if ($request->password === $this->adminPassword) {
            Session::put('admin_logged_in', true);
            return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['password' => 'Password salah!']);
    }

    public function dashboard()
    {
        if (!Session::get('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        // Get database statistics
        $stats = [
            'events' => \App\Models\Event::count(),
            'members' => \App\Models\Member::count(),
            'merchandises' => \App\Models\Merchandise::count(),
            'documentations' => \App\Models\Documentation::count(),
            'holidays' => \App\Models\Holiday::getByYear(date('Y'))->count(),
        ];

        // Get recent members (limit to 5 most recent)
        $recent_members = \App\Models\Member::orderBy('created_at', 'desc')->limit(5)->get();

        // Get upcoming events (limit to 5 most recent)
        $upcoming_events = \App\Models\Event::where('date', '>=', date('Y-m-d'))
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->limit(5)
            ->get();

        // Get recent documentation (limit to 5 most recent)
        $recent_documentation = \App\Models\Documentation::orderBy('created_at', 'desc')->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_members', 'upcoming_events', 'recent_documentation'));
    }

    public function tinker()
    {
        if (!Session::get('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        return view('admin.tinker');
    }

    public function executeTinker(Request $request)
    {
        if (!Session::get('admin_logged_in')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $code = $request->input('code');
        
        if (empty($code)) {
            return response()->json(['error' => 'Code tidak boleh kosong']);
        }

        // Security check - prevent dangerous operations
        $dangerousPatterns = [
            'exec',
            'system',
            'shell_exec',
            'passthru',
            'file_get_contents',
            'file_put_contents',
            'unlink',
            'rmdir',
            'drop',
            'delete',
            'truncate'
        ];

        foreach ($dangerousPatterns as $pattern) {
            if (stripos($code, $pattern) !== false) {
                return response()->json(['error' => 'Operasi berbahaya tidak diizinkan']);
            }
        }

        try {
            // Capture output
            ob_start();
            
            // Execute the code
            $result = eval($code);
            
            $output = ob_get_clean();
            
            // Format result
            if ($result !== null) {
                if (is_object($result) || is_array($result)) {
                    $result = json_encode($result, JSON_PRETTY_PRINT);
                }
                $output .= "\nResult: " . $result;
            }

            return response()->json(['output' => $output ?: 'Code executed successfully']);
            
        } catch (\Exception $e) {
            ob_end_clean();
            return response()->json(['error' => 'Error: ' . $e->getMessage()]);
        }
    }

    public function databaseInfo()
    {
        if (!Session::get('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        try {
            // Get table information
            $tables = DB::select("SELECT name FROM sqlite_master WHERE type='table' ORDER BY name");
            
            $tableInfo = [];
            foreach ($tables as $table) {
                $tableName = $table->name;
                if ($tableName !== 'sqlite_sequence') {
                    $count = DB::table($tableName)->count();
                    $tableInfo[] = [
                        'name' => $tableName,
                        'count' => $count
                    ];
                }
            }

            return view('admin.database', compact('tableInfo'));
            
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function logout()
    {
        Session::forget('admin_logged_in');
        return redirect()->route('admin.login')->with('success', 'Logout berhasil!');
    }
}
