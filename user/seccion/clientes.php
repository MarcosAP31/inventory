<?php include("../templateloginadministrador/cabecera.php");?>
<?php include("../clases/Cliente.php");

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
$_SESSION['EDITARDNICLIENTE']="";
$_SESSION['CLIENTEDNI']="";
        $_SESSION['CLIENTENOMBRE']="";
        $_SESSION['CLIENTEAPELLIDOPATERNO']="";
        $_SESSION['CLIENTEAPELLIDOMATERNO']="";
        $_SESSION['CLIENTEFECHANACIMIENTO']="";
        $_SESSION['CLIENTESEXO']="";
        $_SESSION['CLIENTEDEPARTAMENTO']="";
        $_SESSION['CLIENTEPROVINCIA']="";
        $_SESSION['CLIENTEDISTRITO']="";
        $_SESSION['CLIENTEDIRECCION']="";
        $_SESSION['CLIENTETELEFONO']="";
        $_SESSION['CLIENTECORREO']="";
$clientes=Cliente::all();
$arreglo=[];        
switch($accion){
    case "Buscar":
        
        if($txtSearch!=""){
            
        if($Eleccion=="DNI"){
            foreach($clientes as $cliente){
                if(strpos($cliente->DNI,$txtSearch)!==false){
                    
                    array_push($arreglo,$cliente->DNI);
                }
                
            }
            $_SESSION['OPCION']='DNI';
            $_SESSION['ARREGLO']=$arreglo;
        }
        if($Eleccion=="NOMBRE"){
            foreach($clientes as $cliente){
                if(strpos($cliente->Nombre,$txtSearch)!==false){
                    array_push($arreglo,$cliente->DNI);
                }
                
            }
           
            $_SESSION['OPCION']="NOMBRE";
            $_SESSION['ARREGLO']=$arreglo;
        }
        if($Eleccion=="SEXO"){
            foreach($clientes as $cliente){
                if(strpos($cliente->Sexo,$txtSearch)!==false){
                    $clientesbysexo=Cliente::getBySexo($cliente->Sexo);
                    foreach($clientesbysexo as $cliente){
                       if(!in_array($cliente->DNI,$arreglo)){
                            array_push($arreglo,$cliente->DNI);
                       }
                        
                    }
                   
                }
            }
        
            $_SESSION['OPCION']="SEXO";
            $_SESSION['ARREGLO']=$arreglo;
        }
        if($Eleccion=="DEPARTAMENTO"){
            
            foreach($clientes as $cliente){
                if(strpos($cliente->Departamento,$txtSearch)!==false){
                    $clientesbydepartamento=Cliente::getByDepartamento($cliente->Departamento);
                    foreach($clientesbydepartamento as $cliente){
                        if(!in_array($cliente->DNI,$arreglo)){
                            array_push($arreglo,$cliente->DNI);
                       }
                        
                    }
                    
                }
            }
            $_SESSION['OPCION']="DEPARTAMENTO";
            $_SESSION['ARREGLO']=$arreglo;
        }
        if($Eleccion=="PROVINCIA"){
            foreach($clientes as $cliente){
                if(strpos($cliente->Provincia,$txtSearch)!==false){
                    $clientesbyprovincia=Cliente::getByProvincia($cliente->Provincia);
                    foreach($clientesbyprovincia as $cliente){
                        if(!in_array($cliente->DNI,$arreglo)){
                            array_push($arreglo,$cliente->DNI);
                       }
                       
                    }
                    
                }
            }
            $_SESSION['OPCION']="PROVINCIA";
            $_SESSION['ARREGLO']=$arreglo;
        }
        if($Eleccion=="DISTRITO"){
            foreach($clientes as $cliente){
                if(strpos($cliente->Distrito,$txtSearch)!==false){
                    $clientesbydistrito=Cliente::getByDistrito($cliente->Distrito);
                    foreach($clientesbydistrito as $cliente){
                        if(!in_array($cliente->DNI,$arreglo)){
                            array_push($arreglo,$cliente->DNI);
                       }
                        
                    }
                    
                }
            }
            $_SESSION['OPCION']="DISTRITO";
            $_SESSION['ARREGLO']=$arreglo;
        }
        if($Eleccion=="TELEFONO"){
            foreach($clientes as $cliente){
                if(strpos($cliente->Telefono,$txtSearch)!==false){
                    array_push($arreglo,$cliente->DNI);
                    
                } 
            }
            $_SESSION['OPCION']="TELEFONO";
            $_SESSION['ARREGLO']=$arreglo;
        }
        if($Eleccion=="CORREO"){
            foreach($clientes as $cliente){
                if(strpos($usuario->Correo,$txtSearch)!==false){
                    array_push($arreglo,$cliente->DNI);
                    
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
        header("Location:cliente.php");
        break;
    case "Editar":
        $clientebydni=Cliente::getByDNI($txtDNI);
        $_SESSION['CLIENTEDNI']=$clientebydni->DNI;
        $_SESSION['CLIENTENOMBRE']=$clientebydni->Nombre;
        $_SESSION['CLIENTEAPELLIDOPATERNO']=$clientebydni->Apellidopaterno;
        $_SESSION['CLIENTEAPELLIDOMATERNO']=$clientebydni->Apellidomaterno;
        $_SESSION['CLIENTEFECHANACIMIENTO']=$clientebydni->Fechanacimiento;
        $_SESSION['CLIENTESEXO']=$clientebydni->Sexo;
        $_SESSION['CLIENTEDEPARTAMENTO']=$clientebydni->Departamento;
        $_SESSION['CLIENTEPROVINCIA']=$clientebydni->Provincia;
        $_SESSION['CLIENTEDISTRITO']=$clientebydni->Distrito;
        $_SESSION['CLIENTEDIRECCION']=$clientebydni->Direccion;
        $_SESSION['CLIENTETELEFONO']=$clientebydni->Telefono;
        $_SESSION['CLIENTECORREO']=$clientebydni->Correo;
        
        header("Location:cliente.php");
        break;  
    case "Eliminar":
        $cliente=Cliente::getByDNI($txtDNI);
           
        $cliente->delete();
        header("Location:clientes.php");
        break;
    case "Ver":
        header("Location:cliente.php");
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
<img src="../img/inventory.jpg" style="height:70px"><div style="position:relative;left:700px;"><button type="submit" style="background-color:white;color:black;border:none" name="accion" value="Cerrar" class="btn btn-success">CERRAR SESION</button>  <i class="fa-solid fa-right-from-bracket" style="font-size:35px;"></i></div>
<div>   
<form method="POST" enctype="multipart/form-data">
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
                <th>Nombres y Apellidos</th>
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
                $cliente=Cliente::getByDNI($newarreglo[$i]);
                ?>
            <tr>
                <td><?php echo $cliente->DNI;?></td>
                <td><?php echo $cliente->Nombre." ".$cliente->Apellidopaterno." ".$cliente->Apellidomaterno;?></td>
                <td><?php echo $cliente->Telefono;?></td>
                <td><?php echo $cliente->Correo;?></td>
                <td><?php echo $cliente->Distrito;?></td>
                <td><?php echo $cliente->Direccion;?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="txtDNI" id="txtDNI" value="<?php echo $cliente->DNI;?>"/>
                        <button type="submit" name="accion" value="Editar"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button type="submit" name="accion" value="Eliminar"><i class="fa-solid fa-trash-can"></i></button>
                        <button type="submit" name="accion" value="Ver"><i class="fa-solid fa-eye"></i></button>
                    </form>
                </td>
            </tr>
           <?php } } else { ?>
           <?php $clientes=Cliente::all();
            foreach($clientes as $cliente) { 
                ?>
            <tr>
                <td><?php echo $cliente->DNI;?></td>
                <td><?php echo $cliente->Nombre." ".$cliente->Apellidopaterno." ".$cliente->Apellidomaterno;?></td>
                <td><?php echo $cliente->Telefono;?></td>
                <td><?php echo $cliente->Correo;?></td>
                <td><?php echo $cliente->Distrito;?></td>
                <td><?php echo $cliente->Direccion;?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="txtDNI" id="txtDNI" value="<?php echo $cliente->DNI;?>"/>
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