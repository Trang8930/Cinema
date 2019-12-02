$(document).ready(function(){
		$("#rap").change(function(){
			var idrap= $(this).val();
			$.get("ajax/phong/"+idrap,function(data){
				$("#phong").html(data);
			});
		});

		$("#lich").change(function(){
			var idphim= $(this).val();
			$.get("ajax/lichchieu/"+idphim,function(data){
				$("#lichchieu").html(data);
			});
		});

		$("#phong").change(function(){
			var idphong= $(this).val();
			$.get("ajax/ghe/"+idphong,function(data){
				$("#dsghe").html(data);
			});
		});
});