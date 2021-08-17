<?php
include("../header.php");
include("../connectie.php");

if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../style/reserveringVerwijderLayout.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<div class='container'>
<div class='deleted' id='deleted'>
    <?php

    if (isset($_POST['submit'])) {
        $reserveringnr = $_POST["reserveringnr"];

        $query = "DELETE reservering,klanten,factuur FROM reservering
            INNER JOIN klanten on reservering.klantnr=klanten.klantnr
            INNER JOIN factuur on reservering.factuurid=factuur.factuurid
            WHERE reservering.reserveringnr =$reserveringnr";
        $query1 = "DELETE FROM optie WHERE reserveringnr =$reserveringnr";
        mysqli_query($conn, $query);
        mysqli_query($conn, $query1);

        if (mysqli_query($conn, $query)&& mysqli_query($conn, $query1)) {
            echo "<p>De boeking is successvol verwijderd";
        } else {
            echo "<p>De boeking is niet successvol verwijderd" . mysqli_error($conn);
        }
    }

    ?>
    <br>
    
    <input type="button" value="terug naar overzicht" onClick="window.location.href='reserveringOverzicht.php';">
    </div>
</div>
</body>

</html>