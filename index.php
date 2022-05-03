<?php


$result="";

if(isset($_POST['submit'])){
  require 'PHPMailer/PHPMailer-5.2-stable/PHPMailerAutoload.php';
     $mail = new PHPMailer;

     $mail->isSMTP();                                      // Set mailer to use SMTP
     $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
     $mail->SMTPAuth = true;                               // Enable SMTP authentication
     $mail->Username = 'systemclinic21@gmail.com';                 // SMTP username
     $mail->Password = 'AG2ASFNasdafa**12345';                           // SMTP password
     $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
     $mail->Port = 587;     

     $mail->setFrom('vinlothyvine@gmail.com', 'Mailer'); //mao ni ang mosend sa gmail
      $mail->addAddress('systemclinic21@gmail.com', 'User');  //kani ang makadawat ug email sa  gmail
     //$mail->addReplyto($_POST['email'],$_POST['name']);
     

    $mail->isHTML(true);
   // $mail->Subject = 'Form Submission: '.$_POST['subject'];
     $mail->Subject = 'Consultation';
    $mail->Body='<h1 align=center> Date & Time: ' .$_POST['dateandtime']. '<br> Name: '.$_POST['name']. '<br> Email: '.$_POST['email']. '<br> Course/Year/Section: '.$_POST['courseyear']. '<br> Age/Sex: '.$_POST['agesex']. '<br> Complain(s): '.$_POST['complain'].'</h1>';


    if(!$mail->send()) {
      $result="Something went wrong. Please try again.";
  } else {
    $result="Thank You ".$_POST['name']." for consulting us. We'll get back to you soon!";
  }

     }
?>

<?php
$mysqli = new mysqli('localhost', 'root', '', 'capstone') or die (mysqli_error($mysqli));
session_start();
if(isset($_SESSION["active"]) && $_SESSION["status"]=='admin'){
 header("Location: home.php");
}else{
?>
<?php
}

    if (isset($_POST['login'])) {
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

		
		$email = $_POST['email'];
		$password = $_POST['password'];

  
  $mysqli = new mysqli('localhost', 'root', '', 'capstone') or die (mysqli_error($mysqli));
  
  $query=mysqli_query($mysqli,"select * from `login` where email='$email' && password=MD5('$password')");
  $num_rows=mysqli_num_rows($query);
  $row=mysqli_fetch_array($query);
    $_SESSION["userf"]=$row['firstname'];
    $_SESSION["userl"]=$row['lastname'];
	$_SESSION["status"]=$row['status'];
    $_SESSION["active"]=$row['firstname'];
    $_SESSION["active2"]=$row['lastname'];
  if ($_SESSION['status']=='admin'){
   // echo $Message;
   // include "home.php";
    ?>
    <script type="text/javascript">
      alert("Login Successful.");
      window.location = "home.php";
    </script>

    <?php
   }?>
   <?php
  
  if ($num_rows>0){
    $Message = "Login Successful!";
  }
  else{
  $Message = "Login Failed! User not found";
  $_SESSION['message']=$Message;
  unset($_SESSION['active']);
  unset($_SESSION['active2']);
  unset($_SESSION['userf']);
  unset($_SESSION['userl']);
  session_destroy();
     $_SESSION['message'] = "Email/Password Incorrect";
 
  }
  
  }
}

function check_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
  <meta name="author" content="Sahil Kumar">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Consult Us</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">



  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Log in</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

	<style>
	.section {
	position: relative;
	height: 100vh;
}

.section .section-center {
	position: absolute;
	top: 50%;
	left: 0;
	right: 0;
	-webkit-transform: translateY(-50%);
	transform: translateY(-50%);
}

#booking {
	font-family: 'Montserrat', sans-serif;
	background-image: url('pictures/clinic.jpg');
	background-size: cover;
	background-position: center;
}

#booking::before {
	content: '';
	position: absolute;
	left: 0;
	right: 0;
	bottom: 0;
	top: 0;
	background: rgba(110, 122, 147, 0.6);
}

.booking-form {
	background-color: #EAF2F7;
	padding: 40px 20px;
	-webkit-box-shadow: 0px 5px 20px -5px rgba(0, 0, 0, 0.3);
	box-shadow: 0px 5px 20px -5px rgba(0, 0, 0, 0.3);
	border-radius: 4px;
}

.booking-form .form-group {
	position: relative;
	margin-bottom: 20px;
	margin-top: 20px;
}

.booking-form .form-group-remember-me
{
	position: relative;
	margin-bottom: 10px;
	margin-top: 20px;
	font-size: 14px;
}

.booking-form .form-control {
	background-color: #C5DACB;
	border-radius: 4px;
	border: none;
	height: 40px;
	-webkit-box-shadow: none;
	box-shadow: none;
	color: #3e485c;
	font-size: 14px;
}

.booking-form .form-control::-webkit-input-placeholder {
	color: rgba(62, 72, 92, 0.3);
}

.booking-form .form-control:-ms-input-placeholder {
	color: rgba(62, 72, 92, 0.3);
}

.booking-form .form-control::placeholder {
	color: rgba(62, 72, 92, 0.3);
}

.booking-form input[type="date"].form-control:invalid {
	color: rgba(62, 72, 92, 0.3);
}

.booking-form select.form-control {
	-webkit-appearance: none;
	-moz-appearance: none;
	appearance: none;
}

.booking-form select.form-control+.select-arrow {
	position: absolute;
	right: 0px;
	bottom: 4px;
	width: 32px;
	line-height: 32px;
	height: 32px;
	text-align: center;
	pointer-events: none;
	color: rgba(62, 72, 92, 0.3);
	font-size: 14px;
}

.booking-form select.form-control+.select-arrow:after {
	content: '\279C';
	display: block;
	-webkit-transform: rotate(90deg);
	transform: rotate(90deg);
}

.booking-form .form-label {
	display: inline-block;
	color: #3e485c;
	font-weight: 700;
	margin-bottom: 6px;
	margin-left: 7px;
}

.booking-form .submit-btn {
	display: inline-block;
	color: #fff;
	background-color: #158434;
	font-weight: 700;
	padding: 9px 30px;
	border-radius: 4px;
	border: none;
	-webkit-transition: 0.2s all;
	transition: 0.2s all;
}

.booking-form .submit-btn:hover,
.booking-form .submit-btn:focus {
	opacity: 0.9;
}

.booking-cta {
	margin-top: 100px;
	margin-bottom: 30px;
}

.booking-cta h3 {
	font-size: 32px;
	/*text-transform: uppercnase;*/
	color: #fff;
	font-weight: 700;
}

.booking-cta p {
	font-size: 20px;
	color: rgba(255, 255, 255, 0.8);

}

.text-center
{
	font-weight: bold;
	font-size: 30px;
}
      html{
        scroll-behavior: smooth;
      }
      .parallax {
        /* The image used */
        background-image: url("Z");
        /* Set a specific height */
        min-height: 700px; 
        /* Create the parallax scrolling effect */
        background-attachment: absolute;
        background-position: center;
        background-positgb(28, 28, 28);
      } */
      /* @media (max-width: 500px)
      {
        #sample{
          z-index: 1;
        }
      } */ion: 50% 50%;
        background-repeat: no-repeat;
        background-size: cover;
      }p,h3,h4,h5,tr,td,a,b,h1{
        font-family: 'Roboto', sans-serif !important; 
      }
      #userloginbtn:hover{
        background-color: rgb(231, 10, 10) !important;
      }
      #username:focus{
        transform: 0.5s;
        border-bottom: 2px solid orangered !important;
      }
      #password:focus{
        transform: 0.5s;
        border-bottom: 2px solid orangered !important;
      }


	</style>
		
</head>

<body id="home">

<!--NAVIGATION BAR-->
<nav class="navbar navbar-expand-md navbar-dark fixed-top" style="background-color: rgb(72 72 72 / 24%);">
  <div class="container">
    <a class="navbar-brand" href="index.php">
		<!-- diri e butang ang logo-->
          <img src=".." alt="" width="" height="">
        </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#home">Home
                <span class="sr-only">(current)</span>
              </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#consultus">Consult Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#available medicines">Available Medicines</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


	<div id="booking" class="section">
		<div class="section-center">
			<div class="container">
				<div class="row">
					<div class="col-md-7 col-md-push-5">
						<div class="booking-cta">

						
					

							<h3>CEBU TECHNOLOGICAL UNIVERSITY Naga Extension Campus</h3>
 							<p> A Premier, Multidisciplinary, Technological University.</p>
						</div>
					</div>
					<div class="col-md-4 col-md-pull-7">
						<div class="booking-form">
						<div class="text-center" > Log in</div>
							<form method="POST" action="#">
		<center>
		<! this is a php message error starts here !>	
		<br>
	       <?php
           if (isset($_SESSION['message'])): ?>
           <div class="text-danger">
           <?php  
           echo $_SESSION['message'];
           unset($_SESSION['message']);
           ?>
           </div>
           <?php endif ?>
		<! this is a php message error ends here !>	
		</center>
								<div class="form-group">
									<span class="form-label">User Name</span>
									<input class="form-control" placeholder="Enter User Name" id="email" name="email" type="text"  required>
								</div>
								<div class="form-group">
									<span class="form-label">Password</span>
									<input class="form-control" placeholder="Enter Your Password" id="pass" name="password" type="password" value="" required>
								</div>
								<div class="form-group-remember-me">
                        <input type="checkbox" name="remember">
                        <label class="text-black-50" for="remember-me"> Remember me </label>
                    </div>	
								<div class="form-btn">
									<button class="submit-btn" name="login">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	
	<div class="container-fluid" style="padding-top: 2%;" id="consultus">		
	<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-4 mt-5 bg-light rounded">
         <h1 class="text-center font-weight-bold text-primary">Consult Us</h1>
        <hr class="bg-light">
        <h5 class="text-center text-success"> <?= $result; ?> </h5>

         <form action="" method="post" id="form-box" class="p-2">

         <h5>Date & Time</h5>
         <div class="form-group input-group">
            <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
             </div>
            <input type="text" name="dateandtime" class="form-control" placeholder="F : MM/DD/YYYY - 00:00 AM/PM" 
                required>
           </div>

           <h5>Name</h5>
           <div class="form-group input-group">
            <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
             </div>
            <input type="text" name="name" class="form-control" placeholder="John Doe" 
                required>
           </div>

           <h5>Email</h5>
           <div class="form-group input-group">
            <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
           </div>
             <input type="email" name="email" class="form-control" placeholder="JohnDoe@gmail.com" 
             required>
           </div>

           <h5>Couse/Year/Section</h5>
           <div class="form-group input-group">
            <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
             </div>
            <input type="text" name="courseyear" class="form-control" placeholder="BSIT 4A - DAY" 
                required>
           </div>

           <h5>Age/Sex</h5>
           <div class="form-group input-group">
            <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
             </div>
            <input type="text" name="agesex" class="form-control" placeholder="18 - M" 
                required>
           </div>

           <h5>Complain(s)</h5>
          <div class="form-group input-group">
          <div class="input-group-prepend">
           <span class="input-group-text"><i class="fas fa-comment-alt"></i></span>
          </div>
           <textarea name="complain" id="complain" class="form-control" placeholder="Write your complain here."
          cols="30" rows="4" required></textarea>
          </div>

           <div class="form-group">
          <input type="submit" name="submit" id="submit" class="btn btn-primary btn-block"
          value="Send">
          </div>

        </form>
     </div>
   </div>
 </div>
 </div>
            
             
            </div>            
        </div>
    </div>
</div>

</body>

</html>