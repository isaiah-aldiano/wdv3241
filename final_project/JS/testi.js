<?php
$ingredients = array(
  "1 cup flour",
  "2 eggs",
  "3/4 cup sugar",
);
?>

<ul>
  <?php foreach ($ingredients as $ingredient) { ?>
    <li><span class="ingredient"><?php echo $ingredient ?></span></li>
  <?php } ?>
</ul>

<div>
  <input type="radio" name="multiplier" value="1" checked> Original<br>
  <input type="radio" name="multiplier" value="2"> Double<br>
  <input type="radio" name="multiplier" value="0.5"> Half<br>
</div>

<script>
  var ingredients = document.querySelectorAll('.ingredient');
  var radios = document.querySelectorAll('input[name="multiplier"]');

  function updateIngredients() {
    var multiplier = parseFloat(document.querySelector('input[name="multiplier"]:checked').value);
    ingredients.forEach(function (ingredient) {
      var original = ingredient.innerText;
      var modified = '<?php echo modify_ingredient("' + original + '", "' + "' + multiplier + '" + '") ?>';
      ingredient.innerText = modified;
    });
  }

  radios.forEach(function (radio) {
    radio.addEventListener('change', updateIngredients);
  });
</script>