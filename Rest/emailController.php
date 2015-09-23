<?php
require_once 'authController.php';
require 'PHPMailer-master/PHPMailerAutoload.php';
class emailControllerClass {
	private function establishConnection(){
		$con = new authControllerClass();
		return $con->getConnection();
	}
	private function executeSqlQuery($sql,$dbconn){
		$result = $dbconn->query($sql);
		return $result;
	}
	private function mailInitializer()
	{
		$mail = new PHPMailer;
		$mail->SMTPDebug = 3;                               // Enable verbose debug output
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtpout.secureserver.net';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'tixzooadmin@mytixzoo.com';                 // SMTP username
		$mail->Password = 'computer123';                           // SMTP password
		//$mail->SMTPSecure = 'ssl';     Disabled because this broke it for some reaso                       // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 80;  
		return $mail;              
	}
	public function sendEmail($email, $message)
	{
		$htmlFile = fopen('../new-newsletter.html', "r") or die("Unable to open file");
		$htmlMessage = fread($htmlFile, filesize('../new-newsletter.html'));
		fclose($htmlFile);
		$mail = $this->mailInitializer();
		$mail->From = 'tixzooadmin@mytixzoo.com';
		$mail->FromName = 'Tixzoo Newsletter';
		$mail->addAddress($email, 'newsletter');     // Add a recipient
		$mail->addAddress($email);               // Name is optional
		$mail->addReplyTo('tixzooadmin@mytixzoo.com', 'Newsletter');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Newsletter';
		$mail->Body    = $htmlMessage;
		$mail->AltBody = $message;
		if(!$mail->addEmbeddedImage("../newsletter-banner.png", "tixzoo")) {
			echo "Add tixzoo image failed";
		}
		if(!$mail->addEmbeddedImage("../lock-feature.png", "lock")) {
			echo "Add lock image failed";
		}
		if(!$mail->addEmbeddedImage("../money-feature.png", "money")) {
			echo "Add money image failed";
		}
		if(!$mail->addEmbeddedImage("../talk-feature.png", "talk")) {
			echo "Add talk image failed";
		}
		if(!$mail->addEmbeddedImage("../fi-social-facebook.png", "facebook")) {
    	echo "Add facebook failed";
		}
		if(!$mail->addEmbeddedImage("../fi-social-twitter.png", "twitter")) {
    	echo "Add twitter failed";
		}
		if(!$mail->addEmbeddedImage("../fi-social-instagram.png", "instagram")) {
    	echo "Add instagram failed";
		}

		if(!$mail->send()) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
		    echo 'Message has been sent';
		}

	}
}