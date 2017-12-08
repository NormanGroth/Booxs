<?php
require('config.php');
$status = ""; // hat eigentlich keine Funktion, da er später in jedem Fall von einem der beiden Zweige überschrieben wird
if(isset($_POST['username'])){ // Prüft, ob Inhalt in der Zelle "username" des unteren HTML-Formulars ist
  $name = $_POST['username']; // Fragt die Zelle "username" des HTML-Formulars ab und speichert den Inhalt in der Variable $name
  $password = $_POST['password'];
  $email = $_POST['email'];
  $stmt = "INSERT INTO `user` (`id`, `username`, `password`, `email`) VALUES (NULL, '" . $name . "', '" . $password . "', '" . $email ."');"; //Speichert die eingegebenen Werte des HTML-Formulars in der Tabelle "user" in den Spalten "id" usw
  $result = $link->query($stmt); // Baut Verbindung zur Datenbank auf und löst die $stmt Abfrage aus
  
  $status = "User wurde hinzugefügt!";
}
else {
  $status = "Es wurde kein Benutzer hinzugefügt!";
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

	<script>
	  function replaceUsername(){ // ???
		document.getElementById('username').value = ""; // ???
	  }
	</script>
</head>
<body>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <h1>Add User</h1>
			<h2><?php echo $status ?></h2> <!-- Ausgabe des Status: Wurde ein Benutzer hinzugefügt oder nicht? --> 
            <div class="form-group">
              <label for="username">User-Name:</label>
              <input type="text" class="form-control" id="username" name="username" value="Bitte User-Name eingeben" onclick="replaceUsername()">
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group">
              <label for="email">E-Mail:</label>
              <input type="text" class="form-control" id="email" name="email" value="Bitte E-Mail eingeben">
            </div>
            <button type="submit" class="btn btn-default" name="btn-save">Add User</button>

          </form>

          </div>
        </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>