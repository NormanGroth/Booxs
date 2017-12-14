<?php
 header('Content-Type: text/html; charset=utf-8'); // Definition des Inhalts und des Zeichensatzes
 require('config.php'); // Einbindung des Inhalts von config.php an dieser Stelle
 $status = ""; // Initialisierung der Variable §status ohne Wert, wird später im IF- oder ELSE-Zweig mit Inhalt versehen

if(isset($_POST['username'])){ /* IF-Bedingung: Prüft ob, in dem Formularfeld "username" bei der Übermittlung des Formulars (per HTML-Request, nicht per URL-Übertragung) Inhalt ist (=gesetzt) oder, ob es leer ist */
// Falls die IF-Bedingung wahr ist, also Inhalt in dem Formularfeld "username" drinne ist:
  $username = $_POST['username']; // Abfrage der Formularzelle "username" des unteren HTML-Formulars und Speicherung des Inhalts in der Variable $username
  $mail = $_POST['mail']; //same
  $password = $_POST['password']; // same
  $anfrage = "INSERT INTO `user` (`id`, `username`, `mail`, `password`) VALUES (NULL, '" . $username . "', '" . $mail . "', '" . $password ."');"; // mySQL-Befehl: In die Tabelle "user" wird in den Spalten "id", "username", "password" und "email"  die Werte aus dem unteren HTML-Formular eingefügt. Speicherung dieser Anfrage in der Variable $anfrage.
  $ergebnis = $link->query($anfrage); // Aufbau der Verbindung ($link) zur Datenbank und Ablauf der Anfrage ($anfrage) und Speicherung in der Variable $ergebnis
  
  $status = "User added!"; // Falls Ablauf bis hier erfolgreich: Ausgabe einer Statusmeldung in der oben initialisierten Variable $status: "User added"
}
else { // Falls IF-Bedingung unwahr ist, also kein Inhalt in dem Formularfeld "username" ist:

  $status = "No user added"; // Ausgabe einer Statusmeldung in der oben initialisierten Variable $status: "No user added!
}
?>

<!doctype html>
<html lang="de">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
</head>
<body>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <h1>Add User</h1>
             <h2><?php echo $status ?></h2> <!-- Abfrage des Ergebnisses der oben definierte $status-Variable: Wurde ein Benutzer hinzugefügt oder nicht? --> 
            <div class="form-group">
              <label for="username">User-Name:</label>
              <input type="text" class="form-control" id="username" name="username" value="Bitte User-Name eingeben">
            </div>
            <div class="form-group">
              <label for="email">E-Mail:</label>
              <input type="text" class="form-control" id="mail" name="mail" value="Bitte E-Mail eingeben">
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-default" name="btn-save">Add User</button>
          </form>
          </div>
        </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>