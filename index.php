<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Gerador de Certificados</title>

        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="bootstrap/css/jumbotron-narrow.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <div class="container">
            <div class="header">
                <nav>
                    <ul class="nav nav-pills pull-right">
                        <li role="presentation" class="active"><a href="#">Certificados</a></li>
                        <li role="presentation"><a href="#">Validação</a></li>
                    </ul>
                </nav>
                <h3 class="text-muted">II Workshop e II Mostra de Trabalhos</h3>
            </div>

            <div class="form-horizontal">
                <form class="form-horizontal" role="search" method="post" action="">
                    <div class="input-group">
                        <input name="inscrito" type="text" class="form-control" placeholder="Nome do inscrito">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-default">Buscar</button>
                        </span>
                    </div>
                </form>
            </div>

            <?php
            require_once './app/model/db/Connection.php';
            require_once './app/model/Registered.php';

            //$conn = new Connection('localhost', 'root', 'root', 'certificados_db');
            $conn = new Connection('https://certificados-evppgajataiufg.rhcloud.com/', 'pedro', '123', 'certificados_db');
            
            $conn->connect();

            if (filter_input(INPUT_POST, 'inscrito')) {
                $result = $conn->perfQuery("SELECT * FROM inscritos WHERE nome LIKE '%" . filter_input(INPUT_POST, 'inscrito') . "%'");

                echo '<table class="table table-hover">'
                . '<thead>'
                . '<tr>'
                . '<th>#</th>'
                . '<th>Nome</th>'
                . '<th>Certificado</th>'
                . '</tr>'
                . '</thead>'
                . '<tbody>';

                $i = 0;
                while ($row = mysql_fetch_array($result)) {
                    echo '<tr>'
                    . '<td>' . ++$i . '</td>'
                    . '<td>' . $row['nome'] . '</td>'
                    . '<td>' . (new Registered($row['id'], $row['nome'], $row['tipo']))->makeForm() . '</td>'
                    . '</tr>';
                }

                echo '</tbody>'
                . '</table>';
            }
            ?>

            <footer class="footer">
                <p>&copy; Company <?php date_default_timezone_set('America/Sao_Paulo'); echo getdate()['year']; ?></p>
            </footer>

        </div> <!-- /container -->

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
