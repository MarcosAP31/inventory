<?php include("../templateloginadministrador/cabecera.php");?>
<?php include("../clases/Producto.php");
 include("../clases/Proveedor.php");
 include("../clases/Usuario.php");
 include("../clases/Entrada.php");

$txtCode=(isset($_POST['txtCode']))?$_POST['txtCode']:"";
$txtDescription=(isset($_POST['txtDescription']))?$_POST['txtDescription']:"";
$Proveedor=(isset($_POST['select']))?$_POST['select']:"";
$Category=(isset($_POST['selectcategoria']))?$_POST['selectcategoria']:"";
$txtAmount=(isset($_POST['txtAmount']))?$_POST['txtAmount']:"";
$txtPurchaseprice=(isset($_POST['txtPurchaseprice']))?$_POST['txtPurchaseprice']:"";
$txtSaleprice=(isset($_POST['txtSaleprice']))?$_POST['txtSaleprice']:"";
$categorias=array("TV Y VIDEO","LAPTOPS Y TABLETS","AUDIO","ALMACENAMIENTO","ACCESORIOS");

$accion=(isset($_POST['accion']))?$_POST['accion']:"";
$proveedores=Proveedor::all();
if($_SESSION['CODIGO']!="" && $_SESSION['DESCRIPCION']!="" && $_SESSION['CATEGORIA']!=""&& $_SESSION['CANTIDAD']!=""&& $_SESSION['PRECIOCOMPRA']!=""&& $_SESSION['PRECIOVENTA']!=""&& $_SESSION['PROVEEDORRUC']!=""){
    $txtCode=$_SESSION['CODIGO'];
    $txtDescription=$_SESSION['DESCRIPCION'];
    $Category=$_SESSION['CATEGORIA'];
    $txtAmount=$_SESSION['CANTIDAD'];
    $txtPurchaseprice=$_SESSION['PRECIOCOMPRA'];
    $txtSaleprice=$_SESSION['PRECIOVENTA'];
    $proveedorbyRUC=Proveedor::getByRUC($_SESSION['PROVEEDORRUC']);
    $Proveedor=$proveedorbyRUC->Nombre;
}
        $_SESSION['CODIGO']="";
        $_SESSION['DESCRIPCION']="";
        $_SESSION['CATEGORIA']="";
        $_SESSION['CANTIDAD']="";
        $_SESSION['PRECIOCOMPRA']="";
        $_SESSION['PRECIOVENTA']="";
        $_SESSION['PROVEEDORRUC']="";
switch($accion){
    case "Cancelar":
        header("Location:productos.php");
        break;
    case "Limpiar":
        header("Location:producto.php");
        break;
    case "Guardar":
        $productobycode=Producto::getByCode($txtCode);
        if($txtDescription!=""&&$Proveedor!=""&&$txtAmount!=""&&$txtPurchaseprice!=""&&$txtSaleprice!=""){
            $searchString =" ";
            $replaceString ="";
            $description=$txtDescription;
            $outputDescription= str_replace($searchString, $replaceString, $description);
            
            if(!ctype_alpha($outputDescription)||!is_numeric($txtAmount)||!is_numeric($txtPurchaseprice)||!is_numeric($txtSaleprice)){
                if(!ctype_alpha($outputDescription)){ ?>
                    <div  class="alert alert-danger" role="alert" style="width:30%;margin:auto">
                         La descripción debe contener solo letras.
                    </div>
                <?php }
                if(!is_numeric($txtAmount)){ ?>
                    <div class="alert alert-danger" role="alert" style="width:30%;margin:auto">
                         Cantidad inválida
                    </div>
                <?php }
                
                if(!is_numeric($txtPurchaseprice)){ ?>
                    <div  class="alert alert-danger" role="alert" style="width:30%;margin:auto">
                         Precio de compra inválido
                    </div>
                <?php }
                if(!is_numeric($txtSaleprice)){ ?>
                    <div class="alert alert-danger" role="alert" style="width:30%;margin:auto">
                         Precio de venta inválido
                    </div>
                <?php }
               
            }
            else{
                
                    $proveedor=Proveedor::getByRazonSocial($Proveedor);
                       if($productobycode!=null){
                           
                        $productobycode->Descripcion=$txtDescription;
                        $productobycode->Categoria=$Category;
                        $productobycode->Cantidad=$txtAmount;
                        $productobycode->Preciocompra=$txtPurchaseprice;
                        $productobycode->Precioventa=$txtSaleprice;
                        $productobycode->RUC=$proveedor->RUC;
                        $productobycode->update(); 
                       }
                       else{
                        $producto=new Producto();
                        $producto->Descripcion=$txtDescription;
                        $producto->Categoria=$Category;
                        $producto->Cantidad=$txtAmount;
                        $producto->Preciocompra=$txtPurchaseprice;
                        $producto->Precioventa=$txtSaleprice;
                        $producto->RUC=$proveedor->RUC;
                        $producto->create();
                        $lastproduct=Producto::getlastProduct();
                        
                        $Object = new DateTime();  
                        $Object->setTimezone(new DateTimeZone('America/Lima'));
                        $Dateandtime = $Object->format("d-m-Y h:i:s a");  
                       
                        $entrada=new Entrada();
                        $entrada->Fecha=$Dateandtime;
                        $entrada->Codigo=$lastproduct->Codigo;
                        $entrada->Cantidad=$producto->Cantidad;
                        if($_SESSION['USUARIO']=="admin"){
                        $entrada->DNI=98765432;
                        }else{
                            $usuario=Usuario::GetByCorreo($_SESSION['USUARIO']);
                            $entrada->DNI=$usuario->DNI;
                        }
                        $entrada->create();
                       }
                       header("Location:productos.php");
                    
            }
        }
        else{ ?>
        <div class="alert alert-danger" role="alert" style="width:30%;margin:auto">
                            Debe llenar todos los campos
                        </div>
        <?php }
       
        break;  
   
}
?>


<div class="col-md-5">
<div class="card">
    <div class="card-header">
        Datos de Productos
    </div>

    <div class="card-body">
    <form method="POST" enctype="multipart/form-data">

    <div class = "form-group">
    <label for="txtCode">Codigo:</label>
    <input type="text" require readonly class="form-control" value="<?php echo $txtCode;?>" name="txtCode" id="txtCode" placeholder="Codigo">
    </div>

    <div class = "form-group">
    <label for="txtDescription">Descripcion:</label>
    <input type="text" class="form-control" value="<?php echo $txtDescription;?>" name="txtDescription" id="txtDescription" placeholder="Descripcion">
    </div>

    <label for="txtProveedor">Proveedor:</label>
    <select name="select" id="select">
    <?php if($Proveedor==""){
            foreach($proveedores as $proveedor){?>
      <option value="<?php echo $proveedor->RazonSocial;?>"><?php echo $proveedor->RazonSocial;?></option>
      <?php }}
          else {?>
          <option value="<?php echo $Proveedor;?>"><?php echo $Proveedor;?></option>
          <?php foreach($proveedores as $proveedor){
              if($proveedor->RazonSocial!=$Proveedor){?>
              <option value="<?php echo $proveedor->RazonSocial;?>"><?php echo $proveedor->RazonSocial;?></option>
            <?php }?>
      <?php }}
         ?>
    </select>

    <div class = "form-group">
    <label for="txtCategory">Categoría:</label>
    <select name="selectcategoria" id="selectcategoria">
    <?php if($Category==""){
            for($i=0;$i<count($categorias);$i++){?>
      <option value="<?php echo $categorias[$i];?>"><?php echo $categorias[$i];?></option>
      <?php }}
          else {?>
          <option value="<?php echo $Category;?>"><?php echo $Category;?></option>
          <?php for($i=0;$i<count($categorias);$i++){
              if($categorias[$i]!=$Category){?>
              <option value="<?php echo $categorias[$i];?>"><?php echo $categorias[$i];?></option>
            <?php }?>
      <?php }}
         ?>
    </select>
    <div>

    <div class = "form-group">
    <label for="txtAmount">Cantidad:</label>
    <input type="text" class="form-control" value="<?php echo $txtAmount;?>" name="txtAmount" id="txtAmount" placeholder="Cantidad">
    </div>

    <div class = "form-group">
    <label for="txtPurchaseprice">Precio de compra:</label>
    <input type="text" class="form-control" value="<?php echo $txtPurchaseprice;?>" name="txtPurchaseprice" id="txtPurchaseprice" placeholder="Precio de compra">
    </div>

    <div class = "form-group">
    <label for="txtSaleprice">Precio de venta:</label>
    <input type="text" class="form-control" value="<?php echo $txtSaleprice;?>" name="txtSaleprice" id="txtSaleprice" placeholder="Precio de venta">
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
<?php include("../templateloginadministrador/pie.php");?>