function Verificardatos() {
    var correo = document.getElementById('CORREO').value;                                                              /*Almacena en la variable correo el valor ingresado en el textbox con id=CORREO*/    
    var contraseña = document.getElementById('CONTRASEÑA').value;

    /*VERIFICAR QUE LOS CAMPOS NO ESTEN VACIOS*/
    if (correo == "" || contraseña == "") {
        alert("Por favor, complete todos los campos.");
        return;
    }
   
    /*CREAR UNA SOLICITUD AJAX */
    var solicitud = new XMLHttpRequest();                                                                               /*Se asocia al objeto solicitud la instancias XMLHttpRequest que permite enviar solicitudes http */
    solicitud.open("POST","../PHP/Consulta.php", true);                                                                 /*Se usa el metodo open que inicializa la solicitud usando el metodo de  HTTP "POST" y se envia dichas solcitud a "Consulta.php", ademas de indicar una solicitud asincronica (True) */
    solicitud.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                                    /*Metodo setRequestHeader el cual establece el valor de encabezado HTTP de "Content-Type" indica al servidor el tipo de datos que se están enviando en la solicitud los cuales son "application/x-www-form-urlencoded" el cual es formato nombre=Juan&apellido=Perez   */

    /*MANEJAR RESPUESTA CUANDO LA SOLICITUD SE HA ENVIADO */
    solicitud.onload = function(){                                                                                      /*Funcion que perite realizar una accion cuando la solicitud se ha completado exitosamente "onload"*/ 
        if (solicitud.status === 200) {                                                                                  /*Estado o resultado de la respuesta "status" y si el código de estado es 200 significa que la solicitud fue exitosa y que el servidor ha respondido correctamente. */
            alert (solicitud.responseText);                                                                                   /*Muestra el mensaje de conexion establecida en una ventana de alert */
        } else {
            console.error ("Error en la solicitud AJAX");
            console.error("Error en la solicitud AJAX");
            console.error("Estado de la respuesta:", solicitud.status);
            console.error("Texto de la respuesta:", solicitud.statusText);
            console.error("Respuesta del servidor:", solicitud.responseText);
            console.error("Error en la solicitud: " + solicitud.status + " - " + solicitud.statusText);
        }
    }; 
    /*ENVIAR LA SOLICITUD CON LOS DATOS DEL FORMULARIO */
    solicitud.send("Correo_Login="+ encodeURIComponent(correo) + "&Contraseña_Login="+ encodeURIComponent(contraseña));                                                         /*Se envia la solicitud con nombre Correo_Login el valor capturado en la variable "correo" y en un formato encodeURIComponent que permite codificar caracteres especiales como el @  */ 
}