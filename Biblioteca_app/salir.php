<?php 
    namespace Controller;
    require_once(__DIR__.'/vendor/autoload.php'); 
    use Core\Core;
    session_start();
    if(isset($_SESSION)){
        session_unset();
        session_destroy();            
        Core::redir_log("./login");
    }

?>