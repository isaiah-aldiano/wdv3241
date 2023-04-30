<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // if(($_POST['honeypot']) != '') {
        //     die("<h1>Bot</h1>");
        // }

        //Form Data
        $recipe = htmlspecialchars(trim($_POST['name']));
        $serves = htmlspecialchars(trim( $_POST['serves']));
        $prep = htmlspecialchars(trim($_POST['prep']));
        $prepTime = htmlspecialchars(trim($_POST['prepTime']));
        $cook = htmlspecialchars(trim($_POST['cook']));
        $cookTime = htmlspecialchars(trim($_POST['cookTime']));
        $difficulty = htmlspecialchars(trim($_POST['difficulty']));
        $ingredients = htmlspecialchars(trim($_POST['IngredientArray']));
        $instructions = htmlspecialchars(trim($_POST['InstructionArray']));

        //Image data
        $file = $_FILES['file'];
        $fileName = $file['name'];
        $filetype = $file['type'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        
        $allowed = array('jpg', 'jpeg', 'png');

        if(in_array($fileActualExt, $allowed)) {
            if($fileError === 0 && $fileSize < 200_000) {

                $fileNameNew = uniqid('', true).'.'.$fileActualExt;
                $fileDesination = 'uploads/'.$fileNameNew;

                $uploaded = move_uploaded_file($fileTmpName, $fileDesination);

                if($difficulty == "" or $recipe == "" or $difficulty == "" or $ingredients == "" or $instructions == "" ) {
                    header('Location: ../Pages/RecipeInput.php?InvalidRecipe');
                } else {
                    try {
                        include "db_connect.php";

                        $query = "INSERT INTO recipe (name, serves, prep, prepTime, cook, cookTime, difficulty, ingredients, instructions, photo_url) VALUES (:recipe, :serves, :prep, :prepTime, :cook, :cookTime, :difficulty, :ingredients, :instructions, :photo_url)";

                        $stmt = $conn->prepare($query);
                        $stmt->bindParam(':recipe', $recipe);
                        $stmt->bindParam(':serves', $serves);
                        $stmt->bindParam(':prep', $prep);
                        $stmt->bindParam(':prepTime', $prepTime);
                        $stmt->bindParam(':cook', $cook);
                        $stmt->bindParam(':cookTime', $cookTime);
                        $stmt->bindParam(':difficulty', $difficulty);
                        $stmt->bindParam(':ingredients', $ingredients);
                        $stmt->bindParam(':instructions', $instructions);
                        $stmt->bindParam(':photo_url', $fileDesination);

                        if($stmt->execute()) {
                            header('Location: ../Pages/RecipeInput.php?uploadsuccess');
                        }
                        $conn = null;
                    } catch(PDOException $e) {
                        header('Location: ../Pages/RecipeInput.php?');
                    }
                }
            }
        } else {
            header('Location: ../Pages/RecipeInput.php?');
        }    
    }
?>