<?php
include_once("./config/Conexion.php");
class Usuario extends Conexion{
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
    public $Contraseña;

    public function create(){
        $this->conectar();
        $pre=mysqli_prepare($this->con,"INSERT INTO usuario (DNI,Nombre,Apellidopaterno,Apellidomaterno,Fechanacimiento,Sexo,Departamento,Provincia,Distrito,Direccion,Telefono,Correo,Contraseña) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $pre->bind_param("isssssssssiss",$this->DNI,$this->Nombre,$this->Apellidopaterno,$this->Apellidomaterno,$this->Fechanacimiento,$this->Sexo,$this->Departamento,$this->Provincia,$this->Distrito,$this->Direccion,$this->Telefono,$this->Correo,$this->Contraseña);
        $pre->execute();
        
    }
    public static function all(){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre = mysqli_query($conexion->con, "SELECT * FROM usuario");
        $usuarios = [];
        while ($res=mysqli_fetch_object($pre,'Usuario')){
            $usuario=$res;
            array_push($usuarios, $usuario);
        }
        
        return $usuarios;
    }

  
    public function delete(){
        $this->conectar();
        $pre=mysqli_prepare($this->con,"DELETE FROM usuario WHERE DNI=?");
        $pre->bind_param("i",$this->DNI);
        $pre->execute();
    }
    
    public static function getByDNI($dni){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre=mysqli_query($conexion->con,"SELECT * FROM usuario WHERE DNI='$dni'");
        $res=mysqli_fetch_object($pre,'Usuario');
        return $res;
    }
    public static function getByDepartamento($departamento){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre = mysqli_query($conexion->con, "SELECT * FROM usuario WHERE Departamento='$departamento'");
        $usuarios = [];
        while ($res=mysqli_fetch_object($pre,'Usuario')){
            $usuario=$res;
            array_push($usuarios, $usuario);
        }
        
        return $usuarios;
    }
    public static function getByProvincia($provincia){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre = mysqli_query($conexion->con, "SELECT * FROM usuario WHERE Provincia='$provincia'");
        $usuarios = [];
        while ($res=mysqli_fetch_object($pre,'Usuario')){
            $usuario=$res;
            array_push($usuarios, $usuario);
        }
        
        return $usuarios;
    }
    public static function getByDistrito($distrito){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre = mysqli_query($conexion->con, "SELECT * FROM usuario WHERE Distrito='$distrito'");
        $usuarios = [];
        while ($res=mysqli_fetch_object($pre,'Usuario')){
            $usuario=$res;
            array_push($usuarios, $usuario);
        }
        
        return $usuarios;
    }
    public static function getBySexo($sexo){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre = mysqli_query($conexion->con, "SELECT * FROM usuario WHERE Sexo='$sexo'");
        $usuarios = [];
        while ($res=mysqli_fetch_object($pre,'Usuario')){
            $usuario=$res;
            array_push($usuarios, $usuario);
        }
        
        return $usuarios;
    }
    public static function getByTelefono($telefono){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre=mysqli_query($conexion->con,"SELECT * FROM usuario WHERE Telefono='$telefono'");
        $res=mysqli_fetch_object($pre,'Usuario');
        return $res;
    }
    public static function getByCorreo($correo){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre=mysqli_query($conexion->con,"SELECT * FROM usuario WHERE Correo='$correo'");
        $res=mysqli_fetch_object($pre,'Usuario');
        return $res;
    }
    
   

}