<?php 
  //This is the directory where images will be saved 
  $target = 'uploads/'; 
  $target = $target . basename( $_FILES['upload']['name']); 

  //This gets all the other information from the form 
  $pic=($_FILES['upload']['name']); 

  //Writes the photo to the server 
  if(move_uploaded_file($_FILES['upload']['tmp_name'], $target)) 
  { 
  //Tells you if its all ok 
    echo "The file ". basename( $_FILES['upload']['name']). " has been uploaded, and your information has been added to the directory"; 
  } 
  else { 
  //Gives and error if its not 
    echo "Sorry, there was a problem uploading your file."; 
  } 
?>

<?php
function IsInjected($str)
{
    $injections = array('(\n+)',
           '(\r+)',
           '(\t+)',
           '(%0A+)',
           '(%0D+)',
           '(%08+)',
           '(%09+)'
           );
    $inject = join('|', $injections);
    $inject = "/$inject/i";
    if(preg_match($inject,$str))
    {
      return true;
    }
    else
    {
      return false;
    }
}

// Function used to attach files to the message
function phattach($file, $name, $boundary) {
  
  $fp=fopen($file, "r");
  $str=fread($fp, filesize($file));
  $str=chunk_split(base64_encode($str));
  $message="--".$boundary."\n";
  $message.="Content-Type: application/octet-stream; name=\"".$name."\"\n";
  $message.="Content-disposition: attachment; filename=\"".$name."\"\n"; 
  $message.="Content-Transfer-Encoding: base64\n";
  $message.="\n";
  $message.="$str\n";
  $message.="\n";

  return $message;
}



//Little bit of security from people forging headers. People are mean sometimes :(
function clean_msg($key) {
  $key=str_replace("\r", "", $key);
  $key=str_replace("\n", "", $key);
  $find=array(
    "/bcc\:/i",
    "/Content\-Type\:/i",
    "/Mime\-Type\:/i",
    "/cc\:/i",
    "/to\:/i"
  );
  $key=preg_replace($find, "", $key);
  return $key;
}
?>



<?php

$boundary=md5(uniqid(time()));

if(isset($_POST['submit'])) {
     
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "ultimaxslc@gmail.com";

    //this has to be dynamic in the form of [dW Download2Win][email] space Submission
    $email_subject = "Your email subject line";
     
    /* 
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
     
    // validation expected data exists
    if(!isset($_POST['first_name']) ||
        !isset($_POST['last_name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telephone']) ||
        !isset($_POST['comments'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
    */ 
    $first_name = $_POST['first_name']; // required
    $last_name = $_POST['last_name']; // required
    $occupation = $_POST['occupation']; 
    $email_from = $_POST['email']; // required
    $contactno = $_POST['contactno']; // not required
    $country = $_POST['country']; // not required
    $howknow = $_POST['howknow']; //required
    $feedback = $_POST['feedback']; // not required

    if (IsInjected($feedback)){
      exit;
    }
  

    /* 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
    $string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }
  if(!preg_match($string_exp,$last_name)) {
    $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
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
    */ 
    $email_message .= "First Name: ".$first_name."\n";
    $email_message .= "Last Name: ".$last_name."\n";
    $email_message .= "Occupation: ".$occupation."\n";
    $email_message .= "Email: ".$email_from."\n";
    $email_message .= "Country: ".$country."\n";
    $email_message .= "Contact No: ".$contactno."\n";
    $email_message .= "How they knew: ".$howknow."\n";
    $email_message .= "Feedback: ".$feedback."\n";
    $email_message .=phattach($target, $_FILES['upload']['name'], $boundary);
     
     
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();


    $headers="Return-Path: <".$email_from.">\n";
    $headers.="From: ".$first_name." ".$last_name." <".$email_from.">\n";
    $headers.="X-Mailer: PHP/".phpversion()."\n";
    $headers.="X-Sender: ".$_SERVER['REMOTE_ADDR']."\n";
    $headers.="X-Priority: 3\n"; 
    $headers.="MIME-Version: 1.0\n";
    $headers.="Content-Type: multipart/mixed; boundary=\"".$boundary."\"\n";
    $headers.="This is a multi-part message in MIME format.\n";


@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- include your own success html here -->
 
Thank you for contacting us. We will be in touch with you very soon.<br>

<?php

echo $headers;

?>
 
<?php
}
?>

