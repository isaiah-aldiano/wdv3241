<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(($_POST['honeyPot']) != '') {
            die("<h1>You bot</h1>");
        }

        $serverName = "localhost";
        $username = "wdv341_user";
        $password = "wdv341_password!";
        $database = "wdv341";

        $name = $_POST['name'];
        $desc = $_POST['description'];
        $presenter = $_POST['presenter'];
        $date = $_POST['userDate'];

        $date = str_replace('/', '-', $date);
        $date = date("Y-m-d", strtotime($date));

        $time = $_POST['userTime'];

        $replace = "/[a-zA-Z\s]/";
        $time = preg_replace($replace, "", $time);
    
        try {
            $conn = new PDO("mysql:host=$serverName;dbname=$database", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = 'INSERT INTO wdv341_events (name, description, presenter, date, time, date_inserted, date_updated) VALUES (:name, :desc, :presenter, :date, :time, :date1, :date2)';

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':desc', $desc);
            $stmt->bindParam(':presenter', $presenter);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':time', $time);
            $stmt->bindParam(':date1', $date);
            $stmt->bindParam(':date2', $date);

            if($stmt->execute()) {
                echo "<h1>New record added to db</h1>";
            } 

            $conn = null;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            die("<h1>So Sad :( Database connection failed</h1>");
        }
        }
?>

<!DOCTYPE html>
<html lang="en">
<style>
    h1 {
        color: red;
    }
    
    table {
        border: 1px solid black;
    }

    table th {
        padding: 0 3rem;
    }

    table td {
        padding: 0 1rem;
    }

    table td + td { 
        border-left:2px solid black; 
    }

    textarea {
        resize: none;
    }
</style>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href)
    }
    function setElement() {
        let eventForm =document.querySelector("#eventForm")
        eventForm.addEventListener("submit", () => {
            let userDateTime = new Date().toLocaleString()
            dateTime = userDateTime.split(", ")
            console.log(dateTime)

            document.querySelector("#userDate").value =dateTime[0]
            document.querySelector("#userTime").value =dateTime[1]
        })
    }
</script>
<body onload="setElement()">

<form action="selectEvents.php" method="post" id="eventForm">
    <div id="eventItem">
        <label for="name">Project Name</label>
        <input type="text" name="name" id="">
    </div>

    <div id="eventItem">
        <label for="presenter">Presenter</label>
        <input type="text" name="presenter" id="">
    </div>

    <div id="eventItem">
        <label for="description">Description</label> <br>
        <textarea name="description" id="" cols="35" rows="5"></textarea>
    </div>
    <input type="hidden" name="userDate" id="userDate">
    <input type="hidden" name="userTime" id="userTime">
    <input type="hidden" name="honeyPot" id="honeyPot">

    <input type="submit" name="submit" id="submit">
</form>

<table>
    
    <?php
    $serverName = "localhost";
    $username = "wdv341_user";
    $password = "wdv341_password!";
    $database = "wdv341";

    try {
        $conn = new PDO("mysql:host=$serverName;dbname=$database", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = ('SELECT * FROM wdv341_events');

        $results = $conn->query($sql);
        if ($results->rowCount() > 0)
        echo '<tr>
            <th>ID</th>
            <th>NAME</th>
            <th>PRESENTER</th>
            <th>DESCRIPTION</th>
            <th>DATE</th>
            <th>TIME</th>
            <th>DATE ADDED</th>
            <th>DATE UPDATED</th>
            </tr> ';
        
            while ($row = $results->fetch()) {
                echo '<tr>
                    <td>' . $row['id'] . '</td>
                    <td>' . $row['name'] . '</td>
                    <td>' . $row['presenter'] . '</td>
                    <td>' . $row['description'] . '</td>
                    <td>' . $row['date'] . '</td>
                    <td>' . $row['time'] . '</td>
                    <td>' . $row['date_inserted'] . '</td>
                    <td>' . $row['date_updated'] . '</td>
                </tr>';
            }
            $conn = null;
        }
    catch(PDOException $e)
        {
        echo '<h1>Event table is empty</h1>';
        }
    ?>
</table>

</body>
</html>

