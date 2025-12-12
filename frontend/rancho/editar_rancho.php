<!DOCTYPE html>
<html lang="es">
<?php include "controladorCargarInfoRancho.php";
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taltech</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <main class="container-gestion-rancho">
        <section class="section" data-section="datos-generales">
            <div class="section-title">
                <h2>Datos generales</h2>
                <button class="edit-btn" onclick="openModal('datos-generales')"><i class="fas fa-edit"></i> Editar</button>
            </div>

            <!-- Nuevo apartado para imagen del rancho REDONDO -->
            <div class="form-group">
                <label for="ranch-image">Imagen del Rancho</label>
                <div id="image-preview-container" class="round-image-upload-container" onclick="openImageModal()">
                    <i class="fas fa-camera"></i>
                    <h3>Subir imagen del rancho</h3>
                    <p>Haz clic aquí</p>
                </div>
                <div id="image-display" class="round-image-preview" style="display: none;">
                    <img id="ranch-image-display" src="" alt="Imagen del rancho">
                </div>
                <div class="round-image-actions" id="image-actions" style="display: none;">
                    <button class="image-action-btn change" onclick="openImageModal()"><i class="fas fa-edit"></i> Cambiar Imagen</button>
                    <button class="image-action-btn remove" onclick="removeRanchImage()"><i class="fas fa-trash"></i> Eliminar</button>
                </div>
            </div>
        </section>
        
        <section class="section" data-section="nombre-rancho">
            <div class="section-title">
                <h2>Nombre del Rancho</h2>
                <button class="edit-btn" onclick="openModal('nombre-rancho')"><i class="fas fa-edit"></i> Editar</button>
            </div>

            <div class="form-group">
                <label for="ranch-name">Nombre:</label>
                <div class="view-mode empty" id="ranch-name-view"><?php echo $rancho["nombre"] ?></div>
            </div>
        </section>

        <section class="section" data-section="acerca-de">
            <div class="section-title">
                <h2>Acerca de</h2>
                <button class="edit-btn" onclick="openModal('acerca-de')"><i class="fas fa-edit"></i> Editar</button>
            </div>

            <div class="form-group">
                <label for="description">Descripción:</label>
                <div class="view-mode empty" id="description-view"><?php echo $rancho["descripcion"] ?></div>
            </div>
        </section>

        <section class="section" data-section="ganado">
            <div class="section-title">
                <h2>Ganado</h2>
                <button class="edit-btn" onclick="openModal('ganado')"><i class="fas fa-edit"></i> Editar</button>
            </div>

            <div class="livestock-grid" id="livestock-view">
                <!-- Contenido dinámico -->
            </div>
        </section>

        <section class="section" data-section="ubicacion">
            <div class="section-title">
                <h2>Ubicación</h2>
                <button class="edit-btn" onclick="openModal('ubicacion')"><i class="fas fa-edit"></i> Editar</button>
            </div>

            <div class="form-group">
                <label for="state">Estado:</label>
                <div class="view-mode empty" id="state-view">No especificado</div>
            </div>

            <div class="form-group">
                <label for="municipality">Municipio:</label>
                <div class="view-mode empty" id="municipality-view">No especificado</div>
            </div>

            <div class="form-group">
                <label for="colony">Colonia:</label>
                <div class="view-mode empty" id="colony-view">No especificado</div>
            </div>

            <div class="form-group">
                <label for="street">Calle:</label>
                <div class="view-mode empty" id="street-view">No especificado</div>
            </div>

            <div class="form-group">
                <label for="number">Número Exterior/Interior:</label>
                <div class="view-mode empty" id="number-view">No especificado</div>
            </div>

            <div class="form-group">
                <label>Mapa:</label>
                <div class="map-placeholder">
                    <i class="fas fa-map-marked-alt"></i>
                    <p>Mapa de ubicación del rancho</p>
                </div>
            </div>
        </section>

        <section class="section" data-section="contacto">
            <div class="section-title">
                <h2>Contacto</h2>
                <button class="edit-btn" onclick="openModal('contacto')"><i class="fas fa-edit"></i> Editar</button>
            </div>

            <div class="form-group">
                <label for="phone">Teléfono:</label>
                <div class="view-mode empty" id="phone-view">No especificado</div>
            </div>

            <div class="form-group">
                <label for="email">Correo:</label>
                <div class="view-mode empty" id="email-view">No especificado</div>
            </div>

            <div class="form-group">
                <label>Redes sociales:</label>
                <div class="social-icons">
                    <a href="#" class="social-icon facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon instagram"><i class="fab fa-instagram"></i></a>
                </div>
            </div>

            <div class="form-group">
                <label for="facebook">Facebook:</label>
                <div class="view-mode empty" id="facebook-view">No especificado</div>
            </div>

            <div class="form-group">
                <label for="instagram">Instagram:</label>
                <div class="view-mode empty" id="instagram-view">No especificado</div>
            </div>
        </section>
    </main>

    <!-- Modal para Datos Generales -->
    <div id="modal-datos-generales" class="modal-overlay">
        <div class="modal-content">
            <form action=
            <div class="modal-header">
                <h3><i class="fas fa-user-edit"></i> Editar Datos Generales</h3>
                <button class="close-modal" onclick="closeModal('datos-generales')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="location-edit">Ubicación:</label>
                    <input type="text" id="location-edit" class="input-area" placeholder="Ingresa tu ubicación" value="">
                </div>

                <div class="form-group">
                    <label for="identity-edit">Identidad:</label>
                    <input type="text" id="identity-edit" class="input-area" placeholder="Identidad" value="">
                </div>

                <div class="form-group">
                    <label for="name-edit">Nombre:</label>
                    <input type="text" id="name-edit" class="input-area" placeholder="Nombre completo" value="">
                </div>
            </div>
            <div class="modal-actions">
                <button class="modal-btn cancel" onclick="closeModal('datos-generales')">Cancelar</button>
                <button class="modal-btn save" onclick="saveData('datos-generales')">Guardar Cambios</button>
            </div>
        </div>
    </div>

    <!-- Modal para Nombre del Rancho -->
    <div id="modal-nombre-rancho" class="modal-overlay">
        <div class="modal-content">
            <form action="controladorEditarNombre.php" method="POST">
            <div class="modal-header">
                <h3><i class="fas fa-signature"></i> Editar Nombre del Rancho</h3>
                <button class="close-modal" onclick="closeModal('nombre-rancho')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="ranch-name-edit">Nombre del Rancho:</label>
                    <input type="text" id="ranch-name-edit" name="ranch-name-edit" class="input-area" 
                           placeholder="Ingresa el nombre de tu rancho" value="">
                </div>
            </div>
            <div class="modal-actions">
                <button class="modal-btn cancel" onclick="closeModal('nombre-rancho')">Cancelar</button>
                <button class="modal-btn save" type="submit">Guardar Cambios</button>
            </div>
        </form>
        </div>
    </div>

    <!-- Nuevo Modal para Imagen del Rancho con diseño redondo -->
    <div id="modal-imagen-rancho" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-image"></i> Subir Imagen del Rancho</h3>
                <button class="close-modal" onclick="closeModal('imagen-rancho')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="modal-round-image-container" onclick="triggerFileInput()" id="image-drop-zone">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <h3>Arrastra y suelta una imagen aquí</h3>
                    <p>o haz clic para seleccionar un archivo</p>
                </div>

                <input type="file" id="image-input" accept="image/jpeg, image/png, image/gif" style="display: none;" onchange="handleImageUpload(event)">

                <div id="image-preview-modal" class="modal-round-image-preview" style="display: none; margin-top: 20px;">
                    <img id="image-preview-img" src="" alt="Vista previa">
                </div>

                <div class="round-image-actions" id="modal-image-actions" style="display: none; margin-top: 15px;">
                    <button class="image-action-btn change" onclick="triggerFileInput()"><i class="fas fa-sync"></i> Cambiar Imagen</button>
                    <button class="image-action-btn remove" onclick="clearImagePreview()"><i class="fas fa-times"></i> Cancelar</button>
                </div>

                <div class="form-group" style="margin-top: 20px;">
                    <label for="image-description">Descripción de la imagen (opcional):</label>
                    <input type="text" id="image-description" class="input-area" placeholder="Ej: Vista principal del rancho">
                </div>

                <div style="text-align: center; margin-top: 10px; color: #666; font-size: 14px;">
                    <p><i class="fas fa-info-circle"></i> Formatos permitidos: JPG, PNG, GIF (Máx. 5MB)</p>
                </div>
            </div>
            <div class="modal-actions">
                <button class="modal-btn cancel" onclick="closeModal('imagen-rancho')">Cancelar</button>
                <button class="modal-btn save" onclick="saveRanchImage()" id="save-image-btn" disabled>Guardar Imagen</button>
            </div>
        </div>
    </div>

    <!-- Modales existentes (Acerca de, Ganado, Ubicación, Contacto) -->
    <div id="modal-acerca-de" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-info-circle"></i> Editar Acerca de</h3>
                <button class="close-modal" onclick="closeModal('acerca-de')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="description-edit">Descripción:</label>
                    <textarea id="description-edit" class="input-area" rows="8" placeholder="Describe tu experiencia y actividad ganadera"></textarea>
                </div>
            </div>
            <div class="modal-actions">
                <button class="modal-btn cancel" onclick="closeModal('acerca-de')">Cancelar</button>
                <button class="modal-btn save" onclick="saveData('acerca-de')">Guardar Cambios</button>
            </div>
        </div>
    </div>

    <div id="modal-ganado" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-cow"></i> Editar Tipos de Ganado</h3>
                <button class="close-modal" onclick="closeModal('ganado')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="livestock-grid">
                    <div class="livestock-category">
                        <div class="category-title">Toros</div>
                        <div class="form-group">
                            <label>Razas:</label>
                            <input type="text" id="toros-razas" class="input-area" value="" placeholder="Separar razas por comas">
                        </div>
                    </div>

                    <div class="livestock-category">
                        <div class="category-title">Vacas</div>
                        <div class="form-group">
                            <label>Razas:</label>
                            <input type="text" id="vacas-razas" class="input-area" value="" placeholder="Separar razas por comas">
                        </div>
                    </div>

                    <div class="livestock-category">
                        <div class="category-title">Aves</div>
                        <div class="form-group">
                            <label>Razas:</label>
                            <input type="text" id="aves-razas" class="input-area" value="" placeholder="Separar razas por comas">
                        </div>
                    </div>

                    <div class="livestock-category">
                        <div class="category-title">Caballos</div>
                        <div class="form-group">
                            <label>Razas:</label>
                            <input type="text" id="caballos-razas" class="input-area" value="" placeholder="Separar razas por comas">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-actions">
                <button class="modal-btn cancel" onclick="closeModal('ganado')">Cancelar</button>
                <button class="modal-btn save" onclick="saveData('ganado')">Guardar Cambios</button>
            </div>
        </div>
    </div>

    <div id="modal-ubicacion" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-map-marker-alt"></i> Editar Ubicación</h3>
                <button class="close-modal" onclick="closeModal('ubicacion')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="state-edit">Estado:</label>
                    <div class="custom-select">
                        <select id="state-edit" onchange="handleSelectChange('state', this.value)">
                            <option value="" selected>Selecciona un estado</option>
                            <option value="Veracruz">Veracruz</option>
                            <option value="Puebla">Puebla</option>
                            <option value="Jalisco">Jalisco</option>
                            <option value="Michoacán">Michoacán</option>
                            <option value="Guanajuato">Guanajuato</option>
                            <option value="otro">Otro (especificar)</option>
                        </select>
                    </div>
                    <small class="other-value-display" id="state-other-display" style="display: none; margin-top: 5px; color: #666;">
                        <i class="fas fa-info-circle"></i> Valor personalizado: <span id="state-other-value"></span>
                    </small>
                </div>

                <div class="form-group">
                    <label for="municipality-edit">Municipio:</label>
                    <div class="custom-select">
                        <select id="municipality-edit" onchange="handleSelectChange('municipality', this.value)">
                            <option value="" selected>Selecciona un municipio</option>
                            <option value="Xalapa">Xalapa</option>
                            <option value="Veracruz">Veracruz</option>
                            <option value="Córdoba">Córdoba</option>
                            <option value="Orizaba">Orizaba</option>
                            <option value="Coatepec">Coatepec</option>
                            <option value="otro">Otro (especificar)</option>
                        </select>
                    </div>
                    <small class="other-value-display" id="municipality-other-display" style="display: none; margin-top: 5px; color: #666;">
                        <i class="fas fa-info-circle"></i> Valor personalizado: <span id="municipality-other-value"></span>
                    </small>
                </div>

                <div class="form-group">
                    <label for="colony-edit">Colonia:</label>
                    <div class="custom-select">
                        <select id="colony-edit" onchange="handleSelectChange('colony', this.value)">
                            <option value="" selected>Selecciona una colonia</option>
                            <option value="Centro">Centro</option>
                            <option value="Reforma">Reforma</option>
                            <option value="Buenavista">Buenavista</option>
                            <option value="Lomas del Estadio">Lomas del Estadio</option>
                            <option value="Animas">Animas</option>
                            <option value="otro">Otro (especificar)</option>
                        </select>
                    </div>
                    <small class="other-value-display" id="colony-other-display" style="display: none; margin-top: 5px; color: #666;">
                        <i class="fas fa-info-circle"></i> Valor personalizado: <span id="colony-other-value"></span>
                    </small>
                </div>

                <div class="form-group">
                    <label for="street-edit">Calle:</label>
                    <input type="text" id="street-edit" class="input-area" placeholder="Calle" value="">
                </div>

                <div class="form-group">
                    <label for="number-edit">Número Exterior/Interior:</label>
                    <input type="text" id="number-edit" class="input-area" placeholder="Número" value="">
                </div>

                <div class="form-group">
                    <label>Mapa:</label>
                    <div class="map-placeholder">
                        <i class="fas fa-map-marked-alt"></i>
                        <p>Mapa de ubicación del rancho</p>
                        <small>La ubicación en el mapa se actualizará automáticamente</small>
                    </div>
                </div>
            </div>
            <div class="modal-actions">
                <button class="modal-btn cancel" onclick="closeModal('ubicacion')">Cancelar</button>
                <button class="modal-btn save" onclick="saveData('ubicacion')">Guardar Cambios</button>
            </div>
        </div>
    </div>

    <div id="modal-contacto" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-address-book"></i> Editar Contacto</h3>
                <button class="close-modal" onclick="closeModal('contacto')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="phone-edit">Teléfono:</label>
                    <input type="text" id="phone-edit" class="input-area" placeholder="Teléfono" value="">
                </div>

                <div class="form-group">
                    <label for="email-edit">Correo:</label>
                    <input type="email" id="email-edit" class="input-area" placeholder="Correo electrónico" value="">
                </div>

                <div class="form-group">
                    <label for="facebook-edit">Facebook:</label>
                    <input type="text" id="facebook-edit" class="input-area" placeholder="Enlace a Facebook" value="">
                </div>

                <div class="form-group">
                    <label for="instagram-edit">Instagram:</label>
                    <input type="text" id="instagram-edit" class="input-area" placeholder="Enlace a Instagram" value="">
                </div>
            </div>
            <div class="modal-actions">
                <button class="modal-btn cancel" onclick="closeModal('contacto')">Cancelar</button>
                <button class="modal-btn save" onclick="saveData('contacto')">Guardar Cambios</button>
            </div>
        </div>
    </div>

    <div id="modal-otro" class="modal-overlay">
        <div class="modal-content modal-small">
            <div class="modal-header">
                <h3><i class="fas fa-edit"></i> Especificar <span id="otro-title"></span></h3>
                <button class="close-modal" onclick="closeOtroModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label id="otro-label">Ingresa el nombre:</label>
                    <input type="text" id="otro-input" class="input-area" placeholder="Escribe aquí...">
                    <small style="display: block; margin-top: 5px; color: #666;">
                        Este valor se guardará como opción personalizada.
                    </small>
                </div>
            </div>
            <div class="modal-actions">
                <button class="modal-btn cancel" onclick="closeOtroModal()">Cancelar</button>
                <button class="modal-btn save" onclick="saveOtroValue()">Guardar</button>
            </div>
        </div>
    </div>
</body>
    <script>
        let currentData = {
            "datos-generales": {
                location: "",
                identity: "",
                name: ""
            },
            "nombre-rancho": {
                ranchName: ""
            },
            "acerca-de": {
                description: ""
            },
            "ganado": {
                toros: [],
                vacas: [],
                aves: [],
                caballos: []
            },
            "ubicacion": {
                state: { value: "", isOther: false, otherValue: "" },
                municipality: { value: "", isOther: false, otherValue: "" },
                colony: { value: "", isOther: false, otherValue: "" },
                street: "",
                number: ""
            },
            "contacto": {
                phone: "",
                email: "",
                facebook: "",
                instagram: ""
            },
            "imagen-rancho": {
                imageUrl: "",
                imageDescription: "",
                hasImage: false
            }
        };

        let currentOtroType = "";
        let currentOtroSelect = null;
        let selectedImageFile = null;
        let selectedImageUrl = null;

        function openModal(sectionId) {
            const modal = document.getElementById(`modal-${sectionId}`);
            modal.style.display = "flex";
            if (sectionId !== "imagen-rancho") {
                loadDataToModal(sectionId);
            }
            document.body.style.overflow = "hidden";
        }

        function closeModal(sectionId) {
            const modal = document.getElementById(`modal-${sectionId}`);
            modal.style.display = "none";
            document.body.style.overflow = "auto";

            if (sectionId === "imagen-rancho") {
                clearImagePreview();
            }
        }

        function openImageModal() {
            openModal('imagen-rancho');
        }

        function triggerFileInput() {
            document.getElementById('image-input').click();
        }

        function handleImageUpload(event) {
            const file = event.target.files[0];
            if (!file) return;

            // Validar tamaño del archivo (máx 5MB)
            if (file.size > 5 * 1024 * 1024) {
                alert("El archivo es demasiado grande. El tamaño máximo es de 5MB.");
                return;
            }

            // Validar tipo de archivo
            const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!validTypes.includes(file.type)) {
                alert("Formato de archivo no válido. Solo se permiten JPG, PNG y GIF.");
                return;
            }

            selectedImageFile = file;

            // Crear URL para vista previa
            const reader = new FileReader();
            reader.onload = function (e) {
                selectedImageUrl = e.target.result;
                document.getElementById('image-preview-img').src = selectedImageUrl;
                document.getElementById('image-preview-modal').style.display = 'block';
                document.getElementById('modal-image-actions').style.display = 'flex';
                document.getElementById('save-image-btn').disabled = false;

                // Ocultar el contenedor de subida
                document.getElementById('image-drop-zone').style.display = 'none';
            };
            reader.readAsDataURL(file);
        }

        function clearImagePreview() {
            selectedImageFile = null;
            selectedImageUrl = null;
            document.getElementById('image-preview-img').src = '';
            document.getElementById('image-preview-modal').style.display = 'none';
            document.getElementById('modal-image-actions').style.display = 'none';
            document.getElementById('image-input').value = '';
            document.getElementById('save-image-btn').disabled = true;

            // Mostrar el contenedor de subida
            document.getElementById('image-drop-zone').style.display = 'flex';
        }

        function saveRanchImage() {
            if (!selectedImageUrl) {
                alert("Por favor, selecciona una imagen primero.");
                return;
            }

            const imageDescription = document.getElementById('image-description').value.trim();

            // Guardar en currentData
            currentData['imagen-rancho'].imageUrl = selectedImageUrl;
            currentData['imagen-rancho'].imageDescription = imageDescription;
            currentData['imagen-rancho'].hasImage = true;

            // Actualizar vista
            updateRanchImageView();

            // Cerrar modal
            closeModal('imagen-rancho');

            // Mostrar notificación
            showNotification("Imagen del rancho actualizada correctamente");
        }

        function updateRanchImageView() {
            const imageDisplay = document.getElementById('image-display');
            const imageUploadContainer = document.getElementById('image-preview-container');
            const imageActions = document.getElementById('image-actions');

            if (currentData['imagen-rancho'].hasImage) {
                // Mostrar imagen redonda
                document.getElementById('ranch-image-display').src = currentData['imagen-rancho'].imageUrl;
                imageDisplay.style.display = 'block';
                imageUploadContainer.style.display = 'none';
                imageActions.style.display = 'flex';
            } else {
                // Mostrar contenedor de subida redondo
                imageDisplay.style.display = 'none';
                imageUploadContainer.style.display = 'flex';
                imageActions.style.display = 'none';
            }
        }

        function removeRanchImage() {
            if (confirm("¿Estás seguro de que deseas eliminar la imagen del rancho?")) {
                currentData['imagen-rancho'].imageUrl = "";
                currentData['imagen-rancho'].imageDescription = "";
                currentData['imagen-rancho'].hasImage = false;

                updateRanchImageView();
                showNotification("Imagen del rancho eliminada");
            }
        }

        // Funciones de arrastrar y soltar para la imagen redonda
        function setupDragAndDrop() {
            const dropZone = document.getElementById('image-drop-zone');

            dropZone.addEventListener('dragover', function (e) {
                e.preventDefault();
                dropZone.style.borderColor = '#1976D2';
                dropZone.style.backgroundColor = 'rgba(33, 150, 243, 0.1)';
                dropZone.style.transform = 'scale(1.05)';
            });

            dropZone.addEventListener('dragleave', function (e) {
                e.preventDefault();
                dropZone.style.borderColor = '#2196F3';
                dropZone.style.backgroundColor = '#f9f9f9';
                dropZone.style.transform = 'scale(1)';
            });

            dropZone.addEventListener('drop', function (e) {
                e.preventDefault();
                dropZone.style.borderColor = '#2196F3';
                dropZone.style.backgroundColor = '#f9f9f9';
                dropZone.style.transform = 'scale(1)';

                if (e.dataTransfer.files.length) {
                    const file = e.dataTransfer.files[0];
                    handleDroppedFile(file);
                }
            });
        }

        function handleDroppedFile(file) {
            // Validar que sea una imagen
            if (!file.type.startsWith('image/')) {
                alert("Por favor, arrastra solo archivos de imagen.");
                return;
            }

            // Validar tamaño del archivo (máx 5MB)
            if (file.size > 5 * 1024 * 1024) {
                alert("El archivo es demasiado grande. El tamaño máximo es de 5MB.");
                return;
            }

            selectedImageFile = file;

            // Crear URL para vista previa
            const reader = new FileReader();
            reader.onload = function (e) {
                selectedImageUrl = e.target.result;
                document.getElementById('image-preview-img').src = selectedImageUrl;
                document.getElementById('image-preview-modal').style.display = 'block';
                document.getElementById('modal-image-actions').style.display = 'flex';
                document.getElementById('save-image-btn').disabled = false;

                // Ocultar el contenedor de subida
                document.getElementById('image-drop-zone').style.display = 'none';
            };
            reader.readAsDataURL(file);
        }

        function handleSelectChange(type, value) {
            if (value === "otro") {
                currentOtroType = type;
                currentOtroSelect = document.getElementById(`${type}-edit`);
                openOtroModal(type);
            } else {
                const otherDisplay = document.getElementById(`${type}-other-display`);
                if (otherDisplay) {
                    otherDisplay.style.display = "none";
                }
            }
        }

        function openOtroModal(type) {
            const modal = document.getElementById('modal-otro');
            const title = document.getElementById('otro-title');
            const label = document.getElementById('otro-label');
            const input = document.getElementById('otro-input');

            let tipoTexto = "";
            switch (type) {
                case "state": tipoTexto = "Estado"; break;
                case "municipality": tipoTexto = "Municipio"; break;
                case "colony": tipoTexto = "Colonia"; break;
            }

            title.textContent = tipoTexto;
            label.textContent = `Ingresa el nombre del ${tipoTexto.toLowerCase()}:`;
            input.placeholder = `Ejemplo: Nombre del ${tipoTexto.toLowerCase()}`;

            if (currentData.ubicacion[type].isOther && currentData.ubicacion[type].otherValue) {
                input.value = currentData.ubicacion[type].otherValue;
            } else {
                input.value = "";
            }

            modal.style.display = "flex";
        }

        function closeOtroModal() {
            const modal = document.getElementById('modal-otro');
            modal.style.display = "none";

            if (currentOtroSelect) {
                const currentTypeData = currentData.ubicacion[currentOtroType];
                if (currentTypeData.isOther) {
                    currentOtroSelect.value = "otro";
                } else {
                    const options = currentOtroSelect.options;
                    for (let i = 0; i < options.length; i++) {
                        if (options[i].value === currentTypeData.value) {
                            currentOtroSelect.value = currentTypeData.value;
                            break;
                        }
                    }
                }
            }

            currentOtroType = "";
            currentOtroSelect = null;
        }

        function saveOtroValue() {
            const input = document.getElementById('otro-input');
            const value = input.value.trim();

            if (!value) {
                alert("Por favor ingresa un valor");
                return;
            }

            currentData.ubicacion[currentOtroType].isOther = true;
            currentData.ubicacion[currentOtroType].otherValue = value;

            const otherDisplay = document.getElementById(`${currentOtroType}-other-display`);
            const otherValueSpan = document.getElementById(`${currentOtroType}-other-value`);

            if (otherDisplay && otherValueSpan) {
                otherValueSpan.textContent = value;
                otherDisplay.style.display = "block";
            }

            closeOtroModal();
        }

        function loadDataToModal(sectionId) {
            const data = currentData[sectionId];

            switch (sectionId) {
                case "datos-generales":
                    document.getElementById("location-edit").value = data.location || "";
                    document.getElementById("identity-edit").value = data.identity || "";
                    document.getElementById("name-edit").value = data.name || "";
                    break;

                case "nombre-rancho":
                    document.getElementById("ranch-name-edit").value = data.ranchName || "";
                    break;

                case "acerca-de":
                    document.getElementById("description-edit").value = data.description || "";
                    break;

                case "ganado":
                    document.getElementById("toros-razas").value = data.toros.join(", ") || "";
                    document.getElementById("vacas-razas").value = data.vacas.join(", ") || "";
                    document.getElementById("aves-razas").value = data.aves.join(", ") || "";
                    document.getElementById("caballos-razas").value = data.caballos.join(", ") || "";
                    break;

                case "ubicacion":
                    const stateSelect = document.getElementById("state-edit");
                    const stateData = data.state;

                    if (stateData.isOther && stateData.otherValue) {
                        stateSelect.value = "otro";
                        document.getElementById("state-other-value").textContent = stateData.otherValue;
                        document.getElementById("state-other-display").style.display = "block";
                    } else {
                        stateSelect.value = stateData.value || "";
                        document.getElementById("state-other-display").style.display = "none";
                    }

                    const municipalitySelect = document.getElementById("municipality-edit");
                    const municipalityData = data.municipality;

                    if (municipalityData.isOther && municipalityData.otherValue) {
                        municipalitySelect.value = "otro";
                        document.getElementById("municipality-other-value").textContent = municipalityData.otherValue;
                        document.getElementById("municipality-other-display").style.display = "block";
                    } else {
                        municipalitySelect.value = municipalityData.value || "";
                        document.getElementById("municipality-other-display").style.display = "none";
                    }

                    const colonySelect = document.getElementById("colony-edit");
                    const colonyData = data.colony;

                    if (colonyData.isOther && colonyData.otherValue) {
                        colonySelect.value = "otro";
                        document.getElementById("colony-other-value").textContent = colonyData.otherValue;
                        document.getElementById("colony-other-display").style.display = "block";
                    } else {
                        colonySelect.value = colonyData.value || "";
                        document.getElementById("colony-other-display").style.display = "none";
                    }

                    document.getElementById("street-edit").value = data.street || "";
                    document.getElementById("number-edit").value = data.number || "";
                    break;

                case "contacto":
                    document.getElementById("phone-edit").value = data.phone || "";
                    document.getElementById("email-edit").value = data.email || "";
                    document.getElementById("facebook-edit").value = data.facebook || "";
                    document.getElementById("instagram-edit").value = data.instagram || "";
                    break;
            }
        }

        function saveData(sectionId) {
            switch (sectionId) {
                case "datos-generales":
                    currentData[sectionId].location = document.getElementById("location-edit").value.trim();
                    currentData[sectionId].identity = document.getElementById("identity-edit").value.trim();
                    currentData[sectionId].name = document.getElementById("name-edit").value.trim();

                    document.getElementById("location-view").textContent = currentData[sectionId].location || "No especificado";
                    document.getElementById("location-view").className = currentData[sectionId].location ? "view-mode" : "view-mode empty";

                    document.getElementById("identity-view").textContent = currentData[sectionId].identity || "No especificado";
                    document.getElementById("identity-view").className = currentData[sectionId].identity ? "view-mode" : "view-mode empty";

                    document.getElementById("name-view").textContent = currentData[sectionId].name || "No especificado";
                    document.getElementById("name-view").className = currentData[sectionId].name ? "view-mode" : "view-mode empty";
                    break;

                case "nombre-rancho":
                    currentData[sectionId].ranchName = document.getElementById("ranch-name-edit").value.trim();
                    document.getElementById("ranch-name-view").textContent = currentData[sectionId].ranchName || "No especificado";
                    document.getElementById("ranch-name-view").className = currentData[sectionId].ranchName ? "view-mode" : "view-mode empty";
                    break;

                case "acerca-de":
                    currentData[sectionId].description = document.getElementById("description-edit").value.trim();
                    document.getElementById("description-view").textContent = currentData[sectionId].description || "No hay descripción disponible";
                    document.getElementById("description-view").className = currentData[sectionId].description ? "view-mode" : "view-mode empty";
                    break;

                case "ganado":
                    currentData[sectionId].toros = document.getElementById("toros-razas").value.split(",").map(r => r.trim()).filter(r => r !== "");
                    currentData[sectionId].vacas = document.getElementById("vacas-razas").value.split(",").map(r => r.trim()).filter(r => r !== "");
                    currentData[sectionId].aves = document.getElementById("aves-razas").value.split(",").map(r => r.trim()).filter(r => r !== "");
                    currentData[sectionId].caballos = document.getElementById("caballos-razas").value.split(",").map(r => r.trim()).filter(r => r !== "");

                    updateLivestockView();
                    break;

                case "ubicacion":
                    const stateSelect = document.getElementById("state-edit");
                    if (stateSelect.value === "otro" && currentData.ubicacion.state.isOther) {
                        currentData.ubicacion.state.value = "otro";
                    } else if (stateSelect.value === "otro") {
                        currentData.ubicacion.state = {
                            value: "otro",
                            isOther: true,
                            otherValue: "Otro"
                        };
                    } else {
                        currentData.ubicacion.state = {
                            value: stateSelect.value,
                            isOther: false,
                            otherValue: ""
                        };
                    }

                    const municipalitySelect = document.getElementById("municipality-edit");
                    if (municipalitySelect.value === "otro" && currentData.ubicacion.municipality.isOther) {
                        currentData.ubicacion.municipality.value = "otro";
                    } else if (municipalitySelect.value === "otro") {
                        currentData.ubicacion.municipality = {
                            value: "otro",
                            isOther: true,
                            otherValue: "Otro"
                        };
                    } else {
                        currentData.ubicacion.municipality = {
                            value: municipalitySelect.value,
                            isOther: false,
                            otherValue: ""
                        };
                    }

                    const colonySelect = document.getElementById("colony-edit");
                    if (colonySelect.value === "otro" && currentData.ubicacion.colony.isOther) {
                        currentData.ubicacion.colony.value = "otro";
                    } else if (colonySelect.value === "otro") {
                        currentData.ubicacion.colony = {
                            value: "otro",
                            isOther: true,
                            otherValue: "Otro"
                        };
                    } else {
                        currentData.ubicacion.colony = {
                            value: colonySelect.value,
                            isOther: false,
                            otherValue: ""
                        };
                    }

                    currentData.ubicacion.street = document.getElementById("street-edit").value.trim();
                    currentData.ubicacion.number = document.getElementById("number-edit").value.trim();

                    updateUbicacionView();
                    break;

                case "contacto":
                    currentData[sectionId].phone = document.getElementById("phone-edit").value.trim();
                    currentData[sectionId].email = document.getElementById("email-edit").value.trim();
                    currentData[sectionId].facebook = document.getElementById("facebook-edit").value.trim();
                    currentData[sectionId].instagram = document.getElementById("instagram-edit").value.trim();

                    document.getElementById("phone-view").textContent = currentData[sectionId].phone || "No especificado";
                    document.getElementById("phone-view").className = currentData[sectionId].phone ? "view-mode" : "view-mode empty";

                    document.getElementById("email-view").textContent = currentData[sectionId].email || "No especificado";
                    document.getElementById("email-view").className = currentData[sectionId].email ? "view-mode" : "view-mode empty";

                    document.getElementById("facebook-view").textContent = currentData[sectionId].facebook || "No especificado";
                    document.getElementById("facebook-view").className = currentData[sectionId].facebook ? "view-mode" : "view-mode empty";

                    document.getElementById("instagram-view").textContent = currentData[sectionId].instagram || "No especificado";
                    document.getElementById("instagram-view").className = currentData[sectionId].instagram ? "view-mode" : "view-mode empty";
                    break;
            }

            closeModal(sectionId);
            showNotification("Cambios guardados correctamente");
        }

        function updateLivestockView() {
            const livestockView = document.getElementById("livestock-view");
            livestockView.innerHTML = "";

            const categories = ["toros", "vacas", "aves", "caballos"];
            const titles = {
                "toros": "Toros",
                "vacas": "Vacas",
                "aves": "Aves",
                "caballos": "Caballos"
            };

            categories.forEach(category => {
                const categoryDiv = document.createElement("div");
                categoryDiv.className = "livestock-category";

                const titleDiv = document.createElement("div");
                titleDiv.className = "category-title";
                titleDiv.textContent = titles[category];

                const breedList = document.createElement("ul");
                breedList.className = "breed-list";

                const breeds = currentData.ganado[category];

                if (breeds.length === 0) {
                    const emptyItem = document.createElement("li");
                    emptyItem.className = "empty";
                    emptyItem.textContent = "No hay razas especificadas";
                    breedList.appendChild(emptyItem);
                } else {
                    breeds.forEach(breed => {
                        const breedItem = document.createElement("li");
                        breedItem.textContent = breed;
                        breedList.appendChild(breedItem);
                    });
                }

                categoryDiv.appendChild(titleDiv);
                categoryDiv.appendChild(breedList);
                livestockView.appendChild(categoryDiv);
            });
        }

        function updateUbicacionView() {
            const stateData = currentData.ubicacion.state;
            const stateValue = stateData.isOther ? stateData.otherValue : stateData.value;
            document.getElementById("state-view").textContent = stateValue || "No especificado";
            document.getElementById("state-view").className = stateValue ? "view-mode" : "view-mode empty";

            const municipalityData = currentData.ubicacion.municipality;
            const municipalityValue = municipalityData.isOther ? municipalityData.otherValue : municipalityData.value;
            document.getElementById("municipality-view").textContent = municipalityValue || "No especificado";
            document.getElementById("municipality-view").className = municipalityValue ? "view-mode" : "view-mode empty";

            const colonyData = currentData.ubicacion.colony;
            const colonyValue = colonyData.isOther ? colonyData.otherValue : colonyData.value;
            document.getElementById("colony-view").textContent = colonyValue || "No especificado";
            document.getElementById("colony-view").className = colonyValue ? "view-mode" : "view-mode empty";

            document.getElementById("street-view").textContent = currentData.ubicacion.street || "No especificado";
            document.getElementById("street-view").className = currentData.ubicacion.street ? "view-mode" : "view-mode empty";

            document.getElementById("number-view").textContent = currentData.ubicacion.number || "No especificado";
            document.getElementById("number-view").className = currentData.ubicacion.number ? "view-mode" : "view-mode empty";
        }

        function showNotification(message) {
            const notification = document.createElement("div");
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background-color: #2196F3;
                color: white;
                padding: 15px 25px;
                border-radius: 6px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.2);
                z-index: 2000;
                animation: slideInRight 0.3s ease;
                font-weight: 600;
            `;
            notification.textContent = message;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.animation = "slideOutRight 0.3s ease";
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);

            if (!document.querySelector('#notification-styles')) {
                const style = document.createElement('style');
                style.id = 'notification-styles';
                style.textContent = `
                    @keyframes slideInRight {
                        from { transform: translateX(100%); opacity: 0; }
                        to { transform: translateX(0); opacity: 1; }
                    }
                    @keyframes slideOutRight {
                        from { transform: translateX(0); opacity: 1; }
                        to { transform: translateX(100%); opacity: 0; }
                    }
                `;
                document.head.appendChild(style);
            }
        }

        document.querySelectorAll('.modal-overlay').forEach(modal => {
            modal.addEventListener('click', function (e) {
                if (e.target === this) {
                    if (this.id === 'modal-otro') {
                        closeOtroModal();
                    } else {
                        const modalId = this.id.replace('modal-', '');
                        closeModal(modalId);
                    }
                }
            });
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('.modal-overlay').forEach(modal => {
                    if (modal.style.display === 'flex') {
                        if (modal.id === 'modal-otro') {
                            closeOtroModal();
                        } else {
                            const modalId = modal.id.replace('modal-', '');
                            closeModal(modalId);
                        }
                    }
                });
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            // Inicializar el nombre del rancho desde el PHP
            const ranchNameElement = document.getElementById("ranch-name-view");
            if (ranchNameElement && ranchNameElement.textContent.trim() !== "") {
                currentData["nombre-rancho"].ranchName = ranchNameElement.textContent.trim();
                // Quitar la clase "empty" si tiene contenido
                if (currentData["nombre-rancho"].ranchName !== "No especificado" && 
                    currentData["nombre-rancho"].ranchName !== "holaaaaa") {
                    ranchNameElement.className = "view-mode";
                }
            }
            
            updateLivestockView();
            updateUbicacionView();
            updateRanchImageView();
            setupDragAndDrop();
        });
    </script>

</html>