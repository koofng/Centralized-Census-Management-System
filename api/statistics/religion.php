<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With');

    $host = 'localhost';
    $dbName = 'ccmsdb';
    $table = 'tbl_registered_citizens';
    $user = 'root';
    $password = '';
    $conn;

    
    try {
        $conn = new PDO('mysql:host='.$host . ';dbname=' .$dbName,$user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt1 = $conn->prepare('SELECT * FROM ' . $table . ' WHERE religion = "Christian"');
        $stmt2 = $conn->prepare('SELECT * FROM ' . $table . ' WHERE religion = "Islam"');
        $stmt3 = $conn->prepare('SELECT * FROM ' . $table . ' WHERE religion = "Others"');

        $stmt1->execute();
        $stmt2->execute();
        $stmt3->execute();

        $result1 = $stmt1->rowCount();
        $result2 = $stmt2->rowCount();
        $result3 = $stmt3->rowCount();
    } catch (PDOException $e) {
        echo 'Connection Unsuccessful: ' . $e->getMessage();
    }    

    $data = array(
        'Christianity' => $result1,
        'Islam' => $result2,
        'Others' => $result3
    ); 
    print_r(json_encode($data));
?>