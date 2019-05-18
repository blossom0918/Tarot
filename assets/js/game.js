$('input[type="radio"]').click(function(){
//	$(".category").hide();
	$(".desk").show();
	$(".choice").hide();
})

$(".card").click(function(){
	$(".desk").hide();
	$(".choice").show();
})

$('input[type="reset"]').click(function(){
//	$(".category").hide();
	$(".choice").hide();
})