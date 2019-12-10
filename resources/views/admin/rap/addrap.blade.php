@extends('.admin.layout')
@section('content')
<div class="page-holder w-100 d-flex flex-wrap">
	<div class="container-fluid px-xl-5">
		<section class="py-5">
			<div class="row">
				<div class="col-lg-12 mb-5">
					<div class="card">
						<div class="card-header">
							<h3 class="h6 text-uppercase mb-0">Thêm Rạp Chiếu Phim</h3>
						</div>
						<div class="card-body">
							<form action="{{url('admin/addrap')}}" method="POST" class="form-horizontal">
								{{ csrf_field() }}
								<div class="form-group row">
									<label class="col-md-3 form-control-label">Tên rạp</label>
									<div class="col-md-9">
										<input id="inputHorizontalSuccess" name="tenrap" type="text" placeholder="Tiêu đề"  class="form-control form-control-success" required>
										
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 form-control-label">Thông tin rạp</label>
									<div class="col-md-9">
										<textarea class="form-control " name="ndrap" rows="5" id="ttrap"required></textarea>
									</div>
								</div>
								<div class="form-group row">
										<div class="col-md-12 text-right">
											<a href="{{route('qlyrap')}}" class="btn btn-danger">Hủy bỏ</a>
										<input type="submit" value="Thêm mới" class="btn btn-primary">
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
@endsection