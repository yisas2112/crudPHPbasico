<?php include('header.php'); ?>  
<?php include('conection.php');?>
<?php 
      $objConexion = new conexion();
      $sql = "SELECT * FROM `proyectos`";
      $resultado = $objConexion->selectSQL($sql);      
?>

  <h1>Primer proyecto</h1>
  <div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-5">
      <h1 class="display-5 fw-bold">Bienvenidos</h1>
      <p class="col-md-8 fs-4">Esto es un fortafolio.</p>
      <button class="btn btn-primary btn-lg" type="button">Más info</button>
    </div>
  </div> 

  <div class="row row-cols-1 row-cols-md-2 g-4">
    <?php foreach($resultado as $proyecto){?>        
      <div class="col">
        <div class="card">
          <img src="<?php echo $proyecto['imagen'] ?>" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title"><?php echo $proyecto['nombre'] ?></h5>
            <p class="card-text"><?php echo $proyecto['descripcion'] ?></p>
          </div>
        </div>
      </div>  
    <?php } ?>
  </div>

  
</body>
</html>