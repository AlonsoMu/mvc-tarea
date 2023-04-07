<?php

require_once "conexion.php";

//MODELO = contiende la logica
//extends : Herencia (PDO) en PHP
class Producto extends Conexion{

  // Objeto que almacene la conexion que viene desde el padre(Conexion) y la compartira con todos los metodos (CRUD+)
  private $accesoBD;

  //Constructor, INICIALIZAR
  public function __CONSTRUCT(){
    $this->accesoBD = parent::getConexion(); // El valor de retorno (getConexion) de esta funcion ha sido asignada a este objeto (accesoBD)
  }

  //Metodo listar productos
  public function listarProductos(){
    try {
      // 1. Preparamos la consulta
      $consulta = $this->accesoBD->prepare("CALL spu_productos_listar()");
      // 2. Ejecutamos la consulta
      $consulta->execute();
      // 3. Devolvemos la consulta(array asociativo)
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (Exception $e){
      die($e->getMessage());
    }
  }


  public function registrarProducto($datos = []){
    try {
      //1. Preparamos la consulta
      $consulta = $this->accesoBD->prepare("CALL spu_productos_registrar(?,?,?,?,?,?,?,?)");
      //2. Ejecutamos la consulta
      $consulta->execute(
        array(
          $datos["nombreproducto"],
          $datos["modelo"],
          $datos["marca"],
          $datos["color"],
          $datos["conectividad"],
          $datos["peso"],
          $datos["fechainicio"],
          $datos["precio"]
        )
      );
      
    }
    catch (Exception $e) {
      die($e->getMessage());    
    }
  }

  /*public function actualizarProducto(){
      try {
    //1. Preparamos la consulta
    $consulta = $this->accesoBD->prepare("CALL spu_productos_actualizar(?,?,?,?,?,?,?,?)");
    //2. Ejecutamos la consulta
    $consulta->execute(
      array(
        $datos["nombreproducto"],
        $datos["modelo"],
        $datos["marca"],
        $datos["color"],
        $datos["conectividad"],
        $datos["peso"],
        $datos["fechainicio"],
        $datos["precio"]
      )
    ); 
    // INTENTE HACER EL ACTUALIZAR
    
  }
  catch (Exception $e) {
    die($e->getMessage());    
  }
  }
  
  
  */

  public function eliminarProducto($idproducto = 0){
    try {
      $consulta = $this->accesoBD->prepare("CALL spu_productos_eliminar(?)");
      $consulta->execute(array($idproducto));
    }
    catch (Exception $e) {
      die($e->getMessage());
    }
  }



}