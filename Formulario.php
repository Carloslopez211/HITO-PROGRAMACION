<html>
    <head>
        <meta charset="UTF-8">
        <title>HITO 1</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
 <!-- Menú de navegación de Bootstrap -->
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
            body {
                font-family: Arial, sans-serif;
                background-color: #ff7171;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: left;
                align-items: center;
                height: 100vh;
                flex-direction: column;
            }
            h1 {
                text-align: left;
                color: #333;
                margin-bottom: 20px;
            }
            label {
                font-size: 16px;
                margin-bottom: 8px;
                display: block;
                color: #333;
            }
            input, select, button {
                width: 100%;
                padding: 10px;
                margin: 10px 0 20px;
                border: 1px solid #ccc;
                border-radius: 4px;
                font-size: 16px;
            }

            input[type="checkbox"], input[type="radio"] {
                width: auto;
                margin-right: 10px;
            }
            button {
                background-color: #B00B69;
                color: white;
                border: none;
                cursor: pointer;
                font-size: 18px;
                border-radius: 4px;
            }
        </style>
        <h1>INSCRIPCIÓN A STREAMWEB</h1>
        <form action="Formulario.php" method="POST">

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" placeholder="Pon aquí tu nombre" required>

            <label for="apellido">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" placeholder="Pon aquí tu apellido" required>
            
            <label for="plan">Tipo de plan base:</label>
            <select id="plan" name="plan" required>
                <option value="Básico">Básico</option>
                <option value="Estándar">Estándar</option>
                <option value="Premium">Premium</option>
            </select>

            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" placeholder="Pon tu correo electrónico" required>

            <label for="edad">Edad:</label>
            <input type="number" id="edad" name="edad" placeholder="Pon aquí tu EDAD" required>
            
            <label>Paquetes adicionales:</label>
            <input type="checkbox" name="paquetes[]" value="Deportes"> Deporte
            <input type="checkbox" name="paquetes[]"value="Cine"> Cine
            <input type="checkbox" name="paquetes[]" value="Infantil"> Infantil

            <label>Duración de la suscripción:</label>
            <input type="radio" name="duracion" value="mensual"> Mensual
            <input type="radio" name="duracion" value="anual"> Anual

            <button type="submit" value="Enviar">Registrar</button>

        </form>
    </body>
</html>
<?php
include_once 'conexion.php';
$nombre = '';
$email = '';
$edad = '';
$plan = '';
$paquetes = [];
$duracion = '';
$apellidos = '';
$paqueteDeporte = 0;
$paqueteCine = 0;
$paqueteInfantil = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$email = $_POST["email"];
$edad = $_POST["edad"];
$plan = $_POST["plan"];
$paquetes = isset($_POST["paquetes"]) ? $_POST["paquetes"] : [];
$duracion = isset($_POST["duracion"]) ? $_POST["duracion"] : '';

if (in_array("Deportes", $paquetes)) {
        $paqueteDeporte = 1;
}
if (in_array("Cine", $paquetes)) {
        $paqueteCine = 1;
}
if (in_array("Infantil", $paquetes)) {
        $paqueteInfantil = 1;
}
}
if (!is_numeric($edad) || $edad <= 0) {
    echo "";
    exit();
}
if ($edad < 18) {
    $paquetes = ['Infantil'];
    $paqueteDeporte = 0;
    $paqueteCine = 0;
} else {

    if (in_array("Deportes", $paquetes)) {
        $paqueteDeporte = 1;
    }
    if (in_array("Cine", $paquetes)) {
        $paqueteCine = 1;
    }
    if (in_array("Infantil", $paquetes)) {
        $paqueteInfantil = 1;
    }
}

if ($plan == 'Básico' && count($paquetes) > 1) {
    echo "El plan básico solo seleccionar un paquete de contenido adicional.";
    exit();
}
if (in_array("Deportes", $paquetes) && $duracion != 'anual') {
    echo "El paquete de deporte solo está disponible si la suscripción es de 1 año.";
    exit();
}
$sql = "INSERT INTO usuarios (correoelectronico, nombre, apellidos, edad, plan, paqueteDE, paqueteCI, paqueteIN, duracion)
        VALUES ('$email', '$nombre', '$apellidos', '$edad', '$plan', $paqueteDeporte, $paqueteCine, $paqueteInfantil, '$duracion')";

if (mysqli_query($conexion, $sql)) {
    echo 'Registro realizado con exito';;
} else {
    echo "Error: " . mysqli_error($mysql);
}

mysqli_close($conexion);
?>
</body>
</html>
