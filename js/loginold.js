function validarContrasena() {
    var nombreUsuario = document.getElementById('textUsuario').value;
    var contrasenaUsuario = document.getElementById('textClave').value;
    
    nombreUsuario = allTrim(nombreUsuario);
    contrasenaUsuario = allTrim(contrasenaUsuario);
    
    if (nombreUsuario.length == 0) {
        alert("El nombre de Usuario Ingresado no es Válido ... Digitelo Nuevamente.");
        document.getElementById('textUsuario').value = "";
        document.getElementById('textUsuario').focus();
        return false;
    }
    
    if (contrasenaUsuario.length == 0) {
        alert("No ha ingresado la contraseña... Digitela.");
        document.getElementById('textClave').value = "";
        document.getElementById('textClave').focus();
        return false;
    }
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'valida.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.body.innerHTML = xhr.responseText;
        }
    };
    xhr.send('textUsuario=' + encodeURIComponent(nombreUsuario) + '&textClave=' + encodeURIComponent(contrasenaUsuario));
}

function mensajeInicial() {
    var mensajeInicial = "HORARIOS DE ATENCION :\n\n";
    mensajeInicial += "Para soporte y asistencia técnica Sistema Proservipol v3\n";
    mensajeInicial += "de Lunes a Viernes.\n";
    mensajeInicial += "Horarios de 08:30 a 13:00 Hrs. y de 14:30 a 18:00 Hrs.\n";
    mensajeInicial += "llamar a los siguientes anexos de la mesa de ayuda:\n\n";  
    mensajeInicial += "Mesa de ayuda 1: 20828\n";
    mensajeInicial += "Mesa de ayuda 2: 20844\n";
    mensajeInicial += "Mesa de ayuda 3: 20836\n\n";
    mensajeInicial += "CONSULTAS REALIZARLAS A: correo.proservipol@carabineros.cl.\n\n";
    mensajeInicial += "NOTA: La autenticación se realiza mediante Autentificatic. Si su contraseña ha caducado, actualícela en el sistema Autentificatic.";
    
    alert(mensajeInicial);
}