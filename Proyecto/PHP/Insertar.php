<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {     
    $nombre = $_POST['Nombre_reg'];
    $apellido = $_POST['Apellido_reg'];                                                                        
    $correo = $_POST['Correo_reg'];
    $contraseña = $_POST['Contraseña_reg'];                                                                                   
    $telefono = $_POST['Telefono_reg'];

    /*CONEXION CON LA BASE DE DATOS */
    $host = "localhost";
    $usuario = "root";                                                                                                  
    $password = "";                                                                                                     
    $base_datos = "logiquest";                                                                                   
    $conexion = new mysqli($host, $usuario, $password, $base_datos);

    /*VERIFICAR LA CONEXION CON LA BASE DE DATOS */
    if ($conexion->connect_error) {                                                                                     
        die("Error de conexión: " . $conexion->connect_error);                                                     
    }

    /*INSERTAR UN USUARIO EN LA BASE DE DATOS */
    $sql1 = "SELECT * FROM usuarios WHERE Correo = ?";                                                                   
    $stmt1 = $conexion->prepare($sql1);                                                                                   
    $stmt1->bind_param("s", $correo);                                                                                    
    $stmt1->execute();                                                                                                  
    $resultado = $stmt1->get_result();

    if ($resultado ->num_rows > 0){
        echo "El usuario ya se encuentra registrado en el sistema";
    }else{
        $sql2 = "INSERT INTO usuarios (Nombre, Apellido, Correo, Telefono, Contraseña) VALUES (?,?,?,?,?)";                                                                    
        $stmt2 = $conexion->prepare($sql2); 

        /*Pasar la contraseña a formato Hash antes de almacenarla */   
        $contraseña_hash = password_hash($contraseña, PASSWORD_DEFAULT);

        /*Asignando los parametros */                                                                               
        $stmt2->bind_param("sssss", $nombre, $apellido, $correo, $telefono, $contraseña_hash);                                                                                    

        // EJECUTAR LA INSERCCION DE DATOS
        $stmt2->execute();
        echo "Usuario registrado correctamente.";
        $stmt2->close();
    }

    /*CERRAR LA CONEXION */
    $stmt1->close();
    $conexion->close();
}
?>