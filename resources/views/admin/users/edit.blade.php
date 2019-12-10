@extends('.admin.layout')
@section('content')
<div class="page-holder w-100 d-flex flex-wrap">
	<div class="container-fluid px-xl-5">
		<section class="py-5">
			<div class="row">
				<div class="col-lg-12 mb-5">
					<div class="card">
						<div class="card-header">
							<h3 class="h6 text-uppercase mb-0">Sửa Thành Viên</h3>
						</div>
						<div class="card-body">
							<form action="/admin/users/edit/{{$user->id}}" method="POST" class="form-horizontal">
								{{ csrf_field() }}

								<div class="form-group row">
									<label class="col-md-3 form-control-label">Tên người dùng</label>
									<div class="col-md-9">
                                        <input value="{{$user->name}}" name="name" class="form-control" required>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 form-control-label">Email</label>
									<div class="col-md-9">
                                        <input value="{{$user->email}}" name="email" class="form-control" disabled>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 form-control-label">Level</label>
									<div class="col-md-9">
										<select name="level" class="form-control" id="phong">
                                            <option value="0" <?=$user->level == 0 ? 'selected' : ''?>>User</option>
                                            <option value="1" <?=$user->level == 1 ? 'selected' : ''?>>Admin</option>
										</select>
									</div>
								</div>

								<div class="form-group row">
									<div class="col-md-9 m-auto">
										<input type="submit" value="Cập Nhật" class="btn btn-primary" style="margin-left: 100%;">
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