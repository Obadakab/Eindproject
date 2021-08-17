<?php

include('functions.php');
include("connectie.php");


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Theme Made By www.w3schools.com -->
  <title>Larustiq</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="style/indexlayout.css" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php"><img id="logo" src="images/logo.png" width="75" height="70"></a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
          <li><a id="hovGreen" href="#about">ABOUT</a></li>
          <li><a id="hovBlue" href="#OurValues">Our Values</a></li>
          <li><a id="hovGreen" href="#portfolio">PORTFOLIO</a></li>
          <li><a id="hovBlue" href="#prijzen">Prijzen</a></li>
          <li><a id="hovGreen" href="#contact">CONTACT</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div id="reservering" class="jumbotron text-center">
    <div class="mask slideanim" style="background-color: rgba(0, 0, 0, 0.6); ">
      <h1>larustique</h1>
      <p>Check hier uw beschikbaar plaats</p>
      <form>
        <label for="aandatum">Aankomstdatum</label>
        <input type="date" name="start_date" id="start_date" value="" onchange="myFunction()" />

        <label for="verdatum">Vertrekdatum</label>
        <input type="date" name="end_date" id="end_date" value="" onchange="myFunction()" /><br>

        <label for="camptype">Campingplaats</label>
        <select id="camptype" name="camptype">
        </select><br>

      </form>
    </div>
  </div>

  <!-- Container (About Section) -->
  <div id="about" class="container-fluid text-center">
    <div class="row">
      <div class="col-sm-8">
        <h2>About larustique</h2><br>
        <h4>De schoonheid van de natuur, rust en ruimte. Dat is wat camping La Rustique te bieden heeft in het Franse Ardes.</h4><br>
        <p>La Rustique beschikt over een ruime campingplaats van in totaal 2 hectare.
           Het terrein is voorzien van diverse haagjes en bomen. 
           Schaduwplekken zijn er in voldoende mate aanwezig. 
           Verreweg de meeste plekken zijn voor toeristen bestemd. 
           De camping beschikt over een uitgebreid restaurant en een speelveld.</p>
        <br><a class="btn btn-default btn-lg" href="#contact" role="button">Get in Touch</a>
      </div>
      <div class="col-sm-4">
        <span id="glyphicontent" class="glyphicon glyphicon-tent logo slideanim"></span>
      </div>
    </div>
  </div>

  <div id="OurValues" class="container-fluid text-center bg-grey">
    <div class="row">
      <div class="col-sm-4">
        <span id="glyphiconglobe" class="glyphicon glyphicon-globe logo slideanim"></span>
      </div>
      <div class="col-sm-8">
        <h2>Onze waarden</h2><br>
        <h4><strong>MISSIE:</strong> Onze missie Camping La Rustique biedt campingplekken en huuraccommodaties aan voor verschillende groepen, waarbij zij haar gasten gelegenheid geeft te genieten van alles tussen luieren en activiteit.
        De niet alledaagse outdooractiviteiten worden begeleidt door kundige, ervaren instructeurs en zijn er op ingericht de campinggasten een spannende ervaring te bieden in een bijzondere, unieke omgeving en fraaie natuurgebieden.
        Camping La Rustique ziet de natuur als haar werkplek, waar zij zuinig mee omgaat. Dat vraagt zij ook van haar gasten.
        Iedereen van 0-80 jaar kan zo kennismaken met de natuur en spannende activiteiten.</h4><br>
        <p><strong>VISIE:</strong> Onze visie Het hele gezin heeft het recht op een ontspannen vakantie. Daarom moet er alles aan worden gedaan om hen zoveel mogelijk zichzelf te kunnen laten zijn. In de praktijk is hier veel inlevingsvermogen voor nodig. 
        Dit kan mogelijk worden gemaakt door de kernwaarden: respect, geborgenheid en gastvriendelijkheid steeds centraal te stellen.</p>
      </div>
    </div>
  </div>

  <!-- Container (Portfolio Section) -->
  <div id="portfolio" class="container-fluid text-center">
    <h2>Portefeuille</h2><br>
    <h4>Wat hebben we voor jullie</h4>
    <div class="row text-center slideanim">
      <div class="col-sm-4">
        <div class="thumbnail">
          <img src="images/camp.jpg" alt="Paris" width="400" height="300">
          <p><strong>Kampeerplaats</strong></p>
          <p>Yes, we built Paris</p>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="thumbnail">
          <img src="images/restaurant.jpg" alt="New York" width="400" height="300">
          <p><strong>restaurant</strong></p>
          <p>We built New York</p>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="thumbnail">
          <img src="images/playground.jpg" alt="San Francisco" width="400" height="300">
          <p><strong>Speelplaats</strong></p>
          <p>Yes, San Fran is ours</p>
        </div>
      </div>
    </div><br>
  </div>

  <div id="prijzen" class="container-fluid text-center bg-grey">
    <div class="row text-center slideanim">
      <div class="col-sm-12">
        <h2>Prijzen</h2><br>
          <div class="Pcard">
          <div class="column">
            <div class="card">
              <h3>Caravan of camper</h3>
              <p>(kleine plaats)</p>
              <p>Voor kleine plaats (Caravan) geldt er dagtarief van 2 euro.</p>
            </div>
          </div>

          <div class="column">
            <div class="card">
              <h3>Caravan of camper</h3>
              <p>(grote plaats)</p>
              <p>Voor grote plaats (Caravan) geldt er dagtarief van 4 euro.</p>
            </div>
          </div>
          
          <div class="column">
            <div class="card">
              <h3>Tent</h3>
              <p>(grote plaats)</p>
              <p>Voor grote plaats (Tent) geldt er dagtarief van 5 euro.</p>
            </div>
          </div>
          
          <div class="column">
            <div class="card">
              <h3>Tent</h3>
              <p>(kleine plaats)</p>
              <p>Voor kleine plaats (Tent) geldt er dagtarief van 3 euro.</p>
          </div>
        </div>
        <div class="column">
            <div class="card">
              <h3>Volwassenen</h3>
              <p>Voor volwassenen geldt er dagtarief van 5 euro p.p.</p>
            </div>
          </div>

          <div class="column">
            <div class="card">
              <h3>Kinderen van 4 tot 12</h3>
              <p>Voor kinderen van 4 tot 12 geldt er dagtarief van 4 euro p.p.</p>
            </div>
          </div>
          <div class="column">
            <div class="card">
              <h3>Kinderen tot 4 jaar</h3>
              <p>Voor Kinderen tot 4 jaar is het gratis</p>
          </div>
        </div>
          
          <div class="column">
            <div class="card">
              <h3>Huisdieren</h3>
              <p>(maximaal 1 huisdier)</p>
              <p>Voor hond geldt er dagtarief van 2 euro.</p>
            </div>
          </div>
          <div class="column">
            <div class="card">
              <h3>Douche</h3>
              <p>(munten verkrijgbaar bij de receptie)</p>
              <p>0,50 cent per munt.</p>
            </div>
          </div>
          <div class="column">
            <div class="card">
              <h3>Elektriciteit</h3>
              <p>Er geldt 2 euro dagtarief voor elektriciteit.</p>
          </div>
        </div>
 

          <div class="column">
            <div class="card">
              <h3>Wasmachine</h3>
              <p>Wasmachine gebruiken geldt er tarief van 6 euro.</p>
            </div>
          </div>
          
          <div class="column">
            <div class="card">
              <h3>Parkeerplaats</h3>
              <p>(maximaal 2 auto per gereserveerd campingplaats)</p>
              <p>Voor parkeerplaats geldt er dagtarief van 3 euro.</p>
            </div>
          </div>
          

      </div>
      </div>
    </div>
  </div>
  

  <!-- Container (Contact Section) -->
  <div id="contact" class="container-fluid bg-grey text-center">
    <h2 class="text-center">CONTACT</h2>
    <div class="row">
      <div class="col-sm-5">
        <p>Neem contact met ons op en we nemen binnen 24 uur contact met je op.</p>
        <p><span class="glyphicon glyphicon-map-marker"></span> Brassac-les-Mines, Frankrijk</p>
        <p><span class="glyphicon glyphicon-phone"></span> 04-76372000</p>
        <p><span class="glyphicon glyphicon-envelope"></span> info@larustique.com</p>
      </div>
      <div class="col-sm-7 slideanim">
        <div class="row">
          <div class="col-sm-6 form-group">
            <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
          </div>
          <div class="col-sm-6 form-group">
            <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
          </div>
        </div>
        <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea><br>
        <div class="row">
          <div class="col-sm-12 form-group">
            <button class=" btn btn-default btn-lg btn-block " type="submit">Send</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Image of location/map -->
    <iframe class="w3-image w3-greyscale-min" style="width:100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15177.757341825212!2d3.1174736737856756!3d45.391924382022324!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f7b2a303590351%3A0x473df3e2d23ebeb4!2sVacances%20passion%20-%20Village%20vacances%20le%20c%C3%A9zallier!5e0!3m2!1sen!2snl!4v1618131470139!5m2!1sen!2snl" width="500" padding="10" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
  </div>
  <footer id="footer" class="container-fluid text-center">
    <a href="#myPage" title="To Top">
      <span class="glyphicon glyphicon-chevron-up"></span>
    </a>
    <p>Camping La Rustique is een fictief bedrijf bedoeld voor educatieve doeleinden. Genoemde namen zijn tevens fictief. Overeenkomsten met bestaande bedrijven en personen berusten op louter toeval.</p>

  </footer>

  <script>
    $(document).ready(function() {
      // Add smooth scrolling to all links in navbar + footer link
      $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
          // Prevent default anchor click behavior
          event.preventDefault();

          // Store hash
          var hash = this.hash;

          // Using jQuery's animate() method to add smooth page scroll
          // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
          $('html, body').animate({
            scrollTop: $(hash).offset().top
          }, 900, function() {

            // Add hash (#) to URL when done scrolling (default click behavior)
            window.location.hash = hash;
          });
        } // End if
      });

      $(window).scroll(function() {
        $(".slideanim").each(function() {
          var pos = $(this).offset().top;

          var winTop = $(window).scrollTop();
          if (pos < winTop + 600) {
            $(this).addClass("slide");
          }
        });
      });
    })
  </script>
  <script>
    function myFunction() {
      // ophalen aankomst en vertrekdatum
      var x = document.getElementById("start_date").value;
      var y = document.getElementById("end_date").value;

      // voorwaarde voor verzenden; beide data zijn ingevuld.
      if (x != 0 && y != 0) {

        var request = $.ajax({
          url: "reservering/reserveringDatum.php",
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