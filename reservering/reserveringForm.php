<?php
include("../header.php");
include("../connectie.php");

if (!isLoggedIn()) {
  $_SESSION['msg'] = "You must log in first";
  header('location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../style/reserveringFormlayout.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!--  Flatpickr  -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/themes/material_green.css"> -->
  <style>
#kindaantal
{
vertical-align: baseline;
font-size:14px;
text-align: left;
/* margin-left: -15%; */
}

    </style>
  <title>reservering</title>
</head>

<body>
    <div class="container" style="margin: 0 50;">
      <form id="content" action="reserveringFormDef.php" method="POST">
      <h2>Nieuwe Reservering</h2>
      <div class="Klantinf">
      <input type="hidden" name="facStatus" value="Onbetaald" readonly>
      <label id="info" for="voornaam">Klantinfo</label><br>
      <label for="voornaam">Naam</label>
      <input type="text" name="voornaam" placeholder="Voornaam" required />
      <input type="text" name="achternaam" placeholder="Achternaam" required />
      <br>

      <label for="tel">Telefoonnummer</label>
      <input type="text" placeholder="+31 111 111 111" name="tel" />

      <label for="mail">Email</label>
      <input type="email" name="mail" placeholder="john@example.com" required>
      </div>
      <br>
      <div class="adreinfo">
      <label id="info" for="adres">Adres</label>
      <br>

      <label for="adres">Straat</label>
      <input type="text" name="adres" placeholder="Straatnaam" required />

      <label for="huisnummer">Huisnummer</label>
      <input type="text" name="huisnummer" placeholder="" required />
      <br>

      <label for="postcode">Postcode</label>
      <input type="text" name="postcode" placeholder="1111XX" required />

      <label for="woonplaats">Woonplaats</label>
      <input type="text" name="woonplaats" placeholder="Haarlem" required />
      </div>
      <br><br>

      <label id="info">Camping Info</label>
      <br>
      <br>
      <label for="aandatum">Aankomstdatum</label>
      <input type="date" name="start_date" id="start_date" value="" onchange="myFunction()" />

      <label for="verdatum">Vertrekdatum</label>
      <input type="date" name="end_date" id="end_date" value="" onchange="myFunction()" />
      <br>

      <label for="camptype">Campingplaats</label>
      <select id="camptype" name="camptype" placeholder="kies je kampeerplaats">
      </select><br>

      <label id="info">Reservering Info</label>
      <br>
      <label for="aantalvolwassenen">Volwassenen</label>
      <input type="number" value="0" id="aantalVolwa" name="aantalvolwassenen" min="0" max="10" list="defaultNumbers">
        <datalist id="defaultNumbers">
        <option value="1">
        <option value="2">
        <option value="3">
        <option value="4">
        <option value="5">
        <option value="6">
      </datalist>

      <label id="aantalKind" for="aantalkinderen">Kinderen van 4 t/m 12</label>
      <input type="number" value="0" name="aantalkinderen" min="0" max="10" list="defaultNumbers">
        <datalist id="defaultNumbers">
        <option value="1">
        <option value="2">
        <option value="3">
        <option value="4">
        <option value="5">
        <option value="6">
      </datalist>

 
      <label  for="Bezoekers">Bezoekers</label>
      <input  type="number" value="0" name="bezoekers" value="0">
      <label  for="wasmachine">Wasmachine:</label>
      <input  type="number" value="0" name="wasmachine" >

      <label  for="wasdroger">Wasdroger</label>
      <input  type="number" value="0" name="wasdroger">
      <label  for="elektriciteit">Elektriciteit</label>
      <input  type="number" value="0" name="elektriciteit">

      <label  for="douche">Douche</label>
      <input  type="number" value="0" name="douche">
      <label  for="parkeerplaats">Parkeerplaats</label>
      <input  type="number" name="parkeerplaats" value="0" min="0" max="2">

      <label for="huisdier">Huisdier</label>
      <input type="number" name="huisdier" value="0" min="0" max="1">

<br>
<br>
    <div class="btn-group">
        <button type="submit" name="submit" >reservering plaatsen</button>
        <button type="button" onClick="window.location.href='reserveringForm.php';">Nieuwe reservering</button>
        <button type="button" onClick="window.location.href='reserveringOverzicht.php';">reservering overzicht</button>
        <button type="button" onClick="window.location.href='../fpdf/factuurOverzicht.php';">facturen overzicht</button>
        <button type="button" onClick="window.location.href='../user/user_dashbord.php';">reservering annuleren</button>
    </div>
</div>
  </div>

  <script>
    function myFunction() {
      // ophalen aankomst en vertrekdatum
      var x = document.getElementById("start_date").value;
      var y = document.getElementById("end_date").value;

      // voorwaarde voor verzenden; beide data zijn ingevuld.
      if (x != 0 && y != 0) {

        var request = $.ajax({
          url: "reserveringDatum.php",
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