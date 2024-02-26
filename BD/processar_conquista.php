<?php
session_start();
include_once('../BD/configBD.php');

$usuarioID = $_SESSION['usuarioID'];

// Inicialize um vetor para armazenar as conquistas
$conquistas = array(0, 0, 0, 0, 0, 0);

// Array com os nomes das conquistas de A1 até A6
$conquistas_nomes = array('A1', 'A2', 'A3', 'A4', 'A5', 'A6');

// Loop através das conquistas
for ($i = 0; $i < count($conquistas_nomes); $i++) {
    $conquista_nome = $conquistas_nomes[$i];
    $selectConquista = "SELECT * FROM conquista WHERE usuarioID='$usuarioID' AND conquista_nome='$conquista_nome'";
    
    // Execute a consulta
    $resultConquista = mysqli_query($con, $selectConquista);
    
    // Verifique se a consulta foi bem-sucedida
    if ($resultConquista) {
        // Se a conquista foi encontrada, atualize o vetor de conquistas
        if (mysqli_num_rows($resultConquista) > 0) {
            $conquistas[$i] = 1;
        }
    } else {
        echo "Erro ao consultar o banco de dados: " . mysqli_error($con);
    }
}


// Codifica o array como JSON
$json_dados = json_encode($conquistas);

// Retorna o JSON
echo $json_dados;
?>
