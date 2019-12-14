@extends('.admin.layout')
@section('content')
<div class="page-holder w-100 d-flex flex-wrap">
	<div class="container-fluid px-xl-5">
		<section class="py-5">
			<div class="row">
				<div class="col-lg-12 mb-5">
					<div class="card">
						<div class="card-header">
							<h3 class="h6 text-uppercase mb-0">Sửa Lịch</h3>
						</div>
						<div class="card-body">
							<form action="{{url('admin/sualich')}}" method="POST" class="form-horizontal">
								{{ csrf_field() }}
								<input type="hidden" name="id" value="{{$chitietlich->id}}">
								<div class="form-group row">
									<label class="col-md-3 form-control-label">Phim</label>
									<div class="col-md-9">
										<input name="phim" class="form-control" value="{{$chitietlich->tenphim}}" disabled/>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 form-control-label">Rạp</label>
									<div class="col-md-9">
										<input name="rap" class="form-control" value="{{$chitietlich->tenrap}}" disabled/>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 form-control-label">Phòng</label>
									<div class="col-md-9">
										<select name="phong" class="form-control">
											@foreach ($ds_phong as $p)
											<option value="{{$p->id}}" 
												<?php
													if($p->id == $chitietlich->id_phong) {
														echo 'selected';
													}
												?>>
												{{$p->tenphong}}
											</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 form-control-label">Ngày</label>
									<div class="col-md-9">
										<input value="{{$chitietlich->ngay}}" name="ngay" type="date"
											class="form-control form-control-warning">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 form-control-label">Thời gian</label>
									<div class="col-md-9">
										<input value="{{$chitietlich->time}}" name="time" type="time"
											class="form-control ">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-12 text-right">
										<a href="{{route('qlylichchieu')}}" class="btn btn-danger">Hủy bỏ</a>
										<input type="submit" value="Cập nhật" class="btn btn-primary">
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