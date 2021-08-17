<?php
include('../header.php');

if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>gebruikersdashboard</title>
	<link rel="stylesheet" type="text/css" href="../style/userlayout.css">
</head>
<body>
	<div class="header">
		<h2>Gebruikersdashboard</h2>
	</div>
	<div class="content">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php
						echo $_SESSION['success'];
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>
		<!-- logged in user information -->
		<div class="profile_info">
			<img src="../images/user_profile.png"  >

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i>
						<br>
						<div class="btn-group">
					<button type="button" onClick="window.location.href='../reservering/reserveringForm.php';">Nieuwe reservering</button>
					<button type="button" onClick="window.location.href='../reservering/reserveringOverzicht.php';">Reservering overzicht</button>
					<button type="button" onClick="window.location.href='../fpdf/factuurOverzicht.php';">Facturen overzicht</button>
						<br>
						
					</small>

				<?php endif ?>
				<?php  if (isAdmin()) : ?>
				
					<button type="button" onClick="window.location.href='inkome.php';">Inkome schema</button>
					<button type="button" onClick="window.location.href='create_user.php';"> + Voeg gebruiker toe</button>
				</div>
						<br>
						
					</small>
				<?php endif ?>
				<a href="user_dashbord.php?logout='1'" style="color: red;">Uitloggen</a>
			</div>
		</div>
	</div>
</body>
</html>
