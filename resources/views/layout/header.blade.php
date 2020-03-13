<!doctype html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">

<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Cabal</title>
	<link rel="stylesheet" type="text/css" href="/components/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/components/font-awesome-5-0-6/css/fontawesome-all.css">
	<link rel="stylesheet" type="text/css" href="/components/bootstrap-select/dist/css/bootstrap-select.css">
	<link rel="stylesheet" type="text/css" href="/components/bootstrap-fileinput/css/fileinput.css">
	<link rel="stylesheet" type="text/css" href="/components/bootstrap-fileinput/themes/explorer-fa/theme.css">
	<link rel="stylesheet" type="text/css" href="/components/adminLTE/css/AdminLTE.min.css">
	<link rel="stylesheet" type="text/css" href="/components/adminLTE/css/skins/_all-skins.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
	<link rel="icon" href="/images/Icon.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="/css/jquery.lightbox.css">
	<script type="text/javascript" src="/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="/components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script type="text/javascript" src="/components/bootstrap-fileinput/js/fileinput.js"></script>
	<script type="text/javascript" src="/components/bootstrap-fileinput/js/locales/es.js"></script>
	<script type="text/javascript" src="/components/bootstrap-fileinput/themes/explorer-fa/theme.js"></script>
	<script type="text/javascript" src="/components/adminLTE/js/adminlte.min.js"></script>
	<script type="text/javascript" src="/components/adminLTE/js/pages/dashboard.js"></script>
	<script type="text/javascript" src="/components/adminLTE/js/demo.js"></script>
	<script type="text/javascript" src="/components/datatables.net/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="/components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	
</head>

<body class="hold-transition sidebar-mini skin-blue">
	<img src="/images/cabalV0.png" style=" position: fixed; height: 600px; top: 60px; right: 0">
	
		<label id="idUsuario" class="hidden">{{  Auth::user()->name }}</label> 
	<header class="main-header">
    	<a href="#" class="logo">
			<span class="logo-mini"><img src="/images/cabeza.png" height="25px"></span>
			<span class="logo-lg"><img src="/images/cabeza.png" height="30px"><img src="/images/nombre.png" height="30px"></span>
		</a>
		<nav class="navbar navbar-static-top">
			<a href="#" data-toggle="push-menu" role="button" style="float:left;background-color:transparent;background-image:none;padding:15px 15px; color: white">
				<i class="fa fa-bars"></i>
			</a>

			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<li class="dropdown notifications-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="far fa-bell"></i>
							<span class="label label-warning hidden" id="cntNotif">10</span>
						</a>
						<ul class="dropdown-menu">
							<li class="header bg-yellow-active" style="color: white" id="cntTitle">Tienes 10 notificaciones</li>
							<li class="hidden">
								<ul class="menu">
									<li>
										<a href="#" onClick="skin()">
											<i class="fa fa-car text-red"></i> Apertura manual de barrera
										</a>
									</li>
									<li>
										<a href="#" onClick="skin()">
											<i class="fa fa-car text-red"></i> Apertura manual de barrera
										</a>
									</li>
									<li>
										<a href="#" onClick="skin()">
											<i class="fa fa-car text-red"></i> Apertura manual de barrera
										</a>
									</li>
									<li>
										<a href="#" onClick="skin()">
											<i class="fa fa-car text-red"></i> Apertura manual de barrera
										</a>
									</li>
									<li>
										<a href="#" onClick="skin()">
											<i class="fa fa-car text-red"></i> Apertura manual de barrera
										</a>
									</li>
									<li>
										<a href="#" onClick="skin()">
											<i class="fa fa-car text-red"></i> Apertura manual de barrera
										</a>
									</li>
									<li>
										<a href="#" onClick="skin()">
											<i class="fa fa-car text-red"></i> Apertura manual de barrera
										</a>
									</li>
									<li>
										<a href="#" onClick="skin()">
											<i class="fa fa-car text-red"></i> Apertura manual de barrera
										</a>
									</li>
									<li>
										<a href="#" onClick="skin()">
											<i class="fa fa-car text-red"></i> Apertura manual de barrera
										</a>
									</li>
									<li>
										<a href="#" onClick="skin()">
											<i class="fa fa-car text-red"></i> Apertura manual de barrera
										</a>
									</li>
								</ul>
							</li>
							<li class="footer"><a href="#" class="bg-gray-active">Ver todas</a></li>
						</ul>
					</li>
					<li class="dropdown user user-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-user-circle"></i>
	 <span class="hidden-xs">{{ Auth::user()->name }}  							
								</span>
						</a>
					</li>
				</ul>
			</div>
		</nav>
	</header>
	<aside class="main-sidebar">
		<section class="sidebar">

			@yield('sidebar')
			
		</section>
	</aside>
	<div class="content-wrapper">
		@yield('content')
	</div>
		
</body>
</html>