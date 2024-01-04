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

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9678376346589368"
     crossorigin="anonymous"></script>
</head>

<body>
    <header id="header" class="fixed-top">
        <!-- <div class="container d-flex align-items-center"> -->

            <!-- <h1 class="logo me-auto"><a href="index.html">Salud Integral</a></h1> -->
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="/" class="logo me-auto"><img src="principal/assets/img/logo.png" alt="" class="img-fluid"></a>



            <a href="/" class="appointment-btn scrollto"><span class="d-none d-md-inline">Página Principal</span>
            </a>

        </div> -->
    </header><!-- End Header -->
    <div class="image-container set-full-height" style="background-image: url('principal/assets/img/hero-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">

                    <!--      Wizard container        -->
                    <div class="wizard-container">
                        <div class="card wizard-card" data-color="red" id="wizard">
                            <form action="" method="">
                            @csrf
                                <!--        You can switch " data-color="green" "  with one of the next bright colors: "blue", "azure", "orange", "red"       -->

                                <div class="wizard-header">
                                    <h3 class="wizard-title">Proceso Finalizado</h3>
                                </div>
                                <div class="wizard-navigation">
                                    <div class="progress-with-circle">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="1"
                                            aria-valuemax="4" style="width: 15%;"></div>
                                    </div>
                                    <ul>
                                        <li>
                                            <a href="#informacion">
                                                <div class="icon-circle">
                                                    <i class="ti-check-box"></i>
                                                </div>
                                            </a>
                                        </li>
                                        
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane" id="informacion">
                                        <h3 style="text-align: center;">SOLICITUD ENVIADA</h3>
                                        <div class="row" style="text-align: center">
                                            <h5 style="padding: 25px">Su solicitud a sido enviada al terapeuta, el se comunicara con usted lo antes posible para confirmar su cita. </h5>
                                            <div>
                                                <img src="principal/assets/img/registro.png"  width="150" height="150">
                                                <p style="padding: 25px">Gracias por su tiempo.</p>

                                            </div>
                                        </div>
                                    </div>
		                        </div>
		                        <div style="text-aling:center">
	                            	<div style="text-align: center;">
	                                    <input type='button' onclick="location.href='/'" class='btn btn-fill btn-danger btn-wd' value='Aceptar' />
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
</script>