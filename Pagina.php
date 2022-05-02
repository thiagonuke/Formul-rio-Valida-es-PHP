<?php
$erroNome="";
$erroEmail="";
$erroSenha="";
$erroRepetesenha="";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Se estiver vazio
    if(empty($_POST['nome'])){
        $erroNome = "Por favor, preencha um nome";
    }else{
        //Pegar o valor e limpar
        $nome = $_POST['nome'];
        //Verificar se tem apenas letras
        if(!preg_match("/^[a-zA-Z-' ]*$/", $nome)){
            $erroNome = "Apenas aceitamos letras e espaços em branco!";
        }
    }

    if(empty($_POST['email'])){
        $erroEmail = "Por favor, preencha o email";

    }else{
        $email = limpaPost($_POST['email']);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $erroEmail = "E-mail inválido!";
        }
    }

    if(empty($_POST['senha'])){
        $erroSenha = "Por favor, preencha a senha";

    }else{
        $senha = limpaPost($_POST['senha']);
        if(strlen($senha < 6)){
            $erroSenha = "Senha muito curta, precisa ter no mínimo 6 digitos";
        }
    }
    // Repete senha
    if(empty($_POST['repete_senha'])){
        $erroRepetesenha = "Por favor, preencha a repetição da senha";

    }else{
        $repete_senha = limpaPost($_POST['repete_senha']);
        if($repete_senha !== $senha){
            $erroRepetesenha = "As senhas não são iguais!";
        }   
    }

    if(($erroNome == "") && ($erroEmail == "") && ($erroSenha == "") && ($erroRepetesenha =="")){
        header('Location: obrigado.php');
    }
}
    

function limpaPost($valor){
    $valor = trim($valor);
    $valor = stripslashes($valor);
    $valor = htmlspecialchars($valor);

    return $valor;
}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <header class="cabecalho">

    </header>
    <section class="container">
        <div class="conteudo">
            <form class="formulario" method="post">
                <h1>Preencha os dados:</h1>
                <label for="">Nome:</label>
                <input type="text" name="nome" <?php if (isset($_POST['nome'])) {echo "value='" .$_POST['nome']."'";} ?> placeholder="Digite seu nome:">
                <br> <span class="erro"><?php echo $erroNome; ?></span>
                <label for="">Email</label>
                <input type="text" name="email" placeholder="Digite seu email:">
                <br> <span class="erro"><?php echo $erroEmail; ?></span>
                <label for="">Senha</label>
                <input type="number" name="senha" placeholder="Digite sua senha">
                <br> <span class="erro"><?php echo $erroSenha; ?></span>
                <label for="">Repita sua senha</label>
                <input type="number" name="repete_senha" placeholder="Repita senha">
                <br> <span class="erro"><?php echo $erroRepetesenha; ?></span>
                <input type="submit" class="btn" value="Enviar">
            </form>
        </div>
        <img src="img/Ender_Dragon.png" alt="" width="200px">
    </section>

    <footer class="rodape">

    </footer>
</body>
</html>




