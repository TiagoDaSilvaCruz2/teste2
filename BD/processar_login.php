<?php
session_start(); 

if (isset($_POST['submit'])) {
    include_once('configBD.php');

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if (!empty($email) && !empty($senha)) {
        
        $query = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_assoc($result);

            $_SESSION['usuarioID'] = $row['usuarioID'];
            $_SESSION['nomeUsuario'] = $row['nome']; 
            $_SESSION['imgPerfil'] = $row['imgPerfil']; 

            echo "<script>";
            echo "localStorage.setItem('nomeUsuario', '" . $_SESSION['nomeUsuario'] . "');";
            echo "window.location.href = '../index.html';";
            echo "</script>";

            exit();

        } else {

            echo "<script>";
            echo "window.location.href = '../index.html';";
            echo "</script>";

        }
    } 
} else {echo "Aseeso negado";}

?>
