<!DOCTYPE html>
<html>
<head>
<title>Best Film VN | Booking Film</title>
<!-- for-mobile-apps -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="keywords" content="Movie Ticket Booking Widget Responsive, Login form web template, Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<!-- //for-mobile-apps -->
<link href='//fonts.googleapis.com/css?family=Kotta+One' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<link href="{{ asset('fe_css/style_booking.css') }}" rel="stylesheet" type="text/css" media="all" />
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('fe_js/jquery.seat-charts.js') }}"></script>
</head>
<body>
<div class="content">
	<h1>Bảng đặt vé xem phim</h1>
	<div class="main">
		<h2>Phòng {{$roomID}}</h2>
		<div class="demo">
			<div id="seat-map">
				<div class="front">{{ $film->name }}</div>					
			</div>
			<div class="booking-details">
				<ul class="book-left">
					{{-- <li>Tên phim </li> --}}
					<li>Thời lượng </li>
					<li>Số lượng vé</li>
					<li>Tổng tiền</li>
					<li>Ghế đặt :</li>
				</ul>
				<ul class="book-right">
					{{-- <li>: {{ $film->name }}</li> --}}
					<li>: {{ $film->time_limit }} phút</li>
					<li>: <span id="counter">0</span></li>
					<li>: <b><span id="total">0</span> <i>VNĐ</i></b></li>
				</ul>
				<div class="clear"></div>
				<ul id="selected-seats" class="scrollbar scrollbar1"></ul>
			
				<button class="checkout-button" disabled="true" >Đặt vé</button>	
                <button type="button" class="checkout-button btn btn-warning pull-right" onclick="history.back();">Quay lại</button>
				<div id="legend"></div>
            </div>
			<div style="clear:both"></div>
		</div>
			<script type="text/javascript">

				var seatUnavailable = "{{ $seatUnavailable }}";

				var arrSeats =  seatUnavailable.split(",")

				var price = 60000; //price
				$(document).ready(function() {
					var $cart = $('#selected-seats'), //Sitting Area
					$counter = $('#counter'), //Votes
					$total = $('#total'); //Total money
					
					var sc = $('#seat-map').seatCharts({
						map: [  //Seating chart
							'aaaaaaaaaa',
							'aaaaaaaaaa',
							'__________',
							'aaaaaaaaaa',
							'aaaaaaaaaa',
							'aaaaaaaaaa',
							'aaaaaaaaaa',
							'aaaaaaaaaa',
							'aaaaaaaaaa',
							'__aaaaaa__'
						],
						naming : {
							top : false,
							getLabel : function (character, row, column) {
								return column;
							}
						},
						legend : { //Definition legend
							node : $('#legend'),
							items : [
								[ 'a', 'available',   'Chưa đặt' ],
								[ 'a', 'unavailable', 'Đã đặt'],
								[ 'a', 'selected', 'Đã chọn']
							]					
						},
						click: function () { //Click event
							if (this.status() == 'available') { //optional seat
								$('<li>Hàng '+(this.settings.row+1)+', Ghế '+this.settings.label+'</li>')
									.attr('id', 'cart-item-'+this.settings.id)
									.data('seatId', this.settings.id)
									.appendTo($cart);

								$counter.text(sc.find('selected').length+1);
								$total.text(recalculateTotal(sc)+price);
								$('.checkout-button').prop('disabled', false);
								return 'selected';
							} else if (this.status() == 'selected') { //Checked
									//Update Number
									$counter.text(sc.find('selected').length-1);
									//update totalnum
									$total.text(recalculateTotal(sc)-price);
										
									//Delete reservation
									$('#cart-item-'+this.settings.id).remove();
									//optional
									if ($counter.html() == 0) {
										$('.checkout-button').prop('disabled', true);
									}

									return 'available';
							} else if (this.status() == 'unavailable') { //sold
								return 'unavailable';
							} else {
								return this.style();
							}
						}
					});
					//sold seat
					sc.get(arrSeats).status('unavailable');
						
				});
				//sum total money
				function recalculateTotal(sc) {
					var total = 0;
					sc.find('selected').each(function () {
						total += price;
					});
							
					return total;
				}
			</script>
    </div>
</div>
<script src="{{ asset('fe_js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('fe_js/scripts.js') }}"></script>
<script>
	$('.checkout-button').click(function(){
		arrSeat = []; 
		$("#selected-seats li").each(function( index ) {
			arrSeat.push($( this ).attr('id').slice(10,13));
		});
		url = window.location.pathname;
		scheduleID = url.split("/")[2];
		total = $('#total').html();
		urlRedirect = "{{ route('films.booking.store') }}";
		
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
			},
			url: urlRedirect,
			type: "POST",
			data: {
				"schedule_id": scheduleID,
				"seats": arrSeat,
				"total": total,
				"price": 60000
			},
			success : function ($result) {
				if ($result.code == 200) {
					urlRedirect = "{{ route('films.payment') }}"
					window.location.href = urlRedirect + '?seats=' + $result.seats + '&total=' + $result.total + '&bookingID=' + $result.booking_id;
				}
			},
			error : function () {
				console.log("error")
			}
		});
	});
</script>		

</body>
</html>
