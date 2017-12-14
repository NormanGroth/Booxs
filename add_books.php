<?php
 header('Content-Type: text/html; charset=utf-8'); // Definition des Inhalts und des Zeichensatzes
 require('config.php'); // Einbindung des Inhalts von config.php an dieser Stelle
 $status = ""; // Initialisierung der Variable §status ohne Wert, wird später im IF- oder ELSE-Zweig mit Inhalt versehen

if(isset($_POST['titel'])){ /* IF-Bedingung: Prüft ob, in dem Formularfeld "titel" bei der Übermittlung des Formulars (per HTML-Request, nicht per URL-Übertragung) Inhalt ist (=gesetzt) oder, ob es leer ist */
// Falls die IF-Bedingung wahr ist, also Inhalt in dem Formularfeld "titel" drinne ist:
  $titel = $_POST['titel']; // Abfrage der Formularzelle "titel" des unteren HTML-Formulars und Speicherung des Inhalts in der Variable $titel
  $autor = $_POST['autor']; //same
  $isbn = $_POST['isbn']; // same
  $price = $_POST['price']; // same
  $anfrage = "INSERT INTO `books` (`id`, `titel`, `autor`, `isbn`, `price`) VALUES (NULL, '" . $titel . "', '" . $autor . "', '" . $isbn ."', '" . $price."');"; // mySQL-Befehl: In die Tabelle "user" wird in den Spalten "id", "username", "password" und "email"  die Werte aus dem unteren HTML-Formular eingefügt. Speicherung dieser Anfrage in der Variable $anfrage.
  $ergebnis = $link->query($anfrage); // Aufbau der Verbindung ($link) zur Datenbank und Ablauf der Anfrage ($anfrage) und Speicherung in der Variable $ergebnis
  
  $status = "Book added!"; // Falls Ablauf bis hier erfolgreich: Ausgabe einer Statusmeldung in der oben initialisierten Variable $status: "Book added"
}
else { // Falls IF-Bedingung unwahr ist, also kein Inhalt in dem Formularfeld "titel" ist:

  $status = "No book added"; // Ausgabe einer Statusmeldung in der oben initialisierten Variable $status: "No book added!
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
            <h1>Add Book</h1>
             <h2><?php echo $status ?></h2> <!-- Abfrage des Ergebnisses der oben definierte $status-Variable: Wurde ein Buch hinzugefügt oder nicht? --> 
            <div class="form-group">
              <label for="username">Titel:</label>
              <input type="text" class="form-control" id="titel" name="titel" value="Please insert book name">
            </div>
            <div class="form-group">
              <label for="email">Autor:</label>
              <input type="text" class="form-control" id="autor" name="autor" value="Please insert autor name">
            </div>
           <div class="form-group">
              <label for="email">ISBN:</label>
              <input type="text" class="form-control" id="isbn" name="isbn" value="Please insert ISBN">
            </div>
                <div class="form-group">
              <label for="email">Price:</label>
              <input type="text" class="form-control" id="price" name="price" value="Please insert price">
            </div>
            <button type="submit" class="btn btn-default" name="btn-save">Add Book</button>
          </form>
          </div>
        </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>