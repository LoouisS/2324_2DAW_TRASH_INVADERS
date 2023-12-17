<?php
    $descripciones = array(
        'Correr mas rapido',
        'Mas puntos',
        'Recogida automatica',
        // Agrega más descripciones según sea necesario
    );
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="David, Antonio y Guillermo" />
        <title>Mejoras</title>
        <link rel="stylesheet" href="src/css/style_servidor.css">
        <link rel="icon" type="image/png" href="src/img/logo.jpg">
    </head>
    <body>
        <main id="register-page">
            <div class="div-superior">
                <label><h1>Mejoras</h1></label>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Imagen Mejora</th>
                        <th>Descripcion</th>
                        <th>Multiplicador</th>
                        <th>Duracion Mejora</th>
                        <th>Porcentaje de Aparicion</th>
                        <th>Eliminar</th>          
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if (!is_iterable($mejoras) || count($mejoras) === 0) {
                            echo "<tr><td colspan='6'>No hay Mejoras</td></tr>";
                        } else {
                            foreach ($mejoras as $mejora) {
                                echo "<tr>";
                                // Verifica si hay una imagen asociada con la mejora
                                if (!empty($mejora['imagen'])) {
                                    // Muestra la imagen en lugar del enlace
                                    echo "<td><img src='data:image/jpeg;base64," . $mejora['imagen'] . "' class='redimension'></td>";
                                } else {
                                    echo "<td><a href='index.php?controlador=ControladorImagenesUsuario&action=mostrarImagenUsuario&idUsuario={$idUsuario}&" . http_build_query(['idMejora' => $mejora['idMejora']]) . "'>Seleccionar Imagen</a></td>";
                                }                              
                                echo "<td>" . $mejora['descripcion'] . "</td>";
                                echo "<td>" . $mejora['multiplicador'] . "</td>";
                                echo "<td>" . $mejora['duracion_mejora'] . "</td>";
                                echo "<td>" . $mejora['porcentaje_aparicion'] . "</td>";

                                echo "<td><a href='index.php?controlador=ControladorMejora&action=confirmarBorrado&idMejora=" . $mejora['idMejora'] . "'>Eliminar</a></td>";
                                echo "</tr>";
                            }                           
                        }
                    ?>
                </tbody>
            </table>
            <!-- Formulario para agregar mejora -->
            <form action="index.php?controlador=ControladorMejora&action=agregarDobleMejora" method="post">
                <!-- Modifica el formulario para usar un campo desplegable -->
                <label>Imagen</label>
                <?php
                    ini_set('display_errors', 0);
                    if (isset($_SESSION['selectedImage'])) {
                        $selectedImage = $_SESSION['selectedImage'];
                        $idUsuario = $_GET['idUsuario'] ?? '';
                        echo "<td><img src='data:image/jpeg;base64," . $selectedImage['imagen'] . "' alt='" . $selectedImage['nombre'] . "' class='redimension'></td>";
                        echo "<div><a href='index.php?controlador=ControladorImagenesUsuario&action=mostrarImagenUsuario&idUsuario={$idUsuario}&" . http_build_query(['idMejora' => $mejora['idMejora']]) . "'>Cambiar Imagen</a></div>";
                    } else {
                        // Muestra el enlace para seleccionar la imagen
                        echo "<div><a href='index.php?controlador=ControladorImagenesUsuario&action=mostrarImagenUsuario&idUsuario={$idUsuario}&" . http_build_query(['idMejora' => $mejora['idMejora']]) . "'>Seleccionar Imagen</a></div>";
                    }
                ?>
                
                <label>Descripción:</label>
                <select name="descripcion" required id="descripcion" >
                    <?php
                        foreach ($descripciones as $descripcion) {
                            echo "<option value='{$descripcion}'>{$descripcion}</option>";
                        }
                    ?>
                </select>
                <label>Multiplicador:</label>
                <input type="number" name="multiplicador" required>
                <label>Duración Mejora:</label>
                <input type="number" name="duracionMejora" required>
                <label>Porcentaje de Aparicion:</label>
                <input type="number" name="porcentaje_aparicion" required>
                <button type="submit">Agregar Mejora</button>
            </form>
            <button id="volvermenu"><a href="index.php?controlador=Menu&action=mostrarMenu">VOLVER</a></button>
        </main>
    </body>
</html>