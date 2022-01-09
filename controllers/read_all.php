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
$result = $cus->read_all();
$num = $result->rowCount();

if ($num > 0) {
    $cus_arr = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $cus = array(
            'id' => $id,
            'name' => $name,
            'address' => $address,
            'email' => $email,
            'password' => $password
        );
        array_push($cus_arr, $cus);
    }
    echo json_encode($cus_arr);
} else {
    echo json_encode($returnData = msg(0, 404, 'No Data Found'));
}
