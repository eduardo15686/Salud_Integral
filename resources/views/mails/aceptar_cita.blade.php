<!DOCTYPE html>
<html>
    <head>
        <title>How Send an Email in Laravel</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
        />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,600"
            rel="stylesheet"
        />

        <!-- Styles -->
        <style>
            html,
            body {
                background-color: #fff;
                color: #636b6f;
                /* font-family: "Nunito", sans-serif; */
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }
        </style>
    </head>
    <body>
        <br />
        <br />
        <br />
        <div style="width: 970px; text-align: center">
            <img
                src="{{ $message->embed(public_path('/principal/assets/img/logo.png')) }}"
                alt=""
                width="135"
                height="50"
            />
            
        </div>
        <div class="container box" style="width: 970px; text-align: center">
            <h1 style="text-align: center"><tutofox /></h1>
            <h3>Solicitud de cita confirmada</h3>
            <h4>
                Hola, <b>{{ $nombre }}</b>, con aprecio te informamos que tu
                solicitud de cita ha sido CONFIRMADA por nuestro especialista:
            </h4>
            <br /><br />
            <p>
                <b>FECHA DE CITA:</b> {{$fecha}} <br />
                <b>HORA:</b> {{substr($hora, 0,5)}} HRS <br />
                <b>NOMBRE DEL TERAPEUTA:</b> {{$especialista}} <br />
                <b>MODALIDAD DE TERAPIA:</b> {{$modalidad}} <br />
                <b>PRECIO DE CONSULTA:</b> ${{$precio_consulta}}.00 PESOS
            </p>
        </div>
        <br />
        <div class="container box" style="width: 970px">
            <p style="padding: 20px">
                Recibimos tu número de contacto, por lo que nuestros
                especialistas te contactaran para aclarar cualquier duda, te
                dejaremos algunas sugerencias para mejorar tu experiencia con
                nuestros servicios. <br />
                <br />
                <b>• Acudir con 5 minutos de anticipación a la sesión.</b>
                <br />
            </p>
            <p style="padding: 20px">
                DIRECCIÓN DE CONSULTORIO: Diego de Vilchis #2951 Col. San
                Felipe, Chihuahua, Chihuahua C.P. 31203, Chihuahua, Mexico
                <br />
                NUMERO DE CONTACTO: 6141909374 <br />
                UBICACIÓN POR GOOGLE MAPS: https://n9.cl/1afjr <br />
                WEB: http://saludintegraltest.duckdns.org/
            </p>
            <br />
            <br />
        </div>
        <div class="container box" style="width: 970px; text-align: center">
            <h4>
                GRACIAS POR ELEGIR SALUD INTEGRAL, TU SALUD ES NUESTRO
                COMPROMISO
            </h4>
            <img
            src="{{ $message->embed(public_path('/principal/assets/img/Contenido-04.png')) }}"
                alt=""
                width="150"
                height="150"
            />
            <p style="padding: 30px; font-size: x-small">
                Todos los datos de nuestros pacientes son confidenciales y sus datos están protegidos, 
                consulte nuestro aviso de
                privacidad en http://saludintegraltest.duckdns.org/
            </p>
        </div>
    </body>
</html>
