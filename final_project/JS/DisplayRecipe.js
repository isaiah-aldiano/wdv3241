

function AddEventListeners() {
    let IngredientButton = document.querySelector('#IngredientButton')
    let InstructionButton = document.querySelector('#InstructionButton')

    var Instructions = document.querySelector('#Instructions')
    var Ingredients = document.querySelector('#Ingredients')

    IngredientButton.addEventListener('click', () => {
        Instructions.style.display = 'none'
        InstructionButton.style.backgroundColor = 'transparent'

        Ingredients.style.display = 'inline'
        IngredientButton.style.backgroundColor = 'rgb(95, 23, 23, .5)'
    })

    InstructionButton.addEventListener('click', () => {
        Instructions.style.display = 'inline'
        InstructionButton.style.backgroundColor = 'rgb(95, 23, 23, .5)'

        Ingredients.style.display = 'none'
        IngredientButton.style.backgroundColor = 'transparent'
    })

    parsed_ingredients.forEach((item) => {
        let list = Ingredients.querySelector("ul")
        let newItem = document.createElement("li")
        newItem.innerHTML = item

        list.appendChild(newItem)
    })
    
    parsed_instructions.forEach((item) => {
        let list = Instructions.querySelector("ul")
        let newItem = document.createElement("li")
        newItem.innerHTML = item

        list.appendChild(newItem)
    })
    

    // let ingredients = document.querySelectorAll('.ingredient')
    // function ChangeQuantities() {
    //     let multiplier = parseFloat(document.querySelector('input[name="ServingSize"]:checked').value)

    //     console.log(multiplier)

    //     ingredients.forEach((ingredient) => {
    //         let original = ingredient.innerText
    //         console.log(original)
    //         let modified = '<?php echo modify_ingredient("' + original + '",' + multiplier + ');?>'
    //         ingredient.innerTEXT = modified;
    //     })
    // }
    
    let radios = document.querySelectorAll('input[name="ServingSize"]')

    radios.forEach((radio) => {
        radio.addEventListener('change', () => {
            
        })
    })


    $(function() {
        $('input[name="ServingSize"]').change(function() {
            let multiplier = parseFloat( $('input[name="ServingSize"]:checked').val())
            let fraction_regex = /\b\d+\/\d+\b/g
            let regex = /\b\d+\b/g
            console.log("--------------------")
            $('#Ingredients ul').html('')
            
            $.each(parsed_ingredients, function(item, value) {
                if(value.match(fraction_regex)) {
                    var match = value.match(fraction_regex)[0]
                    let fraction = parseFractionString(match)
                    var quantity = fraction * multiplier
    
                    var newIngredient = value.replace(match, quantity)
                } else {
                    let whole = value.match(regex)
                    quantity = whole * multiplier 
    
                    newIngredient = value.replace(whole, quantity)
                }
             
                var newItem = $('<li>' + newIngredient + '</li>')
                $("#Ingredients ul").append(newItem)
            })
        })
    })
}

function parseFractionString(fractionString) {
    var parts = fractionString.split('/');
    var numerator = parseFloat(parts[0]);
    var denominator = parseFloat(parts[1]);
  
    return numerator / denominator;
}

