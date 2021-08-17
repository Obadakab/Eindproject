<?php 

include('../header.php');
include("../connectie.php");

if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../login.php");
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL - Create user</title>
	<link rel="stylesheet" type="text/css" href="../style/adminlayout.css">
	<style>

		.btn-register button{
			background-color: #f4511e; /* Green background */
			color:#dff0d8;
			border: 1px solid #acceec; /* Green border */
			border-radius: 4px;
			padding: 10px ; /* Some padding */
			cursor: pointer; /* Pointer/hand icon */
			margin: 2px  4px  2px  4px;
			text-align: center;
			float: center; /* Float the buttons side by side */
		}
		  /* Add a background color on hover */
		  .btn-register button:hover,input[type="submit"]:hover {
			background-color: #b9ff99;
			color:black;
			}
	</style>
</head>
<body>
	<div class="header">
		<h2>Admin - gebruiker aanmaken</h2>
	</div>
	<form method="post" action="create_user.php">
		<?php echo display_error(); ?>
		<div class="input-group">
			<label>gebruikersnaam</label>
			<input type="text" name="username" value="<?php echo $username; ?>">
		</div>
		<div class="input-group">
			<label>E-mail</label>
			<input type="email" name="email" value="<?php echo $email; ?>">
		</div>
		<div class="input-group">
			<label>Gebruikerstype</label>
			<select name="user_type" id="user_type" >
				<option value=""></option>
				<option value="admin">Admin</option>
				<option value="user">Gebruiker</option>
			</select>
		</div>
		<div class="input-group">
			<label>Wachtwoord</label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group">
			<label>Bevestig wachtwoord</label>
			<input type="password" name="password_2">
		</div>
		<div class="btn-register">
			<button type="submit" class="btn" name="register_btn"> + Gebruiker aanmaken</button>
			<button type ="button" value="terug naar User dashbord" onClick="window.location.href='user_dashbord.php';">terug naar Admin dashbord</button>
		</div>
	</form>
</body>
</html>
