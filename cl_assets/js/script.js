$(document).ready(function(){
	$(".remove-question").click(function(){
		$(this).closest("div.TextBoxDiv").remove();
	});
});