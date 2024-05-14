<?php
include_once'conexao.php';
include_once 'funcoes.php';

if (isset($_GET['acao']) && $_GET['acao'] == 'editar'){
 
    //if ternário
    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    //vamos abrir conexao com o banco de dados 
    $conexaoComBanco = abrirBanco();

    $sql = "UPDATE pessoas SET nome = '$nome', sobrenome = '$sobrenome',
     nascimento = '$nascimento', telefone = '$telefone'
     WHERE id = $id";
    //preparar a sql para construir o id banco de dados
    $pegarDados = $conexaoComBanco->prepare($sql);
    //substituir a ?????
    $pegarDados->bind_param("1", $id);
    $pegarDados->execute();
    $reult = $pegarDados->get_result();

    if($result->num_rows == 1){
         $resultado = $pegarDados->fetch_assoc();

    } else {
        echo "nenhum registro encontrado";
        exit;
    }

    $pegarDados->close();
    fecharBanco($conexaoComBanco);

   
}

// echo "<pre>";
// print_r($_SERVER);
// echo "</pre>";
// exit;

//capturar os dados digitalizados no form e salva em variaveis
//para facilitar a manipulação dos dados



?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>agenda</title>
    <link rel="stylesheet" href="css/cadastrar.css">
</head>

<body>
    <header>
        <h1>Agenda de contatos</h1>
    
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="cadastrar.php">cadastrar</a></li>
        </ul>

    </nav>
</header>
<section>
    <h2>Atualizar Contato</h2>
<!-- action = envio,  method = metodo de envio -->
    <form action="" method="POST" enctype="multipart/form-data">

        <label for = "nome">Nome</label>
        <input type="text" id="nome" name="nome" values="<?= $registro['nome']?>" required>

        <label for = "sobrenome">Sobrenome</label>
        <input type="text" id="sobrenome" name="sobrenome" values="<?= $registro['sobrenome']?>" required>

        <label for = "nascimento"> nascimento</label>
        <input type="date" id="nascimento" name="nascimento" values="<?= $registro['nasciemnto']?>" required>

        <label for = "endereco">Endereco</label>
        <input type="text" id="endereco" name="endereco" values="<?= $registro['endereco']?>" required>

        <label for = "telefone">Telefone</label>
        <input type="text" id="telefone" name="telefone" values="<?= $registro['telefone']?>" required>

        <input type="hidden" id="id" name="id" value="<?= $registro['id'] ?>">

        <button type="submit">Atualizar</button>

        </form>
    </section>


</body>

</html>