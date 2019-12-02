var giave=document.getElementById('giave').innerHTML;
var slve=document.getElementsByClassName('slve');
var tongtienve=document.getElementsByClassName('tongtienve');
var prices = [65000,80000,150000];
var units = document.getElementsByClassName('units-class');
var subs = document.getElementsByClassName('subtotal-class');
var grand = document.getElementById('total');
tienve()
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



function onLoaderFunc()
{
	$(".seatStructure *").prop("disabled", true);
	$(".displayerBoxes *").prop("disabled", true);

}



function takeData()
{
	if ( $("#Numseats").val() == 0)
	{
		alert("Vui lòng chọn số lượng vé xem phim");
	}
	else
	{
		$('.booking').addClass('tieptuc');
		$('.seatbooking').addClass('showseat');
		$(".inputForm *").prop("disabled", true);
		$(".seatStructure *").prop("disabled", false);
		
	}
}

var allNameVals = [];
var allNumberVals = [];
var allSeatsVals = [];
var allIdSeat = [];
function updateTextArea() { 
	
	if ($("input:checked").length == ($("#Numseats").val()))
	{
		$(".seatStructure *").prop("disabled", true);
		
		
		
     //Storing in Array
     allNumberVals.push($("#Numseats").val());
     $('#seatsBlock :checked').each(function() {
     	allSeatsVals.push($(this).val());
     	allIdSeat.push($(this).attr('id'));
     });
     
     //Displaying 
     $('#nameDisplay').val(allNameVals);
     $('#NumberDisplay').val(allNumberVals);
     $('#seatsDisplay').val(allSeatsVals);
 }
 else
 {
 	alert("Please select " + ($("#Numseats").val()) + " seats")
 }
}


function myFunction() {
	alert($("input:checked").length);
}

$(":checkbox").click(function() {
	if ($("input:checked").length == ($("#Numseats").val())) {
		$(":checkbox").prop('disabled', true);
		$(':checked').prop('disabled', false);
	}
	else
	{
		$(":checkbox").prop('disabled', false);
	}
});

$(document).ready(function(){
		$("#addve").click(function(){
			var url="/ajaxdatve";
			var idlich= $('.idlich').val();
			var iduser= $('.iduser').val();

			$.ajax({
				type:'GET',
				url:url,
				data:{
					idlich:idlich,
					iduser:iduser,
					allseat:allIdSeat
				},
				success:function(response){
					alert("đặt vé thành công");
				}
			});
		});
	});
