<?php
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Edit profile page</title>
	
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  </head>
  
  <body>      
    <?php
    if (isset($_SESSION['loggedin'])) {  
    }
    else {
        echo "<div class='alert alert-danger mt-4' role='alert'>
        <h4>No te haz autenticado!.</h4>
        <p><a href='login.html'>Login Here!</a></p></div>";
        exit;
    }
    // checking the time now when check-login.php page starts
    $now = time();           
    if ($now > $_SESSION['expire']) {
        session_destroy();
        echo "<div class='alert alert-danger mt-4' role='alert'>
        <h4>Your session has expire!</h4>
        <p><a href='login.php'>Accede nuevamente</a></p></div>";
        exit;
        }
    ?>

    <div class="container">
<p>
     <?php echo "<div class='alert alert-success mt-4'  role='alert'><strong>Bienvenido </strong>"; ?>
         <?php echo $_SESSION['name']; ?></p>
         <p><a href="logout.php">Logout</a></p>
        <h3>Administración de  Usuarios</h3>

         <a href="creaUsuario.php">Alta de un nuevo usuario</a>
    <?php

    include 'conn.php';

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // Query to check if the email already exist
    $registros = "SELECT * FROM users ";

    // Variable $result hold the connection data and the query
    $result = $conn-> query($registros);

    // Variable $count hold the result of the query
   // $count = mysqli_num_rows($result);

     echo "<br>
      <br>";


echo "<table border='1'>
 <tr>
    <th>id usuario</th>
    <th>Nombre </th>
    <th>E-mail </th>
    <th>Password </th>
    <th> Eliminar  </th>
    <th>  Actualizar </th>
  </tr>";
   while ($fila =mysqli_fetch_array($result)){
    
echo "<tr>";
echo"<td>". $fila ["Id"]. "</td>";
echo   "<td>". $fila ["Name"]. "</td>";
echo   "<td>". $fila ["Email"]. "</td>";
echo   "<td>". $fila ["Password"]. "</td> ";
echo   "<td> <a href='deletesql.php?id=".$fila ['Id']."'>Eliminar </a> </td>
       <td> <a href='actualizasql.php?id=".$fila ['Id']."'> Actualizar </a></td>
       </tr>"; 

}

echo "</table>";
?>





        
    </div>

	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

	</body>
</html>