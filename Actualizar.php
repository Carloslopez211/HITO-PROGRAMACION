<html>
    <head>
        <meta charset="UTF-8">
        <title>ACTUALIZAR USUARIOS</title>
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
          <style>
              h1 {
                  text-align:left;
                  
              }
          </style>
     <h1>ACTUALIZACIÓN DE USUARIOS</h1>
    <h2>Pon el correo del usuario para actualizar</h2>
        <form action="Actualizar.php" method="GET">
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Buscar Usuario</button>
        </form>
    
      <?php
        include_once 'conexion.php';

        if (isset($_GET['email'])) {
            $email = $_GET['email'];

         
            $sql = "SELECT * FROM usuarios WHERE correoelectronico = '$email'";
            $result = mysqli_query($conexion, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);

           
                echo "<h2>Modificar Datos del Usuario</h2>";
                echo "<form action='Actualizar.php' method='POST'>
                <input type='hidden' name='email' value='" . $user['correoelectronico'] . "'>
                <div>
                <label for='nombre' class='form-label'>Nombre:</label>
                <input type='text' class='form-control' id='nombre' name='nombre' value='" . $user['nombre'] . "' required>
                </div>
                <div>
                <label for='apellidos' class='form-label'>Apellidos:</label>
                <input type='text' class='form-control' id='apellidos' name='apellidos' value='" . $user['apellidos'] . "' required>
                </div>
                <div>
                <label for='edad' class='form-label'>Edad:</label>
                <input type='number' class='form-control' id='edad' name='edad' value='" . $user['edad'] . "' required>
                </div>
                <div>
                <label for='plan' class='form-label'>Plan:</label>
                <select class='form-control' name='plan' required>
                <option value='Básico' " . ($user['plan'] == 'Básico' ? 'selected' : '') . ">Básico</option>
                <option value='Avanzado' " . ($user['plan'] == 'Avanzado' ? 'selected' : '') . ">Avanzado</option>
                <option value='Premium' " . ($user['plan'] == 'Premium' ? 'selected' : '') . ">Premium</option>
                </select>
                </div>
                <button type='submit' class='btn btn-success'>Actualizar Usuario</button>
                </form>";
            } else {
                echo "Usuario no encontrado con ese correo.";
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $edad = $_POST['edad'];
            $plan = $_POST['plan'];

            $sqlUpdate = "UPDATE usuarios SET nombre = '$nombre', apellidos = '$apellidos', edad = '$edad', plan = '$plan' WHERE correoelectronico = '$email'";

            if (mysqli_query($conexion, $sqlUpdate)) {
                echo "Usuario actualizado correctamente.";
            } else {
                echo "Error al actualizar el usuario: " . mysqli_error($conexion);
            }
        }

        mysqli_close($conexion);
        ?>
    </body>
</html>