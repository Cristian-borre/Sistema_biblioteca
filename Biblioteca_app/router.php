<?php 
    namespace Url;
    require_once(__DIR__.'/vendor/autoload.php'); 
    use Core\Router;
    $router = new Router();

    $router->mount('', function() use ($router) {
        // ===== Login ===== //
        $router->post('/entrar', function() {   
            require_once('./controller/LoginController.php');
        });
        // ===== URL VISTAS ===== //
        $router->get('/login', function() {   
            require_once('./login.php');
        });
        $router->get('/dashboard', function() {   
            require_once('./dashboard.php');
        });
        $router->get('/prestamos', function() {   
            require_once('./prestamos.php');
        });
        $router->get('/prestamos2', function() {   
            require_once('./prestamos2.php');
        });
        $router->get('/libros', function() {   
            require_once('./libros.php');
        });
        $router->get('/libros2', function() {   
            require_once('./libros2.php');
        });
        $router->get('/libros3', function() {   
            require_once('./libros3.php');
        });
        $router->get('/categoria', function() {   
            require_once('./categoria.php');
        });
        $router->get('/encuadernado', function() {   
            require_once('./encuadernacion.php');
        });
        $router->get('/editorial', function() {   
            require_once('./editorial.php');
        });
        $router->get('/autores', function() {   
            require_once('./autores.php');
        });
        $router->get('/personas', function() {   
            require_once('./personas.php');
        });
        $router->get('/usuarios', function() {   
            require_once('./usuarios.php');
        });
        $router->get('/salir', function() {   
            require_once('./salir.php');
        });
        $router->get('/index', function() {   
            require_once('./index.php');
        });
        // ===== FIN URL VISTAS ===== //

        // ===== URL FUNCIONES ===== //
        // USUARIO
        $router->post('/addusuariocontroller', function() {   
            require_once('./controller/usuario/AddUsuarioController.php');
        });
        $router->post('/editusuariocontroller', function() {   
            require_once('./controller/usuario/EditUsuarioController.php');
        });
        $router->get('/deleteusuariocontroller', function() {   
            require_once('./controller/usuario/DeleteUsuarioController.php');
        });
        // CATEGORIA
        $router->post('/addcategoriacontroller', function() {   
            require_once('./controller/categoria/AddCategoriaController.php');
        });
        $router->post('/editcategoriacontroller', function() {   
            require_once('./controller/categoria/EditCategoriaController.php');
        });
        $router->get('/deletecategoriacontroller', function() {   
            require_once('./controller/categoria/DeleteCategoriaController.php');
        });
        // AUTORES
        $router->post('/addautorescontroller', function() {   
            require_once('./controller/autor/AddAutoresController.php');
        });
        $router->post('/editautorescontroller', function() {   
            require_once('./controller/autor/EditAutoresController.php');
        });
        $router->get('/deleteautorescontroller', function() {   
            require_once('./controller/autor/DeleteAutoresController.php');
        });
        // LIBROS
        $router->post('/addlibroscontroller', function() {   
            require_once('./controller/libro/AddLibrosController.php');
        });
        $router->post('/editlibroscontroller', function() {   
            require_once('./controller/libro/EditLibrosController.php');
        });
        $router->get('/deletelibroscontroller', function() {   
            require_once('./controller/libro/DeleteLibrosController.php');
        });
        // PRESTAMOS
        $router->post('/addprestamoscontroller', function() {   
            require_once('./controller/prestamo/AddPrestamosController.php');
        });
        $router->post('/editprestamocontroller', function() {   
            require_once('./controller/prestamo/EditPrestamoController.php');
        });
        $router->get('/editestadoprestamocontroller', function() {   
            require_once('./controller/prestamo/EditEstadoPrestamoController.php');
        });
        // EDITORIAL
        $router->post('/addeditorialcontroller', function() {   
            require_once('./controller/editorial/AddEditorialController.php');
        });
        $router->post('/editeditorialcontroller', function() {   
            require_once('./controller/editorial/EditEditorialController.php');
        });
        $router->get('/deleteeditorialcontroller', function() {   
            require_once('./controller/editorial/DeleteEditorialController.php');
        });
        // ENCUADERNADO
        $router->post('/addencuadernadocontroller', function() {   
            require_once('./controller/encuadernado/AddEncuadernadoController.php');
        });
        $router->post('/editencuadernadocontroller', function() {   
            require_once('./controller/encuadernado/EditEncuadernadoController.php');
        });
        $router->get('/deleteencuadernadocontroller', function() {   
            require_once('./controller/encuadernado/DeleteEncuadernadoController.php');
        });
    });
    $router->set404(function() {
        header('HTTP/1.1 404 Not Found');
        echo "ERROR 404 . La pagina no existe";
    });
    $router->run();
