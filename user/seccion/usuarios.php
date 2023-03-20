<?php include("../templateloginadministrador/cabecera.php");?>
<?php include("../clases/Usuario.php");

$txtDNI=(isset($_POST['txtDNI']))?$_POST['txtDNI']:"";
$txtSearch=(isset($_POST['txtSearch']))?$_POST['txtSearch']:"";
$Eleccion=(isset($_POST['select']))?$_POST['select']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
if(!isset($_SESSION['ARREGLO'])){
    $_SESSION['ARREGLO']="";
}
if(!isset($_SESSION['OPCION'])){
    $_SESSION['OPCION']="";
}
$_SESSION['EDITARDNIUSUARIO']= "";
$_SESSION['USUARIODNI']= "";
        $_SESSION['USUARIONOMBRE']= "";
        $_SESSION['USUARIOAPELLIDOPATERNO']= "";
        $_SESSION['USUARIOAPELLIDOMATERNO']= "";
        $_SESSION['USUARIOFECHANACIMIENTO']= "";
        $_SESSION['USUARIOSEXO']="";
        $_SESSION['USUARIODEPARTAMENTO']= "";
        $_SESSION['USUARIOPROVINCIA']= "";
        $_SESSION['USUARIODISTRITO']="";
        $_SESSION['USUARIODIRECCION']="";
        $_SESSION['USUARIOTELEFONO']="";
        $_SESSION['USUARIOCORREO']="";
        $_SESSION['USUARIOCONTRASEÑA']="";
        $usuarios=Usuario::all();
$arreglo=[];  


switch($accion){
    case "Buscar":
        
        if($txtSearch!=""){
           

        
        if($Eleccion=="DNI"){
            foreach($usuarios as $usuario){
                if(strpos($usuario->DNI,$txtSearch)!==false){
                    
                    array_push($arreglo,$usuario->DNI);
                }
                
            }
            $_SESSION['OPCION']='DNI';
            $_SESSION['ARREGLO']=$arreglo;
        }
        if($Eleccion=="NOMBRE"){
            foreach($usuarios as $usuario){
                if(strpos($usuario->Nombre,$txtSearch)!==false){
                    array_push($arreglo,$usuario->DNI);
                }
                
            }
           
            $_SESSION['OPCION']="NOMBRE";
            $_SESSION['ARREGLO']=$arreglo;
        }
        if($Eleccion=="SEXO"){
            foreach($usuarios as $usuario){
                if(strpos($usuario->Sexo,$txtSearch)!==false){
                    $usuariosbysexo=Usuario::getBySexo($usuario->Sexo);
                    foreach($usuariosbysexo as $usuario){
                       if(!in_array($usuario->DNI,$arreglo)){
                            array_push($arreglo,$usuario->DNI);
                       }
                        
                    }
                   
                }
            }
        
            $_SESSION['OPCION']="SEXO";
            $_SESSION['ARREGLO']=$arreglo;
        }
        if($Eleccion=="DEPARTAMENTO"){
            
            foreach($usuarios as $usuario){
                if(strpos($usuario->Departamento,$txtSearch)!==false){
                    $usuariosbydepartamento=Usuario::getByDepartamento($usuario->Departamento);
                    foreach($usuariosbydepartamento as $usuario){
                        if(!in_array($usuario->DNI,$arreglo)){
                            array_push($arreglo,$usuario->DNI);
                       }
                        
                    }
                    
                }
            }
            $_SESSION['OPCION']="DEPARTAMENTO";
            $_SESSION['ARREGLO']=$arreglo;
        }
        if($Eleccion=="PROVINCIA"){
            foreach($usuarios as $usuario){
                if(strpos($usuario->Provincia,$txtSearch)!==false){
                    $usuariosbyprovincia=Usuario::getByProvincia($usuario->Provincia);
                    foreach($usuariosbyprovincia as $usuario){
                        if(!in_array($usuario->DNI,$arreglo)){
                            array_push($arreglo,$usuario->DNI);
                       }
                       
                    }
                    
                }
            }
            $_SESSION['OPCION']="PROVINCIA";
            $_SESSION['ARREGLO']=$arreglo;
        }
        if($Eleccion=="DISTRITO"){
            foreach($usuarios as $usuario){
                if(strpos($usuario->Distrito,$txtSearch)!==false){
                    $usuariosbydistrito=Usuario::getByDistrito($usuario->Distrito);
                    foreach($usuariosbydistrito as $usuario){
                        if(!in_array($usuario->DNI,$arreglo)){
                            array_push($arreglo,$usuario->DNI);
                       }
                        
                    }
                    
                }
            }
            $_SESSION['OPCION']="DISTRITO";
            $_SESSION['ARREGLO']=$arreglo;
        }
        if($Eleccion=="TELEFONO"){
            foreach($usuarios as $usuario){
                if(strpos($usuario->Telefono,$txtSearch)!==false){
                    array_push($arreglo,$usuario->DNI);
                    
                } 
            }
            $_SESSION['OPCION']="TELEFONO";
            $_SESSION['ARREGLO']=$arreglo;
        }
        if($Eleccion=="CORREO"){
            foreach($usuarios as $usuario){
                if(strpos($usuario->Correo,$txtSearch)!==false){
                    array_push($arreglo,$usuario->DNI);
                    
                } 
            }
            $_SESSION['OPCION']="CORREO";
            $_SESSION['ARREGLO']=$arreglo;
        }
        }
        break;
    case "Perfil":
        header("Location:perfil.php");
        break;
    case "Entradas":
        header("Location:entradas.php");
        break;
    case "Salidas":
        header("Location:salidas.php");
        break;
    case "Productos":
        header("Location:productos.php");
        break;
    case "Clientes":
        header("Location:clientes.php");
        break;
    case "Usuarios":
        header("Location:usuarios.php");
        break;
    case "Proveedores":
        header("Location:proveedores.php");
        break;
    case "Inventario":
        header("Location:inventario.php");
        break;
    case "Agregar":
        header("Location:usuario.php");
        break;
    case "Editar":
        $usuariobyDNI=Usuario::getByDNI($txtDNI);
        $_SESSION['USUARIODNI']=$usuariobyDNI->DNI;
        $_SESSION['USUARIONOMBRE']=$usuariobyDNI->Nombre;
        $_SESSION['USUARIOAPELLIDOPATERNO']=$usuariobyDNI->Apellidopaterno;
        $_SESSION['USUARIOAPELLIDOMATERNO']=$usuariobyDNI->Apellidomaterno;
        $_SESSION['USUARIOFECHANACIMIENTO']=$usuariobyDNI->Fechanacimiento;
        $_SESSION['USUARIOSEXO']=$usuariobyDNI->Sexo;
        $_SESSION['USUARIODEPARTAMENTO']=$usuariobyDNI->Departamento;
        $_SESSION['USUARIOPROVINCIA']=$usuariobyDNI->Provincia;
        $_SESSION['USUARIODISTRITO']=$usuariobyDNI->Distrito;
        $_SESSION['USUARIODIRECCION']=$usuariobyDNI->Direccion;
        $_SESSION['USUARIOTELEFONO']=$usuariobyDNI->Telefono;
        $_SESSION['USUARIOCORREO']=$usuariobyDNI->Correo;
        $_SESSION['USUARIOCONTRASEÑA']=$usuariobyDNI->Contraseña;
        header("Location:usuario.php");
        break;  
    case "Eliminar":
        $usuario=Usuario::getByDNI($txtDNI);
           
        $usuario->delete();
        header("Location:usuarios.php");
        break;
    case "Ver":
        header("Location:usuario.php");
        break;
    case "Cerrar":
        header("Location:cerrar.php");
        break; 
}

?>


<div class="col-md-3">
<br>
<i class="fa-solid fa-user-tie" style="font-size:100px;position:relative;left:50px;"></i><br><br><?php echo $_SESSION['nombreUsuario'];?><br><br><br>
<form method="POST" enctype="multipart/form-data">

<i class="fa-solid fa-cart-flatbed" style="font-size:25px"></i><button type="submit" style="width:35%;background-color:white;color:black;border:none" name="accion" value="Entradas" class="btn btn-success">ENTRADAS</button><br><br>
<i class="fa-solid fa-truck-ramp-box" style="font-size:25px"></i><button type="submit" style="width:35%;background-color:white;color:black;border:none" name="accion" value="Salidas" class="btn btn-success">SALIDAS</button><br><br>
<i class="fa-solid fa-box-archive" style="font-size:25px"></i><button type="submit" style="width:35%;background-color:white;color:black;border:none" name="accion" value="Productos" class="btn btn-success">PRODUCTOS</button><br><br>
<i class="fa-solid fa-user-group" style="font-size:25px"></i><button type="submit" style="width:35%;background-color:white;color:black;border:none" name="accion" value="Clientes" class="btn btn-success">CLIENTES</button><br><br>
<i class="fa-solid fa-users" style="font-size:25px"></i><button type="submit" style="width:35%;background-color:white;color:black;border:none" name="accion" value="Usuarios" class="btn btn-success">USUARIOS</button><br><br>
<i class="fa-solid fa-truck" style="font-size:25px"></i><button type="submit" style="width:35%;background-color:white;color:black;border:none" name="accion" value="Proveedores" class="btn btn-success">PROVEEDORES</button><br><br>
<i class="fa-solid fa-warehouse" style="font-size:25px"></i></i><button type="submit" style="width:35%;background-color:white;color:black;border:none" name="accion" value="Inventario" class="btn btn-success">INVENTARIO</button>
</form>   
</div>    

<div class="col-md-7">
        <div>  

  
<form method="POST" enctype="multipart/form-data">
<img src="../img/inventory.jpg" style="height:70px"><div style="position:relative;left:700px;"><button type="submit" style="background-color:white;color:black;border:none" name="accion" value="Cerrar" class="btn btn-success">CERRAR SESION</button>  <i class="fa-solid fa-right-from-bracket" style="font-size:35px;"></i></div>
    <label for="txtBuscar">Buscar por:</label>
    <select name="select" id="select">
      <option value="DNI">DNI</option>
      <option value="NOMBRE">NOMBRE</option>
      <option value="SEXO">SEXO</option>
      <option value="DEPARTAMENTO">DEPARTAMENTO</option>
      <option value="PROVINCIA">PROVINCIA</option>
      <option value="DISTRITO">DISTRITO</option>
      <option value="TELEFONO">TELEFONO</option>
      <option value="CORREO">CORREO</option>
    </select>
    <input type="text" class="form-control" value="<?php echo $txtSearch;?>" name="txtSearch" id="txtSearch"><br>
    <button type="submit" style="width:20%;background-color:black" name="accion" value="Buscar" class="btn btn-success">Buscar</button><br><br>
</form>
</div>
    <table class="table">
        <thead>
            <tr>
                <th>DNI</th>
                <th>Nombres y apellidos</th>
                <th>Telefono</th>
                <th>Correo</th>
                <th>Distrito</th>
                <th>Direccion</th>
                
            </tr>
        </thead>
        <tbody>
        <?php
            $newarreglo=$_SESSION['ARREGLO'];
            ?>
        <?php if(($_SESSION['OPCION']=="DNI"||$_SESSION['OPCION']=="NOMBRE"||$_SESSION['OPCION']=="SEXO"||$_SESSION['OPCION']=="DEPARTAMENTO"||$_SESSION['OPCION']=="PROVINCIA"||$_SESSION['OPCION']=="DISTRITO"||$_SESSION['OPCION']=="TELEFONO"||$_SESSION['OPCION']=="CORREO")&&$newarreglo!=[]){
            for ($i=0;$i<count($newarreglo);$i++) { 
                $usuario=Usuario::getByDNI($newarreglo[$i]);
                ?>
            <tr>
                <td><?php echo $usuario->DNI;?></td>
                <td><?php echo $usuario->Nombre." ".$usuario->Apellidopaterno." ".$usuario->Apellidomaterno;?></td>
                <td><?php echo $usuario->Telefono;?></td>
                <td><?php echo $usuario->Correo;?></td>
                <td><?php echo $usuario->Distrito;?></td>
                <td><?php echo $usuario->Direccion;?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="txtDNI" id="txtDNI" value="<?php echo $usuario->DNI;?>"/>
                        <button type="submit" name="accion" value="Editar"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button type="submit" name="accion" value="Eliminar"><i class="fa-solid fa-trash-can"></i></button>
                        <button type="submit" name="accion" value="Ver"><i class="fa-solid fa-eye"></i></button>
                    </form>
                </td>
            </tr>
           <?php } } else { ?>
           <?php $usuarios=Usuario::all();
            foreach($usuarios as $usuario) { 
                ?>
            <tr>
                <td><?php echo $usuario->DNI;?></td>
                <td><?php echo $usuario->Nombre." ".$usuario->Apellidopaterno." ".$usuario->Apellidomaterno;?></td>
                <td><?php echo $usuario->Telefono;?></td>
                <td><?php echo $usuario->Correo;?></td>
                <td><?php echo $usuario->Distrito;?></td>
                <td><?php echo $usuario->Direccion;?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="txtDNI" id="txtDNI" value="<?php echo $usuario->DNI;?>"/>
                        <button type="submit" name="accion" value="Editar"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button type="submit" name="accion" value="Eliminar"><i class="fa-solid fa-trash-can"></i></button>
                        <button type="submit" name="accion" value="Ver"><i class="fa-solid fa-eye"></i></button>
                    </form>
                </td>
            </tr>
           <?php } } ?>
        </tbody>
        
    </table>
    <form method="post">
            <button type="submit" style="width:20%;background-color:black" name="accion" value="Agregar" class="btn btn-success">Añadir</button><br><br>
        </form>
    <?php
    $_SESSION['OPCION']="";
    $_SESSION['ARREGLO']="";
    ?>   
</div>
<?php include("../templateloginadministrador/pie.php");?>