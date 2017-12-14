<?php
  $link = mysqli_connect("localhost", "root", "", "booky"); /* In der Variable $link wird gespeichert: Verbindungsaufbau zur mySQL-Datenbank unter Benutzung folgender Daten: localhost, Benutzername, Passwort, Datenbankname */

  mysqli_query($link, "SET NAMES 'utf8'"); // Abfrage (query) an die Datenbank wird ausgeführt: Aufbau Verbindung zu DB ($link) und UTF-8 Codierung
  mysqli_error($link); // Ausgabe des letzten Fehlers
?>