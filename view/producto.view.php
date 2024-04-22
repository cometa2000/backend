<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Producto</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col mt-5">
                <a href="/productoRe" class="btn btn-success">Registra un producto</a>
            </div>
            <div class="col mt-5">
                <a href="/eliminar" class="btn btn-danger">Eliminar un producto</a>
            </div>
            <div class="col mt-5">
            <form role="form" action="/filtro" method="post" novalidate>
                <select name="categoria" id="categoria" class="form-control" tabindex="2">
                    <option value="*">Todos</option>
                    <option value="frutas">Frutas</option>
                    <option value="vertudas">Vertudas</option>
                    <option value="cerealesYGranos">Cereales y Granos</option>
                    <option value="carnes">Carnes</option>
                    <option value="aves">Aves</option>
                    <option value="lacteos">Lacteos</option>
                </select>
                <input type="submit" value="Filtrar" class="btn btn-primary btn-block btn-lg">
             </form>
            </div>
        </div>
        <div class="row">
            <?php
            use controller\Productos;
            $productoController = new Productos();
            $resultados = $productoController->consulta_dato();
            foreach ($resultados as $producto) {
                echo '<div class="col-md-4 mt-5">';
                echo '<div class="card" style="width: 18rem;">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $producto['nombre'] . ' &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp ID = ' . $producto['id'] . '</h5>';
                echo '<p class="card-text">' . $producto['categoria'] . '</p>';
                echo '<p class="card-text">' . $producto['descripcion'] . '</p>';
                echo '<p class="card-text">$' . $producto['presio'] . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
