<?php
$to_email = "rubel.webappick@gmail.com";
$subject = "Simple Email Test via PHP";
$body = "Hi, This is test email send by PHP Script";
$headers = "From: rubelcuet@gmail.com";

if ( mail($to_email, $subject, $body, $headers )) {
    echo "Email successfully sent to $to_email...";
} else {
    echo "Email sending failed...";
}