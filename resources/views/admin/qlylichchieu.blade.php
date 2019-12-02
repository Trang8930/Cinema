@extends('admin.layout')
@section('content')
<div class="page-holder w-100 d-flex flex-wrap">
	<div class="container-fluid px-xl-5">
		<section class="py-5">
			<div class="row">
				<div class="col-lg-12 mb-4">
					<label class="ml-3">Tìm Kiếm Theo Tên Phim:</label>
					<select class="form-control w-50 mb-3" id="lich">
						<option checked></option>
						@foreach ($phim as $p)
							<option value="{{$p->id}}">{{$p->tenphim}}</option>
						@endforeach
						
					</select>
					<div class="card">
						<div class="card-header">
							<h6 class="text-uppercase mb-0">Quản Lý Lịch Chiếu</h6>
							<a href="admin/addlichchieu" title="Thêm mới" style="position: absolute;right: 35px;top: 22px;"><i class="fas fa-plus-square text-success" style="font-size: 24px"></i></a>
						</div>
						<div class="card-body">                           
							<table class="table table-hover card-text">
								<thead >
									<tr>
										<th>id</th>
										<th>Phim</th>
										<th>Rạp</th>
										<th>Ngày</th>
										<th>Thời gian</th>
										<th>Chức năng</th>
									</tr>
								</thead>
								<tbody id="lichchieu">
									@foreach ($lich as $l)                     		
									<tr>
										<td>{{$l->id}}</td>
										<td>{{$l->phim->tenphim}}</td>
										<td>{{$l->rap->tenrap}}</td>
										<td>{{date('d-m-Y',strtotime($l->ngay))}}</td>
										<td>{{date('H:i',strtotime($l->time))}}</td>
										<td><a href="admin/sualichchieu/{{$l->id}}"><button style="background-color: #ffffff00;border: none" title="Sửa"><i class="fas fa-edit text-success"></i></button></a><br>
											<form action="admin/xoalich/{{$l->id}}" method="get" onsubmit="return confirm('Chắc chắn không ^_^')">
												{{ csrf_field() }}
												<button type="submit" style="background-color: #ffffff00;border: none" title="Xóa"><i class="fas fa-trash-alt text-danger"></i></button>
											</form></td>
										</tr>
										@endforeach
									</tbody>
								</table>
								{{ $lich->links()}}
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