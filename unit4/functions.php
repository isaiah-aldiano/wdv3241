<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Php functions</title>

    <?php
    function formatDate($dateStyle) {
        $date = date_create($dateStyle);

        $dateStyle = date_format($date, 'd/m/Y');

        echo $dateStyle;
    }

    function formatDateUS($dateStyle) {
        $date = date_create($dateStyle);

        $dateStyle = date_format($date, 'm/d/Y');

        echo $dateStyle;
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

        echo $stringObj->formattedString . $stringObj->containsDMACC . ' ' . $stringObj->stringLength;
    }
    //Takes in a phone number and formats it to (xxx) xxx-xxxx
    function formatPhone($phoneNum) {
        if(strlen($phoneNum) == 10) {
            $phoneNum = "(" . substr($phoneNum, 0, 3) . ") " . substr($phoneNum, 3, 3) . "-" . substr($phoneNum, 6); 
        } else {
            $phoneNum = "*Error occured - Not enough characters entered*";
        }

        echo $phoneNum;
    }
    //Takes in a number and formats it to American currency
    function formatCurrency($currency) {
        $currency = number_format($currency, 2, '.', ',');

        echo $currency;
    }
    ?>

    <style>
        body {
            background-color: lightgray;
            
        }
    </style>
</head>
<body>
    <?php formatDate('23-3-1993')?></br>
    <?php formatDateUS('23-3-3034')?><br>
    <?php formatString('      THIS STRING CONTAINS DMACC YUHHHHH')?><br>
    <?php formatString('      THIS STRING does not')?><br>
    <?php formatPhone('1234567890')?><br>
    <?php formatPhone('515432')?><br>
    <?php formatCurrency(123456)?>
</body>
</html>