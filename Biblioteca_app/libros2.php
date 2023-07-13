<?php
require_once('index.php');
use Controller\LibrosController;
require_once(__DIR__.'/vendor/autoload.php'); 
?>

<div class="main_content">
    <div class="container mt-3">
        <div class="">
            <div class="container col-xl-13">
                <div id="menu_tabla_ingresos" class="header text-center text-dark">Lista de Libros </div>
                <br>
                <table class="table table-bordered" id="tabla_ingresos">
                    <thead class="table-primary">
                        <tr>
                            <th>img</th>
                            <th>Titulo</th>
                            <th>Autor</th>
                            <th>Categoria</th>
                            <th>Editorial</th>
                            <th>Encuadernado</th>
                            <th>Ejemplares</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $libros = LibrosController::GetAllLibro($_SESSION['token']);
                        ?>
                        <?php
                        if($libros['message'] == 'Libros listados'){
                            foreach($libros['data'] as $libros) {?>
                            <tr>
                        <form class="form-inline" method="POST" action="#">
                            <td class="text-center"><img width="80" height="80" src="./upload/<?php echo $libros['img'] ?>" alt=""></td>
                            <td class="text-center"><?php echo $libros['titulo']?></td>
                            <td class="text-center"><?php echo $libros['autor']?></td>
                            <td class="text-center"><?php echo $libros['categoria']?></td>
                            <td class="text-center"><?php echo $libros['editorial']?></td>
                            <td class="text-center"><?php echo $libros['encuadernado']?></td>
                            <td class="text-center"><?php echo $libros['ejemplares']?></td>
                        </form>
                        </tr>
                        <?php }
                        }else{?>
                        <div class=" alert alert-danger">
                          No existen registros
                        </div>
                        <?php }?>
                    </tbody>
                </table>
                <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
                <!-- Option 2: Separate Popper and Bootstrap JS -->
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
            </div>
        </div>
    </div>
</div>