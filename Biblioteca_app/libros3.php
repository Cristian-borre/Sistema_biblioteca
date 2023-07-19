<?php
require_once('index.php');

use Controller\LibrosController;

require_once(__DIR__ . '/vendor/autoload.php');
?>
<div class="p-4">
    <div class="grid place-items-center grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
        <?php
        $libros = LibrosController::GetAllLibro($_SESSION['token']);
        if ($libros['message'] == 'Libros listados') {
            foreach ($libros['data'] as $libro) { ?>
                <div class="rounded-lg w-72 overflow-hidden shadow-lg">
                    <img class="w-80 h-72 rounded-t-lg" src="./upload/<?php echo $libro['img'] ?>" alt="Libro image">
                    <form action="./addprestamoscontroller" method="POST">
                        <div class="px-6 py-4">
                            <h3 class="text-gray-700 font-bold text-xl mb-2"><?php echo $libro['titulo'] ?></h3>
                            <p class="text-gray-700 text-base"><b>Autor:</b> <?php echo $libro['autor'] ?></p>
                            <p class="text-gray-700 text-base"><b>Categoria:</b> <?php echo $libro['categoria'] ?></p>
                            <p class="text-gray-700 text-base"><b>Editorial:</b> <?php echo $libro['editorial'] ?></p>
                            <p class="text-gray-700 text-base"><b>Encuadernado:</b> <?php echo $libro['encuadernado'] ?></p>
                            <input type="hidden" value="<?php echo $_SESSION['user_id'] ?>" name="persona">
                            <input type="hidden" value="<?php echo $_SESSION['token'] ?>" name="token">
                            <input type="hidden" value="<?php echo date('Y-m-d') ?>" name="fecha">
                            <input type="hidden" value="<?php echo $libro['id'] ?>" name="libro">
                            <input type="hidden" value="3" name="estado">
                            <input type="hidden" value="./libros3" name="url">
                        </div>
                        <div class="grid place-items-center mb-4">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 mt-2 font-semibold rounded-lg">Reservar</button>
                        </div>
                    </form>
                </div>
            <?php }
        } else { ?>
            <div class="alert alert-danger">
                No existen registros
            </div>
        <?php } ?>
    </div>
</div>