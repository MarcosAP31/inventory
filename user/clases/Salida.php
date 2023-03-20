<?php
include_once("../config/Conexion.php");
class Salida extends Conexion{
    public $SalidaId;
    public $Fecha;
    public $Codigo;
    public $Cantidad;
    public $DNICliente;
    public $DNIUsuario;
    public function create(){
        $this->conectar();
        $pre=mysqli_prepare($this->con,"INSERT INTO salida (Fecha,Codigo,Cantidad,DNICliente,DNIUsuario) VALUES (?,?,?,?,?)");
        $pre->bind_param("siiii",$this->Fecha,$this->Codigo,$this->Cantidad,$this->DNICliente,$this->DNIUsuario);
        $pre->execute();
    }
    public static function all(){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre = mysqli_query($conexion->con, "SELECT * FROM salida");
        $salidas = [];
        while ($res=mysqli_fetch_object($pre,'Salida')){
            $salida=$res;
            array_push($salidas, $salida);
        }
        
        return $salidas;
    }
    public function update(){
        $this->conectar();
        $pre=mysqli_prepare($this->con,"UPDATE salida SET Fecha=? WHERE SalidaId=?");
        $pre->bind_param("si",$this->Fecha,$this->SalidaId);
        $pre->execute();
        
    }
    public function delete(){
        $this->conectar();
        $pre=mysqli_prepare($this->con,"DELETE FROM salida WHERE SalidaId=?");
        $pre->bind_param("i",$this->SalidaId);
        $pre->execute();
    }
    public static function getByDate($fecha){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre = mysqli_query($conexion->con, "SELECT * FROM salida WHERE Fecha='$fecha'");
        
        $salidas = [];
        while ($res=mysqli_fetch_object($pre,'Salida')){
            $salida=$res;
            array_push($salidas, $salida);
            
        }
        return $salidas;
    }
    public static function getById($id){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre=mysqli_query($conexion->con,"SELECT * FROM salida WHERE SalidaId='$id'");
        $res=mysqli_fetch_object($pre,'Salida');
        return $res;
    }

}