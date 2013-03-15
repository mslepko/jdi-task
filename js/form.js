$(document).ready(function(){
	$('#submitNewIncident').click(function(){
		$('#newIncident input').removeClass('error');
		var hasError = false;
		var errors = new Array();
		var i =0;

		var incident_date = Date.parse($('#incident_date').val());
		var resolution_date = Date.parse($('#resolution_date').val());
		var total_time = $('#total_time').val();
		var explanation = $('#explanation').val();
		var measures = $('#measures').val();
		
		var i_date = new Date(incident_date);
		if(i_date == 'Invalid Date') {
			errors[i] = 'Date / Time of Incident is invalid';
			$('#incident_date').addClass('error');
			hasError = true;
			i++;
		}

		var res_date = new Date(resolution_date);
		if(res_date == 'Invalid Date') {
			errors[i] = 'Date / Time of Resolution is invalid';
			$('#resolution_date').addClass('error');
			hasError = true;
			i++;
		}

		if(total_time.length==0){
			errors[i] = 'Total Time Elapsed cannot be empty';
			$('#total_time').addClass('error');
			hasError = true;
			i++;
		}

		if(explanation.length==0){
			errors[i] = 'General Explanation cannot be empty';
			$('#explanation').addClass('error');
			hasError = true;
			i++;
		}

		if(measures.length==0){
			errors[i] = 'Measures cannot be empty';
			$('#measures').addClass('error');
			hasError = true;
			i++;
		}
		if(hasError == true){
			var showAlert = 'Errors: \n';
			$.each(errors,function(i,e){
				showAlert += '- '+e+'\n';
			})
			alert(showAlert);
			return false;
		}else 
			return true;			
	})
	
	$('#submitNewComment').click(function(){
		var name = $('#name').val();
		var comment = $('#comment').val();
		var hasError = false;
		var errors = new Array();
		var i = 0;

		if(name.length==0 || name.length>32){
			errors[i] = 'Name must be from 1 to 32 characters long.';
			$('#name').addClass('error');
			hasError = true;
			i++;
		}	

		if(comment.length==0){
			errors[i] = 'Comment cannot be empty';
			$('#comment').addClass('error');
			hasError = true;
		}
		if(hasError == true){
			var showAlert = 'Errors: \n';
			$.each(errors,function(i,e){
				showAlert += '- '+e+'\n';
			})
			alert(showAlert);
			return false;
		}else 
			return true;
	})

	$('.error').live('focus',function(){
		$(this).removeClass('error');
	})

})
