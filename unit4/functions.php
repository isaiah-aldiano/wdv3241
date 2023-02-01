<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <?php
    //Input variables from form
    $dateStyle = $_POST['dateStyle']; 
    $someString = $_POST['someString'];
    $phoneNum = preg_replace("/[^0-9]/", "", $_POST['phoneNum']);
    $currency = preg_replace("/[^0-9]/", "", $_POST['currency']); 

    //Variables to catch returns
    $formattedDate = null;
    $stringObject = null;
    $formattedNum = null;
    $formattedCurrency = null;

    function formatDate($dateStyle) {
        date_default_timezone_set('America/Chicago');

        if ($dateStyle == 'USA') {
            $dateStyle= date('m/d/Y', time());
        } else if ($dateStyle == 'EU') {
            $dateStyle = date('d/m/Y', time());
        }

        return $dateStyle;
    }

    //String class to return values
    class aString {
        public $stringLength;
        public $formattedString;
        public $containsDMACC;
    }
    //Takes in a string and created class captures info, string class returned
    function formatString($someString) {
        $stringObj = new aString;

        $stringObj->formattedString = "'" . trim(strtolower($someString)) . "' ";

        $stringObj->stringLength = strlen($someString);

        if(strpos(strtolower($someString), 'dmacc') !== false) { 
            $stringObj->containsDMACC = 'true';
        } else {
            $stringObj->containsDMACC = 'false';
        }

        return $stringObj;
    }
    //Takes in a phone number and formats it to (xxx) xxx-xxxx
    function formatPhone($phoneNum) {
        if(strlen($phoneNum) == 10) {
            $phoneNum = "(" . substr($phoneNum, 0, 3) . ") " . substr($phoneNum, 3, 3) . "-" . substr($phoneNum, 6); 
        } else {
            $phoneNum = "*Error occured - Not enough characters entered*";
        }

        return $phoneNum;
    }
    //Takes in a number and formats it to American currency
    function formatCurrency($currency) {
        $currency = number_format($currency, 2, '.', ',');

        return $currency;
    }

    if (strlen($dateStyle) > 0) {
        $formattedDate = formatDate($dateStyle);
    }

    if(strlen($someString) > 0) {
        $stringObject = formatString($someString);
    }

    if(strlen($phoneNum) > 0) {
        $formattedNum = formatPhone($phoneNum);
    }

    if(strlen($currency) > 0) {
        $formattedCurrency = "$" . formatCurrency($currency);
    }
    ?>

    <style>
        form {
            background-color: lightgray;
            border: 1px solid black;
            max-width: 400px;
            padding: 5px;
        }
    </style>
</head>
<body>
    
    <form method="post">
        Select time stamp format: 
        <input type="radio" name="dateStyle" value="USA">
        <label for="dataStyle">American</label>

        <input type="radio" name="dateStyle" value="EU">
        <label for="dateStyle">European</label><br>

        <label for="someString">Enter a string: </label>
        <input type="text" name="someString"><br>

        <label for="phoneNum">Enter a phone number: </label>
        <input type="text" name="phoneNum"><br>

        <label for="currency">Enter some dollar amount</label>
        <input type="text" name="currency"><br>
        
        <button type="submit">Submit</button>
        <button type="submit">Clear</button>
        </button>
    </form>

    <h1><?php echo $formattedDate;?></h1>
    <h1><?php echo $stringObject->formattedString . $stringObject->containsDMACC . ' ' . $stringObject->stringLength;?></h1>
    <h1><?php echo $formattedNum;?></h1>
    <h1><?php echo $formattedCurrency;?></h1>
</body>
</html>