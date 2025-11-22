@extends('layouts.admi')

@section('title', 'Panel Administrador - Jeff Academy')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 sidebar d-flex flex-column" id="sidebar">
            <div class="sidebar-logo">
                <img src="/img/logo-blanco.png" alt="Logo Jeff Academy"  class="logo-img" style="width: 150px;  margin-left:20px;">
            </div>

            <div class="user-profile">
                <img src="{{ Auth::user()->foto_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}" alt="{{ Auth::user()->name }}" class="user-avatar">
                <h6>{{ Auth::user()->name }}</h6>
                <p>Administrador</p>
            </div>

            <ul class="nav flex-column flex-grow-1">
                <li class="nav-item">
                    <a class="nav-link active" href="#" data-section="inicio">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Inicio</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-section="usuarios">
                        <i class="fas fa-users"></i>
                        <span>Usuarios</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-section="inscripciones">
                        <i class="fas fa-clipboard-list"></i>
                        <span>Asignar Jugadores</span>
                    </a>
                </li>
                                
                <li class="nav-item">
                    <a class="nav-link" href="#" data-section="inscripciones2">
                        <i class="fas fa-user"></i>
                        <span>Inscripciones</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-section="noticias">
                        <i class="fas fa-newspaper"></i>
                        <span>Noticias</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="#" data-section="planes">
                        <i class="fas fa-clipboard-list"></i>
                        <span>Planes</span>
                    </a>
                </li>
                <!-- Seccion de disciplinas -->
                <li class="nav-item">
                    <a class="nav-link" href="#" data-section="disciplinas">
                        <i class="fas fa-futbol"></i>
                        <span>Disciplinas</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="#" data-section="reportes">
                        <i class="fas fa-chart-bar"></i>
                        <span>Reportes</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#" data-section="perfil">
                        <i class="fas fa-user"></i>
                        <span>Perfil</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#" data-section="mensajes">
                        <i class="fas fa-envelope"></i>
                        <span>Mensajes</span>
                    </a>
                </li>
            </ul>

            <li class="nav-item mt-auto">
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Cerrar Sesión</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </div>


        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 main-content">
            <!-- Navbar Sticky -->
            <div class="header sticky-top bg-white shadow-sm" style="z-index: 1000; padding: 1rem 1.5rem;">
                <div class="d-flex justify-content-between align-items-center" style="gap: 1.5rem;">
                    <!-- Botón hamburguesa (visible en móvil) -->
                    <button class="btn btn-link d-md-none text-dark p-0" id="mobileMenuToggle" style="font-size: 1.5rem;">
                        <i class="fas fa-bars"></i>
                    </button>

                    <!-- Título de bienvenida -->
                    <h3 class="mb-0 d-none d-md-block flex-grow-1">Bienvenido, {{ Auth::user()->name }}</h3>
                    <h5 class="mb-0 d-md-none flex-grow-1">Dashboard</h5>

                    <!-- Perfil dropdown con Alpine.js -->
                    <div x-data="{ open: false }" class="position-relative">
                        <button @click="open = !open" class="btn btn-link text-decoration-none d-flex align-items-center p-0" style="gap: 0.5rem;">
                            <img 
                                src="{{ Auth::user()->foto_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}" 
                                alt="Profile" 
                                class="rounded-circle border border-2 border-secondary object-fit-cover shadow-sm"
                                style="width: 40px; height: 40px;">
                            <i class="fas fa-chevron-down text-secondary" style="font-size: 0.75rem;"></i>
                        </button>
                        
                        <!-- Dropdown menu -->
                        <div x-show="open" 
                            @click.away="open = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="position-absolute end-0 mt-2 bg-white rounded-3 shadow-lg border border-light overflow-hidden"
                            style="width: 240px;"
                            x-cloak>
                            
                            <!-- Información del usuario -->
                            <div class="px-3 py-3 border-bottom border-light bg-light">
                                <p class="mb-1 fw-semibold text-dark" style="font-size: 0.9rem;">{{ Auth::user()->name }}</p>
                                <p class="mb-0 text-muted" style="font-size: 0.75rem;">{{ Auth::user()->email }}</p>
                                <span class="badge bg-success mt-1" style="font-size: 0.7rem;">Administrador</span>
                            </div>
                            
                            <!-- Editar Perfil -->
                            <a href="#" 
                                @click="open = false; document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active')); document.querySelector('[data-section=perfil]')?.classList.add('active'); document.querySelectorAll('.section-content').forEach(section => section.classList.remove('active-section')); document.getElementById('perfil')?.classList.add('active-section'); window.location.hash = 'perfil';" 
                                class="d-block px-3 py-2 text-decoration-none text-dark" style="transition: background 0.2s;" 
                                onmouseover="this.style.background='#f8f9fa'" 
                                onmouseout="this.style.background='transparent'">
                                <i class="fas fa-user me-2 text-primary"></i>Mi Perfil
                            </a>
                            
                            <!-- Separador -->
                            <div class="border-top border-light"></div>
                            
                            <!-- Cerrar Sesión -->
                            <form action="{{ route('logout') }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="btn btn-link w-100 text-start px-3 py-2 text-decoration-none text-danger border-0" style="transition: background 0.2s;" 
                                    onmouseover="this.style.background='#fff5f5'" 
                                    onmouseout="this.style.background='transparent'">
                                    <i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Acciones Rápidas -->
            <div class="container-fluid px-3">
                <!-- Primera fila: 4 tarjetas -->
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3 mb-3">
                    <div class="col">
                        <div class="quick-action-card text-center" data-section="usuarios">
                            <i class="fas fa-user-plus"></i>
                            <h5>Agregar Usuario</h5>
                            <p>Registrar nuevo usuario</p>
                        </div>
                    </div>

                    <div class="col">
                        <div class="quick-action-card text-center" data-section="inscripciones">
                            <i class="fas fa-clipboard-list"></i>
                            <h5>Asignar Inscripciones</h5>
                            <p>Gestionar solicitudes</p>
                        </div>
                    </div>

                    <div class="col">
                        <div class="quick-action-card text-center" data-section="inscripciones2">
                            <i class="fas fa-clipboard-check"></i>
                            <h5>Inscripciones</h5>
                            <p>Gestionar solicitudes de inscripción</p>
                        </div>
                    </div>

                    <div class="col">
                        <div class="quick-action-card text-center" data-section="noticias">
                            <i class="fas fa-bullhorn"></i>
                            <h5>Publicar Noticia</h5>
                            <p>Compartir información</p>
                        </div>
                    </div>
                </div>

                <!-- Segunda fila: 3 tarjetas centradas -->
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-4 justify-content-center">
                    <div class="col">
                        <div class="quick-action-card text-center" data-section="planes">
                            <i class="fas fa-clipboard-list"></i>
                            <h5>Gestionar Planes</h5>
                            <p>Crear y editar planes disponibles</p>
                        </div>
                    </div>

                    <div class="col">
                        <div class="quick-action-card text-center" data-section="disciplinas">
                            <i class="fas fa-trophy"></i>
                            <h5>Disciplinas</h5>
                            <p>Gestionar Disciplinas</p>
                        </div>
                    </div>

                    <div class="col">
                        <div class="quick-action-card text-center" data-section="reportes">
                            <i class="fas fa-folder-open"></i>
                            <h5>Generar Reportes</h5>
                            <p>Gestionar Reportes</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- INICIO -->
            <div id="inicio" class="section-content active-section">
                <h1 class="section-title">Dashboard de Administración</h1>

                <!-- TARJETAS DE ESTADÍSTICAS -->
                <div class="row g-3 mb-4">
                    <div class="col">
                        <div class="dashboard-card text-center">
                            <i class="fas fa-users"></i>
                            <h3 class="counter" data-target="{{ $totalJugadores }}">{{ $totalJugadores ?? 0 }}</h3>
                            <p>Jugadores Registrados</p>
                        </div>
                    </div>

                    <div class="col">
                        <div class="dashboard-card text-center">
                            <i class="fas fa-user-tie" style="color: #2196f3;"></i>
                            <h3 class="counter" data-target="{{ $totalEntrenadores }}">{{ $totalEntrenadores ?? 0 }}</h3>
                            <p>Entrenadores Activos</p>
                        </div>
                    </div>

                    <div class="col">
                        <div class="dashboard-card text-center">
                            <i class="fas fa-newspaper" style="color: #f44336;"></i>
                            <h3 class="counter" data-target="{{ $noticias->count() }}">{{ $noticias->count() ?? 0 }}</h3>
                            <p>Noticias Publicadas</p>
                        </div>
                    </div>

                    <div class="col">
                        <div class="dashboard-card text-center">
                            <i class="fas fa-trophy" style="color: #f4de36ff;"></i>
                            <h3 class="counter" data-target="{{ $disciplinas->count() }}">{{ $disciplinas->count() ?? 0 }}</h3>
                            <p>Disciplinas Publicadas</p>
                        </div>
                    </div>

                    <div class="col">
                        <div class="dashboard-card text-center">
                            <i class="fas fa-weight" style="color: #0cc4cbff;"></i>
                            <h3 class="counter" data-target="{{ $planes->count() }}">{{ $planes->count() ?? 0 }}</h3>
                            <p>Planes Activos</p>
                        </div>
                    </div>
                </div>


                <div class="charts-container">
                    <!-- Fila 1: Gráficas principales -->
                    <div class="chart-row">
                        <!-- Gráfica de distribución de roles -->
                        <div class="chart-card">
                            <div class="chart-header">
                                <div class="chart-title">
                                    <div class="chart-icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div>
                                        <h4>Distribución de Roles</h4>
                                        <p class="chart-subtitle">Por tipo de usuario</p>
                                    </div>
                                </div>
                                <div class="chart-actions">
                                    <span class="chart-badge total-badge">
                                        <i class="fas fa-user-circle"></i>
                                        Total: {{ $totalUsuarios }}
                                    </span>
                                </div>
                            </div>
                            <div class="chart-wrapper">
                                <canvas id="rolesChart"></canvas>
                            </div>
                        </div>

                        <!-- Gráfica de estados de usuarios -->
                        <div class="chart-card">
                            <div class="chart-header">
                                <div class="chart-title">
                                    <div class="chart-icon status">
                                        <i class="fas fa-clipboard-list"></i>
                                    </div>
                                    <div>
                                        <h4>Inscripciones por Disciplina</h4>
                                        <p class="chart-subtitle">Distribución de alumnos por deporte</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="disciplines-stats">
                                @php
                                    $inscripcionesPorDisciplina = \App\Models\Inscripcion::select('disciplina', \Illuminate\Support\Facades\DB::raw('COUNT(*) as total'))
                                        ->groupBy('disciplina')
                                        ->get()
                                        ->pluck('total', 'disciplina');
                                    
                                    $totalInscripciones = $inscripcionesPorDisciplina->sum();
                                    $colores = ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#6f42c1'];
                                    $colorIndex = 0;
                                @endphp
                                
                                @foreach($inscripcionesPorDisciplina as $disciplina => $total)
                                @php
                                    $porcentaje = $totalInscripciones > 0 ? round(($total / $totalInscripciones) * 100, 2) : 0;
                                    $color = $colores[$colorIndex % count($colores)];
                                    $colorIndex++;
                                @endphp
                                <div class="discipline-item">
                                    <div class="discipline-info">
                                        <span class="discipline-color" style="background-color: {{ $color }}"></span>
                                        <span class="discipline-name">{{ $disciplina }}</span>
                                        <span class="discipline-count">{{ $total }} alumnos</span>
                                    </div>
                                    <div class="discipline-progress">
                                        <div class="progress">
                                            <div class="progress-bar" style="width: {{ $porcentaje }}%; background-color: {{ $color }}"></div>
                                        </div>
                                        <span class="discipline-percentage">{{ $porcentaje }}%</span>
                                    </div>
                                </div>
                                @endforeach
                                
                                @if($inscripcionesPorDisciplina->count() == 0)
                                <div class="no-data">
                                    <i class="fas fa-info-circle"></i>
                                    No hay inscripciones registradas
                                </div>
                                @endif
                            </div>
                            <div class="total-inscriptions">
                                <div class="total-box">
                                    <i class="fas fa-users"></i>
                                    <div class="total-content">
                                        <h3>{{ $totalInscripciones }}</h3>
                                        <p>Total de Inscripciones</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Fila 2: Gráficas secundarias -->
                    <div class="chart-row">
                        <!-- Gráfica de planes activos -->
                        <div class="chart-card">
                            <div class="chart-header">
                                <div class="chart-title">
                                    <div class="chart-icon plans">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </div>
                                    <div>
                                        <h4>Suscripciones Activas</h4>
                                        <p class="chart-subtitle">Por tipo de plan</p>
                                    </div>
                                </div>
                                <div class="chart-actions">
                                    <span class="chart-badge">
                                        <i class="fas fa-chart-pie"></i>
                                        @php
                                            $totalPlanes = $distribucionPlanes->sum();
                                        @endphp
                                        Total: {{ $totalPlanes }}
                                    </span>
                                </div>
                            </div>
                            <div class="chart-wrapper">
                                <canvas id="plansChart"></canvas>
                            </div>
                            <div class="chart-footer">
                                <div class="plan-summary">
                                    @if($distribucionPlanes->count() > 0)
                                        @foreach($distribucionPlanes as $plan => $count)
                                        <div class="plan-item">
                                            <span class="plan-name">{{ $plan }}</span>
                                            <span class="plan-count">{{ $count }}</span>
                                        </div>
                                        @endforeach
                                    @else
                                        <div class="no-data">
                                            <i class="fas fa-info-circle"></i>
                                            No hay suscripciones activas
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Gráfica de disciplinas populares -->
                        <div class="chart-card">
                            <div class="chart-header">
                                <div class="chart-title">
                                    <div class="chart-icon sports">
                                        <i class="fas fa-futbol"></i>
                                    </div>
                                    <div>
                                        <h4>Disciplinas Populares</h4>
                                        <p class="chart-subtitle">Inscripciones por deporte</p>
                                    </div>
                                </div>
                                <div class="chart-actions">
                                    <span class="chart-badge">
                                        <i class="fas fa-trophy"></i>
                                        Total: {{ $distribucionDisciplinas->sum() }}
                                    </span>
                                </div>
                            </div>
                            <div class="chart-wrapper">
                                <canvas id="disciplinesChart"></canvas>
                            </div>
                            <div class="chart-footer">
                                <div class="sports-list">
                                    @if($distribucionDisciplinas->count() > 0)
                                        @foreach($distribucionDisciplinas as $disciplina => $count)
                                        <div class="sport-item">
                                            <span class="sport-name">{{ $disciplina }}</span>
                                            <span class="sport-count">{{ $count }} inscritos</span>
                                        </div>
                                        @endforeach
                                    @else
                                        <div class="no-data">
                                            <i class="fas fa-info-circle"></i>
                                            No hay inscripciones registradas
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        

            <!-- USUARIOS -->
            <div id="usuarios" class="section-content">
                <h1 class="section-title">Gestión de Usuarios</h1>
                <div class="form-registro">
                    <h3>Registrar Nuevo Usuario</h3>
                        <form id="formUsuario" method="POST" action="{{ route('admin.usuarios.store') }}">
                            @csrf
                            
                            <!-- Mostrar errores generales -->
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Mostrar mensajes de éxito -->
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="card mb-4">
                                <div class="card-body">
                                    <!-- Tipo de Usuario -->
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tipoUsuario" class="form-label fw-bold">Tipo de Usuario *</label>
                                                <select class="form-select @error('tipo_usuario') is-invalid @enderror" id="tipoUsuario" name="tipo_usuario" required>
                                                    <option value="">-- Seleccionar tipo --</option>
                                                    <option value="jugador" {{ old('tipo_usuario') == 'jugador' ? 'selected' : '' }}>Jugador</option>
                                                    <option value="entrenador" {{ old('tipo_usuario') == 'entrenador' ? 'selected' : '' }}>Entrenador</option>
                                                </select>
                                                @error('tipo_usuario')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Selección de Jugador (solo para tipo Jugador) -->
                                    <div class="row mb-4" id="grupoSeleccionarJugador">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="seleccionarRegistro" class="form-label fw-bold">Seleccionar Jugador *</label>
                                                
                                                <!-- Campo de búsqueda -->
                                                <div class="input-group mb-2">
                                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                                    <input type="text" class="form-control" id="buscadorJugador" 
                                                        placeholder="Buscar por nombre, apellido o documento...">
                                                </div>
                                                
                                                <!-- Select de jugadores -->
                                                <select class="form-select @error('registro_id') is-invalid @enderror" 
                                                        id="seleccionarRegistro" name="registro_id" size="4" style="overflow-y: auto; max-height: 200px;">
                                                    <option value="">-- Selecciona un jugador --</option>
                                                    @foreach($registros as $registro)
                                                        <option value="{{ $registro->id }}" 
                                                                data-search="{{ strtolower($registro->nombres . ' ' . $registro->apellido_paterno . ' ' . $registro->apellido_materno . ' ' . $registro->nro_documento) }}"
                                                                data-nombres="{{ $registro->nombres }}"
                                                                data-apellido-paterno="{{ $registro->apellido_paterno }}"
                                                                data-apellido-materno="{{ $registro->apellido_materno }}"
                                                                data-email="{{ $registro->email }}"
                                                                data-telefono="{{ $registro->nro_celular }}"
                                                                data-fecha-nacimiento="{{ $registro->fecha_nacimiento }}"
                                                                data-documento="{{ $registro->tipo_documento }} - {{ $registro->nro_documento }}"
                                                                data-genero="{{ $registro->genero }}"
                                                                {{ old('registro_id') == $registro->id ? 'selected' : '' }}>
                                                            {{ $registro->nombres }} {{ $registro->apellido_paterno }} {{ $registro->apellido_materno }} ({{ $registro->tipo_documento }}: {{ $registro->nro_documento }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('registro_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">Usa el campo de búsqueda para filtrar jugadores</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Información Personal -->
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nombres" class="form-label fw-bold">Nombres *</label>
                                                <input type="text" class="form-control @error('nombres') is-invalid @enderror" 
                                                    id="nombres" name="nombres" 
                                                    placeholder="Ingresa los nombres"
                                                    value="{{ old('nombres') }}"
                                                    {{ old('tipo_usuario') == 'jugador' ? 'readonly' : '' }}>
                                                @error('nombres')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="apellido_paterno" class="form-label fw-bold">Apellido Paterno *</label>
                                                <input type="text" class="form-control @error('apellido_paterno') is-invalid @enderror" 
                                                    id="apellido_paterno" name="apellido_paterno" 
                                                    placeholder="Ingresa el apellido paterno"
                                                    value="{{ old('apellido_paterno') }}"
                                                    {{ old('tipo_usuario') == 'jugador' ? 'readonly' : '' }}>
                                                @error('apellido_paterno')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="apellido_materno" class="form-label fw-bold">Apellido Materno</label>
                                                <input type="text" class="form-control @error('apellido_materno') is-invalid @enderror" 
                                                    id="apellido_materno" name="apellido_materno" 
                                                    placeholder="Ingresa el apellido materno"
                                                    value="{{ old('apellido_materno') }}"
                                                    {{ old('tipo_usuario') == 'jugador' ? 'readonly' : '' }}>
                                                @error('apellido_materno')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="documentoUsuario" class="form-label fw-bold">Documento de Identidad *</label>
                                                <input type="text" class="form-control @error('documento') is-invalid @enderror" 
                                                    id="documentoUsuario" name="documento" 
                                                    placeholder="Ej: DNI 12345678"
                                                    value="{{ old('documento') }}"
                                                    {{ old('tipo_usuario') == 'jugador' ? 'readonly' : '' }}>
                                                @error('documento')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Información de Contacto -->
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="emailUsuario" class="form-label fw-bold">Email *</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                    id="emailUsuario" name="email" 
                                                    placeholder="correo@gmail.com" 
                                                    value="{{ old('email') }}"
                                                    required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="telefonoUsuario" class="form-label fw-bold">Teléfono</label>
                                                <input type="tel" class="form-control @error('telefono') is-invalid @enderror" 
                                                    id="telefonoUsuario" name="telefono" 
                                                    placeholder="+51 999 999 999"
                                                    value="{{ old('telefono') }}">
                                                @error('telefono')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Información Adicional -->
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="generoUsuario" class="form-label fw-bold">Género *</label>
                                                <select class="form-select @error('genero') is-invalid @enderror" 
                                                    id="generoUsuario" name="genero">
                                                    <option value="">-- Seleccionar género --</option>
                                                    <option value="masculino" {{ old('genero') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                                                    <option value="femenino" {{ old('genero') == 'femenino' ? 'selected' : '' }}>Femenino</option>
                                                    <option value="otro" {{ old('genero') == 'otro' ? 'selected' : '' }}>Otro</option>
                                                </select>
                                                @error('genero')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fechaNacimiento" class="form-label fw-bold">Fecha de Nacimiento</label>
                                                <input type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" 
                                                    id="fechaNacimiento" name="fecha_nacimiento"
                                                    value="{{ old('fecha_nacimiento') }}"
                                                    {{ old('tipo_usuario') == 'jugador' ? 'readonly' : '' }}>
                                                @error('fecha_nacimiento')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Contraseñas -->
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="passwordUsuario" class="form-label fw-bold">Contraseña del Sistema *</label>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                                    id="passwordUsuario" name="password" 
                                                    placeholder="Mínimo 8 caracteres" required minlength="8">
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">Esta contraseña es para acceder al sistema</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="confirmarPassword" class="form-label fw-bold">Confirmar Contraseña *</label>
                                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                                                    id="confirmarPassword" name="password_confirmation"
                                                    placeholder="Repite la contraseña" required minlength="8">
                                                @error('password_confirmation')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Botón de Registrar -->
                                    <div class="row">
                                        <div class="col-2">
                                            <button type="submit" class="btn btn-success btn-lg w-80" id="btnRegistrar">
                                                <i class="fas fa-user-plus me-2"></i>Registrar Jugador
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                </div>

                <h2 class="subtitulo-rol">Jugadores y Entrenadores Registrados</h2>
                <!-- Tabla de Jugadores y Entrenadores -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" style="font-size: 0.9rem;">
                            <thead class="table-light">
                                <tr>
                                    <th width="60">ID</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th width="100">Rol</th>
                                    <th width="100">Estado</th>
                                    <th width="300" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($usuarios ?? [] as $usuario)
                                <tr class="{{ $usuario->estado == 'inactivo' ? 'table-secondary' : '' }}">
                                    <td class="fw-bold text-muted">#{{ $usuario->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle-sm bg-primary text-white me-2">
                                                {{ substr($usuario->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="fw-semibold">{{ $usuario->name }}</div>
                                                @if($usuario->fecha_nacimiento)
                                                    <small class="text-muted">
                                                        {{ \Carbon\Carbon::parse($usuario->fecha_nacimiento)->age }} años
                                                    </small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-truncate" style="max-width: 200px;" title="{{ $usuario->email }}">
                                            {{ $usuario->email }}
                                        </div>
                                    </td>
                                    <td>
                                        @if($usuario->telefono)
                                            <span class="badge bg-light text-dark border">
                                                <i class="fas fa-phone me-1"></i>{{ $usuario->telefono }}
                                            </span>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $roleColors = [
                                                'player' => 'primary',
                                                'coach' => 'warning', 
                                                'parent' => 'info',
                                                'admin' => 'danger',
                                                'user' => 'secondary'
                                            ];
                                            $color = $roleColors[$usuario->role] ?? 'secondary';
                                        @endphp
                                        <span class="badge bg-{{ $color }}">
                                            <i class="fas 
                                                @if($usuario->role == 'player') fa-user 
                                                @elseif($usuario->role == 'coach') fa-whistle 
                                                @elseif($usuario->role == 'parent') fa-users 
                                                @elseif($usuario->role == 'admin') fa-crown 
                                                @else fa-user @endif
                                                me-1">
                                            </i>
                                            {{ ucfirst($usuario->role) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($usuario->estado == 'activo')
                                            <span class="badge bg-success">
                                                <i class="fas fa-check-circle me-1"></i>Activo
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                <i class="fas fa-times-circle me-1"></i>Inactivo
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1 flex-wrap justify-content-center">
                                            <!-- Editar -->
                                            <button class="btn btn-outline-primary btn-sm action-btn"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editarUsuarioModal{{ $usuario->id }}"
                                                    title="Editar usuario">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <!-- Cambiar contraseña -->
                                            <button class="btn btn-outline-warning btn-sm action-btn"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#cambiarPasswordModal{{ $usuario->id }}"
                                                    title="Cambiar contraseña">
                                                <i class="fas fa-key"></i>
                                            </button>

                                            <!-- Compartir Credenciales -->
                                            <button class="btn btn-outline-info btn-sm action-btn"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#compartirCredencialesModal{{ $usuario->id }}"
                                                    title="Compartir credenciales">
                                                <i class="fas fa-share-alt"></i>
                                            </button>

                                            <!-- Activar / Desactivar -->
                                            <form action="{{ route('usuarios.toggle', $usuario->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                @if ($usuario->estado == 'activo')
                                                    <button type="submit" 
                                                            class="btn btn-outline-danger btn-sm action-btn"
                                                            onclick="return confirm('¿Desactivar este usuario?')"
                                                            title="Desactivar usuario">
                                                        <i class="fas fa-ban"></i>
                                                    </button>
                                                @else
                                                    <button type="submit" 
                                                            class="btn btn-outline-success btn-sm action-btn"
                                                            onclick="return confirm('¿Activar este usuario?')"
                                                            title="Activar usuario">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                @endif
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                  <!-- Modal Compartir Credenciales -->
                                  <div class="modal fade" id="compartirCredencialesModal{{ $usuario->id }}" tabindex="-1" aria-hidden="true">
                                      <div class="modal-dialog modal-md">
                                          <div class="modal-content">
                                              <div class="modal-header bg-info text-white">
                                                  <h5 class="modal-title">
                                                      <i class="fas fa-share-alt me-2"></i>Compartir Credenciales
                                                  </h5>
                                                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                              </div>
                                              <div class="modal-body">
                                                  <div class="alert alert-info">
                                                      <i class="fas fa-info-circle me-2"></i>
                                                      Se enviarán las credenciales de acceso al correo del usuario.
                                                  </div>

                                                  <div class="credentials-card p-3 border rounded bg-light">
                                                      <h6 class="text-center mb-3">📧 Credenciales de Acceso</h6>

                                                      <!-- Nombre del Usuario -->
                                                      <div class="mb-3">
                                                          <label class="form-label fw-semibold">Nombre del Usuario:</label>
                                                          <div class="input-group">
                                                              <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                              <input type="text" class="form-control bg-white" value="{{ $usuario->name }}" readonly>
                                                              <button type="button" class="btn btn-outline-secondary" 
                                                                      onclick="copiarTexto('{{ $usuario->name }}')">
                                                                  <i class="fas fa-copy"></i>
                                                              </button>
                                                          </div>
                                                      </div>

                                                      <!-- Email del Usuario -->
                                                      <div class="mb-3">
                                                          <label class="form-label fw-semibold">Email:</label>
                                                          <div class="input-group">
                                                              <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                              <input type="text" class="form-control bg-white" value="{{ $usuario->email }}" readonly>
                                                              <button type="button" class="btn btn-outline-secondary" 
                                                                      onclick="copiarTexto('{{ $usuario->email }}')">
                                                                  <i class="fas fa-copy"></i>
                                                              </button>
                                                          </div>
                                                      </div>

                                                      <!-- Contraseña - SOLUCIÓN DEFINITIVA -->
                                                      <div class="mb-3">
                                                          <label class="form-label fw-semibold">Contraseña para Enviar:</label>
                                                          <div class="input-group">
                                                              <span class="input-group-text"><i class="fas fa-key"></i></span>
                                                              <input type="text" class="form-control" 
                                                                  id="passwordParaEnviar{{ $usuario->id }}" 
                                                                  value="{{ $usuario->password_plain ?? 'Usuario123' }}"
                                                                  placeholder="Ingresa la contraseña a enviar">
                                                              <button type="button" class="btn btn-outline-secondary" 
                                                                      onclick="copiarPassword({{ $usuario->id }})">
                                                                  <i class="fas fa-copy"></i>
                                                              </button>
                                                              <button type="button" class="btn btn-outline-info" 
                                                                      onclick="mostrarOcultarPassword({{ $usuario->id }})"
                                                                      title="Mostrar/ocultar contraseña">
                                                                  <i class="fas fa-eye"></i>
                                                              </button>
                                                          </div>
                                                          <div class="mt-2">
                                                              <small class="text-info">
                                                                  <i class="fas fa-lightbulb me-1"></i>
                                                                  <strong>Sugerencias rápidas:</strong>
                                                                  <span class="sugerencia-password" onclick="usarSugerencia('{{ $usuario->id }}', '{{ $usuario->email }}')">usuario+email</span> • 
                                                                  <span class="sugerencia-password" onclick="usarSugerencia('{{ $usuario->id }}', '{{ substr($usuario->name, 0, 3) }}123')">nombre123</span> • 
                                                                  <span class="sugerencia-password" onclick="usarSugerencia('{{ $usuario->id }}', '{{ \Carbon\Carbon::parse($usuario->fecha_nacimiento)->format('dmY') }}')">fecha_nac</span>
                                                              </small>
                                                          </div>
                                                      </div>

                                                      <!-- Mensaje Personalizado -->
                                                      <div class="mb-3">
                                                          <label class="form-label fw-semibold">Mensaje Personalizado:</label>
                                                          <textarea class="form-control" id="mensajePersonalizado{{ $usuario->id }}" 
                                                                  rows="3" placeholder="Hola {{ explode(' ', $usuario->name)[0] }}, aquí tienes tus credenciales de acceso..."></textarea>
                                                          <small class="text-muted">Este mensaje se incluirá en el email.</small>
                                                      </div>

                                                      <!-- Resumen de Envío -->
                                                      <div class="alert alert-warning mt-3">
                                                          <h6 class="alert-heading">📨 Resumen del Envío:</h6>
                                                          <div class="small">
                                                              <strong>Destinatario:</strong> {{ $usuario->email }}<br>
                                                              <strong>Asunto:</strong> Credenciales de Acceso - {{ config('app.name') }}<br>
                                                              <strong>Contenido:</strong> Nombre de usuario, email y contraseña
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                      <i class="fas fa-times me-1"></i>Cancelar
                                                  </button>
                                                  <button type="button" class="btn btn-success" 
                                                          onclick="enviarCredenciales({{ $usuario->id }})">
                                                          <i class="fas fa-paper-plane me-1"></i>Enviar por Email
                                                  </button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                              @empty
                              <tr>
                                  <td colspan="7" class="text-center py-4">
                                      <div class="empty-state">
                                          <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                          <h5 class="text-muted">No hay usuarios registrados</h5>
                                          <p class="text-muted">Comienza agregando el primer usuario al sistema.</p>
                                      </div>
                                  </td>
                              </tr>
                              @endforelse
                          </tbody>
                      </table>
                  </div>
              </div>
                
                <!-- MODALES FUERA DE LA TABLA -->
                @foreach ($usuarios ?? [] as $usuario)
                <div class="modal fade" id="editarUsuarioModal{{ $usuario->id }}" tabindex="-1" aria-labelledby="editarUsuarioLabel{{ $usuario->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="POST" action="{{ route('usuarios.update', $usuario->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editarUsuarioLabel{{ $usuario->id }}">Editar Usuario</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control" name="nombre" value="{{ $usuario->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email">Correo</label>
                                        <input type="email" class="form-control" name="email" value="{{ $usuario->email }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="telefono">Teléfono</label>
                                        <input type="text" class="form-control" name="telefono" value="{{ $usuario->telefono }}">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach

                @foreach ($usuarios ?? [] as $usuario)
                <div class="modal fade" id="cambiarPasswordModal{{ $usuario->id }}" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-sm">
                    <form method="POST" action="{{ route('usuarios.password', $usuario->id) }}">
                      @csrf
                      @method('PUT')
                      <div class="modal-content bg-dark text-light border-secondary">
                        <div class="modal-header border-secondary">
                          <h5 class="modal-title"><i class="fas fa-key me-2"></i> Cambiar contraseña</h5>
                          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                          <div class="mb-3">
                            <label class="form-label">Nueva contraseña</label>
                            <input type="password" name="password" class="form-control bg-secondary bg-opacity-10 text-light border-0" minlength="8" required>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Confirmar contraseña</label>
                            <input type="password" name="password_confirmation" class="form-control bg-secondary bg-opacity-10 text-light border-0" minlength="8" required>
                          </div>

                          {{-- Muestra errores si los hay --}}
                          @if ($errors->any())
                            <div class="alert alert-danger py-2">
                              <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                                @endforeach
                              </ul>
                            </div>
                          @endif
                        </div>
                        <div class="modal-footer border-secondary">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                          <button type="submit" class="btn btn-jeff">Guardar</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                @endforeach
            </div>

            <!-- INSCRIPCIONES -->
            <div id="inscripciones" class="section-content">
                <h1 class="section-title">Gestionar Usuarios</h1>

                <div class="form-registro">
                    <h3>Registrar Nueva Inscripción</h3>
                    <form id="formInscripcion" method="POST" action="{{ route('admin.inscripciones.store') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <label for="jugadorInscripcion">Jugador</label>
                                <select class="form-select" id="jugadorInscripcion" name="jugador_id" required>
                                    <option value="">Seleccionar jugador</option>
                                    @foreach($jugadores as $jugador)
                                        <option value="{{ $jugador->id }}">{{ $jugador->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="disciplinaInscripcion">Disciplina</label>
                                <select class="form-select" id="disciplinaInscripcion" name="disciplina" required>
                                    <option value="">Seleccionar disciplina</option>
                                    <option value="futbol">Fútbol</option>
                                    <option value="basquet">Básquet</option>
                                    <option value="voley">Vóley</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="categoriaInscripcion">Categoría</label>
                                <select class="form-select" id="categoriaInscripcion" name="categoria" required>
                                    <option value="">Seleccionar categoría</option>
                                    <option value="sub8">Sub-8</option>
                                    <option value="sub12">Sub-12</option>
                                    <option value="sub14">Sub-14</option>
                                    <option value="sub16">Sub-16</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tipoEntrenamiento">Tipo de Entrenamiento</label>
                                <select class="form-select" id="tipoEntrenamiento" name="tipo_entrenamiento" required>
                                    <option value="">Seleccionar tipo</option>
                                    <option value="regular">Regular</option>
                                    <option value="personalizado">Personalizado</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="fechaInscripcion">Fecha de Inscripción</label>
                                <input type="date" class="form-control" id="fechaInscripcion" name="fecha" required>
                            </div>
                            <div class="form-group">
                                <label for="entrenadorAsignado">Entrenador Asignado</label>
                                <select class="form-select" id="entrenadorAsignado" name="entrenador_id">
                                    <option value="">Seleccionar entrenador</option>
                                    @foreach($entrenadores as $entrenador)
                                        <option value="{{ $entrenador->id }}">{{ $entrenador->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="observacionesInscripcion">Observaciones</label>
                            <textarea class="form-control" id="observacionesInscripcion" name="observaciones" rows="3"
                                placeholder="Observaciones adicionales"></textarea>
                        </div>

                        <button type="submit" class="btn btn-jeff">Registrar Inscripción</button>
                    </form>
                </div>

                <h2 class="subtitulo-rol">Usuarios Asignados</h2>
                <div class="card card-custom">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Jugador</th>
                                        <th>Disciplina</th>
                                        <th>Categoría</th>
                                        <th>Fecha</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Juan Pérez</td>
                                        <td>⚽ Fútbol</td>
                                        <td>Sub-14</td>
                                        <td>05/10/2025</td>
                                        <td><span class="badge bg-warning">Pendiente</span></td>
                                        <td>
                                            <button class="btn btn-jeff btn-sm">Aprobar</button>
                                            <button class="btn btn-jeff-secondary btn-sm">Rechazar</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- REGISTROS -->
            <div id="inscripciones2" class="section-content">
                <h1 class="section-title">Gestión de Registros</h1>
                <!-- TABLA PRINCIPAL -->
                <h2 class="subtitulo-rol">Registros en el Sistema</h2>
                <div class="card card-custom">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre Completo</th>
                                        <th>Contacto</th>
                                        <th>Plan Adquirido</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($registros as $registro)
                                        <tr class="{{ intval($registro->tiene_plan) === 1 ? 'table-success' : '' }}">
                                            <td>{{ $registro->id }}</td>

                                            <td>
                                                <strong>{{ $registro->nombres }}</strong><br>
                                                <small class="text-muted">
                                                    {{ $registro->apellido_paterno }} {{ $registro->apellido_materno }}
                                                </small>
                                            </td>

                                            <td>
                                                <strong>{{ $registro->email }}</strong><br>
                                                <small class="text-muted">{{ $registro->nro_celular }}</small>
                                            </td>

                                            <td>
                                                @if( intval($registro->tiene_plan) === 1 )
                                                    <span class="badge bg-success">{{ $registro->plan_nombre }}</span><br>
                                                    <small class="text-muted">S/ {{ $registro->plan_precio }}</small>
                                                @else
                                                    <span class="badge bg-secondary">Sin plan</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if( intval($registro->tiene_plan) === 1 )
                                                    <span class="badge bg-success">{{ $registro->estado_suscripcion }}</span><br>
                                                    <small>Vence:
                                                        {{ $registro->fecha_fin
                                                            ? \Carbon\Carbon::parse(trim($registro->fecha_fin))->format('d/m/Y')
                                                            : 'N/A' }}
                                                    </small>
                                                @else
                                                    <span class="badge bg-secondary">Inactivo</span>
                                                @endif
                                            </td>

                                            <td>
                                                <div class="d-flex gap-2">
                                                    <button class="btn btn-jeff btn-sm position-relative"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalDetalle{{ $registro->id }}">
                                                        <i class="fas fa-eye"></i> Ver
                                                        @if( intval($registro->tiene_plan) === 1 )
                                                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                                PLAN
                                                            </span>
                                                        @endif
                                                    </button>
                                                    
                                                    @if( intval($registro->tiene_plan) !== 1 && !empty($registro->plan_nombre) )
                                                        <!-- Botón Confirmar para pagos pendientes -->
                                                        <button class="btn btn-success btn-sm" 
                                                                onclick="confirmarPago({{ $registro->id }}, '{{ $registro->nombres }} {{ $registro->apellido_paterno }}', '{{ $registro->plan_nombre }}')"
                                                                title="Confirmar pago y activar suscripción">
                                                            <i class="fas fa-check-circle"></i> Confirmar
                                                        </button>
                                                    @elseif( intval($registro->tiene_plan) !== 1 )
                                                        <!-- Botón para registrar pago manual -->
                                                        <button class="btn btn-primary btn-sm" 
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modalRegistrarPago{{ $registro->id }}"
                                                                title="Registrar pago manual">
                                                            <i class="fas fa-plus-circle"></i> Registrar Pago
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODALES -->
            @foreach($registros as $registro)
            @php
                // DETECTAR SI EXISTE PLAN ADQUIRIDO (INCLUSO SI NO ESTÁ ACTIVO)
                $tienePlanAdquirido = !empty($registro->plan_nombre) && $registro->plan_nombre !== null;
                $planActivo = $tienePlanAdquirido && intval($registro->tiene_plan) === 1 && $registro->estado_suscripcion === 'active';
                
                $fechaInicio = $registro->fecha_inicio ? \Carbon\Carbon::parse(trim($registro->fecha_inicio)) : null;
                $fechaFin = $registro->fecha_fin ? \Carbon\Carbon::parse(trim($registro->fecha_fin)) : null;
                
                // CALCULAR DÍAS RESTANTES SI HAY FECHA FIN
                $diasRestantes = null;
                $claseDias = 'bg-success';
                if ($fechaFin) {
                    $diasRestantes = $fechaFin->diffInDays(now(), false) * -1;
                    if ($diasRestantes < 0) {
                        $claseDias = 'bg-danger';
                        $diasRestantes = 'Vencido';
                    } elseif ($diasRestantes <= 7) {
                        $claseDias = 'bg-warning';
                    }
                }

                //  DETERMINAR COLORES Y ESTADOS
                $colorPrincipal = $planActivo ? 'success' : ($tienePlanAdquirido ? 'warning' : 'secondary');
                $colorClase = $planActivo ? 'alert-success' : ($tienePlanAdquirido ? 'alert-warning' : 'alert-secondary');
                $iconoEstado = $planActivo ? 'fa-check-circle' : ($tienePlanAdquirido ? 'fa-clock' : 'fa-times-circle');
                $textoEstado = $planActivo ? 'ACTIVO' : ($tienePlanAdquirido ? 'ADQUIRIDO' : 'SIN PLAN');
            @endphp

            <div class="modal fade" id="modalDetalle{{ $registro->id }}" tabindex="-1" aria-labelledby="modalDetalleLabel{{ $registro->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <!-- ENCABEZADO DEL MODAL -->
                        <div class="modal-header bg-light">
                            <h5 class="modal-title">
                                <i class="fas fa-user-circle me-2"></i>Detalles del Registro #{{ $registro->id }}
                                <span class="badge bg-{{ $colorPrincipal }} ms-2">
                                    <i class="fas {{ $iconoEstado }} me-1"></i>{{ $textoEstado }}
                                </span>
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- CUERPO DEL MODAL -->
                        <div class="modal-body">
                            <!-- INFORMACIÓN PERSONAL -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-section">
                                        <h6 class="text-primary border-bottom pb-2">
                                            <i class="fas fa-user me-2"></i>Información Personal
                                        </h6>
                                        <div class="info-item">
                                            <strong>Nombre completo:</strong><br>
                                            {{ $registro->nombres }} {{ $registro->apellido_paterno }} {{ $registro->apellido_materno }}
                                        </div>
                                        <div class="info-item">
                                            <strong>Documento:</strong><br>
                                            {{ $registro->tipo_documento }} - {{ $registro->nro_documento }}
                                        </div>
                                        <div class="info-item">
                                            <strong>Fecha de nacimiento:</strong><br>
                                            {{ $registro->fecha_nacimiento ? \Carbon\Carbon::parse($registro->fecha_nacimiento)->format('d/m/Y') : 'N/A' }}
                                        </div>
                                        <div class="info-item">
                                            <strong>Género:</strong> 
                                            <span class="badge bg-secondary">{{ $registro->genero }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="info-section">
                                        <h6 class="text-primary border-bottom pb-2">
                                            <i class="fas fa-address-card me-2"></i>Información de Contacto
                                        </h6>
                                        <div class="info-item">
                                            <strong>Email:</strong><br>
                                            <a href="mailto:{{ $registro->email }}">{{ $registro->email }}</a>
                                        </div>
                                        <div class="info-item">
                                            <strong>Teléfono:</strong><br>
                                            <a href="tel:{{ $registro->nro_celular }}">{{ $registro->nro_celular }}</a>
                                        </div>
                                        <div class="info-item">
                                            <strong>Fecha de registro:</strong><br>
                                            {{ $registro->created_at ? \Carbon\Carbon::parse($registro->created_at)->format('d/m/Y H:i') : 'N/A' }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- SECCIÓN DE PLANES - SIEMPRE VISIBLE SI HAY PLAN ADQUIRIDO -->
                            @if($tienePlanAdquirido)
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="plan-section">
                                        <h6 class="text-{{ $colorPrincipal }} border-bottom pb-2">
                                            <i class="fas fa-crown me-2"></i>📦 Plan Adquirido
                                        </h6>
                                        <div class="alert {{ $colorClase }} border-0 shadow-sm">
                                            <!-- ENCABEZADO DEL PLAN -->
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h5 class="mb-0 text-{{ $colorPrincipal }}">
                                                    <i class="fas fa-star me-2"></i>{{ $registro->plan_nombre }}
                                                </h5>
                                                <div class="text-end">
                                                    <span class="badge bg-{{ $colorPrincipal }} fs-6">
                                                        {{ $registro->estado_suscripcion ?? 'adquirido' }}
                                                    </span>
                                                    @if($diasRestantes && $planActivo)
                                                        <span class="badge {{ $claseDias }} ms-1">
                                                            {{ is_numeric($diasRestantes) ? $diasRestantes . ' días' : $diasRestantes }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- DETALLES DEL PLAN - SIEMPRE VISIBLES -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="plan-detail-item">
                                                        <strong><i class="fas fa-tag me-2"></i>Plan:</strong>
                                                        {{ $registro->plan_nombre }}
                                                    </div>
                                                    <div class="plan-detail-item">
                                                        <strong><i class="fas fa-align-left me-2"></i>Descripción:</strong>
                                                        {{ $registro->plan_descripcion ?? 'No disponible' }}
                                                    </div>
                                                    <div class="plan-detail-item">
                                                        <strong><i class="fas fa-money-bill-wave me-2"></i>Precio:</strong>
                                                        S/ {{ number_format($registro->plan_precio, 2) }}
                                                    </div>
                                                    <div class="plan-detail-item">
                                                        <strong><i class="fas fa-layer-group me-2"></i>Tipo:</strong>
                                                        {{ $registro->plan_tipo ?? 'Estándar' }}
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="plan-detail-item">
                                                        <strong><i class="fas fa-calendar-alt me-2"></i>Duración:</strong>
                                                        {{ $registro->plan_duracion ?? '1' }} mes(es)
                                                    </div>
                                                    <div class="plan-detail-item">
                                                        <strong><i class="fas fa-play-circle me-2"></i>Fecha inicio:</strong>
                                                        {{ $fechaInicio ? $fechaInicio->format('d/m/Y') : 'N/A' }}
                                                    </div>
                                                    <div class="plan-detail-item">
                                                        <strong><i class="fas fa-flag-checkered me-2"></i>Fecha fin:</strong>
                                                        {{ $fechaFin ? $fechaFin->format('d/m/Y') : 'N/A' }}
                                                    </div>
                                                    @if($fechaInicio && $fechaFin && $planActivo)
                                                    <div class="plan-detail-item">
                                                        <strong><i class="fas fa-chart-line me-2"></i>Progreso:</strong>
                                                        @php
                                                            $totalDias = $fechaInicio->diffInDays($fechaFin);
                                                            $diasTranscurridos = $fechaInicio->diffInDays(now());
                                                            $porcentaje = min(100, max(0, ($diasTranscurridos / $totalDias) * 100));
                                                        @endphp
                                                        <div class="progress mt-1" style="height: 8px;">
                                                            <div class="progress-bar bg-{{ $colorPrincipal }}" 
                                                                role="progressbar" 
                                                                style="width: {{ $porcentaje }}%"
                                                                aria-valuenow="{{ $porcentaje }}" 
                                                                aria-valuemin="0" 
                                                                aria-valuemax="100">
                                                            </div>
                                                        </div>
                                                        <small class="text-muted">{{ number_format($porcentaje, 1) }}% completado</small>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- INFORMACIÓN DE PAGO -->
                                            @if($registro->stripe_subscription_id)
                                            <div class="mt-3 p-3 bg-dark text-white rounded">
                                                <div class="plan-detail-item">
                                                    <strong><i class="fas fa-receipt me-2"></i>ID de Pago Stripe:</strong>
                                                    <code class="ms-2">{{ $registro->stripe_subscription_id }}</code>
                                                </div>
                                            </div>
                                            @endif

                                            <!-- ESTADO DEL PLAN - SIEMPRE VISIBLE -->
                                            <div class="mt-3 p-3 bg-{{ $colorPrincipal }} text-white rounded">
                                                <div class="plan-detail-item text-center">
                                                    <strong>
                                                        <i class="fas {{ $iconoEstado }} me-2"></i>
                                                        @if($planActivo)
                                                            PLAN ACTIVO - El usuario tiene acceso completo a la plataforma
                                                        @elseif($tienePlanAdquirido)
                                                            PLAN ADQUIRIDO - Estado: {{ strtoupper($registro->estado_suscripcion ?? 'ADQUIRIDO') }}
                                                        @endif
                                                    </strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @else
                            <!-- USUARIO SIN PLAN ADQUIRIDO - SOLO ESTA SECCIÓN DESAPARECE -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="alert alert-secondary border-0 shadow-sm">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-times-circle fa-2x me-3 text-secondary"></i>
                                            <div>
                                                <h6 class="mb-1">Este usuario no ha adquirido ningún plan</h6>
                                                <p class="mb-0">No se registran planes adquiridos para este usuario.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                        </div>

                        <!-- PIE DEL MODAL -->
                        <div class="modal-footer bg-light">
                            @if($tienePlanAdquirido)
                            <div class="me-auto">
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Plan: {{ $textoEstado }} | 
                                    Adquirido el: {{ $fechaInicio ? $fechaInicio->format('d/m/Y') : 'Fecha no disponible' }}
                                </small>
                            </div>
                            @endif
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times me-1"></i>Cerrar
                            </button>
                            @if($tienePlanAdquirido)
                            <button type="button" class="btn btn-jeff">
                                <i class="fas fa-cog me-1"></i>Gestionar Plan
                            </button>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
            @endforeach


            <!-- NOTICIAS -->
            <div id="noticias" class="section-content">
                <h1 class="section-title">Gestión de Noticias</h1>
                
                <!-- Formulario de Publicación -->
                <div class="form-registro">
                    <h3>Publicar Nueva Noticia</h3>
                    @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    
                    <form id="formNoticia" method="POST" action="{{ route('admin.noticias.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <label for="tituloNoticia">Título</label>
                                <input type="text" class="form-control" id="tituloNoticia" name="titulo" placeholder="Título de la noticia" required value="{{ old('titulo') }}">
                            </div>
                            <div class="form-group">
                                <label for="categoriaNoticia">Categoría</label>
                                <select class="form-select" id="categoriaNoticia" name="categoria" required>
                                    <option value="">Seleccionar categoría</option>
                                    <option value="general" {{ old('categoria') == 'general' ? 'selected' : '' }}>General</option>
                                    <option value="torneo" {{ old('categoria') == 'torneo' ? 'selected' : '' }}>Torneo</option>
                                    <option value="entrenamiento" {{ old('categoria') == 'entrenamiento' ? 'selected' : '' }}>Entrenamiento</option>
                                    <option value="logro" {{ old('categoria') == 'logro' ? 'selected' : '' }}>Logro</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="descripcionNoticia">Descripción</label>
                            <textarea class="form-control" id="descripcionNoticia" name="descripcion" rows="4" placeholder="Escribe la noticia aquí..." required>{{ old('descripcion') }}</textarea>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="imagenNoticia">Imagen (Opcional)</label>
                                <input type="file" class="form-control" id="imagenNoticia" name="imagen" accept="image/*">
                                <small class="text-muted">Formatos permitidos: JPEG, PNG, JPG, GIF. Máximo 2MB</small>
                            </div>
                            <div class="form-group">
                                <label for="fechaPublicacion">Fecha de Publicación</label>
                                <input type="date" class="form-control" id="fechaPublicacion" name="fecha" required value="{{ old('fecha', date('Y-m-d')) }}">
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-jeff">Publicar Noticia</button>
                    </form>
                </div>
                
                <!-- Tarjetas de Noticias Publicadas -->
                <h2 class="subtitulo-rol">Noticias Publicadas</h2>
                
                @if(($noticias ?? collect())->count() > 0)
                    <div class="eventos-destacados">
                        @foreach($noticias ?? [] as $noticia)
                            <div class="evento" style="position: relative;">
                                <!-- Imagen de la Noticia -->
                                <div style="width: 100%; height: 150px; overflow: hidden; border-radius: 8px; margin-bottom: 15px;">
                                    @if($noticia->imagen)
                                    @if(strpos($noticia->imagen, 'http') === 0)
                                    <img src="{{ $noticia->imagen }}" alt="{{ $noticia->titulo }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                    <img src="{{ asset('storage/' . $noticia->imagen) }}" alt="{{ $noticia->titulo }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    @endif
                                    @else
                                    <img src="https://images.unsplash.com/photo-1575361204480-aadea25e6e68?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" alt="{{ $noticia->titulo }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    @endif
                                </div>
                                
                                <!-- Categoría Badge -->
                                <span class="badge" style="
                                    position: absolute;
                                    top: 10px;
                                    right: 10px;
                                    @php
                                        $colorCategoria = [
                                            'general' => 'background-color: #2196f3;',
                                            'torneo' => 'background-color: #4caf50;',
                                            'entrenamiento' => 'background-color: #ff9800;',
                                            'logro' => 'background-color: #f44336;'
                                        ];
                                    @endphp
                                    {{ $colorCategoria[$noticia->categoria] ?? 'background-color: #9e9e9e;' }}
                                    color: white;
                                    padding: 5px 10px;
                                    border-radius: 20px;
                                    font-size: 0.75rem;
                                ">{{ ucfirst($noticia->categoria) }}</span>

                                <!-- Título -->
                                <h3 style="margin: 10px 0; color: var(--verde-medio); font-weight: 700;">{{ $noticia->titulo }}</h3>
                                
                                <!-- Fecha -->
                                <p style="font-size: 0.85rem; color: #999; margin: 5px 0;">
                                    <i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($noticia->fecha)->format('d/m/Y') }}
                                </p>
                                
                                <!-- Descripción (primeras 100 caracteres) -->
                                <p style="font-size: 0.9rem; color: #666; margin: 10px 0; line-height: 1.5;">
                                    {{ Str::limit($noticia->descripcion, 100, '...') }}
                                </p>
                                
                                <!-- Estado -->
                                <p style="margin: 10px 0;">
                                    <span class="badge bg-success">Publicada</span>
                                </p>
                                
                                <!-- Acciones -->
                                <div style="display: flex; gap: 8px; margin-top: 15px;">
                                    <!-- Botón Editar -->
                                    <button type="button" class="btn btn-jeff-secondary btn-sm" style="flex: 1;" data-bs-toggle="modal" data-bs-target="#modalEditarNoticia{{ $noticia->id }}">
                                        <i class="fas fa-edit"></i> Editar
                                    </button>
                                    
                                    <!-- Botón Eliminar -->
                                    <form action="{{ route('admin.noticias.destroy', $noticia->id) }}" method="POST" style="flex: 1;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-jeff btn-sm" style="width: 100%;" onclick="return confirm('¿Estás seguro de que deseas eliminar esta noticia?')">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                                
                                
                            </div>
                                    <!-- Modal para Editar Noticia -->
                                <div class="modal fade" id="modalEditarNoticia{{ $noticia->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background: linear-gradient(135deg, #4caf50, #2e7d32); color: white;">
                                                <h5 class="modal-title">Editar Noticia</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.noticias.update', $noticia->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    
                                                    <div class="form-group mb-3">
                                                        <label for="titulo{{ $noticia->id }}" class="form-label">Título</label>
                                                        <input type="text" class="form-control" id="titulo{{ $noticia->id }}" name="titulo" value="{{ $noticia->titulo }}" required>
                                                    </div>
                                                    
                                                    <div class="form-group mb-3">
                                                        <label for="categoria{{ $noticia->id }}" class="form-label">Categoría</label>
                                                        <select class="form-select" id="categoria{{ $noticia->id }}" name="categoria" required>
                                                            <option value="general" {{ $noticia->categoria == 'general' ? 'selected' : '' }}>General</option>
                                                            <option value="torneo" {{ $noticia->categoria == 'torneo' ? 'selected' : '' }}>Torneo</option>
                                                            <option value="entrenamiento" {{ $noticia->categoria == 'entrenamiento' ? 'selected' : '' }}>Entrenamiento</option>
                                                            <option value="logro" {{ $noticia->categoria == 'logro' ? 'selected' : '' }}>Logro</option>
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="form-group mb-3">
                                                        <label for="descripcion{{ $noticia->id }}" class="form-label">Descripción</label>
                                                        <textarea class="form-control" id="descripcion{{ $noticia->id }}" name="descripcion" rows="4" required>{{ $noticia->descripcion }}</textarea>
                                                    </div>
                                                    
                                                    <div class="form-group mb-3">
                                                        <label for="imagen{{ $noticia->id }}" class="form-label">Cambiar Imagen (Opcional)</label>
                                                        @if($noticia->imagen)
                                                            <div class="mb-2">
                                                                <p class="text-muted">Imagen actual:</p>
                                                                @if(strpos($noticia->imagen, 'http') === 0)
                                                                    <img src="{{ $noticia->imagen }}" alt="{{ $noticia->titulo }}" style="max-width: 150px; height: auto; border-radius: 4px;">
                                                                @else
                                                                    <img src="{{ asset('storage/' . $noticia->imagen) }}" alt="{{ $noticia->titulo }}" style="max-width: 150px; height: auto; border-radius: 4px;">
                                                                @endif
                                                            </div>
                                                        @endif
                                                        <input type="file" class="form-control" id="imagen{{ $noticia->id }}" name="imagen" accept="image/*">
                                                        <small class="text-muted">Dejar en blanco para mantener la imagen actual</small>
                                                    </div>
                                                    
                                                    <div class="form-group mb-3">
                                                        <label for="fecha{{ $noticia->id }}" class="form-label">Fecha</label>
                                                        <input type="date" class="form-control" id="fecha{{ $noticia->id }}" name="fecha" value="{{ $noticia->fecha }}" required>
                                                    </div>
                                                    
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-jeff">Guardar Cambios</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                    </div>
                @else
                    <div class="card card-custom" style="text-align: center; padding: 40px;">
                        <p style="color: #999; font-size: 1.1rem;">No hay noticias publicadas aún</p>
                    </div>
                @endif
            </div>

            <!-- PLANES -->
            <div id="planes" class="section-content">
                <h1 class="section-title">Gestión de Planes</h1>

                <!-- Formulario de Registro de Planes -->
               <div class="form-registro">
                <h3>Crear Nuevo Plan</h3>
                <form id="formPlan" method="POST" action="{{ route('admin.planes.store') }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nombrePlan">Nombre del Plan</label>
                            <input type="text" class="form-control" id="nombrePlan" name="nombre" placeholder="Ej: Plan Básico" required>
                        </div>
                        <div class="form-group">
                            <label for="precioPlan">Precio (S/.)</label>
                            <input type="number" step="0.01" class="form-control" id="precioPlan" name="precio" placeholder="0.00" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="duracionPlan">Duración (meses)</label>
                            <input type="number" class="form-control" id="duracionPlan" name="duracion" placeholder="3" required>
                        </div>
                        <div class="form-group">
                            <label for="tipoPlan">Tipo de Plan</label>
                            <select class="form-select" id="tipoPlan" name="tipo" required>
                                <option value="">Seleccionar tipo</option>
                                <option value="basico">Básico</option>
                                <option value="premium">Premium</option>
                                <option value="vip">VIP</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="disciplinasPlan">Disciplinas Incluidas</label>
                            <select class="form-select" id="disciplinasPlan" name="disciplinas[]" multiple>
                                @foreach($disciplinas as $disciplina)
                                    <option value="{{ $disciplina->id }}">{{ $disciplina->nombre }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">Mantén presionado Ctrl para seleccionar múltiples disciplinas</small>
                        </div>
                        <div class="form-group">
                            <label for="estadoPlan">Estado</label>
                            <select class="form-select" id="estadoPlan" name="estado" required>
                                <option value="activo">Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="descripcionPlan">Descripción</label>
                        <textarea class="form-control" id="descripcionPlan" name="descripcion" rows="3" placeholder="Descripción detallada del plan"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="beneficiosPlan">Beneficios</label>
                        <textarea class="form-control" id="beneficiosPlan" name="beneficios" rows="3" placeholder="Lista de beneficios separados por comas"></textarea>
                    </div>

                    <button type="submit" class="btn btn-jeff">Crear Plan</button>
                </form>
            </div>

                <!-- Lista de Planes -->
                <h2 class="subtitulo-rol">Planes Disponibles</h2>
                <div class="card card-custom">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Duración</th>
                        <th>Disciplinas</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($planes as $plan)
                    <tr>
                        <td>{{ $plan->id }}</td>
                        <td>{{ $plan->nombre }}</td>
                        <td>S/. {{ number_format($plan->precio, 2) }}</td>
                        <td>{{ $plan->duracion }} meses</td>
                        <td>
                            @if($plan->disciplinas)
                                @php
                                    $disciplinasIds = explode(',', $plan->disciplinas);
                                    $disciplinasNombres = \App\Models\Disciplina::whereIn('id', $disciplinasIds)->pluck('nombre')->toArray();
                                @endphp
                                {{ implode(', ', $disciplinasNombres) }}
                            @else
                                <span class="text-muted">Sin disciplinas</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge 
                                @if($plan->tipo == 'basico') bg-secondary
                                @elseif($plan->tipo == 'premium') bg-primary
                                @else bg-warning text-dark
                                @endif">
                                {{ ucfirst($plan->tipo) }}
                            </span>
                        </td>
                        <td>
                            @if($plan->estado == 'activo')
                                <span class="badge bg-success">Activo</span>
                            @else
                                <span class="badge bg-danger">Inactivo</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editarPlanModal{{ $plan->id }}">
                                Editar
                            </button>
                            <form action="{{ route('admin.planes.destroy', $plan->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este plan?')">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">No hay planes registrados</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modales para Editar Planes -->
            @foreach($planes as $plan)
            <div class="modal fade" id="editarPlanModal{{ $plan->id }}" tabindex="-1" aria-labelledby="editarPlanModalLabel{{ $plan->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header" style="background: linear-gradient(135deg, #4caf50, #2e7d32); color: white;">
                            <h5 class="modal-title">Editar Plan: {{ $plan->nombre }}</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <form method="POST" action="{{ route('admin.planes.update', $plan->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="nombrePlanEdit{{ $plan->id }}">Nombre del Plan</label>
                                        <input type="text" class="form-control" id="nombrePlanEdit{{ $plan->id }}" name="nombre" value="{{ $plan->nombre }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="precioPlanEdit{{ $plan->id }}">Precio (S/.)</label>
                                        <input type="number" step="0.01" class="form-control" id="precioPlanEdit{{ $plan->id }}" name="precio" value="{{ $plan->precio }}" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="duracionPlanEdit{{ $plan->id }}">Duración (meses)</label>
                                        <input type="number" class="form-control" id="duracionPlanEdit{{ $plan->id }}" name="duracion" value="{{ $plan->duracion }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tipoPlanEdit{{ $plan->id }}">Tipo de Plan</label>
                                        <select class="form-select" id="tipoPlanEdit{{ $plan->id }}" name="tipo" required>
                                            <option value="basico" {{ $plan->tipo == 'basico' ? 'selected' : '' }}>Básico</option>
                                            <option value="premium" {{ $plan->tipo == 'premium' ? 'selected' : '' }}>Premium</option>
                                            <option value="vip" {{ $plan->tipo == 'vip' ? 'selected' : '' }}>VIP</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="disciplinasPlanEdit{{ $plan->id }}">Disciplinas Incluidas</label>
                                        <select class="form-select" id="disciplinasPlanEdit{{ $plan->id }}" name="disciplinas[]" multiple>
                                            @foreach($disciplinas as $disciplina)
                                                <option value="{{ $disciplina->id }}" 
                                                    {{ in_array($disciplina->id, $plan->disciplinasArray) ? 'selected' : '' }}>
                                                    {{ $disciplina->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="text-muted">Mantén presionado Ctrl para seleccionar múltiples disciplinas</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="estadoPlanEdit{{ $plan->id }}">Estado</label>
                                        <select class="form-select" id="estadoPlanEdit{{ $plan->id }}" name="estado" required>
                                            <option value="activo" {{ $plan->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                                            <option value="inactivo" {{ $plan->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="descripcionPlanEdit{{ $plan->id }}">Descripción</label>
                                    <textarea class="form-control" id="descripcionPlanEdit{{ $plan->id }}" name="descripcion" rows="3">{{ $plan->descripcion }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="beneficiosPlanEdit{{ $plan->id }}">Beneficios</label>
                                    <textarea class="form-control" id="beneficiosPlanEdit{{ $plan->id }}" name="beneficios" rows="3">{{ $plan->beneficios }}</textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-jeff">Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- DISCIPLINAS -->
            <div id="disciplinas" class="section-content">
                <h1 class="section-title">Gestión de Disciplinas</h1>

                <!-- Formulario de Registro de Disciplinas -->
                <div class="form-registro">
                    <h3>Crear Nueva Disciplina</h3>
                    <form id="formDisciplina" method="POST" action="{{ route('admin.disciplinas.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="form-row">
                            <div class="form-group">
                                <label for="nombreDisciplina">Nombre</label>
                                <input type="text" class="form-control" id="nombreDisciplina" name="nombre" placeholder="Ej: Fútbol" required value="{{ old('nombre') }}">
                            </div>
                            <div class="form-group">
                                <label for="categoriaDisciplina">Categoría</label>
                                <select class="form-select" id="categoriaDisciplina" name="categoria" required>
                                    <option value="">Seleccionar categoría</option>
                                    <option value="Fútbol" {{ old('categoria') == 'Fútbol' ? 'selected' : '' }}>Fútbol</option>
                                    <option value="Voley" {{ old('categoria') == 'Voley' ? 'selected' : '' }}>Voley</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="edadMinima">Edad Mínima</label>
                                <input type="number" class="form-control" id="edadMinima" name="edad_minima" placeholder="5" value="{{ old('edad_minima') }}">
                            </div>
                            <div class="form-group">
                                <label for="edadMaxima">Edad Máxima</label>
                                <input type="number" class="form-control" id="edadMaxima" name="edad_maxima" placeholder="18" value="{{ old('edad_maxima') }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="cupoDisciplina">Cupo Máximo</label>
                                <input type="number" class="form-control" id="cupoDisciplina" name="cupo_maximo" placeholder="20" value="{{ old('cupo_maximo') }}">
                            </div>
                            <div class="form-group">
                                <label for="imagenDisciplina">Imagen de la Disciplina</label>
                                <input type="file" class="form-control" id="imagenDisciplina" name="imagen" accept="image/*">
                                <small class="text-muted">Formatos: JPEG, PNG, JPG, GIF. Máximo 2MB</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="descripcionDisciplina">Descripción</label>
                            <textarea class="form-control" id="descripcionDisciplina" name="descripcion" rows="3" placeholder="Descripción de la disciplina">{{ old('descripcion') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="requisitosDisciplina">Requisitos</label>
                            <textarea class="form-control" id="requisitosDisciplina" name="requisitos" rows="3" placeholder="Requisitos para participar">{{ old('requisitos') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="estadoDisciplina">Estado</label>
                            <select class="form-select" id="estadoDisciplina" name="estado" required>
                                <option value="activa" {{ old('estado') == 'activa' ? 'selected' : '' }}>Activa</option>
                                <option value="inactiva" {{ old('estado') == 'inactiva' ? 'selected' : '' }}>Inactiva</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-jeff">Crear Disciplina</button>
                    </form>
                </div>

                <!-- Lista de Disciplinas -->
                <h2 class="subtitulo-rol">Disciplinas Disponibles</h2>
                <div class="card card-custom">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Categoría</th>
                                        <th>Rango de Edad</th>
                                        <th>Cupo</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($disciplinas ?? [] as $disciplina)
                                    <tr>
                                        <td>{{ $disciplina->id }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($disciplina->imagen)
                                                    <img src="{{ asset('storage/' . $disciplina->imagen) }}" 
                                                         alt="{{ $disciplina->nombre }}" 
                                                         class="rounded me-2" 
                                                         style="width: 40px; height: 40px; object-fit: cover;">
                                                @else
                                                    <div class="bg-secondary rounded me-2 d-flex align-items-center justify-content-center" 
                                                         style="width: 40px; height: 40px;">
                                                        @if($disciplina->categoria == 'Fútbol')
                                                            <i class="fas fa-futbol text-white"></i>
                                                        @else
                                                            <i class="fas fa-volleyball text-white"></i>
                                                        @endif
                                                    </div>
                                                @endif
                                                <strong>{{ $disciplina->nombre }}</strong>
                                            </div>
                                        </td>
                                        <td>
                                            @if($disciplina->categoria == 'Fútbol')
                                                <span class="badge bg-success">Fútbol</span>
                                            @else
                                                <span class="badge bg-warning">Voley</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($disciplina->edad_minima && $disciplina->edad_maxima)
                                                {{ $disciplina->edad_minima }} - {{ $disciplina->edad_maxima }} años
                                            @else
                                                <span class="text-muted">Sin límite</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($disciplina->cupo_maximo)
                                                {{ $disciplina->cupo_maximo }} personas
                                            @else
                                                <span class="text-muted">Ilimitado</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($disciplina->estado == 'activa')
                                                <span class="badge bg-success">Activa</span>
                                            @else
                                                <span class="badge bg-danger">Inactiva</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editarDisciplinaModal{{ $disciplina->id }}">
                                                Editar
                                            </button>
                                            <form action="{{ route('admin.disciplinas.destroy', $disciplina->id) }}" method="POST" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta disciplina?')">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No hay disciplinas registradas</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Modales para Editar Disciplinas -->
                @foreach($disciplinas as $disciplina)
                <div class="modal fade" id="editarDisciplinaModal{{ $disciplina->id }}" tabindex="-1" aria-labelledby="editarDisciplinaModalLabel{{ $disciplina->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header" style="background: linear-gradient(135deg, #2196f3, #0d47a1); color: white;">
                                <h5 class="modal-title">Editar Disciplina: {{ $disciplina->nombre }}</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <form method="POST" action="{{ route('admin.disciplinas.update', $disciplina->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label for="nombreDisciplinaEdit{{ $disciplina->id }}">Nombre</label>
                                            <input type="text" class="form-control" id="nombreDisciplinaEdit{{ $disciplina->id }}" name="nombre" value="{{ $disciplina->nombre }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="categoriaDisciplinaEdit{{ $disciplina->id }}">Categoría</label>
                                            <select class="form-select" id="categoriaDisciplinaEdit{{ $disciplina->id }}" name="categoria" required>
                                                <option value="Fútbol" {{ $disciplina->categoria == 'Fútbol' ? 'selected' : '' }}>Fútbol</option>
                                                <option value="Voley" {{ $disciplina->categoria == 'Voley' ? 'selected' : '' }}>Voley</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group">
                                            <label for="edadMinimaEdit{{ $disciplina->id }}">Edad Mínima</label>
                                            <input type="number" class="form-control" id="edadMinimaEdit{{ $disciplina->id }}" name="edad_minima" value="{{ $disciplina->edad_minima }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="edadMaximaEdit{{ $disciplina->id }}">Edad Máxima</label>
                                            <input type="number" class="form-control" id="edadMaximaEdit{{ $disciplina->id }}" name="edad_maxima" value="{{ $disciplina->edad_maxima }}">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group">
                                            <label for="cupoMaximoEdit{{ $disciplina->id }}">Cupo Máximo</label>
                                            <input type="number" class="form-control" id="cupoMaximoEdit{{ $disciplina->id }}" name="cupo_maximo" value="{{ $disciplina->cupo_maximo }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="estadoDisciplinaEdit{{ $disciplina->id }}">Estado</label>
                                            <select class="form-select" id="estadoDisciplinaEdit{{ $disciplina->id }}" name="estado" required>
                                                <option value="activa" {{ $disciplina->estado == 'activa' ? 'selected' : '' }}>Activa</option>
                                                <option value="inactiva" {{ $disciplina->estado == 'inactiva' ? 'selected' : '' }}>Inactiva</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="imagenDisciplinaEdit{{ $disciplina->id }}">Imagen de la Disciplina</label>
                                        
                                        @if($disciplina->imagen)
                                            <div class="mb-3">
                                                <p class="text-muted mb-2">Imagen actual:</p>
                                                <img src="{{ asset('storage/' . $disciplina->imagen) }}" alt="{{ $disciplina->nombre }}" 
                                                     class="img-thumbnail" style="max-width: 200px; height: auto;">
                                                <div class="form-check mt-2">
                                                    <input class="form-check-input" type="checkbox" name="eliminar_imagen" id="eliminarImagen{{ $disciplina->id }}" value="1">
                                                    <label class="form-check-label text-danger" for="eliminarImagen{{ $disciplina->id }}">
                                                        Eliminar imagen actual
                                                    </label>
                                                </div>
                                            </div>
                                        @else
                                            <div class="alert alert-info mb-3">
                                                <small>No hay imagen actual para esta disciplina</small>
                                            </div>
                                        @endif

                                        <input type="file" class="form-control" id="imagenDisciplinaEdit{{ $disciplina->id }}" name="imagen" accept="image/*">
                                        <small class="text-muted">Formatos aceptados: JPG, PNG, GIF. Tamaño máximo: 2MB</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="descripcionDisciplinaEdit{{ $disciplina->id }}">Descripción</label>
                                        <textarea class="form-control" id="descripcionDisciplinaEdit{{ $disciplina->id }}" name="descripcion" rows="3">{{ $disciplina->descripcion }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="requisitosDisciplinaEdit{{ $disciplina->id }}">Requisitos</label>
                                        <textarea class="form-control" id="requisitosDisciplinaEdit{{ $disciplina->id }}" name="requisitos" rows="3">{{ $disciplina->requisitos }}</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-jeff">Guardar Cambios</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- REPORTES -->
            <div id="reportes" class="section-content">
                <x-report-section-selector :sections="[
                ['id' => 'usuarios', 'nombre' => 'Usuarios', 'icono' => 'users', 'color' => 'blue'],
                ['id' => 'asignar_jugadores', 'nombre' => 'Jugadores', 'icono' => 'user-plus', 'color' => 'green'],
                ['id' => 'inscripciones', 'nombre' => 'Inscripciones', 'icono' => 'clipboard-list', 'color' => 'purple'],
                ['id' => 'noticias', 'nombre' => 'Noticias', 'icono' => 'newspaper', 'color' => 'yellow'],
                ['id' => 'planes', 'nombre' => 'Planes', 'icono' => 'credit-card', 'color' => 'red'],
                ['id' => 'disciplinas', 'nombre' => 'Disciplinas', 'icono' => 'futbol', 'color' => 'indigo'],
            ]" />
            </div>       

            <!-- PERFIL DEL ADMINISTRADOR -->
            <div id="perfil" class="section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-user-circle me-2"></i>Mi Perfil - Administrador
                                    </h6>
                                </div>
                                <div class="card-body">
                                    @if(session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        </div>
                                    @endif

                                    @if(session('error'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        </div>
                                    @endif

                                    <form id="perfilAdminForm" method="POST" action="{{ route('admin.perfil.update') }}"
                                        enctype="multipart/form-data"
                                        x-data="{ showModal: false, tempImage: '{{ Auth::user()->foto_perfil ? asset('storage/' . Auth::user()->foto_perfil) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&size=200' }}', currentImage: '{{ Auth::user()->foto_perfil ? asset('storage/' . Auth::user()->foto_perfil) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&size=200' }}' }">
                                        @csrf
                                        @method('PUT')

                                        <div class="row">
                                            <!-- Foto de Perfil -->
                                            <div class="col-md-4 text-center mb-4">
                                                <div class="profile-photo-container position-relative">
                                                    <div class="position-relative d-inline-block">
                                                        <img :src="currentImage"
                                                            alt="Foto de Perfil"
                                                            class="profile-photo img-thumbnail mb-3 rounded-circle"
                                                            style="width: 200px; height: 200px; object-fit: cover;">
                                                        <button type="button"
                                                                @click.stop="showModal = true; tempImage = currentImage"
                                                                class="btn btn-primary rounded-circle position-absolute"
                                                                style="bottom: 15px; right: 0; width: 50px; height: 50px;">
                                                            <i class="fas fa-camera"></i>
                                                        </button>
                                                                                                        </div>
                                                </div>
                                                <p class="text-muted small mt-2">
                                                    JPG, PNG o GIF (máx. 2MB)
                                                </p>
                                                <!-- Modal para modificar foto -->
                                                <div
                                                    x-show="showModal"
                                                    x-cloak
                                                    class="modal"
                                                    style="background-color: rgba(0,0,0,0.5); z-index: 9999; display: flex; align-items: center; justify-content: center;"
                                                    @click.self="showModal = false; tempImage = currentImage; if($refs.fileInput) $refs.fileInput.value = ''"
                                                    @keydown.escape.window="showModal = false; tempImage = currentImage; if($refs.fileInput) $refs.fileInput.value = ''"
                                                >
                                                    <div class="modal-dialog modal-dialog-centered" @click.stop>
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-primary text-white">
                                                                <h5 class="modal-title">
                                                                    <i class="fas fa-camera me-2"></i>Modificar Foto de Perfil
                                                                </h5>
                                                                <button
                                                                    type="button"
                                                                    class="btn-close btn-close-white"
                                                                    aria-label="Cerrar"
                                                                    @click="showModal = false; tempImage = currentImage; if($refs.fileInput) $refs.fileInput.value = ''"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="text-center mb-4">
                                                                    <img
                                                                        :src="tempImage"
                                                                        alt="Foto de perfil"
                                                                        class="rounded-circle border border-3 border-secondary"
                                                                        style="width: 160px; height: 160px; object-fit: cover;">
                                                                </div>

                                                                <div class="alert alert-info">
                                                                    <ul class="mb-0 small">
                                                                        <li>Recuerda subir una foto con tu <strong>rostro</strong>.</li>
                                                                        <li>El tamaño de la foto no debe superar los <strong>2 MB</strong>.</li>
                                                                        <li>Formatos permitidos: <strong>JPG, PNG, GIF</strong>.</li>
                                                                    </ul>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="btn btn-warning w-100">
                                                                        <i class="fas fa-plus me-2"></i>Seleccionar Foto
                                                                        <input
                                                                            type="file"
                                                                            name="foto_perfil"
                                                                            accept="image/*"
                                                                            class="d-none"
                                                                            x-ref="fileInput"
                                                                            @change="
                                                                                const file = $event.target.files[0];
                                                                                if (file) {
                                                                                    if (file.size > 2 * 1024 * 1024) {
                                                                                        alert('La imagen no debe superar los 2MB');
                                                                                        $refs.fileInput.value = '';
                                                                                        return;
                                                                                    }
                                                                                    if (!file.type.match('image.*')) {
                                                                                        alert('Solo se permiten archivos de imagen (JPG, PNG, GIF)');
                                                                                        $refs.fileInput.value = '';
                                                                                        return;
                                                                                    }
                                                                                    const reader = new FileReader();
                                                                                    reader.onload = (e) => {
                                                                                        tempImage = e.target.result;
                                                                                    };
                                                                                    reader.readAsDataURL(file);
                                                                                }
                                                                            "
                                                                        >
                                                                    </label>
                                                                    <p class="text-muted small text-center mt-2 mb-0">
                                                                        JPG, PNG o GIF (máx. 2MB)
                                                                    </p>
                                                                </div>

                                                                <button
                                                                    type="button"
                                                                    @click="currentImage = tempImage; showModal = false"
                                                                    class="btn btn-primary w-100">
                                                                    <i class="fas fa-save me-2"></i>Actualizar Vista Previa
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Información Personal -->
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="name" class="form-label">Nombre Completo</label>
                                                        <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label">Rol</label>
                                                        <input type="text" class="form-control" value="{{ ucfirst(Auth::user()->role) }}" disabled>
                                                        <small class="text-muted">El rol no puede ser modificado</small>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label">Estado de la Cuenta</label>
                                                        <input type="text" class="form-control" value="{{ ucfirst(Auth::user()->estado) }}" disabled>
                                                        <small class="text-muted">El estado no puede ser modificado</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Cambio de Contraseña -->
                                        <div class="row mt-4">
                                            <div class="col-12">
                                                <h6 class="text-primary mb-3"><i class="fas fa-lock me-2"></i>Cambiar Contraseña</h6>
                                                <div class="row">
                                                    <div class="col-md-4 mb-3">
                                                        <label for="current_password" class="form-label">Contraseña Actual</label>
                                                        <input type="password" class="form-control" name="current_password">
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label for="password" class="form-label">Nueva Contraseña</label>
                                                        <input type="password" class="form-control" name="password">
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                                                        <input type="password" class="form-control" name="password_confirmation">
                                                    </div>
                                                </div>
                                                <small class="text-muted">Deja los campos en blanco si no deseas cambiar tu contraseña</small>
                                            </div>
                                        </div>

                                        <div class="text-end mt-4">
                                            <button type="submit" class="btn btn-jeff">
                                                <i class="fas fa-save me-2"></i>Guardar Cambios
                                            </button>
                                        </div>
                                    </form><!-- fin form -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MENSAJES -->
            <div id="mensajes" class="section-content">
                <div class="row">
                    <!-- Lista de Conversaciones -->
                    <div class="col-md-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    <i class="fas fa-comments me-2"></i>Conversaciones
                                </h6>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalNuevoMensaje">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <div class="card-body p-0" style="max-height: 500px; overflow-y: auto;">
                                <div id="listaConversaciones">
                                    @forelse($conversaciones ?? [] as $conversacion)
                                    <div class="conversation-item p-3 border-bottom cursor-pointer" 
                                            onclick="cargarConversacion({{ $conversacion->id }})" 
                                            data-conversation-id="{{ $conversacion->id }}">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $conversacion->participante->foto_perfil ? asset('storage/' . $conversacion->participante->foto_perfil) : 'https://via.placeholder.com/40x40/28a745/ffffff?text=C' }}" 
                                                    class="rounded-circle me-3" width="40" height="40">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">{{ $conversacion->participante->name }}</h6>
                                                <p class="mb-0 text-muted small">{{ Str::limit($conversacion->ultimo_mensaje, 30) }}</p>
                                            </div>
                                            @if($conversacion->mensajes_no_leidos > 0)
                                            <span class="badge bg-danger">{{ $conversacion->mensajes_no_leidos }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    @empty
                                    <div class="text-center p-4">
                                        <i class="fas fa-inbox text-muted fa-3x mb-3"></i>
                                        <p class="text-muted">No hay conversaciones</p>
                                    </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Chat Area -->
                    <div class="col-md-8">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3" id="chatHeader">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    <i class="fas fa-comment-dots me-2"></i>Selecciona una conversación
                                </h6>
                            </div>
                            <div class="card-body p-0">
                                <div id="chatMessages" style="height: 400px; overflow-y: auto; padding: 20px;">
                                    <div class="text-center text-muted">
                                        <i class="fas fa-comments fa-3x mb-3"></i>
                                        <p>Selecciona una conversación para comenzar a chatear</p>
                                    </div>
                                </div>
                                <div class="border-top p-3" id="chatInput" style="display: none;">
                                    <form id="enviarMensajeForm">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="nuevoMensaje" placeholder="Escribe tu mensaje..." required>
                                            <input type="hidden" id="conversacionId">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fas fa-paper-plane"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>      
        </div>
    </div> 
</div> 

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush
@push('scripts')
<script src="{{ asset('js/admin.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<!-- SCRIPT DE SELECCIÓN (FUNCIONA Y SE QUEDA MARCADO) -->
<script>
function selectSection(id, element) {

    document.getElementById("tipoReporte").value = id;

    // Desmarcar todo
    document.querySelectorAll(".section-option").forEach(card => {
        card.style.borderColor = "#d1d5db";
        card.style.background = "#ffffff";

        let iconCircle = card.querySelector(".section-icon");
        iconCircle.style.background = "#dcfce7";

        let icon = card.querySelector("i");
        icon.style.color = "#16a34a";
    });

    // Marcar seleccionado (verde)
    element.style.borderColor = "#16a34a";
    element.style.background = "#ecfdf5";

    let iconCircle = element.querySelector(".section-icon");
    iconCircle.style.background = "#bbf7d0";

    let icon = element.querySelector("i");
    icon.style.color = "#065f46";
}

function submitForm(type) {
    if (!document.getElementById("tipoReporte").value) {
        document.getElementById("errorSeccion").style.display = "block";
        return;
    }
    document.getElementById("formatoInput").value = type;
    document.getElementById("formReporte").submit();
}

</script>


<script>
document.addEventListener('DOMContentLoaded', function() {
    // Datos pasados desde Laravel - con valores por defecto
    const rolesDistribution = @json($distribucionUsuarios ?? []);
    const planDistribution = @json($distribucionPlanes ?? []);
    const disciplineDistribution = @json($distribucionDisciplinas ?? []);
    
    // Colores para las gráficas
    const colors = {
        roles: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b'],
        status: ['#1cc88a', '#f6c23e'],
        plans: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'],
        disciplines: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#6f42c1']
    };

    // Función para formatear labels de roles
    function formatRoleLabel(role) {
        const roleLabels = {
            'admin': 'Administrador',
            'player': 'Jugador',
            'coach': 'Entrenador'
        };
        return roleLabels[role] || role;
    }

    // 1. Gráfica de Distribución de Roles
    if (Object.keys(rolesDistribution).length > 0) {
        const rolesChart = new Chart(document.getElementById('rolesChart'), {
            type: 'doughnut',
            data: {
                labels: Object.keys(rolesDistribution).map(formatRoleLabel),
                datasets: [{
                    data: Object.values(rolesDistribution),
                    backgroundColor: colors.roles,
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true
                        }
                    }
                }
            }
        });
    } else {
        document.getElementById('rolesChart').parentElement.innerHTML = 
            '<div class="no-chart-data"><i class="fas fa-chart-pie"></i><p>No hay datos de usuarios</p></div>';
    }

    // 2. Gráfica de Estado de Usuarios
    const statusChart = new Chart(document.getElementById('statusChart'), {
        type: 'pie',
        data: {
            labels: ['Activos', 'Inactivos'],
            datasets: [{
                data: [{{ $usuariosActivos ?? 0 }}, {{ $usuariosInactivos ?? 0 }}],
                backgroundColor: colors.status,
                borderWidth: 3,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                }
            }
        }
    });

    // 3. Gráfica de Planes Activos
    if (Object.keys(planDistribution).length > 0) {
        const plansChart = new Chart(document.getElementById('plansChart'), {
            type: 'bar',
            data: {
                labels: Object.keys(planDistribution),
                datasets: [{
                    label: 'Suscripciones Activas',
                    data: Object.values(planDistribution),
                    backgroundColor: '#4e73df',
                    borderColor: '#2e59d9',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    } else {
        document.getElementById('plansChart').parentElement.innerHTML = 
            '<div class="no-chart-data"><i class="fas fa-chart-bar"></i><p>No hay suscripciones activas</p></div>';
    }

    // 4. Gráfica de Disciplinas Populares
    if (Object.keys(disciplineDistribution).length > 0) {
        const disciplinesChart = new Chart(document.getElementById('disciplinesChart'), {
            type: 'polarArea',
            data: {
                labels: Object.keys(disciplineDistribution),
                datasets: [{
                    data: Object.values(disciplineDistribution),
                    backgroundColor: colors.disciplines,
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            padding: 15,
                            usePointStyle: true
                        }
                    }
                }
            }
        });
    } else {
        document.getElementById('disciplinesChart').parentElement.innerHTML = 
            '<div class="no-chart-data"><i class="fas fa-chart-pie"></i><p>No hay datos de disciplinas</p></div>';
    }
});
</script>



@endpush
@endsection