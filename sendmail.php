<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require 'path/to/PHPMailer/src/Exception.php';
    require 'path/to/PHPMailer/src/PHPMailer.php';

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.mail.ru';  																							// Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'permanentinna@mail.ru'; // Ваш логин от почты с которой будут отправляться письма
    $mail->Password = 'jrDg4T5s$'; // Ваш пароль от почты с которой будут отправляться письма
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465; // TCP port to connect to / этот порт может отличаться у других провайдеров

    $mail->setFrom('permanentinna@mail.ru'); // от кого будет уходить письмо?
    $mail->addAddress('innessa_drutman@mail.ru');

    $hand = "Правая";
    if($_POST['hand'] == "left") {
        $hand = "Левая";
    }

    $body = '<h1>Опа заявка на пермонент</h1>';

    if(trim(!empty($_POST['name']))){
        $body.='<p><strong>Имя:</strong> '.$_POST['name'].'</p>';
    }
    if(trim(!empty($_POST['email']))){
        $body.='<p><strong>E-mail:</strong> '.$_POST['email'].'</p>';
    }
    if(trim(!empty($_POST['hand']))){
        $body.='<p><strong>Рука:</strong> '.$_POST['hand'].'</p>';
    }
    if(trim(!empty($_POST['name']))){
        $body.='<p><strong>Имя:</strong> '.$_POST['name'].'</p>';
    }
    if(trim(!empty($_POST['message']))){
        $body.='<p><strong>Сообщение:</strong> '.$_POST['message'].'</p>';
    } 

    if (!empty($_FILES['image']['tmp_name'])){
        $filePath = __DIR__ . "/files/" . $_FILES['image']['name'];

        if (copy($_FILES['image']['tmp_ame'], $filePath)) {
            $fileAttach = $filePath;
            $body.='<p><strong>Фото в приложении:</strong></p>';
            $mail->addAttachment($fileAttach);
        }
    }

    $mail->Body = $body;

    if(!$mail->send()) {
        $message = 'Ошибка';
    } else {
        $message = 'Данные отправлены!'ж
    }
    $response = ['message' => $message];

    header('Content-type: application/json');
    echo json_encode($response);
?>