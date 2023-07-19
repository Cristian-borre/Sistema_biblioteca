<?php
require_once('index.php');

use Controller\LibrosController;

require_once(__DIR__ . '/vendor/autoload.php');
?>

<div class="ml-0 md:ml-[240px]">
    <div class="bg-[#1E1A34] w-full h-16 shadow-xl border-l-2 border-b-2 border-gray-400 grid place-items-center text-2xl font-semibold text-white">Lista de Libros</div>
    <div class="mt-4 md:p-2 lg:p-4 xl:p-10 h-[620px]">
        <div class="mx-4 lg:mx-4 xl:mx-8 2xl:mx-16 mt-8 h-[500px]">
            <div class="table-auto overflow-x-auto h-[550px]">
                <table class="w-full md:w-full" id="tabla_ingresos">
                    <thead class="bg-blue-200">
                        <tr>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">img</th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">Titulo</th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">Autor</th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">Categoria</th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">Editorial</th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">Encuadernado</th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">Ejemplares</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $libros = LibrosController::GetAllLibro($_SESSION['token']);
                        ?>
                        <?php
                        if ($libros['message'] == 'Libros listados') {
                            foreach ($libros['data'] as $libros) { ?>
                                <tr>
                                    <td class="p-3 text-base border border-gray-300 font-semibold text-gray-800"><img width="50" height="50" src="./upload/<?php echo $libros['img'] ?>" alt=""></td>
                                    <td class="p-3 text-base border border-gray-300 font-semibold text-gray-800 font-bold"><?php echo $libros['titulo'] ?></td>
                                    <td class="p-3 text-base border border-gray-300 font-semibold text-gray-800"><?php echo $libros['autor'] ?></td>
                                    <td class="p-3 text-base border border-gray-300 font-semibold text-gray-800"><?php echo $libros['categoria'] ?></td>
                                    <td class="p-3 text-base border border-gray-300 font-semibold text-gray-800"><?php echo $libros['editorial'] ?></td>
                                    <td class="p-3 text-base border border-gray-300 font-semibold text-gray-800"><?php echo $libros['encuadernado'] ?></td>
                                    <td class="p-3 text-base border border-gray-300 font-semibold text-gray-800"><?php echo $libros['ejemplares'] ?></td>
                                </tr>
                            <?php }
                        } else { ?>
                            <div class="font-bold bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                                No existen registros
                            </div>
                        <?php } ?>
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