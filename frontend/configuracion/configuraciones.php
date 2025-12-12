<?php
// 1. Iniciar sesión
session_start();

// 2. Verificar que el usuario esté logueado
if (!isset($_SESSION['id_usuario'])) {
    header('Location: ../iniciosesion/login.php');
    exit;
}

// 3. Incluir conexión y controlador
require_once __DIR__ . '/../Database/db/sqlConnection.php';
require_once __DIR__ . '/../Backend/controladorConfiguracion.php';

// 4. Obtener datos del usuario
$controller = new ConfiguracionController($pdo);
try {
    $data = $controller->mostrarConfiguracion((int)$_SESSION['id_usuario']);
} catch (Exception $e) {
    die("Error: " . htmlspecialchars($e->getMessage()));
}

// 5. Asignar variables para la vista
$nombre = htmlspecialchars($data['nombre'] ?? '');
$apellidopaterno = htmlspecialchars($data['apellidopaterno'] ?? '');
$apellidomaterno = htmlspecialchars($data['apellidomaterno'] ?? '');
$genero = htmlspecialchars($data['genero_texto'] ?? '');
$fechanacimineto = htmlspecialchars($data['fechanacimiento'] ?? '');
$correo = htmlspecialchars($data['correo'] ?? '');

// 6. Incluir el encabezado
include "../base/headerLogueado.php"
?>
<style>
    /* configuraciones.css */
    .profile-container {
        max-width: 900px;
        margin: 40px auto;
        padding: 20px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        border: 1px solid #ddd;
    }

    .header-section {
        background: #9ba657;
        color: white;
        padding: 25px;
        border-radius: 8px 8px 0 0;
        margin-bottom: 30px;
    }

    .header-section h1 {
        margin: 0 0 10px 0;
        font-size: 28px;
        font-weight: bold;
    }

    .header-section small {
        font-size: 16px;
        opacity: 0.9;
    }

    .data-section {
        margin-bottom: 30px;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        background: #fff;
    }

    .section-header {
        background: #f5f5f5;
        padding: 18px 25px;
        border-bottom: 2px solid #9ba657;
    }

    .section-header h2 {
        margin: 0;
        font-size: 20px;
        color: #333;
        font-weight: 600;
    }

    .data-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 18px 25px;
        border-bottom: 1px solid #eee;
    }

    .data-item:last-child {
        border-bottom: none;
    }

    .data-info {
        flex: 1;
    }

    .data-label {
        display: block;
        font-weight: bold;
        color: #555;
        margin-bottom: 5px;
        font-size: 15px;
    }

    .data-value {
        display: block;
        color: #333;
        font-size: 16px;
    }

    .btn-edit-field {
        background: #9ba657;
        color: white;
        border: none;
        padding: 10px 18px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        margin-left: 15px;
        text-decoration: none;
    }

    .btn-edit-field:hover {
        background: #8a9550;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(139, 149, 80, 0.3);
    }

    .action-buttons {
        padding: 30px;
        text-align: center;
        border-top: 1px solid #eee;
        margin-top: 20px;
    }

    .btn-cancel {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 25px;
        background: #6c757d;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        font-weight: 600;
        font-size: 15px;
        transition: all 0.3s ease;
    }

    .btn-cancel:hover {
        background: #5a6268;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(108, 117, 125, 0.3);
    }
</style>

<div class="profile-container">
    <div class="header-section">
        <h1>Configuración de Perfil</h1>
        <small>Gestiona tus datos personales</small>
    </div>

    <!-- Sección Información Personal -->
    <div class="data-section">
        <div class="section-header">
            <h2>Información Personal</h2>
        </div>
        <div class="section-content">
            <div class="data-item" data-field="nombre">
                <div class="data-info">
                    <span class="data-label">Nombre(s):</span>
                    <span class="data-value"><?php echo $nombre; ?></span>
                </div>
                <button class="btn-edit-field" data-field="nombre">
                    <i class="fas fa-edit"></i> Editar
                </button>
            </div>
            <div class="data-item" data-field="apellido_paterno">
                <div class="data-info">
                    <span class="data-label">Apellido Paterno:</span>
                    <span class="data-value"><?php echo $apellidopaterno; ?></span>
                </div>
                <button class="btn-edit-field" data-field="apellido_paterno">
                    <i class="fas fa-edit"></i> Editar
                </button>
            </div>
            <div class="data-item" data-field="apellido_materno">
                <div class="data-info">
                    <span class="data-label">Apellido Materno:</span>
                    <span class="data-value"><?php echo $apellidomaterno; ?></span>
                </div>
                <button class="btn-edit-field" data-field="apellido_materno">
                    <i class="fas fa-edit"></i> Editar
                </button>
            </div>
            <div class="data-item" data-field="genero">
                <div class="data-info">
                    <span class="data-label">Género:</span>
                    <span class="data-value"><?php echo $genero; ?></span>
                </div>
                <button class="btn-edit-field" data-field="genero">
                    <i class="fas fa-edit"></i> Editar
                </button>
            </div>
            <div class="data-item" data-field="fecha_nacimiento">
                <div class="data-info">
                    <span class="data-label">Fecha de Nacimiento:</span>
                    <span class="data-value"><?php echo $fechanacimineto; ?></span>
                </div>
                <button class="btn-edit-field" data-field="fecha_nacimiento">
                    <i class="fas fa-edit"></i> Editar
                </button>
            </div>
        </div>
    </div>

    <!-- Sección Credenciales -->
    <div class="data-section">
        <div class="section-header">
            <h2>Credenciales de Acceso</h2>
        </div>
        <div class="section-content">
            <div class="data-item" data-field="correo">
                <div class="data-info">
                    <span class="data-label">Correo Electrónico:</span>
                    <span class="data-value"><?php echo $correo; ?></span>
                </div>
                <button class="btn-edit-field" data-field="correo">
                    <i class="fas fa-edit"></i> Editar
                </button>
            </div>
            <div class="data-item">
                <div class="data-info">
                    <span class="data-label">Contraseña:</span>
                    <span class="data-value">********</span>
                </div>
                <button class="btn-edit-field btn-password" id="openPasswordModal">
                    <i class="fas fa-key"></i> Cambiar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================
     MODALES
     ============================================ -->

<!-- Modal para editar campo -->
<div class="modal-overlay" id="editModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fas fa-edit"></i> <span id="modalTitle">Editar Campo</span></h3>
            <button class="close-modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="modal-field">
                <label id="modalLabel">Campo:</label>
                <input type="text" id="modalInput" placeholder="Ingresa el nuevo valor">
                <select id="modalSelect" style="display: none;">
                    <option value="">Selecciona género</option>
                    <option value="1">Masculino</option>
                    <option value="2">Femenino</option>
                    <option value="3">Otro</option>
                </select>
                <input type="date" id="modalDate" style="display: none;">
                <div class="validation-message" id="modalValidation"></div>
            </div>
        </div>
        <div class="modal-actions">
            <button class="modal-btn cancel">Cancelar</button>
            <button class="modal-btn save" id="saveFieldBtn">Guardar</button>
        </div>
    </div>
</div>

<!-- Modal para cambiar contraseña -->
<div class="modal-overlay" id="passwordModal">
    <div class="modal-content password-modal">
        <div class="modal-header">
            <h3><i class="fas fa-key"></i> Cambiar Contraseña</h3>
            <button class="close-modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="modal-field">
                <label>Contraseña actual:</label>
                <input type="password" id="currentPassword" placeholder="Ingresa tu contraseña actual">
                <div class="validation-message" id="currentPasswordValidation"></div>
            </div>
            <div class="modal-field">
                <label>Nueva contraseña:</label>
                <input type="password" id="newPassword" placeholder="Ingresa nueva contraseña">
                <div class="password-strength" id="passwordStrength"></div>
            </div>
            <div class="modal-field">
                <label>Confirmar nueva contraseña:</label>
                <input type="password" id="confirmPassword" placeholder="Confirma la nueva contraseña">
                <div class="validation-message" id="confirmPasswordValidation"></div>
            </div>
            <div class="password-requirements">
                <p>La contraseña debe tener:</p>
                <ul>
                    <li>Mínimo 8 caracteres</li>
                    <li>Al menos una letra mayúscula</li>
                    <li>Al menos un número</li>
                    <li>Al menos un carácter especial (!@#$%^&*)</li>
                </ul>
            </div>
        </div>
        <div class="modal-actions">
            <button class="modal-btn cancel">Cancelar</button>
            <button class="modal-btn save" id="savePasswordBtn">Cambiar Contraseña</button>
        </div>
    </div>
</div>

<!-- ============================================
     SCRIPT JAVASCRIPT
     ============================================ -->
<script>
    // Variables globales
    let currentField = '';
    let originalValue = '';

    // Abrir modal de edición
    document.querySelectorAll('.btn-edit-field[data-field]').forEach(button => {
        button.addEventListener('click', function() {
            const field = this.getAttribute('data-field');
            const dataItem = this.closest('.data-item');
            const dataLabel = dataItem.querySelector('.data-label').textContent.trim();
            const dataValue = dataItem.querySelector('.data-value').textContent.trim();

            currentField = field;
            originalValue = dataValue;

            const modalTitle = document.getElementById('modalTitle');
            const modalLabel = document.getElementById('modalLabel');
            const modalInput = document.getElementById('modalInput');
            const modalSelect = document.getElementById('modalSelect');
            const modalDate = document.getElementById('modalDate');

            modalInput.style.display = 'none';
            modalSelect.style.display = 'none';
            modalDate.style.display = 'none';

            modalTitle.textContent = `Editar ${dataLabel.replace(':', '')}`;
            modalLabel.textContent = `Nuevo ${dataLabel.replace(':', '')}:`;

            if (field === 'genero') {
                modalSelect.style.display = 'block';
                const generos = {
                    'Masculino': '1',
                    'Femenino': '2',
                    'Otro': '3',
                };
                modalSelect.value = generos[dataValue] || '';
            } else if (field === 'fecha_nacimiento') {
                modalDate.style.display = 'block';
                if (dataValue) {
                    const parts = dataValue.split('/');
                    if (parts.length === 3) modalDate.value = `${parts[2]}-${parts[1]}-${parts[0]}`;
                }
            } else {
                modalInput.style.display = 'block';
                modalInput.type = field === 'correo' ? 'email' : 'text';
                modalInput.value = dataValue;
            }

            document.getElementById('modalValidation').textContent = '';
            document.getElementById('editModal').classList.add('active');
        });
    });

    // Modal de contraseña
    document.getElementById('openPasswordModal')?.addEventListener('click', () => {
        document.getElementById('passwordModal').classList.add('active');
    });

    // Cerrar modales
    document.querySelectorAll('.close-modal, .modal-btn.cancel').forEach(el => {
        el.addEventListener('click', () => {
            document.querySelectorAll('.modal-overlay').forEach(m => m.classList.remove('active'));
            resetModals();
        });
    });

    // Cerrar al hacer clic fuera
    document.querySelectorAll('.modal-overlay').forEach(modal => {
        modal.addEventListener('click', e => {
            if (e.target === modal) {
                modal.classList.remove('active');
                resetModals();
            }
        });
    });

    // Evitar cierre dentro del contenido
    document.querySelectorAll('.modal-content').forEach(content => {
        content.addEventListener('click', e => e.stopPropagation());
    });

    // Reset modales
    function resetModals() {
        document.getElementById('modalInput').value = '';
        document.getElementById('modalSelect').value = '';
        document.getElementById('modalDate').value = '';
        document.getElementById('modalValidation').textContent = '';
        document.getElementById('currentPassword').value = '';
        document.getElementById('newPassword').value = '';
        document.getElementById('confirmPassword').value = '';
        document.getElementById('passwordStrength').textContent = '';
        document.getElementById('currentPasswordValidation').textContent = '';
        document.getElementById('confirmPasswordValidation').textContent = '';
        const preview = document.getElementById('previewImage');
        if (preview) preview.src = '';
    }

    // Guardar campo
    document.getElementById('saveFieldBtn')?.addEventListener('click', function() {
        let newValue = '';
        const modalInput = document.getElementById('modalInput');
        const modalSelect = document.getElementById('modalSelect');
        const modalDate = document.getElementById('modalDate');
        const validationMsg = document.getElementById('modalValidation');

        if (modalSelect.style.display === 'block') newValue = modalSelect.value;
        else if (modalDate.style.display === 'block') newValue = modalDate.value;
        else newValue = modalInput.value.trim();

        if (!newValue) {
            validationMsg.textContent = 'Este campo es requerido';
            validationMsg.className = 'validation-message error';
            return;
        }

        if (currentField === 'correo' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(newValue)) {
            validationMsg.textContent = 'Correo electrónico no válido';
            validationMsg.className = 'validation-message error';
            return;
        }

        if (['nombre', 'apellido_paterno', 'apellido_materno'].includes(currentField)) {
            if (!/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(newValue)) {
                validationMsg.textContent = 'Solo se permiten letras y espacios';
                validationMsg.className = 'validation-message error';
                return;
            }
        }

        fetch('../configuracion/controladorConfiguracion.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    action: 'actualizarCampo',
                    campo: currentField,
                    valor: newValue
                })
            })
            .then(res => res.json())
            .then(data => {
                const msg = document.getElementById('modalValidation');
                if (data.success) {
                    msg.textContent = '✓ ' + data.message;
                    msg.className = 'validation-message success';
                    const textMap = {
                        1: 'Masculino',
                        2: 'Femenino',
                        3: 'Otro',
                        4: 'Prefiero no decirlo'
                    };
                    const displayValue = (currentField === 'genero') ? (textMap[newValue] || 'No especificado') :
                        (currentField === 'fecha_nacimiento' ? newValue.split('-').reverse().join('/') : newValue);
                    const target = document.querySelector(`.data-item[data-field="${currentField}"] .data-value`);
                    if (target) target.textContent = displayValue;
                    setTimeout(() => {
                        document.getElementById('editModal').classList.remove('active');
                        resetModals();
                    }, 2000);
                } else {
                    msg.textContent = '✗ ' + data.message;
                    msg.className = 'validation-message error';
                }
            })
            .catch(err => {
                console.error(err);
                document.getElementById('modalValidation').textContent = '✗ Error de conexión';
                document.getElementById('modalValidation').className = 'validation-message error';
            });
    });

    // Validación de contraseña
    document.getElementById('newPassword')?.addEventListener('input', function() {
        const password = this.value;
        const strength = document.getElementById('passwordStrength');
        if (!password) {
            strength.textContent = '';
            return;
        }

        let score = 0;
        if (password.length >= 8) score++;
        if (/[A-Z]/.test(password)) score++;
        if (/[0-9]/.test(password)) score++;
        if (/[!@#$%^&*]/.test(password)) score++;

        const texts = ['Muy débil', 'Débil', 'Buena', 'Fuerte'];
        const classes = ['weak', 'weak', 'medium', 'strong'];
        strength.textContent = texts[score - 1] || 'Muy débil';
        strength.className = 'password-strength ' + (classes[score - 1] || 'weak');
    });

    // Guardar contraseña
    document.getElementById('savePasswordBtn')?.addEventListener('click', function() {
        const current = document.getElementById('currentPassword').value;
        const newPass = document.getElementById('newPassword').value;
        const confirm = document.getElementById('confirmPassword').value;

        if (!current || !newPass || !confirm) return;

        if (newPass !== confirm) {
            document.getElementById('confirmPasswordValidation').textContent = 'Las contraseñas no coinciden';
            return;
        }

        fetch('../configuracion/controladorConfiguracion.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    action: 'cambiarPassword',
                    current_password: current,
                    new_password: newPass,
                    confirm_password: confirm
                })
            })
            .then(res => res.json())
            .then(data => {
                const strengthEl = document.getElementById('passwordStrength');
                if (data.success) {
                    strengthEl.textContent = '✓ ' + data.message;
                    strengthEl.className = 'password-strength success';
                    setTimeout(() => {
                        document.getElementById('passwordModal').classList.remove('active');
                        resetModals();
                    }, 2000);
                } else {
                    strengthEl.textContent = '✗ ' + data.message;
                    strengthEl.className = 'password-strength weak';
                }
            })
            .catch(err => {
                document.getElementById('passwordStrength').textContent = '✗ Error al cambiar la contraseña';
                document.getElementById('passwordStrength').className = 'password-strength weak';
            });
    });
</script>

<?php
// Incluir el pie de página
include __DIR__ . '/../base/footer.php';
?>