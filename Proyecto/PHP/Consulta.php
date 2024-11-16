<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {                                                                             //verificar si la solicitud que se está recibiendo en el servidor fue enviada utilizando el método HTTP POST.
    $correo = $_POST['Correo_Login'];                                                                                   //Asigna el valor  enviado del formulario "Correo_Login"  a la variable $correo en el servidor. $_POST contiene datos enviados al servidor mediante el método POST.
    $contraseña = $_POST['Contraseña_Login'];

    /*CONEXION CON LA BASE DE DATOS */
    $host = "localhost";
    $usuario = "root";                                                                                                  // Nombre de usuario para conectarse con as base de datos en este caso en predeterminado "root"
    $password = "";                                                                                                     // Contraseña del ususario para conectarse a la base de datos
    $base_datos = "logiquest";                                                                                   // Nombre de la base de datos a la cual se va a conectar
    
    $conexion = new mysqli($host, $usuario, $password, $base_datos);

    /*VERIFICAR LA CONEXION CON LA BASE DE DATOS */
    if ($conexion->connect_error) {                                                                                     // Propiedad connect_error en MySQLi contiene información sobre el error de conexión si la conexión falla.  
        die("Error de conexión: " . $conexion->connect_error);                                                          // La función die() detiene la ejecución del script y muestra el mensaje proporcionado.
    }

    /*REALIZAR LA CONSULTA EN LA BASE DE DATOS */
    $sql = "SELECT * FROM usuarios WHERE Correo = ?";                                                                   // Consulta SQL ? indica un marcador de posición para un parámetro que se insertará en la consulta más adelante. Esta técnica se utiliza principalmente en consultas parametrizadas para mejorar la seguridad y evitar la iyeccion de datos 
    $stmt = $conexion->prepare($sql);                                                                                   // prepare() es un método que crea una consulta preparada y $stmt es un objeto de tipo mysqli_stmt que representa la consulta preparada.
    $stmt->bind_param("s", $correo);                                                                                    // bind_param() enlaza el valor de una variable a un marcador de posición ? en la consulta, siendo "s" el tipo de dato del parámetro (String) y $correo, el valor que se insertará en el lugar del ? en la consulta.
    $stmt->execute();                                                                                                   // Ejecuta la consulta, Cuando se llama a execute(), el servidor reemplaza el ? con el valor proporcionado
    $resultado = $stmt->get_result();                                                                                   // Recupera los resultados de la consulta ejecutada y los almacena en $resultado

    /*VERIFICACION SI EL DATO CONSULTADO EXISTE */
    if ($resultado ->num_rows > 0) {                                                                                     // La propiedad num_rows en un objeto de resultados ($resultado) indica la cantidad de filas que coinciden con la consulta, "Forma de ver si existe el valor consultado dentro de la base de datos".
        $datos = $resultado->fetch_assoc();                                                                                 // Desgloza los datos en forma de un array asociativo
        $con_contraseña = $datos['Contraseña'];
        if (password_verify($contraseña, $con_contraseña)) {
            echo "Usuario y contraseña correctos";
        }else{
            echo "Contraseña incorrecta";
        }
        
    } else {
        echo "Usuario no registrado";
    }

    /*CERRAR LA CONEXION */
    $stmt->close();
    $conexion->close();
}
?>