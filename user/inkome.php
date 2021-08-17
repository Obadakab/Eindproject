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

<!DOCTYPE HTML>
<html>
<head>
    <style>
        body{
            text-align: center;
        }
    .Container
        {
            margin: 20px;
  border-radius: 10px;
  background-color: #b9ff99;
  padding: 10px;
  width: 95%;
  margin-left: auto;
  margin-right: auto;
  text-align: center;
 
        text-align: center;
        }
    body * {
        box-sizing: border-box;
        }
    #h2
    {

        padding:10px;
    }

    #chartContainer
        {
        height: 60%;
        width: 70%;
        margin: 20px;
        margin-left: auto;
        margin-right: auto;

        }

        .btn-group button,input[type="submit"],input[type="button"] {
  background-color: #f4511e; /* Green background */
  border: 1px solid #acceec; /* Green border */
  border-radius: 4px;
  padding: 10px ; /* Some padding */
  cursor: pointer; /* Pointer/hand icon */
  margin: 2px  4px  2px  4px;
  text-align: center;
  float: center; /* Float the buttons side by side */
  }

  /* Clear floats (clearfix hack) */
  .btn-group:after {
  content: "";
  clear: both;
  display: table;
  }

  /* Add a background color on hover */
  .btn-group button:hover,input[type="submit"]:hover {
  background-color: #3e8e41;
  }

    </style>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    </head>
<body>

<div class="Container">
    
<h2 id="h2">JaarlijkInkome overzicht over  <?php echo date("Y"); ?></h2>
<div class="btn-group">
        <button type="button" onClick="window.location.href='../reservering/reserveringForm.php';">Nieuwe reservering</button>
        <button type="button" onClick="window.location.href='../reservering/reserveringOverzicht.php';">reservering overzicht</button>
        <button type="button" onClick="window.location.href='../fpdf/factuurOverzicht.php';">facturen overzicht</button>
        <button type="button" onClick="window.location.href='../user/inkome.php';">inkome schema</button>
        <button type="button" onClick="window.location.href='create_user.php';"> + add user</button>
    </div>
 

						
</div>
<div id="chartContainer"></div>

<?php


$incQuery="SELECT coalesce(sum(e.bedrag), 0) as income, m.month
from (SELECT '01' as month union all
      SELECT '02' as month union all
      SELECT '03' as month union all
      SELECT '04' as month union all
      SELECT '05' as month union all
      SELECT '06' as month union all
      SELECT '07' as month union all
      SELECT '08' as month union all
      SELECT '09' as month union all
      SELECT '10' as month union all
      SELECT '11' as month union all
      SELECT '12' as month
      ) m left join
     factuur e on year(e.ts_issued) = YEAR(CURDATE()) and DATE_FORMAT(e.ts_issued,'%m') = m.month
        group by m.month";

    $incArray=array();
    $incResult= mysqli_query($conn,$incQuery);
    while ($resultrow = mysqli_fetch_array($incResult)) {
        array_push($incArray, $resultrow['income']);
        }
    // while ($resultrow = mysqli_fetch_array($incResult,MYSQLI_ASSOC)) {
    // echo sprintf(" %s", $resultrow["income"]);
    // echo "<br>";
    // echo "<br>";
    // }
    $incArray[0];
    $incArray[1];
    $incArray[2];
    $incArray[3];
    $incArray[4];
    $incArray[5];
    $incArray[6];
    $incArray[7];
    $incArray[8];
    $incArray[9];
    $incArray[10];
    $incArray[11];

    $totaalJaarlijks=$incArray[0]+$incArray[1]+$incArray[2]+$incArray[3]+$incArray[4]+
    $incArray[5]+$incArray[6]+ $incArray[7]+$incArray[8]+$incArray[9]+$incArray[10]+$incArray[11];

    $dataPoints = array( 
        array("y" => $incArray[0], "label" => "Jan" ),
        array("y" => $incArray[1], "label" => "Feb" ),
        array("y" => $incArray[2], "label" => "Mar" ),
        array("y" => $incArray[3], "label" => "Apr" ),
        array("y" => $incArray[4], "label" => "May" ),
        array("y" => $incArray[5], "label" => "Jun" ),
        array("y" => $incArray[6], "label" => "Jul" ),
        array("y" => $incArray[7], "label" => "Aug" ),
        array("y" => $incArray[8], "label" => "Sep" ),
        array("y" => $incArray[9], "label" => "Oct" ),
        array("y" => $incArray[10], "label" => "Nov" ),
        array("y" => $incArray[11], "label" => "Dec" )
    );

 ?>

<script>
 window.onload = function () {
    CanvasJS.addColorSet("colorSet",
            [//colorSet Array
                'rgba(255, 99, 132, 0.75)',
                'rgba(54, 162, 235, 0.75)',
                'rgba(255, 206, 86, 0.75)',
                'rgba(75, 192, 192, 0.75)',
                'rgba(153, 102, 255, 0.75)',
                'rgba(255, 159, 64, 0.75)',
                'rgba(245, 183, 177 , 0.75)',
                'rgba(215, 189, 226 , 0.75)',
                'rgba(169, 204, 227, 0.75)',
                'rgba(118, 215, 196, 0.75)',
                'rgba(247, 220, 111 , 0.75)',
                'rgba(255, 159, 64, 0.75)'               
            ]);
  
 var chart = new CanvasJS.Chart("chartContainer", {
    // width:720,
     animationEnabled: true,
     animationDuration: 2500,
     backgroundColor: "#F5DEB3",
     colorSet: "colorSet",
     title:{
         
        horizontalAlign: "center",
         text: "Jaarlijks Inkomen <?php echo date("Y"); ?>"
     },
     subtitles:[
		{
			text: "Totaal Inkomen  <?php echo $totaalJaarlijks; ?>"
			//Uncomment properties below to see how they behave
			//fontColor: "red",
			//fontSize: 30
		}
		],
     axisY:{
         includeZero: false
         
         
     },
     axisX:{
        interval: 1,
		intervalType: "month",
        labelFontSize: 12,
        margin:15
     },
 

     data: [{
        type: "column",
        name: "Average Amount",
        indexLabel: "{y}",
        yValueFormatString: "$#0.##",
        showInLegend: false,
		
         dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
     }]
 });
 chart.render();
  

 }
 </script>
 </body>
 </html>   