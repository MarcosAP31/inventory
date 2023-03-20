<?php include("Usuario.php");
session_start();
$txtEmail=(isset($_GET['txtEmail']))?$_GET['txtEmail']:"";
$txtPassword=(isset($_GET['txtPassword']))?$_GET['txtPassword']:"";

if($_GET){
  
  if(($_GET['txtEmail']=="admin")&&($_GET['txtPassword']=="admin")){
    $_SESSION['txtEmail']="ok";
    $_SESSION['nombreUsuario']="Admin";
    $_SESSION['USUARIO']="admin";
    ?>
                    <div  class="alert alert-success" role="alert" style="width:30%;margin:auto">
                         Inicio de sesión exitoso
                    </div>
                <?php sleep(2);
    header('Location:./seccion/productos.php');
  }
  else{
    $usuario=Usuario::getByCorreo($txtEmail);
    if($usuario!=null){
      if($usuario->Contraseña==$txtPassword){
        $_SESSION['txtEmail']="ok";
        $_SESSION['nombreUsuario']=$usuario->Nombre." ".$usuario->Apellidopaterno." ".$usuario->Apellidomaterno;
        $_SESSION['USUARIO']=$usuario->Correo;
         
        header('Location:./seccion/productos.php');
      }else{
        $mensaje="Error: El usuario o contraseña son incorrectos";
      }
    }else{
      $mensaje="Error: No existe un usuario registrado con ese correo";
    }
    
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
  
  <div class="container">
      <div class="row">
          <div class="col-md-4">

          </div>
          <div class="col-md-4">
              <br/><br/><br/>
              <div class="card">
                  <div class="card-header">
                      Login
                  </div>
                  <div class="card-body">
                  <?php if(isset($mensaje)) {?>  
                    <div class="alert alert-danger" role="alert">
                      <?php echo $mensaje;?>
                    </div>
                  <?php } ?>
                     <form method="GET">
                     <div class = "form-group">
                     <label>Usuario</label>
                     <input type="text" class="form-control" value="<?php echo $txtEmail;?>" name="txtEmail" placeholder="Escribe tu usuario">
                     
                     </div>

                     <div class="form-group">
                     <label>Contraseña:</label>
                     <input type="password" class="form-control" value="<?php echo $txtPassword;?>" name="txtPassword" placeholder="Escribe tu contraseña">
                     </div>

                     <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                     </form>
                     
                     
                  </div>
                  
              </div>
          
          
      </div>
  </div>

  </body>
</html>