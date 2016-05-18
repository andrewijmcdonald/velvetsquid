<?php

$to = "hello@velvetsquid.com"; # <--- Your Email 
$subject = "You received a mail from your website's contact form.";


if ($_POST) {
  # about
  $name = stripslashes($_POST['fullname']);
  $name = stripslashes($_POST['businessname']);
  $email = trim($_POST['email']);
  $phone = stripslashes($_POST['phone']);
  # services?
  $service = implode(', ', $_POST['service'] );
  # builds?
  $build = implode(', ', $_POST['build'] );

  $message = htmlspecialchars($_POST['message']);
  $guests = stripslashes($_POST['guests']);
  $date = stripslashes($_POST['date']);

  $error = '';

  if (!$name) {
    $error .= '<p>Enter your name</p>';
  }

  if (!$service) {
    $error .= '<p>Please select a service</p>';
  }

  if (!$build) {
    $error .= '<p>Please select a type of project</p>';
  }

  if (!$email) {
    $error .= '<p>Enter your email</p>';
  }

  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $error .= "<p>E-mail is not valid</p>";
  }

  $mess = "Full Name: " . $name . "\r\n";
  $mess .= "Email: " . $email . "\r\n";
  if ($phone) {
    $mess .= "Phone:" . $phone . "\r\n";
  }
  if ($build) {
    $mess .= "Build:" . $build . "\r\n";
  }
  if ($service) {
    $mess .= "Service:" . $service . "\r\n";
  }

  if ($message) {
    $mess .= "Message: " . $message . "\r\n";
  }
  if ($guests) {
    $mess .= "Guests:" . $guests . "\r\n";
  }
  if ($date) {
    $mess .= "Date:" . $date . "\r\n";
  }

  if (!$error) {
    $mail = mail($to, $subject, $mess,
    "From: ".$name." <".$email.">\r\n"
    ."Reply-To: ".$name."<".$email.">\r\n"
    );

    if ($mail) {
      header('Location: thanks.html');
    }
    else{
      header('HTTP/1.1 500 ' . $error );
      exit();
    }
  }
  else{
    echo $error;
  }
}

?>
