<html>
    <head>
        <meta charset="UTF-8">
        <title>Base de Datos</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="Formulario.php">Formulario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="BaseDatos.php">Revisar registros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Eliminar.php">Eliminar un usuario</a>
                    </li>
                      <li class="nav-item">
                        <a class="nav-link" href="Actualizar.php">Actualizar un usuario existente</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
       <h1>BASE DE DATOS</h1>
      <?php
 include_once 'conexion.php';
 $sql = "SELECT * FROM usuarios";
 $result = mysqli_query($conexion, $sql);
 
if ($result == false) {
    echo "Error en la consulta: " . mysqli_error($conexion);
} else {
    if (mysqli_num_rows($result) > 0) {
        echo "<h2>Lista de Registros</h2>";
        echo "<table border='1'>
        <tr>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Correo</th>
        <th>Edad</th>
        <th>Plan</th>
        <th>Paquetes</th>
        <th>Duración</th>
        <th>Precio</th>
                    
        </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
           
                    $paquetesArray = [];
                    if ($row['paqueteDE'] == 1) $paquetesArray[] = "Deporte";
                    if ($row['paqueteCI'] == 1) $paquetesArray[] = "Cine";
                    if ($row['paqueteIN'] == 1) $paquetesArray[] = "Infantil";
                    $paquetesStr = implode(", ", $paquetesArray);

        echo "<tr>
                        <td>" . $row['nombre'] . "</td>
                        <td>" . $row['apellidos'] . "</td>
                        <td>" . $row['correoelectronico'] . "</td>
                        <td>" . $row['edad'] . "</td>
                        <td>" . $row['plan'] . "</td>
                        <td>" . $paquetesStr . "</td>
                        <td>" . $row['duracion'] . "</td>
                  
              </tr>";
        }
        echo "</table>";
    } else {
        echo "No hay registros disponibles.";
    }
}

mysqli_close($conexion);
         ?>
    </body>
</html>
