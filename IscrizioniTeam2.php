<?php
// Receive form Post data and Saving it in variables

$name2 = @$_POST['name'];
$nick = @$_POST['nick1'];
$email2 = @$_POST['email'];
$profile = @$_POST['steamurl1'];

$nick2 = @$_POST['nick2'];
$profile2 = @$_POST['steamurl2'];

$nick3 = @$_POST['nick3'];
$profile3 = @$_POST['steamurl3'];

$nick4 = @$_POST['nick4'];
$profile4 = @$_POST['steamurl4'];

$nick5 = @$_POST['nick5'];
$profile5 = @$_POST['steamurl5'];

$nick6 = @$_POST['nick6'];
$profile6 = @$_POST['steamurl6'];

$nick7 = @$_POST['nick7'];
$profile7 = @$_POST['steamurl7'];

$nick8 = @$_POST['nick8'];
$profile8 = @$_POST['steamurl8'];

//sanitizzazione
$name = filter_var($name2, FILTER_SANITIZE_STRING);
$email = filter_var($email2, FILTER_SANITIZE_EMAIL);

//controllo campi vuoti
if(empty($nick) || empty($nick2) || empty($nick3) || empty($nick4) || empty($nick5)){
		echo '<body><center>Controllare di avere inserito i nickname di tutti i giocatori!</center></body>'; //controllo del non vuoto
		exit();
	}

if(empty($profile) || empty($profile2) || empty($profile3) || empty($profile4) || empty($profile5)){
		echo '<body><center>Controllare di avere inserito tutti i profili Steam!</center></body>'; //controllo del non vuoto
		exit();
	}
	
//testiamo il json
	$filename = "teamContact.json";
	
	if(file_exists($filename) && $string=file_get_contents($filename) !== false){
		$string = file_get_contents($filename);
	}
	if(empty($name) || empty($email)){
		echo '<body><center>Controllare di avere inserito nome e email</center></body>'; //controllo del non vuoto
		exit();
	}
	$esplosione = ''.$name.'/'.$email.'';
	//controllo che la stringa non sia vuota
	if (isset($string)){
	    //decodifico il file
		$json = json_decode($string, true);
		//controllo che la chiave equivalente a json[name] non sia giù usata
		if (!empty($json[$name])){
			
			echo '<html><body>'.$name.' attualmente registrato</body></html>';
			exit();
			
		}
		//assegno la chiave
        $json[$name] = $esplosione;
	}
	else
		$json = array($name => $esplosione);

	$output_json = json_encode($json);

	//scriviamo il json
	$file = fopen($filename, "w");
	fwrite($file,$output_json);
	fclose($file);		

// Write the name of text file where data will be store
$filename = "Team.txt";

// Marge all the variables with text in a single variable. 
$f_data= '
Nome Team: '.$name.'
Giocatore 1:  '.$nick.'
Profilo: '.$profile.'
Email: '.$email.' 

Giocatore 2: '.$nick2.'
Profilo: '.$profile2.'

Giocatore 3: '.$nick3.'
Profilo: '.$profile3.'

Giocatore 4: '.$nick4.'
Profilo: '.$profile4.'

Giocatore 5: '.$nick5.'
Profilo: '.$profile5.'

Standin 1: '.$nick6.'
Profilo: '.$profile6.'

Standin 2: '.$nick7.'
Profilo: '.$profile7.'

Standin 3: '.$nick8.'
Profilo: '.$profile8.'

==============================================================================
';

echo '<body><center><b><u>Grazie per esservi iscritti!</b></u> <br><br>
Le iscrizioni chiuderanno in data 20 Giugno. <br>
Per favore controllate la mail (<b>Anche nello spam!</b> O aggiungete alla whitelist la mail: noreply@titadota2.com) in quei giorni per confermare la vostra presenza! <br>
Questi sono i dati con cui vi siete registrati: <br><br>
Nome Team: '.$name.'<br>
Giocatore 1:  '.$nick.'<br>
Profilo: '.$profile.'<br>
Email: '.$email.' <br>
<br>
Giocatore 2: '.$nick2.'<br>
Profilo: '.$profile2.'<br>
<br>
Giocatore 3: '.$nick3.'<br>
Profilo: '.$profile3.'<br>
<br>
Giocatore 4: '.$nick4.'<br>
Profilo: '.$profile4.'<br>
<br>
Giocatore 5: '.$nick5.'<br>
Profilo: '.$profile5.'<br>
<br>
Standin 1: '.$nick6.'<br>
Profilo: '.$profile6.'<br>
<br>
Standin 2: '.$nick7.'<br>
Profilo: '.$profile7.'<br>
<br>
Standin 3: '.$nick8.'<br>
Profilo: '.$profile8.'</center></body>';

$file = fopen($filename, "a");
fwrite($file,$f_data);
fclose($file);

$filename = "mailingTeam.txt";

// Merge all the variables with text in a single variable. 
$f_data= ''.$email.'  ';

$file = fopen($filename, "a");
fwrite($file,$f_data);
fclose($file);

//mail a crus
$to      = 'email@email.it';
$subject = 'Nuovo Team - '.$name.'';
$message = '
Questi sono i dati con cui si sono registrati:

Nome Team: '.$name.'
Giocatore 1:  '.$nick.'
Profilo: '.$profile.'
Email: '.$email.' 

Giocatore 2: '.$nick2.'
Profilo: '.$profile2.'

Giocatore 3: '.$nick3.'
Profilo: '.$profile3.'

Giocatore 4: '.$nick4.'
Profilo: '.$profile4.'

Giocatore 5: '.$nick5.'
Profilo: '.$profile5.'

Standin 1: '.$nick6.'
Profilo: '.$profile6.'

Standin 2: '.$nick7.'
Profilo: '.$profile7.'

Standin 3: '.$nick8.'
Profilo: '.$profile8.'
Tutti gli iscritti si trovano a questo link: http://www.site.com/Team.txt
La mailing list si trova qui: http://www.site.com/mailingTeam.txt';

$headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);

//mail al tizio
$to      = ''.$email.'';
$subject = 'Congratulazioni, siete iscritti!';
$message = 'Grazie per esservi iscritti!
Le iscrizioni chiuderanno in data 20 Giugno. 
Per favore controllate la mail (Anche nello spam! O aggiungete alla whitelist la mail: noreply@titadota2.com) in quei giorni per confermare la vostra presenza!

Questi sono i dati con cui vi siete registrati:

Nome Team: '.$name.'
Giocatore 1: '.$nick.'
Profilo: '.$profile.'
Email: '.$email.' 

Giocatore 2: '.$nick2.'
Profilo: '.$profile2.'

Giocatore 3: '.$nick3.'
Profilo: '.$profile3.'

Giocatore 4: '.$nick4.'
Profilo: '.$profile4.'

Giocatore 5: '.$nick5.'
Profilo: '.$profile5.'

Standin 1: '.$nick6.'
Profilo: '.$profile6.'

Standin 2: '.$nick7.'
Profilo: '.$profile7.'

Standin 3: '.$nick8.'
Profilo: '.$profile8.'';

$headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);

?>