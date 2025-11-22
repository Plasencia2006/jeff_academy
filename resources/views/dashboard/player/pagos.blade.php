<!-- Pagos del Jugador -->
<div class="space-y-6">
    <!-- Título de la sección -->
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-gray-900">
            <i class="fas fa-credit-card text-blue-600 mr-3"></i>
            Estado de Pagos
        </h1>
        <div class="flex items-center space-x-3">
            @if($estadoPagos === 'al_dia')
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                    <i class="fas fa-check-circle mr-1"></i>
                    Al día
                </span>
            @elseif($estadoPagos === 'proximo_vencimiento')
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                    <i class="fas fa-exclamation-triangle mr-1"></i>
                    Próximo a vencer
                </span>
            @elseif($estadoPagos === 'vencido')
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                    <i class="fas fa-times-circle mr-1"></i>
                    Vencido
                </span>
            @else
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                    <i class="fas fa-info-circle mr-1"></i>
                    Sin suscripción
                </span>
            @endif
        </div>
    </div>

    <!-- Resumen de pagos -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 rounded-lg">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Pagos Realizados</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $pagosRealizados }}</p>
                    <p class="text-xs text-gray-500">Total</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="p-3 bg-yellow-100 rounded-lg">
                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Pagos Pendientes</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $pagosPendientes }}</p>
                    <p class="text-xs text-gray-500">Por vencer</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="p-3 bg-blue-100 rounded-lg">
                    <i class="fas fa-coins text-blue-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Total Pagado</p>
                    <p class="text-2xl font-bold text-gray-900">S/ {{ number_format($totalPagado, 2) }}</p>
                    <p class="text-xs text-gray-500">Total</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="p-3 bg-purple-100 rounded-lg">
                    <i class="fas fa-calendar-alt text-purple-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Próximo Pago</p>
                    <p class="text-2xl font-bold text-gray-900">
                        @if($proximoPago)
                            {{ $proximoPago->end_date->format('d/m') }}
                        @else
                            --/--
                        @endif
                    </p>
                    <p class="text-xs text-gray-500">Fecha límite</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Estado actual -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                Estado Actual de Pagos
            </h3>
        </div>
        <div class="p-6">
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                </div>
                <div class="flex-1">
                    <h4 class="text-lg font-medium text-gray-900 mb-2">Cuenta al Día</h4>
                    <p class="text-gray-600 mb-4">
                        Actualmente no tienes pagos pendientes. Tu cuenta está al día y puedes continuar 
                        participando en todos los entrenamientos y actividades.
                    </p>
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <i class="fas fa-lightbulb text-green-600 mr-2"></i>
                            <p class="text-sm text-green-800">
                                <strong>Tip:</strong> Mantén tus pagos al día para no interrumpir tu entrenamiento.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Historial de pagos -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                <i class="fas fa-history text-purple-600 mr-2"></i>
                Historial de Pagos
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Concepto</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Monto</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Método</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Recibo</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Placeholder para cuando no hay pagos -->
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            <i class="fas fa-receipt text-4xl mb-4 text-gray-300"></i>
                            <p class="text-lg font-medium text-gray-900 mb-2">No hay historial de pagos</p>
                            <p class="text-sm">Los pagos realizados aparecerán aquí cuando se registren.</p>
                        </td>
                    </tr>
                    
                    <!-- Ejemplo de cómo se verían los pagos (comentado para referencia futura)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            15/10/2024
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            Mensualidad Octubre
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            S/ 150.00
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            Transferencia
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check mr-1"></i>Pagado
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <button class="text-blue-600 hover:text-blue-900">
                                <i class="fas fa-download mr-1"></i>Descargar
                            </button>
                        </td>
                    </tr>
                    -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Métodos de pago disponibles -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                <i class="fas fa-credit-card text-green-600 mr-2"></i>
                Métodos de Pago Disponibles
            </h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Transferencia bancaria -->
                <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-300 transition-colors">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-university text-blue-600"></i>
                        </div>
                        <h4 class="font-medium text-gray-900">Transferencia Bancaria</h4>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">
                        Transfiere directamente a nuestra cuenta bancaria.
                    </p>
                    <div class="text-xs text-gray-500">
                        <p><strong>Banco:</strong> BCP</p>
                        <p><strong>Cuenta:</strong> 123-456789-0-12</p>
                        <p><strong>CCI:</strong> 002-123-456789012345</p>
                    </div>
                </div>
                
                <!-- Pago en efectivo -->
                <div class="border border-gray-200 rounded-lg p-4 hover:border-green-300 transition-colors">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-money-bill-wave text-green-600"></i>
                        </div>
                        <h4 class="font-medium text-gray-900">Pago en Efectivo</h4>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">
                        Paga directamente en nuestras instalaciones.
                    </p>
                    <div class="text-xs text-gray-500">
                        <p><strong>Horario:</strong> Lun-Vie 8:00-18:00</p>
                        <p><strong>Sábados:</strong> 8:00-14:00</p>
                        <p><strong>Ubicación:</strong> Recepción principal</p>
                    </div>
                </div>
                
                <!-- Pago móvil -->
                <div class="border border-gray-200 rounded-lg p-4 hover:border-purple-300 transition-colors">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-mobile-alt text-purple-600"></i>
                        </div>
                        <h4 class="font-medium text-gray-900">Pago Móvil</h4>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">
                        Usa aplicaciones de pago móvil.
                    </p>
                    <div class="text-xs text-gray-500">
                        <p><strong>Yape:</strong> 987-654-321</p>
                        <p><strong>Plin:</strong> 987-654-321</p>
                        <p><strong>Tunki:</strong> Disponible</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Información importante -->
    <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <i class="fas fa-info-circle text-blue-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-medium text-blue-900 mb-2">Información Importante sobre Pagos</h3>
                <ul class="text-sm text-blue-800 space-y-1">
                    <li>• Los pagos deben realizarse una semana antes.</li>
                    <li>• Conserva siempre el comprobante de pago para cualquier consulta.</li>
                    <li>• En caso de retraso, comunícate con administración.</li>
                    <li>• Los pagos parciales deben ser coordinados previamente.</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Contacto para consultas -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                <i class="fas fa-headset text-orange-600 mr-2"></i>
                ¿Tienes dudas sobre tus pagos?
            </h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-phone text-orange-600"></i>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-900">Teléfono</h4>
                        <p class="text-gray-600">(01) 234-5678</p>
                        <p class="text-xs text-gray-500">Lun-Vie 8:00-18:00</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-envelope text-blue-600"></i>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-900">Email</h4>
                        <p class="text-gray-600">pagos@jeffacademy.com</p>
                        <p class="text-xs text-gray-500">Respuesta en 24h</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>