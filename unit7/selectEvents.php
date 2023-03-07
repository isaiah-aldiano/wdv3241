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

    table tr + tr {
        
    }
</style>
<body>


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
        }
    catch(PDOException $e)
        {
        echo '<h1>Event table is empty</h1>';
        }



    ?>
</table>

</body>
</html>

