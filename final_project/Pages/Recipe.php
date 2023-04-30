<?php
    function modify_ingredient($ingredient, $multiplier) {
        preg_match_all('/\d+(\.\d+)?\/?\d*/', $ingredient, $matches);
        foreach ($matches[0] as $match) {
          $modified_match = $match * $multiplier;
          $ingredient = str_replace($match, $modified_match, $ingredient);
        }
        return $ingredient;
    }

    if(isset($_GET['recipeid'])) {
        include '../Php/db_connect.php';

        $query = 'SELECT * FROM recipe WHERE id = :recipeid';

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':recipeid', $_GET['recipeid'], PDO::PARAM_INT);

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/Navbar.css">
    <link rel="stylesheet" href="../Css/Recipe.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="../JS/DisplayRecipe.js"></script>
    <script>
        <?php 
            $instructions = explode(",", $result['instructions']);
            $ingredients = explode(",", $result['ingredients']);

            $json_ingredients = json_encode($ingredients);
            $json_instructions = json_encode($instructions)
        ?>

        let parsed_ingredients = <?php echo $json_ingredients?>;
        let parsed_instructions = <?php echo $json_instructions?>;
        
    </script>

    <title><?php echo $result['name']?></title>
</head>
<body onload="AddEventListeners()">
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


    <div id="RecipeSection">
        <div id="RecipeHeader">
            <div id="RecipeTitle">
                <h1><?php echo $result['name']?></h1> 
            </div>

            <div id="Image">
                <img src="<?php echo $result['photo_url']?>" alt="<?php echo $result['name']?>">
            </div>

            <div id="servings">
                <div id="info">
                    <h1>Serves: <?php echo $result['serves']?> | Difficulty: <?php echo $result['difficulty']?></h1>
                    <h1>Prep Time: <?php echo $result['prep'] . ' ' . $result['prepTime']?></h1>
                    <h1>Cook Time: <?php echo $result['cook'] . ' ' . $result['cookTime']?></h1> 
                </div>
                
                <div id="options">
                    <div>
                        <label for="ServingSize">Half</label>
                        <input type="radio" name="ServingSize" id="half" value=".5">
                    </div>
                    
                    <div>
                        <label for="ServingSize">Normal</label>
                        <input type="radio" name="ServingSize" id="normal" value="1" checked>
                    </div>
                    
                    <div>
                        <label for="ServingSize">Double</label>
                        <input type="radio" name="ServingSize" id="double" value="2">
                    </div>
                </div>
            </div>
        </div>

        <div id="lists">
            <div id="buttons">
                <button class="tab" id="IngredientButton">Ingredients</button>
                <button class="tab" id="InstructionButton">Instructions</button>
            </div>

            <div id="Ingredients">
                <ul>
                    
                </ul>
            </div>

            <div id="Instructions">
                <ul>
                    
                </ul>
            </div>
        </div>
    </div>

   
</body>
</html>