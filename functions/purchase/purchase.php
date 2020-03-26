<?php
require_once "purchase_config.php";

$firstname = $lastname = $cardnumber = $securitycode = $expiryyear = "";
$firstname_err = $lastname_err = $cardnumber_err = $securitycode_err = $expiryyear_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

	if(empty(trim($_POST["cardnumber"]))){
		$cardnumber_err = "Please enter your credit card number.";
	}else{
		$cardnumber = trim($_POST["cardnumber"]);
	}

	if(empty(trim($_POST["firstname"]))){
		$firstname_err = "Please enter your first name.";
	}else{
		$firstname = trim($_POST["firstname"]);
	}

	if(empty(trim($_POST["lastname"]))){
		$lastname_err = "Please enter your first name.";
	}else{
		$lastname = trim($_POST["lastname"]);
	}

	if(empty(trim($_POST["securitycode"]))){
		$securitycode_err = "Please enter the security code.";
	}else{
		$securitycode = trim($_POST["securitycode]);
	}

	if(empty(trim($_POST["expiryyear"]))){
		$expiryyear_err = "Please enter the expiry year.";
	}else{
		$expiryyear = trim($_POST["expiryyear]);
	}

	if(empty($firstname_err) && ($lastname_err) && (cardnumber_err) && (securitycode_err) && (expiryyear_err)){
		$sql = "SELECT first_name, last_name, card_number, security_code, expiry_year FROM card_information WHERE cardnumber = ?";
		
		if(stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "s", $param_cardnumber);
			$param_cardnumber = $cardnumber;

			if(mysqli_stmt_execute($stmt)){
				mysqli_stmt_store_result($stmt);
				
				if(mysqli_stmt_rows($stmt) == 1){
					mysqli.stmt_bind_result($stmt, $first_name, $last_name, $card_number, $security_code, $expiry_year);
					if(mysqli_stmt_fetch($stmt)){
						if(firstname_verify($firstname, $first_name) && lastname_verify($lastname, $last_name) && securitycode_verify($securitycode, $security_code) && expiryyear_verify($expiryyear, $expiry_year)){
							session_start();

							$_SESSION["Card_confirmed"] = true;
							header("location: Payment_OK.php");
						}else{
						 	echo "<script type='text/javascript'>alert('Wrong information!')</script>";
						}
					}
				}else{
					echo "<script type='text/javascript'>alert('Credit card number does not exist.')</script>";
				}
			}else{
				echo "Oops! Something went wrong. Please try again later.";
			}
			mysqli_stmt_close($stmt);
		}
	}
	mysqli_close($link);
}
