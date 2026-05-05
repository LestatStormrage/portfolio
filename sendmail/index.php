<?php
// Налаштування відправки
require 'config.php';
if (!empty($_POST['company'])) {
    exit; // bot detected
}
//Від кого лист
$mail->setFrom('info@stormrageweb.com', 'Stormrage Web'); // Вказати потрібний E-mail
//Кому відправити 
$mail->addAddress('clients@stormrageweb.com'); // Вказати потрібний E-mail
//Тема листа
$mail->Subject = 'You have a message from a potential client!';

//Тіло листа
$body = '<h1>New client!</h1>';

if(trim(!empty($_POST['name']))){
	$body.= '<p>Name: '.$_POST['name'].'</p>';
}	
if(trim(!empty($_POST['email']))){
	$body.= '<p>Email: '.$_POST['email'].'</p>';
}	
if(trim(!empty($_POST['message']))){
	$body.= '<p>Message: '.$_POST['message'].'</p>';
}	


/*
	//Прикріпити файл
	if (!empty($_FILES['image']['tmp_name'])) {
		//шлях завантаження файлу
		$filePath = __DIR__ . "/files/sendmail/attachments/" . $_FILES['image']['name']; 
		//грузимо файл
		if (copy($_FILES['image']['tmp_name'], $filePath)){
			$fileAttach = $filePath;
			$body.='<p><strong>Фото у додатку</strong>';
			$mail->addAttachment($fileAttach);
		}
	}
	*/

$mail->Body = $body;

//Відправляємо
if (!$mail->send()) {
	$message = 'Error';
} else {
	$message = 'Message sent!';
}

$response = ['message' => $message];

header('Content-type: application/json');
echo json_encode($response);
