<?php
require_once('index.php');
use Controller\UsuarioController;
require_once(__DIR__.'/vendor/autoload.php'); 
?>

<div class="main_content">
    <div class="container">
        <div class="">
            <div class="container">
                <div id="menu_tabla_ingresos" class="header text-center text-dark">Lista de Persona </div>
                <br>
                <table class="table table-bordered" id="tabla_ingresos">
                    <thead class="table-primary">
                        <tr>
                            <th>Documento</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                            <th>Telefono</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $usuarios = UsuarioController::GetAllPersona($_SESSION['token']);
                        ?>
                        <?php
                    if($usuarios['message'] == 'Usuarios listados'){
                        foreach($usuarios['data'] as $usuario) {?>
                    <tr>
                    <form class="form-inline">
                        <td class="text-center"><?php echo $usuario['documento'] ?></td>
                        <td class="text-center"><?php echo $usuario['nombre'] ?></td>
                        <td class="text-center"><?php echo $usuario['apellido'] ?></td>
                        <td class="text-center"><?php echo $usuario['email'] ?></td>
                        <td class="text-center"><?php echo $usuario['telefono'] ?></td>
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
