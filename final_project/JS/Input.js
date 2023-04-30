class Recipe {
    constructor(name, serves, cook, cookTime, prep, prepTime, difficulty, ingredients, instructions) {
        this.name = name
        // this.image = image
        this.serves = serves
        this.prep = prep
        this.prepTime = prepTime
        this.cook = cook
        this.cookTime = cookTime
        this.difficulty = difficulty

        //Store both ingredients and instructions in arrays
        this.ingredients = ingredients
        this.instructions = instructions
    }

    display() {
        return `${this.name}, ${this.serves}, ${this.cook}, ${this.cookTime}, ${this.prep}, ${this.prepTime}, ${this.difficulty}`
    }
}

let PrepTimes = ['Minutes', 'Hours']

function FillOptions() {
    let cookTime = document.querySelector('#cookTime')
    let prepTime = document.querySelector('#prepTime')

    PrepTimes.forEach((time) => {
        let NewOption = document.createElement('option')
        NewOption.innerHTML = time

        cookTime.appendChild(NewOption)        
    })

    PrepTimes.forEach((time) => {
        let NewOption = document.createElement('option')
        NewOption.innerHTML = time

        prepTime.appendChild(NewOption)
    })
}

function AddNewIngredient() {
    let IngredientsDiv = document.querySelector("#AllIngredients")

    let NewDiv = document.createElement("div")

    let NewInput = document.createElement("input")
    NewInput.type = "text"
    NewInput.name = "ingredient"

    let NewDelete = document.createElement("button")
    NewDelete.textContent = "Delete"
    NewDelete.type = "button"
    NewDelete.setAttribute("onclick", "deleteNode(this)")

    NewDiv.appendChild(NewInput)
    NewDiv.appendChild(NewDelete)

    IngredientsDiv.appendChild(NewDiv)
}


function AddNewInstruction() {
    let AllInstructions = document.querySelector("#AllInstructions")

    let NewDiv = document.createElement("div")

    let NewInput = document.createElement("input")
    NewInput.type = "text"
    NewInput.name = "instructions"

    let NewDelete = document.createElement("button")
    NewDelete.textContent = "Delete"
    NewDelete.type = "button"
    NewDelete.setAttribute("onclick", "deleteNode(this)")

    NewDiv.appendChild(NewInput)
    NewDiv.appendChild(NewDelete)

    AllInstructions.appendChild(NewDiv)
}


function AddEventListeners() {

    let RecipeForm = document.querySelector('#RecipeForm')

    RecipeForm.addEventListener('submit', (event) => {
        let recipe = CreateRecipe()

        if(recipe.name == '' || recipe.difficulty == '' || recipe.ingredients == '' || recipe.instructions == '') {
            
            checkErrors(recipe.name, recipe.difficulty, recipe.ingredients, recipe.instructions)
            event.preventDefault()
        }

        let IngredientArray = document.querySelector('#IngredientArray')
        let InstructionArray = document.querySelector('#InstructionArray')

        IngredientArray.value = recipe.ingredients
        InstructionArray.value = recipe.instructions
    })

    let AddIngredient = document.querySelector('#AddIngredient')
    AddIngredient.addEventListener('click', AddNewIngredient)

    let AddInstruction = document.querySelector("#AddInstruction")
    AddInstruction.addEventListener('click', AddNewInstruction)
}


//Creates a recipe object
function CreateRecipe() {
    let name = document.querySelector('#name').value
    let servings = document.querySelector('#serves').value

    let prep = document.querySelector('#prep').value
    let prepTime = document.querySelector('#prepTime').value

    let cook = document.querySelector('#cook').value
    let cookTime = document.querySelector('#cookTime').value

    let difficulty = document.querySelector('#difficulty').value

    let IngredientValues = document.querySelectorAll('#AllIngredients input')

    let AllIngredients = []
    for(let ingredient of IngredientValues) {
        if(ingredient.value.localeCompare("")) {
            AllIngredients.push(ingredient.value.trim())
        }
    }

    let InstructionValues = document.querySelectorAll('#AllInstructions input')
    
    let AllInstructions = []
    for(let instruction of InstructionValues) {
        if(instruction.value.localeCompare("")) {
            AllInstructions.push(instruction.value.trim())
        }
    }

    let NewRecipe = new Recipe(name, servings, cook, cookTime, prep, prepTime, difficulty, AllIngredients, AllInstructions)

    return NewRecipe
}

function deleteNode(btn) {
    ((btn.parentNode).parentNode).removeChild(btn.parentNode)
}


function checkErrors(name, difficulty, ingredients, instruction) {
    let nameerror = document.querySelector('#NameError')
    let DiffError = document.querySelector('#DiffError')
    let IngredientError = document.querySelector('#IngredientError')
    let InstructionError = document.querySelector('#InstructionError')
    if(name == '') {
        nameerror.style.display = 'inline'
        nameerror.innerHTML = 'Enter Recipe Name'
    } else {
        nameerror.style.display = 'none'
    }

    if(difficulty == '') {
        DiffError.style.display = 'inline'
        DiffError.innerHTML = 'Enter Difficulty'
    } else {
        DiffError.style.display = 'none'
    }

    if(ingredients == '') {
        IngredientError.style.display = 'inline'
        IngredientError.innerHTML = 'Enter Ingredients'
    } else {
        IngredientError.style.display = 'none'
    }

    if(instruction == '') {
        InstructionError.style.display = 'inline'
        InstructionError.innerHTML = 'Enter Instructions'
    } else {
        InstructionError.style.display = 'none'
    }
}



