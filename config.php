<?php
  $link = mysqli_connect("localhost", "root", "", "booxs"); // In der Variable $link wird gespeichert: Verbindungsaufbau zur mySQL-Datenbank unter Benutzung folgender Daten: localhost, Benutzername, Passwort, Datenbankname

  mysqli_query($link, "SET NAMES 'utf8'");
  mysqli_error($link);
?>