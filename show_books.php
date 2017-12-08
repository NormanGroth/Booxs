<?php // Beginn PHP
  header('Content-Type: text/html; charset=utf-8'); // Inhalt wird als Text/HTML gesetzt und in UTF-8 kodiert
  require('config.php'); // Bindet anderes PHP-Dokument ein als würde es an dieser Stelle stehen


  if (isset($_GET['deleteID'])) 
  // if = Definition der IF-Bedingung in der Klammer: Was soll überprüft werden?: 
  // isset = Prüft, ob eine Variable existiert und ob sie nicht NULL ist
  // $_GET = diese Variable wird überprüft -> $_GET übergibt Variablen von einer Seite zur nächsten Seite mittels der URL
    { // Was soll ausgeführt werden, wenn die gesetzte IF-Bedingung zutrifft?
    $deleteID = $_GET['deleteID'];
    $sql = "DELETE FROM `books` WHERE `id` = " . $deleteID; // In der Variable $sql wird gespeichert: Lösche aus der Tabelle "user" in der Spalte "user" eine bestimmte User-ID
    mysqli_query($link, $sql); // $link = Verbindungsaufbau zur Datenbank, siehe unten & $sql = Löschen einer bestimmten ID von der Spalte "user" aus der Tabelle "user"
  }
// Ende PHP `user`.
?>

<!DOCTYPE html>
<html lang="de">
  <head>
    <title>Books</title>
     <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  </head>
  <body>
    <h1>Books</h1>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<table class="table-striped table">
  <th>Autor</th>
  <th>Titel</th>
  <th>ISBN</th>
  <th>Preis</th>
  <th>Löschen</th>
  <th>Bearbeiten</th>

  <?php
    $link = mysqli_connect("localhost", "root", "", "booxs");
    $stmt = "SELECT * FROM `books`";
    $result = $link->query($stmt);

    if ($result->num_rows > 0){
      while ($row = mysqli_fetch_row($result)){
        echo "<tr>\n";
        echo "<td>" . $row[1] . "</td>\n";
        echo "<td>" . $row[2] . "</td>\n";
        echo "<td>" . $row[3] . "</td>\n";
        echo "<td>" . $row[4] . "</td>\n";
        echo "<td><a href='show_books.php?deleteID=" . $row[0]. "'>delete</a></td>\n"; // HTML-Link mit index.php?deleteID= + Angabe der zu löschenden Zeile
        echo "<td><a href='edit_books.php?ID=" . $row[0]. "'>edit</a></td>\n";
        echo "</tr>";
      }
    }
    else {
        echo "<tr><td colspan='6'>No data found</td></tr>";
    }
  ?>

</table>
  </body>
</html>