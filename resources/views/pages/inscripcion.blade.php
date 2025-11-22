@extends('layouts.app')

@section('title', 'Formulario de Inscripción - Jeff Academy')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl w-full space-y-8 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 py-12 px-8 text-center">
            <h1 class="text-3xl font-bold text-white mb-2">Formulario de Inscripción</h1>
            <p class="text-blue-100 text-lg">Completa tus datos para unirte a Jeff Academy</p>
        </div>
        
        <!-- Form Content -->
        <div class="px-8 py-10" x-data="{ showModal: false }">
            <form action="{{ route('registro.store') }}" method="POST" class="space-y-8">
                @csrf
                
                <!-- Datos Personales -->
                <div>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-user text-blue-600 mr-3"></i>
                        Datos Personales
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-2">
                            <label for="tipo_documento" class="block text-sm font-medium text-gray-700">Tipo de Documento <span class="text-red-500">*</span></label>
                            <select name="tipo_documento" id="tipo_documento" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('tipo_documento') border-red-500 @enderror" required>
                                <option value="">Seleccionar</option>
                                <option value="DNI" {{ old('tipo_documento') == 'DNI' ? 'selected' : '' }}>DNI</option>
                            </select>
                            @error('tipo_documento')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="space-y-2">
                            <label for="nro_documento" class="block text-sm font-medium text-gray-700">Número de Documento <span class="text-red-500">*</span></label>
                            <input type="text" name="nro_documento" id="nro_documento" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nro_documento') border-red-500 @enderror" value="{{ old('nro_documento') }}" placeholder="Ingrese su DNI" required maxlength="8">
                            <div id="dni-loader" class="hidden text-sm text-blue-600 mt-1 flex items-center gap-2">
                                <i class="fas fa-spinner fa-spin"></i> Buscando en RENIEC...
                            </div>
                            @error('nro_documento')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="space-y-2">
                            <label for="genero" class="block text-sm font-medium text-gray-700">Género <span class="text-red-500">*</span></label>
                            <select name="genero" id="genero" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('genero') border-red-500 @enderror" required>
                                <option value="">Seleccionar</option>
                                <option value="Masculino" {{ old('genero') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="Femenino" {{ old('genero') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                            </select>
                            @error('genero')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="space-y-2">
                            <label for="nombres" class="block text-sm font-medium text-gray-700">Nombres <span class="text-red-500">*</span></label>
                            <input type="text" name="nombres" id="nombres" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nombres') border-red-500 @enderror" value="{{ old('nombres') }}" placeholder="Ingrese sus nombres" required>
                            @error('nombres')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="space-y-2">
                            <label for="apellido_paterno" class="block text-sm font-medium text-gray-700">Apellido Paterno <span class="text-red-500">*</span></label>
                            <input type="text" name="apellido_paterno" id="apellido_paterno" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('apellido_paterno') border-red-500 @enderror" value="{{ old('apellido_paterno') }}" placeholder="Apellido paterno" required>
                            @error('apellido_paterno')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="space-y-2">
                            <label for="apellido_materno" class="block text-sm font-medium text-gray-700">Apellido Materno <span class="text-red-500">*</span></label>
                            <input type="text" name="apellido_materno" id="apellido_materno" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('apellido_materno') border-red-500 @enderror" value="{{ old('apellido_materno') }}" placeholder="Apellido materno" required>
                            @error('apellido_materno')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="space-y-2">
                            <label for="fecha_nacimiento" class="block text-sm font-medium text-gray-700">Fecha de Nacimiento <span class="text-red-500">*</span></label>
                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('fecha_nacimiento') border-red-500 @enderror" value="{{ old('fecha_nacimiento') }}" required>
                            @error('fecha_nacimiento')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="space-y-2">
                            <label for="nro_celular" class="block text-sm font-medium text-gray-700">Número de Celular <span class="text-red-500">*</span></label>
                            <input type="tel" name="nro_celular" id="nro_celular" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nro_celular') border-red-500 @enderror" value="{{ old('nro_celular') }}" placeholder="999 999 999" required maxlength="9">
                            @error('nro_celular')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico <span class="text-red-500">*</span></label>
                            <input type="email" name="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror" value="{{ old('email') }}" placeholder="ejemplo@correo.com" required>
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-medium text-gray-700">Contraseña <span class="text-red-500">*</span></label>
                            <input type="password" name="password" id="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror" placeholder="Mínimo 8 caracteres" required>
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="space-y-2">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Contraseña <span class="text-red-500">*</span></label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Repita su contraseña" required>
                        </div>
                    </div>
                </div>
                
                <!-- Términos -->
                <div class="bg-green-50 border border-green-200 rounded-xl p-6 space-y-4">
                    <div class="flex items-start gap-3">
                        <input type="checkbox" name="terminos" id="terminos" class="h-5 w-5 mt-1 text-blue-600 border-gray-300 rounded focus:ring-blue-500 @error('terminos') border-red-500 @enderror" required>
                        <label for="terminos" class="text-sm text-gray-700">
                            He leído y acepto los <a href="#" class="text-blue-600 hover:underline font-medium">términos y condiciones</a> de uso de la plataforma. <span class="text-red-500">*</span>
                        </label>
                    </div>
                    <p class="text-sm text-gray-600 pl-8">
                        Al aceptar, confirmo que la información proporcionada es verídica y autorizo el tratamiento de mis datos personales conforme a las políticas de privacidad de Jeff Academy.
                    </p>
                    @error('terminos')
                        <p class="text-red-500 text-sm mt-1 pl-8">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Acciones -->
                <div class="flex flex-col items-center space-y-4">
                    <button type="submit" class="w-full md:w-auto px-8 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-colors flex items-center justify-center gap-2">
                        <span>Completar Inscripción</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                    
                    <p class="text-sm text-gray-600">
                        ¿Ya tienes una cuenta? <a href="#" @click.prevent="showModal = true" class="text-blue-600 hover:underline font-medium">Inicia sesión aquí</a>
                    </p>
                </div>
            </form>
            
            <!-- Modal de Login -->
            <div x-show="showModal" 
                 x-transition
                 class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center bg-black bg-opacity-50"
                 @click.away="showModal = false">
                <div class="bg-white rounded-2xl shadow-xl max-w-md w-full mx-4 p-8" @click.stop>
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">Iniciar Sesión</h2>
                        <button @click="showModal = false" class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    
                    <p class="text-gray-600 mb-8">Ingresa tus credenciales para acceder a tu cuenta</p>
                    
                    <form action="{{ route('registro.login') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div class="space-y-2">
                            <label for="login_email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                            <input type="email" name="email" id="login_email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="ejemplo@correo.com" required>
                        </div>
                        
                        <div class="space-y-2">
                            <label for="login_password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                            <input type="password" name="password" id="login_password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Ingrese su contraseña" required>
                        </div>
                        
                        <button type="submit" class="w-full px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-colors flex items-center justify-center gap-2">
                            <span>Ingresar</span>
                            <i class="fas fa-sign-in-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const dniInput = document.getElementById('nro_documento');
    const nombres = document.getElementById('nombres');
    const apePat = document.getElementById('apellido_paterno');
    const apeMat = document.getElementById('apellido_materno');
    const fechaNac = document.getElementById('fecha_nacimiento');
    const loader = document.getElementById('dni-loader');

    // Solo números en DNI
    dniInput.addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    dniInput.addEventListener('keyup', async function () {
        let dni = dniInput.value;

        if (dni.length === 8) {
            loader.classList.remove('hidden');
            loader.classList.add('text-blue-600');
            loader.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Buscando en RENIEC...';

            try {
                const response = await fetch(`/buscar-dni/${dni}`);
                const data = await response.json();

                if (!data.error) {
                    nombres.value = data.nombres || '';
                    apePat.value = data.apellido_paterno || '';
                    apeMat.value = data.apellido_materno || '';

                    if (data.fecha_nacimiento) {
                        let fechaFormateada = data.fecha_nacimiento;
                        if (data.fecha_nacimiento.includes('/')) {
                            const partes = data.fecha_nacimiento.split('/');
                            if (partes.length === 3) {
                                fechaFormateada = `${partes[2]}-${partes[1].padStart(2, '0')}-${partes[0].padStart(2, '0')}`;
                            }
                        }
                        fechaNac.value = fechaFormateada;
                    }

                    loader.classList.remove('text-blue-600');
                    loader.classList.add('text-green-600');
                    loader.innerHTML = '<i class="fas fa-check-circle mr-2"></i> Datos encontrados correctamente';
                    
                    setTimeout(() => {
                        loader.classList.add('hidden');
                    }, 3000);
                } else {
                    loader.classList.remove('text-blue-600');
                    loader.classList.add('text-red-600');
                    loader.innerHTML = '<i class="fas fa-exclamation-circle mr-2"></i> DNI no encontrado en RENIEC';
                }
            } catch (error) {
                loader.classList.remove('text-blue-600');
                loader.classList.add('text-red-600');
                loader.innerHTML = '<i class="fas fa-exclamation-circle mr-2"></i> Error al conectar con el servidor';
            }
        } else {
            loader.classList.add('hidden');
        }
    });

    // Solo números en celular
    const celularInput = document.getElementById('nro_celular');
    if (celularInput) {
        celularInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    }
});
</script>
@endpush