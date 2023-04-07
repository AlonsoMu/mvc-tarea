<?php

require_once '../models/producto.php';

if (isset($_POST['operacion'])){

  $producto = new Producto();

  if($_POST['operacion'] == 'listar'){

    $datosObtenidos = $producto->listarProductos();
    //En esta ocasion NO enviaremos un objeto JSON, en su lugar el controlador renderizara las filas que necesita <tobdy></tobdy>
    //echo json_encode($datosObtenidos);

    //PASO 1: Verificar que el objeto contenga datos
    if($datosObtenidos){
      $numeroFila = 1;
      // PASO 2: Recorrer todo el objeto
      foreach($datosObtenidos as $producto){
        // PASO 3: Ahora construimos las filas
        echo "
        <tr>
          <td>{$numeroFila}</td>
          <td>{$producto['nombreproducto']}</td>
          <td>{$producto['modelo']}</td>
          <td>{$producto['marca']}</td>
          <td>{$producto['color']}</td>
          <td>{$producto['conectividad']}</td>
          <td>{$producto['peso']}</td>
          <td>{$producto['fecharegistro']}</td>
          <td>{$producto['precio']}</td>
          <td> 
          <a href='#' data-idproducto='{$producto['idproducto']}' class='btn btn-danger btn-sm eliminar'><i class='bi bi-trash3-fill'></i></a>
                <a href='#' data-idproducto='{$producto['idproducto']}' class='btn btn-info btn-sm editar'><i class='bi bi-pencil-fill'></i></a>
          </td>
        </tr>
        ";
        $numeroFila++;
      }
    }

  }

  if($_POST['operacion'] == 'registrar'){

    //Paso 1: Recpger los datos que nos envia la vista (FORM,utilizando ajax)
    $datosForm = [
      "nombreproducto"      => $_POST['nombreproducto'], //CLAVES // VALORES
      "modelo"              => $_POST['modelo'],
      "marca"               => $_POST['marca'],
      "color"               => $_POST['color'],
      "conectividad"        => $_POST['conectividad'],
      "peso"                => $_POST['peso'],
      "fechainicio"         => $_POST['fechainicio'],
      "precio"              => $_POST['precio']
    ];

    //Paso 2: Enviar el arreglo como paramentro del metodo
      $producto->registrarProducto($datosForm);

  }

  /*if($_POST['operacion'] == 'actualizar'){

    //Paso 1: Recpger los datos que nos envia la vista (FORM,utilizando ajax)
    $idproducto = $idproducto;
    $datosForm = [
      "nombreproducto"      => $_POST['nombreproducto'], //CLAVES // VALORES
      "modelo"              => $_POST['modelo'],
      "marca"               => $_POST['marca'],
      "color"               => $_POST['color'],
      "conectividad"        => $_POST['conectividad'],
      "peso"                => $_POST['peso'],
      "fechainicio"         => $_POST['fechainicio'],
      "precio"              => $_POST['precio']
    ];

    //Paso 2: Enviar el arreglo como paramentro del metodo
      $producto->actualizarProducto($idproducto, $datosForm);

  }*/

  if($_POST['operacion'] == 'eliminar'){
    $producto->eliminarProducto($_POST['idproducto']);
  }
}