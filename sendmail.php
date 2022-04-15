<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;


    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';

    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    $mail->setLanguage('ru', 'phpmailer/language/');
    $mail->IsHTML(true);

    // від кого лист
    $mail->setFrom('info@fls.guru', 'фрілансер по життю');
    // кому віправити
    $mail->addAddress('svecv398@gmail.com');
    // тема листа
    $mail->Subject = 'Привіт! Це фрілансер по життю"';

    //Рука
    $hand = "Права";
    if($_POST['hand'] =="left"){
        $hand= "Ліва";
    }

    $body = '<h1>Зустрічайте супер лист</h1>';

    if(trim(!emty($_POST['name']))){
        $body.='<p><strong>Імя:</strong> '.$_POST['name'].'</p>';
    }

    if(trim(!emty($_POST['email']))){
    $body.='<p><strong>E-mail:</strong> '.$_POST['email'].'</p>';
    }

    if(trim(!emty($_POST['hand']))){
        $body.='<p><strong>Рука:</strong> '.$hand.'</p>';
    }

    if(trim(!emty($_POST['age']))){
        $body.='<p><strong>Вік:</strong> '.$_POST['age'].'</p>';
    }

    if(trim(!emty($_POST['massage']))){
        $body.='<p><strong>Повідомлення:</strong> '.$_POST['message'].'</p>';
        }
    //Прикріпити файл
    if (!emty($_FILES['image']['tmp_name'])) {
        //Шлях загрузки файла
        $filePath = __DIR__ . "/files/" . $_FILES['image']['name'];
        //Загрузка файла
        if (copy($_FILES['image']['tmp_name'], $filePath)) {
        $fileAttach = $filePath;
        $body.='<><strong>Фото в додатку</strong>';
        $mail->addAttachment($fileAttach);
        }
    }

    mail->Body = $body;

    //Відправка
    if (!$mail->send()) {
        $message = 'Помилка';
    } else {
        $message = 'Дані відправлені!';
    }

    $response = ['message' => $message];

    header('Content-type: application/json');
    echo json_encode($response);
?> 