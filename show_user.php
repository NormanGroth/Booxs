<?php
 header('Content-Type: text/html; charset=utf-8'); // Definition des Inhalts und des Zeichensatzes
 require('config.php'); // Einbindung des Inhalts von config.php an dieser Stelle

   if (isset($_GET['loeschenID'])){ /* IF-Bedingung: Prüft, ob die Variable $_GET gesetzt ist oder, ob es leer ist */
	$loeschenID = $_GET['loeschenID']; // Fragt die in der URL gesetzte ID ab und speichert diese in der Variable $loeschenID (RICHTIG???) -> ID wird aus Datenbank ausgelesen, an die URL rangehängt, dort von der GET-Funktion abgefragt und dann per Klick aus der Datenbank gelöscht (RICHTIG???)
	$loeschen = "DELETE FROM `user` WHERE `user`.`id` = " . $loeschenID; // Löschen der definierten ID in der Tabelle "user" der Datenbank
	mysqli_query($link,$loeschen); // Verbindungsaufbau zur Datenbank und Ausführung der Variable §loeschen
  }
?>

<!DOCTYPE html> 
<html lang="de">
  <head> 
    <title>List of users</title> 
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  </head>
  <body>
  	<h1>List of users</h1>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <table class="table-striped table">
  	<th>Name</th> <!-- = table header, Anfang einer Kopfzelle (also eine Reihe mit dicker Überschrift) -->
  	<th>E-Mail</th>
  	<th>Password</th>
  	<th>Delete</th>
  	<th>Edit</th>

<?php
$anfrage="SELECT * FROM `user`"; // Abfrage aller (*) Daten von der user-Tabelle aus der SQL-Datenbank und Speicherung in der $abfrage-Variable
$ergebnis=$link->query($anfrage); /*  Aufbau der Datenbank-Verbindung ($link), Abfrage der Datenbank gemäß $abfrage und Speicherung in der $ergebnis-Variable */

if ($ergebnis->num_rows > 0)  // IF-Bedingung: Wenn es in der Datenbank mehr als 0 Reihen gibt, dann:
{
   while ($reihe = mysqli_fetch_row($ergebnis)) // Wenn IF-Bedingung wahr (= mehr als 0 Reihen), dann: Abruf von Daten (mysqli_fetch_row) gemäß der Variable $ergebnis aus der Datenbank, solange Daten vorhanden sind (While-Schleife) und Speicherung in der Variable "reihe"   
{
echo "<tr>"; // Beginn einer Tabellenzeile, welche mehrere Tabellenzellen enthält, nämlich folgende 3:
echo "<td>" . $reihe[1] . "</td>"; // Beginn von Tabellenzelle (td=table data) und Wiedergabe (. $reihe[1] .) des Inhalts der 1.Reihe/Spalte der DB
echo "<td>" . $reihe[2] . "</td>"; // Beginn von Tabellenzelle (td=table data) und Wiedergabe (. $reihe[2] .) des Inhalts der 2.Reihe/Spalte der DB
echo "<td>" . $reihe[3] . "</td>"; // Beginn von Tabellenzelle (td=table data) und Wiedergabe (. $reihe[3] .) des Inhalts der 3.Reihe/Spalte der DB
echo "<td><a href='show_user.php?loeschenID=" . $reihe[0]. "'>delete</a></td>"; // Beginn von Tabellenzelle (td=table data) und Wiedergabe (. $reihe[0] .) des Inhalts der 0.Reihe/Spalte der DB = Abruf der ID und Anhängen an die Variable der URL
echo "<td><a href='edit_user.php?ID=" . $reihe[0]. "'>edit</a></td>\n"; // Übergabe der zu editierenden ID per URL (=GET-Funktion) an die Seite "edit_user.php"
echo "</tr>"; // Ende der einen Tabellenzeile
}
}
    else {
        echo "<tr><td colspan='4'>No data found</td></tr>"; // Wenn IF-Bedingung nicht wahr und keine Daten aus der Datenbank abgerufen werden können: Ausgabe einer Fehlermeldung: No Data found!
    }

?>
  </table>
  </body>
</html>