$.fn.addFunct = function(functName) {
	$(this).html("")
    $(this).html("<div id='"+functName+"' class='dynFunct'><input type='hidden' class='function' value='"+functName+"'></div>"+$(this).html())
	return $("#"+functName)
};



$.fn.addParam = function(paramName,paramVal) {
	$(this).html("<input type='hidden' id='"+paramName+"' class='param' value='"+paramVal+"'>"+$(this).html())
	return $(this)
};


$.fn.addTempl = function(templVal) {
	$(this).html("<input type='hidden' class='templ' value='"+templVal+"'>"+$(this).html())
	return $(this)
};


$.fn.addText = function(paramName,paramVal) {
	$(this).html("<textarea style='display:none' id='"+paramName+"' class='param'>"+paramVal+"</textarea>"+$(this).html())
	return $(this)
};






$.fn.goAjax = function() {
	nameDiv = $(this).attr("id")
	$( "#"+nameDiv+">.dynFunct" ).each(function() {
	
	
		FunctionName = $(this).attr("id")
		
		params = "function="+FunctionName
			
			$( "#"+nameDiv+">#"+FunctionName+">.param" ).each(function() {
			
				ParamName = $(this).attr("id")
				ParamVal = $(this).val()
				
				params = params +"&"+ParamName+"="+encodeURIComponent(ParamVal)
			
			});
			
			$( "#"+nameDiv+">#"+FunctionName+">.templ" ).each(function() {

				ParamVal = $(this).val()
				
				params = params +"&templ="+encodeURIComponent(ParamVal)			
			
			
			});
		
				
		$.ajax({
			url: "get.php?",
			type: "POST",
			data : params,
			async: false, 
			success: function (res) { 
			
			  $("#"+nameDiv+">#"+FunctionName).html(res);
			}
		});
		
	});

	return $(this)
};




