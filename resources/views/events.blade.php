@extends('layouts.app')

@section('title', 'Kalender Kegiatan - BOI Bekasi')

@section('content')
<style>
    .calendar-day {
        min-height: 100px;
        transition: all 0.3s ease;
        border-radius: 8px;
        border: 1px solid #e9ecef;
        margin: 2px;
        position: relative;
    }
    
    .calendar-day:hover {
        background-color: #f8f9fa;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        border-color: #28a745;
    }
    
    .calendar-event-day {
        background-color: #e8f5e8 !important;
        border: 2px solid #28a745 !important;
        box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
    }
    
    .calendar-event-day:hover {
        background-color: #d4edda !important;
        border-color: #1e7e34 !important;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.4);
    }
    
    .calendar-day-number {
        font-size: 1.1rem;
        margin-bottom: 4px;
    }
    
    .event-indicators {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 2px;
        align-items: center;
    }
    
    .event-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
        margin: 1px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.3);
        border: 1px solid rgba(255,255,255,0.8);
    }
    
    .event-more {
        font-weight: bold;
        margin-left: 2px;
    }
    
    .holiday-day {
        background: linear-gradient(135deg, #fff3cd, #ffeaa7) !important;
        border: 2px solid #ffc107 !important;
        box-shadow: 0 2px 8px rgba(255, 193, 7, 0.3);
    }
    
    .holiday-day:hover {
        background: linear-gradient(135deg, #fff3cd, #ffe082) !important;
        border-color: #ff8f00 !important;
        box-shadow: 0 4px 15px rgba(255, 193, 7, 0.4);
    }
    
    .holiday-indicator {
        position: absolute;
        top: 2px;
        right: 2px;
        font-size: 0.8rem;
        color: #dc3545;
    }
    
    .holiday-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
        margin: 1px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.3);
    }
    
    .calendar-grid .row {
        margin: 0;
    }
    
    .calendar-grid .col {
        padding: 2px;
        border-right: 1px solid #dee2e6;
    }
    
    .calendar-grid .col:last-child {
        border-right: none;
    }
    
    .calendar-header {
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
        padding: 1rem;
        border-radius: 10px 10px 0 0;
        margin-bottom: 0;
    }
    
    .calendar-container {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    @media (max-width: 768px) {
        .calendar-day {
            min-height: 60px;
            font-size: 0.9rem;
        }
        
        .event-dot {
            width: 6px;
            height: 6px;
        }
        
        .calendar-day-number {
            font-size: 1rem;
        }
    }
</style>
<!-- Header Section -->
<section class="hero-section py-5">
    <div class="container">
        <div class="text-center">
            <h1 class="display-4 fw-bold mb-3">
                <span class="text-success">Kalender Kegiatan</span>
            </h1>
            <p class="lead">Jadwal lengkap kegiatan BOI Bekasi bulan ini</p>
        </div>
    </div>
</section>



<!-- Monthly Calendar View -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="calendar-container">
                            <!-- Calendar Navigation -->
                            <div class="calendar-header d-flex justify-content-between align-items-center mb-4">
                                <a href="{{ route('events', ['month' => $calendarData['prevMonth']->format('n'), 'year' => $calendarData['prevMonth']->format('Y')]) }}" 
                                   class="btn btn-outline-success">
                                    <i class="fas fa-chevron-left"></i> {{ $calendarData['prevMonth']->format('M') }}
                                </a>
                                <h4 class="text-success mb-0">{{ $calendarData['monthName'] }}</h4>
                                <a href="{{ route('events', ['month' => $calendarData['nextMonth']->format('n'), 'year' => $calendarData['nextMonth']->format('Y')]) }}" 
                                   class="btn btn-outline-success">
                                    {{ $calendarData['nextMonth']->format('M') }} <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                            
                            <div class="calendar-grid">
                                <!-- Day Headers -->
                                <div class="row text-center fw-bold bg-success text-white py-2">
                                    <div class="col">Min</div>
                                    <div class="col">Sen</div>
                                    <div class="col">Sel</div>
                                    <div class="col">Rab</div>
                                    <div class="col">Kam</div>
                                    <div class="col">Jum</div>
                                    <div class="col">Sab</div>
                                </div>
                                
                                <!-- Calendar Weeks -->
                                @foreach($calendarData['weeks'] as $week)
                                <div class="row text-center border-bottom">
                                    @foreach($week as $day)
                                    <div class="col py-2 position-relative calendar-day {{ !$day['isCurrentMonth'] ? 'text-muted' : '' }} 
                                         {{ $day['hasEvents'] ? 'calendar-event-day' : '' }}
                                         {{ $day['hasHolidays'] ? 'holiday-day' : '' }}"
                                         @if($day['hasEvents']) 
                                         style="cursor: pointer;"
                                         onclick="showDayEvents('{{ $day['date'] }}', {{ $day['events']->toJson() }}, {{ $day['holidays']->toJson() }})"
                                         @endif>
                                        
                                        <!-- Day Number -->
                                        <div class="calendar-day-number {{ $day['hasEvents'] ? 'fw-bold' : '' }} {{ $day['hasHolidays'] ? 'text-danger fw-bold' : '' }}">
                                            {{ $day['day'] }}
                                        </div>
                                        
                                        <!-- Holiday Text -->
                                        @if($day['hasHolidays'])
                                            <div class="text-center mt-1">
                                                @foreach($day['holidays'] as $holiday)
                                                    <small class="d-block text-danger fw-bold" style="font-size: 0.65rem; line-height: 1.1;" title="{{ $holiday->description }}">
                                                        {{ $holiday->name }}
                                                    </small>
                                                @endforeach
                                            </div>
                                        @endif
                                        
                                        <!-- Event Indicators -->
                                        @if($day['hasEvents'])
                                            <div class="event-indicators mt-1">
                                                @foreach($day['events']->take(3) as $event)
                                                    @php
                                                        $typeColors = [
                                                            'kopdar' => 'primary',
                                                            'touring' => 'success',
                                                            'baksos' => 'warning',
                                                            'workshop' => 'info',
                                                            'sunmori' => 'secondary'
                                                        ];
                                                        $color = $typeColors[$event->type] ?? 'primary';
                                                    @endphp
                                                    <div class="event-dot bg-{{ $color }}" 
                                                         title="{{ $event->title }} - {{ ucfirst($event->type) }}">
                                                    </div>
                                                @endforeach
                                                @if($day['eventCount'] > 3)
                                                    <div class="event-more text-success" title="+{{ $day['eventCount'] - 3 }} kegiatan lagi">
                                                        <small>+{{ $day['eventCount'] - 3 }}</small>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Day Events Modal -->
<div class="modal fade" id="dayEventsModal" tabindex="-1" aria-labelledby="dayEventsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="dayEventsModalLabel">Kegiatan Hari Ini</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="dayEventsContent">
                <!-- Day events will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Event Details Modal -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="eventModalLabel">Detail Kegiatan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <h4 id="modalEventTitle" class="text-success mb-3"></h4>
                        <p id="modalEventDescription" class="text-muted mb-4"></p>
                        
                        <div class="event-details">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar text-success me-3 fa-lg"></i>
                                        <div>
                                            <strong>Tanggal</strong><br>
                                            <span id="modalEventDate"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-clock text-success me-3 fa-lg"></i>
                                        <div>
                                            <strong>Waktu</strong><br>
                                            <span id="modalEventTime"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-map-marker-alt text-success me-3 fa-lg"></i>
                                        <div>
                                            <strong>Lokasi</strong><br>
                                            <span id="modalEventLocation"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-tag text-success me-3 fa-lg"></i>
                                        <div>
                                            <strong>Jenis Kegiatan</strong><br>
                                            <span id="modalEventType" class="badge"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-light rounded p-3">
                            <h6 class="text-success mb-3">
                                <i class="fas fa-info-circle me-2"></i>Informasi Penting
                            </h6>
                            <ul class="list-unstyled small">
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Pastikan motor dalam kondisi baik
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Bawa surat-surat lengkap
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Datang tepat waktu
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Patuhi protokol keselamatan
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-outline-success" onclick="addToCalendarFromModal()">
                    <i class="fas fa-calendar-plus me-2"></i>Tambah ke Kalender
                </button>
                <button type="button" class="btn btn-success" onclick="registerEventFromModal()">
                    <i class="fab fa-whatsapp me-2"></i>Daftar Kegiatan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Legend -->
<section class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h5 class="text-center mb-3">Keterangan Jenis Kegiatan</h5>
                <div class="row g-2 text-center">
                    <div class="col-md-2">
                        <span class="badge bg-primary">Kopdar</span>
                    </div>
                    <div class="col-md-2">
                        <span class="badge bg-success">Touring</span>
                    </div>
                    <div class="col-md-2">
                        <span class="badge bg-warning">Baksos</span>
                    </div>
                    <div class="col-md-2">
                        <span class="badge bg-info">Workshop</span>
                    </div>
                    <div class="col-md-2">
                        <span class="badge bg-secondary">Sunmori</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Join Section -->
<section class="py-5 bg-dark text-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h3 class="mb-4">Jangan Sampai Ketinggalan!</h3>
                <p class="lead mb-4">
                    Bergabunglah dengan grup WhatsApp BOI Bekasi untuk mendapatkan update terbaru tentang semua kegiatan kami.
                </p>
                <a href="https://wa.me/6281234567890?text=Halo%20BOI%20Bekasi,%20saya%20ingin%20bergabung%20dengan%20grup%20WhatsApp%20untuk%20update%20kegiatan" 
                   class="whatsapp-btn" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                    Join Grup WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    // Event modal data storage
    let currentEventData = {};
    
    // Show events for a specific day
    function showDayEvents(date, events) {
        const modal = new bootstrap.Modal(document.getElementById('dayEventsModal'));
        const modalTitle = document.getElementById('dayEventsModalLabel');
        const modalContent = document.getElementById('dayEventsContent');
        
        // Format date for display
        const dateObj = new Date(date);
        const formattedDate = dateObj.toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        
        modalTitle.textContent = `Kegiatan - ${formattedDate}`;
        
        // Build events HTML
        let eventsHtml = '';
        if (events.length === 0) {
            eventsHtml = '<p class="text-muted">Tidak ada kegiatan pada hari ini.</p>';
        } else {
            events.forEach(event => {
                const typeColors = {
                    'kopdar': 'primary',
                    'touring': 'success',
                    'baksos': 'warning',
                    'workshop': 'info',
                    'sunmori': 'secondary'
                };
                const color = typeColors[event.type] || 'primary';
                
                eventsHtml += `
                    <div class="card mb-3 border-start border-${color} border-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="card-title fw-bold mb-0">${event.title}</h6>
                                <span class="badge bg-${color}">${event.type.charAt(0).toUpperCase() + event.type.slice(1)}</span>
                            </div>
                            <p class="card-text text-muted mb-2">${event.description}</p>
                            <div class="row g-2 mb-3">
                                <div class="col-md-6">
                                    <small><i class="fas fa-clock text-success me-1"></i> ${event.time}</small>
                                </div>
                                <div class="col-md-6">
                                    <small><i class="fas fa-map-marker-alt text-success me-1"></i> ${event.location}</small>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <button class="btn btn-success btn-sm" onclick="registerEventFromDay('${event.title}')">
                                    <i class="fab fa-whatsapp me-1"></i> Daftar
                                </button>
                                <button class="btn btn-outline-success btn-sm" onclick="showEventDetails(${JSON.stringify(event).replace(/"/g, '&quot;')})">
                                    <i class="fas fa-info-circle me-1"></i> Detail
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            });
        }
        
        modalContent.innerHTML = eventsHtml;
        modal.show();
    }
    
    // Show single event details
    function showEventDetails(event) {
        // Close day events modal first
        const dayModal = bootstrap.Modal.getInstance(document.getElementById('dayEventsModal'));
        if (dayModal) {
            dayModal.hide();
        }
        
        // Show event details modal
        currentEventData = event;
        const modal = new bootstrap.Modal(document.getElementById('eventModal'));
        
        // Populate modal with event data
        document.getElementById('modalEventTitle').textContent = event.title;
        document.getElementById('modalEventDescription').textContent = event.description;
        document.getElementById('modalEventDate').textContent = new Date(event.date).toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        document.getElementById('modalEventTime').textContent = event.time;
        document.getElementById('modalEventLocation').textContent = event.location;
        document.getElementById('modalEventType').textContent = event.type.charAt(0).toUpperCase() + event.type.slice(1);
        
        // Set type badge color
        const typeColors = {
            'kopdar': 'primary',
            'touring': 'success',
            'baksos': 'warning',
            'workshop': 'info',
            'sunmori': 'secondary'
        };
        const typeBadge = document.getElementById('modalEventType');
        typeBadge.className = `badge bg-${typeColors[event.type] || 'primary'}`;
        
        modal.show();
    }
    
    // Register for event from day modal
    function registerEventFromDay(title) {
        const message = `Halo, saya ingin mendaftar untuk kegiatan "${title}". Mohon informasi lebih lanjut.`;
        const whatsappUrl = `https://wa.me/6281234567890?text=${encodeURIComponent(message)}`;
        window.open(whatsappUrl, '_blank');
    }
    
    // Handle event modal show
    document.addEventListener('DOMContentLoaded', function() {
        const eventModal = document.getElementById('eventModal');
        
        eventModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            
            // Extract event data from button attributes
            currentEventData = {
                id: button.getAttribute('data-event-id'),
                title: button.getAttribute('data-event-title'),
                description: button.getAttribute('data-event-description'),
                date: button.getAttribute('data-event-date'),
                time: button.getAttribute('data-event-time'),
                location: button.getAttribute('data-event-location'),
                type: button.getAttribute('data-event-type')
            };
            
            // Populate modal with event data
            document.getElementById('modalEventTitle').textContent = currentEventData.title;
            document.getElementById('modalEventDescription').textContent = currentEventData.description || 'Tidak ada deskripsi tersedia.';
            document.getElementById('modalEventDate').textContent = currentEventData.date;
            document.getElementById('modalEventTime').textContent = currentEventData.time || 'Waktu belum ditentukan';
            document.getElementById('modalEventLocation').textContent = currentEventData.location || 'Lokasi belum ditentukan';
            
            // Set event type badge
            const typeElement = document.getElementById('modalEventType');
            const typeColors = {
                'kopdar': 'bg-primary',
                'touring': 'bg-success',
                'baksos': 'bg-warning',
                'workshop': 'bg-info',
                'sunmori': 'bg-secondary'
            };
            
            typeElement.textContent = currentEventData.type ? currentEventData.type.charAt(0).toUpperCase() + currentEventData.type.slice(1) : 'Umum';
            typeElement.className = `badge ${typeColors[currentEventData.type] || 'bg-primary'}`;
        });
    });
    
    // Add to Google Calendar function from modal
    function addToCalendarFromModal() {
        if (!currentEventData.title) return;
        
        const title = currentEventData.title;
        const description = currentEventData.description || '';
        const date = currentEventData.date;
        const time = currentEventData.time || '09:00';
        const location = currentEventData.location || '';
        
        addToCalendar(title, description, date, time, location);
    }
    
    // Register for event via WhatsApp from modal
    function registerEventFromModal() {
        if (!currentEventData.title) return;
        
        const title = currentEventData.title;
        const date = currentEventData.date;
        const message = `Halo, saya ingin mendaftar untuk kegiatan "${title}" pada tanggal ${date}. Mohon informasi lebih lanjut.`;
        const whatsappUrl = `https://wa.me/6281234567890?text=${encodeURIComponent(message)}`;
        window.open(whatsappUrl, '_blank');
    }
    
    // Add to Google Calendar function
    function addToCalendar(title, description, date, time, location) {
        // Parse the Indonesian date format
        const months = {
            'Januari': '01', 'Februari': '02', 'Maret': '03', 'April': '04',
            'Mei': '05', 'Juni': '06', 'Juli': '07', 'Agustus': '08',
            'September': '09', 'Oktober': '10', 'November': '11', 'Desember': '12'
        };
        
        let formattedDate = date;
        for (const [indo, num] of Object.entries(months)) {
            formattedDate = formattedDate.replace(indo, num);
        }
        
        // Convert to YYYY-MM-DD format
        const dateParts = formattedDate.split(' ');
        if (dateParts.length === 3) {
            const day = dateParts[0].padStart(2, '0');
            const month = dateParts[1];
            const year = dateParts[2];
            formattedDate = `${year}-${month}-${day}`;
        }
        
        const startDate = new Date(formattedDate + ' ' + time);
        const endDate = new Date(startDate.getTime() + 2 * 60 * 60 * 1000); // Add 2 hours
        
        const formatDate = (date) => {
            return date.toISOString().replace(/[-:]/g, '').split('.')[0] + 'Z';
        };
        
        const googleCalendarUrl = `https://calendar.google.com/calendar/render?action=TEMPLATE&text=${encodeURIComponent(title)}&dates=${formatDate(startDate)}/${formatDate(endDate)}&details=${encodeURIComponent(description)}&location=${encodeURIComponent(location)}`;
        
        window.open(googleCalendarUrl, '_blank');
    }
    
    // Register for event via WhatsApp
    function registerEvent(title) {
        const message = `Halo, saya ingin mendaftar untuk kegiatan "${title}". Mohon informasi lebih lanjut.`;
        const whatsappUrl = `https://wa.me/6281234567890?text=${encodeURIComponent(message)}`;
        window.open(whatsappUrl, '_blank');
    }
</script>
@endsection
