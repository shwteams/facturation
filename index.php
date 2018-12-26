<?php
if(!isset($_SESSION))
    session_start();
if(isset($_SESSION['str_SECURITY_ID']) && !empty($_SESSION['str_SECURITY_ID']))
{
?>
<!DOCTYPE html>
<html lang="fr" >
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>
			SUNU | Outil d'édition de facture
		</title>
		<meta name="description" content="Application de gestion des incidents">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!--begin::Web font -->
		<script src="services/js/webfont.js"></script>
		<!--<script>
          WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
		</script>-->
		<!--end::Web font -->
		<script src="services/plugins/jquery/dist/jquery.min.js"></script>
		<!--begin::Base Styles -->
		<link href="services/css_js/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
		<link href="services/css_js/base/style.bundle.css" rel="stylesheet" type="text/css" />
		<script src="services/js/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="services/css/sweetalert.css">
		<!-- Datatables-->
		<script src="services/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
		<script src="services/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
        
        <script src="services/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="services/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
		
		<link rel="stylesheet" href="services/plugins/datatables/jquery.dataTables.css" />
        <link rel="stylesheet" href="services/plugins/datatables/dataTables.bootstrap.css" />

        <link rel="stylesheet" href="services/plugins/datatables/jquery.dataTables.css" />
        <link rel="stylesheet" href="services/plugins/datatables/dataTables.bootstrap.css" />
		<link href="services/css/site.css" rel="stylesheet" type="text/css" />
        <!-- datetime -->
        <link rel="stylesheet" type="text/css" href="services/css/jquery.datetimepicker.min.css"/>
        <!-- fin datetime -->
		<!--end::Base Styles -->

		<link rel="shortcut icon" href="assets/demo/default/media/img/logo/favicon.ico" />
        <!--<meta http-equiv="refresh" content="6600">-->
	</head>
	<!-- end::Head -->
	<!-- end::Body oncontextmenu="return false;" onselectstart="return false" ondragstart="return false" -->
	<body  class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default m-header--minimize-off"  >
		<!--<div class="loader" id="loader-bar">
			<div class="contener_general"> 
				<div class="contener_mixte">
					<div class="ballcolor ball_1">&nbsp;</div>
				</div> 
				<div class="contener_mixte">
					<div class="ballcolor ball_2">&nbsp;</div>
				</div> 
				<div class="contener_mixte">
					<div class="ballcolor ball_3">&nbsp;</div>
				</div> 
				<div class="contener_mixte">
					<div class="ballcolor ball_4">&nbsp;</div>
				</div> 
			</div>
		</div>-->
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<!-- BEGIN: Header -->
			<header class="m-grid__item    m-header "  data-minimize-mobile="hide" data-minimize-offset="200" data-minimize-mobile-offset="200" data-minimize="minimize" >
				<div class="m-container m-container--fluid m-container--full-height">
					<div class="m-stack m-stack--ver m-stack--desktop">
						<!-- BEGIN: Brand -->
						<div class="m-stack__item m-brand  m-brand--skin-dark ">
							<div class="m-stack m-stack--ver m-stack--general">
								<div class="m-stack__item m-stack__item--middle m-brand__logo">
									<a href="index.php" class="m-brand__logo-wrapper">
										<img alt="" src="services/img/logo.png" width="110" height="70"/>
									</a>
								</div>
								<div class="m-stack__item m-stack__item--middle m-brand__tools">
									<!-- BEGIN: Left Aside Minimize Toggle -->
									<a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block 
					 ">
										<span></span>
									</a>
									<!-- END -->
									<!-- BEGIN: Responsive Aside Left Menu Toggler -->
									<a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
										<span></span>
									</a>
									<!-- END -->
									<!-- BEGIN: Responsive Header Menu Toggler -->
									<a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
										<span></span>
									</a>
									<!-- END -->
									<!-- BEGIN: Topbar Toggler -->
									<a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
										<i class="flaticon-more"></i>
									</a>
									<!-- BEGIN: Topbar Toggler -->
								</div>
							</div>
						</div>
						<!-- END: Brand -->
						<?php include('header-.php'); ?>
					</div>
				</div>
			</header>
			<!-- END: Header -->
			<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
				<!-- BEGIN: Left Aside -->
				<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
					<!-- BEGIN: Aside Menu -->
					<?php include('menu-.php'); ?>
					<!-- END: Aside Menu -->
				</div>
				<!-- END: Left Aside -->
				<div class="m-grid__item m-grid__item--fluid m-wrapper" id="contenue-application" >
					
					
				</div>
			</div>
			<!-- end:: Body -->
			<!-- begin::Footer -->
			<?php include('footer-.php'); ?>
			<!-- end::Footer -->
		</div>
		<!-- end:: Page -->
		<!-- begin::Scroll Top -->
		<div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
			<i class="la la-arrow-up"></i>
		</div>
		<script src="services/css_js/base/vendors.bundle.js" type="text/javascript"></script>
		<script src="services/css_js/base/scripts.bundle.js" type="text/javascript"></script>
		<!--end::Base Scripts -->
		<!--begin::Page Snippets -->
		<script src="services/js/dashboard.js" type="text/javascript"></script>
		<script src="services/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="services/plugins/datatables/dataTables.responsive.min.js"></script>
		<!--end::Page Snippets -->

        <script src="services/js/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="services/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
        <script src="services/js/build/jquery.datetimepicker.full.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function() {
                jQuery(".loader").remove();
            });
		</script>
		<script>
            $.datetimepicker.setLocale('fr');
            $.ajax("./services/center.php" + "?task=showHomeAdminPage")
                    .done(function (data, status, jqxhr) {
                        $('#contenue-application').empty();
                        $('#contenue-application').append(jqxhr.responseText).fadeIn();
                    });

            $('a.m_link').on('click', function (e) {
                e.preventDefault();
                var $btn = $(this);
                var task = $btn.attr('id');
                var content_top_number = "";
                //$.session.set("url_page", task);//en lien avec les boutons a afficher par pages

                $.ajax("./services/center.php" + "?task=" + task)
                    .done(function (data, status, jqxhr) {
                        $('#contenue-application').empty();
                        $('#contenue-application').html(jqxhr.responseText).fadeIn();
                    });
            });

            $(document).ready(function () {
                $('#datatable').dataTable();
            });
            $(document).ready(function () {
                $.ajax("./services/center.php" + "?task=showAllMenu")
                    .done(function (data, status, jqxhr) {
                        $('#IdgetMenu').empty();
                        $('#IdgetMenu').append(jqxhr.responseText).fadeIn();
                    });
            });
            
             $("#deconnexion").on('click', function(e){
                e.preventDefault();
                swal({
                    title: 'Demande de Confirmation',
                    text: "Etes-vous sûr de vouloir vous déconnecter ?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ff5858',
                    cancelButtonColor: '#fe4500',
                    confirmButtonText: 'Oui',
                    cancelButtonText: 'Non',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false,
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        window.location.href = "composant/com_security/controlersecurity.php?task=disconnect";
                    } else {
                        swal(
                            'Annulation',
                            'Opération annulé',
                            'error'
                        );
                    }
                });
            });

            $("#generate_all").on('click', function(e){
                e.preventDefault();
                swal({
                        title: 'Demande de Confirmation',
                        text: "Etes-vous sûr de vouloir vous générer tout les courriers sans en-tête?\n\r Cella peut prendre au moins une heure.",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ff5858',
                        cancelButtonColor: '#fe4500',
                        confirmButtonText: 'Oui',
                        cancelButtonText: 'Non',
                        confirmButtonClass: 'btn btn-success',
                        cancelButtonClass: 'btn btn-danger',
                        buttonsStyling: false,
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            swal(
                                'Génération',
                                'Génération en cour, veuillez patienter',
                                'info'
                            );
                            $.get("generer-courrier-sans-entete.php?task=printf", function(json, textStatus){
                                var obj = $.parseJSON(json);
                                if (obj[0].code_statut == "1")
                                {
                                    /*swal({
                                        title: "Opération de génération de courriers réussie!",
                                        text: obj[0].results,
                                        type: "success",
                                        confirmButtonText: "Ok"
                                    });*/
                                    window.open(obj[0].link_file , '_blank');
                                }
                                else{
                                    /*swal({
                                        title: "Echec de l'opéraion",
                                        text: obj[0].results,
                                        type: "error",
                                        confirmButtonText: "Ok"
                                    });*/
                                    window.open(obj[0].link_file , '_blank');
                                }
                            });
                        } else {
                            swal(
                                'Annulation',
                                'Opération annulé',
                                'error'
                            );
                        }
                    });
            });

            $("#generate_with_entete").on('click', function(e){
                e.preventDefault();
                swal({
                        title: 'Demande de Confirmation',
                        text: "Etes-vous sûr de vouloir vous générer tout les courriers avec en-tête?\n\r Cella peut prendre au moins une heure.",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ff5858',
                        cancelButtonColor: '#fe4500',
                        confirmButtonText: 'Oui',
                        cancelButtonText: 'Non',
                        confirmButtonClass: 'btn btn-success',
                        cancelButtonClass: 'btn btn-danger',
                        buttonsStyling: false,
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            swal(
                                'Génération',
                                'Génération en cours, veuillez patienter',
                                'info'
                            );
                            $.get("generer-courrier-avec-entete.php?task=printf", function(json, textStatus){
                                var obj = $.parseJSON(json);
                                if (obj[0].code_statut == "1")
                                {
                                    /*swal({
                                        title: "Opération de génération de courriers réussie !",
                                        text: obj[0].results,
                                        type: "success",
                                        confirmButtonText: "Ok"
                                    });*/
                                    window.open(obj[0].link_file , '_blank');
                                }
                                else{
                                    /*swal({
                                        title: "Echec de l'opéraion",
                                        text: obj[0].results,
                                        type: "error",
                                        confirmButtonText: "Ok"
                                    });*/
                                    window.open(obj[0].link_file , '_blank');
                                }
                            });
                        } else {
                            swal(
                                'Annulation',
                                'Opération annulé',
                                'error'
                            );
                        }
                    });
            });
            $('.date_timepicker_start').datetimepicker({
                format:'Y-m-d',
                onShow:function( ct ){
                    this.setOptions({
                        maxDate:jQuery('.date_timepicker_end').val()?jQuery('.date_timepicker_end').val():false
                    })
                },
                timepicker:false
            });
            $('.date_timepicker_end').datetimepicker({
                format:'Y-m-d',
                onShow:function( ct ){
                    this.setOptions({
                        minDate:jQuery('.date_timepicker_start').val()?jQuery('.date_timepicker_start').val():false
                    })
                },
                timepicker:false
            });
        </script>
	</body>
	<!-- end::Body -->

</html>
<?php
}
else
    header("location:login.php");
?>
