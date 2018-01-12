<?php
 header('Content-Type: text/html; charset=utf-8'); // Definition des Inhalts und des Zeichensatzes
 require('config.php'); // Einbindung des Inhalts von config.php an dieser Stelle
 $status = ""; // Initialisierung der Variable §status ohne Wert, wird später im IF- oder ELSE-Zweig mit Inhalt versehen

if(isset($_POST['username'])){ /* IF-Bedingung: Prüft ob, in dem Formularfeld "username" bei der Übermittlung des Formulars (per HTML-Request, nicht per URL-Übertragung) Inhalt ist (=gesetzt) oder, ob es leer ist */
// Falls die IF-Bedingung wahr ist, also Inhalt in dem Formularfeld "username" drinne ist:
  $username = $_POST['username']; // Abfrage der Formularzelle "username" des unteren HTML-Formulars und Speicherung des Inhalts in der Variable $username
  $mail = $_POST['mail']; //same
  $password = $_POST['password']; // same
  $address = $_POST['address'];
  $lat = 0.0;
  $lng = 0.0;
  $maps_url = 'https://' .
	'maps.googleapis.com/' .
	'maps/api/geocode/json' .
	'?address=' . urlencode($address);
  $maps_json = file_get_contents($maps_url);
  $maps_array = json_decode($maps_json, true);
  $lat = $maps_array['results'][0]['geometry']['location']['lat'];
  $lng = $maps_array['results'][0]['geometry']['location']['lng'];

  $anfrage = "INSERT INTO `user` (`id`, `username`, `mail`, `password`, `address`,`lat`, `lng`) VALUES (NULL, '" . $username . "', '" . $mail . "', '" . $password . "' ,'" . $address . "' ,'" . $lat . "' ,'" . $lng . "');"; // mySQL-Befehl: In die Tabelle "user" wird in den Spalten "id", "username", "password" und "email"  die Werte aus dem unteren HTML-Formular eingefügt. Speicherung dieser Anfrage in der Variable $anfrage.
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
			<div class="form-group">
				<label for="address">Address:</label>
				<input type="text" class="form-control" id="address" name="address">
			</div>
            <button type="submit" class="btn btn-default" name="btn-save">Add User</button>
          </form>
			<div id ="map" style="width: 100%; height: 400px">
			</div>
          </div>
        	</div>


      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<script>
	function initMap() {
	var loc = {lat: <?php echo $row[7] ?>, lng: <?php echo $row[8] ?>};
	var map = new google.maps.Map(document.getElementById('map'), {
	zoom: 14,
	center: loc
	});
	var marker = new google.maps.Marker({
	position: loc,
	map: map
	});
	}
	</script>
	<script async defer
	src="https://maps.googleapis.com/maps/api/js?key=[AIzaSyBOfH33yqSm78VVt9COBYIojovNCh0ByVM]&callback=initMap">
	</script>

</body>
</html>