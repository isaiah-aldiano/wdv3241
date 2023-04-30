<?php
    $serverName = "localhost";
    $db_username = "persist_app_user";
    $db_password = "Wizard101!2";
    $database = "recipe_project";
    
    
    try {
        $conn = new PDO("mysql:host=$serverName; dbname=$database;", $db_username, $db_password);
    
        // Set the PDO error mode to exception
        // ATTR_ERRMODE: Error Reporting type, ERRMODE_EXCEPTION: Throw Exceptions
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    
        return 1;
    } catch(PDOException $e) {
        // write_log('Connection Failed', 'debug.log');
        // write_log($e->getMessage(), 'debug.log');
    
        set_connection_exception_handler($conn, $e);
        echo 'That didn\'t work2222';

    }
?>