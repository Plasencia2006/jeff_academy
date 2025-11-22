<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Datos - Jeff Academy</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --verde-oscuro: #0d3b2e;
            --verde-medio: #1a5c3a;
            --verde-mendio: #2e7d32;
            --verde-claro: #4caf50;
            --verde-brillante: #5FDB68;
            --amarillo-brillante: #FFD700;
            --amarillo-hover: #FFC700;
            --negro: #000000;
            --negro-suave: #1a1a1a;
            --blanco: #ffffff;
            --primary-blue: var(--verde-oscuro);
            --dark-blue: var(--verde-medio);
            --light-blue: var(--verde-claro);
            --primary-red: var(--amarillo-brillante);
            --gold: var(--amarillo-brillante);
            --primary-white: #ffffff;
            --gray-light: #f8fafc;
            --gray-dark: #1f2937;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --gris-light: var(--gray-light);
            --gris-dark: var(--gray-dark);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, var(--verde-oscuro) 0%, var(--verde-medio) 50%, var(--verde-mendio) 100%);
            padding: 40px 20px;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 25px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            transition: var(--transition);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateX(-5px);
        }

        .user-welcome {
            color: white;
            font-size: 1.2rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .main-content {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 30px;
        }

        .datos-card {
            background: white;
            border-radius: 24px;
            box-shadow: var(--shadow);
            padding: 40px;
            animation: fadeInUp 0.6s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .datos-title {
            color: var(--verde-oscuro);
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .datos-title i {
            background: linear-gradient(135deg, var(--verde-medio) 0%, var(--verde-claro) 100%);
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .datos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .dato-item {
            padding: 20px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 12px;
            border-left: 4px solid var(--verde-claro);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .dato-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(76, 175, 80, 0.1) 0%, rgba(46, 125, 50, 0.1) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .dato-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(46, 125, 50, 0.2);
        }

        .dato-item:hover::before {
            opacity: 1;
        }

        .dato-label {
            font-size: 0.85rem;
            color: #6c757d;
            font-weight: 700;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 8px;
            position: relative;
        }

        .dato-label i {
            color: var(--verde-claro);
            font-size: 1rem;
        }

        .dato-value {
            font-size: 1.1rem;
            color: #212529;
            font-weight: 600;
            position: relative;
        }

        /* Sidebar */
        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .profile-card {
            background: white;
            border-radius: 24px;
            padding: 30px;
            text-align: center;
            box-shadow: var(--shadow);
            animation: fadeInRight 0.6s ease;
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, var(--verde-medio) 0%, var(--verde-claro) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: white;
            font-weight: bold;
            box-shadow: 0 10px 30px rgba(46, 125, 50, 0.4);
        }

        .profile-name {
            font-size: 1.3rem;
            font-weight: 700;
            color: #212529;
            margin-bottom: 5px;
        }

        .profile-email {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 20px;
        }

        .profile-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px solid #e9ecef;
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--verde-claro);
            display: block;
        }

        .stat-label {
            font-size: 0.75rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 5px;
        }

        /* Action Buttons */
        .action-buttons {
            background: white;
            border-radius: 24px;
            padding: 25px;
            box-shadow: var(--shadow);
            animation: fadeInRight 0.7s ease;
        }

        .action-buttons-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--verde-oscuro);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .action-buttons-title i {
            color: var(--verde-claro);
        }

        .btn-action {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 14px 20px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            margin-bottom: 12px;
        }

        .btn-action:last-child {
            margin-bottom: 0;
        }

        .btn-logout {
            background: linear-gradient(135deg, var(--amarillo-brillante) 0%, var(--amarillo-hover) 100%);
            color: var(--negro-suave);
        }

        .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 215, 0, 0.4);
        }

        .btn-delete {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
        }

        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(220, 53, 69, 0.4);
        }

        /* Plan Card */
        .plan-card {
            background: white;
            border-radius: 24px;
            padding: 30px;
            box-shadow: var(--shadow);
            animation: fadeInRight 0.8s ease;
        }

        .plan-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .plan-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--amarillo-brillante) 0%, var(--amarillo-hover) 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--negro-suave);
            font-size: 1.5rem;
        }

        .plan-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #212529;
        }

        .plan-active {
            background: linear-gradient(135deg, var(--verde-medio) 0%, var(--verde-claro) 100%);
            color: white;
            padding: 25px;
            border-radius: 16px;
            margin-bottom: 15px;
        }

        .plan-name {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .plan-name i {
            font-size: 1.2rem;
        }

        .plan-price {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 5px;
        }

        .plan-duration {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .plan-btn {
            display: block;
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, var(--amarillo-brillante) 0%, var(--amarillo-hover) 100%);
            color: var(--negro-suave);
            text-align: center;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            transition: var(--transition);
            margin-top: 15px;
        }

        .plan-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(255, 215, 0, 0.4);
        }

        .no-plan {
            text-align: center;
            padding: 30px 20px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 16px;
            border: 2px dashed #dee2e6;
        }

        .no-plan i {
            font-size: 3rem;
            color: #adb5bd;
            margin-bottom: 15px;
            display: block;
        }

        .no-plan-text {
            color: #6c757d;
            margin-bottom: 20px;
            font-size: 0.95rem;
        }

        .choose-plan-btn {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, var(--verde-medio) 0%, var(--verde-claro) 100%);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            transition: var(--transition);
        }

        .choose-plan-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(46, 125, 50, 0.4);
        }

        /* Modal de confirmación */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            animation: fadeIn 0.3s ease;
        }

        .modal-overlay.active {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            padding: 35px;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            animation: slideUp 0.3s ease;
        }

        @keyframes slideUp {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .modal-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .modal-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #212529;
            margin-bottom: 10px;
        }

        .modal-body {
            color: #6c757d;
            font-size: 1rem;
            margin-bottom: 25px;
            line-height: 1.6;
            text-align: center;
        }

        .modal-body strong {
            color: #dc3545;
        }

        .confirmation-box {
            background: #f8f9fa;
            border: 2px solid #dee2e6;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .confirmation-label {
            font-size: 0.9rem;
            color: #495057;
            margin-bottom: 10px;
            text-align: center;
            font-weight: 600;
        }

        .confirmation-input {
            width: 100%;
            padding: 12px;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            font-size: 1rem;
            text-align: center;
            transition: var(--transition);
        }

        .confirmation-input:focus {
            outline: none;
            border-color: #dc3545;
        }

        .modal-actions {
            display: flex;
            gap: 10px;
        }

        .btn-modal {
            flex: 1;
            padding: 14px 20px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-cancel {
            background: #e9ecef;
            color: #495057;
        }

        .btn-cancel:hover {
            background: #dee2e6;
        }

        .btn-confirm {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
        }

        .btn-confirm:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(220, 53, 69, 0.4);
        }

        .btn-confirm:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .main-content {
                grid-template-columns: 1fr;
            }

            .sidebar {
                order: -1;
            }

            .datos-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 20px 10px;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .user-welcome {
                font-size: 1rem;
            }

            .datos-card, .profile-card, .plan-card, .action-buttons {
                padding: 25px;
            }

            .datos-title {
                font-size: 1.5rem;
            }

            .datos-grid {
                grid-template-columns: 1fr;
            }

            .profile-avatar {
                width: 100px;
                height: 100px;
                font-size: 2.5rem;
            }

            .modal-content {
                padding: 25px;
            }
        }

        @media (max-width: 480px) {
            .back-btn {
                padding: 10px 15px;
                font-size: 0.9rem;
            }

            .user-welcome {
                font-size: 0.9rem;
            }

            .datos-title {
                font-size: 1.3rem;
                flex-direction: column;
                text-align: center;
            }

            .modal-actions {
                flex-direction: column;
            }

            .btn-modal {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="{{ route('platform') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Volver al Dashboard
            </a>
            <div class="user-welcome">
                <i class="fas fa-user-circle"></i>
                Bienvenido, {{ $registro->nombres }}
            </div>
        </div>

        <div class="main-content">
            <!-- Datos Personales -->
            <div class="datos-card">
                <h1 class="datos-title">
                    <i class="fas fa-id-card"></i>
                    Mis Datos Personales
                </h1>
                
                <div class="datos-grid">
                    <div class="dato-item">
                        <div class="dato-label">
                            <i class="fas fa-id-badge"></i>
                            Tipo de Documento
                        </div>
                        <div class="dato-value">{{ $registro->tipo_documento }}</div>
                    </div>
                    
                    <div class="dato-item">
                        <div class="dato-label">
                            <i class="fas fa-hashtag"></i>
                            Nro. de Documento
                        </div>
                        <div class="dato-value">{{ $registro->nro_documento }}</div>
                    </div>
                    
                    <div class="dato-item">
                        <div class="dato-label">
                            <i class="fas fa-venus-mars"></i>
                            Género
                        </div>
                        <div class="dato-value">{{ $registro->genero }}</div>
                    </div>
                    
                    <div class="dato-item">
                        <div class="dato-label">
                            <i class="fas fa-user"></i>
                            Nombres
                        </div>
                        <div class="dato-value">{{ $registro->nombres }}</div>
                    </div>
                    
                    <div class="dato-item">
                        <div class="dato-label">
                            <i class="fas fa-user-tag"></i>
                            Apellido Paterno
                        </div>
                        <div class="dato-value">{{ $registro->apellido_paterno }}</div>
                    </div>
                    
                    <div class="dato-item">
                        <div class="dato-label">
                            <i class="fas fa-user-tag"></i>
                            Apellido Materno
                        </div>
                        <div class="dato-value">{{ $registro->apellido_materno }}</div>
                    </div>
                    
                    <div class="dato-item">
                        <div class="dato-label">
                            <i class="fas fa-calendar-alt"></i>
                            Fecha de Nacimiento
                        </div>
                        <div class="dato-value">{{ \Carbon\Carbon::parse($registro->fecha_nacimiento)->format('d/m/Y') }}</div>
                    </div>
                    
                    <div class="dato-item">
                        <div class="dato-label">
                            <i class="fas fa-mobile-alt"></i>
                            Nro. de Celular
                        </div>
                        <div class="dato-value">{{ $registro->nro_celular }}</div>
                    </div>
                    
                    <div class="dato-item">
                        <div class="dato-label">
                            <i class="fas fa-envelope"></i>
                            Email
                        </div>
                        <div class="dato-value">{{ $registro->email }}</div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Profile Card -->
                <div class="profile-card">
                    <div class="profile-avatar">
                        {{ strtoupper(substr($registro->nombres, 0, 1)) }}{{ strtoupper(substr($registro->apellido_paterno, 0, 1)) }}
                    </div>
                    <div class="profile-name">
                        {{ $registro->nombres }} {{ $registro->apellido_paterno }}
                    </div>
                    <div class="profile-email">
                        {{ $registro->email }}
                    </div>

                    <div class="profile-stats">
                        <div class="stat-item">
                            <span class="stat-value">
                                <i class="fas fa-check-circle"></i>
                            </span>
                            <span class="stat-label">Activo</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">{{ \Carbon\Carbon::parse($registro->created_at)->format('Y') }}</span>
                            <span class="stat-label">Miembro desde</span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <div class="action-buttons-title">
                        <i class="fas fa-cog"></i>
                        Acciones de Cuenta
                    </div>
                    
                    <form action="{{ route('registro.logout') }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" class="btn-action btn-logout">
                            <i class="fas fa-sign-out-alt"></i>
                            Cerrar Sesión
                        </button>
                    </form>
                </div>

                <!-- Plan Card -->
                <div class="plan-card">
                    <div class="plan-header">
                        <div class="plan-icon">
                            <i class="fas fa-crown"></i>
                        </div>
                        <div class="plan-title">Mi Plan</div>
                    </div>

                    @if($registro->plan_id && $registro->plan)
                        <div class="plan-active">
                            <div class="plan-name">
                                <i class="fas fa-star"></i>
                                {{ $registro->plan->nombre }}
                            </div>
                            <div class="plan-price">
                                <i class="fas fa-dollar-sign"></i>
                                ${{ number_format($registro->plan->precio, 2) }} / {{ $registro->plan->duracion }} meses
                            </div>
                            @if($registro->plan->descripcion)
                            <div class="plan-duration">
                                {{ $registro->plan->descripcion }}
                            </div>
                            @endif
                        </div>
                        
                        <a href="{{ route('registro.mis-planes') }}" class="plan-btn">
                            <i class="fas fa-list-alt"></i>
                            Ver Detalles del Plan
                        </a>
                    @else
                        <div class="no-plan">
                            <i class="fas fa-inbox"></i>
                            <p class="no-plan-text">
                                Aún no tienes un plan activo.<br>
                                ¡Elige el mejor plan para ti!
                            </p>
                            <a href="{{ route('registro.elegir-plan') }}" class="choose-plan-btn">
                                <i class="fas fa-shopping-cart"></i>
                                Elegir Plan
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        const confirmText = document.getElementById('confirmText');
        const confirmBtn = document.getElementById('confirmBtn');
        const deleteForm = document.getElementById('deleteForm');

        // Validar texto de confirmación
        confirmText.addEventListener('input', function() {
            if (this.value === 'ELIMINAR MI CUENTA') {
                confirmBtn.disabled = false;
                confirmBtn.style.opacity = '1';
            } else {
                confirmBtn.disabled = true;
                confirmBtn.style.opacity = '0.5';
            }
        });

        function openDeleteModal() {
            document.getElementById('deleteModal').classList.add('active');
            confirmText.value = '';
            confirmBtn.disabled = true;
            confirmBtn.style.opacity = '0.5';
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('active');
            confirmText.value = '';
        }

        // Cerrar modal al hacer clic fuera
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });

        // Cerrar modal con tecla ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDeleteModal();
            }
        });
    </script>
</body>
</html>
