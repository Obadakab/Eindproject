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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="style/reserveringOverzichtLayout.css">
  <title>reserveringoverzicht</title>

</head>

<body>
  <?php

  $query = "SELECT * FROM reservering 
INNER JOIN plaatsen ON reservering.plaatsnr = plaatsen.plaatsnr
INNER JOIN klanten on reservering.klantnr = klanten.klantnr";

  $result = mysqli_query($conn, $query);
  ?>

  <div class="container">

    <h1>Reservering Overzicht</h1>
    <div class="btn-group">
        <button type="button" onClick="window.location.href='reserveringForm.php';">Nieuwe reservering</button>
        <button type="button" onClick="window.location.href='reserveringOverzicht.php';">reservering overzicht</button>
        <button type="button" onClick="window.location.href='fpdf/factuurOverzicht.php';">facturen overzicht</button>
        <button type="button" onClick="window.location.href='../user/user_dashbord.php';">Naar gebruiker dashbord</button>
    </div>

    <div id="Sbar" class="searchBar">
      <i id="searchicon" class="fa fa-search"></i>
      <input type="text" name="search_text" id="search_text" placeholder="Search by Customer Details" onkeyup=" load_data(query)">
      <!-- <button type="submit"><i class="fa fa-search"></i></button> -->
    </div>
    <div id="result"></div>


  
  <?php
  	$limit = 10;  
    if (isset($_GET["page"])) {
      $page  = $_GET["page"]; 
      } 
      else{ 
      $page=1;
      };  
    $start_from = ($page-1) * $limit; 
    ?>
  <div class="pagination">
  <?php
	$result_db = mysqli_query($conn,"SELECT COUNT(reserveringnr) FROM reservering"); 
	$row_db = mysqli_fetch_row($result_db);  
	$total_records = $row_db[0];  
	$total_pages = ceil($total_records / $limit); 
	/* echo  $total_pages; */
	$pagLink = "";  
	if($page>=2){   
		echo "<a href='reserveringOverzicht.php?page=".($page-1)."'>  &laquo; </a>";   
	}       
			   
	for ($i=1; $i<=$total_pages; $i++) {   
	  if ($i == $page) {   
		  $pagLink .= "<a class = 'active' href='reserveringOverzicht.php?page="  
											.$i."'>".$i." </a>";   
	  }               
	  else  {   
		  $pagLink .= "<a href='reserveringOverzicht.php?page=".$i."'>   
											".$i." </a>";     
	  }   
	};     
	echo $pagLink;   

	if($page<$total_pages){   
		echo "<a href='reserveringOverzicht.php?page=".($page+1)."'> &raquo; </a>";   
	}   

  ?>    
  </div>  


  <br>
 
</div>   
</div>
<script>   
    function go2Page()   
    {   
        var page = document.getElementById("page").value;   
        page = ((page><?php echo $total_pages; ?>)?<?php echo $total_pages; ?>:((page<1)?1:page));   
        window.location.href = 'reserveringOverzicht.php?page='+page;   
    }   
  </script>  
  </div>
</body>

<script>
  $(document).ready(function() {
    // fetch data from table without reload/refresh page
    loadData();

    function loadData(query) {
      $.ajax({
        url: "reserveringOverzichtSerch.php",
        type: "POST",
        chache: false,
        data: {
          query: query
        },
        success: function(data) {
          $("#result").html(data);
        }
      });
    }

    // live search data from table without reload/refresh page
    $("#search_text").keyup(function() {
      var search = $(this).val();
      if (search != "") {
        loadData(search);
      } else {
        loadData();
      }
    });
  });
</script>

</html>