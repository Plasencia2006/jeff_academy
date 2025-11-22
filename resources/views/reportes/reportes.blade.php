
<div id="reportes" class="section-content">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Generar Reportes</h1>
        <p class="text-gray-600">Selecciona qué reporte quieres descargar</p>
    </div>

    <!-- Mensajes -->
    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
    @endif

    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('admin.reportes.generar') }}">
            @csrf

            <!-- Selección de Reporte -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-3">Tipo de Reporte</label>
                <div class="grid grid-cols-2 gap-3">
                    <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                        <input type="radio" name="tipo_reporte" value="usuarios" class="mr-3">
                        <div>
                            <i class="fas fa-users text-blue-500 mr-2"></i>
                            <span>Usuarios</span>
                        </div>
                    </label>

                    <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                        <input type="radio" name="tipo_reporte" value="noticias" class="mr-3">
                        <div>
                            <i class="fas fa-newspaper text-yellow-500 mr-2"></i>
                            <span>Noticias</span>
                        </div>
                    </label>

                    <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                        <input type="radio" name="tipo_reporte" value="planes" class="mr-3">
                        <div>
                            <i class="fas fa-credit-card text-red-500 mr-2"></i>
                            <span>Planes</span>
                        </div>
                    </label>

                    <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                        <input type="radio" name="tipo_reporte" value="disciplinas" class="mr-3">
                        <div>
                            <i class="fas fa-futbol text-green-500 mr-2"></i>
                            <span>Disciplinas</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Botones de Descarga -->
            <div class="flex gap-3">
                <button type="submit" name="formato" value="pdf" 
                        class="flex-1 bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded flex items-center justify-center">
                    <i class="fas fa-file-pdf mr-2"></i>Descargar PDF
                </button>
                
                <button type="submit" name="formato" value="excel" 
                        class="flex-1 bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded flex items-center justify-center">
                    <i class="fas fa-file-excel mr-2"></i>Descargar Excel
                </button>
            </div>
        </form>
    </div>

    <!-- Información Simple -->
    <div class="mt-6 text-center text-sm text-gray-500">
        <p>Los reportes se generan con los datos actuales del sistema</p>
    </div>
</div>

<script>
// Selección visual de radio buttons
document.querySelectorAll('input[type="radio"]').forEach(radio => {
    radio.addEventListener('change', function() {
        // Remover todas las selecciones
        document.querySelectorAll('label').forEach(label => {
            label.classList.remove('border-blue-500', 'bg-blue-50');
        });
        
        // Marcar el seleccionado
        if (this.checked) {
            this.closest('label').classList.add('border-blue-500', 'bg-blue-50');
        }
    });
});

// Validación básica
document.querySelector('form').addEventListener('submit', function(e) {
    const radioSelected = document.querySelector('input[type="radio"]:checked');
    
    if (!radioSelected) {
        e.preventDefault();
        alert('Por favor, selecciona un tipo de reporte');
        return;
    }
    
    // Mostrar loading
    const buttons = document.querySelectorAll('button[type="submit"]');
    buttons.forEach(btn => {
        btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Generando...';
        btn.disabled = true;
    });
});
</script>

<style>
label {
    transition: all 0.2s ease;
}
</style>