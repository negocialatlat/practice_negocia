<?php

//OBTENER JSON
$input_data = file_get_contents('php://input');
$json = json_decode($input_data, true);

//contenido modal cliente

if (!empty($json['operacionCliente']) && $json['operacionCliente'] == 1) {

  sleep(2);
  $id_cliente = (int) $json['id_cliente'];


  $ClienteTipoDoc = "";
  $ClienteDni = "";

  $ClienteNombre = "";
  $ClienteNomComercial = "";
  $razonsocial = "";
  $ClienteDireccion = "";
  $ClienteDepartamento = "";
  $ClienteProvincia = "";
  $ClienteDistrito = "";
  $ClienteTelefono = "";
  $ClienteFechaNac = "";
  $ClienteEmail = "";
  $ClienteCodigo = "";
  $ClienteIdTipoContacto = "";
  $ClienteNotas = "";

  if (!empty($id_cliente)) {

    $id_empresa = 2;

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.negocia.pe/webservice/app_erp/clientes/ws_clientes.php',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => '{
        "entry": [
            {
                "id_empresa": ' . $id_empresa . ',
                "limit": 25, 
                "id_cliente": ' . $id_cliente . '
            }
        ],
        "hub_verify_token": "neg-tkverify-app"
    }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Bearer hub-verify-token-app'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);


    // Decodificar el JSON recibido
    $data = json_decode($response, true);

    // Verificar si la decodificación fue exitosa
    if (json_last_error() === JSON_ERROR_NONE) {
      // Acceder a los datos del JSON
      $cliente = $data['data'][0]; // Acceder al primer elemento del array "data"
      $ClienteNombre = $cliente['ClienteNombre'];
      $ClienteDni = $cliente['ClienteDni'];
      $ClienteTipoDoc = $cliente['ClienteTipoDoc'];
      $ClienteNomComercial = $cliente['ClienteNomComercial'];
      $razonsocial = $cliente['ClienteNombre'];
      $ClienteDireccion = $cliente['ClienteDireccion'];
      $ClienteDepartamento = $cliente['ClienteDepartamento'];
      $ClienteProvincia = $cliente['ClienteProvincia'];
      $ClienteDistrito = $cliente['ClienteDistrito'];
      $ClienteTelefono = $cliente['ClienteTelefono'];
      $ClienteFechaNac = $cliente['ClienteFechaNac'];
      $ClienteEmail = $cliente['ClienteEmail'];
      $ClienteCodigo = $cliente['ClienteCodigo'];
      $ClienteIdTipoContacto = $cliente['ClienteIdTipoContacto'];
      $ClienteNotas = $cliente['ClienteNotas'];

      // Imprimir los valores del JSON
      // echo "ClienteId: " . $cliente['ClienteId'] . "<br>";
      // echo "ClienteDni: " . $cliente['ClienteDni'] . "<br>";
      // echo "ClienteNombre: " . $cliente['ClienteNombre'] . "<br>";
      // echo "ClienteTelefono: " . $cliente['ClienteTelefono'] . "<br>";
      // echo "ClienteEmail: " . $cliente['ClienteEmail'] . "<br>";
      // echo "ClienteDireccion: " . $cliente['ClienteDireccion'] . "<br>";
      // echo "ClienteFechaNac: " . $cliente['ClienteFechaNac'] . "<br>";
      // echo "ClienteNotas: " . $cliente['ClienteNotas'] . "<br>";

      // // Imprimir las etiquetas (ArrayEtiquetas)
      // echo "<h3>Etiquetas:</h3>";
      // foreach ($cliente['ArrayEtiquetas'] as $etiqueta) {
      //     echo "EtqId: " . $etiqueta['EtqId'] . "<br>";
      //     echo "EtqColor: " . $etiqueta['EtqColor'] . "<br>";
      //     echo "EtqNombre: " . $etiqueta['EtqNombre'] . "<br><br>";
      // }
    } else {
      // Manejar errores de decodificación JSON
      echo "Error al decodificar el JSON: " . json_last_error_msg();
    }

  }


  ?>


  <div class="fcclientes-container ">



    <div class="fcclientes-steps ">





      <div class="fcclientes-eempresa-persona">
        <div class="btn">
          <button type="button" class="fcclientes-button-next-btn" onclick="showForm('persona')">
            Persona</button>
        </div>
        <div class="btn">
          <button type="button" class="fcclientes-button-next-btn" onclick="showForm('empresa')">Empresa</button>
        </div>
      </div>

      <!-- fcc_CA_formulario -->

      <!-- Single form with dynamic fields -->
      <div id="formContainer" class="fcclientes-form" style="display:none;">
        <form id="dynamicForm" class="fromulario">


          <div class="row" style="--bs-gutter-x: 10px;">
          <div class="col-4">
    <label for="fcclientes_tipo_doc">Tipo de Doc.</label>
    <select name="fcclientes_tipo_doc" id="fcclientes_tipo_doc">
        <option value="">Seleccione</option>
        <option value="1" <?php echo ($ClienteTipoDoc == 1) ? 'selected="selected"' : ''; ?>>DNI</option>
        <option value="6" <?php echo ($ClienteTipoDoc == 6) ? 'selected="selected"' : ''; ?>>Ruc</option>
        <option value="4" <?php echo ($ClienteTipoDoc == 4) ? 'selected="selected"' : ''; ?>>Carnet De Extranjeria</option>
        <option value="7" <?php echo ($ClienteTipoDoc == 7) ? 'selected="selected"' : ''; ?>>Pasaporte</option>
        <option value="100" <?php echo ($ClienteTipoDoc == 100) ? 'selected="selected"' : ''; ?>>Ninguno</option>
    </select>
</div>
            <div class="col-4">
              <label for="fcclientes_dni_cliente_proveedor">N° Documento</label>
              <input type="text" id="fcclientes_dni_cliente_proveedor" name="fc_dni" value=" <?php echo $ClienteDni ?> ">
            </div>
            <div class="col-4">
              <button id="fcclientes_btn_cliente_proveedor_consult" type="button"
                style="margin-top: 23px; ">Consultar</button>
            </div>
          </div>

          <div id="fcclientes_personaFields" class="form-fields">
            <label for="fccliente_name">Nombre:</label>
            <input type="text" id="fccliente_name" name="fccliente_name" value="<?php echo $ClienteNombre; ?>">

          </div>


          <!-- Campos para Empresa -->
          <div id="fcclientes_empresaFields" class="form-fields" style="display:none;">
            <div class="fcclientescampos">
              <label for="nombre_comercial">Nombre Comercial:</label>
              <input type="text" id="fcc_nombre_comercial" name="nombre_comercial"
                value=" <?php echo $ClienteNomComercial ?>">
            </div>
            <div class="fcclientescampos">
              <label for="fccliente_razon">Razón Social:</label>
              <input type="text" id="fccliente_razon" name="fccliente_razon" value="<?php echo $razonsocial; ?>">
            </div>
          </div>








          <!--DIRECCION 1-->
          <div class="col-12 ">
            <div style="display: flex;justify-content: space-between;">
              <label>Dirección</label> <!--CLICK MORTRAR - DIRECCION (2)-->
              <!--MULTIPLE-->
              <div type="button" onclick="agregar_direccion();">
                <i class="fcclientes-direccion fa fa-plus-circle"> </i>
                <a class="fcclientes-direccion">
                  Agregar otra dirección</a>
              </div>
              <div id="fcclientes_agregar_cliente_proveedor_direccion_1" style="display: none;">
                <i class="fcclientes-direccion fa fa-plus-circle" type="button"></i>
                <a class="fcclientes-direccion" href="javascript:void(0)"
                  id="fcclientes_cliente_nueva_direccion_1">Agregar otra dirección</a>
              </div>
            </div>
            <textarea class=" fcclientes-imput form-control autosize" rows="1" id="fcclientes_direccion_cliente_proveedor"
              name="fcclientes_direccion_cliente_proveedor"><?php echo $ClienteDireccion ?></textarea>

          </div>

          <!-- ubigeo -->

          <div class="fccubigeo" id="fcclientes_bloque_ubigeo">
            <select id="fcclientes_ubigeo_contacto_1" disabled>
              <option value=" <?php echo $ClienteDepartamento ?>" hidden>Buscar Ubigeo</option>
            </select>
          </div>

          <!-- Departamento, Provincia, Distrito -->
          <div class="col-12 fccdepartamentos">

          <div style="flex: 1;">
    <label>Departamento</label>
    <select name="fccubigeo_departamento_1" id="fccubigeo_departamento_1" class="fccinput-sm">
        <option value="0">Departamento</option> <!-- Eliminado el atributo "hidden" -->
        <option value="01" <?php echo ($ClienteDepartamento == '01') ? 'selected="selected"' : ''; ?>>Amazonas</option>
        <option value="02" <?php echo ($ClienteDepartamento == '02') ? 'selected="selected"' : ''; ?>>Áncash</option>
        <option value="03" <?php echo ($ClienteDepartamento == '03') ? 'selected="selected"' : ''; ?>>Apurímac</option>
        <option value="04" <?php echo ($ClienteDepartamento == '04') ? 'selected="selected"' : ''; ?>>Arequipa</option>
        <option value="05" <?php echo ($ClienteDepartamento == '05') ? 'selected="selected"' : ''; ?>>Ayacucho</option>
        <option value="06" <?php echo ($ClienteDepartamento == '06') ? 'selected="selected"' : ''; ?>>Cajamarca</option>
        <option value="08" <?php echo ($ClienteDepartamento == '08') ? 'selected="selected"' : ''; ?>>Cusco</option>
        <option value="09" <?php echo ($ClienteDepartamento == '09') ? 'selected="selected"' : ''; ?>>Huancavelica</option>
        <option value="10" <?php echo ($ClienteDepartamento == '10') ? 'selected="selected"' : ''; ?>>Huánuco</option>
        <option value="11" <?php echo ($ClienteDepartamento == '11') ? 'selected="selected"' : ''; ?>>Ica</option>
        <option value="12" <?php echo ($ClienteDepartamento == '12') ? 'selected="selected"' : ''; ?>>Junín</option>
        <option value="13" <?php echo ($ClienteDepartamento == '13') ? 'selected="selected"' : ''; ?>>La Libertad</option>
        <option value="14" <?php echo ($ClienteDepartamento == '14') ? 'selected="selected"' : ''; ?>>Lambayeque</option>
        <option value="15" <?php echo ($ClienteDepartamento == '15') ? 'selected="selected"' : ''; ?>>Lima</option>
        <option value="16" <?php echo ($ClienteDepartamento == '16') ? 'selected="selected"' : ''; ?>>Loreto</option>
        <option value="17" <?php echo ($ClienteDepartamento == '17') ? 'selected="selected"' : ''; ?>>Madre de Dios</option>
        <option value="18" <?php echo ($ClienteDepartamento == '18') ? 'selected="selected"' : ''; ?>>Moquegua</option>
        <option value="19" <?php echo ($ClienteDepartamento == '19') ? 'selected="selected"' : ''; ?>>Pasco</option>
        <option value="20" <?php echo ($ClienteDepartamento == '20') ? 'selected="selected"' : ''; ?>>Piura</option>
        <option value="07" <?php echo ($ClienteDepartamento == '07') ? 'selected="selected"' : ''; ?>>Prov. Const. del Callao</option>
        <option value="21" <?php echo ($ClienteDepartamento == '21') ? 'selected="selected"' : ''; ?>>Puno</option>
        <option value="22" <?php echo ($ClienteDepartamento == '22') ? 'selected="selected"' : ''; ?>>San Martín</option>
        <option value="23" <?php echo ($ClienteDepartamento == '23') ? 'selected="selected"' : ''; ?>>Tacna</option>
        <option value="24" <?php echo ($ClienteDepartamento == '24') ? 'selected="selected"' : ''; ?>>Tumbes</option>
        <option value="25" <?php echo ($ClienteDepartamento == '25') ? 'selected="selected"' : ''; ?>>Ucayali</option>
    </select>
</div>

            <div style="flex: 1;">
              <label>Provincia</label>
              <select name="fcclientes_ubigeo_provincia_1" id="fcclientes_ubigeo_provincia_1"
                class="form-control fccinput-sm">
                <option hidden value="<?php echo $ClienteProvincia ?>">Provincia</option>
                <!-- Aquí se pueden agregar las provincias dependiendo del departamento seleccionado -->
              </select>
            </div>

            <div style="flex: 1;">
              <label>Distrito</label>
              <select name="ubigeo_distrito_1" id="ubigeo_distrito_1" class="form-control fccinput-sm">
                <option hidden value="<?php echo $ClienteDistrito ?>">Distrito</option>
                <!-- Aquí se pueden agregar los distritos dependiendo de la provincia seleccionada -->
              </select>
            </div>

          </div>

          <!--CELULAR-->

          <div class="row ">
            <!-- Celular -->
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 ">
              <label>Celular
              </label><br>
              <div class="iti iti--allow-dropdown">
                <div class="iti iti--allow-dropdown">
                  <div class="iti__flag-container">
                    <div class="iti__selected-flag" role="combobox" aria-controls="iti-2__country-listbox"
                      aria-owns="iti-2__country-listbox" aria-expanded="false" tabindex="0" title="Peru (Perú): +51"
                      aria-activedescendant="iti-2__item-pe-preferred">
                      <div class="iti__flag iti__pe"></div>
                      <div class="iti__arrow"></div>
                    </div>

                  </div>
                  <input autocomplete="off" type="cel" class="form-control"
                    id="fcclientes-imput fc_telefono_cliente_proveedor" name="fc_telefono" data-intl-tel-input-id="2"
                    placeholder="912 345 678" value="<?php echo $ClienteTelefono ?>">

                </div>
              </div>
            </div>


            <!-- Fecha de Cumpleaños -->
            <div class="col-6">
              <label for="cumpleanos">Fecha de Cumpleaños</label>
              <input type="date" id="fcc_cumpleanos" class="form-control" value="<?php echo $ClienteFechaNac ?>" />
            </div>
          </div>

          <div id="fcclientes_personaFields" class="form-fields">
            <label for="fcc_email">Correo Eléctronico:</label>
            <input type="email" id="fcc_email" name="fcc_email" value="<?php echo $ClienteEmail ?>">

          </div>

          <!-- codigo cliente -->
          <div class="col-12 ">
            <label class="fcclientes-codigo">Codigo</label>
            <input type="text" class="fcclientes-imput form-control fccinput-sm" id="fc_cod_cliente_proveedor"
              name="fc_cod_cliente_proveedor" value=" <?php echo $ClienteCodigo ?>">

            <div class="result_codigo_auto">
              <div id="spinner_page19d6fcp" hidden="" style="text-align:center;"><img
                  src="https://wuandos3-img-recursos.s3.amazonaws.com/operaciones_img_ajax-loader.gif"><span
                  style="font-size:9pt;">Cargando...</span></div>
              <script>
                $('#fc_cod_cliente_proveedor').val(`1020615`);
              </script>
            </div>
          </div>

          <!-- TAMBIEN ES - NEGOCIA.PE-->
          <div class="col-12 ">
            <label class="container-checkbox">¿También es un
              proveedor?<input type="checkbox" name="fc_tambien_es" id="fc_tambien_es"><span
                class="checkmark-box"></span></label>
          </div>
          <div class="col-12 f">
    <label>Tipo Contacto</label>
    <select aria-label="Tipo Del contacto" id="fc_tipo" name="fc_tipo">
        <option value="0">Seleccione</option>
        <option value="1" <?php echo ($ClienteIdTipoContacto == 1) ? 'selected="selected"' : ''; ?>>Cliente</option>
        <option value="2" <?php echo ($ClienteIdTipoContacto == 2) ? 'selected="selected"' : ''; ?>>Potencial Cliente</option>
        <option value="3" <?php echo ($ClienteIdTipoContacto == 3) ? 'selected="selected"' : ''; ?>>Proveedor</option>
        <option value="4" <?php echo ($ClienteIdTipoContacto == 4) ? 'selected="selected"' : ''; ?>>Potencial Proveedor</option>
        <option value="5" <?php echo ($ClienteIdTipoContacto == 5) ? 'selected="selected"' : ''; ?>>Partner</option>
    </select>
</div>


          <div class="col-12  " style=" padding-bottom: 0px;"><label>Notas</label>
            <textarea class=" fcclientes-imput form-control autosize" rows="" id="fc_notas" name="fc_notas"
              placeholder="Notas"><?php echo $ClienteNotas ?></textarea>
          </div>



          <div class="modal-footer footer_sticky">
            <button type="submit" class="btn" id="fc_guardar_datos_cliente_proveedor"
              onclick="guardar_datos_cliente_proveedor();">
              Guardar
            </button>
            <button id="fcclientes-btn-mas-opciones" type="button" class="btn" onclick="fcclientes_btn_mas_opciones();">
              Más opciones
            </button>
          </div>



        </form>
      </div>


    </div>

    <div class="fcclientes-contents fcclientes-hidden">


      <div class="fccliente-desplegable">
        <div class="fccliente-desplegable-item">
          <div class="fccliente-desplegable-header">
            <img src="iconos\Ícono Contacto asociado.svg" alt="Icono">
            <div class="fcc-AC textos">
              <span>Contactos Asociados</span>
              <p>Agrega información de otros contactos relacionados a este contacto</p>
            </div>
            <div class="fcc-CA icon"><i class="bx bx-chevron-right" id="fcc-CA-icon"></i></div>
          </div>
          <div class="fccliente-desplegable-content">
            <p id="fcc_CA_mensajeVacio">No cuenta con un contacto asociado. <a href="#"
                id="fcc_CA_mostrarFormulario">Click para Asociar</a></p>
            <div class="fcc_CA_formulario" id="fcc_CA_formulario">
              <label for="fcc_CA_nombre" class="fcc_CA_nombreetiqueta">Nombre</label>
              <input type="text" id="fcc_CA_nombre" placeholder="Nombre" />


              <div class="row">
                <!-- Correo -->
                <div class="col-6">
                  <label for="fcc_CA_correo">E-mail</label>
                  <input type="email" id="fcc_CA_correo" class="form-control" placeholder="Correo" />
                </div>

                <!-- Celular -->
                <div class="col-6">
                  <label for="fcc_CA_celular">Celular</label>
                  <div class="iti iti--allow-dropdown w-100">
                    <!-- Asegura que el contenedor sea del mismo ancho -->
                    <div class="iti__flag-container">
                      <div class="iti__selected-flag" role="combobox" aria-controls="iti-2__country-listbox"
                        aria-owns="iti-2__country-listbox" aria-expanded="false" tabindex="0" title="Peru (Perú): +51"
                        aria-activedescendant="iti-2__item-pe-preferred">
                        <div class="iti__flag iti__pe"></div>
                        <div class="iti__arrow"></div>
                      </div>
                    </div>
                    <input autocomplete="off" type="text" id="fcc_CA_celular" name="fc_telefono" class="form-control w-80"
                      placeholder="912 345 678"> <!-- Aplica la clase w-100 -->
                  </div>
                </div>
              </div>
              <!-- .... -->

              <div class="row ">
                <!-- Celular -->
                <div class="col-lg-6 ">
                  <label for="fcc_CA_campo">Cargo</label>
                  <input type="text" id="fcc_CA_campo" class="form-control" placeholder="Cargo" />
                </div>


                <!-- Fecha de Cumpleaños -->
                <div class="col-6">
                  <label for="fcc_CA_fecha">Fecha de Cumpleaños</label>
                  <input type="date" id="fcc_CA_fecha" class="form-control" />
                </div>
              </div>



              <div class="fcc_CA_botones">
                <button class="fcc_CA_boton-cancelar" id="cancelar">Cancelar</button>
                <button class="fcc_CA_boton-guardar" id="guardar">Guardar</button>
              </div>
            </div>
            <div class="column">
              <div class="row fcc_CA_contactos" id="fcc_CA_contactos" style="max-width: 500px; display: flex;"></div>
            </div>

            <p class="fcc_CA_agregarcontacto" id="fcc_CA_agregarcontacto">+ Agregar otro contacto</p>
          </div>
        </div>

        <div class="fccliente-desplegable-item">
          <div class="fccliente-desplegable-header">
          <img src="iconos\Ícono Datos Distribución SVG.svg" alt="Icono">

            <div class="fcc-DD textos">
              <span>Datos Distribución</span>
              <p>Define datos importantes para el trabajo de tus productos hacia este cliente</p>
            </div>

            <div class="fcc_DD icon "><i class="bx bx-chevron-right"></i></div>
          </div>
          <div class="fccliente-desplegable-content">

            <div class="fcc_form-container">
              <div class="fcc_form-group">
                <label for="fcc_DD_ruta">Ruta</label>
                <select id="fcc_DD_ruta" name="fcc_DD_ruta">
                  <option value="">- Seleccionar -</option>
                  <option value="ruta1">Ruta 1</option>
                  <option value="ruta2">Ruta 2</option>
                </select>
              </div>
              <div class="fcc_form-group">
                <label for="fcc_DD_zona">Zona</label>
                <select id="fcc_DD_zona" name="fcc_DD_zona">
                  <option value="">- Seleccionar -</option>
                  <option value="zona1">Zona 1</option>
                  <option value="zona2">Zona 2</option>
                </select>
              </div>
            </div>
            <div class="fcc_form-group">
              <label for="fcc_DD_vendedor">Vendedor asignado</label>
              <input type="text" id="fcc_DD_vendedor" name="fcc_DD_vendedor" placeholder="Buscar">
            </div>
            <div class="fcc_form-group">
              <label for="fcc_DD_coordenadas">Coordenadas Maps</label>
              <input type="text" id="fcc_DD_coordenadas" name="fcc_DD_coordenadas" placeholder="Introduce una ubicación">
            </div>
            <div class="fcc_DD_map" id="fcc_DD_map">
              <!-- Mapa embebido -->
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15605.824455555005!2d-77.0427939!3d-12.0463731!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTLCsDAyJzQ4LjkiUyA3N8KwMDInMzguMiJX!5e0!3m2!1ses!2spe!4v1615560382034!5m2!1ses!2spe"
                width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>

          </div>
        </div>

        <div class="fccliente-desplegable-item">
          <div class="fccliente-desplegable-header">
          <img src="iconos\Ícono campos adicionales SVG.svg" alt="Icono">

            <div class="fcc-CA textos">
              <span>Campos Adicionales</span>
              <p>Agrega información adicional para este contacto de manera personalizada</p>
            </div>
            <div class="fcc_CA icon "><i class="bx bx-chevron-right"></i></div>
          </div>
          <div class="fccliente-desplegable-content">

            <div class="fcc_form-container">
              <div class="fcc_form-group">
                <label for="fcc_CA_Composicion">Composición Quimica</label>
                <input type="text" id="fcc_CA_Composicion" name="fcc_CA_Composicion" placeholder="Buscar composición">
              </div>
              <div class="fcc_form-group">
                <label for="fcc_CA_placa">Placa</label>
                <input type="text" id="fcc_CA_placa" name="fcc_CA_placa" placeholder="Buscar Placa">

              </div>


            </div>
            <div class="fcc-CA-agregar-ca">
              <p class="" id="">+ Agregar campo adicional</p>
            </div>


          </div>
        </div>

        <div class="fccliente-desplegable-item">
          <div class="fccliente-desplegable-header">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt"
              viewBox="0 0 16 16">
              <path
                d="M12 0c0 .282-.051.556-.146.804A1.995 1.995 0 0 0 10 3c0 .27.05.535.147.781C10.847 4.656 11 4.964 11 5.5c0 .905-.77 1.25-1.553 2.239-.509.654-.823 1.05-1.447 1.512-.624-.462-.938-.858-1.447-1.512C4.77 6.75 4 6.405 4 5.5c0-.536.153-.844.853-1.719C5.05 3.535 5 3.27 5 3a2 2 0 0 0-1.854-2.196C3.051.556 3 0 .001 0 .001 3.145 5 8.128 8 16c3-7.872 7.999-12.855 7.999-16C15.999 0 12 0 12 0z" />
            </svg>
            <div class="fcc-LP textos">
              <span>Lista de Precios</span>
              <p>Establece una lista de precios de productos preestablecida para est cliente</p>
            </div>
            <div class="fcc_LP icon "><i class="bx bx-chevron-right"></i></div>
          </div>
          <div class="fccliente-desplegable-content">


            <div class="fcc_LP_content">

              <select id="fcc_LP_elijep" name="fcc_LP_elijep">
                <option value="">Elije una lista de precios</option>
                <option value="precio1">Precio 1</option>
                <option value="precio2">Precio 2</option>
              </select>
            </div>



          </div>



        </div>
      </div>



    </div>

  </div>








  <?php
  exit();
}




?>