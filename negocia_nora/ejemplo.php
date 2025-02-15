
<?php
//OBTENER JSON
$input_data = file_get_contents('php://input');
$json = json_decode($input_data, true);




//OBTENER DATOS
if(!empty($json['operacionCliente']) && $json['operacionCliente'] == 1){
    header('Content-Type: application/json'); // Asegura que la respuesta sea JSON

    $id_cliente = $json['id_cliente'];
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
    CURLOPT_POSTFIELDS =>'{
        "entry": [
            {
                "id_empresa": '.$id_empresa.',
                "limit": 25, 
                "id_cliente": '.$id_cliente.'
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
    echo $response;



    exit();
}






?>

<script>

const myHeaders = new Headers();
myHeaders.append("Content-Type", "application/json");
const raw = JSON.stringify({
      "operacionCliente": 1,
      "id_cliente": 139003
});

const requestOptions = {
  method: "POST",
  headers: myHeaders,
  body: raw,
  redirect: "follow"
};

fetch("./ejemplo.php", requestOptions)
  .then((response) => response.json())  // Cambia .text() a .json()
  .then((result) => console.log(result))  // Aquí result será un objeto JSON
  .catch((error) => console.error(error));
</script>