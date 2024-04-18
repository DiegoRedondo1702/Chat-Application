<?php 
    session_start();
    if (!isset($_SESSION['username'])) {
?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chat App - Login</title>
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
        <div style="border: 2px solid #00FFFF;" class="w-400 p-5 shadow rounded">
            <form method="post" 
                action="app/http/auth.php">
                <div class="d-flex
                            justify-content-center
                            align-items-center
                            flex-column">

                <img src="img/logo.png" 
                    class="w-25">
                    <h3 style="background-color:#d300e7; color:#00FFFF;" class="display-4 fs-4 text-center">
                        Inicio de Sesión
                    </h3> 
                </div>
                <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-warning" role="alert">
                <?php echo htmlspecialchars($_GET['error']);?>
                </div>
                <?php } ?>
                
                <?php if (isset($_GET['success'])) { ?>
                <div class="alert alert-success" role="alert">
                <?php echo htmlspecialchars($_GET['success']);?>
                </div>
                <?php } ?>
            <div class="mb-3">
                <label style="color:#00FFFF;" class="form-label">
                    Usuario</label>
                <input type="text" 
                    class="form-control"
                    name="username">
            </div>

            <div class="mb-3">
                <label style="color:#00FFFF;" class="form-label">
                    Contraseña</label>
                <input type="password" 
                    class="form-control"
                    name="password">
            </div>
            
            <button type="submit" 
                    class="btn btn-primary">
                    Iniciar Sesión</button>
            <a href="signup.php">Registrarse</a>
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
