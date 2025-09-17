<?php
$data = file_get_contents("php://input");

if (!empty($data)) {
    $file = __DIR__ . "/../../public/data/usuarios.json";
    if (file_put_contents($file, $data)) {
        echo json_encode(["status" => "success", "message" => "Usuarios guardados correctamente"]);
    } else {
        echo json_encode(["status" => "error", "message" => "No se pudo guardar el archivo"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "No se recibieron datos"]);
}
