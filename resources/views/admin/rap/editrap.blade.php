@extends('.admin.layout')
@section('content')
<div class="page-holder w-100 d-flex flex-wrap">
	<div class="container-fluid px-xl-5">
		<section class="py-5">
			<div class="row">
				<div class="col-lg-12 mb-5">
					<div class="card">
						<div class="card-header">
							<h3 class="h6 text-uppercase mb-0">Sửa Rạp Chiếu Phim</h3>
						</div>
						<div class="card-body">
							<form action="admin/suarap/{{$rap->id}}" method="POST" class="form-horizontal">
								{{ csrf_field() }}
								<div class="form-group row">
									<label class="col-md-3 form-control-label">Tên rạp</label>
									<div class="col-md-9">
										<input id="inputHorizontalSuccess" name="tenrap" value="{{$rap->tenrap}}" placeholder="Tiêu đề"  class="form-control form-control-success" required><small class="form-text text-muted ml-3">Chú ý : .</small>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 form-control-label">Thông tin rạp</label>
									<div class="col-md-9">
										<textarea class="form-control " name="ndrap" rows="5" id="ttrap">{{$rap->thongtin}}</textarea>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-9 m-auto">
										<input type="submit" value="Cập nhật" class="btn btn-primary" style="margin-left: 100%;">
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