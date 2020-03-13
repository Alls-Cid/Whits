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
			<div class="col-lg-9">
		@include('commons.succes')
				<h2 style="margin-top: -10px">
					Usuarios
				</h2>
			</div>
		</section>
		<section class="content" style="margin-top: 35px">
			<div class="row">
				<section class="col-lg-9">
					<div id="boxTable" class="box box-solid box-default" style="height: 610px">
						<div class="box-header">
							<i class="fa fa-list-ol"></i>
							<h3 class="box-title">Lista de usuarios:</h3>
							<a href="/usuarios/create" class="btn btn-primary" role="button" style="float: right">Nueva entrada</a>
						</div>
						<div class="box-body" style="display: block;">
							<table id="theTable" class="table table-bordered" style="font-size: 12px">
								<thead class="bg-black-gradient">
									<tr>
										<th>Id</th>
										<th>Nombre</th>
										<th>Correo</th>
										<th>Telefono</th>
										<th>Fecha Nacimiento</th>
										<th>Método Registro</th>
										<th>Calificación</th>
										<th>Estatus</th>
										<th>Fecha de Creación</th>
									</tr>
								</thead>
								<tbody>
								@foreach($usuario as $user)
									<tr>
										<td>{{$user->id}}</td>
										<td><a href="/usuarios/{{Crypt::encrypt($user->id)}}/edit">{{$user->nombre}}</a></td>
										<td>{{$user->correo}}</td>
										<td>{{$user->telefono}}</td>
										<td>{{$user->borndate}}</td>
										<td>{{$user->metodo_registro}}</td>
										<td>{{$user->calificacion}}</td>
										@if($user->estatus)
										<td>Activo</td>
										@else
										<td>Inactivo</td>
										@endif
										<td>{{$user->created_at}}</td>
									</tr>
									
								@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</section>
			</div>
		</section>
		<script>
		    $(document).ready(function() {
                $('#theTable').DataTable({
        			"processing": true,
        			"serverSide": false,
        			"order": [[0, 'asc']],
        			scrollY:        410,
        			scrollCollapse: true,
        			paging:         false
        		});
            } );
		</script>

@endsection