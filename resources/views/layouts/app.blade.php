<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Salud Integral</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/Contenido-04.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />

    <script>
        window.Laravel = <?php echo json_encode([
                                'csrfToken' => csrf_token(),
                                'apiToken' => Auth::user()->api_token ?? null
                            ]); ?>
    </script>
    <!-- Scripts -->
    @vite('resources/js/app.js')
</head>

<body style="background-color: #a1b6a7;">
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between" style="padding-bottom: 15px; padding-top: 10px;">

                    <a href="home" class="text-nowrap logo-img">
                        <img src="../assets/images/logos/logo_vertical-05.png" width="200" alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">

                    <ul id="sidebarnav">

                        <?php
                        $idModulo = Session::get('useradmin.idModulo.0');

                        $listaPermisos = Session::get('useradmin.permisos.0');

                        $llave_array = array_search($idModulo, array_column($listaPermisos, 'parent_id'));
                        $opcionesMenu = array();

                        while (($llave_array != NULL) || ($llave_array !== false)) {

                            if ($listaPermisos[$llave_array]['categoria'] == 'Menu')
                                $opcionesMenu[] = $listaPermisos[$llave_array];

                            array_splice($listaPermisos, $llave_array, 1);
                            $llave_array = array_search($idModulo, array_column($listaPermisos, 'parent_id'));
                        }
                        $opciones = '';
                        foreach ($opcionesMenu as $key => $opcion) {
                            $bandera_submenu = 0;
                            $array_submenu = getKeysMultiArray($listaPermisos, 'parent_id', $opcion['id'], 'Submenu');
                            if (!empty($array_submenu)) {
                                if ($opcion['url'] != 'javascript:void(0)')
                                    $opciones .= '<li class="sidebar-item"><a class="sidebar-link" href="' . asset($opcion['url']) . '"><i class="' . $opcion['class'] . '"></i><span>' . $opcion['text_html'] . '</span></a></li>';
                                else
                                    $opciones .= '<li class="sidebar-item"><a class="sidebar-link" data-bs-target="#opc' . $opcion['id'] . '-nav" data-bs-toggle="collapse" href="#" aria-expanded="false" ><i class="' . $opcion['class'] . '"></i><span>' . $opcion['text_html'] . '</span><i class="bi bi-chevron-down ms-auto"></i></a><ul id="opc' . $opcion['id'] . '-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">';

                                foreach ($array_submenu as $sub) {
                                    $opciones .= '<li class="sidebar-item" style="margin-left: 20px;"><a class="sidebar-link" href="' . asset($sub['url']) . '"><i class="' . $sub['class'] . '"></i><span>' . $sub['text_html'] . '</span></a></li>';
                                }
                                $opciones .= '</ul></li>';
                            } else {
                                if ($opcion['url'] != 'javascript:void(0)')
                                    $opciones .= '<li class="sidebar-item"><a class="sidebar-link" href="' . asset($opcion['url']) . '" alt="' . $opcion['text_html'] . '"><i class="' . $opcion['class'] . '"></i><span>' . $opcion['text_html'] . '</span></a></li>';
                                else
                                    $opciones .= '<li class="sidebar-item"><a class="sidebar-link" href="#" alt="' . $opcion['text_html'] . '"><i class="' . $opcion['class'] . '"></i><span>' . $opcion['text_html'] . '</span></a><ul>';
                            }
                        }


                        echo $opciones;
                        ?>
                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-icon-hover" data-bs-toggle="dropdown" aria-expanded="false" href="javascript:void(0)">
                                <i class="ti ti-bell-ringing"></i>
                                
                                <div class="notification rounded-circle" style="text-align:center; background-color: #FA5757">
                                <?php
                                 use App\Models\Agenda;
                                 $especialista = Agenda::where('especialista_id', Auth::user()->id)
                                 ->where('estatus', 'Activo')
                                 ->where('proceso', 'Apartada')
                                 ->count();
                                 if($especialista != 0)
                                    echo '<p style="font-size: 13px; margin-top: -25px; margin-left:5px; color: white;"><b>'.$especialista.'</b></p>'
                                ?>                            
                                </div>
                            </a>
                            <ul class="dropdown-menu">
                            <?php
                                use App\Models\Prospecto;
                                $prospecto = [];
                                 $especialista = Agenda::where('especialista_id', Auth::user()->id)
                                 ->where('estatus', 'Activo')
                                 ->where('proceso', 'Apartada')
                                 ->get();
                                 foreach ($especialista as $info){
                                    $prospecto = Prospecto::find($info['prospecto_id']);
                                    echo ' <li><a class="dropdown-item">'. $prospecto['nombre'].' / ' .$info['fecha']. ' / ' .substr($info['hora'],0,5) . '</a></li>';
                                 }
                                    
                                ?>
                            </ul>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">

                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <span class="d-none d-md-block ps-2">{{ Auth::user()->name }}</span>
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php 
                                use App\Models\Especialista;
                                $especialista = Especialista::where('user_id', Auth::user()->id)
                                ->where('estatus', 'Activo')
                                ->first();
                                if(empty($especialista)){
                                    echo '<img src="../assets/images/logos/perfil.png" alt="" width="35" height="35" class="rounded-circle">';
                                }else{
                                    $imagenReal =  substr($especialista['foto']['imagen_path'],6);
                                    
                                    echo '<img src="storage/'. $imagenReal. '" alt="" width="35" height="35" class="rounded-circle">';
                                }
                               
                                ?>
                                
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="contraseña" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-lock fs-6"></i>
                                            <p class="mb-0 fs-3">Cambiar Contraseña</p>
                                        </a>
                                        <!-- <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-mail fs-6"></i>
                                            <p class="mb-0 fs-3">My Account</p>
                                        </a> -->
                                        <!-- <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-list-check fs-6"></i>
                                            <p class="mb-0 fs-3">My Task</p>
                                        </a> -->
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                                     > 
                                            {{ __('Cerrar Sesion') }}
                                            <i class="ti ti-arrow-right fs-6"></i>
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            <div class="container-fluid">
                <!--  Row 1 -->



                <div class="row">
                    <div id="app">
                        <main id="main" class="main">

                            <section class="section">
                                <?php
                                function getKeysMultiArray($multiarray, $field, $value, $type)
                                {
                                    $returnArray = [];
                                    foreach ($multiarray as $key => $array) {
                                        if (($array[$field] === $value) && ($array['categoria'] == $type))
                                            $returnArray[] = $array;
                                    }
                                    return $returnArray;
                                }
                                ?>
                                <div class="row" style="height: 85vh;">
                                    @yield('content')
                                </div>
                            </section>

                        </main><!-- End #main -->
                    </div>
                </div>
                <div class="py-6 px-6 text-center">
                    <!-- <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank" class="pe-1 text-primary text-decoration-underline">AdminMart.com</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a></p> -->
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
    <script type="text/javascript">
        window.vue_url = '{{config('
        app.url ')}}'
    </script>
    @yield('javascript')
</body>

</html>