<?php
// Receive form Post data and Saving it in variables

$nick2 = @$_POST['nick'];
$email2 = @$_POST['email'];
$profile = @$_POST['steamurl'];
$url = @$_POST['sito'];
$commento = @$_POST['commento'];
$facebook = @$_POST['facebook'];
$check1 = @$_POST['check1'];

//sanitizzazione
$nick = filter_var($nick2, FILTER_SANITIZE_STRING);
$email = filter_var($email2, FILTER_SANITIZE_EMAIL);

//controllo campi vuoti
if(empty($nick)){
		echo '<body><center>Controllare di avere inserito il Nickname!</center></body>'; //controllo del non vuoto
		exit();
	}
	if(empty($email)){
		echo '<body><center>Controllare di avere inserito la Mail!</center></body>'; //controllo del non vuoto
		exit();
	}
if(empty($profile)){
		echo '<body><center>Controllare di avere inserito il profilo Steam!</center></body>'; //controllo del non vuoto
		exit();
	}

//controllo checkbox caster
	$cocasting = 'No';
if (isset($_POST['check1'])) $cocasting = 'Si';

//testiamo il json
	$filename = "casterContact.json";
	
	if(file_exists($filename) && $string=file_get_contents($filename) !== false){
		$string = file_get_contents($filename);
	}
	if(empty($nick) || empty($email)){
		echo '<body><center>Variabili non valide</center</body>'; //controllo del non vuoto
		exit();
	}
	$esplosione = ''.$nick.'/'.$email.'';
	//controllo che la stringa non sia vuota
	if (isset($string)){
	    //decodifico il file
		$json = json_decode($string, true);
		//controllo che la chiave equivalente a json[nick] non sia giù usata
		if (!empty($json[$nick])) exit("$nick gia' registrato");
		//assegno la chiave
        $json[$nick] = $esplosione;
	}
	else
		$json = array($nick => $esplosione);

	$output_json = json_encode($json);

	//scriviamo il json
	$file = fopen($filename, "w");
	fwrite($file,$output_json);
	fclose($file);		

// Write the name of text file where data will be store
$filename = "Casters.txt";

// Marge all the variables with text in a single variable. 
$f_data= '
Nickname:  '.$nick.'
Profile: '.$profile.'
Email: '.$email.' 
Facebook: '.$facebook.'
Sito: '.$url.'
Co-Casting: '.$cocasting.'
Commento: '.$commento.'

==============================================================================
';

echo '<body><center><b><u>Grazie per esserti iscritto come caster!</b></u> <br><br>
Le iscrizioni chiuderanno in data 20 Giugno. <br>
Per favore controllate le mail (<b>Anche nello spam!</b> O aggiungete alla whitelist la mail: noreply@titadota2.com) in quei giorni per confermare la vostra presenza! <br>
Questi sono i dati con cui vi siete registrati: <br><br>

Nickname:  '.$nick.'<br>
Profile: '.$profile.'<br>
Email: '.$email.'<br>
Facebook: '.$facebook.'
Sito: '.$url.'<br>
Co-Casting: '.$cocasting.'
Commento: '.$commento.'</center></body>';


$file = fopen($filename, "a");
fwrite($file,$f_data);
fclose($file);

$filename = "mailingCasters.txt";

$f_data = ''.$email.' ';

$file = fopen($filename, "a");
fwrite($file,$f_data);
fclose($file);

$to      = 'titadota2@gmail.com';
$subject = 'Nuovo Caster - '.$nick.'';
$message = '
Questi sono i dati con cui si è registrato:

Nickname:  '.$nick.'
Profile: '.$profile.'
Email: '.$email.'
Facebook: '.$facebook.'
Sito/Stream: '.$url.'
Co-Casting: '.$cocasting.'
Commento: '.$commento.'

Tutti gli iscritti si trovano a questo link: http://www.titadota2.com/phpstuff/Casters.txt
La mailing list si trova qui: http://www.titadota2.com/phpstuff/mailingCasters.txt';

$headers = 'From: newcaster@titadota2.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);

//mail al tizio
$to2      = ''.$email.'';
$subject = 'Congratulazioni, sei iscritto!';
$message = ' Grazie per esserti iscritto come caster!
Le iscrizioni chiuderanno in data 20 Giugno.
Per favore controllate le mail (Anche nello spam! O aggiungete alla whitelist la mail: noreply@titadota2.com) in quei giorni per confermare la vostra presenza!

Questi sono i dati con cui vi siete registrati:

Nickname:  '.$nick.'
Profile: '.$profile.'
Email: '.$email.'
Facebook: '.$facebook.'
Sito/Stream: '.$url.'
Co-Casting: '.$cocasting.'
Commento: '.$commento.'';

$headers = 'From: noreply@titadota2.com' . "\r\n" .
    'Reply-To: postmaster@titadota2.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to2, $subject, $message, $headers);

?>
