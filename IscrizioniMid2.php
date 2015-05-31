<?php
// Receive form Post data and Saving it in variables

$nick2 = @$_POST['nick1'];
$email2 = @$_POST['email'];
$mmr = @$_POST['mmr'];
$profile = @$_POST['steamurl1'];

//sanitizzazione
$nick = filter_var($nick2, FILTER_SANITIZE_STRING);
$email = filter_var($email2, FILTER_SANITIZE_EMAIL);

//controllo campi vuoti
if(empty($nick)){
		echo '<body><center>Controllare di avere inserito il nickname!</center></body>'; //controllo del non vuoto
		exit();
	}

if(empty($profile)){
		echo '<body><center>Controllare di avere inserito il profilo Steam!</center></body>'; //controllo del non vuoto
		exit();
	}
	
//testiamo il json
	$filename = "mailingMid.json";
	
	if(file_exists($filename) && $string=file_get_contents($filename) !== false){
		$string = file_get_contents($filename);
	}
	if(empty($nick) || empty($email)){
		echo '<body><center>Controllare di avere inserito nickname e email</center></body>'; //controllo del non vuoto
		exit();
	}
	$esplosione = ''.$nick.'/'.$email.'';
	//controllo che la stringa non sia vuota
	if (isset($string)){
	    //decodifico il file
		$json = json_decode($string, true);
		//controllo che la chiave equivalente a json[name] non sia giù usata
		if (!empty($json[$nick])){
			
			echo '<html><body>'.$nick.' attualmente registrato</body></html>';
			exit();
			
		}
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
$filename = "TorneoMid.txt";

// Marge all the variables with text in a single variable. 
$f_data= '
Giocatore:  '.$nick.'
Profilo: '.$profile.'
MMR: '.$mmr.'
Email: '.$email.' 

==============================================================================
';

echo '<body><center><b><u>Grazie per esserti iscritto!</b></u> <br><br>
Le iscrizioni chiuderanno in data 20 Giugno. <br>
Per favore controlla la mail (<b>Anche nello spam!</b> O aggiungi alla whitelist la mail: noreply@titadota2.com) in quei giorni per confermare la tua presenza! <br>
Questi sono i dati con cui ti sei registrato: <br><br>

Giocatore:  '.$nick.'<br>
Profilo: '.$profile.'<br>
MMR:  '.$mmr.'<br>
Email: '.$email.' <br>
<br>
</body>';

$file = fopen($filename, "a");
fwrite($file,$f_data);
fclose($file);

$filename = "mailingMid.txt";

// Merge all the variables with text in a single variable. 
$f_data= ''.$email.'  ';

$file = fopen($filename, "a");
fwrite($file,$f_data);
fclose($file);

//mail a crus
$to      = 'titadota2@gmail.com';
$subject = 'Nuovo Giocatore 1v1 - '.$nick.'';
$message = '
Questi sono i dati con cui si sono registrati:

Giocatore 1:  '.$nick.'
Profilo: '.$profile.'
MMR:  '.$mmr.'
Email: '.$email.' 

Tutti gli iscritti si trovano a questo link: [url]
La mailing list si trova qui: [url]';

$headers = 'From: newmid@email.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);

//mail al tizio
$to      = ''.$email.'';
$subject = 'Congratulazioni, sei iscritto!';
$message = 'Grazie per esserti iscritto!
Le iscrizioni chiuderanno in data 20 Giugno. 
Per favore controlla la mail (Anche nello spam! O aggiungete alla whitelist la mail: noreply@titadota2.com) in quei giorni per confermare la tua presenza!

Questi sono i dati con cui ti sei registrato:

Giocatore 1: '.$nick.'
Profilo: '.$profile.'
MMR:  '.$mmr.'
Email: '.$email.' ';

$headers = 'From: noreply@email.com' . "\r\n" .
    'Reply-To: postmaster@email.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);

?>