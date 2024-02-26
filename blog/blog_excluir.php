<?php
include_once('../BD/configBD.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Realize a exclusão do post com base no ID
    $deleteQuery = "DELETE FROM blog WHERE id = $id";
    $result = mysqli_query($con, $deleteQuery);

    if ($result) {
        echo "<script>";
        echo "window.location.href = 'blog.php';";
        echo "</script>";
    } else {
        echo "Erro ao excluir o post: " . mysqli_error($con);
    }
} else {
    echo "ID do post não fornecido para exclusão.";
}

// Feche a conexão com o banco de dados
mysqli_close($con);
?>
