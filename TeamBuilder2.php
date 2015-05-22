<?php

$name = @$_POST['name'];
$nick = @$_POST['nick'];
$email = @$_POST['email'];
$profile = @$_POST['steamurl'];
$mmr = @$_POST['mmr'];
$ruoli = @$_POST['ruoli'];
$numero = @$_POST['contatore'];

if(empty($nick) || empty($email) || empty($profile)){
		echo '<body><center>Assicuratevi di aver completato tutti i campi richiesti e riprovare!<center></body>'; //controllo del non vuoto
		exit();
	}

$filename1 = "spaiati1.txt";
$filename2 = "spaiati2.txt";
$filename3 = "spaiati3.txt";
$filename4 = "spaiati4.txt";

$f_data= '
Nome Team: '.$name.'
Nickname:  '.$nick.'
Profile: '.$profile.'
Email: '.$email.' 
MMR medio: '.$mmr.'
Ruoli copribili: '.$ruoli.'

==============================================================================
';

switch($numero){
	case '1':
		$file = fopen($filename1, "a");
		fwrite($file,$f_data);
		fclose($file);
		$urler = 'http://www.site.com/spaiati1.txt';
		break;
	case '2':
		$file = fopen($filename2, "a");
		fwrite($file,$f_data);
		fclose($file);
		$urler = 'http://www.site.com/spaiati2.txt';
		break;
	case '3':
		$file = fopen($filename3, "a");
		fwrite($file,$f_data);
		fclose($file);
		$urler = 'http://www.sitecom/spaiati3.txt';
		break;
	case '4':
		$file = fopen($filename4, "a");
		fwrite($file,$f_data);
		fclose($file);
		$urler = 'http://www.site.com/spaiati4.txt';
		break;
}

echo '<body><center> Grazie per aver inviato la richiesta!<br>
Controllate frequentemente la e-mail per informazioni riguardo altri giocatori con cui formare una squadra!<br>
Verrete contattati non appena si iscriveranno giocatori con requisiti compatibili ai vostri.<br>
Non assicuriamo che questo sia possibile, ma faremo del nostro meglio per aiutarvi a trovare i membri mancanti! <br>

Questi sono i dati con cui vi siete registrati: <br><br>

Nome Team: '.$name.'<br>
Nickname:  '.$nick.'<br>
Profile: '.$profile.'<br>
Email: '.$email.' <br>
MMR medio: '.$mmr.'<br>
Ruoli copribili: '.$ruoli.'<br>
Numero Giocatori: '.$numero.'</center></body>';

$to      = 'email@email.it';
$subject = 'Nuovo Gruppo - Numero giocatori:'.$numero.'';
$message = '
Questi sono i dati con cui si è registrato:

Nome Team: '.$name.'
Nickname:  '.$nick.'
Profile: '.$profile.'
Email: '.$email.' 
MMR medio: '.$mmr.'
Ruoli copribili: '.$ruoli.'
Numero Giocatori: '.$numero.'

Tutti gli iscritti si trovano a questo link: '.$urler.'';

$headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);

$to2      = ''.$email.'';
$subject = 'Grazie per esservi registrati al Team Builder!';
$message = ' Grazie per aver inviato la richiesta!
Controllate frequentemente la e-mail per informazioni riguardo altri giocatori con cui formare una squadra!
Verrete contattati non appena si iscriveranno giocatori con requisiti compatibili ai vostri.
Non assicuriamo che ciò sia possibile, ma faremo del nostro meglio per aiutarvi a trovare i membri mancanti!

Questi sono i dati con cui vi siete registrati:

Nome Team: '.$name.'
Nickname:  '.$nick.'
Profile: '.$profile.'
Email: '.$email.' 
MMR medio: '.$mmr.'
Ruoli copribili: '.$ruoli.'
Numero Giocatori: '.$numero.'';

$headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to2, $subject, $message, $headers);