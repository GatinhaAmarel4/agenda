<?php

// criar constante para amarzenar as informações de acesso ao banco de dados//
define ("DB_HOST","localhost");
define ("DB_USER","root");
define ("DB_PASS","");
define ("DB_NAME","agenda");
define ("DB_PORT",3306);

/**
 * Abre uma conexao com o banco de dados e retornaum objeto de conexao 
 * @return mysqli que é o objeto de conexao 
 */
function abrirbanco(){
    $conexaoComBanco = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

    //verificar se ocorreu algum erro durante a conexao
    if ($conexaoComBanco->connect_error) {
        die("falha na conexão: ". $conexaoComBanco->connect_error);
       
        $id = $_GET['id'];
        if($id > 0){
            //abrir conexao com o banco
            $conexaoComBanco = abrirbanco();
            //preparar um sql de exclusao 
            $sql = "DELETE FROM pessoas WHERE id = $id";
            //executar comando de banco 
            if ($conexaoComBanco->query ($sql) === TRUE){
                echo "<script>alert('contato excluido com sucesso!')</script>";
            } else {
                echo "contato excluido com sucesso! :(";
            }
            }
        }
        return $conexaoComBanco;
    }

   

function fecharBanco($conexaoComBanco) {
    $conexaoComBanco->close();
}

?>