<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php'
?>
<br>   

   
            <br>

            <?php if($mensaje!=""){?>
              <div class="alert alert-success">
             <?php echo $mensaje; ?>
             <a href="mostrarCarrito.php" class="btn btn-success btn-sm">Ver carrito(<?php
                    echo (empty ($_SESSION['CARRITO']))?0:count($_SESSION['CARRITO']);
                    ?>)</a>
              </div>
          <?php }?>

        <h1 class="PLOMERIA">Combos Individuales</h1>
        <div class="row">
            <?php

            $setencia=$pdo->prepare("SELECT * FROM `combosindividuales`");
            $setencia->execute();
            $listaproductos=$setencia->fetchAll(PDO::FETCH_ASSOC);
           // print_r($listaproductos);
            ?>

            <?php foreach($listaproductos as $producto){ ?>
                <div class="col-3">
                    <br>
                <div class="card">
                    <img

                    title="<?php echo $producto['Nombre'];?>"
                    alt="<?php echo $producto['Nombre'];?>"
                    class="card-img-top" 
                    src="<?php echo $producto['Imagen'];?>"
                    data-bs-toggle="popover"
                    data-trigger="click"
                    data-content="<?php echo $producto['Descripcion'];?>"
                    height="200"
                    >
                    <div class="card-body">
                        <span><?php echo $producto['Nombre'];?></span>
                        <h5 class="card-title">$RD <?php echo $producto['Precio'];?></h5>
                     

                        <form action="" method="post">
                            <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['ID'],COD,KEY);?>">
                            <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['Nombre'],COD,KEY);?>">
                            <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['Precio'],COD,KEY);?>">
                            <input type="number" name="cantidad" id="cantidad" value="1" min="1" max="99" placeholder="Cantidad" required style="width:146px;height:21px">
                        <button class="btn btn-primary" 
                        name="btnAccion" 
                        value="agregar" 
                        type="submit"
                        >
                        Agregar al carrito</button>
                        
                        </form>

                        
                    </div>
                </div>
            </div>
        <?php }?>


<script>
$(document).ready(function(){
  $('[data-bs-toggle="popover"]').popover();   
});
</script>

<?php
include 'templates/pie.php';
?>