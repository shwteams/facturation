<?php
if(!isset($_SESSION))
    session_start();
if(!isset($_SESSION['str_SECURITY_ID']))
{
?>
<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>Login | Facturation</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

        <link rel="stylesheet" type="text/css" href="services/css/google.css" />
        <link rel="stylesheet" href="services/services/maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

        <link href="services/assets/css/material-dashboard.min40a0.css?v=2.0.2" rel="stylesheet" />

        <link href="services/assets/demo/demo.css" rel="stylesheet" />
        <link href="services/css/site.css" rel="stylesheet" />

    </head>
    <!-- oncontextmenu="return false;" onselectstart="return false" ondragstart="return false" class="off-canvas-sidebar" -->
    <body >

        <div class="wrapper wrapper-full-page">

            <div class="page-header login-page header-filter" filter-color="black" style="background-image: url('services/assets/img/login.jpg'); background-size: cover; background-position: top center;">
                <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
                <div class="container">
                    <div class="col-lg-4 col-md-6 col-sm-6 ml-auto mr-auto">
                        <form class="form" method="" action="#" id="frm-add">
                            <div class="card card-login card-hidden">
                                <div class="card-header card-header-rose text-center">
                                    <h4 class="card-title">Authentification</h4>
                                    <div class="social-line">
                                        <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                                            <i class="fa fa-facebook-square"></i>
                                        </a>
                                        <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                        <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                                            <i class="fa fa-google-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body ">
                                    <p class="card-description text-center">Veuillez vous authentifier</p>
                                    <span class="bmd-form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="material-icons">face</i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Nom d'utilisateur..." id="str_LOGIN" >
                                        </div>
                                    </span>
                                    <span class="bmd-form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="material-icons">lock_outline</i>
                                                </span>
                                            </div>
                                            <input type="password" class="form-control" placeholder="Mot de passe..." id="str_PASSWORD" >
                                        </div>
                                    </span>
                                </div>
                                <div class="card-footer justify-content-center">
                                    <button class="btn btn-danger" type="submit" id="soumettre">Connexion</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="services/assets/js/core/jquery.min.js" type="text/javascript"></script>
        <script src="services/assets/js/core/popper.min.js" type="text/javascript"></script>
        <script src="services/assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>

        <script src="services/assets/js/plugins/perfect-scrollbar.jquery.min.js" ></script>


        <!-- Plugin for the momentJs  -->
        <script src="services/assets/js/plugins/moment.min.js"></script>

        <!--  Plugin for Sweet Alert -->
        <script src="services/assets/js/plugins/sweetalert2.js"></script>

        <!-- Forms Validations Plugin -->
        <script src="services/assets/js/plugins/jquery.validate.min.js"></script>

        <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
        <script src="services/assets/js/plugins/jquery.bootstrap-wizard.js"></script>

        <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
        <script src="services/assets/js/plugins/bootstrap-selectpicker.js" ></script>

        <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
        <script src="services/assets/js/plugins/bootstrap-datetimepicker.min.js"></script>

        <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
        <script src="services/assets/js/plugins/jquery.dataTables.min.js"></script>

        <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
        <script src="services/assets/js/plugins/bootstrap-tagsinput.js"></script>

        <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
        <script src="services/assets/js/plugins/jasny-bootstrap.min.js"></script>

        <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
        <script src="services/assets/js/plugins/fullcalendar.min.js"></script>

        <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
        <script src="services/assets/js/plugins/jquery-jvectormap.js"></script>

        <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
        <script src="services/assets/js/plugins/nouislider.min.js" ></script>

        <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
        <script src="services/services/cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

        <!-- Library for adding dinamically elements -->
        <script src="services/assets/js/plugins/arrive.min.js"></script>


        <!--  Google Maps Plugin    -->

        <!-- Place this tag in your head or just before your close body tag. -->
        <script async defer src="services/services/buttons.github.io/buttons.js"></script>


        <!-- Chartist JS -->
        <script src="services/assets/js/plugins/chartist.min.js"></script>

        <!--  Notifications Plugin    -->
        <script src="services/assets/js/plugins/bootstrap-notify.js"></script>
        <script src="services/assets/js/material-dashboard.min40a0.js?v=2.0.2" type="text/javascript"></script>
        <script src="services/assets/demo/demo.js"></script>
        <script>
            $(document).ready(function () {
                $().ready(function () {
                    $sidebar = $('.sidebar');

                    $sidebar_img_container = $sidebar.find('.sidebar-background');

                    $full_page = $('.full-page');

                    $sidebar_responsive = $('body > .navbar-collapse');

                    window_width = $(window).width();

                    fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

                    if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
                        if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
                            $('.fixed-plugin .dropdown').addClass('open');
                        }

                    }

                    $('.fixed-plugin a').click(function (event) {
                        // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
                        if ($(this).hasClass('switch-trigger')) {
                            if (event.stopPropagation) {
                                event.stopPropagation();
                            } else if (window.event) {
                                window.event.cancelBubble = true;
                            }
                        }
                    });

                    $('.fixed-plugin .active-color span').click(function () {
                        $full_page_background = $('.full-page-background');

                        $(this).siblings().removeClass('active');
                        $(this).addClass('active');

                        var new_color = $(this).data('color');

                        if ($sidebar.length != 0) {
                            $sidebar.attr('data-color', new_color);
                        }

                        if ($full_page.length != 0) {
                            $full_page.attr('filter-color', new_color);
                        }

                        if ($sidebar_responsive.length != 0) {
                            $sidebar_responsive.attr('data-color', new_color);
                        }
                    });

                    $('.fixed-plugin .background-color .badge').click(function () {
                        $(this).siblings().removeClass('active');
                        $(this).addClass('active');

                        var new_color = $(this).data('background-color');

                        if ($sidebar.length != 0) {
                            $sidebar.attr('data-background-color', new_color);
                        }
                    });

                    $('.fixed-plugin .img-holder').click(function () {
                        $full_page_background = $('.full-page-background');

                        $(this).parent('li').siblings().removeClass('active');
                        $(this).parent('li').addClass('active');


                        var new_image = $(this).find("img").attr('src');

                        if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                            $sidebar_img_container.fadeOut('fast', function () {
                                $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                                $sidebar_img_container.fadeIn('fast');
                            });
                        }

                        if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                            $full_page_background.fadeOut('fast', function () {
                                $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                                $full_page_background.fadeIn('fast');
                            });
                        }

                        if ($('.switch-sidebar-image input:checked').length == 0) {
                            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
                            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                        }

                        if ($sidebar_responsive.length != 0) {
                            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
                        }
                    });

                    $('.switch-sidebar-image input').change(function () {
                        $full_page_background = $('.full-page-background');

                        $input = $(this);

                        if ($input.is(':checked')) {
                            if ($sidebar_img_container.length != 0) {
                                $sidebar_img_container.fadeIn('fast');
                                $sidebar.attr('data-image', '#');
                            }

                            if ($full_page_background.length != 0) {
                                $full_page_background.fadeIn('fast');
                                $full_page.attr('data-image', '#');
                            }

                            background_image = true;
                        } else {
                            if ($sidebar_img_container.length != 0) {
                                $sidebar.removeAttr('data-image');
                                $sidebar_img_container.fadeOut('fast');
                            }

                            if ($full_page_background.length != 0) {
                                $full_page.removeAttr('data-image', '#');
                                $full_page_background.fadeOut('fast');
                            }

                            background_image = false;
                        }
                    });

                    $('.switch-sidebar-mini input').change(function () {
                        $body = $('body');

                        $input = $(this);

                        if (md.misc.sidebar_mini_active == true) {
                            $('body').removeClass('sidebar-mini');
                            md.misc.sidebar_mini_active = false;

                            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

                        } else {

                            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

                            setTimeout(function () {
                                $('body').addClass('sidebar-mini');

                                md.misc.sidebar_mini_active = true;
                            }, 300);
                        }

                        // we simulate the window Resize so the charts will get updated in realtime.
                        var simulateWindowResize = setInterval(function () {
                            window.dispatchEvent(new Event('resize'));
                        }, 180);

                        // we stop the simulation of Window Resize after the animations are completed
                        setTimeout(function () {
                            clearInterval(simulateWindowResize);
                        }, 1000);

                    });
                });
            });
        </script>

        <script src="services/assets/demo/jquery.sharrre.js"></script>


        <script>
            /*$(document).ready(function () {

                var _gaq = _gaq || [];
                _gaq.push(['_setAccount', 'UA-46172202-1']);
                _gaq.push(['_trackPageview']);

                (function () {
                    var ga = document.createElement('script');
                    ga.type = 'text/javascript';
                    ga.async = true;
                    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                    var s = document.getElementsByTagName('script')[0];
                    s.parentNode.insertBefore(ga, s);
                })();

                // Facebook Pixel Code Don't Delete
                !function (f, b, e, v, n, t, s) {
                    if (f.fbq)
                        return;
                    n = f.fbq = function () {
                        n.callMethod ?
                                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                    };
                    if (!f._fbq)
                        f._fbq = n;
                    n.push = n;
                    n.loaded = !0;
                    n.version = '2.0';
                    n.queue = [];
                    t = b.createElement(e);
                    t.async = !0;
                    t.src = v;
                    s = b.getElementsByTagName(e)[0];
                    s.parentNode.insertBefore(t, s)
                }(window,
                        document, 'script', 'services/services/connect.facebook.net/en_US/fbevents.js');

                try {
                    fbq('init', '111649226022273');
                    fbq('track', "PageView");

                } catch (err) {
                    console.log('Facebook Track Error:', err);
                }

            });*/
            $(document).ready(function () {
                demo.checkFullPageBackgroundImage();
                setTimeout(function () {
                    // after 1000 ms we add the class animated to the login/register card
                    $('.card').removeClass('card-hidden');
                }, 700);
            });
			
			
        </script>
		<script src="composant/com_security/login.js"></script>
    </body>
</html>

<?php
}
else
    header("location:index.php");
?>
