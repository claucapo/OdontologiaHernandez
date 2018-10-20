<?php
if(isset($_POST['email'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "claucapo@gmail.com";
    $email_subject = "Consulta Página Web";

    function died($error) {
        // your error code can go here
        echo "Ocurrió un error. ";
        die();
    }


    // validation expected data exists
    if(!isset($_POST['nombre_completo']) ||
        !isset($_POST['telefono']) ||
        !isset($_POST['email']) ||
        !isset($_POST['mensaje']))) {
        died('Falto completar datos.');
    }



    $first_name = $_POST['nombre_completo']; // required
    $email_from = $_POST['email']; // required
    $telephone = $_POST['telefono']; // not required
    $comments = $_POST['mensaje']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }

    $string_exp = "/^[A-Za-z .'-]+$/";

  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }


  if(strlen($comments) < 2) {
    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
  }

  if(strlen($error_message) > 0) {
    died($error_message);
  }

    $email_message = "Form details below.\n\n";


    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }



    $email_message .= "Nombre Completo: ".clean_string($first_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Telefono: ".clean_string($telephone)."\n";
    $email_message .= "Mensaje: ".clean_string($comments)."\n";

// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);
?>

<!-- include your own success html here -->

Gracias por contactarnos, nos comunicaremos lo antes posible.

<?php

}
?>
