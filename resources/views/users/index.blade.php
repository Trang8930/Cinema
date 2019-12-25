@extends('master')
@section('content')
<div class="container-fluid" style="min-height: 850px">
    <div class="row">
        <div class="container mt-5 bootstrap snippet">
            <div class="row">
          		<div class="col-sm-3">
                    <ul class="list-group mb-4">
                        <li class="list-group-item">Xin chào <span style="color:red;font-weight:bold"><?=Auth::user()->name;?></span></li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                        Lịch sử giao dịch
                            <span class="badge badge-primary badge-pill">{{$count}}</span>
                        </li>
                    </ul> 
                </div><!--/col-3-->
            	<div class="col-sm-9">
            	    <div class="card text-center">
                        <div class="card-header">
                    	    <ul class="nav nav-tabs nav-fill card-header-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-edit"></i> Thông tin cá nhân</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="history-order-tab" data-toggle="tab" href="#history-order" role="tab" aria-controls="profile" aria-selected="false"><i class="fas fa-shopping-bag"></i> Lịch sử giao dịch</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content card-body" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-6">
                                        <form class="needs-validation" novalidate>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-3">
                                                    <label for="validationTooltip01">Tên đăng nhập</label>
                                                    <input type="text" class="form-control" value="<?=Auth::user()->name?>" disabled>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label for="validationTooltip03">E-mail</label>
                                                    <input type="email" class="form-control" placeholder="E-mail" value="<?=Auth::user()->email?>" disabled>
                                                </div>
                                            </div>
                                        </form>
                                        <hr>
                                        <!-- <form class="needs-validation" novalidate>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-3">
                                                    <label for="validationTooltip05">Mật khẩu mới</label>
                                                    <input type="password" class="form-control" id="validationTooltip05" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-3">
                                                    <label for="validationTooltip05">Nhập lại mật khẩu</label>
                                                    <input type="password" class="form-control" id="validationTooltip05" required>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary" type="submit">Lưu thay đổi</button>
                                        </form> -->
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="history-order" role="tabpanel" aria-labelledby="history-order-tab">
                                <table class="table table-sm table-hover table-bordered table-striped">
                                <thead class="thead-light">
									<tr>
										<th scope="col">STT</th>
										<th scope="col">Tên Phim</th>

										<th scope="col">Lịch chiếu</th>
                                        <th scope="col">Ghế</th>
                                        <th>Trạng thái</th>
									</tr>
								</thead>
								<tbody>
									<?php $stt = 1; ?>
									@foreach ($ve as $v)
									<tr>
										<td class="align-middle">{{$stt}}</td>
										<td class="align-middle">{{$v->lichchieu->phim->tenphim}}
										</td>
										<td class="align-middle">
                                        {{$v->lichchieu->rap->tenrap}} | {{$v->lichchieu->phong->tenphong}} | {{$v->lichchieu->ngay}} | {{$v->lichchieu->time}}
                                        </td>
										<td class="align-middle">
                                        {{$v->ghe->row}}{{$v->ghe->number}}
										</td>
                                        <td>
                                            @if($v->status == 1)
                                            <span class="badge badge-success">Đặt thành công</span>
                                            @else
                                            <span class="badge badge-warning">Chờ xác nhận</span>
                                            @endif
                                        </td>
									</tr>
                                    <?php $stt++; ?>
									@endforeach
								</tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!--/col-9-->
            </div>
        </div>     
    </div>
</div>
@endsection