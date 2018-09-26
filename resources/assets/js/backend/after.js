// Loaded after CoreUI app.js

var $ = require('jquery');

jQuery(function(){
     $('#backend-bookings #venue_id').on('change',function(){
       	$.ajax({
		type:'GET',
		url: "/admin/get-venue-capacity",
		data: {venue_id: $(this).val()},
		success: function(data){
			$('#backend-bookings #venue-capacity').text(data);
		}
		});
    });
    var keyupp = false; 
    $('#backend-bookings #students_count').on('keyup',function(){
       	if(!keyupp){
       		$.ajax({
			type:'GET',
			url: "/admin/get-venue-capacity",
			data: {venue_id: $('#backend-bookings #venue_id').val()},
			success: function(data){
				$('#label-capacity').show();
				$('#backend-bookings #venue-capacity').text(data);
				keyupp = true;
			}
			});
       	}

    }); 
});

$( "#backend-bookings" ).submit(function( event ) {
  	var students_count = $('#backend-bookings #students_count').val();
  	var capacity = parseInt($('#backend-bookings #venue-capacity').text());
  	if(capacity){
  		if(students_count > capacity){
  		alert('Students Count Should be less than Total Capacity');
  		event.preventDefault();
  		setTimeout(function(){
  			$('#submit-bookings').attr('disabled', false);
  		},1000);
//  		return false;
  		}
  	}
});

// $('.backend-bookings #venue_id').on('change',function(){
// 	alert('coming here');
// 	$.ajax({
// 	type:'GET',
// 	url: "/venue-capacity",
// 	data: {venue_id: venue_id},
// 	success: function(data){
// 		console.log(data);
// 	}
// 	});
// })

// const days_work= ['saturday', 'sunday', 'monday', 'tuesday', 'wednessday', 'thursday', 'friday'];

// $('#days_of_work').val(JSON.stringify(days_work))

// $(document).on('click','#saturday, #sunday, #monday, #tuesday, #wednessday, #thursday, #friday', function(){

// 	let selected_val = this.value;

// 	if(days_work.includes(selected_val)){
// 		days_work.splice( days_work.indexOf(selected_val), 1 );
// 	}else{
// 		days_work.push(selected_val)
// 	}

// 	$('#days_of_work').val(JSON.stringify(days_work))

// })