<?php 
    session_start();

    require "config.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de e-commerce SubSubMarino">
    <meta name="author" content="">
    
    <title>ADMIN - SubSubmarino</title>

    <base href="<?php echo "http://".$_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"]; ?>">

    <script src="js/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="css/sweetalert2.min.css"></script>
    
</head>

<body>
<?php
    require "funcoes.php";
    
    if ( !isset ( $_SESSION["usuario"] ) ) {
        require "login.php";
    } else {
        $page = "home";

        $pagina = $pasta = "Dashboard";
        $id = NULL;

        if ( isset ( $_GET["param"] ) ) {
            $page = explode("/",$_GET["param"]);
            
            $pasta = $page[0] ?? NULL;
            $pagina = $page[1] ?? NULL;
            $id = $page[2] ?? NULL;

            $page = "{$pasta}/{$pagina}";
        }
        
        $page = "{$page}.php";
        include $page;
    }

?>
</body>