<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once(__DIR__ . '../../config/Database.php');
include_once(__DIR__ . '../../models/Customer.php');

function msg($success, $status, $message = array())
{
    return array_merge(array(
        'success' => $success,
        'status' => $status,
        'message' => $message
    ));
}
$database = new Database();
$db = $database->dbConnection();
$cus = new Customer($db);
$cus->id = isset($_GET['id']) ? $_GET['id'] : die();
$result = $cus->read_single();
$num = $result->rowCount();
$returnData = array();
if ($num > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $cus_arr = array(
            'id' => $id,
            'name' => $name,
            'address' => $address,
            'email' => $email,
            'password' => $password
        );
    }
    echo json_encode($cus_arr);
} else {
    echo json_encode($returnData = msg(0, 404, 'Data Not Found'));
}
