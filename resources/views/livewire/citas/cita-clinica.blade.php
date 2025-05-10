<div>
    @assets
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    @endassets


    

    <!-- Modal para crear cita usando Flux -->
    @include('livewire.citas.modal2')
    <!-- Modal para editar cita usando Flux -->
    @include('livewire.citas.modal')

    <x-page-header title="🗓️ Agenda de Citas" subtitle="Visualiza todas las citas de la clínica" color="lime"
        :clickable="true" badge="Nuevo" icon="check" footer="Texto de pie" wire:key="factura-filtros">
        

        @include('livewire.citas.filtroprofesionales')

        <div wire:ignore x-data x-init="$nextTick(() => { Livewire.dispatch('calendar2:load'); });">
            <div id="calendar2"></div>
        </div>

        
        

    </x-page-header>


    @script
    <script>
     let calendar;
        Livewire.on('calendar2:load', () => {
            let calendarEl = document.getElementById('calendar2');
            if (!calendarEl) return;
    
             calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridDay',
                slotMinTime: '08:00:00',
                slotMaxTime: '22:00:00',
                locale: 'es',
                allDaySlot: false,
                nowIndicator: true,
                height: 'auto',
                hiddenDays: [0],
                slotDuration: '00:15:00',
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
                selectable: true,
                select: function(info) {
                    const eventData = {
                        start: info.startStr,
                        end: info.endStr,
                        date: info.startStr.split('T')[0]
                    };
                    @this.openCreateModal(eventData);
                },
                events: @json($citas),

                eventDidMount: function(info) {
        const profesionalColor = info.event.extendedProps.profesional?.color || '#3b82f6';
        const estado = info.event.classNames[0]; // evento-pendiente, evento-confirmado, etc.

        // Convertir HEX a RGBA
        function hexToRgba(hex, alpha = 0.5) {
            const shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
            hex = hex.replace(shorthandRegex, function(m, r, g, b) {
                return r + r + g + g + b + b;
            });
            const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
            return result ? `rgba(${parseInt(result[1], 16)}, ${parseInt(result[2], 16)}, ${parseInt(result[3], 16)}, ${alpha})` : hex;
        }

        const background = hexToRgba(profesionalColor, 0.5);

        // Estilo base
        info.el.style.borderRadius = '4px';
        info.el.style.color = '#1f2937';
        info.el.style.fontSize = '0.85rem';

        if (info.view.type === 'dayGridMonth') {
            // Estilos para la vista mensual (tipo grid)
            info.el.style.backgroundColor = background;
            info.el.style.border = '1px solid #ccc';

            // También podrías aplicar a un inner div si FullCalendar no aplica al <a>
            const title = info.el.querySelector('.fc-event-title');
            if (title) title.style.color = '#1f2937';

        } else {
            // Estilos para timeGrid (día, semana)
            info.el.style.backgroundColor = background;
            info.el.style.boxShadow = '0 2px 4px rgba(0,0,0,0.1)';
            info.el.style.padding = '3px 4px';

            // Borde izquierdo por estado
            let borderColor = '#9ca3af';
            if (estado === 'evento-pendiente') borderColor = '#f59e0b';
            if (estado === 'evento-confirmado') borderColor = '#10b981';
            if (estado === 'evento-cancelado') borderColor = '#ef4444';

            info.el.style.borderLeft = '5px solid ' + borderColor;

            // Icono visual
            const icon = document.createElement('span');
            icon.textContent = estado === 'evento-confirmado' ? '✔️ ' :
                            estado === 'evento-cancelado' ? '❌ ' : '⏳ ';
            const titleEl = info.el.querySelector('.fc-event-title');
            if (titleEl) titleEl.prepend(icon);
        }
    },

                dateClick: function(info) {
                    calendar.changeView('timeGridDay', info.dateStr);
                },
                eventClick: function(info) {
                    info.jsEvent.preventDefault();
                    const eventData = {
                        citaId: info.event.id,
                        title: info.event.title,
                        start: info.event.start ? info.event.start.toISOString() : null,
                        end: info.event.end ? info.event.end.toISOString() : null,
                        tipo: info.event.extendedProps.tipo,
                        estado: info.event.classNames[0]?.replace('evento-', '')
                    };
    
                    @this.openCitaModal(eventData);
                }
            });
    
           
    
           
    
            calendar.render();
        });

        // ✅ Refrescar eventos correctamente desde Livewire
    Livewire.on('refresh-calendar', (updatedEvents) => {
        if (!calendar || typeof calendar.removeAllEvents !== 'function') {
            console.warn('Calendario no inicializado correctamente');
            return;
        }

        const eventos = updatedEvents.updatedEvents || updatedEvents;

        if (!Array.isArray(eventos)) {
            console.error('Formato incorrecto de eventos:', eventos);
            return;
        }
       // console.log(eventos);
        calendar.removeAllEvents();
        calendar.addEventSource(eventos);
      //  console.log(updatedEvents.updatedEvents);
        
    });
    
    </script>
    @endscript
</div>

