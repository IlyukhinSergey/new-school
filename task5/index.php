<?php

require "vendor/autoload.php";
require "src/config.php";

try {
    // Инициализировать Swift Mailer
    $transport = (new Swift_SmtpTransport('smtp.mail.ru', 465))
      ->setUsername(MAIL_LOG)
      ->setPassword(MAIL_PASS)
      ->setEncryption('SSL'); //обязательно нужен для отправки

    // объект почтовой программы
    $mailer = new Swift_Mailer($transport);

    // создать экземпляр объекта Swift_Message
    $message = new Swift_Message();

    // Тема письма
    $message->setSubject('Тестирование отправки писем через SwiftMailer');

    // установка адреса "From" электронной почты
    $message->setFrom(['ilukhin.sergey@mail.ru' => "it's me"]);

    // адрес «Кому» по электронной почте
    $message->addTo('ilukhin.sergey@mail.ru', 'Sergey');

    // Add "CC" address [Use setCc method for multiple recipients, argument should be array]
    //$message->addCc('recipient@gmail.com', 'recipient name');

    // Add "BCC" address [Use setBcc method for multiple recipients, argument should be array]
    //$message->addBcc('recipient@gmail.com', 'recipient name');

    // Присоединение файлов
    //    $attachment = Swift_Attachment::fromPath('example.xls');
    //    $attachment->setFilename('report.xls');
    //    $message->attach($attachment);

    // Добавление изображения
    //    $inline_attachment = Swift_Image::fromPath('nature.jpg');
    //    $cid = $message->embed($inline_attachment);

    // Тело сообщения
    $message->setBody("This is the plain text body of the message.\nThanks,\nAdmin");

    // Set a "Body" для загрузки изображения
    //        $message->addPart('This is the HTML version of the message.<br>Example of inline image:<br><img src="' . $cid . '" width="200" height="200"><br>Thanks,<br>Admin',
    //          'text/html');

    // Отправка сообщения
    $result = $mailer->send($message);
    echo 'Сообщение отправлено';
} catch (Exception $e) {
    echo $e->getMessage();
}
