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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style/reserveringWijzgecss.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <title>reservering</title>
</head>

<body>

  <?php

  //ophalen van emailadres
  $reserveringnr = $_POST["verstopt"];

  $query = "SELECT *,
        CONCAT(klanten.prefix,'-',klanten.klantnr) AS 'klantId', 
        CONCAT(factuur.prefix,'-',factuur.factuurid) AS 'factuurNr', 
        CONCAT(reservering.prefix,'-',reservering.reserveringnr) AS 'reserveringId' FROM reservering
        INNER JOIN plaatsen ON reservering.plaatsnr=plaatsen.plaatsnr 
        INNER JOIN klanten ON reservering.klantnr=klanten.klantnr
        INNER JOIN factuur ON reservering.factuurid=factuur.factuurid 
        INNER JOIN optie ON reservering.reserveringnr=optie.reserveringnr 
        WHERE reservering.reserveringnr ='$reserveringnr' limit 1";
        $result = mysqli_query($conn, $query);

        while ($rij = mysqli_fetch_array($result)) {
          
          $facDatum=$rij['ts_issued'];
          $factuurId=$rij['factuurNr'];
          $factuurNr=$rij['factuurid'];
          $klantId=$rij['klantId'];
          $klantnr = $rij['klantnr'];
          $reserveringID=$rij['reserveringId'];
          $reserveringnr = $rij['reserveringnr'];
          $datumaankomst = $rij['datumaankomst'];
          $datumvertrek = $rij['datumvertrek'];
          $voornaam = $rij['voornaam'];
          $achternaam = $rij['achternaam'];
          $adres = $rij['adres'];
          $huisnummer = $rij['huisnummer'];
          $postcode = $rij['postcode'];
          $woonplaats = $rij['woonplaats'];
          $tel = $rij['tel'];
          $email = $rij['email'];
      }


        $qcamp = "SELECT reservering.plaatsnr,plaatsen.plaatsnaam, plaatsen.plaatsid FROM reservering
                 INNER JOIN plaatsen ON reservering.plaatsnr = plaatsen.plaatsnr where reserveringnr =$reserveringnr";
        $rcamp = mysqli_query($conn, $qcamp);
        while ($rijcamp = mysqli_fetch_array($rcamp)) {
            $plaats = $rijcamp['plaatsid'] . " " . $rijcamp['plaatsnaam'] . " " . $rijcamp['plaatsnr'];
        }
        //aantal optie ophalen
        $optieNrAantal = array();
        $queryAantal = "SELECT aantal FROM optie WHERE reserveringnr = $reserveringnr";
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

        //rij op halen en weergeven

       

        //date : days teller
        $dteStart = new DateTime($datumaankomst);
        $dteEnd   = new DateTime($datumvertrek);
        $interval = date_diff($dteStart, $dteEnd);
        $aantaldagen = $interval->format('%a');
        // $overzichtresult = mysqli_query($conn, $query);

        // while ($rij = mysqli_fetch_array($overzichtresult)) {

  ?>

<div class="container" style="margin: 0 50;">
      <h2>Reservering Wijzigen </h2>
      <form id="content" action="reserveringWijzgeDef.php" method="POST">
      <div id="reservInfo">
      <label id="info">Reservering Info</label>
      <br>

      <label for="voornaam">Reservering Nr.</label>
      <input type="text" readonly name="reserveringID" value="<?php echo $reserveringID ?>" />
      <input type="hidden" readonly name="reserveringnr" value="<?php echo $reserveringnr ?>" />

      <label for="achternaam">klant Nr.</label>
      <input type="text" readonly name="klantId" value="<?php echo $klantId ?>" />
      <input type="hidden" readonly name="klantnr" value="<?php echo $klantnr ?>" />

      <label for="achternaam">Factuur Nr.</label>
      <input type="text" readonly name="factuurId" value="<?php echo $factuurId ?>" />
      <input type="hidden" readonly name="factuurnr" value="<?php echo $factuurnr ?>" />

      <label for="achternaam">Reservering Datum</label>
      <input type="text" readonly name="facDatum" value="<?php echo $facDatum ?>" />
      </div>
      <br>
      <div class="Klantinf">
      <label id="info" for="Klantinfo">Klantinfo</label><br>
      <label for="voornaam">Voornaam</label>
      <input type="text" name="voornaam" value="<?php echo $voornaam ?>" />

      <label for="achternaam">Achternaam</label>
      <input type="text" name="achternaam" value="<?php echo $achternaam ?>" />
      <br>

      <label for="tel">Telefoonnummer</label>
      <input type="text" name="tel" value="<?php echo $tel ?>" />

      <label for="mail">Email</label>
      <input type="email" name="mail" value="<?php echo $email ?>"><br>
      </div>
      <br>

      <div class="adreinfo">
      <label id="info" for="adres">Adres</label>
      <br>
      <label for="adres">Straat</label>
      <input type="text" name="adres" value="<?php echo $adres ?>" />

      <label for="huisnummer">Huisnummer</label>
      <input type="text" name="huisnummer" value="<?php echo $huisnummer ?>" />
      <br>
      <label for="postcode">Postcode</label>
      <input type="text" name="postcode" value="<?php echo $postcode ?>" />

      <label for="woonplaats">Woonplaats</label>
      <input type="text" name="woonplaats" value="<?php echo $woonplaats ?>" /><br>
      </div>
      <br>
      <br>
      <div id="reservInfo">
      <label id="info">Camping Info</label>
      <br>
      <br>
      <label for="aandatum">Aankomstdatum</label>
      <input type="date" name="start_date" id="start_date" value="<?php echo $datumaankomst  ?>" onchange="myFunction()/">

      <label for="verdatum">Vertrekdatum</label>
      <input type="date" name="end_date" id="end_date" value="<?php echo $datumvertrek  ?>" onchange="myFunction()/"><br>

      <label for="camptype">Campingplaats</label>
      <select id="camptype" name="camptype">
        <option><?php echo $plaats ?></option>
        </div>
      </select><br>
      <label id="info">Reservering Inhoud</label>
      <br>
      <label for="aantalvolwassenen">Volwassenen</label>
      <input type="number" id="aantalVolwa" name="aantalvolwassenen" value="<?php echo $aantalVolwas?>" min="0" max="10" list="defaultNumbers">
      <datalist id="defaultNumbers">
        <option value="1">
        <option value="2">
        <option value="3">
        <option value="4">
        <option value="5">
        <option value="6">
      </datalist>

      <label id="aantalKind" for="aantalkinderen">Kinderen van 4 t/m 12</label>
      <input type="number"  name="aantalkinderen" value="<?php echo $aantalKind ?>" min="0" max="10" list="defaultNumbers">
      <datalist id="defaultNumbers">
        <option value="1">
        <option value="2">
        <option value="3">
        <option value="4">
        <option value="5">
        <option value="6">
      </datalist>

      <label  for="Bezoekers">Aantal Bezoekers</label>
      <input  type="number" name="bezoekers" value="<?php echo $bezoekers;  ?>">
      <label  for="wasmachine">Wasmachine</label>
      <input  type="number" name="wasmachine" value="<?php echo $wasmachine;  ?>">

      <label  for="wasdroger">Wasdroger</label>
      <input  type="number" name="wasdroger" value="<?php echo $wasdroger; ?>">
      <label  for="elektriciteit">Elektriciteit</label>
      <input  type="number" name="elektriciteit" value="<?php echo $elektriciteit;  ?>">

      <label  for="douche">Douche</label>
      <input  type="number" name="douche" value="<?php echo $douche; ?>">
      <label  for="parkeerplaats">Parkeerplaats</label>
      <input  type="number" name="parkeerplaats" min="0" max="2" value="<?php echo $parkeerplaats; ?>">

      <label for="huisdier">Huisdier</label>
      <input type="number" name="huisdier" value="<?php echo $huisdier;  ?>" min="0" max="1">

      <div class="btn-group">
        <button type="submit" name="submit" >Gegevens Wijzigen</button>
        <button type="button" onClick="window.location.href='../reservering/reserveringForm.php';">Nieuwe reservering</button>
        <button type="button" onClick="window.location.href='../reserveringOverzicht.php';">reservering overzicht</button>
        <button type="button" onClick="window.location.href='../fpdf/factuurOverzicht.php';">facturen overzicht</button>
    </div>
    </form>
    <br>
</div>
  </div>


  <script>
    function myFunction() {
      // ophalen aankomst en vertrekdatum
      var x = document.getElementById("start_date").value;
      var y = document.getElementById("end_date").value;
      alert("");
      // voorwaarde voor verzenden; beide data zijn ingevuld.
      if (x != 0 && y != 0) {

        var request = $.ajax({
          url: "reserveringWijzgeDatum.php",
          method: "POST", // verzoek van zichtbaar versturen
          data: {
            x: x,
            y: y
          } // verzoek versturen van aankomst en vertrekdatum  
        });

        // belangrijkste koppeling naar de tweede pagina. Hierin zitten dus ook de aankomst- en vertrekdata.
        request.done(function(msg) {
          $("#camptype").html(msg);
        });

        request.fail(function(jqXHR, textStatus) {
          alert("Request failed: " + textStatus);
        });

      }
    }
  </script>




</body>

</html>