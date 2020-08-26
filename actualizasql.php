<!doctype html>
<?php
session_start();
?>

<html lang="en">
  <head>
    <title>Actualiza información</title>
    
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
		<link rel="stylesheet" href="css/custom.css">
  </head>
  <body>
  
  <div class="container">
		
	 <?php
			// Connection info. file
			include 'conn.php';	
			
			// Connection variables
			$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

			// Check connection
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			
			// data sent from form login.html 
			if (!isset($_POST['enviado'])) {

                if (isset($_GET['id'])) {
				$id = $_GET['id']; 
				echo "get";

               }else {
                $id = $_POST['id'];
                 echo "post";
                 echo "codigo de actualizacion";
     
                  echo "<script>
                      alert('Datos actualizados!');

                      </script>";
                      $nombre= $_POST['name'];
                      $email= $_POST['email'];
                      $password= $_POST['password'];
                      $rol= $_POST['rol'];
                $sql = "UPDATE users SET Name=' $nombre', 
                                         Email='$email', 
                                         Password='$password',
                                         Rol ='$rol'
                                          WHERE Id=$id";

                 if ($conn->query($sql) === TRUE) {
                    echo "Actualización exitosa!";
                 } else {
                    echo "Error al actualizar!: " . $conn->error;
                 } 


               }
			// Query sent to database
			$result = mysqli_query($conn, "SELECT * FROM users WHERE Id = '$id'");
			
			// Variable $row hold the result of the query
			$row = mysqli_fetch_assoc($result);

       ?>



	<div class="row">	
		<div class="col-sm-12 col-md-6 col-lg-6">
		
		<h3>Actualiza un registro</h3><hr />
		
		<form method="post" action="actualizasql.php?enviado=true" >
			<div class="form-group">
			    Nombre:				
				<input type="text" class="form-control" name="name" placeholder="Enter your name" required value="<?php echo $row['Name']?>"  >			
		  </div>
		  
		  <div class="form-group">	
		         E-mail:			
				<input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter your email" required value="<?php echo $row['Email']?>"  >			
			</div>
		  
		  <div class="form-group">
		        Password				
				<input type="text" class="form-control" name="password" placeholder="Change Password"  required value="<?php echo $row['Password']?>"  >

			
			</div>
			<div class="form-group">
		        Rol	
			<select id="rol" name="rol" class="form-control">
			    <option value="1"  <?php if ($row['Rol'] == '1') echo ' selected="selected"'; ?> >Administrador </option>
			    <option value="2" <?php if ($row['Rol'] == '2') echo ' selected="selected"'; ?>>Prestador </option>
			    <option value="3" <?php if ($row['Rol'] == '3') echo ' selected="selected"'; ?>>Cliente </option>
			    
			  </select>

				
			
			</div>
			 
			<input type ="hidden" name="id" value="<?php echo $row['Id']?>" >
		  
		  <button type="submit" class="btn btn-success btn-block">Actualizar </button>
		</form>	
        <form method="post" action="edit-profile.php" >
		  <button type="submit" class="btn btn-success btn-block">Regresar </button>
		</form>	
		</div>		
		
	</div>
</div>

<?php 
    } 
    mysqli_close($conn);
?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
 
	</body>
</html>