<?php
/**
* _Maila
*
* PHP version 5
*
* @category Maila
* @package  Innebandybokning
* @author   Markus Thulin <macky_b@hotmail.com>
* @license  http://www.opensource.org/licenses/mit-license.php MIT
* @link     https://github.com/thulin82/innebandybokning
*/
session_start();

require 'connect.php';
require 'PHPMailer-5.2.10/PHPMailerAutoload.php';

$gmail_account  = 'GMAIL_ACCOUNT';
$gmail_password = 'GMAIL_PASSWORD';
$gmail_title    = 'GMAIL_TITLE';
$gmail_body     = 'GMAIL_BODY';
$enable_guests  = false;

//ENABLE GUESTS
if ($enable_guests == true) {
    $mysqli->query('UPDATE variables SET value = 1 WHERE name="enable_guests"');
}

$mail = new PHPMailer();
$mail->IsSMTP();                              // Telling the class to use SMTP
$mail->Debugoutput = 'html';                  // Ask for HTML-friendly debug output
$mail->SMTPAuth    = true;                    // Enable SMTP authentication
$mail->SMTPSecure  = 'tls';                   // Sets the prefix to the servier
$mail->Host        = 'smtp.gmail.com';        // Sets GMAIL as the SMTP server
$mail->Port        = 587;                     // Set the SMTP port for GMAIL server
$mail->Username    = $gmail_account;          // GMAIL username
$mail->Password    = $gmail_password;         // GMAIL password
$mail->Subject     = $gmail_title;            // Title
$mail->SetFrom($gmail_account, $gmail_title); // Send mail from
$mail->MsgHTML($gmail_body);                  // Body

//Get name + email of those who have attend=2 (no answer)
$result = $mysqli->query('SELECT DISTINCT name, mail FROM users WHERE attend="2"');
$row    = $result->fetch_all(MYSQLI_ASSOC);
foreach ($row as $key => $value) {
    $mail->AddAddress($value['mail'], $value['name']);
}

if (!$mail->Send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';
}