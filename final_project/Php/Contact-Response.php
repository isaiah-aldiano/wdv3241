<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submitter_message = $_POST['message'];
    $submitter_email = $_POST['email'];
    $submitter_name = $_POST['name'];

    $email = "
    	<h1>Name: $submitter_name</h1>
    	<h1>Email: $submitter_email</h1>
    	<h1>Message: $submitter_message</h1>";
    	
    $subject = 'Thank you!';
    
    $headers .= 'Content-type:text/html;charset=UTF-8\r\n';
    $headers .= 'MIME-Version: 1.0\r\n';  
	
    //Email to the submitter
    $sent = mail($submitter_email, $subject, $email, $headers, '-f recipe_contact@isaiahaldiano.com');
    
    //Email to recipe_contact
    mail('recipe_contact@isaiahaldiano.com', 'Contact Form Submission', $email, $headers);
}
?>