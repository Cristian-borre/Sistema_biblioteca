<?php

namespace index;

require_once(__DIR__ . '/vendor/autoload.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="asset/js/sweetalert2.all.js"></script>
    <title>BIBLIOTECA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#1E1A34] h-screen flex justify-center">
    <div class="bg-white h-96 w-72 sm:w-96 shadow-2xl rounded-2xl mt-48 ">
        <form action="./entrar" method="post">
            <div class="flex flex-col h-96 px-6 py-10 sm:py-12 sm:px-10">
                <div class="grid place-items-center">
                    <div class="flex">
                        <i class="text-3xl bx bxs-user"></i>
                        <h2 class="font-semibold text-2xl ml-4"> INICIAR SESION</h2>
                    </div>
                </div>
                <div class="grow flex flex-col justify-center">
                    <label class="font-semibold text-base">Usuario</label>
                    <input type="text" class="bg-gray-100 mb-5 py-1 border border-gray-300 rounded-md" name="usuario">
                    <label class="font-semibold text-base">Contraseña</label>
                    <input type="text" class="bg-gray-100 py-1 border border-gray-300 rounded-md" name="password">
                </div>
                <div class="grid place-items-center">
                    <button class="bg-[#1E1A34] text-white py-2 font-semibold px-4 rounded-md hover:bg-[#4B3F87]" type="submit">INGRESAR</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>