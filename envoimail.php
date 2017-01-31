

<?php
function sendEmail($email, $emailp, $url, $copy= NULL){

	$headers[]  = 'MIME-Version: 1.0';
	$headers[] = 'Content-type: text/html; charset=UTF-8';

	// En-têtes additionnels
	$headers[] = "To: destinataire <". $email .">";
	$headers[] ="From : <". $emailp .">";
	if(isset($copy )){
		$headers[] = 'Cc: '. $emailp;
	}



	$nbErreurs = 0;
	$msgErreurs = "";
	$emailValid = true;

	 $templateEmail = file_get_contents('template/templateMail.html');

	$templateEmail = str_replace('{{url}}', $url, $templateEmail);
	$message = str_replace('{{email}}', $emailp, $templateEmail);

	$destinataire = $email ;
	$expediteur= 'Les fées mères';
	$objet = 'Un fichier vous a été partagé';

	if (empty($email)) {
		$nbErreurs ++;
		$msgErreurs .="Email<br />";
	}
	else
	{
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$emailValid = false;
			print("Email Invalide");
		}


		if($nbErreurs!=0)
		{
			print("Champ(s) manquant(s) :<br />".$msgErreurs);
		}
		else
		{
			if($emailValid)
			{
				mail ( $destinataire,$objet,$message,implode("\r\n",$headers));
				echo "<script>alert(\" Le fichier a été partagé\")</script>";

			}
		}
	}
}
?>
