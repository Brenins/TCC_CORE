<?php
    require "config.php";
    //validação dos dados
    if ( $_POST ) {
        //recuperar login e senha
        $login = trim( $_POST["login"] ?? NULL );
        $senha = trim ( $_POST["senha"] ?? NULL );
        
        //validar o login e a senha
        if ((empty($login)) or (empty($senha))) {
            //mostrar um erro na tela
            ?>
            <script>
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Preencha o campo login e o campo senha',
              }).then((result) => {
                 history.back(); 
              })
            </script>
            <?php
            exit;
        }

        //selecionar os dados do banco
        $sql = "select usuario_id,login, senha 
            from usuario
            where login = :login AND ativo = '1'
            limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":login", $login);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        //verificar se trouxe resultado
        if ( !isset( $dados->usuario_id ) ) {
            mensagemErro("Usuário não encontrado ou inativado");
        } else if ( !password_verify($senha,$dados->senha)){
            mensagemErro("Senha incorreta");
        }

        //guardar as informações na sessao
        $_SESSION["usuario"] = array("id"=>$dados->usuario_id,
            "login"=>$dados->login);
        //direcionar para uma página home
        echo "<script>location.href='home.php';</script>";
        exit;

    } // fim do POST

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@100;200;300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="icon" type="image/x-icon" href="images/represt.ico">
    <link rel="stylesheet" href="css/telaLogin.css">
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <title>REPREST - LOGIN</title>
</head>
<body>
    <div class="main">
        <div class="card-login shadow rounded-4">
            <div class="logo">
                <img src="images/logoteste1.png" alt="logo" srcset="">
            </div>

            <form name="formLogin" method="post" data-parsley-validate="" class="form-label">
                <label for="login" class="form-label"><h4><i class="bi bi-person-circle"></i> Usuario</h3></label>
                <input type="text" id="login" class="form-control"  name="login" required
                data-parsley-required-message="Por favor preencha seu usuario">
                <label for="senha" class="form-label"><h4><i class="bi bi-key"></i> Senha</h4></label>
                <input type="password" id="senha" class="form-control" name="senha" required 
                data-parsley-required-message="Por favor preencha sua senha">
                <div class="botaos">
                <button type="submit" class="btn btn-success rounded-pill"><i class="bi bi-box-arrow-in-right"></i> Efetuar Login</button>
            </div>
            </form>
        </div>
    </div>
</body>
</html>