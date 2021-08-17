<?php
include("../connectie.php");
include("../functions.php");

if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="../style/factuurOverzichtLayout.css">
	<title>reserveringoverzicht</title>

</head>

<body>


	<?php

	$limit = 10;  
	if (isset($_GET["page"])) {
		$page  = $_GET["page"]; 
		} 
		else{ 
		$page=1;
		};  
	$start_from = ($page-1) * $limit; 
	
	$output = "";
	if (isset($_POST['query'])) {
	$search = mysqli_real_escape_string($conn, $_POST['query']);
	$sql = "SELECT *,
    CONCAT(klanten.prefix,'-',klanten.klantnr) AS 'klantId',
    CONCAT(factuur.prefix,'-',factuur.factuurid) AS 'factuurId', 
    CONCAT(reservering.prefix,'-',reservering.reserveringnr) AS 'reserveringId' FROM reservering 
    JOIN klanten ON klanten.klantnr = reservering.klantnr
    JOIN plaatsen ON reservering.plaatsnr = plaatsen.plaatsnr
    JOIN factuur ON reservering.factuurid=factuur.factuurid 
    WHERE  reservering.reserveringnr  LIKE '%".$search."%'
    OR klanten.klantnr LIKE '%".$search."%' 
    OR reservering.plaatsnr LIKE '%".$search."%' 
    OR reservering.factuurid LIKE '%".$search."%'
    OR datumaankomst LIKE '%".$search."%'
    OR datumvertrek LIKE '%".$search."%'
    OR voornaam LIKE '%".$search."%'
    OR achternaam LIKE '%".$search."%'
    OR plaatsid LIKE '%".$search."%'
	OR status LIKE '%".$search."%'
	";}
else
{
	$sql = "SELECT *,
    CONCAT(klanten.prefix,'-',klanten.klantnr) AS 'klantId',
    CONCAT(factuur.prefix,'-',factuur.factuurid) AS 'factuurId', 
    CONCAT(reservering.prefix,'-',reservering.reserveringnr) AS 'reserveringId'
    FROM reservering 
    JOIN klanten ON reservering.klantnr = klanten.klantnr
    JOIN plaatsen ON reservering.plaatsnr = plaatsen.plaatsnr
    JOIN factuur ON reservering.factuurid=factuur.factuurid
    ORDER BY reservering.reserveringnr DESC";
}
	$query = mysqli_query($conn, $sql);
	if (mysqli_num_rows($query) > 0) {
		$output .= "
		<div id=tablecontent style=overflow-x:auto;>
		<table class='center' id='info'>
	<thead>
		<tr>
		<th>Reservering Nr.</th>
		<th>Klant Nr.</th>
		<th>Factuur Nr.</th>
		<th>factuurstatus</th>
		<th>Voornaam</th>
		<th>Achternaam</th>
		<th>Datumaankomst</th>
		<th>Datumvertrek</th>
		<th>Plaats.nr</th>
		<th>Plaatsid</th>
		<th colspan=3></th>
		</tr>
	</thead>";
		while ($row = mysqli_fetch_assoc($query)) {
			$output .= "<tbody>
		<tr>
			<td>{$row['reserveringId']}</td>
			<td>{$row['klantId']}</td>
			<td>{$row['factuurId']}</td>
			<td>{$row['status']}</td>
			<td>{$row['voornaam']}</td>
			<td>{$row['achternaam']}</td>
			<td>{$row['datumaankomst']}</td>
			<td>{$row['datumvertrek']}</td>
			<td>{$row['plaatsnr']}</td>
			<td>{$row['plaatsid']}-{$row['plaatsnaam']}</td>

			<td><form action='factuur.php' method='POST'>
				<input type='hidden' name='verstopt' value='$row[reserveringnr]'>
				<input type = 'submit' name='wijzig' value='Factuur Overzicht'>
            </form></td>
			
			<td><form action='../reservering/reserveringInfo.php' method='POST'>
				<input type='hidden' name='verstopt' value='$row[reserveringnr]'>
				<input type = 'submit' name='reserveringInfo' value='Reservering details'>
            </form></td>
			
		</tr>

		</tbody>";

	}
$output .="</table>";
	echo $output;
	

}else{
	echo "<h5>No record found</h5>";
}

?>

