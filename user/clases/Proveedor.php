<?php
include_once("../config/Conexion.php");
class Proveedor extends Conexion{
    public $RUC;
    public $RazonSocial;
    public $Nombre;
    public $Tipo;
    public $Departamento;
    public $Provincia;
    public $Distrito;
    public $Direccion;
    public $Telefono;
    public $Correo;
    public function create(){
        $this->conectar();
        $pre=mysqli_prepare($this->con,"INSERT INTO proveedor (RUC,RazonSocial,Nombre,Tipo,Departamento,Provincia,Distrito,Direccion,Telefono,Correo) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $pre->bind_param("isssssssis",$this->RUC,$this->RazonSocial,$this->Nombre,$this->Tipo,$this->Departamento,$this->Provincia,$this->Distrito,$this->Direccion,$this->Telefono,$this->Correo);
        $pre->execute();
        
    }
    public static function all(){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre = mysqli_query($conexion->con, "SELECT * FROM proveedor");
        $proveedores = [];
        while ($res=mysqli_fetch_object($pre,'Proveedor')){
            $proveedor=$res;
            array_push($proveedores, $proveedor);
        }
        
        return $proveedores;
    }
  
    public function delete(){
        $this->conectar();
        $pre=mysqli_prepare($this->con,"DELETE FROM proveedor WHERE RUC=?");
        $pre->bind_param("i",$this->RUC);
        $pre->execute();
    }
    public static function getByName($name){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre=mysqli_query($conexion->con,"SELECT * FROM proveedor WHERE Nombre='$name'");
        $res=mysqli_fetch_object($pre,'Proveedor');
        return $res;
    }
    public static function getByRazonSocial($razonsocial){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre=mysqli_query($conexion->con,"SELECT * FROM proveedor WHERE RazonSocial='$razonsocial'");
        $res=mysqli_fetch_object($pre,'Proveedor');
        return $res;
    }
    public static function getByRUC($ruc){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre=mysqli_query($conexion->con,"SELECT * FROM proveedor WHERE RUC='$ruc'");
        $res=mysqli_fetch_object($pre,'Proveedor');
        return $res;
    }
    public static function getByDepartamento($departamento){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre = mysqli_query($conexion->con, "SELECT * FROM proveedor WHERE Departamento='$departamento'");
        $proveedores = [];
        while ($res=mysqli_fetch_object($pre,'Proveedor')){
            $proveedor=$res;
            array_push($proveedores, $proveedor);
        }
        
        return $proveedores;
    }
    public static function getByProvincia($provincia){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre = mysqli_query($conexion->con, "SELECT * FROM proveedor WHERE Provincia='$provincia'");
        $proveedores = [];
        while ($res=mysqli_fetch_object($pre,'Proveedor')){
            $proveedor=$res;
            array_push($proveedores, $proveedor);
        }
        
        return $proveedores;
    }
    public static function getByDistrito($distrito){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre = mysqli_query($conexion->con, "SELECT * FROM proveedor WHERE Distrito='$distrito'");
        $proveedores = [];
        while ($res=mysqli_fetch_object($pre,'Proveedor')){
            $proveedor=$res;
            array_push($proveedores, $proveedor);
        }
        
        return $proveedores;
    }
    public static function getByTelefono($telefono){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre=mysqli_query($conexion->con,"SELECT * FROM proveedor WHERE Telefono='$telefono'");
        $res=mysqli_fetch_object($pre,'Proveedor');
        return $res;
    }
    public static function getByCorreo($correo){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre=mysqli_query($conexion->con,"SELECT * FROM proveedor WHERE Correo='$correo'");
        $res=mysqli_fetch_object($pre,'Proveedor');
        return $res;
    }

}