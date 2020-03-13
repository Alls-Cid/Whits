@extends('layout.header')

@section('sidebar')
			<ul class="sidebar-menu" data-widget="tree">
				<li>
					<a href="/inicio/">
					<i class="fa fa-home"></i> <span>Inicio</span>
				</a>
				</li>
				<li class="active">
					<a href="/categorias/">
						<i class="fa fa-sitemap"></i> <span>Categorias</span>
					</a>
				</li>
				<li>
					<a href="/usuarios/">
						<i class="fa fa-users"></i> <span>Usuarios</span>
					</a>
				</li>
				<li>
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
@endsection

@section('content')

			<section class="content-header">
			<div class="col-lg-7">
				<h2 style="margin-top: -10px">
					Editar Categoria
				</h2>
			</div>
		</section>
		<section class="content" style="margin-top: 35px">
			<div class="row">
				<section class="col-lg-8">
						@include('commons.errors')	
					<div class="box box-solid box-default" style="height: 610px">
						<div class="box-header">
							
						</div>
						<div class="box-body">
							<div id="kv-avatar-errors-2" class="center-block" style="width:600px;display:none"></div>
							<form method="POST" action="/categorias/{{$categoria->id}}" enctype="multipart/form-data">
							@method('PUT')
							@csrf
								<div class="col-sm-4 text-center">
									<div class="kv-avatar">
										<div class="file-loading">
											<input id="file-es" name="profile" type="file">
										</div>
									</div>
								</div>
								<div class="col-sm-8">
									<div class="form-group form-horizontal">
										<label class="col-sm-3">Nombre: </label>
										<div class="col-sm-9">
											<div class="form-group form-horizontal">
											<input type="text" name="nombre" value="{{$categoria->nombre}}" class="form-control" id="t3-2">
										</div>
										</div>
									</div>

									<div class="form-group form-horizontal">
										<label class="col-sm-4">Estatus: </label>
										<div class="col-sm-6">
											<div class="form-group form-horizontal">
										<div class="btn-group btn-group-toggle" data-toggle="buttons">
									@if($categoria->estatus)
										 <label class="btn btn-primary active">
											<input type="radio" name="estatus" value="1" id="1" checked="checked"> Activo
										</label>
										<label class="btn btn-primary">
											<input type="radio" name="estatus" value="0" id="0"> Inactivo
										</label>
										@else
										<label class="btn btn-primary">
											<input type="radio" name="estatus" value="1" id="1"> Activo
										</label>
										<label class="btn btn-primary active">
										 <input type="radio" name="estatus" value="0" id="0" checked="checked"> Inactivo 
										</label>
											@endif 
										</div> 
										</div> 
										</div>
									</div>
								</div>
								<div class="form-group col-sm-12">
									<button type="submit" class="col-lg-12 btn btn-primary" style="margin-top: 15px"> Actualizar </button>
								</div>
							</form>
						</div>
					</div>
				</section>
			</div>
		</section>
		<style>
	.kv-avatar .krajee-default.file-preview-frame,.kv-avatar .krajee-default.file-preview-frame:hover {
        margin: 0;
        padding: 0;
        border: none;
        box-shadow: none;
        text-align: center;
    }
    .kv-avatar {
        display: inline-block;
    }
    .kv-avatar .file-input {
        display: table-cell;
        width: 213px;
    }
    .kv-reqd {
        color: red;
        font-family: monospace;
        font-weight: normal;
    }
	</style>
		<script>
	$('#file-es').fileinput({
		
		overwriteInitial: true,
		showClose: false,
		showCaption: false,
		showBrowse: false,
		browseOnZoneClick: true,
		removeLabel: '',
		removeIcon: '<i class="fa fa-trash"></i>',
		removeTitle: 'Quitar elemento',
		elErrorContainer: '#kv-avatar-errors-2',
		msgErrorClass: 'alert alert-block alert-danger',
		layoutTemplates: {main2: '{preview} {remove} '},
		defaultPreviewContent: '<img src="/images/categorias/{{$categoria->img_profile}}" alt="Your Avatar" width="213px"><h6 class="text-muted">Click para seleccionar</h6>',
		allowedFileExtensions: ["jpg", "png", "gif"],
		maxFileCount: 1,
		language: 'es',
    });
</script>
@endsection