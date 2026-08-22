@extends('layouts.admin')

@section('admin-content')
    <div class="mb-8">
        <a href="{{ route('admin.rooms.index') }}"
            class="group inline-flex items-center text-sm font-semibold text-slate-500 hover:text-cyan-600 transition-colors mb-4">
            <svg class="w-4 h-4 mr-2 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar Unit
        </a>
        
        <h1 class="text-3xl font-bold text-slate-900 tracking-tight">
            Kalender Unit: {{ $room->namakamar ?? $room->namavilla }}
        </h1>
        <p class="text-slate-500 mt-1 font-medium">Monitoring ketersediaan dan jadwal hunian unit secara real-time.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        {{-- Side Cards --}}
        <div class="lg:col-span-1 space-y-6">
            {{-- Legend Card --}}
            <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm shadow-slate-200/50">
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-5">Keterangan</h3>
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-3.5 h-3.5 rounded-full bg-emerald-500 shadow-sm shadow-emerald-200"></div>
                        <span class="text-sm font-semibold text-slate-700">Terisi (Disetujui)</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-3.5 h-3.5 rounded-full bg-amber-500 shadow-sm shadow-amber-200"></div>
                        <span class="text-sm font-semibold text-slate-700">Menunggu (Pending)</span>
                    </div>
                </div>
            </div>

            {{-- Metric Card --}}
            <div class="bg-slate-900 rounded-3xl p-7 text-white shadow-xl shadow-slate-900/10 relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19,4H18V2H16V4H8V2H6V4H5A2,2 0 003,6V20A2,2 0 005,22H19A2,2 0 0021,20V6A2,2 0 0019,4M19,20H5V10H19V20M19,8H5V6H19V8Z" />
                    </svg>
                </div>
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1 relative z-10">Booking Aktif</h3>
                <div class="relative z-10">
                    <span class="text-5xl font-bold tracking-tighter">{{ count($bookedDates) }}</span>
                    <span class="text-slate-400 text-sm font-medium ml-1">Jadwal</span>
                </div>
                <p class="text-xs text-slate-500 mt-4 leading-relaxed font-medium relative z-10">
                    Total jadwal yang terdata di sistem untuk unit ini.
                </p>
            </div>
        </div>

        {{-- Calendar Card --}}
        <div class="lg:col-span-3">
            <div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/40 p-1 overflow-hidden">
                <div class="p-6">
                    <div id="calendar" class="min-h-[650px]"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
    <style>
        /* Modern Calendar Overrides */
        .fc {
            --fc-border-color: #f1f5f9;
            --fc-today-bg-color: #f8fafc;
            --fc-page-bg-color: #ffffff;
            font-family: inherit;
        }

        .fc .fc-toolbar-title {
            font-size: 1.4rem !important;
            font-weight: 800 !important;
            color: #1e293b !important;
            letter-spacing: -0.02em !important;
        }

        .fc .fc-button-primary {
            background-color: #f1f5f9 !important;
            border: none !important;
            color: #475569 !important;
            font-weight: 700 !important;
            text-transform: capitalize !important;
            padding: 0.6rem 1rem !important;
            border-radius: 0.75rem !important;
            transition: all 0.2s ease !important;
            box-shadow: none !important;
        }

        .fc .fc-button-primary:hover {
            background-color: #e2e8f0 !important;
            color: #0f172a !important;
        }

        .fc .fc-button-active {
            background-color: #0f172a !important;
            color: #ffffff !important;
        }

        .fc th {
            padding: 15px 0 !important;
            background: #ffffff !important;
            color: #94a3b8 !important;
            font-size: 0.75rem !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.05em !important;
            border-bottom: 2px solid #f1f5f9 !important;
        }

        .fc-day-today {
            position: relative;
        }

        .fc-daygrid-day-number {
            font-weight: 700 !important;
            color: #64748b !important;
            padding: 0.75rem !important;
            font-size: 0.85rem !important;
        }

        .fc-event {
            border: none !important;
            padding: 4px 10px !important;
            border-radius: 0.5rem !important;
            font-weight: 700 !important;
            font-size: 0.7rem !important;
            margin: 2px 4px !important;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05) !important;
            cursor: default;
        }

        .fc-daygrid-more-link {
            font-weight: 800 !important;
            color: #0ea5e9 !important;
            font-size: 0.65rem !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'id',
                buttonText: {
                    today: 'Hari Ini',
                    month: 'Bulanan'
                },
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: ''
                },
                events: [
                    @foreach($bookedDates as $booking)
                        {
                            title: 'Terisi',
                            start: '{{ $booking->start_date }}',
                            end: '{{ \Carbon\Carbon::parse($booking->end_date)->addDay()->format("Y-m-d") }}',
                            backgroundColor: '{{ in_array($booking->status ?? "", ["disetujui", "approved"]) ? "#10b981" : "#f59e0b" }}',
                            allDay: true
                        },
                    @endforeach
                ],
                eventContent: function (arg) {
                    return {
                        html: `<div class="flex items-center gap-1.5 py-0.5">
                                    <div class="w-1.5 h-1.5 rounded-full bg-white/80"></div>
                                    <span class="truncate">${arg.event.title}</span>
                               </div>`
                    };
                }
            });
            calendar.render();
        });
    </script>
@endsection