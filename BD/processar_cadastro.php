<?php
if (isset($_POST['submit'])) {

    include_once('configBD.php');

    $cod_aleatorio   = mt_rand(100000, 999999);
    $aleatorioPerfil = mt_rand(0, 5);

    $imgPerfil = $conquistas = array("https://avatarfiles.alphacoders.com/893/thumb-89303.gif",
                                    "https://avatarfiles.alphacoders.com/108/thumb-108672.gif",
                                    "https://avatarfiles.alphacoders.com/108/thumb-108839.gif",
                                    "https://avatarfiles.alphacoders.com/844/thumb-84463.jpg",
                                    "https://avatarfiles.alphacoders.com/339/339605.jpg");
 
    // Validar e limpar os dados recebidos do formulário
    $nome =  ($_POST['nome']);
    $email = ($_POST['email']);
    $senha = ($_POST['senha']);

    // Verificar se os campos estão preenchidos
    if (!empty($nome) && !empty($email) && !empty($senha)) {


        $query = "SELECT * FROM usuario WHERE email = '$email'";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            echo "Esse email já existe";
        } else{
            


            // Preparar a declaração SQL
            $stmt = $con->prepare("INSERT INTO usuario(nome, email, senha, cod, imgPerfil) VALUES (?, ?, ?, ?, ?)");
            
            // Vincular os parâmetros
            $stmt->bind_param("sssss", $nome, $email, $senha, $cod_aleatorio, $imgPerfil[$aleatorioPerfil]);

            // Executar a declaração preparada
            if ($stmt->execute()) {

                // Redirecionar o usuário para a página inicial com uma mensagem de sucesso

                header("Location: ../index.html");
                exit();
                
            } else {
                // Se houver um erro no banco de dados, exibir uma mensagem de erro
                echo "Erro ao cadastrar usuário: " . $stmt->error;
            }

            // Fechar a declaração preparada
            $stmt->close();




        }

    } else {
        // Se algum campo estiver vazio, exibir uma mensagem de erro
        echo "Por favor, preencha todos os campos do formulário.";
    }

    // Fechar a conexão com o banco de dados
    $con->close();
}
?>
