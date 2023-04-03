<?php
if($_SERVER['REQUEST_METHOD'] ==='POST') {
    if(!empty($_POST['honeyPot'])) {
        die("Sorry you bot");
    } else {
        
    }
}

?>

<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
	#values {
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		height: 90vh;
	}

	#values div {
		
	}

</style>
<title>WDV101 Basic Form Handler Example</title>
</head>

<body>
<div id="values">

	<div id="thankYou">
		Thank you <?php echo $_POST['first_name'] . ' ' . $_POST['last_name']?>
	</div>
	<br>
	<div>
		<?php

			echo "<table border='1'>";
			echo "<tr><th>Field Name</th><th>Value of Field</th></tr>";
			foreach($_POST as $key => $value)
			{
				echo '<tr>';
				echo '<td>',$key,'</td>';
				echo '<td>',$value,'</td>';
				echo "</tr>";
			} 
			echo "</table>";
			echo "<p>&nbsp;</p>";

		?>
	</div>

	<div>
		<p>A signup confirmation has been sent to <?php echo $_POST['email']?>. Thank you for your support!</p>
	</div>
</div>

</body>
</html>
