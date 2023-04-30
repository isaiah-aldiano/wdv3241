<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Recipe</title>
    <link rel="stylesheet" href="../Css/Input.css">
    <link rel="stylesheet" href="../Css/Navbar.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="../JS/Input.js"></script>

</head>
<body onload="AddEventListeners(), FillOptions()">
    <nav>
        <a href="RecipeHome.html" id="title">Kitchen Cache</a>
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
                <a href="#">Input Recipe</a>
            </li>
        </ul>
    </nav>

    <div id="FormSection">
        <!-- Needs:
            1. Validataion JS and PHP
            3. Input for a picture of a recipe-->
        <h1>Add a new recipe</h1>
        <form action="../Php/read_obj.php" method="post" id="RecipeForm" enctype="multipart/form-data">
            <label for="image">Recipe Image (jpg, jpeg, png)</label>
            <input type="file" name="file" id="file">
            
            <label for="name">Recipe Name</label>
            <input type="text" name="name" id="name" autocomplete="off">
            <div id="NameError"></div> 
    
            <label for="serves">Servings</label>
            <input type="number" name="serves" min="1" max="50" id="serves" value="1" autocomplete="off">
            
            <label for="prep">Preperation Time</label>
            <div id="FormTime">
                <input type="number" name="prep" id="prep" min="1" max="60" value="15" autocomplete="off">
        
                <select name="prepTime" id="prepTime"></select>
            </div>
            
            <label for="cookTime">Cook Time</label>
            <div id="FormTime">
                <input type="number" name="cook" id="cook" min="1" max="60" value="15" autocomplete="off">
        
                <select name="cookTime" id="cookTime"></select>
            </div>
    
            <label for="difficulty">Difficulty</label>
            <input type="text" name="difficulty" id="difficulty" autocomplete="off">
            <div id="DiffError"></div> <br>
            <input type="input" name="honeypot" id="honeypot">
            <label for="ingredients">Ingredients</label>

            <div id="AllIngredients">
                <div>
                    <input type="text" name="ingredient">
                    <button type="button" onclick="deleteNode(this)">Delete</button>
                </div>

                <div>
                    <input type="text" name="ingredient">
                    <button type="button" onclick="deleteNode(this)">Delete</button>
                </div>

                <div>
                    <input type="text" name="ingredient">
                    <button type="button" onclick="deleteNode(this)">Delete</button>
                </div>
                
            </div>

            <button type="button" id="AddIngredient">+ Ingredient</button>
            <div id="IngredientError"></div> 

            <input type="hidden" id="IngredientArray" name="IngredientArray">

            <label for="instructions">Instructions</label>

            <div id="AllInstructions">
                <div>
                    <input type="text" name="instructions" id="instruction">
                    <button type="button" onclick="deleteNode(this)">Delete</button>
                </div>
                
                <div>
                    <input type="text" name="instructions" id="instruction">
                    <button type="button" onclick="deleteNode(this)">Delete</button>
                </div>
                 
                <div>
                    <input type="text" name="instructions" id="instruction">
                    <button type="button" onclick="deleteNode(this)">Delete</button>
                </div>
            </div>

            <button type="button" id="AddInstruction">+ Instruction</button>
            <div id="InstructionError"></div> 


            <input type="hidden" id="InstructionArray" name="InstructionArray">

            <input type="submit" value="Submit" id="submit">
            <!-- <button type="button" id="submit">Submit </button> -->
        </form>
    </div>
</body>
</html>