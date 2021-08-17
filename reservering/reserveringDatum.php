<!DOCTYPE html>
<html>

<body>

  <?php

  include("../connectie.php");

  echo $x = $_POST['x'];
  echo $y = $_POST['y'];
  $plaatsid = "";


  $sql = "SELECT plaatsen.plaatsnaam, plaatsen.plaatsid, plaatsen.plaatsnr, reservering.datumaankomst, reservering.datumvertrek
    FROM reservering RIGHT JOIN
    plaatsen ON reservering.plaatsnr = plaatsen.plaatsnr WHERE plaatsen.plaatsnr 
    NOT IN(SELECT plaatsnr FROM reservering WHERE (datumaankomst BETWEEN '$x' AND '$y' OR datumvertrek BETWEEN '$x' AND '$y')
    OR( datumaankomst <= '$x' AND datumvertrek >= '$y'))GROUP BY plaatsid ORDER BY plaatsnr ASC ";
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_array($result)) {


    echo "<option value='" . $row['plaatsnr'] . "'>" . $row['plaatsnaam'] . " " . $row['plaatsid'] . "</option>";
  }
  ?>

  </select>
</body>

</html>