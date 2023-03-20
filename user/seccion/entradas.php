<?php include("../templateloginadministrador/cabecera.php");?>
<?php include("../clases/Producto.php");?>
<?php include("../clases/Proveedor.php");?>
<?php include("../clases/Usuario.php");?>
<?php include("../clases/Entrada.php");

$txtEntradaId=(isset($_POST['txtEntradaId']))?$_POST['txtEntradaId']:"";
$txtInicio=(isset($_POST['txtInicio']))?$_POST['txtInicio']:"";
$txtFin=(isset($_POST['txtFin']))?$_POST['txtFin']:"";

$txtCode=(isset($_POST['txtCode']))?$_POST['txtCode']:"";
$txtAmount=(isset($_POST['txtAmount']))?$_POST['txtAmount']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
$entradas=Entrada::all();
$arreglo=[];
switch($accion){
    case "Cancelar":
        header("Location:entradas.php");
        break;
    case "Limpiar":
        header("Location:entradas.php");
        break;
    case "Guardar":
        
        $product=Producto::getByCode($txtCode);
        
        if($product!=null){
            
            $entrada=new Entrada();
            $Object = new DateTime();  
            $Object->setTimezone(new DateTimeZone('America/Lima'));
            $Dateandtime = $Object->format("d-m-Y h:i:s a");  
            $entrada->Fecha=$Dateandtime;
            $entrada->Cantidad=$txtAmount;
            $entrada->Codigo=$txtCode;
            
            
            if($_SESSION['USUARIO']=="admin"){
                $entrada->DNI=98765432;
            }else{
                $usuario=Usuario::getByCorreo($_SESSION['USUARIO']);
                $entrada->DNI=$usuario->DNI;
            }
            $entrada->create();
            $product->Cantidad=$product->Cantidad+$txtAmount;
            $product->update();
            header("Location:entradas.php");
            
        }else{
            ?>
         <div class="alert alert-danger" role="alert" style="width:30%;margin:auto">
              No existe producto con ese código.
        </div>
    <?php }

    break;  
    case "Buscar":
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
        $entrada=Entrada::getById($txtEntradaId);
           
        $entrada->delete();
        header("Location:entradas.php");
        break;
    case "Cerrar":
        header("Location:cerrar.php");
        break;   
}
$preciototal=0;

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
<div style="display:flex;">
    <div style="display:flex">
    <label for="txtInicio">FECHA INICIO:</label>
    <input type="date" style="height:30px;"  class="form-control" value="<?php echo $txtInicio;?>" name="txtInicio" id="txtInicio"><br>
    </div>
    <div  style="margin-left:20px;display:flex">
    <label for="txtInicio">FECHA FIN:</label>
    <input type="date"  style="height:30px;" class="form-control" value="<?php echo $txtFin;?>" name="txtFin" id="txtFin"><br>
</div>
    <button type="submit" style="margin-left:20px;height:50px;background-color:black" name="accion" value="Buscar" class="btn btn-success">Buscar</button><br><br>
    </div>
</form>
<div class="card">
    <div class="card-header">
        Salidas
    </div>

    <div class="card-body">
    <form method="POST" enctype="multipart/form-data">

   

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
</div>
    <table class="table">
        <thead>
            <tr>
                <th>Codigo de producto</th>
                <th>Descripción de producto</th>
                <th>Proveedor</th>
                <th>Trabajador</th>
                <th>Categoria</th>
                <th>Precio Compra</th>
                <th>Cantidad</th>
                <th>Sub total</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $newarreglo=$_SESSION['ARREGLO'];
            ?>
        <?php if($_SESSION['OPCION']=="BUSCAR"){
            for ($i=0;$i<count($newarreglo);$i++) { 
                
                $entrada=Entrada::getByEntradaId($newarreglo[$i]);
                $empleado=Usuario::getByDNI($entrada->DNI);
                $producto=Producto::getByCode($entrada->Codigo);
                $proveedor=Proveedor::getByRUC($producto->RUC);
                ?>
            <tr>
                <td><?php echo $producto->Codigo;?></td>
                <td><?php echo $producto->Descripcion;?></td>
                <td><?php echo $proveedor->RazonSocial;?></td>
                <td><?php if($empleado==null){
                    echo "ADMINISTRADOR";
                }
                else{
                    echo $empleado->Nombre." ".$empleado->Apellidopaterno;
                }
                ?></td>
                <td><?php echo $producto->Categoria;?></td>
                <td>S/.<?php echo $producto->Preciocompra;?></td>
                <td><?php echo $producto->Cantidad;?></td>
                <td>S/.<?php echo $producto->Cantidad*$producto->Preciocompra;?></td>
                <?php $preciototal=$preciototal+($producto->Cantidad*$producto->Preciocompra)?>
            </tr>
           <?php } } else { ?>
           <?php 
           foreach ($entradas as $entrada) { 
            $empleado=Usuario::getByDNI($entrada->DNI);
          
            $producto=Producto::getByCode($entrada->Codigo);
            $proveedor=Proveedor::getByRUC($producto->RUC);
            ?>
            <tr>
                <td><?php echo $producto->Codigo;?></td>
                <td><?php echo $producto->Descripcion;?></td>
                <td><?php echo $proveedor->RazonSocial;?></td>
                <td><?php if($empleado==null){
                    echo "ADMINISTRADOR";
                }
                else{
                    echo $empleado->Nombre." ".$empleado->Apellidopaterno;
                }
                ?></td>
                <td><?php echo $producto->Categoria;?></td>
                <td>S/.<?php echo $producto->Preciocompra;?></td>
                <td><?php echo $producto->Cantidad;?></td>
                <td>S/.<?php echo $producto->Cantidad*$producto->Preciocompra;?></td>
                <?php $preciototal=$preciototal+($producto->Cantidad*$producto->Preciocompra)?>
                
            </tr>
           <?php } }?>
        </tbody>
        
    </table>
    <div style="position:relative;text-align:right;left:200px">S/.<?php echo $preciototal?></div>
    <?php $_SESSION['OPCION']="";
    $_SESSION['ARREGLO']="";?>
</div>
<?php include("../templateloginadministrador/pie.php");?>