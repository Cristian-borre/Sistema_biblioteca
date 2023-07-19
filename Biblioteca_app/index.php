<?php

namespace index;

use Core\Core;

require_once(__DIR__ . '/vendor/autoload.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="asset/js/sweetalert2.all.js"></script>
    <link rel="stylesheet" type="text/css" href="asset/DataTables/datatables.min.css" />
    <script type="text/javascript" src="asset/DataTables/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <?php session_start();
    if (isset($_SESSION['token'])) {

        if ($_SESSION['cargo'] == 1) { ?>
            <i class="text-4xl cursor-pointer md:hidden icon text-white fixed p-4 bx bx-menu-alt-left"></i>
            <div class="fixed bg-[#1E1A34] sidebar z-10 h-full w-0 hidden md:block md:w-[240px]">
                <div class="flex h-full flex-col">
                    <div class="flex w-full justify-center justify-around items-center h-16 border-b-2 border-gray-500">
                        <h2 class="ml-14 md:ml-0 text-white font-semibold text-4xl">Menu</h2>
                        <i class="text-white md:hidden close text-3xl cursor-pointer ml-4 bx bx-x"></i>
                    </div>
                    <div class="grow mt-10 flex flex-col">
                        <a href="./dashboard" class="text-white h-14 mb-4 py-3 pl-6 text-xl hover:bg-[#4B3F87] bx bxs-dashboard"> Dashboard</a>
                        <a href="./prestamos" class="text-white h-14 mb-4 py-3 pl-6 text-xl hover:bg-[#4B3F87] bx bx-spreadsheet"> Prestamos</a>
                        <a class="text-white cursor-pointer h-14 mb-4 py-3 pl-6 text-xl hover:bg-[#4B3F87] bx bx-book-bookmark a-click"> Biblioteca <i class="bx bx-chevron-down l-arrow"></i></a>
                        <ul class="h-0 flex flex-col submenu hidden">
                            <a href="./libros" class="text-white h-10 mb-2 py-2 text-xl hover:bg-[#4B3F87] pl-14 bx bx-book"><small> Libros</small></a>
                            <a href="./autores" class="text-white h-10 mb-2 py-2 text-xl hover:bg-[#4B3F87] pl-14 bx bx-pencil"><small> Autores</small></a>
                            <a href="./categoria" class="text-white h-10 mb-2 py-2 text-xl hover:bg-[#4B3F87] pl-14 bx bx-category"><small> Categoria</small></a>
                            <a href="./editorial" class="text-white h-10 mb-2 py-2 text-xl hover:bg-[#4B3F87] pl-14 bx bx-bookmark-alt"><small> Editorial</small></a>
                            <a href="./encuadernado" class="text-white h-10 mb-2 py-2 text-xl hover:bg-[#4B3F87] pl-14 bx bx-book-alt"><small>Encuadernado</small></a>
                        </ul>
                        <a href="./personas" class="text-white h-14 mb-4 py-3 pl-6 text-xl hover:bg-[#4B3F87] bx bx-user"> Personas</a>
                        <a href="./usuarios" class="text-white h-14 mb-4 py-3 pl-6 text-xl hover:bg-[#4B3F87] bx bx-user-circle"> usuarios</a>
                    </div>
                    <div class="border-t-2 border-gray-500">
                        <a href="./salir" class="text-white w-full h-14 mb-4 py-3 pl-6 text-xl hover:bg-[#4B3F87] bx bx-exit"> Salir</a>
                    </div>
                </div>
            </div>

            <script src="app.js"></script>
            <script src="/asset/js/datatable.js"></script>

        <?php } else if ($_SESSION['cargo'] == 2) { ?>

            <i class="text-4xl cursor-pointer md:hidden icon text-white fixed p-4 bx bx-menu-alt-left"></i>
            <div class="fixed bg-[#1E1A34] sidebar z-10 h-full w-0 hidden md:block md:w-[240px]">
                <div class="flex h-full flex-col">
                    <div class="flex w-full justify-center justify-around items-center py-6 border-b-2 border-gray-500">
                        <h2 class="ml-14 md:ml-0 text-white font-semibold text-4xl">Menu</h2>
                        <i class="text-white md:hidden close text-3xl cursor-pointer ml-4 bx bx-x"></i>
                    </div>
                    <div class="grow mt-10 flex flex-col">
                        <a href="./prestamos2" class="text-white h-14 mb-4 py-3 pl-6 text-xl hover:bg-[#4B3F87] bx bx-spreadsheet"> Prestamos</a>
                        <a href="./libros2" class="text-white h-14 mb-4 py-3 pl-6 text-xl hover:bg-[#4B3F87] bx bx-book"> libros</a>
                        <a href="./personas" class="text-white h-14 mb-4 py-3 pl-6 text-xl hover:bg-[#4B3F87] bx bx-user"> Personas</a>
                    </div>
                    <div class="py-4 border-t-2 border-gray-500">
                        <a href="./salir" class="text-white w-full h-14 mb-4 py-3 pl-6 text-xl hover:bg-[#4B3F87] bx bx-exit"> Salir</a>
                    </div>
                </div>
            </div>

            <script src="app.js"></script>
            <script src="/asset/js/datatable.js"></script>

        <?php } else if ($_SESSION['cargo'] == 3) { ?>

            <nav class="bg-[#1E1A34] h-14 flex justify-between text-white">
                <h2 class="mt-3 mx-5 text-2xl">Lista de Libros</h2>
                <a href="./salir" class="text-white bx bx-exit mx-5 text-xl py-3 px-5 rounded-xl hover:bg-[#4B3F87]"> Salir</a>
            </nav>
        <?php
        }
    } else { ?>
        <?php
        require_once(__DIR__ . '/vendor/autoload.php');
        session_start();
        if (isset($_SESSION)) {
            session_unset();
            session_destroy();
            Core::redir_log("./login");
        }
        ?>
    <?php } ?>

    <script src="asset/js/datatable.js" crossorigin="anonymous"></script>
</body>

</html>