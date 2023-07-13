<?php
namespace index;
use Core\Core;
require_once(__DIR__.'/vendor/autoload.php'); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="asset/css/menu.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="./asset/css/content.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="asset/font/css/font-awesome.min.css">
    <script src="asset/js/sweetalert2.all.js"></script>
    <link rel="stylesheet" type="text/css" href="asset/DataTables/datatables.min.css"/>
    <script type="text/javascript" src="asset/DataTables/datatables.min.js"></script>

</head>
<body>
<?php session_start();
    if(isset($_SESSION['token'])){
        
        if($_SESSION['cargo'] == 1){ ?>

            <div class="wrapper">
                    <div class="sidebar">
                        <h2>Menu</h2>
                        <ul>
                            <li><a href="./prestamos" class="bx bx-spreadsheet a-click"> Prestamos</a>
                            </li>
                            <li><a href="#" class="bx bx-book-bookmark a-click"> Biblioteca <i class="bx bx-chevron-down l-arrow"></i></a>
                                <ul class="submenu">
                                    <li><a href="./libros" class="bx bx-book"><small> Libros</small></a></li>
                                    <li><a href="./autores" class="bx bx-pencil"><small> Autores</small></a></li>
                                    <li><a href="./categoria" class="bx bx-category"><small> Categoria</small></a></li>
                                    <li><a href="./editorial" class="bx bx-bookmark-alt"><small> Editorial</small></a></li>
                                    <li><a href="./encuadernado" class="bx bx-book-alt"><small>Encuadernado</small></a></li>
                                </ul>
                            </li>
                            <li><a href="./personas" class="bx bx-user"> Personas</a></li>
                            <li><a href="./usuarios" class="bx bx-user-circle"> usuarios</a></li>
                            <li><a href="./salir" class="bx bx-exit"> Salir</a></li>
                        </ul>
                    </div>
            </div>
            <script src="app.js"></script>
            <script src="/asset/js/datatable.js"></script>

        <?php }else if($_SESSION['cargo'] == 2){ ?>

            <div class="wrapper">
                <div class="sidebar">
                    <h2>Menu</h2>
                    <ul>
                        <li><a href="./prestamos2" class="bx bx-spreadsheet"> Prestamos</a></li>
                        <li><a href="./libros2" class="bx bx-book"> Libros</a></li>
                        <li><a href="./personas" class="bx bx-user"> Personas</a></li>
                        <li><a href="./salir" class="bx bx-exit"> Salir</a></li>
                    </ul>
                </div>
            </div>
                
            <script src="app.js"></script>
            <script src="/asset/js/datatable.js"></script>

        <?php }else if($_SESSION['cargo'] == 3){ ?>

            <nav class="navbar flex text-white" style="background: #594f8d;">
                <h2 class="mx-5">Lista de Libros</h2>
                <a href="./salir" class="btn text-white bx bx-exit mx-5"> Salir</a>
            </nav>
    <?php
    }
    }else{ ?>
    <?php
    require_once(__DIR__.'/vendor/autoload.php'); 
    session_start();
    if(isset($_SESSION)){
        session_unset();
        session_destroy();            
        Core::redir_log("./login");
    }
    ?>
    <?php } ?>

    <script src="asset/js/datatable.js" crossorigin="anonymous"></script>
</body>
</html>