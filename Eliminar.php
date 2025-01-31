<html>
<head>
    <meta charset="UTF-8">
    <title>ELIMINAR USUARIOS</title>
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
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
    
    </style>

    <h1>ELIMINAR USUARIOS</h1>
    <h2>Inserte el correo del usuario que quieres eliminar</h2>
    
    <form action="Eliminar.php" method="POST">
        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" required>
        <button type="submit">Eliminar</button>
    </form>

    <?php
    include_once 'conexion.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST["email"];

        $sql = "SELECT * FROM usuarios WHERE correoelectronico = '$email'";
        $result = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($result) > 0) {
            $delete_sql = "DELETE FROM usuarios WHERE correoelectronico = '$email'";
            if (mysqli_query($conexion, $delete_sql)) {
                echo "Usuario eliminado correctamente.";
            } else {
                echo "Error al eliminar: " . mysqli_error($conexion);
            }
        } else {
            echo "El correo ingresado no existe en la base de datos.";
        }

        mysqli_close($conexion);
    }
    ?>
</body>
</html>