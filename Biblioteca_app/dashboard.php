<?php
require_once('index.php');
require_once(__DIR__ . '/vendor/autoload.php');

use Controller\PrestamosController;
use Controller\UsuarioController;
use Controller\LibrosController;
?>

<div class="ml-0 md:ml-[240px]">
    <div class="bg-[#1E1A34] w-full h-16 shadow-xl border-l-2 border-b-2 border-gray-400 grid place-items-center text-2xl font-semibold text-white">Dashboard</div>
    <div class="mt-4 md:p-2 lg:p-4 xl:p-10 grid grid grid-rows-4 h-full">
        <div class="p-4 grid grid-cols-1 sm:grid-cols-2 row-span-1 lg:grid-cols-3 gap-6">
            <div class="rounded border border-l-2 border-l-[#1E1A34] border-gray-300 overflow-hidden shadow-2xl">
                <div class="px-4 py-4 flex">
                    <i class="bx bx-bar-chart text-green-500 text-6xl mr-4"></i>
                    <div class="font-semibold mb-2 flex flex-col">
                        <?php
                        $prestamos = PrestamosController::GetCountPrestamos($_SESSION['token']);
                        ?>
                        <?php
                        if ($prestamos['message'] == 'Prestamos contados') {
                            $data = $prestamos['data'] ?>
                            <span class="text-xl"><?php echo $data ?></span>
                        <?php
                        } ?>
                        <span class="text-base">Total Prestamos</span>
                    </div>
                </div>
            </div>
            <div class="rounded border border-l-2 border-l-[#1E1A34] border-gray-300 overflow-hidden shadow-2xl">
                <div class="px-4 py-4 flex">
                    <i class="bx bxs-user-badge text-blue-400 text-6xl mr-4"></i>
                    <div class="font-semibold mb-2 flex flex-col">
                        <?php
                        $usuarios = UsuarioController::GetCountPersona($_SESSION['token']);
                        ?>
                        <?php
                        if ($usuarios['message'] == 'Usuarios contados') {
                            $data = $usuarios['data'] ?>
                            <span class="text-xl"><?php echo $data ?></span>
                        <?php
                        } ?>
                        <span class="text-base">Total Lectores</span>
                    </div>
                </div>
            </div>
            <div class="rounded border border-l-2 border-l-[#1E1A34] border-gray-300 overflow-hidden shadow-2xl">
                <div class="px-4 py-4 flex">
                    <i class="bx bx-library text-red-600 text-6xl mr-4"></i>
                    <div class="font-semibold mb-2 flex flex-col">
                        <?php
                        $libro = LibrosController::GetCountLibro($_SESSION['token']);
                        ?>
                        <?php
                        if ($libro['message'] == 'Libros contados') {
                            $data = $libro['data'] ?>
                            <span class="text-xl"><?php echo $data ?></span>
                        <?php
                        } ?>
                        <span class="text-base">Total Libros</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5 h-96 grid grid-cols-1 row-span-3 md:grid-cols-1 lg:grid-cols-3 p-4 gap-6">
            <div class="shadow-xl mt-5 h-full col-span-2">
                <?php
                $data = PrestamosController::GetCountPrestamoReport($_SESSION['token']);
                $jsonData = json_encode($data['data']);
                ?>
                <canvas id="myChartLine"></canvas>
                <script>
                    var data = <?php echo $jsonData; ?>;
                </script>
                <script src="./asset/js/ChartLine.js"></script>
            </div>
            <div class="shadow-xl mt-5 h-full w-full">
                <?php
                $data = PrestamosController::GetCountPrestamoLibro($_SESSION['token']);
                $jsonData = json_encode($data['data']);
                ?>
                <canvas id="myChartPie"></canvas>
                <script>
                    var datos = <?php echo $jsonData; ?>;
                </script>
                <script src="./asset/js/ChartPie.js"></script>
            </div>
        </div>
    </div>
</div>