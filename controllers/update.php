<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json;charset=UTF-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

function msg($success, $status, $message = array())
{
    return array_merge(array(
        'success' => $success,
        'status' => $status,
        'message' => $message
    ));
}
include_once(__DIR__ . '../../config/Database.php');
include_once(__DIR__ . '../../models/Customer.php');

$database = new Database();
$db = $database->dbConnection();
$cus = new Customer($db);

$data = json_decode(file_get_contents("php://input"));
$returnData = array();

$cus->id = $data->id;
$cus->name = $data->name;
$cus->address = $data->address;
$cus->email = $data->email;
$cus->password = $data->password;

if ($cuc->id != null && $cus->name != null && $cus->address != null && $cus->email != null && $cus->password != null) {
    $cus->update();
    echo json_encode($returnData = array(
        'success' => 1,
        'status' => 201,
        'message' => 'Customer updated.',
    ));
} else {
    echo json_encode($returnData = msg(0, 422, 'Data could not be updated'));
}
