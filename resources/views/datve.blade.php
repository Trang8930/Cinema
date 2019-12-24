@extends('master')
@section('content')
@php
//$idl=null;
$idl=$lichchieu->id

@endphp
<div class="container">
	<div class="row">
		<div class="col-sm-9" style="background-color: #f26b38;margin-top: 50px">
			<div style="position: relative;">
				<div class="booking">
					<table class="table mt-3">
						<thead class="thead-dark">
							<tr>
								<th style="width: 50%">Vé</th>
								<th style="width: 15%">Số lượng</th>
								<th style="width: 15%">Giá(VNĐ)</th>
								<th style="width: 20%">Tổng(VNĐ)</th>
							</tr>
						</thead>
						<tbody>
							<tr style="background-color: #f9f9f9">
								<td>
									<span>{{$lichchieu->phim->tenphim}}</span>

								</td>
								<td>
									<div>
										<input class="slve" type="number" id="Numseats" style="width: 50px;" value="0"
											min="0" onchange="tienve()">
									</div>
								</td>
								<td id="giave">50000</td>
								<td><span class="tongtienve"></span>&nbsp;vnđ</td>
							</tr>
						</tbody>
					</table>
					<h4 style="color: white;padding: 10px;">CHỌN COMBO</h4>
					<table class="table" id="tb">
						<thead class="thead-dark">
							<tr>
								<th style="width: 50%">Combo</th>
								<th style="width: 15%">Số lượng</th>
								<th style="width: 15%">Giá(VNĐ)</th>
								<th style="width: 20%">Tổng(VNĐ)</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($cb as $c)
							<tr style="background-color: #f9f9f9">
								<td>
									<span id="tencb">{{$c->tencombo}}</span><br>
									<span style="font-size: 14px;">{{$c->chitiet}}</span>
								</td>
								<td>
									<div>

										<input class="units-class combo" type="number" id="{{$c->tencombo}}-{{$c->id}}"
											style="width: 50px;" value="0" min="0" onchange="calculate()">

									</div>
								</td>
								<td>{{number_format($c->gia)}}</td>
								<td><span class="subtotal-class"></span>&nbsp;vnđ</td>
							</tr>
							@endforeach


						</tbody>
					</table>
				</div>
				<div class="seatbooking" style="background-color: #fff;height: 600px">

					<div class="inputForm">
					</div>


					<div class="seatStructure">
						<center>
							<div class="screen">SCREEN</div>
							<div class="seatcolor">
								<span class="seat-gray">Ghế đã bán</span>
								<span class="seat-blue">Có thể chọn</span>
								<span class="seat-green">Ghế đang chọn</span>
							</div>
							<div class="seatBooking">
								@foreach ($ghe as $g)
								<div class="seatRow">
									<div class="seatRowName">
										{{$g->row}}
									</div>
									@php
										$check = false;
									@endphp
									@foreach ($g['number'] as $n)
										@php
											foreach ($ve as $key => $value) {
												if($value['id_ghe'] == $n->id) {
													$check = true; // da ton tai
												break;
												}else {
													$check = false;
												}
											}
										@endphp
										{{-- <span>ghe {{$n}}</span> --}}
										{{-- @if (($n->ve->id_lichchieu== $idl ) && ($n->ve->id_user !=null)) --}}
										@if ($check)
											<div id="{{$n->id}}" class="seatNumber seatDisable" value="{{$n->row}}{{$n->number}}">{{$n->number}}</div>
										@else
											<div id="{{$n->id}}" class="seatNumber" value="{{$n->row}}{{$n->number}}">{{$n->number}}</div>
										@endif
									@endforeach
								</div>
								@endforeach
								<div class="seatReceipt">
									<button class="btnClear">Clear</button>
								</div>
							</div>
						</center>
					</div>
					<br /><br />
				</div>
				<button class="tt" style="float: right;margin-bottom: 10px;border: 1px solid;padding: 10px 15px">Tiếp
					Tục</button>
			</div>
		</div>
		<div class="col-sm-3" style="margin-top: 50px">
			<div style="background-color: #f9f9f9">
				<input type="hidden" class="idlich" value="{{$lichchieu->id}}">
				@if (Auth::check())
				<input type="hidden" class="iduser" value="{{Auth::user()->id}}">
				@endif
				<div class="col-md-12" style="text-align: center;">
					<img src="/anhda4/phim/{{$lichchieu->phim->image}}" width="215" height="150">
				</div>
				<div class="col-md-12">
					<div>
						<h4 style="font-size: 16px" id="tenphim">{{$lichchieu->phim->tenphim}}</h4>
						<h4 style="font-size: 14px" id="tentienganh">{{$lichchieu->phim->tentienganh}}</h4>
					</div>
					<div>
						<p><b>Rạp:</b>&nbsp;<span id="tenrap">{{$lichchieu->rap->tenrap}}</span></p>
						<p><b>Phòng:</b>&nbsp;<span id="tenphong">{{$lichchieu->phong->tenphong}}</span></p>
						<p><b>Suất chiếu:</b>&nbsp;<span
								id="ngay">{{date('d-m-Y', strtotime($lichchieu->ngay))}}</span>&nbsp;|&nbsp;<span
								id="thoigian">{{date('G:i',strtotime($lichchieu->time))}}</span></p>

						<div><b>Combo:</b>&nbsp;<div class="comboList"></div>
						</div>
						<div><b>Ghế:</b>&nbsp;<div class="seatList"></div>
						</div>
					</div>
					<div>
						<p><b>Tổng:</b><span id="total"> </span>&nbsp;VNĐ</p>
					</div>
					<div>
						@if (!Auth::check())
						<p class="text-danger">Đăng nhập để tiếp tục</p>
						@else
						<center>
							<button id="addve" class="datve">Đặt vé</button>
						</center>
						@endif

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$(".seatNumber").click(function() {
			var selectedSeats = parseInt($(".seatSelected").length);
			if (selectedSeats == $("#Numseats").val()) {
				if ($(this).hasClass("seatSelected")) {
					var thisName = $(this).attr('value');
					$(this).removeClass("seatSelected");
					$(".seatList ." + thisName).remove();
				}
			} else {
				if (!$(this).hasClass("seatDisable")) {
					if ($(this).hasClass("seatSelected")) {
						var thisName = $(this).attr('value');
						$(this).removeClass("seatSelected");
						$(".seatList ." + thisName).remove();
					} else {
						$(this).addClass("seatSelected");
						var thisName = $(this).attr('value');
						$(".seatList").append('<span class=' + thisName + '>' + thisName + "&nbsp;," + '</span>');
					}
				}
			}
		});

		$(".btnClear").click(function() {
			$(".seatSelected").removeClass("seatSelected");
			$(".seatList span").remove();
		});

		$(".combo").change(function() {
			var slcombo=$(this).val();
			var combo=$(this).attr('id');
			var combo=combo.split("-");
			if (slcombo >= 1) {
				if (slcombo > 1) {
					$(".comboList ."+ combo[1]).remove();
					$(".comboList").append('<span class='+ combo[1] +'>'+ combo[0] +'(x'+ slcombo +')&nbsp;,'+'</span>');
				}else{
					$(".comboList ."+ combo[1]).remove();
					$(".comboList").append('<span class='+ combo[1] +'>'+ combo[0] +'(x'+ slcombo +')&nbsp;,'+'</span>');
				}
			}else{
				$(".comboList ."+ combo[1]).remove();
			}
		});

		$(".tt").click(function(){
			if ($("#Numseats").val() == 0) {
				alert('Vui lòng chọn số lượng vé');
			}
			else{
				$('.booking').addClass('tieptuc');
				$('.seatbooking').addClass('showseat');
			}
		});
		var allseat=[];
		var allcombo=[];
		var soluongcb=[];
		var combo={
			id:null,
			sl:null
		};
		$(".datve").click(function(){
			var selectedSeats = parseInt($(".seatSelected").length);
			if ($("#Numseats").val() == selectedSeats) {
				$(".seatSelected").each(function(){
					allseat.push($(this).attr('id'));
				});
				$(".combo").each(function(){
					if ($(this).val()>=1) {
						var combo=$(this).attr('id');
						var combo=combo.split("-");
						allcombo.push({
							idcb:combo[1],
							slcb:$(this).val()
						});
					}
				});
				var url="/ajaxdatve";
				var idlich= $('.idlich').val();
				var iduser= $('.iduser').val();

				$.get({
					type:'GET',
					url:url,
					data:{
						idlich:idlich,
						iduser:iduser,
						allseat:allseat,
						allcombo:allcombo
					},
					success:function(response){
						alert("đặt vé thành công");
						location.reload();
					}
				});
			}else{
				alert('Vui lòng chọn đủ số lượng vé');
			}
		});
	});
		var giave=document.getElementById('giave').innerHTML;
		var slve=document.getElementsByClassName('slve');
		var tongtienve=document.getElementsByClassName('tongtienve');
		var prices = [65000,80000,150000];
		var units = document.getElementsByClassName('units-class');
		var subs = document.getElementsByClassName('subtotal-class');
		var grand = document.getElementById('total');
	tienve();
		var tongtv=0;
		function tienve(){
			for(i = 0; i < tongtienve.length; i++){
				tongtv=slve[i].value * giave;
				tongtienve[i].innerHTML=tongtv;
			}
			grand.innerHTML = tongtv;
		}
	calculate();

		function calculate(){
			let sum = 0;
			for(i = 0; i < subs.length; i++){
				var subTotal = units[i].value * prices[i];
				subs[i].innerHTML = subTotal;
				sum += subTotal;
			}

			grand.innerHTML = sum+tongtv; 
		}
</script>
@endsection