var $ = require('jquery');
var moment = require('moment');
const swal = require('sweetalert2');
//Get All months of Year
var All_month = moment.monthsShort();
//Get Current Month in number
var currentMonth = moment().month();
//Get current Year
var currentYear = moment().year();
//Get year on calendar


//Check what if select previous month
$(document).on('click','.left_bar', function(){
	var month = $('#month').html();
	var getkey = All_month.indexOf(month) - 1;
	var year_calendar = parseInt($('#year').html());
	//Will check if selecting the month not less than current month of this year
	//else if it is on next year then go back as usual
	if(getkey >= 0){
		if(getkey >= currentMonth){
			var prev_month = All_month[getkey];
			$('#month').text(prev_month);
		}else{
			if(year_calendar > currentYear){
				var prev_month = All_month[getkey];
				$('#month').text(prev_month);
			}
		}
		if(year_calendar > currentYear){
			var cur_date = year_calendar + '-' + moment().month(All_month[getkey]).format("M") + '-01';
			var venue = $('#current_venue').val();

			var data = {id: venue, date:cur_date}

			getCalendar(data);
		}else if(All_month.indexOf(month) > currentMonth){
			var cur_date = year_calendar + '-' + moment().month(All_month[getkey]).format("M") + '-01';
			var venue = $('#current_venue').val();
			var data = {id: venue, date:cur_date}
			getCalendar(data);
		}
	}else{
		if(year_calendar > currentYear){
			var year_calendar = year_calendar - 1;
			var prev_month = All_month[11];
			$('#month').text(prev_month);
			$('#year').text(year_calendar)
				
		}

	var cur_date = year_calendar + '-' + moment().month(All_month[11]).format("M") + '-01';
	var venue = $('#current_venue').val();

	var data = {id: venue, date:cur_date}

	getCalendar(data);
	}

})

//check what if select next months
$(document).on('click','.right_bar', function(){
	//get value of the month on calendar
	var month = $('#month').html();
	var getkey = All_month.indexOf(month) + 1;
	var year_calendar = parseInt($('#year').html());
	//check if month is December or less than that else go for next year
	if(getkey <= 11){
			var next_month = All_month[getkey];
			$('#month').text(next_month);
	}else{
		year_calendar = year_calendar + 1;
		//if next month is exceeding December then make month as January and add one year and render
		var next_month = All_month[0];
		$('#month').text(next_month);
		$('#year').text(year_calendar)
	}

	getkey = getkey <= 11 ? getkey : 0;
	var cur_date = year_calendar + '-' + moment().month(All_month[getkey]).format("M") + '-01';
	var venue = $('#current_venue').val();
	var data = {id: venue, date:cur_date}
	getCalendar(data, true);
//$("html, body").animate({ scrollTop: $(document).height() - 200 }, 1000);
});

$('.venues').click(function(){

	//set state for current venue
	var venue_id  = $(this).attr('id');
	var cur_date = moment().format('YYYY-MM-DD');
	var data = {id : venue_id, date: cur_date};
	$('#current_venue').val(venue_id)
	getCalendar(data,true);
	var heights = $(document).height()-500
	$("html, body").animate({ scrollTop: heights }, 1000);
})



function getCalendar(datas, forwards=null){

	$.ajax({
		headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
		method: 'post',
		data : datas,
		url : '/booking/calendarDates',
		success : function(data){
			var res = data
			var check = moment(datas.date).format('YYYY-MM-DD')
           	var Month = moment(datas.date).month() + 1;


            var Year = moment(datas.date).year();
            var days = moment(datas.date).daysInMonth();

            var default_month = moment().month() + 1;

            if(default_month == Month){
	            var current_date = moment().date()
	        }else{
	        	var current_date = moment(datas.date).date();
	        }
			var month_calendar = '';

			

			var Month_In_Alphabets = moment(datas.date).format('MMM');

            for(i=1; i<=days ;  i++){
            	if(default_month == Month){
	            	var classes = current_date > i ? 'greystyle' : '';
	            	classes = current_date == i ? 'greenstyle' : classes;
            	}else{
            		classes = '';
            	}
	            var capacity =  Month == default_month ? current_date < i ? res[0].capacity : ''  : current_date <= i ? res[0].capacity : '';
				month_calendar    += `<div class="main_dates calendar_div ${classes}"><span clas="date${i}">${i}</span>
										<br>
										<span id="seats${i}">${capacity}</span>
										<br>
										<span  id="booked${i}"></span></div>`
			}

			if(res.length > 0){

				// res.forEach(function(element){
				$('#calendar').remove();
				$('#parent_calendar').append(`<div id="calendar"><div class="calendar_Date">
                    <div class="left_bar"><i class="fas fa-angle-left"></i></div>        
                    <div id="month_year"><span id="month">${Month_In_Alphabets}</span> &nbsp;&nbsp; <span id="year">${Year}</span></div> 
                    <div class="right_bar"><i class="fas fa-angle-right"></i></div>
                </div>
                <div class="card-body">
                    <div class="calendar col-md-12">
                        ${month_calendar}
                    </div>
                </div>
               </div>`);

			// })
			//console.log(res)

			 res.forEach(function(el){
            	var res_month = moment(el.book_date).month() + 1
            	var res_day = moment(el.book_date).date()
            	var res_year = moment(el.book_date).year()
            	var seats = el.capacity

            	if(res_month == Month && res_year == Year){
            		if(res_day >= current_date){
            			seats = el.capacity - el.seats;
            			$('#seats'+res_day).text(seats)
            			$('#booked'+res_day).text(el.seats)
            			$('#seats'+res_day).addClass('seats_left');
            			$('#booked'+res_day).addClass('booked');
            		}
            	}

            })

			}else{
				$('#calendar').remove();
				$('#parent_calendar').append(`<div id="calendar"><div class="calendar_Date">
                    <div class="left_bar"><i class="fas fa-angle-left"></i></div>        
                    <div id="month_year"><span id="month">${Month_In_Alphabets}</span> &nbsp;&nbsp; <span id="year">${Year}</span></div> 
                    <div class="right_bar"><i class="fas fa-angle-right"></i></div>
                </div>
                <div class="card-body">
                    <div class="calendar col-md-12">
                        ${month_calendar}
                    </div>
                </div>
               </div>`);
			}
		}
	})
}


$(document).on('click', '.main_dates', function(){
	
	var current_date = moment().date();
	var selected_date = $(this).children().first().text();
	var selected_month = $('#month').text();
	var selected_year = $('#year').text();
	var remaining = parseInt($(this).children().eq(2).text());
	var booked = $(this).children().eq(4).text() == '' ? 0:parseInt($(this).children().eq(4).text());


	if(selected_date == current_date){
		swal('OOps','Event Already Started Please Select Future Dates',  'error')
	}else if(selected_date < current_date){
		swal('Back Dates Not Allowed','Please Select Future Dates',  'error')
	}else if(selected_date> current_date){
		console.log(remaining, booked)
		var total = remaining + booked;

		// swal.mixin({
		//   input: 'text',
		//   confirmButtonText: 'OK',
		//   showCancelButton: true,
		// }).queue([
		//   {
		//     title: 'Please select Students Count',
		//   }
		// ]).then((result) => {

		// 	var studentsCount = result.value;

		// 	if (studentsCount[0] === "") {
		// 		console.log('coming')
		// 		throw new Error("You need to type in your Students Count for Reservation!")
		//         return false;
		// 	}else if(studentsCount[0] > total){
		// 		swal.showInputError("Total Should Not be Greater Than Venue Capacity OF "+total );
		//         return false;
		// 	}

			var number_month = All_month.indexOf(selected_month) < 10 ? '0'+All_month.indexOf(selected_month) : All_month.indexOf(selected_month);
			var selected_full_date = selected_year + '-' + number_month + '-' + selected_date;
			$('#selected_date').val(selected_full_date)
		// 	$('#students_count').val(studentsCount);
		//   	if (studentsCount) {
		//     swal({
		//       title: 'All done!',
		//       html:
		//         'You selected ' +
		//           studentsCount +
		//         ' Students',
		//       confirmButtonText: 'Close!'
		//     })
		//   }
		//   //error handling
		// }).catch(error => {
	 //        swal.showValidationError(
	 //          `Request failed: ${error}`
	 //        )
  //     })


		swal({
			  title: 'Please select Students Count',
			  input: 'text',
			  inputAttributes: {
			    autocapitalize: 'off'
			  },
			  showCancelButton: true,
			  confirmButtonText: 'ok',
			  showLoaderOnConfirm: true,
			  preConfirm: (studentsCount) => {
			  	console.log(studentsCount, total )
			  	if (studentsCount === "") {
					throw new Error("You need to type in your Students Count for Reservation!")
			        return false;
				}else if(studentsCount > total){
					throw new Error("Total Should Not be Greater Than Venue Capacity OF " + total );
			        return false;
				}else{
					return studentsCount;
				}
				}
			}).then((result) => {
				$('#students_count').val(result.value)
				$('.log_reg').removeClass('d-none')
				$('#tab1').html(`<div class="login-register">
									<div class="child-login-register">
										<button class="btn btn-primary btn-custs-reg-login login" id="login">Login</button>
									</div>
									<div class="child-login-register">
										<button class="btn btn-primary btn-custs-reg-login register" id="register">New User</button>
									</div>
								</div>
									`)
				
				 // $.ajax({
		   //          type: 'GET', 
		   //          url : "/event-register", 
		   //          success : function (data) {
		   //          	console.log(data)
		   //              $("#tab1").html(data);
		   //          }
		   //      });
		   $("html, body").animate({ scrollTop: $(document).height() }, 1000);
			  }).catch(error => {
			        swal({
			        	type : 'error',
			        	text : `${error}`,
			        })
			      })
		}

});


$(document).on('click', '#login', function(){
	$('.forms_click').removeClass('d-none')
		$.ajax({
	    type: 'GET', 
	    url : "/event-login", 
	    success : function (data) {

	    	if(data.success){
	    		console.log($("#logged-in"))
	    		// var div = `<div class="logged-in">
							// 	${data.message}
	    		// 		  </div>`
	    		// $("#logged-in").html(div);
	    		
	    		fetch('/check-bookings')
	    		.then(res => res.json())
				.then(response => {
					if(!response.success){
						fetch('/get-reservation')
						.then(res => res.text())
						.then(text => {
							$("#get-reservation").html(text);
							var studentsCount = $("#students_count").val();
							console.log(studentsCount);
							$("#students_count_reservation").val(studentsCount);
							$('#students_count_reservation').prop('readonly', true);
						})
					}else if(response.success && response.data.status == 1){

					}else{

					}
				})
				.catch(error => console.error('Error:', error));
	    	}else{
	    		$("#logged-in").html(data);
	    	}
	    
	    
		$("html, body").animate({ scrollTop: $(document).height() }, 1000);

	    }
	});
})

$(document).on('click', '#register', function(){
	$('.forms_click').removeClass('d-none')
	var check_already_login = is_logged_in()
	if(check_already_login.success){
   		var div = `<div class="logged-in">
						${check_already_login.message}
	    			</div>`
	    	$("#logged-in").html(div);
	$("html, body").animate({ scrollTop: $(document).height() }, 1000);
	return false;

	}
		$.ajax({
	    type: 'GET', 
	    url : "/event-register", 
	    success : function (data) {

	        $("#logged-in").html(data);
	        $("html, body").animate({ scrollTop: $(document).height() }, 1000);
	    }
	});
})	

// $(document).on('click', '#event-login', function(){

// document.getElementById("form_id").submit();
// 	// var email = $()
// 	// 	$.ajax({
// 	//     type: 'POST', 
// 	//     url : "/login", 
// 	//     success : function (data) {
// 	//     	console.log(data)
// 	//         $("#logged-in").html(data);
// 	// 	$("html, body").animate({ scrollTop: $(document).height() }, 1000);

// 	//     }
// 	// });
// })


$(document).on('submit', 'form.form_register', function(e){
      	$.ajax({
      	headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
	    type: 'POST', 
	    url : "/event-register",
	    data: $( this ).serializeArray() ,
	    success : function (data) {
	    	// if(data.success){
	    	// 	console.log($("#logged-in"))
	    	// 	var div = `<div class="logged-in">
						// 		${data.message}
	    	// 			  </div>`
	    	// 	$("#logged-in").html(div);
	    	// 	$('.login-succes').addClass('d-none');
	    	// 	$('#logged-in').addClass('alert-success');
	    	// }else{
	    	// 	$('.login-succes').removeClass('d-none');
	    	// 	$('.login-succes').removeClass('alert-success', 'd-none');
	    	// 	$('.login-succes').addClass('alert-danger');

	    	// 	$('.login-succes').html(data.message).show()
	    	// 	//$("#logged-in").html(data);
	    	// }
	    	console.log(data)
	 	// $("#logged-in").html(data);
		// $("html, body").animate({ scrollTop: $(document).height() }, 1000);
		$("html, body").animate({ scrollTop: $(document).height() }, 1000);
	    }
	});
  e.preventDefault();
});


$(document).on('submit', 'form.form_id', function(e){
	
      	$.ajax({
      	headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
	    type: 'POST', 
	    url : "/event-login",
	    data: $( this ).serializeArray() ,
	    success : function (data) {
	    	if(data.success){
	    		console.log($("#logged-in"))
	    		var div = `<div class="logged-in">
								${data.message}
	    				  </div>`
	    		$("#logged-in").html(div);
	    		$('.login-succes').addClass('d-none');
	    		$('#logged-in').addClass('alert-success');
	    	}else{
	    		$('.login-succes').removeClass('d-none');
	    		$('.login-succes').removeClass('alert-success', 'd-none');
	    		$('.login-succes').addClass('alert-danger');

	    		$('.login-succes').html(data.message).show()
	    		//$("#logged-in").html(data);
	    	}
	   
	 	// $("#logged-in").html(data);
		// $("html, body").animate({ scrollTop: $(document).height() }, 1000);
		$("html, body").animate({ scrollTop: $(document).height() }, 1000);
	    }
	});

fetch('/check-bookings').then(res => res.json())
.then(response => console.log('Success:', JSON.stringify(response)))
.catch(error => console.error('Error:', error));
      


  e.preventDefault();
});


function is_logged_in(){
	res = new Array();
	$.ajax({
	    type: 'GET', 
	    async: false,
	    url : "/is-logged-in", 
	    success : function (data) {
	    	res = data;
	    	
	    }
	});
console.log(res)
	return res;
		
}


function getReservation(){

	

	fetch('/get-reservation')
	.then(res => res.value)
	.then(response => {

	})
}

$(document).on('click','#btn_make_reservation', function(){
	$('#terms_overlay').removeClass('d-none');
	$('.terms_conditions').removeClass('d-none');

})

$(document).on('click','#cancel_reservation',function(){
	$('#terms_overlay').addClass('d-none');
	$('.terms_conditions').addClass('d-none');
})

$(document).on('click','#submit_reservation',function(){
	$('#form_reservation').submit();
	e.preventDefault();
})