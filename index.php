<?php // Beginn PHP
  header('Content-Type: text/html; charset=utf-8'); // Inhalt wird als Text/HTML gesetzt und in UTF-8 kodiert
  require('config.php'); // Bindet anderes PHP-Dokument ein als würde es an dieser Stelle stehen, wenn das PHP-Dokument nicht gefunden wird, bricht das Skript hart ab und der weitere Code wird nicht durchlaufen ("include" würde weiter laufen)


  if (isset($_GET['deleteID'])) 
  // if = Definition der IF-Bedingung in der Klammer: Was soll überprüft werden?: 
  // isset = Prüft, ob eine Variable existiert und ob sie nicht NULL ist
  // $_GET = diese Variable wird überprüft -> $_GET übergibt Variablen von einer Seite zur nächsten Seite mittels der URL
    { // Was soll ausgeführt werden, wenn die gesetzte IF-Bedingung zutrifft?
    $deleteID = $_GET['deleteID'];
    $sql = "DELETE FROM `user` WHERE `user`.`id` = " . $deleteID; // In der Variable $sql wird gespeichert: Lösche aus der Tabelle "user" in der Spalte "user" eine bestimmte User-ID
    mysqli_query($link, $sql); // $link = Verbindungsaufbau zur Datenbank, siehe unten & $sql = Löschen einer bestimmten ID von der Spalte "user" aus der Tabelle "user"
  }
// Ende PHP
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

<table class="table-striped table"> <!-- Beginn Tabelle -->
  <th>Name</th> <!-- th = Spalte bzw. Tabellenkopf -->
  <th>E-Mail</th>
  <th>Delete</th>
  <th>Edit</th>

  <?php // Hier Beginn der PHP-Einbindung in die Tabelle
    $link = mysqli_connect("localhost", "root", "", "booxs"); // In der Variable $link wird abgespeichert: Aufbau zur DB
    $stmt = "SELECT * FROM `user`"; // In der Variable $stmt wird abgespeicher: Abfrage aller Spalten in der Tabelle "user"
    $result = $link->query($stmt); // Aufbau der DB-Verbindung und Speicherung der abgefragten Daten in der Variable $result

    if ($result->num_rows > 0) // Wenn es in der Abfrage der Datenbank mehr als 0 Reihen gibt, dann:
    {
      while ($row = mysqli_fetch_row($result)) // Abfrage der Daten per WHILE-Schleife, solange Daten in der Datenbank vorhanden sind
      {  
        echo "<tr>\n"; // Anlage von einer Tabellenzeile, welche mehrere Tabellenzellen enthält, nämlich folgende 4:
        echo "<td>" . $row[1] . "</td>\n"; // Anlage von Tabellenzelle und gibt den Inhalt der 1.Reihe wieder + \n = Zeilenumbruch 
        echo "<td>" . $row[2] . "</td>\n"; // Anlage von Tabellenzelle und gibt den Inhalt der 2. Reihe wieder + \n = Zeilenumbruch 
        echo "<td><a href='index.php?deleteID=" . $row[0]. "'>delete</a></td>\n"; // HTML-Link mit index.php?deleteID= + Angabe der zu löschenden Zeile
        echo "<td><a href='edit_user.php?ID=" . $row[0]. "'>edit</a></td>\n";
        echo "</tr>"; // Ende der einen Tabellenzeile
        }
        echo "</tr>";
      }
    else {
        echo "<tr><td colspan='3'>No data found</td></tr>";
    }
  ?>

</table>
  </body>
</html>