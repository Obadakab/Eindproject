<?php
include("functions.php");
include("connectie.php");

if (!isLoggedIn()) {
  $_SESSION['msg'] = "You must log in first";
  header('location: login.php');
}
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../login.php");
}

$message = "wrong answer";
function alert($message) {
  // $message = "wrong answer";
  echo "<script type='text/javascript'>alert('$message');</script>";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../style/headerlayout.css">
</head>

<body>
  <div class="navbar">
    <a href="../user/user_dashbord.php">Home</a>
    <div class="dropdown">
      <button class="dropbtn">Reservering</button>
      <div class="dropdown-content">
        <a href="../reservering/reserveringForm.php">Nieuwe Reservering</a>
        <a href="../reservering/reserveringOverzicht.php">Reservering Overzicht</a>
      </div>
    </div>
    
        <a href="../fpdf/factuurOverzicht.php">Facturen Overzicht</a>
      
    <div>
      <!--<a id="log" href="uitloggen.php">Logout</a>-->
      <a id="log" href="../uitloggen.php">
        <div class="profile_info">

          <?php if (isset($_SESSION['user'])) : ?>
            <strong><?php echo $_SESSION['user']['username']; ?></strong>

            <small>
              <i style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i>
              <br>
            </small>

          <?php endif ?>
        </div>
    </div></a>
  </div>
  </div>


</body>

</html>