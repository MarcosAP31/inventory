<?php include("../templateloginadministrador/cabecera.php");?>
<?php include("../clases/Producto.php");?>
<?php include("../clases/Proveedor.php");?>
<?php include("../clases/Entrada.php");
if(!isset($_SESSION['ARREGLO'])){
    $_SESSION['ARREGLO']="";
}
if(!isset($_SESSION['OPCION'])){
    $_SESSION['OPCION']="";
}
$txtCode=(isset($_POST['txtCode']))?$_POST['txtCode']:"";
$txtSearch=(isset($_POST['txtSearch']))?$_POST['txtSearch']:"";
$txtInicio=(isset($_POST['txtInicio']))?$_POST['txtInicio']:"";
$txtFin=(isset($_POST['txtFin']))?$_POST['txtFin']:"";
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
$newarreglo=[];


switch($accion){
    case "Buscar":
        
        if($txtSearch!=""||($txtInicio!=""&&$txtFin!="")){
           

        
            if($txtSearch!=""&&$txtInicio!=""&&$txtFin!=""){
                $arraydateinicio = explode("-", $txtInicio);
            $arraydatefin = explode("-", $txtFin);
            foreach($entradas as $entrada){
                $arraydate = explode("-", $entrada->Fecha);
                if($arraydate[0]>=$arraydateinicio[2]&&$arraydate[0]<=$arraydatefin[2]&&$arraydate[1]==$arraydateinicio[1]&&$arraydate[1]==$arraydatefin[1]&&$arraydate[2]>=$arraydateinicio[0]&&$arraydate[2]<=$arraydatefin[0]){
                    array_push($arreglo,$entrada->Codigo);
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
        if($Eleccion=="CODIGO"){
            for($i=0;$i<count($productos);$i++){
                if(strpos($productos[$i]->Codigo,$txtSearch)!==false&&$productos[$i]->Codigo==$arreglo[$i]){
                    array_push($newarreglo,$productos[$i]->Codigo);
                }
                
            }
            $_SESSION['OPCION']='CODIGO';
            $_SESSION['ARREGLO']=$newarreglo;
        }
        if($Eleccion=="CATEGORIA"){
            for($i=0;$i<count($productos);$i++){
                if(strpos($productos[$i]->Categoria,$txtSearch)!==false&&$productos[$i]->Codigo==$arreglo[$i]){
                    $productosbycategoria=Producto::getByCategory($productos[$i]->Categoria);
                    foreach($productosbycategoria as $producto){
                        if(!in_array($producto->Codigo,$newarreglo)){
                            array_push($newarreglo,$producto->Codigo);
                       }
                        
                    }
                    
                }
            }
            $_SESSION['OPCION']="CATEGORIA";
            $_SESSION['ARREGLO']=$newarreglo;
        }
        if($Eleccion=="PRECIO DE COMPRA"){
            for($i=0;$i<count($productos);$i++){
                if(strpos($productos[$i]->Preciocompra,$txtSearch)!==false&&$productos[$i]->Codigo==$arreglo[$i]){
                    $productosbycompra=Producto::getByPurchase($productos[$i]->Preciocompra);
                    foreach($productosbycompra as $producto){
                        if(!in_array($producto->Codigo,$newarreglo)){
                            array_push($newarreglo,$producto->Codigo);
                       }
                        
                    }
                    
                }
            }
            
            $_SESSION['OPCION']="PRECIO DE COMPRA";
            $_SESSION['ARREGLO']=$newarreglo;
        }
        if($Eleccion=="PRECIO DE VENTA"){
            for($i=0;$i<count($productos);$i++){
                if(strpos($productos[$i]->Precioventa,$txtSearch)!==false&&$productos[$i]->Codigo==$arreglo[$i]){
                    $productosbyventa=Producto::getBySale($productos[$i]->Precioventa);
                    foreach($productosbyventa as $producto){
                        if(!in_array($producto->Codigo,$newarreglo)){
                            array_push($newarreglo,$producto->Codigo);
                       }
                    }
                    
                }
            }
            
            $_SESSION['OPCION']="PRECIO DE VENTA";
            $_SESSION['ARREGLO']=$newarreglo;
        }
        if($Eleccion=="NOMBRE DE PROVEEDOR"){
            foreach($proveedores as $proveedor){
                if(strpos($proveedor->RazonSocial,$txtSearch)!==false){
                    $productosbyruc=Producto::getByProveedor($proveedor->RUC);
                    foreach($productosbyruc as $producto){
                        if(!in_array($producto->Codigo,$newarreglo)){
                            array_push($newarreglo,$producto->Codigo);
                       }
                    }
                    
                } 
            }
            $_SESSION['OPCION']="NOMBRE DE PROVEEDOR";
            $_SESSION['ARREGLO']=$newarreglo;
        }
        }
        if($txtSearch!=""&&($txtInicio==""||$txtFin=="")){
            if($Eleccion=="CODIGO"){
                foreach($productos as $producto){
                    if(strpos($producto->Codigo,$txtSearch)!==false){
                        array_push($newarreglo,$producto->Codigo);
                    }
                    
                }
                $_SESSION['OPCION']='CODIGO';
                $_SESSION['ARREGLO']=$newarreglo;
            }
            if($Eleccion=="CATEGORIA"){
                foreach($productos as $producto){
                    if(strpos($producto->Categoria,$txtSearch)!==false){
                        $productosbycategoria=Producto::getByCategory($producto->Categoria);
                        foreach($productosbycategoria as $producto){
                            if(!in_array($producto->Codigo,$newarreglo)){
                                array_push($newarreglo,$producto->Codigo);
                           }
                            
                        }
                        
                    }
                }
                $_SESSION['OPCION']="CATEGORIA";
                $_SESSION['ARREGLO']=$newarreglo;
            }
            if($Eleccion=="PRECIO DE COMPRA"){
                foreach($productos as $producto){
                    if(strpos($producto->Preciocompra,$txtSearch)!==false){
                        $productosbycompra=Producto::getByPurchase($producto->Preciocompra);
                        foreach($productosbycompra as $producto){
                            if(!in_array($producto->Codigo,$newarreglo)){
                                array_push($newarreglo,$producto->Codigo);
                           }
                            
                        }
                        
                    }
                }
                
                $_SESSION['OPCION']="PRECIO DE COMPRA";
                $_SESSION['ARREGLO']=$newarreglo;
            }
            if($Eleccion=="PRECIO DE VENTA"){
                foreach($productos as $producto){
                    if(strpos($producto->Precioventa,$txtSearch)!==false){
                        $productosbyventa=Producto::getBySale($producto->Precioventa);
                        foreach($productosbyventa as $producto){
                            if(!in_array($producto->Codigo,$newarreglo)){
                                array_push($newarreglo,$producto->Codigo);
                           }
                        }
                        
                    }
                }
                
                $_SESSION['OPCION']="PRECIO DE VENTA";
                $_SESSION['ARREGLO']=$newarreglo;
            }
            if($Eleccion=="NOMBRE DE PROVEEDOR"){
                foreach($proveedores as $proveedor){
                    if(strpos($proveedor->RazonSocial,$txtSearch)!==false){
                        $productosbyruc=Producto::getByProveedor($proveedor->RUC);
                        foreach($productosbyruc as $producto){
                            if(!in_array($producto->Codigo,$newarreglo)){
                                array_push($newarreglo,$producto->Codigo);
                           }
                        }
                        
                    } 
                }
                $_SESSION['OPCION']="NOMBRE DE PROVEEDOR";
                $_SESSION['ARREGLO']=$newarreglo;
            }
        }
        }else{
            ?>
                <div class="alert alert-danger" role="alert" style="font-size:15px;position:fixed;z-index:1;margin-left:37%">
                     No se encontro lo que buscaba o no estableció fecha de inicio o fin para filtrar la búsqueda.
                </div>
            <?php
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
    <div style="display:flex;">
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
    <table class="table">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Descripcion</th>
                <th>Categoria</th>
                <th>Entradas</th>
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
                $entrada=Entrada::getByCode($producto->Codigo)
                ?>
            <tr>
                <td><?php echo $producto->Codigo;?></td>
                <td><?php echo $producto->Descripcion;?></td>
                <td><?php echo $producto->Categoria;?></td>
                <td><?php echo $entrada->Cantidad;?></td>
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