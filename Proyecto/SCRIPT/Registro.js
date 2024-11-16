function Registrardatos() {
    var nombre = document.getElementById('NAME').value;                                                             
    var apellido = document.getElementById('LASTNAME').value;
    var correo = document.getElementById('EMAIL').value;
    var contraseña = document.getElementById('PASSWORD').value;
    var confirmacion = document.getElementById('CONFIRMATION').value;
    var telefono = document.getElementById('NUMBER').value;

    /*VERIFICAR QUE LOS CAMPOS NO ESTEN VACIOS*/
    if (nombre == "" || apellido == "" || correo == "" || contraseña == "" || confirmacion == "" || telefono == "") {
        alert("Por favor, complete todos los campos.");
        return;
    }
   
    /*CREAR UNA SOLICITUD AJAX */
    var solicitud = new XMLHttpRequest();                                                                              
    solicitud.open("POST","../PHP/Insertar.php", true);                                                                 
    solicitud.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                                    

    /*MANEJAR RESPUESTA CUANDO LA SOLICITUD SE HA ENVIADO */
    solicitud.onload = function(){                                                                                      
        if (solicitud.status === 200) {     
            alert(solicitud.responseText); 
            document.getElementById('Form_registro').reset();                                                                            
        } else {
            console.error ("Error en la solicitud AJAX");
            console.error("Estado de la respuesta:", solicitud.status);
            console.error("Texto de la respuesta:", solicitud.statusText);
            console.error("Respuesta del servidor:", solicitud.responseText);
            console.error("Error en la solicitud: " + solicitud.status + " - " + solicitud.statusText);
        }
    }; 
    /*ENVIAR LA SOLICITUD CON LOS DATOS DEL FORMULARIO */
    if (contraseña != confirmacion){
        alert("No coincide la contraseña");
        return;
    }else{
        solicitud.send("Nombre_reg="+ encodeURIComponent(nombre) + "&Apellido_reg="+ encodeURIComponent(apellido)                                                         /*Se envia la solicitud con nombre Correo_Login el valor capturado en la variable "correo" y en un formato encodeURIComponent que permite codificar caracteres especiales como el @  */ 
        + "&Correo_reg="+ encodeURIComponent(correo) + "&Contraseña_reg="+ encodeURIComponent(contraseña)
        + "&Telefono_reg="+ encodeURIComponent(telefono)); 
        Iniciosesion();
    }
}