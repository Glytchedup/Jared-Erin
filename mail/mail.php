<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = 'Name: ' . $_POST[name] . '<br>';
    $email = 'E-mail: ' . $_POST[email] . '<br>';
    $guest = "Guest's Name: " . $_POST[guest] . '<br>';
    $attending = '#Attending: ' . $_POST[attending] . '<br>';

    $ip = getRealIpAddr();
    $message = "$name$email$guest$attending <br>From page: " . urldecode($_SERVER['HTTP_REFERER']) . "<br>IP: $ip\nBrowser: " . '<br>' . $_SERVER['HTTP_USER_AGENT'] . '<br>';
    $error = array();

    if (empty($error)) {
        $to = "davekubo@gmail.com";
        $subject = "RSVP Data";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <davekubo@gmail.com>' . "\r\n";

        mail($to, $subject, $message, $headers);
        echo json_encode(array('status' => 'success'));
    }
}

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
