window.addEventListener("load", alerta);


		function alerta()
		{
			//alert(getParameterByName("datosLogin.email", null));
		}

		function getParameterByName(name, url) 
		{
            if (!url) url = window.location.href;
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        }   

        function enviarPost()
        {
            var datosPost = {"title": texttitle, "header": textheader, "posttext": posttext, "author": author};
            xml.open("POST", "http://localhost:1337/postearNuevaEntrada", true);
            xml.onreadystatechange = callback;
            xml.send(JSON.stringify(datosPost));
        }

