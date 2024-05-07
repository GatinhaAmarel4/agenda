<?php
//incluir o conexao na pagina e todo o seu coteudo 
include 'conexao.php';

if(isset ($_GET['acao']) && $_GET['acao'] == 'excluir') {
    echo "Quer Mesmo Deletar";
    exit;
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>agenda</title>
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
        <h2>Lista de contatos</h2>
        <table border="1">
            <thead>
                <tr>
                    <td>id</td>
                    <td>nome</td>
                    <td>sobrenome</td>
                    <td>Nascimento</td>
                    <td>endereco</td>
                    <td>telefone</td>
                    <td>Ações</td>
                </tr>
            </thead>
            <tbody>
                <?php
                //abrir a conexao com o banco de dados
                $conexaoComBanco = abrirbanco();
                //Preparar a consulta SQL para selecionar dados no BD
                $sql = "SELECT id, nome, sobrenome, nascimento, endereco, telefone
            From pessoas";
                // executar o query (o SQL do banco)
                $result = $conexaoComBanco->query($sql);

                // echo "<pre>";
                // print_r($registros);
                // echo "</pre>";
                // exit;
                //$registros = $result->fetch_assoc();
                //verificar se a query retornou registros
                if ($result->num_rows > 0) {
                    //ha registro no banco
                    while ($registro = $result->fetch_assoc()) {
                ?>
                        <tr>
                            <td><?= $registro['id'] ?></td>
                            <td><?= $registro['nome'] ?></td>
                            <td><?= $registro['sobrenome'] ?></td>
                            <td><?= date("d/m/Y", strtotime($registro['nascimento'])) ?></td>
                            <td><?= $registro['endereco'] ?></td>
                            <td><?= $registro['telefone'] ?></td>
                            <td>
                                <a href="#"><button>Editar</button></a>
                                <a href="?acao=excluir&=<?= $registro['id']?>"
                                onclick="confirm('tem certezaque deseja excluir');">
                                ><button>Excluir</button></a>
                            </td>
                        </tr>
                    <?php

                    }
                } else {
                    ?>
                    <!-- nao tem registro no banco -->

                    <tr>
                        <td colspan='7'>Nenhum Resgistro no banco de dados</td>
                    </tr>
                <?php
                }


                //criar um laço de repetição para preencher a tabela
                ?>

            </tbody>
        </table>

    </section>
</body>

</html>