<?php 
  session_start();

  if (!isset($_SESSION['username'])) {
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Chat App - Sign Up</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,700;1,400;1,700&family=Orbitron:wght@400;700&family=Bebas+Neue&display=swap">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link rel="stylesheet" 
	      href="css/style.css">
	<link rel="icon" href="img/logo.png">
</head>
<body background="img/retro.jpg" class="d-flex
             justify-content-center
             align-items-center
             vh-100">
	 <div class="w-400 p-5 shadow rounded">
	 	<form method="post" 
	 	      action="app/http/signup.php"
	 	      enctype="multipart/form-data">
	 		<div class="d-flex
	 		            justify-content-center
	 		            align-items-center
	 		            flex-column">

	 		<img src="img/logo.png" 
	 		     class="w-25">
	 		<h3 style="color:#00FFFF;"  class="display-4 fs-1 
	 		           text-center">
	 			       Registrarse</h3>   
	 		</div>

	 		<?php if (isset($_GET['error'])) { ?>
	 		<div class="alert alert-warning" role="alert">
			  <?php echo htmlspecialchars($_GET['error']);?>
			</div>
			<?php } 
              
              if (isset($_GET['name'])) {
              	$name = $_GET['name'];
              }else $name = '';

              if (isset($_GET['username'])) {
              	$username = $_GET['username'];
              }else $username = '';
			?>

	 	  <div class="mb-3">
		    <label style="color:#00FFFF;"  class="form-label">
		           Nombre</label>
		    <input style="color:#00FFFF;background-color:#d300e7;" type="text"
		           name="name"
		           value="<?=$name?>" 
		           class="form-control">
		  </div>

		  <div class="mb-3">
		    <label style="color:#00FFFF;"  class="form-label">
		           Nombre de usuario</label>
		    <input style="color:#00FFFF;background-color:#d300e7;" type="text" 
		           class="form-control"
		           value="<?=$username?>" 
		           name="username">
		  </div>


		  <div class="mb-3">
		    <label style="color:#00FFFF;"  class="form-label">
		           Contraseña</label>
		    <input style="color:#00FFFF;background-color:#d300e7;" type="password" 
		           class="form-control"
		           name="password">
		  </div>

		  <div class="mb-3">
		    <label style="color:#00FFFF;" class="form-label">
		           Foto de perfil</label>
		    <input style="color:#d300e7;background-color:#00FFFF;" type="file" 
		           class="form-control"
		           name="pp">
		  </div>
		  
		  <button style="color:#00FFFF;background-color:#d300e7;"  type="submit" 
		          class="btn btn-primary">
		          Registrarse</button>
		  <a style="color:#00FFFF;"  href="index.php">Inicio</a>
		</form>
	 </div>
</body>
</html>
<?php
  }else{
  	header("Location: home.php");
   	exit;
  }
 ?>
