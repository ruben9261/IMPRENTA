

function AlertNotify(versionB, titulo, texto, tipo) {
    
    new PNotify({
        styling: 'bootstrap3',
        title: titulo,
        text: texto,
        type: tipo
    });
}

var Login = function(){

    var Usuario = {
        NombreUsuario : $("#NombreUsuario").val(),
        PasswordUsuario : $("#PasswordUsuario").val()
    };

    $.ajax({
        type:"post",
        url:"/LoginController/Login",
        // dataType : "json",      
        // contentType: "application/json; charset=utf-8",
        data: {Usuario:Usuario},
        success: function(respuesta){
            var respuesta = JSON.parse(respuesta);
            if(respuesta){
                if(respuesta.length > 0){
                    window.location.href = "/MainController";
                    AlertNotify('', 'Éxito', 'Usuario correcto', 'success');
                }
            }
            AlertNotify('', 'Warning', 'Usuario y/o contraseña inválido', 'danger');
        },
        error: function(error){
            AlertNotify('', 'Error', 'Error en el servidor consulte con el administrador', 'danger');
        }
    });
    return false;
};