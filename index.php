<?php
  header('Content-Type: text/html; charset=utf-8');
  require('config.php');
?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <title>Users</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  </head>
  <body>
    <h1>Users</h1>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<table class="table-striped table">
  <th>Name</th>
  <th>E-Mail</th>

  <?php
    $link = mysqli_connect("localhost", "root", "", "booxs");
    $stmt = "SELECT * FROM `user`";
    $result = $link->query($stmt);

    if ($result->num_rows > 0){
      while ($row = mysqli_fetch_row($result)){
        echo "<tr>\n";
        echo "<td>" . $row[1] . "</td>\n";
        echo "<td>" . $row[2] . "</td>\n";
        echo "</tr>";
      }
    }
    else {
        echo "<tr><td colspan='2'>No data found</td></tr>";
    }
  ?>

</table>
  </body>
</html>