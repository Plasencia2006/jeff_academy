<!-- COMUNICADOS - Sistema de Mensajería Admin-Coach -->
<div class="container-fluid">
    <div class="row">
        <!-- Lista de Conversaciones -->
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-comments me-2"></i>Mensajes del Administrador
                    </h6>
                </div>
                <div class="card-body p-0" style="max-height: 500px; overflow-y: auto;">
                    <div id="listaConversacionesCoach">
                        <!-- Las conversaciones se cargarán aquí dinámicamente -->
                        <div class="text-center p-4">
                            <i class="fas fa-spinner fa-spin text-muted fa-2x mb-3"></i>
                            <p class="text-muted">Cargando conversaciones...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Área de Chat -->
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3" id="chatHeaderCoach">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-comment-dots me-2"></i>Selecciona una conversación
                    </h6>
                </div>
                <div class="card-body p-0">
                    <div id="chatMessagesCoach" style="height: 400px; overflow-y: auto; padding: 20px;">
                        <div class="text-center text-muted">
                            <i class="fas fa-comments fa-3x mb-3"></i>
                            <p>Selecciona una conversación para ver los mensajes</p>
                        </div>
                    </div>
                    <div class="border-top p-3" id="chatInputCoach" style="display: none;">
                        <form id="enviarMensajeCoachForm">
                            <div class="input-group">
                                <input type="text" class="form-control" id="nuevoMensajeCoach" placeholder="Escribe tu respuesta..." required>
                                <input type="hidden" id="conversacionIdCoach">
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

<style>
.conversation-item-coach {
    cursor: pointer;
    transition: background-color 0.2s;
}

.conversation-item-coach:hover {
    background-color: #f8f9fa;
}

.conversation-item-coach.active {
    background-color: #e3f2fd;
    border-left: 4px solid #2196f3;
}

.message-bubble {
    max-width: 70%;
    padding: 10px 15px;
    border-radius: 15px;
    margin-bottom: 10px;
}

.message-admin {
    background-color: #e3f2fd;
    margin-right: auto;
}

.message-coach {
    background-color: #c8e6c9;
    margin-left: auto;
}

.message-time {
    font-size: 0.75rem;
    color: #6c757d;
    margin-top: 5px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Cargar conversaciones al iniciar
    cargarConversacionesCoach();
    
    // Actualizar cada 30 segundos
    setInterval(cargarConversacionesCoach, 30000);
});

// Cargar lista de conversaciones
function cargarConversacionesCoach() {
    fetch('/coach/conversaciones')
        .then(response => response.json())
        .then(data => {
            const lista = document.getElementById('listaConversacionesCoach');
            
            if (data.conversaciones && data.conversaciones.length > 0) {
                lista.innerHTML = '';
                data.conversaciones.forEach(conv => {
                    const item = document.createElement('div');
                    item.className = 'conversation-item-coach p-3 border-bottom';
                    item.setAttribute('data-conversation-id', conv.id);
                    item.onclick = () => cargarConversacionCoach(conv.id);
                    
                    item.innerHTML = `
                        <div class="d-flex align-items-center">
                            <img src="${conv.admin_foto || 'https://ui-avatars.com/api/?name=Admin&size=40'}" 
                                class="rounded-circle me-3" width="40" height="40">
                            <div class="flex-grow-1">
                                <h6 class="mb-1">${conv.admin_nombre || 'Administrador'}</h6>
                                <p class="mb-0 text-muted small">${conv.ultimo_mensaje ? conv.ultimo_mensaje.substring(0, 30) + '...' : 'Sin mensajes'}</p>
                            </div>
                            ${conv.mensajes_no_leidos > 0 ? `<span class="badge bg-danger">${conv.mensajes_no_leidos}</span>` : ''}
                        </div>
                    `;
                    
                    lista.appendChild(item);
                });
            } else {
                lista.innerHTML = `
                    <div class="text-center p-4">
                        <i class="fas fa-inbox text-muted fa-3x mb-3"></i>
                        <p class="text-muted">No hay mensajes del administrador</p>
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Error al cargar conversaciones:', error);
            document.getElementById('listaConversacionesCoach').innerHTML = `
                <div class="text-center p-4">
                    <i class="fas fa-exclamation-triangle text-warning fa-3x mb-3"></i>
                    <p class="text-muted">Error al cargar conversaciones</p>
                </div>
            `;
        });
}

// Cargar mensajes de una conversación específica
function cargarConversacionCoach(conversacionId) {
    // Marcar conversación como activa
    document.querySelectorAll('.conversation-item-coach').forEach(item => {
        item.classList.remove('active');
    });
    document.querySelector(`[data-conversation-id="${conversacionId}"]`).classList.add('active');
    
    // Cargar mensajes
    fetch(`/coach/conversaciones/${conversacionId}/mensajes`)
        .then(response => response.json())
        .then(data => {
            const chatArea = document.getElementById('chatMessagesCoach');
            const chatHeader = document.getElementById('chatHeaderCoach');
            const chatInput = document.getElementById('chatInputCoach');
            
            // Actualizar header
            chatHeader.innerHTML = `
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-comment-dots me-2"></i>${data.admin_nombre || 'Administrador'}
                </h6>
            `;
            
            // Mostrar mensajes
            if (data.mensajes && data.mensajes.length > 0) {
                chatArea.innerHTML = '';
                data.mensajes.forEach(mensaje => {
                    const isAdmin = mensaje.remitente_tipo === 'admin';
                    const messageDiv = document.createElement('div');
                    messageDiv.className = `message-bubble ${isAdmin ? 'message-admin' : 'message-coach'}`;
                    messageDiv.innerHTML = `
                        <div><strong>${isAdmin ? 'Administrador' : 'Tú'}:</strong></div>
                        <div>${mensaje.contenido}</div>
                        <div class="message-time">${new Date(mensaje.created_at).toLocaleString('es-PE')}</div>
                    `;
                    chatArea.appendChild(messageDiv);
                });
                
                // Scroll al final
                chatArea.scrollTop = chatArea.scrollHeight;
            } else {
                chatArea.innerHTML = `
                    <div class="text-center text-muted">
                        <i class="fas fa-comment-slash fa-3x mb-3"></i>
                        <p>No hay mensajes en esta conversación</p>
                    </div>
                `;
            }
            
            // Mostrar input y guardar ID de conversación
            chatInput.style.display = 'block';
            document.getElementById('conversacionIdCoach').value = conversacionId;
            
            // Marcar mensajes como leídos
            fetch(`/coach/conversaciones/${conversacionId}/marcar-leido`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });
        })
        .catch(error => {
            console.error('Error al cargar mensajes:', error);
        });
}

// Enviar mensaje
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('enviarMensajeCoachForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const conversacionId = document.getElementById('conversacionIdCoach').value;
            const mensaje = document.getElementById('nuevoMensajeCoach').value;
            
            if (!mensaje.trim()) return;
            
            fetch(`/coach/conversaciones/${conversacionId}/enviar`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ mensaje: mensaje })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Limpiar input
                    document.getElementById('nuevoMensajeCoach').value = '';
                    
                    // Recargar mensajes
                    cargarConversacionCoach(conversacionId);
                    
                    // Actualizar lista de conversaciones
                    cargarConversacionesCoach();
                } else {
                    alert('Error al enviar el mensaje');
                }
            })
            .catch(error => {
                console.error('Error al enviar mensaje:', error);
                alert('Error al enviar el mensaje');
            });
        });
    }
});
</script>
