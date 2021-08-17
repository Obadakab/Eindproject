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
    <meta http-equiv="X-UA-Compatible" invoice-c-2r="IE=edge">
    <meta name="viewport" invoice-c-2r="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style/factuurLayout.css">
    <title>Factuur</title>
    <style type="text/css">
    
</style>
</head>
<body>
<?php
    //reservering info ophalen
    $reserveringnr = $_POST["verstopt"];

    $query = "SELECT *,
        CONCAT(klanten.prefix,'-',klanten.klantnr) AS 'klantId', 
        CONCAT(factuur.prefix,'-',factuur.factuurid) AS 'factuurId', 
        CONCAT(reservering.prefix,'-',reservering.reserveringnr) AS 'reserveringId' FROM reservering
        INNER JOIN plaatsen ON reservering.plaatsnr=plaatsen.plaatsnr 
        INNER JOIN klanten ON reservering.klantnr=klanten.klantnr
        INNER JOIN factuur ON reservering.factuurid=factuur.factuurid 
        INNER JOIN optie ON reservering.reserveringnr=optie.reserveringnr 
        WHERE reservering.reserveringnr ='$reserveringnr'";

    $result = mysqli_query($conn, $query);

    //rij op halen en weergeven

    while ($rij = mysqli_fetch_array($result)) {
        $facDatum=$rij['ts_issued'];
        $facStatus=$rij['status'];
        $fabetaald=$rij['ts_paid'];
        $factuurId=$rij['factuurId'];
        $facN=$rij['factuurid'];
        $klantId=$rij['klantId'];
        $reserveringID=$rij['reserveringId'];
        $reserveringnr = $rij['reserveringnr'];
        $klantnr = $rij['klantnr'];
        $datumaankomst = $rij['datumaankomst'];
        $datumvertrek = $rij['datumvertrek'];
        $klantnr = $rij['klantnr'];
        $voornaam = $rij['voornaam'];
        $achternaam = $rij['achternaam'];
        $adres = $rij['adres'];
        $huisnummer = $rij['huisnummer'];
        $postcode = $rij['postcode'];
        $woonplaats = $rij['woonplaats'];
        $tel = $rij['tel'];
        $email = $rij['email'];
    }
    //plaats naam
    $qcamp = "SELECT * FROM reservering 
    INNER JOIN plaatsen ON reservering.plaatsnr = plaatsen.plaatsnr 
    INNER JOIN plaatentarief ON plaatsen.plaatsnaam = plaatentarief.plaatsnaam
    WHERE reservering.reserveringnr ='$reserveringnr'";
    $rcamp = mysqli_query($conn, $qcamp);
    while ($rijcamp = mysqli_fetch_array($rcamp)) {
        $plaats = $rijcamp['plaatsid'] . " " . $rijcamp['plaatsnaam'] . " " . $rijcamp['plaatsnr'];
        $plaatsPrijs = $rijcamp['prijs'];
        
    }
    //aantal optie ophalen
    $optieNrAantal = array();
    $queryAantal = "SELECT aantal FROM optie WHERE reserveringnr = '$reserveringnr'";
    $rAantal = mysqli_query($conn, $queryAantal);
    while ($data = mysqli_fetch_array($rAantal)) {
        array_push($optieNrAantal, $data['aantal']);
    };

    $aantalVolwas = $optieNrAantal[0];
    $aantalKind = $optieNrAantal[1];
    $bezoekers = $optieNrAantal[2];
    $wasmachine = $optieNrAantal[3];
    $wasdroger = $optieNrAantal[4];
    $elektriciteit = $optieNrAantal[5];
    $huisdier = $optieNrAantal[6];
    $douche = $optieNrAantal[7];
    $parkeerplaats = $optieNrAantal[8];

    $optiePrijs = array();
    $opprijs = "SELECT optieprijs FROM opties";
    $rPrijs = mysqli_query($conn, $opprijs);
    while ($dPrijs = mysqli_fetch_array($rPrijs)) {
        array_push($optiePrijs, $dPrijs['optieprijs']);
    };

    $volwPrijs = $optiePrijs[0];
    $kindPrijs = $optiePrijs[1];
    $bezoPrijs = $optiePrijs[2];
    $wasmPrijs = $optiePrijs[3];
    $wasdPrijs = $optiePrijs[4];
    $elektPrijs = $optiePrijs[5];
    $huisdPrijs = $optiePrijs[6];
    $dochPrijs = $optiePrijs[7];
    $parkplPrijs = $optiePrijs[8];

    //date : days teller
    $dteStart = new DateTime($datumaankomst);
    $dteEnd   = new DateTime($datumvertrek);
    $interval = date_diff($dteStart, $dteEnd);
    $aantaldagen = $interval->format('%a');

    $volwpernacht=  $aantalVolwas * $volwPrijs;
    $kindPernacht= $aantalKind * $kindPrijs;
    $bezoekPnacht= $bezoPrijs*$bezoekers;
    $parkPnacht=$parkeerplaats*$parkplPrijs;
    $hdierPnacht=$huisdier*$huisdPrijs;

    $volwTotaal= $volwpernacht*$aantaldagen;
    $kindTotaal= $kindPernacht*$aantaldagen;
    $bezoekTotaal=$bezoekPnacht*$aantaldagen;
    $wasmTotaal=$wasmachine * $wasmPrijs;
    $wasdTotaal=$wasdroger * $wasdPrijs;
    $elektrTotaal=$elektriciteit * $elektPrijs;
    $dochTotaal=$douche * $dochPrijs;
    $hdierTotaal=$hdierPnacht*$aantaldagen;
    $parkTotaal=$parkPnacht*$aantaldagen;

    $subTotaal=$volwTotaal+$kindTotaal+$bezoekTotaal+$wasmTotaal+
    $wasdTotaal+$elektrTotaal+$dochTotaal+$hdierTotaal+$parkTotaal;
    $btw=$subTotaal* 6/100 ;
    $totaal= $subTotaal+$btw;
    $betaald="Onbetaald";


    ?>

<div class="container">
<div class="btn-group">

        <button type="button" onClick="window.location.href='../reservering/reserveringForm.php';">Nieuwe reservering</button>
        <button type="button" onClick="window.location.href='../reservering/reserveringOverzicht.php';">reservering overzicht</button>
        <button type="button" onClick="window.location.href='../fpdf/factuurOverzicht.php';">facturen overzicht</button>
        <button type="button" onClick="window.location.href='../user/user_dashbord.php';">Gebruiker dashbord</button>
        
        <?php  if ($facStatus==$betaald) : ?>
          <?php echo"<form  action='factuurbetalen.php' method='POST'>
                <input id='sub' type='hidden' name='verstopt' value='$reserveringnr'>
                <button id='sub' type='submit' name='submit' > Betaal </button>
             </form>"; ?>
        <?php endif ?>
    </div>
    <br>
    <table class="tg">
<thead>
  <tr>
    <th class="tg-invoice-info" colspan="6">Factuur</th>
  </tr>
</thead>
<tbody>
  <tr>
  <td class="tg-klant-info" colspan="3"><ul>
    <li><strong>Factuur Nr.</strong> <?php echo  $factuurId; ?></li>
    <li><strong>Status: </strong><?php echo $facStatus; ?></li>
    <li><strong>Klantnr Nr. </strong><?php echo $klantId; ?></li>
    </ul></td>
    <td class="tg-logo-info" colspan="3"><img width="110" src="../images/Logo.png" alt="Invoice logo"></td>
  </tr>
  <tr>
  <td class="tg-klant-info" colspan="3"><ul>
    <li><strong>Naam: </strong><?php echo $voornaam . " " . $achternaam; ?></li>
    <li><strong>Adres: </strong><?PHP echo $adres . " " . $huisnummer; ?> </li>
    <li><strong>Postcode: </strong><?PHP echo $postcode; ?></li>
    <li><strong>Woonplaats: </strong><?PHP echo $woonplaats; ?></li>
    <li><strong>Tel: </strong><?PHP echo $tel; ?></li>
    <li><strong>Email: </strong><?PHP echo $email; ?> </li>
    </ul></td>
  <td class="tg-invoice-info-header" colspan="3"><ul>
      <li><strong>LARUSTIQUE</strong></li>
      <li><strong>Adres: 63420 Ardes</strong></li>
      <li><strong>Telefoon: 04-76372000</strong></li>
      <li><strong>Geopend: 15-03 – 15-10</strong></li>
    </ul></td>

  </tr>
  <tr>
    <th class="tg-invoice-info">Betaaldatum</th>
    <th class="tg-invoice-info">Factuur nr.</th>
    <th class="tg-invoice-info">Reserveringdatum</th>
    <th class="tg-invoice-info">Reservering nr.</th>
    <th class="tg-invoice-info">Ankomst</th>
    <th class="tg-invoice-info">Vertrek</th>
  </tr>
  <tr>
    <td class="tg-invoice-c-3r"><?php echo $fabetaald; ?></td>
    <td class="tg-invoice-c-3r"><?php echo $factuurId; ?></td>
    <td class="tg-invoice-c-3r"><?php echo $facDatum; ?></td>
    <td class="tg-invoice-c-3r"><?php echo $reserveringID; ?></td>
    <td class="tg-invoice-c-3r"><?php echo $datumaankomst;  ?></td>
    <td class="tg-invoice-c-3r"><?php echo $datumvertrek;  ?></td>
  </tr>
  <tr>
    <td class="tg-invoice-spece" colspan="6"></td>
  </tr>
  <tr>
    <th class="tg-invoice-info">Omschrijving</th>
    <th class="tg-invoice-info">Tarief</th>
    <th class="tg-invoice-info">Aantal</th>
    <th class="tg-invoice-info">Totaal per nacht</th>
    <th class="tg-invoice-info">Totaal</th>
    <th class="tg-invoice-info">BTW</th>
  </tr>
  <tr>
    <td class="tg-invoice-c-1r"><?php echo $plaats; ?></td>
    <td class="tg-invoice-c-1r"><?php echo $plaatsPrijs; ?></td>
    <td class="tg-invoice-c-1r"><?php echo $aantaldagen; ?> (dagen)</td>
    <td class="tg-invoice-c-1r">-</td>
    <td class="tg-invoice-c-1r"><?php echo $aantaldagen*$plaatsPrijs; ?></td>
    <td class="tg-invoice-c-1r"><?php echo '6%'; ?></td>

  </tr>
  <tr>
    <td class="tg-invoice-c-2r">Volwassenen</td>
    <td class="tg-invoice-c-2r"><?php echo $volwPrijs; ?></td>
    <td class="tg-invoice-c-2r"><?PHP echo $aantalVolwas; ?></td>
    <td class="tg-invoice-c-2r"><?php echo $volwpernacht; ?></td>
    <td class="tg-invoice-c-2r"><?php echo $volwTotaal; ?></td>
    <td class="tg-invoice-c-2r"><?php echo '6%'; ?></td>
  </tr>
  <tr>
    <td class="tg-invoice-c-1r">Kinderen van 4 t/m 12:</td>
    <td class="tg-invoice-c-1r"><?php echo $kindPrijs; ?></td>
    <td class="tg-invoice-c-1r"><?PHP echo $aantalKind; ?></td>
    <td class="tg-invoice-c-1r"><?php echo $kindPernacht; ?></td>
    <td class="tg-invoice-c-1r"><?php echo $kindTotaal; ?></td>
    <td class="tg-invoice-c-1r"><?php echo '6%'; ?></td>
  </tr>
  <tr>
    <td class="tg-invoice-c-2r">Bezoekers</td>
    <td class="tg-invoice-c-2r"><?php echo $bezoPrijs; ?></td>
    <td class="tg-invoice-c-2r"><?PHP echo $bezoekers;  ?></td>
    <td class="tg-invoice-c-2r"><?php echo $bezoekPnacht; ?></td>
    <td class="tg-invoice-c-2r"><?php echo $bezoekTotaal; ?></td>
    <td class="tg-invoice-c-2r"><?php echo '6%'; ?></td>
    
  </tr>
  <tr>

    <td class="tg-invoice-c-1r">Elektriciteit</td>
    <td class="tg-invoice-c-1r"><?php echo $elektPrijs; ?></td>
    <td class="tg-invoice-c-1r"><?PHP echo $elektriciteit; ?></td>
    <td class="tg-invoice-c-1r">-</td>
    <td class="tg-invoice-c-1r"><?php echo $elektrTotaal; ?></td>
    <td class="tg-invoice-c-1r"><?php echo '6%'; ?></td>
  </tr>
  <tr>
    <td class="tg-invoice-c-2r">Wasdroger</td>
    <td class="tg-invoice-c-2r"><?php echo $wasdPrijs; ?></td>
    <td class="tg-invoice-c-2r"><?PHP echo $wasdroger; ?></td>
    <td class="tg-invoice-c-2r">-</td>
    <td class="tg-invoice-c-2r"><?php echo $wasdTotaal; ?></td>
    <td class="tg-invoice-c-2r"><?php echo '6%'; ?></td>
  </tr>
  <tr>
    <td class="tg-invoice-c-1r">Wasmachine </td>
    <td class="tg-invoice-c-1r"><?php echo $wasmPrijs; ?></td>
    <td class="tg-invoice-c-1r"><?PHP echo $wasmachine; ?></td>
    <td class="tg-invoice-c-1r">-</td>
    <td class="tg-invoice-c-1r"><?php echo $wasmTotaal; ?></td>
    <td class="tg-invoice-c-1r"><?php echo '6%'; ?></td>
  </tr>
  <tr>
    <td class="tg-invoice-c-2r">Douche</td>
    <td class="tg-invoice-c-2r"><?php echo $dochPrijs; ?></td>
    <td class="tg-invoice-c-2r"><?PHP echo $douche; ?></td>
    <td class="tg-invoice-c-2r">-</td>
    <td class="tg-invoice-c-2r"><?php echo $dochTotaal; ?></td>
    <td class="tg-invoice-c-2r"><?php echo '6%'; ?></td>
  </tr>
  <tr>
    <td class="tg-invoice-c-1r">Huisdier</td>
    <td class="tg-invoice-c-1r"><?php echo $huisdPrijs; ?></td>
    <td class="tg-invoice-c-1r"><?PHP echo $huisdier; ?></td>
    <td class="tg-invoice-c-1r"><?php echo $hdierPnacht; ?></td>
    <td class="tg-invoice-c-1r"><?php echo $hdierTotaal; ?></td>
    <td class="tg-invoice-c-1r"><?php echo '6%'; ?></td>
  </tr>
  <tr>
    <td class="tg-invoice-c-2r">Parkeerplaats</td>
    <td class="tg-invoice-c-2r"><?php echo $parkplPrijs; ?></td>
    <td class="tg-invoice-c-2r"><?PHP echo $parkeerplaats; ?></td>
    <td class="tg-invoice-c-2r"><?PHP echo $parkPnacht; ?></td>
    <td class="tg-invoice-c-2r"><?php echo $parkTotaal; ?></td>
    <td class="tg-invoice-c-2r"><?php echo '6%'; ?></td>
  </tr>
  <tr>
    <td class="tg-invoice-spece" colspan="6"></td>
  </tr>
  <tr>
    <th class="tg-invoice-info" colspan="4">Omschrijving</th>
    <th class="tg-invoice-info" colspan="2">Bedrag</th>
  </tr>
  <tr>
    <td class="tg-invoice-c-1r" colspan="4"><strong>Sub Totaal</strong></td>
    <td class="tg-invoice-c-1r" colspan="2"><?php echo $subTotaal; ?></td>
  </tr>
  <tr>
    <td class="tg-invoice-c-2r" colspan="4"><strong>BTW</strong></td>
    <td class="tg-invoice-c-2r" colspan="2"><?php echo $btw; ?></td>
  </tr>
  <tr>
    <td class="tg-invoice-c-1r" colspan="4"><strong>Totaal</strong></td>
    <td class="tg-invoice-c-1r" colspan="2"><?php echo $totaal; ?></td>
  </tr>

</tbody>

</table>
<br>

</div>
</body>
</html>