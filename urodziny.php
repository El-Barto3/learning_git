<!DOCTYPE html>
<html lang="pl" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>urodziny</title>
  <link rel="stylesheet" type="text/css" href="urodziny-style.css">
  <script src="scripts/jquery-3.5.1.min.js"></script>
  <script src="scripts/urodziny-dane.js"></script>
  <script src="scripts/urodziny-script.js"></script>
</head>

<body>
	<?php
	  $servername = "pma.ct8.pl";
	  $username = "m20451_spacer";
	  $password = "8GscvBRcTHa8YSq3Jn0w";
	  $dbname = "m20451_spacer";

	  // Create connection
	  $conn = new mysqli($servername, $username, $password, $dbname);
	  // Check connection
	  if ($conn->connect_error) {
	      die("Connection failed: " . $conn->connect_error);
	  }

	  $sql = "SELECT birthday FROM book";
	  $result = $conn->query($sql);

	  if ($result->num_rows > 0) {
	      // output data of each row
	      while($row = $result->fetch_assoc()) {
	          echo "<br> birthday: ". $row["birthday"];
	      }
	  } else {
	      echo "0 results";
	  }

	  $conn->close();
	?>
  <div id="urodziny">
    <div>Dzisiaj urodziny obchodzi</div>
    <div id="text">
        
    </div>
  </div>
</body>

</html>
