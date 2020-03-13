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
				<li class="active">
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
					Editar Usuario
				</h2>
			</div>
		</section>
		<section class="content" style="margin-top: 35px">
			<div class="row">
				
				<section class="col-lg-7">
						@include('commons.errors')	
					<div class="box box-primary" style="height: 610px">
						<div class="box-header">
						</div>
						<div class="box-body">
			<form method="POST" action="/usuarios/{{$usuario->id}}" enctype="multipart/form-data">
								@method('PUT')
								@csrf
								
								<div class="col-lg-3 col-xs-7">
								<div class="widget-user-image">
									<img class="img-circle" src="https://pickaface.net/gallery/avatar/unr_delbridge_180203_0739_2n3n4lc.png" alt="User Avatar" style="width: 100%">
								</div>
							</div>
							<div class="col-lg-9 col-xs-12">
								<ul class="list-group list-group-unbordered">
								    <li class="list-group-item">
									    <i class="fa fa-user margin-r-5"></i><b>Nombre</b> <a class="pull-right text-muted">{{$usuario->nombre}}</a>
									</li>
									<li class="list-group-item">
										<i class="fa fa-envelope margin-r-5"></i><b>E-mail</b> <a class="pull-right text-muted">{{$usuario->correo}}</a>
									</li>
									<li class="list-group-item">
										<i class="fa fa-phone margin-r-5"></i><b>Teléfono</b> <a class="pull-right text-muted">{{$usuario->telefono}}</a>
									</li>
								    <li class="list-group-item">
									    <i class="fa fa-calendar-alt margin-r-5"></i><b>Fecha de Nacimiento</b> <a class="pull-right text-muted">{{$usuario->borndate}}</a>
									</li>
									<li class="list-group-item">
										<i class="fa fa-sign-in-alt margin-r-5"></i><b>Metodo de registro</b> <a class="pull-right text-muted">{{$usuario->metodo_registro}}</a>
									</li>
									<li class="list-group-item">
										<i class="fa fa-star margin-r-5"></i><b>Calificación</b> <a class="pull-right text-muted">{{$usuario->calificacion}}</a>
									</li>
									<li class="list-group-item">
										<i class="fa fa-list margin-r-5"></i><b>Estatus</b> <a class="pull-right text-muted"><div class="form-group form-horizontal">
									<div class="btn-group btn-group-toggle" data-toggle="buttons">
								@if($usuario->estatus)
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
									</li>
									
								</ul>
							</div>
						</div>
						<input type="text" name="nombre" value="{{$usuario->nombre}}" class="hidden" id="t3-2">
							
								
								
																	
							
								<div class="form-group col-sm-12">
									<button type="submit" class="col-lg-12 btn btn-primary" style="margin-top: 15px"> Actualizar </button>
								</div>
							
				</form>
							
								
						</div>
					</div>
				</section>
			</div>
		</section>
@endsection