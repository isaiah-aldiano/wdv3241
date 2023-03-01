<?php 
    if(isset($_POST['submit'])) {
    	$from = $_POST['email'];
        $name = $_POST['name'];
        $comments = $_POST['comments'];
        
        $tz = 'America/Chicago';
        $timestamp = time();
        $dt = new DateTime('now', new DateTimeZone($tz));
        $date = $dt->format('m/d/Y'); 
        
        $to = 'contactform@isaiahaldiano.com';
        $subject = 'Form Submission';
        $headers = "From: A sender <" . $from . ">\n";
        $headers .= "Reply-To: " . $to . "\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1";
        $headers .= "MIME-Version: 1.0\r\n";
        
        $testEmail = file_get_contents('email.html');
        
        $subject2 = 'Thank you for submitting';
        //$headers2 = "From: A sender <" . $from . ">\n";
        //$headers2 .= 'Reply-To: <contactform@isaiahaldiano.com>\n';
        $headers2 .= 'Content-type: text/html; charset=iso-8859-1';
        $headers2 .= "MIME-Version: 1.0\r\n";
        
        $message = '<html><body>';
        $message .= '<h1>' . $from . '</h1';
        $message .= '<h1>' . $name . '</h1';
        $message .= '<h1>' . $date . '</h1';
        $message .= '<h1>Comments</h1';
        $message .= '<p>' . $comments . '</p>';
        $message .= '</body></html>';
        
        $message2 = '<html><body>';
        $message2 .= '<h1>confirmed email from ' . $from .  '</h1>';
        $message2 .= '</body></html>'; 

        $send = mail($to, $subject, $testEmail, $headers);
        //$send2 = mail($from, $subject2, $message2, $headers2, '-f contactform@isaiahaldiano.com');
        //$send = mail($to, $subject, $message);
        
        $send2 = mail('<spamacct009@gmail.com>', 'subject', $testEmail, $headers2, '-f contactform@isaiahaldiano.com');

	echo ($send2 ? 'Was2send ' : '2not ');
        echo ($send ? 'Was send ' : 'Not ');   
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank you!</title>
    
</head>
<body>
    <?php echo "hello"?>
</body>
</html>