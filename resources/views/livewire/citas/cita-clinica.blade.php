<div>
 
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    
        <div class="p-6 rounded-3xl shadow-2xl bg-white dark:bg-gray-800 transition duration-300 ring-1 ring-gray-200 dark:ring-gray-600">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">🗓️ Agenda de Citas</h2>
                    <p class="text-gray-500 dark:text-gray-300">Visualiza todas las citas de la clínica</p>
                </div>
                <button @click="Livewire.dispatch('calendar:load')" class="px-3 py-1 text-sm rounded bg-blue-500 hover:bg-blue-600 text-white shadow">
                    🔄 Recargar
                </button>
            </div>
            <div x-data x-init="$nextTick(() => {Livewire.dispatch('calendar:load');    }); " >
                <div id="calendar"></div>
            </div>
        </div>
        
        <script>
          
                Livewire.on('calendar:load', () => {
                    let lastClickTime = 0;
                    let calendarEl = document.getElementById('calendar');
                    if (!calendarEl) return;
                    let calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'timeGridDay', // Vista diaria
                    slotMinTime: '08:00:00',
                    slotMaxTime: '22:00:00',
                    locale: 'es',
                    allDaySlot: false,
                    nowIndicator: true,
                    height: 'auto',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    buttonText: {
                    today: 'Hoy',
                    month: 'Mes',
                    week: 'Semana',
                    day: 'Día',
                    list: 'Lista'
                },
                events: @json($citas),
                    eventDidMount: function (info) {
                        // Estilizar evento manualmente
                        info.el.style.borderRadius = '12px';
                        info.el.style.backgroundColor = info.event.extendedProps.tipo === 'grupal' ? '#a5b4fc' : '#6ee7b7';
                        info.el.style.color = '#1f2937';
                        info.el.style.padding = '3px 4px';
                        info.el.style.fontSize = '0.85rem';
                        info.el.style.boxShadow = '0 2px 4px rgba(0,0,0,0.1)';
                    
                    // Colores por estado
                   // let estado = info.event.extendedProps.estado;
                    let estado = info.event.classNames[0];

                    let color = '#9ca3af'; // gris por defecto
                    if (estado === 'evento-pendiente') color = '#f59e0b';     // ámbar
                    if (estado === 'evento-confirmado') color = '#10b981';   // verde
                    if (estado === 'evento-cancelado') color = '#ef4444';    // rojo

                    // Aplica borde izquierdo visible en todas las vistas
                    info.el.style.borderLeft = '5px solid ' + color;
                    info.el.style.borderRadius = '4px';

                    // Opcional: ícono junto al título
                    const icon = document.createElement('span');
                    icon.textContent = estado === 'evento-confirmado' ? '✔️ ' : estado === 'evento-cancelado' ? '❌ ' : '⏳ ';
                    const titleEl = info.el.querySelector('.fc-event-title');
                    if (titleEl) {
                        titleEl.prepend(icon);
                    }
                },
                //cambia la vista de mes a dia con un click
                dateClick: function(info) {
                    calendar.changeView('timeGridDay', info.dateStr);
                },
            
            });
    
                calendar.render();
    
                // Para futuras actualizaciones
                Livewire.on('refresh-calendar', (updatedEvents) => {
                    calendar.removeAllEvents();
                    calendar.addEventSource(updatedEvents);
                });
            });
     
        
        </script>
    
    
</div>
