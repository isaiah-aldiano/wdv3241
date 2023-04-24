<?php
    session_start();    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $serverName = "localhost";
        $username = "";
        $password = "";
        $database = "";

        $event_user = $_POST['username'];
        $event_password = $_POST['password'];

        try {
            $conn = new PDO("mysql:host=$serverName;dbname=$database", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT event_user_id FROM event_user WHERE event_user_name = :username AND event_user_password = :password";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $event_user);
            $stmt->bindParam(':password', $event_password);
            $stmt->execute();
            $id = $stmt->fetch();
            $conn = null;

            $_SESSION['logged_in'] = $id ? 1 : 0;

            if($_SESSION['logged_in']) {
                $_SESSION['valid_user'] = True;
            }

        } catch(PDOException $e) {
            $conn = null;

            echo $e->getMessage();
            die("<h1>So Sad :( Database connection failed</h1>");
        }

        if ($_SESSION['logged_in'] and $_SESSION['valid_user']) {

            header('Location: selectEvents.php');
        } else {
            echo '<h1>So Sad :( Invalid login credentials</h1>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="13_2_login.php" method="post">
        Username: <input type="text" name="username" id="username">
        Password: <input type="text" name="password" id="password">

        <input type="submit" name="submit" id="submit">
    </form>
</body>
</html>