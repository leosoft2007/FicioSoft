<div>
    @assets
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="https://unpkg.com/tippy.js@6"></script>
    @endassets

    <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/dist/tippy.css" />




    <x-page-header title="🗓️ Agenda de Citas" color="lime" :clickable="true" badge="Nuevo" icon="check"
        footer="Texto de pie" wire:key="factura-filtros">

        @include('livewire.citas.filtroprofesionales')

        <div wire:ignore x-data x-init="$nextTick(() => { Livewire.dispatch('calendar3:load'); });">
            <div id="calendar3"></div>
        </div>
        @include('livewire.grupos.modal')
        @include('livewire.grupos.modalCondicion')
        <!-- Modal para crear cita usando Flux -->
        @include('livewire.citas.modal2')
        <!-- Modal para editar cita usando Flux -->
        @include('livewire.citas.modal')
        @include('livewire.grupos.grupoOcurranciaModal')
        @include('livewire.grupos.OcurrenciaUnicaModal')


        <!-- mensajes de sesion -->
        @if (session()->has('message'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition
                class="fixed top-6 right-6 max-w-md w-auto bg-green-100 border border-green-400 text-green-900 text-lg font-semibold px-6 py-4 rounded-xl shadow-2xl z-50">
                {{ session('message') }}
            </div>
        @endif



    </x-page-header>


    @include('livewire.grupos.modal')


    @script
        <script>
            let calendar;
            Livewire.on('calendar3:load', () => {
                let calendarEl = document.getElementById('calendar3');
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
                    slotDuration: '00:30:00',
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
                        list: '📃'
                    },
                    selectable: true,
                    selectAllow: function(selectInfo) {
                        // Solo permitir selección si estamos en la vista diaria
                        return calendar.view.type === 'timeGridDay' || calendar.view.type ===
                            'timeGridWeek';
                    },
                    select: function(info) {
                        const eventData = {
                            start: info.startStr,
                            end: info.endStr,
                            date: info.startStr.split('T')[0]
                        };

                        @this.set('datosSeleccion', eventData);
                        @this.set('mostrarSelectorTipoCita', true); // abrir modal de tipo de cita
                    },


                    events: @json($citas),

                    eventDidMount: function(info) {
                        // Reemplaza el título del evento
                        const titleEl = info.el.querySelector('.fc-event-title');
                        if (titleEl && info.event.extendedProps.titleHtml) {
                            titleEl.innerHTML = info.event.extendedProps.titleHtml;
                        }

                        // Aplica tooltip personalizado con Tippy
                        if (info.event.extendedProps.tooltipHtml) {
                            tippy(info.el, {
                                content: info.event.extendedProps.tooltipHtml,
                                allowHTML: true,
                                theme: 'light-border',
                                placement: 'top',
                                maxWidth: 300,
                                trigger: 'mouseenter focus', // Solo mouse y teclado, no 'click'
                                touch: ['hold', 500], // 👈 long press en móvil (medio segundo)
                                onShow(instance) {
                                    // Si es touch, ocultar el tooltip después de un tiempo
                                    if ('ontouchstart' in window) {
                                        setTimeout(() => instance.hide(), 2000);
                                    }
                                }
                            });
                        }

                        const profesionalColor = info.event.extendedProps.profesional?.color || '#3b82f6';
                        const estado = info.event.classNames[
                            0]; // evento-pendiente, evento-confirmado, etc.

                        // Convertir HEX a RGBA
                        function hexToRgba(hex, alpha = 0.5) {
                            const shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
                            hex = hex.replace(shorthandRegex, function(m, r, g, b) {
                                return r + r + g + g + b + b;
                            });
                            const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
                            return result ?
                                `rgba(${parseInt(result[1], 16)}, ${parseInt(result[2], 16)}, ${parseInt(result[3], 16)}, ${alpha})` :
                                hex;
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

                        const tipo = info.event.extendedProps.tipo;

                        const eventData = {
                            citaId: info.event.id,
                            tipo: tipo,

                        };

                        if (tipo === 'grupal') {
                            // Dispara el evento para el modal de selección

                            @this.openGrupalocurrencia('show-grupal-modal-choice', eventData);
                        } else if (tipo === 'individual') {
                            @this.openCitaModal(eventData);
                        }
                    },


                });



                calendar.render();
            });

            // ✅ Refrescar eventos correctamente desde Livewire
            Livewire.on('refresh-calendar', (updatedEvents) => {
                if (!calendar || typeof calendar.removeAllEvents !== 'function') {
                    //  console.warn('Calendario no inicializado correctamente');
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
