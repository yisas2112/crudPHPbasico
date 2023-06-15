<?php
  class conexion{
    private $servidor="localhost";
    private $user = "root";
    private $contrasena ="";
    private $dbname = "album";
    private $conexion;

    public function __construct(){
      try{
        $this->conexion = new PDO("mysql:host=$this->servidor;dbname=$this->dbname",$this->user, $this->contrasena);
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
      }catch(PDOExeption $e){
        return "Falla de conexión".$e;
      }
    }

    public function ejecutar($sql){
      $this->conexion->exec($sql);
      return $this->conexion->lastInsertId();
    }

    public function selectSQL($sql){      
      $setencia = $this->conexion->prepare($sql);
      $setencia->execute();
      return $setencia->fetchAll();
    }

    
  }  
?>