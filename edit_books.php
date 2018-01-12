<?php
header('Content-Type: text/html; charset=utf-8'); // Definition des Inhalts und des Zeichensatzes
require('config.php'); // Einbindung des Inhalts von config.php an dieser Stelle

$status = ""; // Initialisierung der Variable §status ohne Wert, wird später im IF- oder ELSE-Zweig mit Inhalt (=Status) versehen

/*
  Wir unterscheiden zwischen zwei Zuständen für das Skript:
  1) Es wurde per GET von einer Seite aufgerufen (z.B. von index.php):
  Es soll zunächst der zu ändernde Datensatz angezeigt werden.
  2) Daten wurden per POST zur Änderung aufgerufen:
  Die per POST übermittelten Daten sollen in der DB gespeichert werden.
*/

if (! empty($_GET['ID'])){  // IF-Bedingung:Prüft, ob von der Seite show_books.php eine ID per URL übergeben wurde (=wahr ist), d.h. die ID als Variable gesetzt ist. Falls hier eine ID als Variable gesetzt ist, folgendes ausführen:
 
  $ID = $_GET['ID']; // Speichert die per GET-Funktion von der URL abgerufene Variable in der Variable $ID -> wurde von der Seite show_books.php übergeben und wird benutzt um im Formularfeld über die ID die Daten abzurufen und diese später dann wieder editiert abzuschicken = ID-Übergabe ist elementar!
}

else if (! empty($_POST['ID'])){ // Wenn die Bedingung wahr ist, d.h. die ID im HTML-Formular unten gesetzt ist und das Feld nicht leer ist, die ID per POST-Funktion in die DB schreiben

  if (empty ($_POST['titel'])){  // Wenn die Bedingung wahr ist, d.h. der Username im HTML-Formular unten gesetzt ist und das Feld nicht leer ist, den Titel per POST-Funktion in die DB schreiben
      die("Titel muss gesetzt sein..."); // Falls Bedingung unwahr ist, d.h. der Titel nicht im HTML-Formular gesetzt ist, also das Feld leer ist, diese Meldung ausgeben
  }
  else { // Ansonsten, falls die Bedingung wahr ist, folgendes tun:
    $titel = $_POST['titel']; // Formularfeld "titel" auslesen und in der Variable $titel speichern
  }
  $autor = $_POST['autor']; // same
  $isbn = $_POST['isbn']; //same
  $price = $_POST['price']; //same
  $ID = $_POST['ID']; //same



$stmt = "UPDATE `books` SET `titel` = '" . $titel . "', `autor` = '" . $autor . "', `isbn` = '" . $isbn . "', `price` = '" . $price . "' WHERE `books`.`id` = " . $ID . ";";;  // Updatebefehl für die mySQL-Datenbank: Ersetze in der Tabelle "titel" bei einer bestimmten ID z.B. die ISBN durch den Inhalt der Variable $isbn
  $result = $link->query($stmt); // Aufbau zur Datenbank und Durchführung des vorher definierten Update-Befehls


  if ($result){
    $status = ">> Book " . $titel . " (ID: " . $ID . ") edited"; // Ausgabe einer Statusmeldung: "Book x (ID: x) edited"

  }
}

else { // Wenn Update nicht erfolgreich:
    die("No ID set!"); // Ausgabe der Fehlermeldung: "No ID set!"
}
$stmt = "SELECT * FROM `books` WHERE `ID` = $ID"; // Abruf der Daten aus der Tabelle "books" mit der ID der Variable $ID
$result = $link->query($stmt); // Verbindungsaufbau zur Datenbank und Abruf der Daten, Speicherung in $result


if ($result->num_rows > 0){ // Wenn mehr als 0 Zeilen Daten vorhanden sind, Abruf der Daten. Hier wird OOP verwendet, von dem Objekt $result wird die Anzahl der Zeilen abgefragt (nochmal prüfen)
  while ($row = mysqli_fetch_row($result)){ // Solange Daten abrufen, solange welche vorhanden sind
      $titel = $row[1]; // In das untere HTML-Formular wird bei der Zelle mit der ID=titel der Inhalt der Variable $row[1] eingesetzt
      $autor = $row[2]; //same
      $isbn = $row[3]; //same
      $price = $row[4]; //same
  
  }
}
else {
  die("Book with ID " . $ID . " not found"); // Fehlermeldung, falls unter der ID kein Datensatz gefunden worden ist 
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

</head>
<body>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <h1>Edit Book</h1> <!-- Ausgabe eines Status -->
			      <h2><?php echo $status ?></h2>
            <!--
              DIE NÄCHSTE ZEILE IST ZENTRAL!!!
              Hier übergeben wir die ID des Datensatzes, um den es geht.
              Wenn die Seite mit dem GET-Parameter ID
              aufgerufen wurde, schreiben wir hier die ID des zu ändernden
              Datensatzes rein. Diese ID wird dann beim Übermitteln des
              Formulars wieder mitgeschickt. D.h. beim Empfang der Formular-
              Daten ist immer noch bekannt, welcher Datensatz geändert
              werden soll (daraus wird der "WHERE ID = 3" Teil der
              SQL-Statements...)
              Wenn die Seite nach dem Editieren wieder aufgerufen wird,
              schreiben wir hier die ID des gerade geänderten (und evtl.
              erneut zu ändernden) Datensatzes rein.
              Es handelt sich um ein verstecktes Textfeld (type = "hidden")
              Dh. wir können Daten übertragen, ohne dass der User das im
              Frontend sieht...
            -->
            <input type="hidden" name="ID" value="<?php echo $ID ?>">
            <div class="form-group">
              <label for="titel">Name of book:</label>
              <!--
                über &lt;?php echo $username ?&gt; schreiben wir die vorher aus der
                DB gezogenen Daten in das Textfeld - wir füllen also das
                Formular schon mal mit bestehenden Daten...
              -->
              <input type="text" class="form-control" id="titel" name="titel" value="<?php echo $titel ?>">
           <div class="form-group">
              <label for="autor">Autor:</label>
              <input type="text" class="form-control" id="autor" name="autor" value="<?php echo $autor ?>">
            </div>
            </div>
            <div class="form-group">
              <label for="ISBN">ISBN:</label>
              <input type="text" class="form-control" id="isbn" name="isbn" value = "<?php echo $isbn ?>">
            </div>
            <div class="form-group">
              <label for="price">Price:</label>
              <input type="text" class="form-control" id="price" name="price" value = "<?php echo $price ?>">
            </div>
            <button type="submit" class="btn btn-default" name="btn-save">Edit Book</button>
          </form>

          </div>
        </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
