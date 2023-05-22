<?php

use Src\Models\Connection;

require __DIR__ . '/src/models/Connection.php';

require __DIR__ . '/src/models/Crud.php';

require __DIR__ . '/src/models/Url.php';

require __DIR__ . '/src/controllers/functions.php';

$pdo = Connection::getInstance();

?>
<!doctype html>
<html lang="pt-br">

  <head>
    <title>Aplicação PHP com Javascript</title>
    <!-- Obrigatório meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS Styles do Site -->
    <link rel="stylesheet" href="src/public/css/style.css">

  </head>

  <body>
    <div id="wrapper">
      <div class="container">
        <header>
          <!-- colocar o navbar aqui -->
          <?php require __DIR__ . '/src/views/layout/header.php'; ?>
        </header>
        <main>
          <!-- colocar o conteúdo aqui -->
          <?php require __DIR__ . '/src/controllers/url.php'; ?>
        </main>
        <footer>
          <!-- colocar o footer aqui -->
          <?php require __DIR__ . '/src/views/layout/footer.php'; ?>
        </footer>
      </div>
    </div>
    <!-- JavaScript Bibliotecas -->
    <script src="src/public/js/zepto.min.js"></script>
    <script src="src/public/js/custom.js"></script>
  </body>

</html>
