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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/reserveringInfoLayout.css">
    <title>Reservering Form</title>
</head>
<body>
<div class="container" style="margin: 0 50; text-align: center;">
<?php
    if(isset($_POST['submit'])){
        $voornaam=$_POST['voornaam'];
        $achternaam=$_POST['achternaam'];
        $adres=$_POST['adres'];
        $huisnummer=$_POST['huisnummer'];
        $postcode=$_POST['postcode'];
        $woonplaats=$_POST['woonplaats'];
        $tel=$_POST['tel'];
        $email=$_POST['mail'];
        //$aankomstdatum=$_POST['start_date'];
        $aankomstdatum=date('Y-m-d', strtotime($_POST['start_date']));
        $vertrekdatum=date('Y-m-d', strtotime($_POST['end_date']));
        //$vertrekdatum=$_POST['end_date'];
        $plaatstype=$_POST['camptype'];
        $aantalVolwas= $_POST['aantalvolwassenen'];
        $aantalKind = $_POST['aantalkinderen'];
        $bezoekers= $_POST['bezoekers'];
        $wasmachine= $_POST['wasmachine'];
        $elektriciteit= $_POST['elektriciteit'];
        $wasdroger=$_POST['wasdroger'];
        $douche= $_POST['douche'];
        $parkeerplaats=$_POST['parkeerplaats'];
        $huisdier=$_POST['huisdier'];
        $fcastatus=$_POST['facStatus'];
        

        $query="SELECT plaatsnr FROM plaatsen WHERE plaatsnr= '$plaatstype'";
        $result= mysqli_query($conn,$query);
        while ($row = mysqli_fetch_array( $result)) {
            $plaatsnrcheck= $row['plaatsnr']; 
        }
        $query1="INSERT INTO klanten(voornaam,achternaam,adres,
        huisnummer,postcode,woonplaats,tel,email)VALUES
        ('$voornaam','$achternaam','$adres',
        '$huisnummer','$postcode','$woonplaats','$tel','$email');";
        $result1=mysqli_query($conn,$query1);

        $last_id = mysqli_insert_id($conn);

        $query3="INSERT INTO factuur(status) VALUES
        ('$fcastatus')";
        $result3= mysqli_query($conn,$query3);

        $last_idfactuur = mysqli_insert_id($conn);

        $query2 ="INSERT INTO reservering(klantnr,factuurid,datumaankomst,datumvertrek,plaatsnr) VALUES
        ('$last_id','$last_idfactuur','$aankomstdatum','$vertrekdatum','$plaatsnrcheck')";
        $result2= mysqli_query($conn,$query2); 

        $last_idreservering = mysqli_insert_id($conn);
        

        //insert aantal volwasenen
        $volwaInsertquery ="INSERT INTO optie(optienr,aantal,reserveringnr) VALUES
        ('1','$aantalVolwas','$last_idreservering')";
        $volwaresult1= mysqli_query($conn,$volwaInsertquery);  
        //insert aantal kinderen
        $kindInsertquery ="INSERT INTO optie(optienr,aantal,reserveringnr) VALUES
        ('2','$aantalKind','$last_idreservering')";
        $kindresult1= mysqli_query($conn,$kindInsertquery);
         //insert aantal bezoekers
        $bezoekInsertquery ="INSERT INTO optie(optienr,aantal,reserveringnr) VALUES
        ('3','$bezoekers','$last_idreservering')";
        $bezoekresult1= mysqli_query($conn,$bezoekInsertquery);
        //insert aantal wasmachine
        $wasmachineInsertquery ="INSERT INTO optie(optienr,aantal,reserveringnr) VALUES
        ('4','$wasmachine','$last_idreservering')";
        $wasmachineresult1= mysqli_query($conn,$wasmachineInsertquery);
        //insert aantal wasdroger
        $wasdrogerInsertquery ="INSERT INTO optie(optienr,aantal,reserveringnr) VALUES
        ('5','$wasdroger','$last_idreservering')";
        $wasdrogerresult1= mysqli_query($conn,$wasdrogerInsertquery); 
        //insert aantal elektriciteit
        $elektriInsertquery ="INSERT INTO optie(optienr,aantal ,reserveringnr) VALUES
        ('6','$elektriciteit','$last_idreservering')";
        $elektriresult1= mysqli_query($conn,$elektriInsertquery);    
        //insert aantal huisdier
        $dierInsertquery ="INSERT INTO optie(optienr,aantal,reserveringnr) VALUES
        ('7','$huisdier','$last_idreservering')";
        $dierresult1= mysqli_query($conn,$dierInsertquery);
        //insert aantal douche
        $doucheInsertquery ="INSERT INTO optie(optienr,aantal,reserveringnr) VALUES
        ('8','$douche','$last_idreservering')";
        $doucheresult1= mysqli_query($conn,$doucheInsertquery); 
        //insert aantal parkeerplaats
        $parkeerInsertquery ="INSERT INTO optie(optienr,aantal,reserveringnr) VALUES
        ('9','$parkeerplaats','$last_idreservering')";
        $parkeerresult1= mysqli_query($conn,$parkeerInsertquery); 
            }
  
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

          $dteStart = new DateTime($aankomstdatum);
          $dteEnd   = new DateTime($vertrekdatum);
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



            $query4="UPDATE factuur SET bedrag='$totaal'
            WHERE factuurid= $last_idfactuur";
            $result4=mysqli_query($conn,$query4);


          $overzcihtq="SELECT *,
          CONCAT(klanten.prefix,'-',klanten.klantnr) AS 'klantId', 
          CONCAT(factuur.prefix,'-',factuur.factuurid) AS 'factuurId', 
          CONCAT(reservering.prefix,'-',reservering.reserveringnr) AS 'reserveringId' FROM reservering
          INNER JOIN plaatsen ON reservering.plaatsnr=plaatsen.plaatsnr 
          INNER JOIN klanten ON reservering.klantnr=klanten.klantnr
          INNER JOIN factuur ON reservering.factuurid=factuur.factuurid 
          INNER JOIN optie ON reservering.reserveringnr=optie.reserveringnr  
          WHERE reservering.reserveringnr ='$last_idreservering' limit 1";
  
          $overzichtresult=mysqli_query($conn,$overzcihtq);

          while ($rij = mysqli_fetch_array($overzichtresult)) {
              
            $facDatum=$rij['ts_issued'];
            $facStatus=$rij['status'];
            $factuurId=$rij['factuurId'];
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
            $totaalpernacht=$aantaldagen*$plaatsPrijs;

          echo "<table>";
            echo "
            <thead>
            <tr>
            <th class=tg-invoice-info  colspan= 6 ><h2>Reservering Overzicht</h2></th>
            </tr>
            </thead>
            <tbody>
            <tr>
            <td class= tg-klant-info  colspan= 2 ><ul>
            <li><strong>Klantnaam: </strong>  $voornaam $achternaam </li>
            <li><strong>Tel: </strong>  $tel </li>
            <li><strong>Email: </strong>  $email  </li>
            </ul></td>
            <td class= tg-klant-info  colspan= 2 >
            <ul>
            <li><strong>Adres: </strong>  $adres $huisnummer  </li>
            <li><strong>Postcode: </strong>  $postcode </li>
            <li><strong>Woonplaats: </strong>  $woonplaats </li>
            </ul>
            </td >
            <td class= tg-klant-info colspan= 2>
            <div id=mySidenav class=sidenav>
            <form  action='reserveringWijzge.php' method='POST'>
                <input type='hidden' name='verstopt' value='$reserveringnr'>
                <input id='wijzigBtn' type='submit' name='wijzig' value='Wijzig'>
            </form>
            <form  action='reserveringVerwijder.php' method='POST'>
                <input type='hidden' name='verstopt' value='$reserveringnr'>
                <input id='verwijderBtn' type='submit' name='verwijder' value='Verwijder'>
            </form>
                <form action='reserveringOverzicht.php' method='POST'>
                <input type='submit' name='Naaroverzicht' value='Naar overzicht'>
            </form>
                <form action='../user/user_dashbord.php' method='POST'>
                <input type='submit' name='NaarHome' value='Naar Home'>
            </form>
            </div></td>
            </tr>
            <tr>
            <th class=tg-invoice-info >Klantnr nr.</th>
            <th class=tg-invoice-info >Factuur nr.</th>
            <th class=tg-invoice-info >Reservering nr.</th>
            <th class=tg-invoice-info >Reserveringdatum</th>
            <th class=tg-invoice-info >Ankomstdatum</th>
            <th class=tg-invoice-info >Vertrekdatum</th>
            </tr>
            <tr>
            <td class=tg-invoice-c-3r >  $klantId </td>
            <td class=tg-invoice-c-3r >  $factuurId </td>
            <td class=tg-invoice-c-3r >  $reserveringID </td>
            <td class=tg-invoice-c-3r >  $facDatum </td>
            <td class=tg-invoice-c-3r >  $datumaankomst</td>
            <td class=tg-invoice-c-3r >  $datumvertrek</td>
            </tr>
            <tr>
            <td class= tg-invoice-spece  colspan= 6 ></td>
            </tr>
            <tr>
            <th class= tg-invoice-info colspan=2 >Omschrijving</th>
            <th class= tg-invoice-info >Tarief</th>
            <th class= tg-invoice-info >Aantal</th>
            <th class= tg-invoice-info >Totaal per nacht</th>
            <th class= tg-invoice-info  >Totaal</th>
            
            </tr>
            <tr>
            <td class= tg-invoice-c-1r colspan=2 >  $plaats </td>
            <td class= tg-invoice-c-1r >  $plaatsPrijs </td>
            <td class= tg-invoice-c-1r >  $aantaldagen  (dagen)</td>
            <td class= tg-invoice-c-1r >-</td>
            <td class= tg-invoice-c-1r > $totaalpernacht  </td>
            
            </tr>
            <tr>
            <td class= tg-invoice-c-2r colspan=2 >Volwassenen</td>
            <td class= tg-invoice-c-2r >  $volwPrijs </td>
            <td class= tg-invoice-c-2r >  $aantalVolwas </td>
            <td class= tg-invoice-c-2r >  $volwpernacht </td>
            <td class= tg-invoice-c-2r >  $volwTotaal </td>
             
            </tr>
            <tr>
            <td class= tg-invoice-c-1r colspan=2 >Kinderen van 4 t/m 12:</td>
            <td class= tg-invoice-c-1r >  $kindPrijs </td>
            <td class= tg-invoice-c-1r >  $aantalKind </td>
            <td class= tg-invoice-c-1r >  $kindPernacht </td>
            <td class= tg-invoice-c-1r >  $kindTotaal </td>
            </tr>
            <tr>
            <td class= tg-invoice-c-2r colspan=2 >Bezoekers</td>
            <td class= tg-invoice-c-2r >  $bezoPrijs </td>
            <td class= tg-invoice-c-2r >  $bezoekers</td>
            <td class= tg-invoice-c-2r >  $bezoekPnacht </td>
            <td class= tg-invoice-c-2r >  $bezoekTotaal </td>
             
            
            </tr>
            <tr>
            
            <td class= tg-invoice-c-1r colspan=2 >Elektriciteit</td>
            <td class= tg-invoice-c-1r >  $elektPrijs </td>
            <td class= tg-invoice-c-1r >  $elektriciteit </td>
            <td class= tg-invoice-c-1r >-</td>
            <td class= tg-invoice-c-1r >  $elektrTotaal </td>
            </tr>
            <tr>
            <td class= tg-invoice-c-2r colspan=2 >Wasdroger</td>
            <td class= tg-invoice-c-2r >  $wasdPrijs </td>
            <td class= tg-invoice-c-2r >  $wasdroger </td>
            <td class= tg-invoice-c-2r >-</td>
            <td class= tg-invoice-c-2r >  $wasdTotaal </td>
             
            </tr>
            <tr>
            <td class= tg-invoice-c-1r colspan=2 >Wasmachine </td>
            <td class= tg-invoice-c-1r >  $wasmPrijs </td>
            <td class= tg-invoice-c-1r >  $wasmachine </td>
            <td class= tg-invoice-c-1r >-</td>
            <td class= tg-invoice-c-1r >  $wasmTotaal </td>
            </tr>
            <tr>
            <td class= tg-invoice-c-2r colspan=2 >Douche</td>
            <td class= tg-invoice-c-2r >  $dochPrijs </td>
            <td class= tg-invoice-c-2r >  $douche </td>
            <td class= tg-invoice-c-2r >-</td>
            <td class= tg-invoice-c-2r >  $dochTotaal </td>
             
            </tr>
            <tr>
            <td class= tg-invoice-c-1r colspan=2 >Huisdier</td>
            <td class= tg-invoice-c-1r >  $huisdPrijs </td>
            <td class= tg-invoice-c-1r >  $huisdier </td>
            <td class= tg-invoice-c-1r >  $hdierPnacht </td>
            <td class= tg-invoice-c-1r >  $hdierTotaal </td>
            </tr>
            <tr>
            <td class= tg-invoice-c-2r colspan=2 >Parkeerplaats</td>
            <td class= tg-invoice-c-2r >  $parkplPrijs </td>
            <td class= tg-invoice-c-2r >  $parkeerplaats </td>
            <td class= tg-invoice-c-2r >  $parkPnacht </td>
            <td class= tg-invoice-c-2r >  $parkTotaal </td>
             
            </tr>
            <tr>
            <td class= tg-invoice-spece  colspan= 6 ></td>
            </tr>
            <tr>
            <th class= tg-invoice-info  colspan= 4 >Omschrijving</th>
            <th class= tg-invoice-info  colspan= 2 >Bedrag</th>
            </tr>
            <tr>
            <td class= tg-invoice-c-1r  colspan= 4 ><strong>Sub Totaal</strong></td>
            <td class= tg-invoice-c-1r  colspan= 2 >  $subTotaal </td>
            </tr>
            <tr>
            <td class= tg-invoice-c-2r  colspan= 4 ><strong>BTW 6%</strong></td>
            <td class= tg-invoice-c-2r  colspan= 2 >  $btw </td>
            </tr>
            <tr>
            <td class= tg-invoice-c-1r  colspan= 4 ><strong>Totaal</strong></td>
            <td class= tg-invoice-c-1r  colspan= 2 >  $totaal </td>
            </tr>
            
    

        </tbody>
        </table>";
            ?>

<div class="btn-group">
<button type ="button"  onClick="window.location.href='reserveringOverzicht.php';"> Naar overzicht </button>
<button type ="button"  onClick="window.location.href='home.php';"> Naar Home </button>

</div>

  </div>

</body>
</html>

