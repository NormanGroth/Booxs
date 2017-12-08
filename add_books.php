<?php // Beginn PHP
require('config.php'); // Einbindung config.php an dieser Stelle
if(isset($_POST['autor'])){ // Wenn (IF-Bedingung) das Feld nicht leer ist (isset), dann wird folgender Zweig ausgeführt:
  $autor = $_POST['autor']; // Datenübertragung durch $_POST mittels des unten erstellten HTML-Formulars durch Auslesen der dort vorhandenen Zelle "autor" und Speicherung in der Variable $autor (bei $_POST werden die Variablen durch ein Formular übertragen, bei $_GET durch die URL), jede PHP-Anweisung wird mit einem ";" beendet
  $titel = $_POST['titel'];  // Gleich: Abrufen des Inhaltes des Formularfeldes "titel" und Speichern in der Variable §titel
  $isbn = $_POST['isbn'];
  $preis = $_POST['preis'];
  $stmt = "INSERT INTO `books` (`id`, `autor`, `titel`, `isbn`,`preis`) VALUES (NULL, '" . $autor . "', '" . $titel . "', '" . $isbn ."', '" . $preis ."');"; // In die SQL-Datenbank werden in der Tabelle "books" die Spalten "id", "autor", "titel", "isbn" und "preis" mit den entsprechenden Daten aus dem Formular befüllt = Übergabe der Daten vom unteren HTML-Formular in die SQL-Datenbank mittels PHP
  $result = $link->query($stmt); // Verbindungsaufbau zur Datenbank durch $link (ist in config.php abgespeichert) und Übergabe (query) der abgefragten Daten von §stmt -> Speicherung in der Variable $result
  
  
  $status = "Buch wurde hinzugefügt!"; // "Buch wurde hinzugefügt" wird mit der Variable "$status" verbunden und ausgegeben, wenn dieser Zweig bis zum Ende abgespielt wird
}
else { // Falls das Feld doch leer ist, wird ein anderer Zweig ausgeführt mit Ausgabe der Meldung: "Es wurde kein Buch hinzugefügt!"
  $status = "Es wurde kein Buch hinzugefügt!";
}
?>
<!doctype html>
<html lang="de">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

	<script> // Beginn Javascript
	  function replaceUsername(){ // ???
		document.getElementById('autor').value = ""; // Das Element "autor" wird ausgewählt, ";" beendet jede JavaScript Zeile .value=""?
	  }
	</script> <!-- Ende Javascript -->
</head>
<body>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>"> <!-- Erstellung eines HTML-Formular, beim Absenden wird per action-Element durch den PHP-Code (ruft den aktuellen Dateinamen auf) die gleiche Seite wieder aufgerufen (man könnte nach dem Absenden auch auf eine neue Seite weiterleiten), POST-Methode geht über Formular anstatt URL, kann daher länger sein, URL ist begrenzt -->
            <h1>Add Book</h1>
			       <h2><?php echo $status ?></h2> <!-- Ausgabe von Status, siehe oben, 2 Möglichkeiten durch "else": "Es wurde ein/kein Buch hinzugefügt"-->
            <div class="form-group">
              <label for="autor">Autor:</label>
              <input type="text" class="form-control" id="autor" name="autor" value="Bitte Autor eingeben" onclick="replaceUsername()">
            </div>
            <div class="form-group">
              <label for="titel">Titel:</label>
              <input type="titel" class="form-control" id="titel" name="titel" value="Bitte Titel eingeben">
            </div>
            <div class="form-group">
              <label for="isbn">ISBN:</label>
              <input type="text" class="form-control" id="isbn" name="isbn" value="Bitte ISBN eingeben">
            </div>
               <div class="form-group">
              <label for="preis">Preis:</label>
              <input type="text" class="form-control" id="preis" name="preis" value="Bitte Preis eingeben">
            </div>
            <button type="submit" class="btn btn-default" name="btn-save">Add Book</button>

          </form>

          </div>
        </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>