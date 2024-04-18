<?php

require 'connection.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


$stmt = $conn->prepare("SELECT * FROM to_do_data WHERE id = :send_id");
$stmt->bindParam(':send_id', $send_id, PDO::PARAM_INT);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
  $due_date = $row['due_date'];
  $checked_val = $row['checked'];

  if ($checked_val == 1) {
    $current_date = date('Y-m-d');
    $diff_seconds = strtotime($due_date) - strtotime($current_date);
    $days_left = floor($diff_seconds / (60 * 60 * 24));
    if ($days_left == 1) {
      $html = "test";
      $to_email = "abc@gmail.com";
      $subject = "Test Email";

      $result = smtp_mailer($to_email, $subject, $html);
      echo $result;
    }
  }
}

function smtp_mailer($to, $subject, $msg)
{
  $mail = new PHPMailer(true);

  try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'himanshu jaiswal';
    $mail->Password = 'your_gmail_password';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('abc@gmail.com', 'himanshu');
    $mail->addAddress($to);

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $msg;

    $mail->send();
    return 'Email sent successfully';
  } catch (Exception $e) {
    return "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}

?>