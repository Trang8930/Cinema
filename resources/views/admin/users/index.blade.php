@extends('admin.layout')
@section('content')
<div class="page-holder w-100 d-flex flex-wrap">
	<div class="container-fluid px-xl-5">
		<section class="py-5">
			<div class="row">
				<div class="col-lg-12 mb-4">
					<div class="card">
						<div class="card-header">
							<h6 class="text-uppercase mb-0">Quản Lý User</h6>
						</div>
						<div class="card-body">
							<table class="table table-hover card-text">
								<thead>
									<tr>
										<th>id</th>
										<th>Tên người dùng</th>
										<th>Email</th>
										<th>Level</th>
										<th>Chức năng</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($user as $p)
									<tr>
										<td>{{$p->id}}</td>
										<td>{{$p->name}}</td>
										<td>{{$p->email}}</td>
										<td>
											@if($p->level == 0)
												Người dùng
											@else
												Admin
											@endif
										</td>
										<td><a href="admin/users/edit/{{$p->id}}"><button style="background-color: #ffffff00;border: none" title="Sửa"><i class="fas fa-edit text-success"></i></button></a>
											<a href="admin/users/delete/{{$p->id}}" data-confirm="Are you sure to delete this item?"><i class="fas fa-trash-alt text-danger"></i></button>
											</a></td>
										</tr>
										</tr>
										@endforeach
									</tbody>
								</table>
								{{ $user->links()}}
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<footer class="footer bg-white shadow align-self-end py-3 px-xl-5 w-100">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6 text-center text-md-left text-primary">
						<p class="mb-2 mb-md-0">Your company &copy; 2018-2020</p>
					</div>
					<div class="col-md-6 text-center text-md-right text-gray-400">
						<p class="mb-0">Design by <a href="https://bootstrapious.com/admin-templates" class="external text-gray-400">Bootstrapious</a></p>
						<!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
					</div>
				</div>
			</div>
		</footer>
	</div>
	@endsection