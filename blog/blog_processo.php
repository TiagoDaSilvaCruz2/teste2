<?php
if (isset($_POST['submit'])) {
    // Inclua os arquivos necessários
    require_once('../BD/configBD.php');
    require_once('upload.php');

    // Configure o fuso horário
    date_default_timezone_set('America/Sao_Paulo');

    // Verifique se os dados do formulário estão presentes e limpe-os, se necessário
    $conteudo = isset($_POST['conteudo']) ? $_POST['conteudo'] : '';
    
    // Verifique se a sessão do usuário está definida antes de usá-la
    if (isset($_SESSION['usuarioID'], $_SESSION['nomeUsuario'], $_SESSION['imgPerfil'])) {
        // Atribua os valores das sessões a variáveis
        $usuarioID = $_SESSION['usuarioID'];
        $nome = $_SESSION['nomeUsuario'];
        $imgPerfil = $_SESSION['imgPerfil'];
        
        // Obtenha a data atual
        $dataAtual = date("Y-m-d");

        // Prepare a declaração SQL
        $stmt = mysqli_prepare($con, "INSERT INTO blog (usuarioID, conteudo, dataPost, nome, imagem, imgPerfil) VALUES (?, ?, ?, ?, ?, ?)");
        
        if ($stmt) {
            // Vincule os parâmetros
            mysqli_stmt_bind_param($stmt, "isssss", $usuarioID, $conteudo, $dataAtual, $nome, $path, $imgPerfil);

            // Execute a query
            $result = mysqli_stmt_execute($stmt);
            
            if ($result) {
                // Redirecione para a página blog.php se a inserção for bem-sucedida
                header("Location: blog.php");
                exit();
            } else {
                echo "Erro ao executar a consulta.";
            }

            // Feche a declaração
            mysqli_stmt_close($stmt);
        } else {
            echo "Não foi possível preparar a declaração SQL.";
        }
    } else {
        echo "Sessão do usuário não definida.";
    }

    // Feche a conexão com o banco de dados
    mysqli_close($con);
} else {
    echo "Acesso negado!";
}
?>
