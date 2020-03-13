@extends('layout.header')

@section('sidebar')
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
@endsection

@section('content')
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
					@include('commons.errors')
					<div class="box box-solid box-default" style="height: 610px">

						<div class="box-header">
							<h5>Subir documentos del trabajador <label id="t3-1" hidden="">0</label>
							{{-- <button class="btn btn-success" style="float: right">Nuevo</button></h4> --}}
						</div>
						<div class="box-body">
			<form method="POST" action="/trabajadores/documents" enctype="multipart/form-data">
								@csrf
							
								<div class="form-group form-horizontal">
									<label class="col-sm-3">Nombre: </label>
									<div class="col-sm-9">
										<div class="form-group form-horizontal">
										<input type="text" value="{{$trabajador->nombre}}" name="nombre" class="form-control" id="t3-2" disabled="">
									</div>
									</div>
								</div>
							<input type="hidden" value="{{$trabajador->id}}" name="id" class="form-control" hidden>
														
								<div class="form-group" style="width: 100%">
									<div class="box-body" style="height: 310px; overflow-y: scroll;">
										<div class="file-loading">
											<input id="file-es" name="documents[]" type="file" multiple="">
										</div>
									</div>
								</div>
							
								<div class="form-group col-sm-12 col-lg-12">
									<button type="submit" class="col-lg-12 col-md-12 btn btn-primary" style="margin-top: 15px"> Guardar </button>
								</div>
							
				</form>
							
							
							
						</div>
					</div>
				</section>
			</div>
		</section>
		<script>
			
	$('#file-es').fileinput({
        theme: 'explorer-fa',
        language: 'es',
        uploadUrl: '#',
		showUpload: false,
		showRemove: false
    });

</script>

@endsection