<?php include("../templateloginadministrador/cabecera.php");?>
<?php include("../clases/Producto.php");?>
<?php include("../clases/Cliente.php");?>
<?php include("../clases/Usuario.php");?>
<?php include("../clases/Proveedor.php");?>
<?php include("../clases/Salida.php");

$txtSalidaId=(isset($_POST['txtSalidaId']))?$_POST['txtSalidaId']:"";
$txtDate=(isset($_POST['txtDate']))?$_POST['txtDate']:"";
$txtDNICliente=(isset($_POST['txtDNICliente']))?$_POST['txtDNICliente']:"";
$txtCode=(isset($_POST['txtCode']))?$_POST['txtCode']:"";
$txtSearch=(isset($_POST['txtSearch']))?$_POST['txtSearch']:"";
$Eleccion=(isset($_POST['select']))?$_POST['select']:$_SESSION['OPCION'];
$txtAmount=(isset($_POST['txtAmount']))?$_POST['txtAmount']:"";
$txtInicio=(isset($_POST['txtInicio']))?$_POST['txtInicio']:"";
$txtFin=(isset($_POST['txtFin']))?$_POST['txtFin']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
$salidas=Salida::all();
$arreglo=[];
switch($accion){
    case "Buscar":
        if($txtSearch!=""){
           

        
            if($Eleccion=="CODIGO"){
                foreach($salidas as $salida){
                    $producto=Producto::getByCode($salida->Codigo);
                    if($producto!=null){
                        if(strpos($salida->Codigo,$txtSearch)!==false){
                            array_push($arreglo,$salida->SalidaId);
                        }
                    }
                    
                }
                $_SESSION['OPCION']='CODIGO';
                $_SESSION['ARREGLO']=$arreglo;
            }
            if($Eleccion=="CATEGORIA"){
                foreach($salidas as $salida){
                    $producto=Producto::getByCode($salida->Codigo);
                    if($producto!=null){
                        if(strpos($producto->Categoria,$txtSearch)!==false){
                           
                                    array_push($arreglo,$salida->SalidaId);
                               

                            }

                    }
                }
                
                $_SESSION['OPCION']="CATEGORIA";
                $_SESSION['ARREGLO']=$arreglo;
            }
            if($Eleccion=="PRECIO DE COMPRA"){
                foreach($salidas as $salida){
                    $producto=Producto::getByCode($salida->Codigo);
                    if($producto!=null){
                        if(strpos($salida->Preciocompra,$txtSearch)!==false){
                            
                                    array_push($arreglo,$salida->SalidaId);
                               

                        }

                    }
                }
                
                
                $_SESSION['OPCION']="PRECIO DE COMPRA";
                $_SESSION['ARREGLO']=$arreglo;
            }
            if($Eleccion=="PRECIO DE VENTA"){
                foreach($salidas as $salida){
                    $producto=Producto::getByCode($salida->Codigo);
                    if($producto!=null){
                        if(strpos($salida->Precioventa,$txtSearch)!==false){
                            
                                    array_push($arreglo,$salida->SalidaId);
                               

                        }

                    }
                }
                
                $_SESSION['OPCION']="PRECIO DE VENTA";
                $_SESSION['ARREGLO']=$arreglo;
            }
            
            if($Eleccion=="NOMBRE DE PROVEEDOR"){
                foreach($salidas as $salida){
                    $producto=Producto::getByCode($salida->Codigo);
                    if($producto!=null){
                        $proveedor=Proveedor::getByRUC($producto->RUC);
                        if(strpos($proveedor->RazonSocial,$txtSearch)!==false){
                            
                                
                                array_push($arreglo,$salida->SalidaId);
                                
                            

                        } 
                    }
                }
                $_SESSION['OPCION']="NOMBRE DE PROVEEDOR";
                $_SESSION['ARREGLO']=$arreglo;
            }
            if($Eleccion=="FECHA"){
                if($txtInicio!=""&&$txtFin!=""){
                    $arraydateinicio = explode("-", $txtInicio);
                    $arraydatefin = explode("-", $txtFin);
                    foreach($entradas as $entrada){
                        $arraydate = explode("-", $entrada->Fecha);
                        if($arraydate[0]>=$arraydateinicio[2]&&$arraydate[0]<=$arraydatefin[2]&&$arraydate[1]==$arraydateinicio[1]&&$arraydate[1]==$arraydatefin[1]&&$arraydate[2]>=$arraydateinicio[0]&&$arraydate[2]<=$arraydatefin[0]){
                            array_push($arreglo,$entrada->EntradaId);
                        }
                    }
                    $_SESSION['OPCION']="BUSCAR";
                    $_SESSION['ARREGLO']=$arreglo;
                    if($arreglo==[]){
                        ?>
                        <div class="alert alert-danger" role="alert" style="font-size:15px;position:fixed;z-index:1;margin-left:37%">
                             No se encontraron entradas de productos en ese intervalo de tiempo.
                        </div>
                    <?php
                    }
                }else{
                    ?>
                            <div class="alert alert-danger" role="alert" style="font-size:15px;position:fixed;z-index:1;margin-left:37%">
                                 Por favor ingrese fecha de inicio y fin para filtrar la búsqueda.
                            </div>
                        <?php
                }
            }
        }
            
        break;
    case "Cancelar":
        header("Location:salidas.php");
        break;
    case "Limpiar":
        header("Location:salidas.php");
        break;
    case "Guardar":
        
            $product=Producto::getByCode($txtCode);
            $client=Cliente::getByDNI($txtDNICliente);
            if($product!=null&&$client!=null){
                if($txtAmount>$product->Cantidad){
                    ?>
                     <div class="alert alert-danger" role="alert" style="width:30%;margin:auto">
                          La cantidad ingresada excede al total de productos en el stock.
                     </div>
                <?php }
                else{
                $salida=new Salida();
                $Object = new DateTime();  
                $Object->setTimezone(new DateTimeZone('America/Lima'));
                $Dateandtime = $Object->format("d-m-Y h:i:s a");  
                $salida->Fecha=$Dateandtime;
                $salida->Codigo=$txtCode;
                $salida->Cantidad=$txtAmount;
                $salida->DNICliente=$txtDNICliente;
                
                if($_SESSION['USUARIO']=="admin"){
                    $salida->DNIUsuario=98765432;
                }else{
                    $usuario=Usuario::getByCorreo($_SESSION['USUARIO']);
                    $salida->DNIUsuario=$usuario->DNI;
                }
                $salida->create();
                $product->Cantidad=$product->Cantidad-$txtAmount;
                $product->update();
                header("Location:salidas.php");
                }
            }else{
                ?>
             <div class="alert alert-danger" role="alert" style="width:30%;margin:auto">
                  El código de producto o DNI de cliente son incorrectos
            </div>
        <?php }
    
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
        header("Location:producto.php");
        break;
    case "Eliminar":
        $salida=Salida::getById($txtSalidaId);
           
        $salida->delete();
        header("Location:salidas.php");
        break;
    case "Cerrar":
        header("Location:cerrar.php");
        break;  
}
$preciototal=0;
$salidas=Salida::all();
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
<div class="col-md-5">
<div>   
<form method="POST" enctype="multipart/form-data">
<img src="../img/inventory.jpg" style="height:70px"><div style="position:relative;left:700px;"><button type="submit" style="background-color:white;color:black;border:none" name="accion" value="Cerrar" class="btn btn-success">CERRAR SESION</button>  <i class="fa-solid fa-right-from-bracket" style="font-size:35px;"></i></div>
    <label for="txtBuscar">Buscar por:</label>
    <select name="select" id="select">
      <option value="CODIGO">CODIGO</option>
      <option value="CATEGORIA">CATEGORIA</option>
      <option value="PRECIO DE COMPRA">PRECIO DE COMPRA</option>
      <option value="PRECIO DE VENTA">PRECIO DE VENTA</option>
      <option value="NOMBRE DE PROVEEDOR">NOMBRE DE PROVEEDOR</option>
      <option value="NOMBRE DE PROVEEDOR">FECHA</option>
    </select>
    </select>
    <input type="text" class="form-control" value="<?php echo $txtSearch;?>" name="txtSearch" id="txtSearch"><br>
    <div style="display:flex">
    <label for="txtInicio">FECHA INICIO:</label>
    <input type="date" style="height:30px;"  class="form-control" value="<?php echo $txtInicio;?>" name="txtInicio" id="txtInicio"><br>
    </div>
    <div  style="margin-left:20px;display:flex">
    <label for="txtInicio">FECHA FIN:</label>
    <input type="date"  style="height:30px;" class="form-control" value="<?php echo $txtFin;?>" name="txtFin" id="txtFin"><br>
    </div>
    <button type="submit" style="width:20%;background-color:black" name="accion" value="Buscar" class="btn btn-success">Buscar</button><br><br>
</form>
</div>
<div class="card">
    <div class="card-header">
        Salidas
    </div>

    <div class="card-body">
    <form method="POST" enctype="multipart/form-data">

    <div class = "form-group" style="display:flex">
    <label for="txtDNICliente">DNI de cliente:</label><input style="width:50%" type="text" class="form-control" value="<?php echo $txtDNICliente;?>" name="txtDNICliente" id="txtDNICliente" placeholder="DNI de cliente">
    
    </div>

    <div class = "form-group" style="display:flex">
    <label for="txtCode">Código de producto:</label><input style="width:50%" type="text" class="form-control" value="<?php echo $txtCode;?>" name="txtCode" id="txtCode" placeholder="Código de producto">
    
    </div>

    <div>

    <div class = "form-group" style="display:flex">
    <label for="txtAmount">Cantidad:</label><input style="width:50%" type="text" class="form-control" value="<?php echo $txtAmount;?>" name="txtAmount" id="txtAmount" placeholder="Cantidad">
    
    </div>


    <div class="btn-group" role="group" aria-label="">
        <button style="color:white;background-color:black" type="submit" name="accion" value="Cancelar">Cancelar</button>
        <button style="color:white;background-color:black" type="submit" name="accion" value="Limpiar">Limpiar</button>
        <button style="color:white;background-color:black" type="submit" name="accion" value="Guardar">Guardar</button>
    </div>
    </form>
    </div>
    
</div>    
</div>
<div class="col-md-7">

    <table class="table">
        <thead>
            <tr>
                <th>CLIENTE</th>
                <th>CODIGO DE PRODUCTO</th>
                <th>DESCRIPCION DE PRODUCTO</th>
                <th>CATEGORIA</th>
                <th>PRECIO VENTA</th>
                <th>CANTIDAD</th>
                <th>SUBTOTAL</th>
                
            </tr>
        </thead>
        <tbody>
        <?php foreach ($salidas as $salida) { 
            $cliente=Cliente::getByDNI($salida->DNICliente);
            $producto=Producto::getByCode($salida->Codigo);
            $proveedor=Proveedor::getByRUC($producto->RUC);
            ?>
            <tr>
                <td><?php echo $cliente->Nombre." ".$cliente->Apellidopaterno;?></td>
                <td><?php echo $producto->Codigo;?></td>
                <td><?php echo $producto->Descripcion;?></td>
                <td><?php echo $producto->Categoria;?></td>
                <td>S/.<?php echo $producto->Precioventa;?></td>
                <td><?php echo $salida->Cantidad;?></td>
                <td>S/.<?php echo $producto->Cantidad*$producto->Precioventa;?></td>
                <?php $preciototal=$preciototal+($producto->Cantidad*$producto->Precioventa)?>
                <td>
                    <form method="post">
                            <input type="hidden" name="txtSalidaId" id="txtSalidaId" value="<?php echo $salida->SalidaId;?>"/>
                            <button type="submit" name="accion" value="Eliminar"><i class="fa-solid fa-trash-can"></i></button>
                    </form>
                </td>
            </tr>
           <?php } ?>
           
        </tbody>
        
    </table>
    <div style="position:relative;text-align:right;left:465px">S/.<?php echo $preciototal?></div>
</div>

<?php include("../templateloginadministrador/pie.php");?>
