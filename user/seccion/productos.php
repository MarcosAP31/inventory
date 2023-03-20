<?php include("../templateloginadministrador/cabecera.php");?>
<?php include("../clases/Producto.php");?>
<?php include("../clases/Proveedor.php");

if(!isset($_SESSION['ARREGLO'])){
    $_SESSION['ARREGLO']="";
}
if(!isset($_SESSION['OPCION'])){
    $_SESSION['OPCION']="";
}
$txtCode=(isset($_POST['txtCode']))?$_POST['txtCode']:"";
$txtSearch=(isset($_POST['txtSearch']))?$_POST['txtSearch']:"";
$Eleccion=(isset($_POST['select']))?$_POST['select']:$_SESSION['OPCION'];
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
$_SESSION['CODIGO']="";
        $_SESSION['DESCRIPCION']="";
        $_SESSION['CATEGORIA']="";
        $_SESSION['CANTIDAD']="";
        $_SESSION['PRECIOCOMPRA']="";
        $_SESSION['PRECIOVENTA']="";
        $_SESSION['PROVEEDORRUC']="";
$productos=Producto::all();
$proveedores=Proveedor::all();
$arreglo=[];



switch($accion){
    case "Buscar":
        
        if($txtSearch!=""){
           

        
        if($Eleccion=="CODIGO"){
            foreach($productos as $producto){
                if(strpos($producto->Codigo,$txtSearch)!==false){
                    array_push($arreglo,$producto->Codigo);
                }
                
            }
            $_SESSION['OPCION']='CODIGO';
            $_SESSION['ARREGLO']=$arreglo;
        }
        if($Eleccion=="CATEGORIA"){
            foreach($productos as $producto){
                if(strpos($producto->Categoria,$txtSearch)!==false){
                    $productosbycategoria=Producto::getByCategory($producto->Categoria);
                    foreach($productosbycategoria as $producto){
                        if(!in_array($producto->Codigo,$arreglo)){
                            array_push($arreglo,$producto->Codigo);
                       }
                        
                    }
                    
                }
            }
            $_SESSION['OPCION']="CATEGORIA";
            $_SESSION['ARREGLO']=$arreglo;
        }
        if($Eleccion=="PRECIO DE COMPRA"){
            foreach($productos as $producto){
                if(strpos($producto->Preciocompra,$txtSearch)!==false){
                    $productosbycompra=Producto::getByPurchase($producto->Preciocompra);
                    foreach($productosbycompra as $producto){
                        if(!in_array($producto->Codigo,$arreglo)){
                            array_push($arreglo,$producto->Codigo);
                       }
                        
                    }
                    
                }
            }
            
            $_SESSION['OPCION']="PRECIO DE COMPRA";
            $_SESSION['ARREGLO']=$arreglo;
        }
        if($Eleccion=="PRECIO DE VENTA"){
            foreach($productos as $producto){
                if(strpos($producto->Precioventa,$txtSearch)!==false){
                    $productosbyventa=Producto::getBySale($producto->Precioventa);
                    foreach($productosbyventa as $producto){
                        if(!in_array($producto->Codigo,$arreglo)){
                            array_push($arreglo,$producto->Codigo);
                       }
                    }
                    
                }
            }
            
            $_SESSION['OPCION']="PRECIO DE VENTA";
            $_SESSION['ARREGLO']=$arreglo;
        }
        if($Eleccion=="NOMBRE DE PROVEEDOR"){
            foreach($proveedores as $proveedor){
                if(strpos($proveedor->RazonSocial,$txtSearch)!==false){
                    $productosbyruc=Producto::getByProveedor($proveedor->RUC);
                    foreach($productosbyruc as $producto){
                        if(!in_array($producto->Codigo,$arreglo)){
                            array_push($arreglo,$producto->Codigo);
                       }
                    }
                    
                } 
            }
            $_SESSION['OPCION']="NOMBRE DE PROVEEDOR";
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
        header("Location:producto.php");
        break;
    case "Editar":
        $productobycode=Producto::getByCode($txtCode);
        $_SESSION['CODIGO']=$productobycode->Codigo;
        $_SESSION['DESCRIPCION']=$productobycode->Descripcion;
        $_SESSION['CATEGORIA']=$productobycode->Categoria;
        $_SESSION['CANTIDAD']=$productobycode->Cantidad;
        $_SESSION['PRECIOCOMPRA']=$productobycode->Preciocompra;
        $_SESSION['PRECIOVENTA']=$productobycode->Precioventa;
        $_SESSION['PROVEEDORRUC']=$productobycode->RUC;
       
        header("Location:producto.php");
        break;
    case "Eliminar":
        $producto=Producto::getByCode($txtCode);
           
        $producto->delete();
        header("Location:productos.php");
        break;
    case "Ver":
        header("Location:producto.php");
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
      <option value="CODIGO">CODIGO</option>
      <option value="CATEGORIA">CATEGORIA</option>
      <option value="PRECIO DE COMPRA">PRECIO DE COMPRA</option>
      <option value="PRECIO DE VENTA">PRECIO DE VENTA</option>
      <option value="NOMBRE DE PROVEEDOR">NOMBRE DE PROVEEDOR</option>
    </select>
    <input type="text" class="form-control" value="<?php echo $txtSearch;?>" name="txtSearch" id="txtSearch"><br>
    <button type="submit" style="width:20%;background-color:black" name="accion" value="Buscar" class="btn btn-success">Buscar</button><br><br>
</form>
</div>
    <table class="table">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Descripcion</th>
                <th>Categoria</th>
                <th>Cantidad</th>
                <th>Precio Compra</th>
                <th>Precio Venta</th>
                <th>Proveedor</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $newarreglo=$_SESSION['ARREGLO'];
            ?>
        <?php if(($_SESSION['OPCION']=="CODIGO"||$_SESSION['OPCION']=="DESCRIPCION"||$_SESSION['OPCION']=="CATEGORIA"||$_SESSION['OPCION']=="PRECIO DE COMPRA"||$_SESSION['OPCION']=="PRECIO DE VENTA"||$_SESSION['OPCION']=="NOMBRE DE PROVEEDOR")&&$newarreglo!=[]){
            for ($i=0;$i<count($newarreglo);$i++) { 
                $producto=Producto::getByCode($newarreglo[$i]);
                $proveedor=Proveedor::getByRUC($producto->RUC);
                ?>
            <tr>
                <td><?php echo $producto->Codigo;?></td>
                <td><?php echo $producto->Descripcion;?></td>
                <td><?php echo $producto->Categoria;?></td>
                <td><?php echo $producto->Cantidad;?></td>
                <td><?php echo $producto->Preciocompra;?></td>
                <td><?php echo $producto->Precioventa;?></td>
                <td><?php echo $proveedor->RazonSocial;?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="txtCode" id="txtCode" value="<?php echo $producto->Codigo;?>"/>
                        <button type="submit" name="accion" value="Editar"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button type="submit" name="accion" value="Eliminar"><i class="fa-solid fa-trash-can"></i></button>
                        <button type="submit" name="accion" value="Ver"><i class="fa-solid fa-eye"></i></button>
                    </form>
                </td>
            </tr>
           <?php } } else { ?>
           <?php $productos=Producto::all();
            foreach($productos as $producto) { 
                $proveedor=Proveedor::getByRUC($producto->RUC);
                ?>
            <tr>
                <td><?php echo $producto->Codigo;?></td>
                <td><?php echo $producto->Descripcion;?></td>
                <td><?php echo $producto->Categoria;?></td>
                <td><?php echo $producto->Cantidad;?></td>
                <td><?php echo $producto->Preciocompra;?></td>
                <td><?php echo $producto->Precioventa;?></td>
                <td><?php echo $proveedor->RazonSocial;?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="txtCode" id="txtCode" value="<?php echo $producto->Codigo;?>"/>
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