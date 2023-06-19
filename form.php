<?php
if(isset($_POST['Email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "16ucc003@lnmiit.ac.in";
    $email_subject = "IWMA 2019 Query";
 
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['Full_Name']) ||
        !isset($_POST['Email'])||
        !isset($_POST['Query']) ||
        !isset($_POST['Organisation'])  ||
        !isset($_POST['Role'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
     
 
    $full_name = $_POST['Full_name']; // required
    $query = $_POST['Query']; // required
    $email_from = $_POST['Email']; // required
    $organisation = $_POST['Organisation']; // not required
    $role = $_POST['Role']; // required
    $phone = $_POST['Phone_No'];
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$full_name)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }
 
  if(!preg_match($string_exp,$query)) {
    $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Form details below.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "Full Name: ".clean_string($full_name)."\n";
    $email_message .= "Organisation: ".clean_string($organisation)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Telephone: ".clean_string($phone)."\n";
    $email_message .= "role: ".clean_string($role)."\n";
    $email_message .= "Query: ".clean_string($query)."\n";
// create email headers
  $email = "16ucc003@lnmiit.ac.in"
$headers = 'From: '.$email."\r\n".
'Reply-To: '.$email."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
}
?>
 