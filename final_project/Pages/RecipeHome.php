<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Home Page</title>
    <link rel="stylesheet" href="../Css/Homepage.css">
    <link rel="stylesheet" href="../Css/Navbar.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="../JS/Homepage.js"></script>
</head>
<body>
    <nav>
        <a href="#" id="title">Kitchen Cache</a>
        <ul>
            <li>
                <a href="RecipeHome.php">Home</a>
            </li>
            <li>
                <a href="Contact.html">Contact Us</a>
            </li>
            <li>
                <a href="#">All Recipes</a>
            </li>
            <li>
                <a href="RecipeInput.php">Input Recipe</a>
            </li>
        </ul>
    </nav>

    <div class="RecipeSection">
        <?php 
                include "../Php/db_connect.php";

                try {
                    $query = "SELECT * FROM recipe";
                    $result = $conn->query($query);
                    if($result->rowCount() > 0) {
                        while($row = $result->fetch()) {
                            $name = $row['name'];
                            $id = $row['id'];
                            $image = $row['photo_url'];
                            $diff = $row['difficulty'];
                            $serves = $row['serves'];
                            echo '<a href="Recipe.php?recipeid=' . $id . '">';
                            echo '<div class="card">';
                            echo '<div><img src="' . $image . '" alt="' . $name . '"></div>';
                            echo '<h2>Recipe: ' . $name . '</h2>';
                            echo '<h2>Difficulty: ' . $diff . '</h2>';
                            echo '<h2>Serves: ' . $serves . '</h2>';
                            echo '<input type="hidden" name="id" value="' . $id . '">';
                            echo '</div>';
                            echo '</a>';
                        }
                        $conn = null;
                    }
                } catch (PDOException $e) {
                    echo '<h1>No recipes submitted yet! Submit a new recipe <a href="RecipeInput.php">here!</a>';
                }
                
            ?>
    </div>
    
</body>
</html>