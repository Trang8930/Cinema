@extends('admin.layout')
@section('content')
<div class="page-holder w-100 d-flex flex-wrap">
	<div class="container-fluid px-xl-5">
		<section class="py-5">
			<div class="row">
				<div class="col-lg-12 mb-4">
					<div class="card">
						<div class="card-header">
							<h6 class="text-uppercase mb-0">Quản Lý Ghế</h6>						</div>
						<div class="card-body"> 
							<div>                 
								<select class="form-control w-25 mb-5" id="phong">
									<option>Vui lòng chọn phòng</option>
									@foreach ($phong as $p)
									<option value="{{$p->id}}">{{$p->tenphong}}</option>
									@endforeach
								</select>
							</div> 
							<div id="dsghe">
								
							</div>  

						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
@endsection