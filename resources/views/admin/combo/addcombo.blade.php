@extends('.admin.layout')
@section('content')
<div class="page-holder w-100 d-flex flex-wrap">
	<div class="container-fluid px-xl-5">
		<section class="py-5">
			<div class="row">
				<div class="col-lg-12 mb-5">
					<div class="card">
						<div class="card-header">
							<h3 class="h6 text-uppercase mb-0">Thêm Combo</h3>
						</div>
						<div class="card-body">
							<form action="{{url('admin/addcombo')}}" method="POST" class="form-horizontal">
								{{ csrf_field() }}
								
								<div class="form-group row">
									<label class="col-md-3 form-control-label">Tên combo</label>
									<div class="col-md-9">
										<input id="inputHorizontalSuccess" name="tencb" type="text" placeholder="Tên Combo"  class="form-control form-control-success">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 form-control-label">Chi Tiết</label>
									<div class="col-md-9">
										<textarea class="form-control " name="chitietcb" rows="5" id="ctcb"></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 form-control-label">Giá</label>
									<div class="col-md-9">
										<input id="inputHorizontalSuccess" name="giacb" type="text" placeholder="Giá Combo"  class="form-control form-control-success">
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