<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Salud Integral</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- CSS Files -->
    <link href="principal/assets/css/style.css" rel="stylesheet">
    <link href="citas/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="citas/assets/css/paper-bootstrap-wizard.css" rel="stylesheet" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <!-- <link href="citas/assets/css/demo.css" rel="stylesheet" /> -->

    <!-- Fonts and Icons -->
    <link href="https://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="citas/assets/css/themify-icons.css" rel="stylesheet">
</head>

<body>
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

            <!-- <h1 class="logo me-auto"><a href="index.html">Salud Integral</a></h1> -->
            <!-- Uncomment below if you prefer to use an image logo -->
            <a href="/" class="logo me-auto"><img src="principal/assets/img/logo.png" alt="" class="img-fluid"></a>



            <a href="/" class="appointment-btn scrollto"><span class="d-none d-md-inline">Página Principal</span>
            </a>

        </div>
    </header><!-- End Header -->
    <div class="image-container set-full-height" style="background-image: url('principal/assets/img/hero-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">

                    <!--      Wizard container        -->
                    <div class="wizard-container">
                        <div class="card wizard-card" data-color="red" id="wizard">
                            <form action="{{route('filtrar')}}" method="POST">
                            @csrf
                                <!--        You can switch " data-color="green" "  with one of the next bright colors: "blue", "azure", "orange", "red"       -->

                                <div class="wizard-header">
                                    <h3 class="wizard-title">AGENDA UNA CITA</h3>
                                    <p class="category">Esta información sera utilizada para contactarte con un
                                        terapeuta.</p>
                                </div>
                                <div class="wizard-navigation">
                                    <div class="progress-with-circle">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="1"
                                            aria-valuemax="4" style="width: 15%;"></div>
                                    </div>
                                    <ul>
                                        <li>
                                            <a href="#informacion" data-toggle="tab">
                                                <div class="icon-circle">
                                                    <i class="ti-book"></i>
                                                </div>
                                                Registro
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#location" data-toggle="tab">
                                                <div class="icon-circle">
                                                    <i class="ti-bookmark-alt"></i>
                                                </div>
                                                Especialidades
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#facilities" data-toggle="tab">
                                                <div class="icon-circle">
                                                    <i class="ti-layout-cta-left"></i>
                                                </div>
                                                Terapeutas
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#type" data-toggle="tab">
                                                <div class="icon-circle">
                                                    <i class="ti-user"></i>
                                                </div>
                                                Sobre ti
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#description" data-toggle="tab">
                                                <div class="icon-circle">
                                                    <i class="ti-email"></i>
                                                </div>
                                                Datos de Contacto
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane" id="informacion">
                                        <h3 style="text-align: center;">REGISTRO DE CITA</h3>
                                        <div class="row" style="text-align: center">
                                            <h5 style="padding: 25px">Vamos a crear tu cita personal y asignarte el mejor psicólogo acorde a tus necesidades. En solo unos sencillos pasos...</h5>
                                            <div>
                                                <img src="principal/assets/img/registro.png"  width="150" height="150">
                                                <p style="padding: 25px">Agradeciendo que llene el formulario de manera correcta para ofrecerle el mejor servicio que se merece.</p>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="location">
                                        <p style="text-align: center;">¿QUÉ QUIERES SOLUCIONAR CON LA TERAPIA?</p>
                                        <div class="row">

                                            <div class="col-sm-8 col-sm-offset-1">
                                                <br>
                                                @foreach($servicios as $servicio)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        value='{{$servicio -> id}}' name="registro[]">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        {{$servicio -> text_html}}
                                                    </label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="type">
                                        <h5 class="info-text">CUÉNTANOS SOBRE TI</h5>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="col-sm-6">
                                                    <p><b>¿Cuál es tu rango de edad?</b></p>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="edad"
                                                            value="Menos de 18">
                                                        <label class="form-check-label" for="edad">
                                                            Menos de 18
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="edad"
                                                            value="18-25">
                                                        <label class="form-check-label" for="edad">
                                                            18-25
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="edad"
                                                            id="edad">
                                                        <label class="form-check-label" for="edad">
                                                            26-35
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="edad"
                                                            id="edad">
                                                        <label class="form-check-label" for="edad">
                                                            36-45
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="edad"
                                                            id="edad">
                                                        <label class="form-check-label" for="edad">
                                                            Más de 45
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p><b>¿Es tu primera vez en terapia?</b></p>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="primera_vez" value="Si">
                                                        <label class="form-check-label" for="primera_vez">
                                                            Si
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="primera_vez" value="No">
                                                        <label class="form-check-label" for="primera_vez">
                                                            No
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="facilities">
                                        <h5 class="info-text">Selecciona uno de los especialistas. </h5>
                                        <div class="row row-cols-1 row-cols-md-3 g-4">
                                            @foreach($especialistas as $especialista)
                                            <div class="col">
                                                <div class="card">
                                                    <div >
                                                        <img src="img/fotos/{{$especialista['foto']['imagen_path']}}" style="height: 100px; width: 100px; background-repeat: no-repeat; background-position: 50%; border-radius: 50%; background-size: 100% auto;">
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-10">
                                                                <h5 class="card-title">{{$especialista -> titulo}} {{$especialista -> nombre}} {{$especialista -> apellido_pat}} {{$especialista -> apellido_mat}}</h5>
                                                                <p class="card-text">{{$especialista -> descripcion}}</p>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="especialista"  value='{{$especialista -> id}}'>
                                                                    <label class="form-check-label" for="especialista">
                                                                        Seleccionar
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
												    </div>
												</div>
											</div>
											@endforeach
										</div>
		                            </div>
		                            <div class="tab-pane" id="description">
		                                <div class="row">
		                                    <h5 class="info-text">Datos del paciente</h5>
		                                    <div class="col-sm-10 col-sm-offset-1">
		                                        <div class="form-group">
                                                    <div class="form-floating mb-3">
                                                        <label for="floatingInput">Nombre Completo</label>
                                                        <input type="text" name ="nombre" class="form-control" id="floatingInput" placeholder="Nombre Completo">                                
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <label for="floatingInput">Correo Electrónico</label>
                                                        <input type="email" name ="correo" class="form-control" id="floatingInput" placeholder="Correo Electrónico">                                
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <label for="floatingInput">Teléfono</label>
                                                        <input type="text" name="celular" class="form-control" id="floatingInput" placeholder="Teléfono">                                
                                                    </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                        <div class="wizard-footer">
	                            	<div class="pull-right">
	                                    <input type='button' class='btn btn-next btn-fill btn-danger btn-wd' name='next' value='Siguiente' />
	                                    <input type='submit' onclick="location.href='/finalizar'" class='btn btn-finish btn-fill btn-danger btn-wd' name='finish' value='Finalizar' />
									</div>

	                                <div class="pull-left">
	                                    <input type='button' class='btn btn-previous btn-default btn-wd' name='previous' value='Anterior' />
	                                </div>
	                                <div class="clearfix"></div>
		                        </div>
		                    </form>
		                </div>
		            </div>
                                                </div>
                                            </div> 
                                        </div> <!--  big container -->



                                    </div>

</body>


<!--   Core JS Files   -->
<script src="citas/assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
<script src="citas/assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="citas/assets/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>

<!--  Plugin for the Wizard -->
<script src="citas/assets/js/demo.js" type="text/javascript"></script>
<script src="citas/assets/js/paper-bootstrap-wizard.js" type="text/javascript"></script>

<!--  More information about jquery.validate here: https://jqueryvalidation.org/	 -->
<script src="citas/assets/js/jquery.validate.min.js" type="text/javascript"></script>

</html>
<script>
document.querySelectorAll('input[type=checkbox][name=registro]').forEach(oneRadio => {
    oneRadio.addEventListener('click', function(e) {
        var mValue = e.target.value;
        console.log(mValue);
    });
});

$("#BtnEnviar").click(function (e) {
      e.preventDefault();
      var nombre = $('#txtNombre').val();
      $.ajax({
        type: "post",
        url: "cita",
        data: {
            nombre: nombre
        }, success: function (msg) {
                alert("Se ha realizado el POST con exito "+msg);
        }
      });
  });
</script>