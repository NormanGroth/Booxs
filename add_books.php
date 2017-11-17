<?php
require('config.php');
$status = "";
if(isset($_POST['autor'])){
  $autor = $_POST['autor'];
  $titel = $_POST['titel'];
  $isbn = $_POST['isbn'];
  $preis = $_POST['preis'];
  $stmt = "INSERT INTO `books` (`id`, `autor`, `titel`, `isbn`,`preis`) VALUES (NULL, '" . $autor . "', '" . $titel . "', '" . $isbn ."', '" . $isbn ."');";
  $result = $link->query($stmt);
  
  $status = "Buch wurde hinzugefügt!";
}
else {
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

	<script>
	  function replaceUsername(){
		document.getElementById('autor').value = "";
	  }
	</script>
</head>
<body>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <h1>Add Book</h1>
			<h2><?php echo $status ?></h2>
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