@extends('.admin.layout')
@section('content')
<div class="page-holder w-100 d-flex flex-wrap">
	<div class="container-fluid px-xl-5">
		<section class="py-5">
			<div class="row">
				<div class="col-lg-12 mb-5">
					<div class="card">
						<div class="card-header">
							<h3 class="h6 text-uppercase mb-0">Thêm Phòng Chiếu</h3>
						</div>
						<div class="card-body">
							<form action="{{url('admin/addphong')}}" method="POST" class="form-horizontal">
								{{ csrf_field() }}
								
								<div class="form-group row">
									<label class="col-md-3 form-control-label">Tên phòng</label>
									<div class="col-md-9">
										<input name="tenphong" placeholder="Tên Phòng"  class="form-control" required>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-md-3 form-control-label">Chọn rạp</label>
									<div class="col-md-9">
										<select name="rap_id" class="form-control">
											@foreach ($rap as $r)
											<option value="{{$r->id}}">{{$r->tenrap}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group row">       
									<div class="col-md-9 m-auto">
										<input type="submit" value="ADD" class="btn btn-primary">
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