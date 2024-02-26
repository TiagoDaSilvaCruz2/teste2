<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=8">
    <script src="https://cdn.tiny.cloud/1/unrlnk55rplxzao03mqvi36b3e85mt9e3j7oqe2jzjmqgjhx/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <title>Blog-Início</title>
    
</head>

<body>

<form action="blog_processo.php" method="POST" enctype="multipart/form-data">
    <label for="imagem">Selecione uma imagem para enviar:</label>
    <input type="file" name="imagem" id="imagem" accept="image/*">
    <br><br>
    <textarea class="conteudo" name="conteudo" placeholder="Conteúdo"></textarea>
    <br>
    <input class="submit" type="submit" name="submit" value="Enviar">
</form>

    <div class="session_start">
        <?php
        include_once('../BD/configBD.php');
        session_start();

        $usuarioID = isset($_SESSION['usuarioID']) ? $_SESSION['usuarioID'] : null;
	    $nomeUsuario = isset($_SESSION['nomeUsuario']) ? $_SESSION['nomeUsuario'] : null;


        // Realize a consulta à tabela blog
        $result = mysqli_query($con, "SELECT * FROM blog ORDER BY id DESC");
        if ($result) {
            // Verifique se existem linhas retornadas pela consulta
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='post'>";

                    echo "<div class='cabecario'>";

                    echo "<div style='display=flex'> <img class='imagenPerfil' src='$row[imgPerfil]'></div>";
                    echo "<div class='nome-usuario'>$row[nome]</div>";
                    //echo "<div class='data-post'>$row[dataPost]</div>";
                    

                    if ($usuarioID == $row['usuarioID']) {
                        echo "<button onclick=\"excluirPost(" . $row['id'] . ");\">Excluir</button>";
                    }

                    echo "</div>";

                    echo "<div class='main'>";
                    echo "<div class='conteudo'> <p>" . $row['conteudo'] . "</p> </div>";

                    if($row['imagem'] != 0)
                        echo "<div class='imagemPath'> <img class='imagemImg' src=". $row['imagem'] ."> </div>";

                    echo "</div>";

                    echo "</div>";

                }
            } else {
                echo "Não há dados na tabela blog.";
            }
        }

        // Feche a conexão com o banco de dados
        mysqli_close($con);
        ?>
    </div>



    <script>
        function excluirPost(id) {
            if (confirm("Deseja realmente excluir este post?")) {
                window.location.href = "blog_excluir.php?id=" + id;
            }
        }
    </script>

<script>
    tinymce.init({
        selector: 'textarea.conteudo',
        plugins: 'emoticons lists',
        toolbar: 'bold italic underline | bullist numlist | emoticons',
        height: 230,
        width: 300,
        statusbar: false,
        toolbar: 'undo redo styles bold italic alignleft aligncenter alignright outdent indent code',
        plugins: 'code',
    });
</script>

<script src="/socket.io/socket.io.js"></script>
  <script>
    const socket = io();

    const form = document.getElementById('form');
    const input = document.getElementById('input');

    form.addEventListener('submit', (e) => {
      e.preventDefault();
      if (input.value) {
        socket.emit('chat message', input.value);
        input.value = '';
      }
    });

    socket.on('chat message', (msg) => {
      const item = document.createElement('li');
      item.textContent = msg;
      document.getElementById('messages').appendChild(item);
    });
  </script>

</body>

</html>