<?php include("../templateloginadministrador/cabecera.php");?>
<?php include("../clases/Cliente.php");
$txtDNI=(isset($_POST['txtDNI']))?$_POST['txtDNI']:"";
$txtName=(isset($_POST['txtName']))?$_POST['txtName']:"";
$txtPaterno=(isset($_POST['txtPaterno']))?$_POST['txtPaterno']:"";
$txtMaterno=(isset($_POST['txtMaterno']))?$_POST['txtMaterno']:"";
$txtFechaNacimiento=(isset($_POST['txtFechaNacimiento']))?$_POST['txtFechaNacimiento']:"";
$Sexo=(isset($_POST['select']))?$_POST['select']:"";
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

if($_SESSION['CLIENTEDNI']!= ""&& $_SESSION['CLIENTENOMBRE']!="" && $_SESSION['CLIENTEAPELLIDOPATERNO']!=""&& $_SESSION['CLIENTEAPELLIDOMATERNO']!=""&& $_SESSION['CLIENTEFECHANACIMIENTO']!=""&& $_SESSION['CLIENTESEXO']!=""&& $_SESSION['CLIENTEDEPARTAMENTO']!=""&& $_SESSION['CLIENTEPROVINCIA']!=""&& $_SESSION['CLIENTEDISTRITO']!=""&& $_SESSION['CLIENTEDIRECCION']!=""&& $_SESSION['CLIENTETELEFONO']!=""&&$_SESSION['CLIENTECORREO']!=""){
    
    $txtDNI=$_SESSION['CLIENTEDNI'];
    $txtName=$_SESSION['CLIENTENOMBRE'];
    $txtPaterno=$_SESSION['CLIENTEAPELLIDOPATERNO'];
    $txtMaterno=$_SESSION['CLIENTEAPELLIDOMATERNO'];
    $txtFechaNacimiento=$_SESSION['CLIENTEFECHANACIMIENTO'];
    $Sexo=$_SESSION['CLIENTESEXO'];
    $Departamento=$_SESSION['CLIENTEDEPARTAMENTO'];
    $Provincia=$_SESSION['CLIENTEPROVINCIA'];
    $Distrito=$_SESSION['CLIENTEDISTRITO'];
    $txtDirection=$_SESSION['CLIENTEDIRECCION'];
    $txtPhone=$_SESSION['CLIENTETELEFONO'];
    $txtEmail=$_SESSION['CLIENTECORREO'];
    $_SESSION['EDITARDNICLIENTE']=$txtDNI;
}

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
switch($accion){
    case "Cancelar":
        header("Location:clientes.php");
        break;
    case "Limpiar":
        header("Location:cliente.php");
        break;
    case "Guardar":
        
        if($txtDNI!=""&&$txtName!=""&&$txtPaterno!=""&&$txtMaterno!=""&&$txtDirection!=""&&$txtPhone!=""&&$txtEmail!=""){
            $searchString =" ";
            $replaceString ="";
            
            $name=$txtName;
            
            
            $outputName= str_replace($searchString, $replaceString, $name);
            
            if(!is_numeric($txtDNI)||!ctype_alpha($outputName)||!ctype_alpha($txtPaterno)||!ctype_alpha($txtMaterno)||!is_numeric($txtPhone)||(strpos($txtEmail,"@gmail.com") == false && strpos($txtEmail,"@hotmail.com") == false )){
                if(!is_numeric($txtDNI)){ ?>
                    <div class="alert alert-danger" role="alert" style="width:30%;margin:auto">
                         DNI inválido
                    </div>
                <?php }
                if(!ctype_alpha($txtName)){ ?>
                    <div  class="alert alert-danger" role="alert" style="width:30%;margin:auto">
                         Nombre inválido
                    </div>
                <?php }
                if(!ctype_alpha($txtPaterno)){ ?>
                    <div  class="alert alert-danger" role="alert" style="width:30%;margin:auto">
                         Apellido paterno inválido
                    </div>
                <?php }
                if(!ctype_alpha($txtMaterno)){ ?>
                    <div  class="alert alert-danger" role="alert" style="width:30%;margin:auto">
                         Aapellido materno inválido
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
                if(strlen($txtDNI)!=8||strlen($txtPhone)!=9){ 
                    if(strlen($txtDNI)!=8){ ?>
                        <div class="alert alert-danger" role="alert" style="width:30%;margin:auto">
                            El DNI debe contener 8 dígitos
                        </div>
                    <?php }
                    if(strlen($txtPhone)!=9){ ?>
                        <div class="alert alert-danger" role="alert" style="width:30%;margin:auto">
                            El teléfono debe contener 9 dígitos
                        </div>
                    <?php }
                }
                else{
                    if($_SESSION['EDITARDNICLIENTE']!=""){
                        $clientebydni=Usuario::getByDNI($_SESSION['EDITARDNICLIENTE']);
                        if($clientebydni!=null){
                            $clientebydni->delete();
                            
                        }
                    }
                        
                        $cliente=new Cliente();
                        $cliente->DNI=$txtDNI;
                        $cliente->Nombre=$txtName;
                        $cliente->Apellidopaterno=$txtPaterno;
                        $cliente->Apellidomaterno=$txtMaterno;
                        $arraydate = explode("-", $txtFechaNacimiento);
                        $cliente->Fechanacimiento=$arraydate[2]."-".$arraydate[1]."-".$arraydate[0];
                        $cliente->Sexo=$Sexo;
                        $cliente->Departamento=$Departamento;
                        $cliente->Provincia=$Provincia;
                        $cliente->Distrito=$Distrito;
                        $cliente->Direccion=$txtDirection;
                        $cliente->Telefono=$txtPhone;
                        $cliente->Correo=$txtEmail;
                        $cliente->create();
                        
                      
                       header("Location:clientes.php");
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
        Datos de cliente
    </div>

    <div class="card-body">
    <form method="POST" enctype="multipart/form-data">

    <div class = "form-group">
    <label for="txtDNI">DNI:</label>
    <input type="text" class="form-control" value="<?php echo $txtDNI;?>" name="txtDNI" id="txtDNI" placeholder="DNI">
    </div>

    <div class = "form-group">
    <label for="txtName">Nombres:</label>
    <input type="text" class="form-control" value="<?php echo $txtName;?>" name="txtName" id="txtName" placeholder="Nombres">
    </div>

    <div class = "form-group">
    <label for="txtPaterno">Apellido paterno:</label>
    <input type="text" class="form-control" value="<?php echo $txtPaterno;?>" name="txtPaterno" id="txtPaterno" placeholder="Apellido paterno">
    </div>

    <div class = "form-group">
    <label for="txtMaterno">Apellido materno:</label>
    <input type="text" class="form-control" value="<?php echo $txtMaterno;?>" name="txtMaterno" id="txtMaterno" placeholder="Apellido materno">
    </div>

    <div class = "form-group">
    <label for="txtFechaNacimiento">Fecha de nacimiento:</label>
    <input type="date" class="form-control" value="<?php echo $txtFechaNacimiento;?>" name="txtFechaNacimiento" id="txtFechaNacimiento" placeholder="Fecha de Nacimiento">
    </div>

    <div class = "form-group">
    <label for="txtSexo">Sexo:</label>
    <select name="select" id="select">
      <option value="MASCULINO"><?php echo "MASCULINO";?></option>
      <option value="FEMENINO"><?php echo "FEMENINO";?></option>
    </select>
    <div>

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