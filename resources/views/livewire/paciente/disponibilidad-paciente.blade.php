<div>

        
        <x-page-header 
    title="Disponibilidad de horarios de {{ $paciente->nombre }} {{ $paciente->apellido }}" 
    color="green"
/>
       

        <style>
            /* Oculta la línea de la fecha (ej. "29 abr") pero deja el nombre del día visible */
            .fc .fc-col-header-cell .fc-col-header-cell-cushion > span:nth-child(2) {
                display: none;
            }
        </style>


    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

   
    <div x-data x-init="Livewire.dispatch('calendar:load')">
        <div id="calendar"></div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Livewire.on('calendar:load', () => {
                let lastClickTime = 0;
                let calendarEl = document.getElementById('calendar');
                if (!calendarEl) return;
        
    
                let calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'timeGridWeek',
                    slotMinTime: '08:00:00',
                    slotMaxTime: '22:00:00',
                    allDaySlot: false,
                    height: 'auto',
                    locale: 'es',
                    dayHeaderFormat: { weekday: 'long' },
                    hiddenDays: [0],
                    headerToolbar: {
                        left: '',
                        center: '',
                        right: ''
                    },
                    events: `/disponibilidad/{{ $paciente->id }}/ver`,
                    selectable: true,
                    selectMirror: true,
                    select: function(info) {
                            const start = info.startStr;
                            const end = info.endStr;

                            // Usamos Livewire para guardar
                            @this.store(start, end).then(() => {
                                Livewire.dispatch('calendar:load');
                            });
                        },
                        eventClick: function(info) {
                            const now = new Date().getTime();
                            if (now - lastClickTime < 400) {
                                @this.eliminar(info.event.id).then(() => {
                                    Livewire.dispatch('calendar:load');
                                });
                            }
                            lastClickTime = now;
                        }
                });
    
                calendar.render();
            });
        });
        
      
    </script>
</div>