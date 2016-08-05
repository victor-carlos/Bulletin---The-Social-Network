var index;

function abrirAba(aba){
	index = aba;
}

$(function() {
	
    $('.btn1, .btn2').click(function(){
		//var conteudo = $(".about").parent().find('.content');
		
		//alert($(".content:eq("+index+") div").attr("style"));
		
		if($(".content:eq("+index+") div").attr("style") == "display: none;"){
			$(".content:eq("+index+") div").slideDown('less', function(){
				$(".content:eq("+index+") div").attr("style", "display: block;");
				$(".btn1:eq("+(index - 1)+"), .btn2:eq("+index+")").css("transform", "rotate(225deg)");
			});
			
		}else{
			$(".content:eq("+index+") div").slideUp('less', function(){
				$(".content:eq("+index+") div").attr("style", "display: none;");
				$(".btn1:eq("+(index - 1)+"), .btn2:eq("+index+")").css("transform", "rotate(45deg)");
			});
		}
	});
	
	$('.btn4').click(function(){
		//var conteudo = $(".about").parent().find('.content');
		
		//alert(index+"--"+$(".bulletin:eq("+index+") div").attr("style"));
		
		if($(".bulletin:eq("+index+") div").attr("style") == "display: none;"){
			$(".bulletin:eq("+index+") div").slideDown('less', function(){
				//$(".bulletin:eq("+index+") div").attr("style", "display: block;");
				$(".btn4:eq("+(index - 2)+"), .btn4:eq("+index+")").css("transform", "rotate(225deg)");
			});
			
		}else{
			$(".bulletin:eq("+index+") div").slideUp('less', function(){
				//$(".bulletin:eq("+index+") div").attr("style", "display: none;");
				$(".btn4:eq("+(index - 2)+"), .btn4:eq("+index+")").css("transform", "rotate(45deg)");
			});
		}
	});
	
	$('.btn6').click(function(){
		
		if($(".blt_window").css("display") == "none"){
			$(".blt_window").slideDown('less');
			
		}else{
			$(".blt_window").slideUp('less');
		}
	});
	
	$('#global-menu').click(function(){
		if ($(".global-main-menu").css("display") == "none") {
			$(".global-main-menu").slideDown();
		}else{
			$(".global-main-menu").slideUp();
		}
	});
	
	/* Correção de bug do height: 100%; da classe global-nav */
	$(".global-nav").css("height", $(window).height());
	
	/*$('#publicar').click(function() {
		
		var dados = $('#publicacao').serialize();
		
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: '_ajax/publicPost.php',
			async: true,
			data: dados,
			success: function(response) {
				location.reload();
			}
		});

		return false;
	});*/
	

	
//});
	
});

