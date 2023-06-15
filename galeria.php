<?php include('header.php'); ?>
<?php include('conection.php'); ?>
<?php 
    //Insert 
    $folder = 'upload/';
    if($_POST){
      $nombre = $_POST['nombre'];
      $descripcion = $_POST['descripcion'];
      $img = $_FILES['imagen']['name'];
      $targetDir = $folder.$img;
      $objConexion = new conexion();
      if(move_uploaded_file($_FILES['imagen']['tmp_name'], $targetDir)){
        $sql = "INSERT INTO `proyectos` (`id`, `nombre`, `imagen`, `descripcion`) VALUES (NULL, '$nombre', '$targetDir', '$descripcion');";
        $objConexion->ejecutar($sql);
        header("location:galeria.php");
      }else{
        echo 'Error al cargar la imagen';
      }

      
    }
    //Delete de registros
    if($_GET){
      $objConexion = new conexion();
      $id = $_GET['borrar'];
      $sql = "DELETE FROM `proyectos` WHERE `proyectos`.`id` =".$id;
      $sqlSelect = "SELECT * FROM `proyectos` WHERE `proyectos`.`id` =".$id;
      $resultado = $objConexion->selectSQL($sqlSelect);
      $nombreImagen = $resultado[0]['imagen'];      
      $objConexion->ejecutar($sql);
      unlink($nombreImagen);
      header("location:galeria.php");
    }

    //Recuperamos los datos desde la base de datos
    $objConexion = new conexion();
    $sql = "SELECT * FROM `proyectos`";
    $resultado = $objConexion->selectSQL($sql);
    
    

?>

<div class="container">
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          Datos del proyecto
        </div>
        <div class="card-body">
          <form action="galeria.php" method="POST" enctype="multipart/form-data">
            Nombre del Proyecto
            <input required class="form-control" type="text" name="nombre" >
            <br/>
            Imagen del Proyecto
            <input required class="form-control" type="file" name="imagen">
            <br/>
            Descripcion
            <textarea class="form-control mb-2" name="descripcion" id="" cols="30" rows="3"></textarea>
            <button class="btn btn-success" type="submit">Guardar</button>
          </form>    
        </div>  
      </div>
    </div>
    <div class="col-md-5">
      <div class="table-responsive">
        <table class="table table-primary">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nombre</th>
              <th scope="col">Imagen</th>
              <th scope="col">Descripcion</th>
              <th scope="col">Eliminar</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($resultado as $proyecto){ ?>
            <tr class="">
              <td scope="row"><?php echo $proyecto['id']?></td>
              <td><?php echo $proyecto['nombre']?></td>
              <td><img width="100" height="100" src="<?php echo $proyecto['imagen']?>" alt=""></td>
              <td><?php echo $proyecto['descripcion']?></td>
              <td><a name="" href="?borrar=<?php echo $proyecto['id'];?>" class="btn btn-primary" role="button">Eliminar</a></td>
            </tr>
            <?php }?>
          </tbody>
        </table>
      </div>
    </div>
    
  </div>
</div>






<?php include('footer.php'); ?>
