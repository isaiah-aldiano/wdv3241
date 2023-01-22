<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <?php 
        $yourName = "Isaiah Aldiano";
        $value1 = 68;
        $value2 = 421;
        $total = $value1 + $value2;
        $someArray = array('PHP', 'HTML', 'Javascript'); 
    ?>
</head>
<body>
    <?php echo "<h1> $yourName </h1>" ?>
    <h2> <?php echo $yourName?></h2>
    <p><?php echo "value 1 = $value1 </br>value2 = $value2<br> total = $total"?></p>
    <span id="array"></span>

    <script>
        printArray = document.querySelector("#array")
        var anotherArray = []
        <?php 
            foreach($someArray as $val) {
                echo 'anotherArray.push("'.$val.'");';
            }
        ?>
        
        anotherArray.forEach(item => {
            printArray.innerHTML += item + "</br>"
        })
        console.log(anotherArray)
    </script>
</body>
</html>