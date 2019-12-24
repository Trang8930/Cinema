@extends('.admin.layout')
@section('content')
<div class="page-holder w-100 d-flex flex-wrap">
	<div class="container-fluid px-xl-5">
		<section class="py-5">
			<div class="row">
				<div class="col-lg-12 mb-5">
					<div class="card">
						<div class="card-header">
							<h3 class="h6 text-uppercase mb-0">Thêm Lịch</h3>
						</div>
						<div class="card-body">
							@if(Session::has('error'))
							<div class="alert alert-danger">{{Session::get('error')}}</div>
							@endif
							<form action="{{url('admin/addlich')}}" method="POST" class="form-horizontal">
								{{ csrf_field() }}
								
								<div class="form-group row">
									<label class="col-md-3 form-control-label">Phim</label>
									<div class="col-md-9">
										<select name="phim" class="form-control">
											@foreach ($phim as $p)
												<option value="{{$p->id}}">{{$p->tenphim}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 form-control-label">Rạp</label>
									<div class="col-md-9">
										<select name="rap" class="form-control" id="rap">
											<option checked></option>
											@foreach ($rap as $r)
												<option value="{{$r->id}}">{{$r->tenrap}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 form-control-label">Phòng</label>
									<div class="col-md-9">
										<select name="phong" class="form-control" id="phong">
											
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 form-control-label">Ngày</label>
									<div class="col-md-9">
										<input id="inputHorizontalWarning" name="ngay" type="date"  class="form-control form-control-warning">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 form-control-label">Thời gian</label>
									<div class="col-md-9">
										<input id="inputHorizontalWarning" name="time" type="time"  class="form-control ">
									</div>
								</div>
								<div class="form-group row">       
										<div class="col-md-12 text-right">
											<a href="{{route('qlylichchieu')}}" class="btn btn-danger">Hủy bỏ</a>
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
<script type="text/javascript">
	
</script>
@endsection