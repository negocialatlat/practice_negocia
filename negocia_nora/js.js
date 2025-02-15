// funcion abrir modad 

      //ABRIR MODAL
      $(function () {
        $('#fcclientes-modal').modal('show');
        obtener_data_cliente(0) ;

        
      });



      //CONTENEDOR PRINCIPAL DE USERS
      document.addEventListener("DOMContentLoaded", () => {


        const steps = document.querySelectorAll(".fcclientes-step");
        const contents = document.querySelectorAll(".fcclientes-content");
        const nextButtons = document.querySelectorAll(".fcclientes-button-next-btn");
        const prevButtons = document.querySelectorAll(".fcclientes-button-prev-btn");

        let currentStep = 1;

        function showStep(step) {
          steps.forEach((s, index) => {
            s.classList.toggle("active", index + 1 === step);
          });

          contents.forEach((content) => {
            content.classList.toggle("fcclientes-hidden", content.getAttribute("fcclientes-content-data") != step);
          });

          currentStep = step;
          // Desplazar horizontalmente al paso correspondiente
          const content = document.querySelector(`.fcclientes-content[fcclientes-content-data="${step}"]`);
          document.querySelector(".fcclientes-contents").scrollTo({
            left: content.offsetLeft,
            behavior: "smooth"
          });
        }

        nextButtons.forEach((button) => {
          button.addEventListener("click", () => {
            if (currentStep < steps.length) {
              showStep(currentStep + 1);
            }
          });
        });

        prevButtons.forEach((button) => {
          button.addEventListener("click", () => {
            if (currentStep > 1) {
              showStep(currentStep - 1);
            }
          });
        });

        steps.forEach((step) => {
          step.addEventListener("click", () => {
            const stepNumber = parseInt(step.getAttribute("fcclientes-step-data"));
            showStep(stepNumber);
          });
        });
      });


      //3. PREFERENCIAS
      document.querySelectorAll('.fcclientes-preferencias-step').forEach(fusers_tab => {
        fusers_tab.addEventListener('click', () => {
          // Cambiar la clase activa en los fcclientes-preferencias-steps
          document.querySelectorAll('.fcclientes-preferencias-step').forEach(t => t.classList.remove('active'));
          fusers_tab.classList.add('active');

          // Mostrar el contenido correspondiente
          const tabId = fusers_tab.getAttribute('fcclientes-preferencias-step-data');
          document.querySelectorAll('.fcclientes-preferencias-content').forEach(content => {
            content.classList.remove('active');
          });
          document.getElementById('fcclientes-preferencias-content-' + tabId).classList.add('active');
        });
      });




 // Función que se ejecuta al abrir el modal
      function openModal() {
        
        document.getElementById('formContainer').style.display = 'none';
        document.querySelector('.modal-body').classList.remove('scrollable');

        // Resetear el fcc_CA_formulario
        document.getElementById('dynamicForm').reset();
        updateDocumentTypeOptions('persona'); // Por defecto, mostrar opciones de persona
        document.getElementById('fcclientes_personaFields').style.display = 'none';
        document.getElementById('fcclientes_empresaFields').style.display = 'none';
      }

      function showForm(clienteTipo) {
        // Muestra el fcc_CA_formulario correspondiente
        document.getElementById('formContainer').style.display = 'block';

        // Agrega la clase scrollable al modal-body
        document.querySelector('.modal-body').classList.add('scrollable');

        // Oculta los campos de persona o empresa según el tipo
        if (clienteTipo === '1') {

          const boton = document.getElementById('fcc_btn_persona');

    // Cambiar el color de fondo a naranja
    boton.style.background = 'orange';

    // Cambiar el color del texto a blanco
    boton.style.color = 'white';
          
          document.getElementById('fcclientes_personaFields').style.display = 'block';
          document.getElementById('fcclientes_empresaFields').style.display = 'none';

          // Cambia el tipo de documento a "DNI"
          document.getElementById('fcclientes_tipo_doc').value = "1"; // Asumiendo que "1" es el valor para DNI

          // Actualiza las opciones del select
          updateDocumentTypeOptions('persona');
        } else if (clienteTipo === '6') {
          const boton = document.getElementById('fcc_btn_empresa');

    // Cambiar el color de fondo a naranja
    boton.style.background = 'orange';

    // Cambiar el color del texto a blanco
    boton.style.color = 'white';
          document.getElementById('fcclientes_empresaFields').style.display = 'block';
          document.getElementById('fcclientes_personaFields').style.display = 'none';

          // Cambia el tipo de documento a "RUC"
          document.getElementById('fcclientes_tipo_doc').value = "6"; // Asumiendo que "6" es el valor para RUC

          // Actualiza las opciones del select
          updateDocumentTypeOptions(clienteTipo === '6' ? 'empresa' : 'persona');
        }
      }

      function updateDocumentTypeOptions(type) {
        const select = document.getElementById('fcclientes_tipo_doc');
        select.innerHTML = ''; // Limpiar opciones

        if (type === 'persona') {
          select.innerHTML += '<option value="">Seleccione</option>';
          select.innerHTML += '<option value="1" selected="selected">DNI</option>';
          select.innerHTML += '<option value="4">Carnet De Extranjería</option>';
          select.innerHTML += '<option value="7">Pasaporte</option>';
          select.innerHTML += '<option value="100">Ninguno</option>';
        } else if (type === 'empresa') {
          select.innerHTML += '<option value="">Seleccione</option>';
          select.innerHTML += '<option value="6" selected="selected">RUC</option>';
        }
      }

      function hideForm() {
        document.getElementById('formContainer').style.display = 'none';
        document.querySelector('.modal-body').classList.remove('scrollable');

        // Resetear el fcc_CA_formulario
        document.getElementById('dynamicForm').reset();
        updateDocumentTypeOptions('persona'); // Por defecto, mostrar opciones de persona
        document.getElementById('fcclientes_personaFields').style.display = 'none';
        document.getElementById('fcclientes_empresaFields').style.display = 'none';
      }
function fcclientes_btn_mas_opciones(){
  document.getElementById('fcclientes-btn-mas-opciones').classList.add('d-none');

  fcc_acordiones();
   
        // Modificar fcclientes-container
        const container = document.querySelector('.fcclientes-container');
        if (container) {
          container.style.display = 'grid';
          container.style.gridTemplateColumns = '0.5fr 1fr';
        }

         

        // Modificar fcclientes-container
        const content = document.querySelector('.fcclientes-contents');
        if (content) {
          content.classList.remove('fcclientes-hidden');
          content.scrollIntoView({ behavior: "smooth", block: "start" });
        }
}
      



// function de los acordiones 
function fcc_acordiones() {
                      // Selecciona todos los fcc_CA_botones de toggle dentro del acordeón
                      const toggleButtons = document.querySelectorAll(".fccliente-desplegable-header");

                      toggleButtons.forEach(header => {
                        header.addEventListener("click", () => {
                          const content = header.nextElementSibling; // Encuentra el contenido asociado
                          const icon = header.querySelector(".icon i"); // Encuentra el ícono dentro del header

                          // Alternar el estado del acordeón actual
                          if (content.style.display === "block") {
                            content.style.display = "none";
                            icon.classList.remove("bx-chevron-down");
                            icon.classList.add("bx-chevron-right");
                            header.style.borderLeft = "none"; // Eliminar borde del header
                            content.style.borderLeft = "none"; // Eliminar el borde cuando se oculta
                          } else {
                            content.style.display = "block";
                            icon.classList.remove("bx-chevron-right");
                            icon.classList.add("bx-chevron-down");
                            header.style.borderLeft = "4px solid #ff9c00"; // Agregar borde al header
                            content.style.borderLeft = "4px solid #ff9c00"; // Agregar el borde izquierdo
                          }
                        });
                      });

                      // Array para almacenar los contactos
                      let contactos = [];

                      // Elementos del DOM
                      const formulario = document.getElementById('fcc_CA_formulario');
                      const mensajeVacio = document.getElementById('fcc_CA_mensajeVacio');
                      const listaContactos = document.getElementById('fcc_CA_contactos');
                      const botonAgregarContacto = document.getElementById('fcc_CA_agregarcontacto');
                      const botonGuardar = document.getElementById('guardar');
                      const botonCancelar = document.getElementById('cancelar');

                      // Mostrar/ocultar formulario
                      document.getElementById('fcc_CA_mostrarFormulario').addEventListener('click', function (e) {
                        e.preventDefault();
                        formulario.style.display = 'block';
                        mensajeVacio.style.display = 'none';

                      });

                      // Cancelar formulario
                      botonCancelar.addEventListener('click', function (e) {
                        e.preventDefault();
                        formulario.style.display = 'none'; // Ocultar el formulario
                        limpiarFormulario(); // Limpiar los campos del formulario

                        // Mostrar el div de contactos y el botón "+ Agregar contacto"
                        if (listaContactos.children.length === 0) {
                          mensajeVacio.style.display = "block"; // Si no hay fcc_CA_contactos, mostrar "Click para Asociar"
                        } else {
                          listaContactos.style.display = "flex"; // Mostrar lista de fcc_CA_contactos
                          botonAgregarContacto.style.display = "block"; // Mostrar "+ Agregar otro contacto"
                        }
                      });

                      // Guardar contacto
                      botonGuardar.addEventListener('click', function (e) {
                        e.preventDefault();
                        const nombre = document.getElementById('fcc_CA_nombre').value;
                        const correo = document.getElementById('fcc_CA_correo').value;
                        const celular = document.getElementById('fcc_CA_celular').value;
                        const cargo = document.getElementById('fcc_CA_campo').value;
                        const fecha = document.getElementById('fcc_CA_fecha').value;

                        if (nombre && correo && celular && cargo && fecha) {
                          const contacto = {
                            nombre,
                            correo,
                            celular,
                            cargo,
                            fecha
                          };

                          console.log(contacto)

                          // Verificar si estamos editando un contacto existente
                          const indiceEdicion = formulario.getAttribute('data-indice');
                          if (indiceEdicion !== null) {
                            contactos[indiceEdicion] = contacto;
                            formulario.removeAttribute('data-indice');
                          } else {
                            contactos.push(contacto);
                          }

                          actualizarListaContactos();
                          limpiarFormulario();
                          formulario.style.display = 'none';
                          mensajeVacio.style.display = 'none';
                          listaContactos.style.display = 'flex';
                          botonAgregarContacto.style.display = "block"; // Mostrar "+ Agregar otro contacto"

                        }
                        else {
                          alert('Por favor, completa todos los campos.');
                        }
                      });

                      // Agregar otro contacto
                      botonAgregarContacto.addEventListener('click', function (e) {
                        e.preventDefault();
                        formulario.style.display = 'block';
                        listaContactos.style.display = 'none';

                        botonAgregarContacto.style.display = "none "; // Mostrar "+ Agregar otro contacto"
                        if (contactos.length > 0) {

                          listaContactos.style.display = 'none'; // Mostrar el div de contactos si hay contactos
                        }
                        limpiarFormulario();
                      });

                      // Función para actualizar la lista de contactos
                      function actualizarListaContactos() {
                        listaContactos.innerHTML = '';
                        contactos.forEach((contacto, indice) => {
                          const col6 = document.createElement('div');
                          col6.className = 'col-6 col-xs-12 mb-3'; // agregamos mb-3 para margen inferior
                          const contactoElemento = document.createElement('div');
                          contactoElemento.className = 'fcc_CA_contacto p-3'; // agregamos p-3 para padding
                          contactoElemento.innerHTML = `
                                <p class="mb-1"><strong>Nombre:</strong> ${contacto.nombre}</p>
                                <p class="mb-1"><strong>Correo:</strong> ${contacto.correo}</p>
                                <p class="mb-1"class="mb-1"><strong>Celular:</strong> ${contacto.celular}</p>
                                <p class="mb-1"><strong>Cargo:</strong> ${contacto.cargo}</p>
                                <p class="mb-1"><strong>Fecha de Cumpleaños:</strong> ${contacto.fecha}</p>
                               <div class="btncontactos d-flex justify-content-end gap-2">
  <button class="editar btn " data-indice="0">
    <i class="fas fa-edit"></i>
  </button>
  <button class="eliminar btn" data-indice="0">
    <i class="fas fa-trash"></i>
  </button>
</div>
                                                           `;

                          col6.appendChild(contactoElemento);
                          listaContactos.appendChild(col6);
                        });

                        // Agregar eventos a los botones de editar y eliminar
                        document.querySelectorAll('.editar').forEach(boton => {
                          boton.addEventListener('click', function () {
                            const indice = this.getAttribute('data-indice');
                            cargarFormularioParaEdicion(indice);
                            listaContactos.style.display = 'none';
                            botonAgregarContacto.style.display = "none ";
                          });
                        });
                        document.querySelectorAll('.eliminar').forEach(boton => {
                          boton.addEventListener('click', function () {
                            if (confirm("¿Estás seguro de que deseas eliminar este contacto?")) {
                              const indice = this.getAttribute('data-indice');
                              contactos.splice(indice, 1);
                              actualizarListaContactos();
                              if (contactos.length === 0) {
                                mensajeVacio.style.display = 'block';
                                botonAgregarContacto.style.display = "none ";
                              }
                            }
                           
                          });
                        });
                      }

                      // Función para cargar el formulario con los datos de un contacto para editar
                      function cargarFormularioParaEdicion(indice) {
                        const contacto = contactos[indice];
                        document.getElementById('fcc_CA_nombre').value = contacto.nombre;
                        document.getElementById('fcc_CA_correo').value = contacto.correo;
                        document.getElementById('fcc_CA_celular').value = contacto.celular;
                        document.getElementById('fcc_CA_campo').value = contacto.cargo;
                        document.getElementById('fcc_CA_fecha').value = contacto.fecha;
                        formulario.setAttribute('data-indice', indice);
                        formulario.style.display = 'block';
                      }

                      // Función para limpiar el formulario
                      function limpiarFormulario() {
                        document.getElementById('fcc_CA_nombre').value = '';
                        document.getElementById('fcc_CA_correo').value = '';
                        document.getElementById('fcc_CA_celular').value = '';
                        document.getElementById('fcc_CA_campo').value = '';
                        document.getElementById('fcc_CA_fecha').value = '';
                        formulario.removeAttribute('data-indice');
                      }


                    };

                  


                    function obtener_data_cliente(id_cliente) {
                      // Mostrar el spinner de carga
                      document.getElementById('loadingSpinner').classList.remove('d-none');
                      document.getElementById('fcclientes-formulario').classList.add('d-none');
                  
                      const myHeaders = new Headers();
                      myHeaders.append("Content-Type", "application/json");
                  
                      const raw = JSON.stringify({
                          "operacionCliente": 1,
                          "id_cliente": id_cliente
                      });
                  
                      const requestOptions = {
                          method: "POST",
                          headers: myHeaders,
                          body: raw,
                          redirect: "follow"
                      };
                  
                      fetch("./crud_data_cliente.php", requestOptions)
                      .then((response) => response.text())  // Convertir la respuesta a texto (HTML)
                      .then((html) => {
                          // Ocultar el spinner de carga
                          document.getElementById('loadingSpinner').classList.add('d-none');
                  
                          // Mostrar el formulario y llenarlo con el HTML obtenido
                          const formularioDiv = document.getElementById('fcclientes-formulario');
                          formularioDiv.innerHTML = html;  // Insertar el HTML en el div
                          formularioDiv.classList.remove('d-none');  // Mostrar el div
                  
                          // Extraer y ejecutar el código JavaScript del HTML
                          const scripts = formularioDiv.getElementsByTagName('script');
                          for (let i = 0; i < scripts.length; i++) {
                              const scriptContent = scripts[i].innerHTML;
                              if (scriptContent) {
                                  // Ejecutar el código JavaScript usando eval (ten cuidado con eval por razones de seguridad)
                                  eval(scriptContent);
                              }
                          }
                      })
                      .catch((error) => {
                          console.error(error);  // Manejar errores
                          document.getElementById('loadingSpinner').classList.add('d-none');  // Ocultar el spinner en caso de error
                      });
                  }

                    
                  