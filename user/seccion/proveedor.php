<?php include("../templateloginadministrador/cabecera.php");?>
<?php include("../clases/Proveedor.php");

$txtRUC=(isset($_POST['txtRUC']))?$_POST['txtRUC']:"";
$txtRazonSocial=(isset($_POST['txtRazonSocial']))?$_POST['txtRazonSocial']:"";
$txtName=(isset($_POST['txtName']))?$_POST['txtName']:"";
$txtKind=(isset($_POST['txtKind']))?$_POST['txtKind']:"";
$Departamento=(isset($_POST['selectdepa']))?$_POST['selectdepa']:"";
$Provincia=(isset($_POST['selectprovincia']))?$_POST['selectprovincia']:"";
$Distrito=(isset($_POST['selectdistrito']))?$_POST['selectdistrito']:"";
$txtDirection=(isset($_POST['txtDirection']))?$_POST['txtDirection']:"";
$txtPhone=(isset($_POST['txtPhone']))?$_POST['txtPhone']:"";
$txtEmail=(isset($_POST['txtEmail']))?$_POST['txtEmail']:"";
$departamentos=array("Amazonas","Ancash","Apurímac","Arequipa","Ayacucho","Cajamarca","Callao","Cusco","Huancavelica","Huánuco",
"Ica","Junín","La Libertad","Lambayeque","Lima","Loreto","Madre de Dios","Moquegua","Pasco","Piura","Puno","San Martín","Tacna","Tumbes","Ucayali");
$provincias=array("Barranco","Cajatambo","Canta","Cañete","Huaral","Huarochirí","Huaura","Lima","Oyón","Yauyos");
$distritos=array("Ate Vitarte","Barranco","Breña","Carabayllo","Chaclacayo","Chorrillos","Cieneguilla","Comas","El Agustino","Independencia","Jesús María","La Molina","La Victoria","Lima","Lince","Los Olivos","Lurigancho","Lurín","Magdalena del Mar","Miraflores",
"Pachacamac","Pucusana","Pueblo Libre","Puente Piedra","Punta Hermosa","Punta Negra","Rímac","San Bartolo","San Borja","San Isidro","San Juan de Lurigancho","San Juan de Miraflores","San Luis","San Martín de Porres","San Miguel","Santa Anita","Santa María del Mar","Santa Rosa","Santiago de Surco","Surquillo",
"Villa El Salvador","Villa María del Triunfo");
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

if($_SESSION['RUC']!=""&& $_SESSION['RAZONSOCIAL']!="" && $_SESSION['NOMBRE']!=""&& $_SESSION['TIPO']!=""&& $_SESSION['DEPARTAMENTO']!=""&& $_SESSION['PROVINCIA']!=""&& $_SESSION['DISTRITO']!=""&& $_SESSION['DIRECCION']!=""&& $_SESSION['TELEFONO']!=""&&$_SESSION['CORREO']!=""){
    
    $txtRUC=$_SESSION['RUC'];
    $txtRazonSocial=$_SESSION['RAZONSOCIAL'];
    $txtName=$_SESSION['NOMBRE'];
    $txtKind=$_SESSION['TIPO'];
    $Departamento=$_SESSION['DEPARTAMENTO'];
    $Provincia=$_SESSION['PROVINCIA'];
    $Distrito=$_SESSION['DISTRITO'];
    $txtDirection=$_SESSION['DIRECCION'];
    $txtPhone=$_SESSION['TELEFONO'];
    $txtEmail=$_SESSION['CORREO'];
    $_SESSION['EDITARRUC']=$txtRUC;
    
}
        
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
switch($accion){
    case "Cancelar":
        header("Location:proveedores.php");
        break;
    case "Limpiar":
        header("Location:proveedor.php");
        break;
    case "Guardar":
        
       
        if($txtRUC!=""&&$txtRazonSocial!=""&&$txtName!=""&&$txtKind!=""&&$txtDirection!=""&&$txtPhone!=""&&$txtEmail!=""){
            $searchString =" ";
            $replaceString ="";
            $razonsocial = $txtRazonSocial;
            $name=$txtName;
            
            $outputString = str_replace($searchString, $replaceString, $razonsocial);
            $outputName= str_replace($searchString, $replaceString, $name);
            
            if(!is_numeric($txtRUC)||!ctype_alpha($txtKind)||!is_numeric($txtPhone)||(strpos($txtEmail,"@gmail.com") == false && strpos($txtEmail,"@hotmail.com") == false )){
                if(!is_numeric($txtRUC)){ ?>
                    <div class="alert alert-danger" role="alert" style="width:30%;margin:auto">
                         RUC inválido
                    </div>
                <?php }
                /*
                if(!ctype_alpha($outputString)){ ?>
                    <div  class="alert alert-danger" role="alert" style="width:30%;margin:auto">
                         Razón social inválido
                    </div>
                <?php }
                if(!ctype_alpha($outputName)){ ?>
                    <div  class="alert alert-danger" role="alert" style="width:30%;margin:auto">
                         Nombre inválido
                    </div>
                <?php }*/
                if(!ctype_alpha($txtKind)){ ?>
                    <div  class="alert alert-danger" role="alert" style="width:30%;margin:auto">
                         Tipo de empresa inválido
                    </div>
                <?php }
                if(!is_numeric($txtPhone)){ ?>
                    <div class="alert alert-danger" role="alert" style="width:30%;margin:auto">
                         Telefono inválido
                    </div>
                <?php }
                if(strpos($txtEmail,"@gmail.com") == false && strpos($txtEmail,"@hotmail.com") == false ){ ?>
                    <div class="alert alert-danger" role="alert" style="width:30%;margin:auto">
                         Correo invalido
                    </div>
                <?php }
            }
            else{
                if(strlen($txtRUC)!=11||strlen($txtPhone)!=9){ 
                    if(strlen($txtRUC)!=11){ ?>
                        <div class="alert alert-danger" role="alert" style="width:30%;margin:auto">
                            El RUC debe contener 11 dígitos
                        </div>
                    <?php }
                    if(strlen($txtPhone)!=9){ ?>
                        <div class="alert alert-danger" role="alert" style="width:30%;margin:auto">
                            El teléfono debe contener 9 dígitos
                        </div>
                    <?php }
                }
                else{
                        if($_SESSION['EDITARRUC']!=""){
                            $proveedorbyruc=Proveedor::getByRUC($_SESSION['EDITARRUC']);
                            if($proveedorbyruc!=null){
                                $proveedorbyruc->delete();
                                
                            }
                        }

                        $proveedor=new Proveedor();
                        $proveedor->RUC=$txtRUC;
                        $proveedor->RazonSocial=$txtRazonSocial;
                        $proveedor->Nombre=$txtName;
                        $proveedor->Tipo=$txtKind;
                        $proveedor->Departamento=$Departamento;
                        $proveedor->Provincia=$Provincia;
                        $proveedor->Distrito=$Distrito;
                        $proveedor->Direccion=$txtDirection;
                        $proveedor->Telefono=$txtPhone;
                        $proveedor->Correo=$txtEmail;
                        $proveedor->create();
                        
                        header("Location:proveedores.php");
                       
                    }
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
        Datos del proveedor
    </div>

    <div class="card-body">
    <form method="POST" enctype="multipart/form-data">

    <div class = "form-group">
    <label for="txtRUC">RUC:</label>
    <input type="text" class="form-control" value="<?php echo $txtRUC;?>" name="txtRUC" id="txtRUC" placeholder="RUC">
    </div>

    <div class = "form-group">
    <label for="txtRazonSocial">Razon Social:</label>
    <input type="text" class="form-control" value="<?php echo $txtRazonSocial;?>" name="txtRazonSocial" id="txtRazonSocial" placeholder="Nombres">
    </div>

    <div class = "form-group">
    <label for="txtName">Nombre comercial:</label>
    <input type="text" class="form-control" value="<?php echo $txtName;?>" name="txtName" id="txtName" placeholder="Nombre">
    </div>

    <div class = "form-group">
    <label for="txtKind">Tipo:</label>
    <input type="text" class="form-control" value="<?php echo $txtKind;?>" name="txtKind" id="txtKind" placeholder="Tipo">
    </div>

    <diV class = "form-group">
    <label for="txtDepartamento">Departamento:</label>
    <select name="selectdepa" id="selectdepa">
    <?php if($Departamento==""){
            for($i=0;$i<count($departamentos);$i++){?>
      <option value="<?php echo $departamentos[$i];?>"><?php echo $departamentos[$i];?></option>
      <?php }}
          else {?>
          <option value="<?php echo $Departamento;?>"><?php echo $Departamento;?></option>
          <?php for($i=0;$i<count($departamentos);$i++){
              if($departamentos[$i]!=$Departamento){?>
              <option value="<?php echo $departamentos[$i];?>"><?php echo $departamentos[$i];?></option>
            <?php }?>
      <?php }}
         ?>
    </select>
    <diV>

    <diV class = "form-group">
    <label for="txtProvincia">Provincia:</label>
    <select name="selectprovincia" id="selectprovincia">
    <?php if($Provincia==""){
            for($i=0;$i<count($provincias);$i++){?>
      <option value="<?php echo $provincias[$i];?>"><?php echo $provincias[$i];?></option>
      <?php }}
          else {?>
          <option value="<?php echo $Provincia;?>"><?php echo $Provincia;?></option>
          <?php for($i=0;$i<count($provincias);$i++){
              if($provincias[$i]!=$Provincia){?>
              <option value="<?php echo $provincias[$i];?>"><?php echo $provincias[$i];?></option>
            <?php }?>
      <?php }}
         ?>
    </select>
    <diV>

    <diV class = "form-group">
    <label for="txtDistrito">Distrito:</label>
    <select name="selectdistrito" id="selectdistrito">
    <?php if($Distrito==""){
            for($i=0;$i<count($distritos);$i++){?>
      <option value="<?php echo $distritos[$i];?>"><?php echo $distritos[$i];?></option>
      <?php }}
          else {?>
          <option value="<?php echo $Distrito;?>"><?php echo $Distrito;?></option>
          <?php for($i=0;$i<count($distritos);$i++){
              if($distritos[$i]!=$Distrito){?>
              <option value="<?php echo $distritos[$i];?>"><?php echo $distritos[$i];?></option>
            <?php }?>
      <?php }}
         ?>
    </select>
    <diV>

    <div class = "form-group">
    <label for="txtDirection">Direccion:</label>
    <input type="text" class="form-control" value="<?php echo $txtDirection;?>" name="txtDirection" id="txtDirection" placeholder="Direction">
    </div>

    <div class = "form-group">
    <label for="txtPhone">Celular:</label>
    <input type="text" class="form-control" value="<?php echo $txtPhone;?>" name="txtPhone" id="txtPhone" placeholder="Celular">
    </div>

    <div class = "form-group">
    <label for="txtEmail">Correo:</label>
    <input type="text" class="form-control" value="<?php echo $txtEmail;?>" name="txtEmail" id="txtEmail" placeholder="Correo">
    </div>

    <div class="btn-group" role="group" aria-label="">
        <button style="color:white;background-color:black" type="submit" name="accion" value="Cancelar">Cancelar</button>
        <button style="color:white;background-color:black" type="submit" name="accion" value="Limpiar">Limpiar</button>
        <button style="color:white;background-color:black" type="submit" name="accion" value="Guardar">Guardar</button>
    </div>
    </form> 
</div>    
</div>
<?php include("../templateloginadministrador/pie.php");?>