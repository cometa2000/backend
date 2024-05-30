<!-- principal.view.php -->
<?php
use config\Router;

$ruta = new Router;
?>
<div class="container mt-4">
    <div class="row">
        <div class="col">
            <a href="/formulario" type="button" class="btn btn-success">Agregar Máquina</a>
            <a href="<?=$ruta->redireccion('logout') ?>"  type="button" class="btn btn-danger ">Cerrar Sesión</a>
            <h1>Máquinas del Ciber Café</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre de Máquina</th>
                        <th>Hora de Inicio</th>
                        <th>Cronómetro</th>
                        <th>Día</th>
                        <th>Precio</th>
                        <th>Pausar</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($consulta as $fila) { ?>
                        <tr>
                            <td><?php echo $fila['nombre_maquina']; ?></td>
                            <td><?php echo $fila['tiempo_de_inicio']; ?></td>
                            <td><?php echo $fila['cronometro']; ?></td>
                            <td><?php echo $fila['dia']; ?></td>
                            <td><?php echo $fila['precio']; ?></td>
                            <td><button class="btn btn-primary" onclick="pausarCronometro(<?php echo $fila['id']; ?>)">Pausar</button></td>
                            <td>
                                <!-- <a href="<?=$ruta->redireccion('editForm').'/'.$fila['id'] ?>" class="btn btn-warning">Editar</a> -->
                                <form action="/edit" method="post">
                                    <input type="hidden" id="id" name="id" value="<?php echo $fila['id']; ?>">
                                    <button type="submit" class="btn btn-warning">Editar</button>
                                </form>
                            </td>
                            <td>
                                <form action="/eliminarDatos" method="post">
                                    <input type="hidden" id="id" name="id" value="<?php echo $fila['id']; ?>">
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
function pausarCronometro(id) {
    // Lógica para pausar el cronómetro
}
</script>
