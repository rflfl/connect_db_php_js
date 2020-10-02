<?php
require_once('con_db.php');

$conn = mysqli_connect($host, $user, $pass, $db );

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}else{
    
    $query = mysqli_query($conn, "SELECT * FROM registros WHERE destaque = 'Destaque'");
    $img = mysqli_query($conn, "SELECT * FROM images WHERE flag = '0'");
    mysqli_close($conn);
    $data = array();
    foreach ($query as $key => $value) {
        foreach ($img as $key => $val) {
            if ($value['codigo'] == $val['codigo_reg']) {
                array_push($value, ['link_thumb' => $val['link_thumb']]);
            }
        }
        array_push($data, $value);
    }
    $response = json_encode($data);
    echo $response;
    return $response;
        
}
