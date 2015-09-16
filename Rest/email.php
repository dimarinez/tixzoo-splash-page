<?php
require 'PHPMailer-master/PHPMailerAutoload.php';
$htmlFile = fopen('../newsletter.html', "r") or die("Unable to open file");
$htmlMessage = fread($htmlFile, filesize('../newsletter.html'));
fclose($htmlFile);
$mail = new PHPMailer;

$mail->SMTPDebug = 3;                               // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtpout.secureserver.net';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'tixzooadmin@mytixzoo.com';                 // SMTP username
$mail->Password = 'computer123';                           // SMTP password
//$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 80;                                    // TCP port to connect to
$mail->From = 'tixzooadmin@mytixzoo.com';
$mail->FromName = 'AutoMailer';
//$mail->addAddress('arusse02@gmail.com', 'Aubs test');     // Add a recipient
$mail->addAddress('nickliuyanzhe@gmail.com');               // Name is optional
$mail->addReplyTo('tixzooadmin@mytixzoo.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Tixzoo test subject';
$mail->Body    = $htmlMessage;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
/**
     * Add an embedded (inline) attachment from a file.
     * This can include images, sounds, and just about any other document type.
     * These differ from 'regular' attachments in that they are intended to be
     * displayed inline with the message, not just attached for download.
     * This is used in HTML messages that embed the images
     * the HTML refers to using the $cid value.
     * @param string $path Path to the attachment.
     * @param string $cid Content ID of the attachment; Use this to reference
     *        the content when using an embedded image in HTML.
     * @param string $name Overrides the attachment name.
     * @param string $encoding File encoding (see $Encoding).
     * @param string $type File MIME type.
     * @param string $disposition Disposition to use
     * @return boolean True on successfully adding an attachment
     */
if(!$mail->addEmbeddedImage("../NEW-TIXZOO.png", "tixzoo")) {
	echo "Add tixzoo failed";
}
if(!$mail->addEmbeddedImage("../lock-feature.png", "lock")) {
	echo "Add lock failed";
}
if(!$mail->addEmbeddedImage("../money-feature.png", "money")) {
	echo "Add money failed";
}
if(!$mail->addEmbeddedImage("../talk-feature.png", "talk")) {
	echo "Add talk failed";
}
	if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
