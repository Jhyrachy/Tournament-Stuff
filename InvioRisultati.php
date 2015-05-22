<head>
<title> Report Risultati </title>
</head>
<body>
<center>
<form name="Caricamento" enctype="multipart/form-data" action="InvioRisultati2.php" method="post">
<p>
<center><b> Modulo  <u>Risultati</u> </b>
<br>
<?php
	
	$filename = "teamContact.json";
	if(file_exists($filename) && $string=file_get_contents($filename) !== false){
		$jsonData = file_get_contents($filename);
		$json = json_decode($jsonData, true);
	
		$opts = '';
		foreach($json as $name => $email)
		{
			$opts .= '<option value="'.$email.'">'.$name.'</option>';
		}
		
		echo '<select name="Team1">'.$opts.'</select> <br>';
		echo '<select name="Team2">'.$opts.'</select> <br>';
	}
	else
		echo '<body>Nessuna lista contatti disponibile! <br></body>';
?>
<input type="hidden" name="uploading"/>
<br/>Screenshoot dei risultati: <input name="image" type="file" required />
<br>
<br/><input type="submit" value="Invia risultati" />
</form>
</center>
</body>