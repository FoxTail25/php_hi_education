<?php

	

    $host = DB_HOST;
    $db = DB_NAME;
    $user = DB_USER;
    $pass = DB_PASS;
    $charset = 'utf8';

    $dsn = "mysql:host=$host; dbname=$db; charset=$charset";
    
    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    try {
        $pdo = new PDO($dsn, $user, $pass, $opt);
        // echo 'DB is connected';
        $connect_msg = 'DB is connected';
        $connect = true;
    } catch(PDOException $e) {
        // echo "Connection failed: " . $e->getMessage();
        $connect_msg = "Connection failed: " . $e->getMessage();
        $connect = false;
    }
    return ['pdo'=>$pdo, 'connect_msg'=>$connect_msg, 'connect' => $connect];
?>