<!-- Gestión de Asistencias -->
@php
    $categorias = [
        'sub8' => 'Sub-8',
        'sub12' => 'Sub-12',
        'sub14' => 'Sub-14',
        'sub16' => 'Sub-16',
        'avanzado' => 'Avanzado'
    ];
@endphp

<div class="space-y-6" x-data="{ currentView: 'main' }">
    <!-- Encabezado -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">
                <i class="fas fa-clipboard-check text-blue-600 mr-2 sm:mr-3"></i>
                Gestión de Asistencias
            </h1>
            <p class="text-sm sm:text-base text-gray-600 mt-1">Registra y consulta la asistencia de tus jugadores</p>
        </div>
        <div class="flex flex-wrap items-center gap-2 sm:gap-3">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs sm:text-sm font-medium bg-blue-100 text-blue-800">
                <i class="fas fa-users mr-2"></i>
                <span class="font-bold">{{ $inscripciones->count() }}</span>
                <span class="ml-1">Jugadores</span>
            </span>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs sm:text-sm font-medium bg-green-100 text-green-800">
                <i class="fas fa-check mr-2"></i>
                <span class="font-bold">{{ $asistenciasHistorial->count() }}</span>
                <span class="ml-1">Registros</span>
            </span>
        </div>
    </div>

    <!-- Vista Principal -->
    <div x-show="currentView === 'main'" class="space-y-6">
        <!-- Acciones principales -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Registrar Asistencia -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow cursor-pointer" 
                 @click="currentView = 'registro'">
                <div class="p-8 text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user-check text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Registrar Asistencia</h3>
                    <p class="text-gray-600 mb-4">Toma la asistencia del día de hoy</p>
                    <div class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i>
                        Comenzar Registro
                    </div>
                </div>
            </div>

            <!-- Ver Historial -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow cursor-pointer" 
                 @click="currentView = 'historial'">
                <div class="p-8 text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-history text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Ver Historial</h3>
                    <p class="text-gray-600 mb-4">Consulta las asistencias registradas</p>
                    <div class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-search mr-2"></i>
                        Ver Registros
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Vista de Registro -->
    <div x-show="currentView === 'registro'" class="space-y-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-4 sm:p-6 border-b border-gray-100">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div class="flex items-center">
                        <button @click="currentView = 'main'" 
                                class="mr-3 sm:mr-4 p-2 text-gray-400 hover:text-gray-600 transition-colors">
                            <i class="fas fa-arrow-left text-base sm:text-lg"></i>
                        </button>
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900">
                            <i class="fas fa-user-check text-green-600 mr-2"></i>
                            Registrar Asistencia
                        </h3>
                    </div>
                    <span class="text-xs sm:text-sm text-gray-500">{{ now()->format('d M Y') }}</span>
                </div>
            </div>
            
            <div class="p-4 sm:p-6">
                <form action="{{ route('coach.asistencias.store') }}" method="POST" class="space-y-6" id="formAsistencias">
                    @csrf
                    
                    <!-- Controles superiores -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Fecha de Asistencia</label>
                            <input type="date" name="fecha" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                   value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Filtrar por Categoría</label>
                            <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                    id="categoriaFiltro" @change="filtrarRegistro()">
                                <option value="">Todas las categorías</option>
                                @foreach($categorias as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Buscar Jugador</label>
                            <input type="text" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                   id="filtroRegistroJugador" 
                                   placeholder="Nombre..." 
                                   @keyup="filtrarRegistro()">
                        </div>
                    </div>

                    <!-- Lista de jugadores -->
                    <div class="space-y-3" id="listaJugadores">
                        @foreach($inscripciones as $inscripcion)
                            <div class="p-3 sm:p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors jugador-item" 
                                data-categoria="{{ strtolower($inscripcion->categoria) }}"
                                data-inscripcion-id="{{ $inscripcion->id }}">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                    <!-- Info del jugador -->
                                    <div class="flex items-center space-x-3 min-w-0">
                                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gray-100 rounded-full flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-user text-gray-600 text-sm sm:text-base"></i>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <h4 class="text-sm font-medium text-gray-900 truncate">
                                                {{ $inscripcion->jugador->name ?? 'Sin nombre' }}
                                            </h4>
                                            <p class="text-xs text-gray-500 flex flex-wrap items-center gap-1">
                                                <span>ID: {{ $inscripcion->jugador_id }}</span>
                                                <span>•</span>
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    {{ $categorias[$inscripcion->categoria] ?? ucfirst($inscripcion->categoria) }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <!-- Estados de asistencia -->
                                    <div class="flex items-center justify-center sm:justify-end">
                                        <div class="flex bg-gray-100 rounded-lg p-1 gap-1">
                                            <input type="radio" 
                                                   name="asistencias[{{ $inscripcion->id }}][estado]" 
                                                   id="presente{{ $inscripcion->id }}" 
                                                   value="presente" 
                                                   class="estado-radio sr-only" 
                                                   checked>
                                            <label for="presente{{ $inscripcion->id }}" 
                                                class="estado-label px-2 py-1.5 text-xxs sm:text-xs font-medium rounded-md cursor-pointer transition-colors text-gray-700 hover:bg-green-100 whitespace-nowrap">
                                                <i class="fas fa-check mr-1"></i>Presente
                                            </label>
                                            
                                            <input type="radio" 
                                                   name="asistencias[{{ $inscripcion->id }}][estado]" 
                                                   id="tarde{{ $inscripcion->id }}" 
                                                   value="tarde" 
                                                   class="estado-radio sr-only">
                                            <label for="tarde{{ $inscripcion->id }}" 
                                                class="estado-label px-2 py-1.5 text-xxs sm:text-xs font-medium rounded-md cursor-pointer transition-colors text-gray-700 hover:bg-yellow-100 whitespace-nowrap">
                                                <i class="fas fa-clock mr-1"></i>Tarde
                                            </label>
                                            
                                            <input type="radio" 
                                                   name="asistencias[{{ $inscripcion->id }}][estado]" 
                                                   id="ausente{{ $inscripcion->id }}" 
                                                   value="ausente" 
                                                   class="estado-radio sr-only">
                                            <label for="ausente{{ $inscripcion->id }}" 
                                                class="estado-label px-2 py-1.5 text-xxs sm:text-xs font-medium rounded-md cursor-pointer transition-colors text-gray-700 hover:bg-red-100 whitespace-nowrap">
                                                <i class="fas fa-times mr-1"></i>Ausente
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Campo de observaciones -->
                                <div class="mt-3">
                                    <input type="text" 
                                           name="asistencias[{{ $inscripcion->id }}][observaciones]" 
                                           placeholder="Observaciones opcionales..."
                                           class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Botón guardar -->
                    <div class="flex justify-center gap-6 pt-4 border-t border-gray-200">
                        <button type="button" @click="currentView = 'main'" 
                                class="px-6 py-2 text-sm border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                            <i class="fas fa-times mr-2"></i>Cancelar
                        </button>
                        <button type="submit" 
                                class="px-8 py-2 text-sm bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                            <i class="fas fa-save mr-2"></i>
                            <span class="hidden sm:inline">Guardar Asistencias</span>
                            <span class="sm:hidden">Guardar</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Vista de Historial (sin cambios) -->
    <div x-show="currentView === 'historial'" class="space-y-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <button @click="currentView = 'main'" 
                                class="mr-4 p-2 text-gray-400 hover:text-gray-600 transition-colors">
                            <i class="fas fa-arrow-left text-lg"></i>
                        </button>
                        <h3 class="text-lg font-semibold text-gray-900">
                            <i class="fas fa-history text-blue-600 mr-2"></i>
                            Historial de Asistencias
                        </h3>
                    </div>
                </div>
            </div>
            
            <div class="p-6">
                @if($asistenciasHistorial->count() === 0)
                    <div class="text-center py-12">
                        <i class="fas fa-inbox text-gray-300 text-6xl mb-4"></i>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No hay registros de asistencia</h3>
                        <p class="text-gray-500 mb-4">Comienza registrando la primera asistencia</p>
                        <button @click="currentView = 'registro'" 
                                class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                            <i class="fas fa-user-check mr-2"></i>Registrar Primera Asistencia
                        </button>
                    </div>
                @else
                    <!-- Filtros -->
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Categoría</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm" 
                                    id="filtroHistorialCategoria" @change="filtrarHistorialAsistencias()">
                                <option value="">Todas</option>
                                @foreach($categorias as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm" 
                                    id="filtroHistorialEstado" @change="filtrarHistorialAsistencias()">
                                <option value="">Todos</option>
                                <option value="presente">Presente</option>
                                <option value="ausente">Ausente</option>
                                <option value="tarde">Tarde</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Desde</label>
                            <input type="date" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm" 
                                   id="filtroHistorialDesde" @change="filtrarHistorialAsistencias()">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Hasta</label>
                            <input type="date" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm" 
                                   id="filtroHistorialHasta" @change="filtrarHistorialAsistencias()">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Buscar Jugador</label>
                            <input type="text" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm" 
                                   id="filtroHistorialJugador" 
                                   placeholder="Nombre..." 
                                   @keyup="filtrarHistorialAsistencias()">
                        </div>
                    </div>

                    <!-- Botón para limpiar filtros -->
                    <div class="flex justify-end mb-4">
                        <button type="button" @click="limpiarFiltrosHistorial()" 
                                class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors text-sm">
                            <i class="fas fa-eraser mr-2"></i>Limpiar Filtros
                        </button>
                    </div>

                    <!-- Tabla de historial -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200" id="tablaHistorialAsistencias">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jugador</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoría</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Observaciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($asistenciasHistorial as $a)
                                <tr class="hover:bg-gray-50 transition-colors fila-asistencia-historial" 
                                    data-categoria="{{ strtolower($a['categoria'] ?? '') }}" 
                                    data-estado="{{ strtolower(trim($a['estado'] ?? '')) }}"
                                    data-fecha="{{ $a['fecha'] }}"
                                    data-jugador="{{ strtolower($a['jugador_nombre'] ?? '') }}">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($a['fecha'])->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $a['jugador_nombre'] }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $categorias[$a['categoria']] ?? ucfirst($a['categoria']) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php $estado = strtolower(trim($a['estado'] ?? '')); @endphp
                                        @if($estado === 'presente')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check mr-1"></i>Presente
                                            </span>
                                        @elseif($estado === 'ausente')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <i class="fas fa-times mr-1"></i>Ausente
                                            </span>
                                        @elseif($estado === 'tarde')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <i class="fas fa-clock mr-1"></i>Tarde
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                N/A
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $a['observaciones'] ?? 'Sin observaciones' }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Resumen -->
                    <div class="mt-4 text-sm text-gray-600">
                        Mostrando <span class="font-semibold text-gray-900" id="contadorAsistencias">{{ $asistenciasHistorial->count() }}</span> registros
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
/* Tamaño extra pequeño para móviles */
.text-xxs {
    font-size: 0.65rem;
    line-height: 1rem;
}

@media (min-width: 640px) {
    .text-xxs {
        font-size: 0.75rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Filtrar en registro (categoría y búsqueda) - SOLO MUESTRA/OCULTA
function filtrarRegistro() {
    const cat = document.getElementById('categoriaFiltro')?.value || '';
    const busqueda = document.getElementById('filtroRegistroJugador')?.value.toLowerCase() || '';
    
    const jugadores = document.querySelectorAll('.jugador-item');
    jugadores.forEach(jugador => {
        const jugadorCat = jugador.dataset.categoria;
        const jugadorNombre = jugador.querySelector('h4')?.textContent.toLowerCase() || '';
        
        const okCat = !cat || jugadorCat === cat;
        const okBusqueda = !busqueda || jugadorNombre.includes(busqueda);
        
        // Solo mostrar/ocultar, NO deshabilitar inputs
        if (okCat && okBusqueda) {
            jugador.style.display = '';
        } else {
            jugador.style.display = 'none';
        }
    });
}

// NUEVO: Antes de enviar el formulario, eliminar inputs de jugadores ocultos
document.getElementById('formAsistencias')?.addEventListener('submit', function(e) {
    // Eliminar todos los inputs de jugadores que están ocultos
    document.querySelectorAll('.jugador-item').forEach(jugador => {
        if (jugador.style.display === 'none') {
            // Encontrar todos los inputs dentro de este jugador y eliminarlos
            jugador.querySelectorAll('input, textarea, select').forEach(input => {
                input.remove();
            });
        }
    });
});

// Filtrar historial de asistencias
function filtrarHistorialAsistencias() {
    const cat = document.getElementById('filtroHistorialCategoria')?.value.toLowerCase() || '';
    const est = document.getElementById('filtroHistorialEstado')?.value.toLowerCase() || '';
    const desde = document.getElementById('filtroHistorialDesde')?.value || '';
    const hasta = document.getElementById('filtroHistorialHasta')?.value || '';
    const jugador = document.getElementById('filtroHistorialJugador')?.value.toLowerCase() || '';
    
    let contador = 0;
    
    document.querySelectorAll('.fila-asistencia-historial').forEach(fila => {
        const filaCat = fila.dataset.categoria || '';
        const filaEst = fila.dataset.estado || '';
        const filaFecha = fila.dataset.fecha || '';
        const filaJugador = fila.dataset.jugador || '';
        
        const okCat = !cat || filaCat === cat;
        const okEst = !est || filaEst === est;
        const okJugador = !jugador || filaJugador.includes(jugador);
        
        let okFecha = true;
        if (desde && filaFecha < desde) okFecha = false;
        if (hasta && filaFecha > hasta) okFecha = false;
        
        const mostrar = okCat && okEst && okFecha && okJugador;
        fila.style.display = mostrar ? '' : 'none';
        if (mostrar) contador++;
    });
    
    document.getElementById('contadorAsistencias').textContent = contador;
}

// Limpiar filtros de historial
function limpiarFiltrosHistorial() {
    document.getElementById('filtroHistorialCategoria').value = '';
    document.getElementById('filtroHistorialEstado').value = '';
    document.getElementById('filtroHistorialDesde').value = '';
    document.getElementById('filtroHistorialHasta').value = '';
    document.getElementById('filtroHistorialJugador').value = '';
    filtrarHistorialAsistencias();
}

// Manejar el cambio de estado de asistencia visual
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.estado-radio').forEach(radio => {
        radio.addEventListener('change', function() {
            // Remover clases activas de todos los labels del mismo grupo
            const name = this.name;
            document.querySelectorAll(`input[name="${name}"]`).forEach(r => {
                const label = document.querySelector(`label[for="${r.id}"]`);
                label.classList.remove('bg-green-500', 'bg-yellow-500', 'bg-red-500', 'text-white');
                label.classList.add('text-gray-700');
                label.classList.remove('hover:bg-green-100', 'hover:bg-yellow-100', 'hover:bg-red-100');
            });
            
            // Agregar clase activa al label seleccionado
            const label = document.querySelector(`label[for="${this.id}"]`);
            if (this.value === 'presente') {
                label.classList.add('bg-green-500', 'text-white');
                label.classList.remove('text-gray-700');
            } else if (this.value === 'tarde') {
                label.classList.add('bg-yellow-500', 'text-white');
                label.classList.remove('text-gray-700');
            } else if (this.value === 'ausente') {
                label.classList.add('bg-red-500', 'text-white');
                label.classList.remove('text-gray-700');
            }
        });
    });
    
    // Activar el estado inicial (presente) visualmente
    document.querySelectorAll('.estado-radio:checked').forEach(radio => {
        const label = document.querySelector(`label[for="${radio.id}"]`);
        label.classList.add('bg-green-500', 'text-white');
        label.classList.remove('text-gray-700');
        label.classList.remove('hover:bg-green-100');
    });
});
</script>
@endpush
