<?php
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["imagem"])) {

    session_start();

    //verifica o tamanho da imagem
    $arquivo = $_FILES["imagem"];
    if($arquivo['size'] > 2097152)
        die("Arquivo muito grande");

    //pega o local da pasta
    $pastaLocal = "uploads/";

    //pega o nome do arquivo
    $nomeDoArquivo = $arquivo['name'];

    // Verifica se o arquivo foi selecionado
    if($nomeDoArquivo != "") {
        //cria um código único
        $novoNomeDoArquivo = uniqid();

        //pega a extensão do arquivo
        $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

        // Verifica se a extensão é válida
        if($extensao != "jpeg" && $extensao != "png" && $extensao != "jpg")
            die("Tipo de arquivo não aceito");

        $path = $pastaLocal . $novoNomeDoArquivo . "." . $extensao;
        
        // enviar para a pasta local o código do arquivo com um ponto e a extensão  cod.png
        $enviar = move_uploaded_file($arquivo["tmp_name"], $path);

    } else {$path = 0;}
}
?>
