<?php
include 'global/config.php';
include 'carrito.php';
include 'templates/cabecera.php'
?>

<br>
<br>
<h2><center>Lista del carrito<center></h2>
<br>
<?php if(!empty($_SESSION['CARRITO'])) {?>
<table class="table table-light table-bordered">
    <tbody>
        <tr>
            <th width="25%">Descripción</th>
            <th width="10%" class="text-center">Cantidad</th>
            <th width="10%" class="text-center">Precio</th>
            <th width="15%" class="text-center">Subtotal</th> 
            <th width="15%" class="text-center">ITBIS</th> 
            <th width="5%">--</th>
        </tr>

        <?php $total=0; ?>

        <?php foreach($_SESSION['CARRITO'] as $indice=>$producto){?>

        <tr>
            <td width="25%"><?php echo $producto['NOMBRE']?></td>
            <td width="10%" class="text-center"><?php echo $producto['CANTIDAD']?></td>
            <td width="10%" class="text-center">$RD <?php echo $producto['PRECIO']?></td>
            <td width="15%" class="text-center">$RD <?php echo number_format($producto['PRECIO']*$producto['CANTIDAD'],0);?></td>
            <td width="15%" class="text-center">$RD <?php echo number_format($producto['PRECIO']*$producto['CANTIDAD']*0.18,0);?></td>
            <td width="5%"> 

            <form action="" method="post">

            <input type="hidden" 
            name="id" 
            id="id" value="<?php echo openssl_encrypt($producto['ID'],COD,KEY);?>">

            <button 
            class="btn btn-danger" 
            type="submit"
            name="btnAccion"
            value="Eliminar"
            >Eliminar</button> </td>
            </form>
        </tr>
        <?php $total=$total+($producto['PRECIO']*$producto['CANTIDAD']*0.18+$producto['PRECIO']*$producto['CANTIDAD']);?>
        <?php } ?>


        <tr>
            <td colspan="4" align="right"><h3>Total:</h3></td>
            <td align="right"><h3>$RD <?php echo number_format($total,0);?></h3></td>
            <td></td>
        </tr>
        
        <tr>
            <td colspan="6">
                <form action="pagar.php" method="post">
                <div class="alert alert-success">

                <div class="form-group">
                     <label for="my-input" id="datos">Datos de envio:</label>
                       <input id="nombre" name="nombre" 
                       class="form-control"
                       type="text"
                       placeholder="Nombre completo" 
                       required>
                </div>

                <div class="form-group">
                       <input id="email" name="email" 
                       class="form-control"
                       type="email"
                       placeholder="Correo" 
                       required>
                </div>


                <div class="form-group">
                       <input id="Numero" name="Numero" 
                       class="form-control"
                       type="number"
                       placeholder="Numero de telefono" 
                       required>
                </div>


                <div class="form-group">
                       <input id="Direccion" name="Direccion" 
                       class="form-control"
                       type="text"
                       placeholder="Direccion" 
                       required>
                </div>


                  <small id="emailHelp"
                  class="form-text text-muted"
                  >
               
                  </small>
            </div>
               <button class="btn btn-primary btn-lg btn-block w-100" type="submit" 
                  name="btnAccion"
                  value="proceder">
                  Proceder a pagar >>
                </button>

            </form>

        
    <?php }else{ ?>
        <div class="alert alert-success" role="alert">
        No hay productos en el carrito...
        </div>
        <div class="dropdown">
        <a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
              Puedes ir a comprar por categorias en:
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <a class="dropdown-item" href="plomeria.php">Plomería</a>
          <a class="dropdown-item" href="electrico.php">Eléctrico</a>
          <a class="dropdown-item" href="iluminacion.php">Iluminacíon</a>
          <a class="dropdown-item" href="carpinteria.php">Carpintería</a>
        </div>
        </div>
    <?php } ?>
    
<?php include 'templates/pie.php';?>