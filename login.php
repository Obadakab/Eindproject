<?php

	include('functions.php');
	include("connectie.php");

?>
<!DOCTYPE html>
<html>
<head>
	<title>Login system PHP and MySQL</title>
	<link rel="stylesheet" type="text/css" href="style/loginlayout.css">

</head>
<body>

	<div class="navbar">
	<a href="lgoin.php">Home</a>
	<a id="log" href="login.php">Inloggen</a>
	</div>
 <div id="hform" class="wrapper fadeInDown">
    <div id="formContent">
      <!-- Tabs Titles -->
      <h2 class="active"> Inloggen </h2>
      <!-- Icon -->
      <div class="fadeIn first">
        <img src="images/user_profile.png" id="icon" alt="User Icon" />
      </div>
      <!-- Login Form -->
      <form method="post" action="login.php">
        <?php echo display_error(); ?>
        <input type="text" id="username" class="fadeIn second" name="username" placeholder="Gebruikernaam" >
        <input type="password" id="password" class="fadeIn third" name="password" placeholder="Wachtwoord" >
        <button id="login_btn" type="submit" class="fadeIn fourth" name="login_btn">Inloggen</button>
      </form>
      <!-- Remind Passowrd -->
      <div id="formFooter">
        <a class="underlineHover" href="register.php">Wachtwoord vergeten?</a>
      </div>
    </div>
  </div>
</body>
</html>
