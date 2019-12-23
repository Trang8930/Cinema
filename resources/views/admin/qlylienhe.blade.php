@extends('admin.layout')
@section('content')
<div class="page-holder w-100 d-flex flex-wrap">
	<div class="container-fluid px-xl-5">
		<section class="py-5">
			<div class="row">
				<div class="col-lg-12 mb-4">
					<div class="card">
						<div class="card-header">
							<h6 class="text-uppercase mb-0">Quản Lý Tin Tức</h6>
							<a href="admin/formtintuc" title="Thêm mới"
								style="position: absolute;right: 35px;top: 22px;"><i
									class="fas fa-plus-square text-success" style="font-size: 24px"></i></a>
						</div>
						<div class="card-body">
							<table class="table table-hover card-text">
								<thead>
									<tr>
										<th>id</th>
										<th>Họ tên</th>
										<th>Email</th>
										<th>Số điện thoại</th>
										<th>Nội dung</th>
										<th>Ngày gửi</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($lienhe as $lh)
									<tr>
										<td>{{$lh->id}}</td>
										<td>{{$lh->ho_ten}}</td>
										<td>{{$lh->email}}</td>
										<td>{{$lh->sdt}}</td>
										<td>{{$lh->noi_dung}}</td>
										<td>{{$lh->created_at}}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							{{ $lienhe->links()}}
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
					<p class="mb-0">Design by <a href="https://bootstrapious.com/admin-templates"
							class="external text-gray-400">Bootstrapious</a></p>
					<!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
				</div>
			</div>
		</div>
	</footer>
</div>
@endsection