<?php
include_once("../config/Conexion.php");
class Producto extends Conexion{
    public $Codigo;
    public $Descripcion;
    public $Categoria;
    public $Cantidad;
    public $Preciocompra;
    public $Precioventa;
    public $RUC;
    public function create(){
        $this->conectar();
        $pre=mysqli_prepare($this->con,"INSERT INTO producto (Descripcion,Categoria,Cantidad,Preciocompra,Precioventa,RUC) VALUES (?,?,?,?,?,?)");
        $pre->bind_param("ssiddi",$this->Descripcion,$this->Categoria,$this->Cantidad,$this->Preciocompra,$this->Precioventa,$this->RUC);
        $pre->execute();
        
    }
    public static function all(){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre = mysqli_query($conexion->con, "SELECT * FROM producto");
        $productos = [];
        while ($res=mysqli_fetch_object($pre,'Producto')){
            $producto=$res;
            array_push($productos, $producto);
        }
        
        return $productos;
    }
    public function update(){
        $this->conectar();
        $pre=mysqli_prepare($this->con,"UPDATE producto SET Descripcion=?, Categoria=?, Cantidad=?, Preciocompra=?, Precioventa=?, RUC=? WHERE Codigo=?");
        $pre->bind_param("ssiddii",$this->Descripcion,$this->Categoria,$this->Cantidad,$this->Preciocompra,$this->Precioventa,$this->RUC,$this->Codigo);
        $pre->execute();
        
    }
    
    public function delete(){
        $this->conectar();
        $pre=mysqli_prepare($this->con,"DELETE FROM producto WHERE Codigo=?");
        $pre->bind_param("i",$this->Codigo);
        $pre->execute();
    }
    public static function getByCode($codigo){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre=mysqli_query($conexion->con,"SELECT * FROM producto WHERE Codigo='$codigo'");
        $res=mysqli_fetch_object($pre,'Producto');
        return $res;
    }
    public static function getByDescription($descripcion){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre=mysqli_query($conexion->con,"SELECT * FROM producto WHERE Descripcion='$descripcion'");
        $res=mysqli_fetch_object($pre,'Producto');
        return $res;
    }
    public static function getByCategory($Categoria){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre = mysqli_query($conexion->con, "SELECT * FROM producto WHERE Categoria='$Categoria'");
        
        $productos = [];
        while ($res=mysqli_fetch_object($pre,'Producto')){
            $producto=$res;
            array_push($productos, $producto);
            
        }
        return $productos;
    }
    public static function getByPurchase($purchaseprice){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre = mysqli_query($conexion->con, "SELECT * FROM producto WHERE Preciocompra='$purchaseprice'");
        
        $productos = [];
        while ($res=mysqli_fetch_object($pre,'Producto')){
            $producto=$res;
            array_push($productos, $producto);
            
        }
        return $productos;
    }
    public static function getBySale($saleprice){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre = mysqli_query($conexion->con, "SELECT * FROM producto WHERE Precioventa='$saleprice'");
        
        $productos = [];
        while ($res=mysqli_fetch_object($pre,'Producto')){
            $producto=$res;
            array_push($productos, $producto);
        }
        return $productos;
    }
    public static function getByProveedor($ruc){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre = mysqli_query($conexion->con, "SELECT * FROM producto WHERE RUC='$ruc'");
        $productos = [];
        while ($res=mysqli_fetch_object($pre,'Producto')){
            $producto=$res;
            array_push($productos, $producto);
        }
        return $productos;
    }
    public static function getlastProduct(){
        $conexion=new Conexion();
        $conexion->conectar();
        $pre = mysqli_query($conexion->con, "SELECT * FROM producto ORDER BY Codigo DESC LIMIT 1");
        $res=mysqli_fetch_object($pre,'Producto');
        return $res;
    }
    

}