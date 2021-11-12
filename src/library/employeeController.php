<?php

require("./employeeManager.php");
$_POST = json_decode(file_get_contents('php://input', true), true);

$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'POST') {
    var_dump($_POST['data']);
    if (addEmployee($_POST['data'])) {
        echo json_encode("employee created succesfully");
    } else {
        echo json_encode("error ");
    }
};

// if ($method == 'PUT') {
// };

// if ($method == 'PATCH') {
// };

if ($method === 'GET') {
    $json_data = file_get_contents('../../resources/employees.json');
    $data = json_decode($json_data, true);
    $a = array_filter($data, function ($employee) {
        return $employee->id !== $_GET['id'];
    });
    file_put_contents('../../resources/employees.json', json_encode($a));
}
