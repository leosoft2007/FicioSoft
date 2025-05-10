<section class="w-full">
    <x-page-header 
        title="Panel de Control" 
        subtitle="Resumen general de la clínica"
        color="blue"
    />
<head>
    <title>Gráfico de Ventas</title>
    
</head>
    <div class="py-6">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Primera fila de cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card: Citas hoy -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-4 py-5 sm:p-6 flex items-center">
                        <div class="rounded-full bg-blue-100 p-3 mr-4">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Citas Hoy</h3>
                            <p class="text-2xl font-semibold text-gray-900">{{ $citasHoy }}</p>
                            <p class="text-sm text-gray-500">{{ $citasConfirmadasHoy }} confirmadas</p>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-4 sm:px-6">
                        <a href="{{ route('agenda') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                            Ver todas las citas
                        </a>
                    </div>
                </div>

                <!-- Card: Facturación mensual -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-4 py-5 sm:p-6 flex items-center">
                        <div class="rounded-full bg-green-100 p-3 mr-4">
                            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Facturación Mensual</h3>
                            <p class="text-2xl font-semibold text-gray-900">${{ number_format($facturacionMes, 2) }}</p>
                            <p class="text-sm text-gray-500">
                                @if($comparacionFacturacion >= 0)
                                    <span class="text-green-600">↑ {{ $comparacionFacturacion }}%</span> vs mes anterior
                                @else
                                    <span class="text-red-600">↓ {{ abs($comparacionFacturacion) }}%</span> vs mes anterior
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-4 sm:px-6">
                        <a href="{{ route('facturas.index') }}" class="text-sm font-medium text-green-600 hover:text-green-500">
                            Ver reporte completo
                        </a>
                    </div>
                </div>

                <!-- Card: Pacientes nuevos -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-4 py-5 sm:p-6 flex items-center">
                        <div class="rounded-full bg-purple-100 p-3 mr-4">
                            <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Pacientes Nuevos</h3>
                            <p class="text-2xl font-semibold text-gray-900">{{ $pacientesNuevosMes }}</p>
                            <p class="text-sm text-gray-500">Total: {{ $totalPacientes }} pacientes</p>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-4 sm:px-6">
                        <a href="{{ route('pacientes.index') }}" class="text-sm font-medium text-purple-600 hover:text-purple-500">
                            Gestionar pacientes
                        </a>
                    </div>
                </div>

                <!-- Card: Profesionales activos -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-4 py-5 sm:p-6 flex items-center">
                        <div class="rounded-full bg-yellow-100 p-3 mr-4">
                            <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Profesionales Activos</h3>
                            <p class="text-2xl font-semibold text-gray-900">{{ $profesionalesActivos }}</p>
                            <p class="text-sm text-gray-500">{{ $profesionalesDisponibles }} disponibles hoy</p>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-4 sm:px-6">
                        <a href="{{ route('profesionals.index') }}" class="text-sm font-medium text-yellow-600 hover:text-yellow-500">
                            Ver equipo médico
                        </a>
                    </div>
                </div>
            </div>

            <!-- Segunda fila: Gráficos y listados -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Card: Citas por profesional -->
                <div class="bg-white shadow rounded-lg overflow-hidden lg:col-span-1">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Citas Hoy por Profesional</h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                       <ul class="divide-y divide-gray-200">
                   @forelse($citasPorProfesional as $profesional)
                                <li class="py-3">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                <span class="text-blue-600 font-medium">
                                                    {{ substr($profesional['nombre'], 0, 1) }}{{ substr($profesional['apellido'], 0, 1) }}
                                                </span>
                                            </div>
                                            <div class="ml-4">
                                                <p class="text-sm font-medium text-gray-900">
                                                    {{ $profesional['nombre'] }} {{ $profesional['apellido'] }}
                                                </p>
                                                <p class="text-sm text-gray-500">
                                                    {{ $profesional['especialidad'] }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="ml-2 flex-shrink-0 flex">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{ $profesional['citas_count'] }} citas
                                            </span>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="py-3 text-center text-gray-500">
                                    No hay citas programadas para hoy
                                </li>
                            @endforelse
                    </ul>
                    </div>
                    <div class="bg-gray-50 px-4 py-4 sm:px-6">
                        <a href=" ddd" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                            Agendar nueva cita
                        </a>
                    </div>
                </div>

                <!-- Card: Facturación mensual por servicio -->

                

            <div class="bg-white shadow rounded-lg overflow-hidden lg:col-span-2">
                            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                                <h3 class="text-lg font-medium text-gray-900">Facturación por Servicio (Últimos 30 días)</h3>
                            </div>

                            <div class="p-6">
                                <!-- Listado de servicios -->
                                <ul class="space-y-4">
                                    @php
                                        $total = $facturacionServicios->sum('total');
                                    @endphp

                                    @foreach ($facturacionServicios as $index => $servicio)
                                        @php
                                            $porcentaje = $total > 0 ? round(($servicio['total'] / $total) * 100, 1) : 0;
                                            $color = ['#3b82f6', '#10b981', '#8b5cf6', '#f59e0b', '#ef4444'][$index % 5];
                                        @endphp

                                        <li class="flex flex-col space-y-2">
                                            <!-- Nombre + Monto -->
                                            <div class="flex justify-between items-center">
                                                <div class="flex items-center">
                                                    <span class="inline-block w-3 h-3 rounded-full mr-2" style="background-color: {{ $color }};"></span>
                                                    <span class="font-medium text-gray-900">{{ $servicio['nombre'] }}</span>
                                                </div>
                                                <div class="text-right">
                                                    <span class="font-semibold text-gray-900">${{ number_format($servicio['total'], 2) }}</span>
                                                    <span class="ml-2 text-xs text-gray-500">({{ $porcentaje }}%)</span>
                                                </div>
                                            </div>

                                            <!-- Barra de progreso -->
                                            <div class="w-full bg-gray-200 rounded-full h-2">
                                                <div 
                                                    class="rounded-full h-2 transition-all duration-500 ease-in-out" 
                                                    style="width: {{ $porcentaje }}%; background-color: {{ $color }};">
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach

                                    <!-- Total general -->
                                    <li class="pt-4 mt-4 border-t border-gray-200 flex justify-between items-center font-bold text-gray-900">
                                        <span>Total General</span>
                                        <span>${{ number_format($total, 2) }}</span>
                                    </li>
                                </ul>
                            </div>

                            <!-- Botón de acción -->
                            <div class="bg-gray-50 px-4 py-4 sm:px-6 flex justify-end">
                                <a href="{{ route('facturas.listado') }}" class="text-sm font-medium text-green-600 hover:text-green-700">
                                    Ver reporte detallado
                                </a>
                            </div>
            </div>
           

            <!-- Tercera fila: Tabla de próximas citas -->
            
      <!-- Segunda fila: Gráficos y listados -->
<!-- Segunda fila: Gráficos y listados -->


<div class="bg-white shadow rounded-lg overflow-hidden">
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">Próximas Citas</h3>
    </div>
    <div class="px-4 py-5 sm:p-6">
        <!-- Contenedor responsivo -->
        <div class="overflow-x-auto rounded-lg shadow-sm">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Paciente
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Profesional
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Fecha y Hora
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Servicio
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Estado
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Acciones</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($proximasCitas as $cita)
                        <tr>
                            <!-- Paciente -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                        <span class="text-blue-600 font-medium">
                                            {{ substr($cita->paciente->nombre, 0, 1) }}{{ substr($cita->paciente->apellido, 0, 1) }}
                                        </span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $cita->paciente->nombre }} {{ $cita->paciente->apellido }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $cita->paciente->telefono }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Profesional -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $cita->profesional->nombre }}</div>
                                <div class="text-sm text-gray-500">{{ $cita->profesional->especialidad }}</div>
                            </td>

                            <!-- Fecha y Hora -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $cita->fecha->format('d/m/Y') }}</div>
                                <div class="text-sm text-gray-500">{{ $cita->hora_inicio }} - {{ $cita->hora_fin }}</div>
                            </td>

                            <!-- Servicio -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $cita->servicio?->nombre ?? 'Sin servicio' }}
                            </td>

                            <!-- Estado -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($cita->estado == 'confirmada')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Confirmada
                                    </span>
                                @elseif($cita->estado == 'pendiente')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Pendiente
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        {{ ucfirst($cita->estado) }}
                                    </span>
                                @endif
                            </td>

                            <!-- Acciones -->
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('agenda', $cita->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Editar</a>
                                <a href="{{ route('agenda', $cita->id) }}" class="text-blue-600 hover:text-blue-900">Ver</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                No hay próximas citas programadas
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer con info y enlace -->
    <div class="bg-gray-50 px-4 py-4 sm:px-6">
        <div class="flex justify-between items-center">
            <div class="text-sm text-gray-500">
                Mostrando <span class="font-medium">{{ $proximasCitas->count() }}</span> de <span class="font-medium">{{ $totalProximasCitas }}</span> próximas citas
            </div>
            <a href="{{ route('agenda') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700">
                Ver todas las citas →
            </a>
        </div>
    </div>
</div>


        </div>
    </div>

</section>
