<?php
include_once("../config/Conexion.php");
class Entrada extends Conexion{
    public $EntradaId;
    public $Fecha;
    public $Cantidad;
    public $Codigo;
    public $DNI;
    public function create(){
        $this->conectar();
        $pre=mysqli_prepare($this->con,"INSERT INTO entrada (Fecha,Cantidad,Codigo,DNI) VALUES (?,?,?,?)");
        $pre->bind_param("siii",$this->Fecha,$this->Cantidad,$this->Codigo,$this->DNI);
        $pre->execute();
    }
    public static function getById($entradaid){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre=mysqli_query($conexion->con,"SELECT * FROM entrada WHERE EntradaId='$entradaid'");
        $res=mysqli_fetch_object($pre,'Entrada');
        return $res;
    }
    public static function getByCode($codigo){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre=mysqli_query($conexion->con,"SELECT * FROM entrada WHERE Codigo='$codigo'");
        $res=mysqli_fetch_object($pre,'Entrada');
        return $res;
    }
    public static function all(){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre = mysqli_query($conexion->con, "SELECT * FROM entrada");
        $entradas = [];
        while ($res=mysqli_fetch_object($pre,'Entrada')){
            $entrada=$res;
            array_push($entradas, $entrada);
        }
        
        return $entradas;
    }
    public function update(){
        $this->conectar();
        $pre=mysqli_prepare($this->con,"UPDATE entrada SET Fecha=? WHERE EntradaId=?");
        $pre->bind_param("si",$this->Fecha,$this->EntradaId);
        $pre->execute();
        
    }
    public function delete(){
        $this->conectar();
        $pre=mysqli_prepare($this->con,"DELETE FROM entrada WHERE EntradaId=?");
        $pre->bind_param("i",$this->EntradaId);
        $pre->execute();
    }
    public static function getByDate($fecha){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre = mysqli_query($conexion->con, "SELECT * FROM entrada WHERE Fecha='$fecha'");
        
        $entradas = [];
        while ($res=mysqli_fetch_object($pre,'Entrada')){
            $entrada=$res;
            array_push($entradas, $entrada);
            
        }
        return $entradas;
    }
    

}