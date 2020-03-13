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

<body class="hold-transition sidebar-mini skin-blue" onload="mapa.initMap()">
	<img src="/images/cabalV0.png" style=" position: fixed; height: 600px; top: 60px; right: 0">
	
	<label id="idUsuario" class="hidden">{{ Auth::user()->name }}</label>
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

			<ul class="sidebar-menu" data-widget="tree">
				<li>
					<a href="/inicio/">
					<i class="fa fa-home"></i> <span>Inicio</span>
				</a>
				</li>
				<li>
					<a href="/categorias/">
						<i class="fa fa-sitemap"></i> <span>Categorias</span>
					</a>
				</li>
				<li >
					<a href="/usuarios/">
						<i class="fa fa-users"></i> <span>Usuarios</span>
					</a>
				</li>
				<li class="active">
					<a href="/trabajadores/">
						<i class="fa fa-address-card"></i> <span>Trabajadores</span>
					</a>
				</li>
				<li>
					<a href="/promociones/">
						<i class="fas fa-clipboard-check"></i></i> <span>Promociones</span>
					</a>
				</li>
				<li>
					<a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out-alt"></i> <span>Cerrar Sesión</span>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
				</li>
			</ul>
			
		</section>
	</aside>
	<div class="content-wrapper">
		<section class="content-header">
			<div class="col-lg-7">
				<h2 style="margin-top: -10px">
					Trabajadores
				</h2>
			</div>
		</section>
		<section class="content" style="margin-top: 35px">
			<div class="row">
				<section class="col-lg-7">
					<div id="boxTable" class="box box-primary" style="height: 580px">
						<div class="box-header">
							<i class="fa fa-address-card"></i>
							<h3 class="box-title">{{$trabajador->nombre}}</h3>
							<!--<button style="float: right" class="btn btn-default">Actualizar Datos</button>-->
						</div>
						<div class="box-body" style="display: block;">
							<div class="col-lg-3 col-xs-7">
								<div class="widget-user-image">
									<img class="img-circle" src="http://cabalapp.com.mx/images/trabajadores/{{$trabajador->img_profile}}" alt="User Avatar" style="width: 100%; height: calc(width)">
								</div>
							</div>
							<div class="col-lg-9 col-xs-12">
								<ul class="list-group list-group-unbordered">
									<hr>
									<strong><i class="fa fa-map-marker-alt margin-r-5"></i> Dirección</strong>
									<div id="mapa" style="width: 100%; height: 250px;"> </div>
									@foreach($categorias as $cat)
					                @if($trabajador->actividad == $cat->id)
									@if($cat->categoria == '1')
									<li class="list-group-item">
										<i class="fa fa-suitcase margin-r-5"></i><b>Actividad</b> <a class="pull-right text-muted">Oficio</a>
									</li>
									@else
									<li class="list-group-item">
										<i class="fa fa-suitcase margin-r-5"></i><b>Actividad</b> <a class="pull-right text-muted">Profesión</a>
									</li>
									@endif
								    <li class="list-group-item">
									    <i class="fa fa-book margin-r-5"></i><b>Categoria</b> <a class="pull-right text-muted">{{$cat->nombre}}</a>
									</li>
									@endif
									@endforeach
									<li class="list-group-item">
										<i class="fa fa-envelope margin-r-5"></i><b>Correo</b> <a class="pull-right text-muted">{{$trabajador->correo}}</a>
									</li>
									
									<li class="list-group-item">
										<i class="fa fa-star margin-r-5"></i><b>Calificación</b> <a class="pull-right text-muted">{{$trabajador->calificacion}}</a>
									</li>
									<li class="list-group-item">
										<i class="fa fa-list margin-r-5"></i><b>Estatus</b> <a class="pull-right text-muted">@if($trabajador->estatus)
										Activo
										@else
										Inactivo
										@endif</a>
									</li>
									
								</ul>
							</div>
						</div>
						<div class="box-footer">
        					{!! Form::open([ 'route' => ['trabajadores.destroy', $trabajador->id], 'method' => 'DELETE' ]) !!}
        						<button type="submit" class="btn btn-danger pull-left"> Eliminar </button>
        					{!! Form::close() !!}
        					<a href="/trabajadores/{{Crypt::encrypt($trabajador->id)}}/documentos" class="btn btn-primary" style="float:right" role="button">Subir documentos</a>
        					<a href="/trabajadores/{{Crypt::encrypt($trabajador->id)}}/validar" class="btn btn-primary" style="float:right" role="button">Validar Documentos</a>
							<a href="/trabajadores/{{Crypt::encrypt($trabajador->id)}}/edit" class="btn btn-primary" style="float:none" role="button">Editar</a>
						</div>
					</div>
				</section>
			</div>
		</section>



<script>

mapa = {
 map : false,
 marker : false,

 initMap : function() {

 // Creamos un objeto mapa y especificamos el elemento DOM donde se va a mostrar.

 mapa.map = new google.maps.Map(document.getElementById('mapa'), {
   center: {lat: {{$trabajador->lat}}, lng: {{$trabajador->lng}}},
   scrollwheel: false,
   zoom: 16,
   zoomControl: true,
   rotateControl : false,
   mapTypeControl: true,
   streetViewControl: false,
 });

 // Creamos el marcador
 mapa.marker = new google.maps.Marker({
 position: {lat: {{$trabajador->lat}}, lng: {{$trabajador->lng}}},
 draggable: false
 });

 // Le asignamos el mapa a los marcadores.
  mapa.marker.setMap(mapa.map);
  
  
 },
}

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCulZGPV9ZjSzO_DJqO4gNtOdMvgTCxnso&callback=initMap"
    async defer></script>
    
    </div>
		
</body>
</html>