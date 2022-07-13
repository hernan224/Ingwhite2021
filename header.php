<?php
    // Inicializar Clima
    $urlClima = 'https://ingenierowhite.com/clima/';
    $zipNombre = 'AccuWheaterGlobalCurrent_16453.zip';
    $copiaZip = 'ClimaActual.zip';
    $pathXML = '/library/clima/';
    $xmlNombre = 'AccuWheaterGlobalCurrent_16453.xml';
    $tmplDir = get_template_directory();

    $newClima = new Clima_Controller($urlClima, $zipNombre, $copiaZip, $pathXML, $xmlNombre, $tmplDir);

    $climaObj = $newClima->getClimaObj();

    $climaIcon = ($climaObj === FALSE)
        ? false
        : $newClima->getIcon($climaObj);
    $climaTmp = ($climaObj === FALSE)
        ? false
        : $newClima->getTemp($climaObj);
    $climaST = ($climaObj === FALSE)
        ? false
        : $newClima->getTempSt($climaObj);
    $climaCondition = ($climaObj === FALSE)
        ? false
        : $newClima->getCondition($climaObj);
    $climaHum  = ($climaObj === FALSE)
        ? false
        : $newClima->getHumidity($climaObj);
    $climaPress = ($climaObj === FALSE)
        ? false
        : $newClima->getPression($climaObj);
    $climaWind = ($climaObj === FALSE)
        ? false
        : $newClima->getWind($climaObj);
?>

<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head <?php do_action( 'add_head_attributes' ); ?>>
		<meta charset="utf-8">

		<?php // force Internet Explorer to use the latest rendering engine available ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title><?php wp_title(' - '); ?></title>

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-touch.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

		<?php // drop Google Analytics Here ?>
		<?php // end analytics ?>

	</head>

    <body <?php body_class(); ?>>

        <!-- Hidden SVG Logo -->
        <div class="hidden">
            <svg xmlns="http://www.w3.org/2000/svg" >
                <symbol id="svgMainLogo" viewBox="0 0 375.2 65.47"><path d="M65.47 32.73C65.47 14.66 50.81 0 32.74 0 14.66 0 0 14.66 0 32.73c0 18.08 14.66 32.73 32.74 32.73 18.07.01 32.73-14.65 32.73-32.73" fill="#e53f2b"/><path fill="#ffffff" d="M15.95 18.58h5.52v4.66h-5.52v-4.66zm.14 6.7h5.25v18.51h-5.25V25.28zM24.75 25.28h5.32l2.97 11.22 3.49-11.29h4.52l3.52 11.32 3.04-11.25h5.22l-5.77 18.64h-4.73l-3.56-11.36-3.62 11.36h-4.7z"/><g><path class="main-logo-text" d="M82.07 19.27h2.11v2.31h-2.11v-2.31zm.21 6.91h1.69v17.61h-1.69V26.18zM88.4 26.18h1.69v3.28c1.17-2.07 3.14-3.69 6.35-3.69 4.46 0 7.04 3.04 7.04 7.25v10.77h-1.69V33.32c0-3.63-2.04-6.01-5.59-6.01-3.45 0-6.11 2.63-6.11 6.28v10.19H88.4v-17.6zM107.17 46.69l1-1.38c2.11 1.62 4.52 2.49 7.11 2.49 4.04 0 6.91-2.31 6.91-6.84V38.4c-1.52 2.18-3.87 4.07-7.35 4.07-4.25 0-8.46-3.25-8.46-8.29v-.07c0-5.07 4.21-8.35 8.46-8.35 3.52 0 5.9 1.86 7.35 3.94v-3.52h1.69v14.88c0 2.56-.83 4.56-2.24 5.97-1.52 1.52-3.8 2.35-6.39 2.35-2.93 0-5.66-.9-8.08-2.69m15.12-12.54v-.07c0-4.07-3.63-6.7-7.29-6.7-3.69 0-6.8 2.56-6.8 6.66v.07c0 3.97 3.18 6.73 6.8 6.73 3.67.01 7.29-2.68 7.29-6.69M127.18 35.01v-.07c0-5.11 3.59-9.18 8.36-9.18 4.94 0 8.08 4.01 8.08 9.22 0 .31 0 .41-.04.69h-14.61c.31 4.38 3.45 6.94 6.91 6.94 2.73 0 4.59-1.21 6.04-2.76l1.17 1.04c-1.79 1.93-3.9 3.31-7.28 3.31-4.62 0-8.63-3.7-8.63-9.19m14.61-.86c-.24-3.56-2.28-6.84-6.32-6.84-3.49 0-6.18 2.94-6.49 6.84h12.81zM146.71 26.18h1.69v3.28c1.17-2.07 3.14-3.69 6.35-3.69 4.46 0 7.04 3.04 7.04 7.25v10.77h-1.69V33.32c0-3.63-2.04-6.01-5.59-6.01-3.45 0-6.11 2.63-6.11 6.28v10.19h-1.69v-17.6zM165.75 19.27h2.11v2.31h-2.11v-2.31zm.21 6.91h1.69v17.61h-1.69V26.18zM170.93 35.01v-.07c0-5.11 3.59-9.18 8.36-9.18 4.94 0 8.08 4.01 8.08 9.22 0 .31 0 .41-.03.69h-14.61c.31 4.38 3.45 6.94 6.91 6.94 2.73 0 4.59-1.21 6.04-2.76l1.17 1.04c-1.79 1.93-3.9 3.31-7.28 3.31-4.63 0-8.64-3.7-8.64-9.19m14.61-.86c-.24-3.56-2.28-6.84-6.32-6.84-3.49 0-6.18 2.94-6.49 6.84h12.81zM190.46 26.18h1.69v5.01c1.38-3.14 4.32-5.42 7.8-5.28v1.86h-.17c-4.07 0-7.63 3.07-7.63 8.8v7.22h-1.69V26.18zM200.14 35.05v-.07c0-4.94 3.83-9.22 9.08-9.22 5.21 0 9.01 4.21 9.01 9.15v.07c0 4.94-3.83 9.22-9.08 9.22-5.21 0-9.01-4.21-9.01-9.15m16.26 0v-.07c0-4.25-3.18-7.63-7.25-7.63-4.18 0-7.18 3.42-7.18 7.56v.07c0 4.25 3.18 7.63 7.25 7.63 4.18 0 7.18-3.42 7.18-7.56M218.79 25.55h4.28l3.66 12.5 4.04-12.57h3.55l4.08 12.57 3.73-12.5h4.17l-5.97 18.37h-3.73l-4.07-12.46-4.11 12.46h-3.73zM247.88 18.58h4.18v9.81c1.17-1.73 2.87-3.21 5.7-3.21 4.11 0 6.49 2.76 6.49 7.01v11.6h-4.18V33.43c0-2.83-1.42-4.45-3.9-4.45-2.42 0-4.11 1.69-4.11 4.52v10.29h-4.18V18.58zM267.38 18.79h4.49v3.97h-4.49v-3.97zm.18 6.76h4.18v18.23h-4.18V25.55zM275.93 38.74v-9.6h-2.31v-3.59h2.31v-5.01h4.18v5.01h4.9v3.59h-4.9v8.94c0 1.62.83 2.28 2.24 2.28.93 0 1.76-.21 2.59-.62v3.42c-1.04.59-2.21.93-3.76.93-3.08.01-5.25-1.34-5.25-5.35M285.79 34.74v-.07c0-5.21 3.7-9.49 8.91-9.49 5.8 0 8.74 4.56 8.74 9.81 0 .38-.04.76-.07 1.17h-13.4c.45 2.97 2.56 4.63 5.25 4.63 2.04 0 3.49-.76 4.94-2.18l2.45 2.18c-1.73 2.07-4.11 3.42-7.46 3.42-5.29-.01-9.36-3.84-9.36-9.47m13.5-1.35c-.28-2.69-1.87-4.8-4.63-4.8-2.56 0-4.35 1.97-4.73 4.8h9.36zM305.07 40.85h2.28v2.94h-2.28zM309.99 35.05v-.07c0-4.94 3.94-9.22 8.98-9.22 3.32 0 5.39 1.52 7.04 3.25l-1.21 1.24c-1.52-1.55-3.25-2.9-5.87-2.9-4.01 0-7.11 3.35-7.11 7.56v.07c0 4.25 3.21 7.63 7.25 7.63 2.49 0 4.42-1.28 5.9-2.93l1.17 1.04c-1.8 2.04-3.94 3.49-7.18 3.49-5.07-.01-8.97-4.22-8.97-9.16M327.24 35.05v-.07c0-4.94 3.83-9.22 9.08-9.22 5.21 0 9.01 4.21 9.01 9.15v.07c0 4.94-3.83 9.22-9.08 9.22-5.21 0-9.01-4.21-9.01-9.15m16.27 0v-.07c0-4.25-3.18-7.63-7.25-7.63-4.18 0-7.18 3.42-7.18 7.56v.07c0 4.25 3.18 7.63 7.25 7.63 4.17 0 7.18-3.42 7.18-7.56M348.58 26.18h1.69v3.14c1.14-1.83 2.73-3.56 5.87-3.56 3.07 0 4.97 1.76 5.94 3.8 1.14-1.97 3.04-3.8 6.35-3.8 4.18 0 6.77 2.94 6.77 7.35v10.67h-1.69V33.32c0-3.8-1.97-6.01-5.21-6.01-2.97 0-5.56 2.28-5.56 6.21v10.26h-1.69V33.22c0-3.66-2-5.91-5.14-5.91-3.14 0-5.63 2.76-5.63 6.32v10.15h-1.69v-17.6z"/></g></symbol>
            </svg>
        </div>
		<div id="fb-root"></div>
		<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v12.0&appId=879897482081350&autoLogAppEvents=1" nonce="QR8GsLaJ"></script>

		<div id="container">
			<!-- <div id="top-header" class="hidden-xs hidden-sm">
				<div class="wrap cf">
					<span class="header-date"> -->
                        <?php //echo "$dias[$day] $numero_dia de $meses[$month] de $year"; ?>
            						<!-- Lunes 22 de Julio de 2019 -->
                    <!-- </span>
				</div>
			</div> -->

            <?php
                // $bg_num = rand(1, 3);

                // if (isset($bg_num)){
                //     $clase_header = "bg-$bg_num";
                // }else{
                //     $clase_header = 'bg-0';
                // }
            ?>

        <?php // Show the date
            $dias = array(
                'Sunday'    =>  'Domingo',
                'Monday'    =>  'Lunes',
                'Tuesday'   =>  'Martes',
                'Wednesday' =>  'Miércoles',
                'Thursday'  =>  'Jueves',
                'Friday'    =>  'Viernes',
                'Saturday'  =>  'Sábado'
            );

            $meses = array(
                'January'   => 'Enero',
                'February'  => 'Febrero',
                'March'     => 'Marzo',
                'April'     => 'Abril',
                'May'       => 'Mayo',
                'June'      => 'Junio',
                'July'      => 'Julio',
                'August'    => 'Agosto',
                'September' => 'Septiembre',
                'October'   => 'Octubre',
                'November'  => 'Noviembre',
                'December'  => 'Diciembre'
            );

            date_default_timezone_set('America/Argentina/Buenos_Aires');

            $day = date('l');
            $numero_dia = date('j');
            $month = date('F');
            $year = date('Y');

        ?>
            <div id="top-header" class="hidden-xs hidden-sm">
                <!-- <div class="top-header-left">
                    <button class="top-header-menu-btn nav-button">
                        <div class="nav-icon icon-left">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        Menú
                    </button>
                </div> -->
				<div class="header-container">
                    <a id="topHeaderLogo" class="main-logo" href="<?php echo home_url(); ?>" rel="nofollow">
                        <svg class="main-logo-svg">
                            <use href="#svgMainLogo" xml:href="#svgMainLogo"></use>
                        </svg>
                    </a>
                    <div class="header-container-right">
                        <p class="top-header-date"><strong>
                            <?php echo "$dias[$day] $numero_dia de $meses[$month] de $year"; ?>
                        </strong></p>
                        <p class="top-header-weather">
                            <?php if ($climaIcon):
                                $iconUrl = get_template_directory_uri().'/library/images/weather-icons/'.$climaIcon.'.svg';
                            ?>
                            <img class="weather-icon"  src="<?php echo $iconUrl ?>" alt="<?php echo $climaCondition ?>">
                            <?php endif; ?>

                            <?php if ($climaTmp) :  ?>
                            <strong class="clima-temp" style="margin-right: 0.25rem"><?php echo $climaTmp ?>°C</strong>
                            <?php endif ?>
                            <?php if ($climaCondition) :  ?>
                            <span class="estado-descripcion"><?php echo $climaCondition ?></span>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
                <!-- <div class="top-header-right">
                    <button class="top-header-menu-btn nav-button">
                        Buscar
                        <i class="fa fa-search fa-lg icon-right" aria-hidden="true"></i>
                    </button>
                    <button class="top-header-menu-btn nav-button">
                        Seguinos
                        <i class="fa fa-share-alt fa-lg icon-right" aria-hidden="true"></i>
                    </button>
                </div> -->
			</div>
			<header class="header hidden-xs hidden-sm" role="banner">
				<div id="inner-header" class="wrap cf">
                    <div class="row between-xs ">
                        <!-- Fecha -->
                        <div class="col-xs-6">
                            <a id="mainLogo" href="<?php echo home_url(); ?>" rel="nofollow">
                                <svg class="main-logo-svg">
                                    <use href="#svgMainLogo" xml:href="#svgMainLogo"></use>
                                </svg>
                            </a>
                            <p class="header-date">
                            <?php echo "$dias[$day] $numero_dia de $meses[$month] de $year"; ?>
                                        <!-- Lunes 22 de Julio de 2019 -->
                            </p>
                        </div>
                        <!-- <div class="col-xs-6 logo-container"> -->
                            <!-- LOGO NORMAL -->


                            <!-- LOGO NAVIDAD -->
                          <!--<a id="logo" href="<?php //echo home_url(); ?>" rel="nofollow" style="background: transparent url('http://ingenierowhite.com/sitio_core/wp-content/themes/Ingwhite/library/images/header-logo-navidad.png') no-repeat center center; background-size: contain; height: 90px; margin-top: 1rem;">Ingenierowhite.com</a>-->
                        <!-- </div>  end of #logo -->

                        <div class="col-xs-3 clima-container hidden-xs">
                            <div class="clima-content-container">
                            <?php if ($climaObj === FALSE) : ?>
                                <p class="clima-sin-datos text-center">No hay información meteorológica disponible. <br/> Para conocer el estado del tiempo <a class="clima-link" target="_blank" rel="nofollow" href="http://www.accuweather.com/es/ar/ingeniero-white/7702/weather-forecast/7702">haga click aquí</a>.</p>

                            <?php else :?>

                                <div class="clima-estado-general">
                                    <div class="clima-temp-icon">
                                        <?php if ($climaIcon):
                                            $iconUrl = get_template_directory_uri().'/library/images/weather-icons/'.$climaIcon.'.svg';
                                        ?>
                                        <!-- <i class="clima-icono wi <?php //echo $climaIcon; ?>"></i> -->

                                        <img class="weather-icon" src="<?php echo $iconUrl ?>" alt="">
                                        <?php endif; ?>
                                        <?php if ($climaTmp) :  ?>
                                        <span class="clima-temp"><?php echo $climaTmp ?>°C</span>
                                        <?php endif ?>
                                        <?php if ($climaCondition) :  ?>
                                    </div>

                                    <p class="estado-descripcion"><?php echo $climaCondition ?></p>
                                    <?php endif; ?>
                                    <a class="clima-btn" href="http://www.ingenierowhite.com/pronostico-clima/">Ver pronóstico extendido  <i class="fa fa-chevron-right"></i></a>
                                </div>
                                <!-- <div class="clima-detalle">
                                    <?php //if ($climaST) :  ?>
                                    <span class="clima-st"><i class="wi wi-thermometer"></i> &nbsp;<?php //echo $climaST ?>°C</span>
                                    <?php //endif; ?>

                                    <?php
                                    //if ($climaWind) : ?>

                                        <span class="clima-viento"><i class="<?php //echo 'wi wi-wind-direction '.$climaWind['icon'] ?>"></i>&nbsp;<?php //echo $climaWind['speed'] .'&nbsp;'. $climaWind['unit'] .'&nbsp;' . $climaWind['direction'] ?></span>
                                    <?php //endif; ?>
                                    <br class="clima-separador"/>
                                    <?php //if ($climaHum) :  ?>
                                    <span class="clima-humedad"><i class="wi wi-humidity"></i>&nbsp;<?php //echo $climaHum ?>%</span>
                                    <?php //endif; ?>

                                    <?php //if ($climaPress) :  ?>
                                    <span class="clima-pres"><i class="wi wi-barometer"></i>&nbsp;<?php //echo ($climaPress*10) ?>&nbsp;HPa</span>
                                    <?php //endif; ?>

                                </div> -->
                            <?php endif; ?>
                            </div> <!-- / .clima-content-container -->
                        </div> <!-- end of clima container -->
                    </div>
                </div> <!-- end of #inner-header -->

                <nav id="nav-principal" class="cf" role="navigation">

                    <div class="wrap cf">
                        <div class="row between-xs">
                            <div class="col-xs-12 col-sm-6 col-md-9">
                           <!-- <div class="col-xs-12">-->
                                <?php wp_nav_menu(array(
                                    'container' => false,                           // remove nav container
                                    'container_class' => 'menu cf',                 // class of container (should you choose to use it)
                                    'menu' => __('The Main Menu', 'bonestheme'),    // nav name
                                    'menu_class' => 'nav top-nav cf',               // adding custom nav class
                                    'theme_location' => 'main-nav',                 // where it's located in the theme
                                    'before' => '',                                 // before the menu
                                    'after' => '',                                  // after the menu
                                    'link_before' => '',                            // before each link
                                    'link_after' => '',                             // after each link
                                    'depth' => 0,                                   // limit the depth of the nav
                                    'fallback_cb' => ''                             // fallback function (if there is one)
                                )); ?>

                            </div>
                            <div class="col-sm-6 col-md-3 last-col">
                                <ul class="header-social row">
                                    <!--<li><a href="<?php bloginfo('rss2_url'); ?>" target="_blank" title="RSS Feed"><i class="fa fa-lg fa-rss"></i></a></li>-->
                                    <li><a href="https://www.facebook.com/IngenieroWhiteOficial" target="_blank" title="Facebook"><i class="fa fa-lg fa-facebook"></i></a></li>
                                    <li><a href="https://twitter.com/IWOficial" target="_blank" title="Twitter"><i class="fa fa-lg fa-twitter"></i></a></li>
                                    <li><a href="https://www.flickr.com/photos/128423552@N08" target="_blank" title="Flickr"><i class="fa fa-lg fa-flickr"></i></a></li>
                                  	<li><a title="Youtube" target="_blank" href="https://www.youtube.com/channel/UCqRlBKULtbYGe-dCTvj8k6w"><i class="fa fa-lg fa-youtube"></i></a></li>
                                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-search fa-lg"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <?php get_search_form(); ?>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>


                    </div>

                </nav>

            </header>

            <header id="mobileHeader" class="header-mobile hidden-lg hidden-md">
                <a href="#" class="show-sidemenu-btn mobile-header-btn">
                    <i class="fa fa-bars fa-lg"></i>
                </a>
                <a class="mobile-header-logo" href="<?php echo home_url(); ?>" rel="nofollow"><img src="<?= get_template_directory_uri() ?>/library/images/header-logo.png" alt="IngenieroWhite.com" class="img-responsive"></a>
                <span class="dropdown search-dropdown new-search-bar">
                    <a href="#" class="dropdown-toggle mobile-header-btn" data-toggle="dropdown"><i class="fa fa-search fa-lg"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <?php get_search_form(); ?>
                    </div>
                </span>
            </header>

            <div id="mobileSidemenu" class="sidemenu-container">
                <div class="sidemenu-overlay close-sidemenu"></div>
                <div class="sidemenu-content">
                    <a href="#" class="close-sidemenu-btn close-sidemenu" data-prevent="true"><i class="fa fa-times"></i></a>
                    <header class="sidemenu-header">
                        <a class="sidemenu-logo" href="<?php echo home_url(); ?>" rel="nofollow"><img src="<?= get_template_directory_uri() ?>/library/images/header-logo.png" alt="IngenieroWhite.com" class="img-responsive"></a>
                        <p class="sidemenu-date"><strong>
                            <?php echo "$dias[$day] $numero_dia de $meses[$month] de $year"; ?>
                        </strong></p>
                        <p class="sidemenu-weather">
                            <?php if ($climaIcon):
                                $iconUrl = get_template_directory_uri().'/library/images/weather-icons/'.$climaIcon.'.svg';
                            ?>
                            <img class="weather-icon"  src="<?php echo $iconUrl ?>" alt="<?php echo $climaCondition ?>">
                            <?php endif; ?>

                            <?php if ($climaTmp) :  ?>
                            <strong class="clima-temp" style="font-size:1.4em; margin-right: 0.25rem"><?php echo $climaTmp ?>°C</strong>
                            <?php endif ?>
                            <?php if ($climaCondition) :  ?>
                            <span class="estado-descripcion"><?php echo $climaCondition ?></span>
                            <?php endif; ?>
                        </p>
                    </header>
                    <nav class="sidemenu-nav">
                    <?php wp_nav_menu(array(
                        'container' => false,                           // remove nav container
                        'container_class' => 'menu cf',                 // class of container (should you choose to use it)
                        'menu' => __('The Main Menu', 'bonestheme'),    // nav name
                        'menu_class' => 'nav mobile-nav cf',            // adding custom nav class
                        'container' => 'div',
                        'walker' => new submenuWrap(),
                        'theme_location' => 'main-nav',                 // where it's located in the theme
                        'before' => '',                                 // before the menu
                        'after' => '',                                  // after the menu
                        'link_before' => '',                            // before each link
                        'link_after' => '',                             // after each link
                        'depth' => 0,                                   // limit the depth of the nav
                        'fallback_cb' => ''                             // fallback function (if there is one)
                    )); ?>
                    </nav>
                    <footer class="sidemenu-footer">
                        <div class="social-networks-container">
                            <a title="Facebook" target="_blank" href="https://www.facebook.com/IngenieroWhiteOficial"><i class="fa fa-lg fa-facebook"></i></a>
                            <a title="Twitter" target="_blank" href="https://twitter.com/IWOficial"><i class="fa fa-lg fa-twitter"></i></a>
                            <a title="Flickr" target="_blank" href="https://www.flickr.com/photos/128423552@N08"><i class="fa fa-lg fa-flickr"></i></a>
                            <a title="Youtube" target="_blank" href="https://www.youtube.com/channel/UCqRlBKULtbYGe-dCTvj8k6w"><i class="fa fa-lg fa-youtube"></i></a>
                            <!--<li><a title="Vimeo" target="_blank" href="https://vimeo.com/ingenierowhite"><i class="fa fa-lg fa-vimeo-square"></i></a></li>-->
                            <a title="RSS Feed" target="_blank" href="https://www.ingenierowhite.com/feed/rdf/"><i class="fa fa-lg fa-rss"></i></a>
                            <a title="Contacto" href="mailto:contacto@ingenierowhite.com"><i class="fa fa-lg fa-envelope"></i></a>
                        </div>
                    </footer>
                </div>
            </div>