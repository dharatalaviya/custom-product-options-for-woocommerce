jQuery(document).ready(function($){
	var jemCutsomValidation = jem.cutsomValidationFields;
	console.log(jemCutsomValidation);
	$(".cart").validate({
		 debug:true,
		errorElement: 'label',
   	 	wrapper: 'p',
   	 	
	});
	if(jemCutsomValidation.length > 0){
		 $.each(jemCutsomValidation, function(key, value) {
		 	//console.log(regexp.test(value.validation_regex));
			var id = "#"+value.unique_name;
			$( id ).rules( "add", {
				required: true,
				regex: value.validation_regex,
				messages: {
					required: "Required input",
					regex:value.error_msg
				}
			});
		});
	}
	
	$.validator.addMethod("regex", function(value, element, regexp) {
		 regexp = new RegExp(regexp);
		return regexp.test(value);
	});
		
});