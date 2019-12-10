@extends('.admin.layout')
@section('content')
<div class="page-holder w-100 d-flex flex-wrap">
	<div class="container-fluid px-xl-5">
		<section class="py-5">
			<div class="row">
				<div class="col-lg-12 mb-5">
					<div class="card">
						<div class="card-header">
							<h3 class="h6 text-uppercase mb-0">Cập nhật Tin Tức</h3>
						</div>
						<div class="card-body">
							<form action="{{url('admin/addtintuc')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
								{{ csrf_field() }}
								
								<div class="form-group row">
									<label class="col-md-3 form-control-label">Tên tin tức</label>
									<div class="col-md-9">
										<input id="inputHorizontalSuccess" name="tentintuc" type="text" placeholder="Tiêu đề"  class="form-control form-control-success">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 form-control-label">Ảnh Tin Tức</label>
									<div class="col-md-9">
										<input id="inputHorizontalWarning" name="anhtintuc" type="file"  class="form-control form-control-warning">
										
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 form-control-label">Thể loại tin tức</label>
									<div class="col-md-9">
										<div class="custom-control custom-radio custom-control-inline">
											<input id="customRadioInline1" type="radio" name="radio" value="1" class="custom-control-input" checked>
											<label for="customRadioInline1" class="custom-control-label">Review Phim</label>
										</div>
										<div class="custom-control custom-radio custom-control-inline">
											<input id="customRadioInline2" type="radio" name="radio" value="0" class="custom-control-input">
											<label for="customRadioInline2" class="custom-control-label">Blog</label>
										</div>            
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 form-control-label">Nội Dung</label>
									<div class="col-md-9">
										<textarea class="form-control " name="ndtintuc" rows="5" id="noidungtt"></textarea>
									</div>
								</div>
								<div class="form-group row">       
									<div class="col-md-9 m-auto">
										<input type="submit" value="Thêm mới" class="btn btn-primary" style="margin-left: 100%;">
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