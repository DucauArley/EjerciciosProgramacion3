window.addEventListener("load", carga);

        var xml = new XMLHttpRequest();

        function carga()
        {
            var boton = document.getElementById("btn").addEventListener("click", validarUsuario);
        }

        function validarUsuario()
        {
            var email = document.getElementById("email"); 
            var password = document.getElementById("pass");

            if(email.value == "email" && password.value == "password")
            {
                enviarPost();   
           	}
            else
            {
                alert("Datos equivocados");
            }
        }

        function enviarPost()
            {
                var usuario = document.getElementById("email");
                var contraseña = document.getElementById("pass");

                if(usuario.value != "" && contraseña.value != "")
                {
                    var datosLogin = {email: usuario.value,  password: contraseña.value};
                    xml.open("POST", "http://localHost:1337/login",true);
                    xml.onreadystatechange = callback;
                    xml.send(JSON.stringify(datosLogin));
                }
                else
                {
                    alert("Debe ingresar el usuario y la contraseña");
                }

            }


        function callback()
            {
                if(xml.readyState === 4)
                {
                    if(xml.status === 200)
                    {
                        console.log("LLego respuesta del servidor ", xml.readyState, xml.status, xml.responseText);
                        var respuesta = xml.responseText;
                        respuesta = JSON.parse(respuesta);
                        console.log(respuesta.autenticado);
                        if (respuesta.autenticado == "si") 
                        {
                            var email = document.getElementById("email").value;
                			window.location.replace("index.html" + "?preferencias=" + JSON.stringify(respuesta.preferencias) + "&?email=" + email);
                        }
                        else
                        {
                            alert("Usuario o contraseña incorrecta");
                        }
                    }
                    else
                    {
                        alert("Error del servidor ", xml.status);
                    }
                }
            }



