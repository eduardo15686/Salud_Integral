<!doctype html>
<html lang="en">

<head>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9678376346589368"
        crossorigin="anonymous"></script>

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
    @vite(['resources/js/app.js'])
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

    <div class="row">
        <div id="app">
            <main id="main" class="main">
                <section class="section">
                    <div class="row" style="text-align: center;">
                        @yield('content')
                    </div>
                </section>
            </main><!-- End #main -->
        </div>
    </div>
    <script type="text/javascript">
        window.vue_url = '{{config('
        app.url ')}}'
    </script>
    @yield('javascript')
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