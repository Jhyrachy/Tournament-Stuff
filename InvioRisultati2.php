<?php

$vincitore_imploso = @$_POST['Team1'];
$sconfitto_imploso = @$_POST['Team2'];
$ora = date("H,i,s");
$data = date("d,m,Y"); 

$vincitore_temp = explode("_",$vincitore_imploso);
$vincitore = $vincitore_temp[0];
$mail1 = $vincitore_temp[1];
$sconfitto_temp = explode("_",$sconfitto_imploso);
$sconfitto = $sconfitto_temp[0];
$mail2 = $sconfitto_temp[1];

if(isset($_FILES['image'])){
		$errors= array();
		$file_size =$_FILES['image']['size'];
		$file_tmp =$_FILES['image']['tmp_name'];
		$file_type=$_FILES['image']['type'];   
		$exploded = explode('.',$_FILES['image']['name']);
		$file_ext=strtolower(end($exploded));
		$file_name = ''.$vincitore.'-'.$sconfitto.'_'.$ora.'_'.$data.'.'.$file_ext.'';
		
		$expensions= array("jpeg","jpg","png"); 		
		if(in_array($file_ext,$expensions)=== false){
			$errors[]="Formato non corretto! Riprova con un'immagine jpg/jpeg o png!";
		}
		if($file_size > 1024000){
		$errors[]='File troppo grande!';
		}				
		if(empty($errors)==true){
			move_uploaded_file($file_tmp,"screenshoots/".$file_name);
			$url = 'http://www.titadota2.com/screenshoots/';
			$notencoded = $url.$file_name;
			$path = $new = str_replace(' ', '%20', $notencoded);
			echo '<center>Risultati inviati correttamente! <br>
			Screenshoot salvato!<br>			
				<a href="'.$path.'">Premi qui per visualizzarlo </a> <br><br></center>';
				
				$to      = 'titadota2@gmail.com';
				$subject = 'W: '.$vincitore.' - L: '.$sconfitto.'';
				$message = 'Team vincitore: '.$vincitore.'
							Team sconfitto: '.$sconfitto.'
							Screenshoot: '.$path.' ';

				$headers = 	'From: newresult@titadota2.com' . "\r\n" .
							'Reply-To: webmaster@example.com' . "\r\n" .
							'X-Mailer: PHP/' . phpversion();

				mail($to, $subject, $message, $headers);
				
				$subject = 'W: '.$vincitore.' - L: '.$sconfitto.'';
				$message = 'Risultati incontro:
Team vincitore: '.$vincitore.'
Team sconfitto: '.$sconfitto.'
Screenshoot: '.$path.' ';

				$headers = 	'From: newresult@titadota2.com' . "\r\n" .
							'Reply-To: webmaster@example.com' . "\r\n" .
							'X-Mailer: PHP/' . phpversion();

				mail($mail1, $subject, $message, $headers);
				mail($mail2, $subject, $message, $headers);
			
				
		}else{
			print_r($errors);
		}
	}
?>