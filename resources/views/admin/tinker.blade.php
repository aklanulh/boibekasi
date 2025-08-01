@extends('layouts.admin')

@section('title', 'Tinker - Admin Panel')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-3">
                <i class="fas fa-terminal me-2"></i>
                PHP Tinker
            </h1>
            <p class="text-muted">Execute PHP code securely. Dangerous operations are blocked for security.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-code me-2"></i>
                        Code Editor
                    </h5>
                </div>
                <div class="card-body">
                    <form id="tinkerForm">
                        @csrf
                        <div class="mb-3">
                            <label for="code" class="form-label">PHP Code (without &lt;?php tags):</label>
                            <textarea class="form-control" id="code" name="code" rows="8" placeholder="Example:&#10;use App\Models\Event;&#10;$events = Event::all();&#10;echo 'Total events: ' . $events->count();&#10;&#10;// Or test database connection:&#10;echo 'Database connection: ' . (DB::connection()->getPdo() ? 'OK' : 'Failed');"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-play me-1"></i>
                            Execute
                        </button>
                        <button type="button" class="btn btn-secondary" onclick="clearCode()">
                            <i class="fas fa-trash me-1"></i>
                            Clear
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-terminal me-2"></i>
                        Output
                    </h5>
                </div>
                <div class="card-body">
                    <pre id="output" class="bg-dark text-light p-3 rounded" style="min-height: 200px; white-space: pre-wrap;">Ready to execute PHP code...</pre>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Quick Examples
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Database Queries:</h6>
                            <button class="btn btn-sm btn-outline-primary mb-2" onclick="insertExample('use App\\Models\\Event;\\n$events = Event::all();\\necho \"Total events: \" . $events->count();')">Count Events</button>
                            <button class="btn btn-sm btn-outline-primary mb-2" onclick="insertExample('use App\\Models\\Member;\\n$members = Member::all();\\nforeach($members as $member) {\\n    echo $member->name . \"\\n\";\\n}')">List Members</button>
                            <button class="btn btn-sm btn-outline-primary mb-2" onclick="insertExample('echo \"Database connection: \" . (DB::connection()->getPdo() ? \"OK\" : \"Failed\");')">Test DB Connection</button>
                        </div>
                        <div class="col-md-6">
                            <h6>System Info:</h6>
                            <button class="btn btn-sm btn-outline-success mb-2" onclick="insertExample('echo \"PHP Version: \" . phpversion();\\necho \"\\nLaravel Version: \" . app()->version();')">Version Info</button>
                            <button class="btn btn-sm btn-outline-success mb-2" onclick="insertExample('echo \"Environment: \" . app()->environment();\\necho \"\\nDebug Mode: \" . (config(\"app.debug\") ? \"ON\" : \"OFF\");')">Environment Info</button>
                            <button class="btn btn-sm btn-outline-success mb-2" onclick="insertExample('$tables = DB::select(\"SELECT name FROM sqlite_master WHERE type=\\\"table\\\"\");\\nforeach($tables as $table) {\\n    echo $table->name . \"\\n\";\\n}')">List Tables</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('tinkerForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const code = document.getElementById('code').value;
    const output = document.getElementById('output');
    
    if (!code.trim()) {
        output.textContent = 'Error: Please enter some PHP code to execute.';
        return;
    }
    
    output.textContent = 'Executing...';
    
    fetch('{{ route("admin.tinker.execute") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ code: code })
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            output.textContent = 'Error: ' + data.error;
            output.className = 'bg-danger text-light p-3 rounded';
        } else {
            output.textContent = data.output || 'Code executed successfully (no output)';
            output.className = 'bg-dark text-light p-3 rounded';
        }
    })
    .catch(error => {
        output.textContent = 'Network Error: ' + error.message;
        output.className = 'bg-danger text-light p-3 rounded';
    });
});

function clearCode() {
    document.getElementById('code').value = '';
    document.getElementById('output').textContent = 'Ready to execute PHP code...';
    document.getElementById('output').className = 'bg-dark text-light p-3 rounded';
}

function insertExample(code) {
    document.getElementById('code').value = code;
}
</script>
@endsection
