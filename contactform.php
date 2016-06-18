<!DOCTYPE html>
<?php
  /*
		

  */
function filterForm ($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}



$fullName = $phone = $email = $callTime = $message = $phoneErr = $fullNameErr = $emailErr = $company = "";
$sendEmail = true;


  if ($_SERVER["REQUEST_METHOD"] == "POST"){
  	if (empty($_POST["fullName"])){
  		$fullNameErr = "Name is required";
      $sendEmail = false;
  	} else {
  		$fullName = filterForm($_POST["fullName"]);
      if (!preg_match("/^[a-zA-Z ]*$/", $fullName)){
        $fullNameErr = "Only letters and white space allowed";
        $sendEmail = false;
      }
  	}
  	
  	$phone = filterForm($_POST["phone"]);
  	if (!preg_match("/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i", $phone)){
  		$phoneErr = "Invalid phone number format";
  		$sendEmail = false;
  	}
  	
  	if (empty($_POST["email"])){
  		$emailErr = "Email address is required";
      $sendEmail = false;
  	} else {
  		$email = filterForm($_POST["email"]);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $emailErr = "Invalid email format";
        $sendEmail = false;
      }
  	}
  	//$callTime = filterForm($_POST["callTime"]);
  	$message = filterForm($_POST["message"]);
  	$company = filterForm($_POST["company"]);

  	echo  $fullNameErr  . "<br>" . $phoneErr . "<br>" . $emailErr;

  	if ($sendEmail){

  		$package = $fullName . "<br>" . $phone . "<br"> . $email . "<br>" . $company . "<br>" . $message . "<br>";

  		/*
  		*UNCOMMENT MAIL LINE BEFORE DEPLOYING
  		*/
  		mail ("jordi@hookandshadow.com", "H&S Query", $package);

  		//UNCOMMENT THE NEXT TWO LINES OUT BEFORE DEPLOYING
  		echo $package;
  		echo "Email sent";
  	}
  }
 ?>


