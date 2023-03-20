<?php include("../templateloginadministrador/cabecera.php");?>
<?php include("../clases/Proveedor.php");

$txtRUC=(isset($_POST['txtRUC']))?$_POST['txtRUC']:"";
$txtSearch=(isset($_POST['txtSearch']))?$_POST['txtSearch']:"";
$Eleccion=(isset($_POST['select']))?$_POST['select']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
if(!isset($_SESSION['ARREGLO'])){
    $_SESSION['ARREGLO']="";
}
if(!isset($_SESSION['OPCION'])){
    $_SESSION['OPCION']="";
}
$_SESSION['EDITARRUC']="";       
        $_SESSION['RUC']="";
        $_SESSION['RAZONSOCIAL']="";
        $_SESSION['NOMBRE']="";
        $_SESSION['TIPO']="";
        $_SESSION['DEPARTAMENTO']="";
        $_SESSION['PROVINCIA']="";
        $_SESSION['DISTRITO']="";
        $_SESSION['DIRECCION']="";
        $_SESSION['TELEFONO']="";
        $_SESSION['CORREO']="";
        
$proveedores=Proveedor::all();
$arreglo=[];

switch($accion){
    case "Buscar":
        
        if($txtSearch!=""){
            if($Eleccion=="RUC"){
                foreach($proveedores as $proveedor){
                    if(strpos($proveedor->RUC,$txtSearch)!==false){
                        
                        array_push($arreglo,$proveedor->RUC);
                    }
                    
                }
                $_SESSION['OPCION']='RUC';
                $_SESSION['ARREGLO']=$arreglo;
            }
            if($Eleccion=="RAZON SOCIAL"){
                foreach($proveedores as $proveedor){
                    if(strpos($proveedor->RazonSocial,$txtSearch)!==false){
                        array_push($arreglo,$proveedor->RUC);
                    }
                    
                }
               
                $_SESSION['OPCION']="RAZON SOCIAL";
                $_SESSION['ARREGLO']=$arreglo;
            }
            if($Eleccion=="NOMBRE COMERCIAL"){
                foreach($proveedores as $proveedor){
                    if(strpos($proveedor->Nombre,$txtSearch)!==false){
                        array_push($arreglo,$proveedor->RUC);
                    }
                    
                }
               
                $_SESSION['OPCION']="NOMBRE COMERCIAL";
                $_SESSION['ARREGLO']=$arreglo;
            }
           
            if($Eleccion=="DEPARTAMENTO"){
                
                foreach($proveedores as $proveedor){
                    if(strpos($proveedor->Departamento,$txtSearch)!==false){
                        $proveedoresbydepartamento=Proveedor::getByDepartamento($proveedor->Departamento);
                        foreach($proveedoresbydepartamento as $proveedor){
                            if(!in_array($proveedor->RUC,$arreglo)){
                                array_push($arreglo,$proveedor->RUC);
                           }
                            
                        }
                        
                    }
                }
                $_SESSION['OPCION']="DEPARTAMENTO";
                $_SESSION['ARREGLO']=$arreglo;
            }
            if($Eleccion=="PROVINCIA"){
                foreach($proveedores as $proveedor){
                    if(strpos($proveedor->Provincia,$txtSearch)!==false){
                        $proveedoresbyprovincia=Usuario::getByProvincia($proveedor->Provincia);
                        foreach($proveedoresbyprovincia as $proveedor){
                            if(!in_array($proveedor->RUC,$arreglo)){
                                array_push($arreglo,$proveedor->RUC);
                           }
                           
                        }
                        
                    }
                }
                $_SESSION['OPCION']="PROVINCIA";
                $_SESSION['ARREGLO']=$arreglo;
            }
            if($Eleccion=="DISTRITO"){
                foreach($proveedores as $proveedor){
                    if(strpos($proveedor->Distrito,$txtSearch)!==false){
                        $proveedoresbydistrito=Usuario::getByDistrito($proveedor->Distrito);
                        foreach($proveedoresbydistrito as $proveedor){
                            if(!in_array($proveedor->RUC,$arreglo)){
                                array_push($arreglo,$proveedor->RUC);
                           }
                            
                        }
                        
                    }
                }
                $_SESSION['OPCION']="DISTRITO";
                $_SESSION['ARREGLO']=$arreglo;
            }
            if($Eleccion=="TELEFONO"){
                foreach($proveedores as $proveedor){
                    if(strpos($proveedor->Telefono,$txtSearch)!==false){
                        array_push($arreglo,$proveedor->RUC);
                        
                    } 
                }
                $_SESSION['OPCION']="TELEFONO";
                $_SESSION['ARREGLO']=$arreglo;
            }
            if($Eleccion=="CORREO"){
                foreach($proveedores as $proveedor){
                    if(strpos($proveedor->Correo,$txtSearch)!==false){
                        array_push($arreglo,$proveedor->RUC);
                        
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
        header("Location:proveedor.php");
        break;
    case "Editar":
        $proveedorbyRUC=Proveedor::getByRUC($txtRUC);
        
        $_SESSION['RUC']=$proveedorbyRUC->RUC;
        $_SESSION['RAZONSOCIAL']=$proveedorbyRUC->RazonSocial;
        $_SESSION['NOMBRE']=$proveedorbyRUC->Nombre;
        $_SESSION['TIPO']=$proveedorbyRUC->Tipo;
        $_SESSION['DEPARTAMENTO']=$proveedorbyRUC->Departamento;
        $_SESSION['PROVINCIA']=$proveedorbyRUC->Provincia;
        $_SESSION['DISTRITO']=$proveedorbyRUC->Distrito;
        $_SESSION['DIRECCION']=$proveedorbyRUC->Direccion;
        $_SESSION['TELEFONO']=$proveedorbyRUC->Telefono;
        $_SESSION['CORREO']=$proveedorbyRUC->Correo;
        
        header("Location:proveedor.php");
        break;  
    case "Eliminar":
        $proveedor=Proveedor::getByRUC($txtRUC);
           
        $proveedor->delete();
        header("Location:proveedores.php");
        break;
    case "Ver":
        header("Location:proveedor.php");
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
      <option value="RUC">RUC</option>
      <option value="RAZON SOCIAL">RAZON SOCIAL</option>
      <option value="NOMBRE COMERCIAL">NOMBRE COMERCIAL</option>
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
                <th>RUC</th>
                <th>Razón Social</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Distrito</th>
                <th>Dirección</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $newarreglo=$_SESSION['ARREGLO'];
            ?>
        <?php if(($_SESSION['OPCION']=="RUC"||$_SESSION['OPCION']=="RAZON SOCIAL"||$_SESSION['OPCION']=="NOMBRE COMERCAL"||$_SESSION['OPCION']=="DEPARTAMENTO"||$_SESSION['OPCION']=="PROVINCIA"||$_SESSION['OPCION']=="DISTRITO"||$_SESSION['OPCION']=="TELEFONO"||$_SESSION['OPCION']=="CORREO")&&$newarreglo!=[]){
            for ($i=0;$i<count($newarreglo);$i++) { 
                $proveedor=Proveedor::getByRUC($newarreglo[$i]);
                ?>
            <tr>
                <td><?php echo $proveedor->RUC;?></td>
                <td><?php echo $proveedor->RazonSocial;?></td>
                <td><?php echo $proveedor->Telefono;?></td>
                <td><?php echo $proveedor->Correo;?></td>
                <td><?php echo $proveedor->Distrito;?></td>
                <td><?php echo $proveedor->Direccion;?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="txtRUC" id="txtRUC" value="<?php echo $proveedor->RUC;?>"/>
                        <button type="submit" name="accion" value="Editar"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button type="submit" name="accion" value="Eliminar"><i class="fa-solid fa-trash-can"></i></button>
                        <button type="submit" name="accion" value="Ver"><i class="fa-solid fa-eye"></i></button>
                    </form>
                </td>
            </tr>
           <?php } } else { ?>
           <?php $proveedores=Proveedor::all();
            foreach($proveedores as $proveedor) { 
                ?>
            <tr>
                <td><?php echo $proveedor->RUC;?></td>
                <td><?php echo $proveedor->RazonSocial;?></td>
                <td><?php echo $proveedor->Telefono;?></td>
                <td><?php echo $proveedor->Correo;?></td>
                <td><?php echo $proveedor->Distrito;?></td>
                <td><?php echo $proveedor->Direccion;?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="txtRUC" id="txtRUC" value="<?php echo $proveedor->RUC;?>"/>
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