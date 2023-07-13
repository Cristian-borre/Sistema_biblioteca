<?php
require_once('index.php');
use Controller\LibrosController;
require_once(__DIR__.'/vendor/autoload.php');
?>
<div class="container-fluid">
    <div class="row gy-3 my-3">
        <?php 
            $libros = LibrosController::GetAllLibro($_SESSION['token']);
            if($libros['message'] == 'Libros listados'){
                foreach($libros['data'] as $libro){ ?>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card border mb-4">
                    <img height="300" class="border card-img-top" src="./upload/<?php echo $libro['img'] ?>" alt="Libro image">
                    <form action="./addprestamoscontroller" method="POST">
                        <div class="card-body">
                            <h3 class="card-text"><?php echo $libro['titulo']?></h3>
                            <p class="card-text"><b>Autor:</b> <?php echo $libro['autor']?></p>
                            <p class="card-text"><b>Categoria:</b> <?php echo $libro['categoria']?></p>
                            <p class="card-text"><b>Editorial:</b> <?php echo $libro['editorial']?></p>
                            <p class="card-text"><b>Encuadernado:</b> <?php echo $libro['encuadernado']?></p>
                            <input type="hidden" value="<?php echo $_SESSION['user_id'] ?>" name="persona">
                            <input type="hidden" value="<?php echo $_SESSION['token'] ?>" name="token">
                            <input type="hidden" value="<?php echo date('Y-m-d') ?>" name="fecha">
                            <input type="hidden" value="<?php echo $libro['id'] ?>" name="libro">
                            <input type="hidden" value="3" name="estado">
                            <input type="hidden" value="./libros3" name="url">
                            <button type="submit" class="btn btn-info">Reservar</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php }
            }else{?>
                <div class="alert alert-danger">
                  No existen registros
                </div>
            <?php }?>
    </div>
</div>
