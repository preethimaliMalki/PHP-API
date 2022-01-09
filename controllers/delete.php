<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
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
$data = json_decode(file_get_contents("php://input"));
$cus->id = $data->id;
$result = $cus->delete_customer();
$num = $result->rowCount();
$returnData = array();
if ($num > 0) {
    echo json_encode($returnData = array(
        'success' => 1,
        'status' => 200,
        'message' => 'Customer Deleted.',
    ));
} else {
    echo json_encode($returnData = msg(0, 422, 'Customer could not be deleted.'));
}
