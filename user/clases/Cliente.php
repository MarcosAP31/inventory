<?php
include_once("../config/Conexion.php");
class Cliente extends Conexion{
    public $DNI;
    public $Nombre;
    public $Apellidopaterno;
    public $Apellidomaterno;
    public $Fechanacimiento;
    public $Sexo;
    public $Departamento;
    public $Provincia;
    public $Distrito;
    public $Direccion;
    public $Telefono;
    public $Correo;

    public function create(){
        $this->conectar();
        $pre=mysqli_prepare($this->con,"INSERT INTO cliente (DNI,Nombre,Apellidopaterno,Apellidomaterno,Fechanacimiento,Sexo,Departamento,Provincia,Distrito,Direccion,Telefono,Correo) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
        $pre->bind_param("isssssssssis",$this->DNI,$this->Nombre,$this->Apellidopaterno,$this->Apellidomaterno,$this->Fechanacimiento,$this->Sexo,$this->Departamento,$this->Provincia,$this->Distrito,$this->Direccion,$this->Telefono,$this->Correo);
        $pre->execute();
        
    }
    public static function all(){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre = mysqli_query($conexion->con, "SELECT * FROM cliente");
        $clientes = [];
        while ($res=mysqli_fetch_object($pre,'Cliente')){
            $cliente=$res;
            array_push($clientes, $cliente);
        }
        
        return $clientes;
    }

    public function delete(){
        $this->conectar();
        $pre=mysqli_prepare($this->con,"DELETE FROM cliente WHERE DNI=?");
        $pre->bind_param("i",$this->DNI);
        $pre->execute();
    }
    
    public static function getByDNI($dni){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre=mysqli_query($conexion->con,"SELECT * FROM cliente WHERE DNI='$dni'");
        $res=mysqli_fetch_object($pre,'Cliente');
        return $res;
    }
    public static function getByDepartamento($departamento){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre = mysqli_query($conexion->con, "SELECT * FROM cliente WHERE Departamento='$departamento'");
        $clientes = [];
        while ($res=mysqli_fetch_object($pre,'Cliente')){
            $cliente=$res;
            array_push($clientes, $cliente);
        }
        
        return $clientes;
    }
    public static function getByProvincia($provincia){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre = mysqli_query($conexion->con, "SELECT * FROM cliente WHERE Provincia='$provincia'");
        $clientes = [];
        while ($res=mysqli_fetch_object($pre,'Cliente')){
            $cliente=$res;
            array_push($clientes, $cliente);
        }
        
        return $clientes;
    }
    public static function getByDistrito($distrito){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre = mysqli_query($conexion->con, "SELECT * FROM cliente WHERE Distrito='$distrito'");
        $clientes = [];
        while ($res=mysqli_fetch_object($pre,'Cliente')){
            $cliente=$res;
            array_push($clientes, $cliente);
        }
        
        return $clientes;
    }
    public static function getBySexo($sexo){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre = mysqli_query($conexion->con, "SELECT * FROM cliente WHERE Distrito='$sexo'");
        $clientes = [];
        while ($res=mysqli_fetch_object($pre,'Cliente')){
            $cliente=$res;
            array_push($clientes, $cliente);
        }
        
        return $clientes;
    }
    public static function getByTelefono($telefono){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre=mysqli_query($conexion->con,"SELECT * FROM cliente WHERE Telefono='$telefono'");
        $res=mysqli_fetch_object($pre,'Cliente');
        return $res;
    }
    public static function getByCorreo($correo){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre=mysqli_query($conexion->con,"SELECT * FROM cliente WHERE Correo='$correo'");
        $res=mysqli_fetch_object($pre,'Cliente');
        return $res;
    }
    
   

}