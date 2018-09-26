var $ = require('jquery');
var moment = require('moment');
const swal = require('sweetalert2');
require('jquery-validation');
//Get All months of Year
var All_month = moment.monthsShort();
//Get Current Month in number
var currentMonth = moment().month();
//Get current Year
var currentYear = moment().year();
//Get date 
var currentDate = moment().format('YYYY-MM-DD');


$(document).ready(function () {
    $(document).ajaxStart(function () {
        $("#loading-gif").show();
    }).ajaxStop(function () {
        $("#loading-gif").hide();
    });
});

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


String.prototype.toArabic= function(){
 var id= ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
 return this.replace(/[0-9]/g, function(w){
  return id[+w]
 });
}


function getCalendar(datas, forwards=null){
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});

	$.ajax({
		headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
		method: 'post',
		data : datas,
		url : '/booking/calendarDates',
		success : function(data){
			
			var res = data.bookings
			var check = moment(datas.date).format('YYYY-MM-DD')
           	var Month = moment(datas.date).month() + 1;
            var Year = moment(datas.date).year();
            var days = moment(datas.date).daysInMonth();
            var default_month = moment().month() + 1;
            var default_year = moment().year();
            var exc_dates =  getExcludeDates();
			var month_calendar = '';
			var venue_selected = $('#current_venue').val();
			var from_date;
			var to_date;
			var rise_capacity = getRiseCapacity();
			var get_work_days = getWorkDays();
			

			if(default_month == Month && default_year == Year){
				var current_date = moment().date()
	        }else{
	        	var current_date = moment(datas.date).date();
	        }	
				if(exc_dates){
					exc_dates.forEach(function(item,index){
						if(venue_selected == item.venues_id){
							from_date = item.from_date;
							to_date = item.to_date;							
						}
					}) 
				}

				var Month_In_Alphabets = moment(datas.date).format('MMM');

				 	
				var j=0;
				
	            for(var i=1; i<=days ;  i++){
	            	if(default_month == Month && default_year == Year){
	            		var classes = current_date > i ? 'greystyle' : '';
		            	classes = current_date == i ? 'greenstyle' : classes;
	            	}else{
	            		classes = '';
	            	}
	            	var checkerz = moment(Year+'-'+Month+'-'+i).format('YYYY-MM-DD')

	            	var capacity =  Month == default_month ? current_date < i ? data.capacity : ''  : current_date <= i ? data.capacity : '';
	            	const weeksInMonth = moment(moment().endOf('month') - moment().startOf('month')).weeks();
	            	var dayname= moment(Year+'-'+Month+'-'+i).format('dddd');
	            	var days_status = 0;
	            	if(get_work_days.length > 0){
	            		for(var nn=0; nn<=get_work_days.length; nn++){
		            		if(get_work_days[nn] == dayname.toLowerCase()){
		            			days_status = 1;
		            			break;
		            		}
	            		}		
	            	}
	            	
	            	//console.log(weeksInMonth);
	            	if(days_status == 1 && i > current_date){
	            		month_calendar += `<div class="calendar_div day_${i} ${classes}"><span class="date${i}">${i}</span>&nbsp;&nbsp;${i.toString().toArabic()}
											<br>
											<span class="offday_title" id="offday_title${i}">OFF DAY</span>
											<span class="not_allow" id="not_allow${i}" style="display:none">NOT ALLOWED</span>
											<br>
											<span class="dayname">${dayname}</span>
											</div>`
	            		days_status = 0;
	            	}
	            	else{
	            		month_calendar += `<div class="main_dates calendar_div day_${i} ${classes}"><span class="date${i}">${i}</span>&nbsp;&nbsp;${i.toString().toArabic()}
											<br>
											<span id="seats${i}">${capacity}</span>
											<span class="not_allow" id="not_allow${i}" style="display:none">NOT ALLOWED</span>
											<br>
											<span  id="booked${i}"></span>
											<span class="dayname">${dayname}</span></div>`
					}
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
		            		if(res_day > current_date){
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

					if(rise_capacity.length >0){
	        			rise_capacity.forEach(function(item,index){
	        				
	        				from_date = item.from_date;
							to_date = item.to_date;

							var start = moment(from_date, "YYYY-MM-DD");
							var end = moment(to_date, "YYYY-MM-DD");
							var selected_month = $('#month').text();

							//standing means the month on the calendar or choosen by user
							var standing_year =  $('#year').text();
							var standing_month = moment().month(selected_month).format("M");
							var standing_month_date = standing_year + '-' + standing_month;
							//var standing_days_in_month = moment(standing_month_date).daysInMonth();
							var check_standing_year = parseInt(moment(standing_month_date).format('YYYY')); //
							var check_to_year = parseInt(moment(item.to_date).format('YYYY')) 	; //

							//Difference in number of days
							var diff_date = moment.duration(end.diff(start)).asDays();
							var check_year = moment(from_date).isSame(to_date, 'year'); // 

							var check_month = moment(from_date).isSame(to_date, 'month'); // 
							if(check_year && check_month && All_month[moment().month()] == selected_month && check_standing_year <= check_to_year){
								var starting = moment(from_date).date() > moment().date() ? moment(from_date).date() : moment().date() + 1 ;
							}else{
								
								if(All_month[moment().month()] == selected_month && check_standing_year <= check_to_year){
									var starting = moment(from_date).date();
								}else{

									
									// standing_month_date = standing_month_date + '-' + standing_days_in_month;

									// var diff_from_standing = moment(new Date(standing_month_date)).diff(new Date(from_date), 'months', true);
									// var diff_current_todate = moment(new Date(standing_month_date)).diff(new Date(to_date), 'months', true);
									// var month_diff = moment(new Date(to_date)).diff(new Date(from_date), 'months', true);
									var standing_monthly = moment(standing_month_date).format('YYYY-MM');
									var to_monthly = moment(item.to_date).format('YYYY-MM');
									var starting = 1;
									if(standing_monthly<=to_monthly && check_standing_year <= check_to_year){
										var days_in_month = moment(from_date).daysInMonth();
										var cur_day = moment(from_date).date()
										var remaining_days = days_in_month - cur_day;
										if(standing_monthly == to_monthly)
											diff_date = moment(item.to_date).date() - 1 ;
										else
											diff_date = diff_date - remaining_days -1
									}else{

									}
									
								}
							}

							for (var i = 0; i <= diff_date; i++) {
								var check_remaining = $('#seats'+starting).hasClass('seats_left')

								if(check_year && check_month && All_month[moment().month()] == selected_month && check_standing_year <= check_to_year){
									if(check_remaining){
										var final_capacity = parseInt(item.rise_capacity - $('#booked'+starting).text());
										$('#seats'+starting).text(final_capacity)
									}else{
										$('#seats'+starting).text(item.rise_capacity)
									}
									
								}else{
									var selected_month = $('#month').text();
									if(All_month[moment().month()] == selected_month && check_standing_year <= check_to_year){
										if(check_remaining){
											var final_capacity = parseInt(item.rise_capacity - $('#booked'+starting).text());
											$('#seats'+starting).text(final_capacity)
										}else{
											$('#seats'+starting).text(item.rise_capacity)
										}
									}else{
										if(standing_monthly<=to_monthly && check_standing_year <= check_to_year){
											if(check_remaining){
												var final_capacity = parseInt(item.rise_capacity - $('#booked'+starting).text());
												$('#seats'+starting).text(final_capacity)
											}else{
												$('#seats'+starting).text(item.rise_capacity)
											}
										}	
									}
								}

								starting++
							}

	        			})
	        			// if(checkerz >= rise_capacity.data[j].from_date && 
	        			// 	checkerz <= rise_capacity.data[j].to_date && 
	        			// 	rise_capacity.data[j].from_date != moment().format('YYYY-MM-DD')){

	        			// 	capacity = rise_capacity.data[j].rise_capacity;
	        			// 	j++;
	        			// }
	        		}
	        		if(exc_dates.length >0){
			 		exc_dates.forEach(function(item,index){
			 				from_date = parseInt(moment(item.from_date,'YYYY/MM/DD').format('D'));
			 				from_date_month = parseInt(moment(item.from_date,'YYYY/MM/DD').format('M'));
			 				from_date_year = parseInt(moment(item.from_date,'YYYY/MM/DD').format('Y'));
			 				to_date = parseInt(moment(item.to_date,'YYYY/MM/DD').format('D'));
			 				to_date_month = parseInt(moment(item.to_date,'YYYY/MM/DD').format('M'));
			 				to_date_year = parseInt(moment(item.to_date,'YYYY/MM/DD').format('Y'));	 				
			 				
			 				// For Loop in Days
			 				for( var i=1; i<=days; i++){
			 					//Check if from_date and to_date have same year
			 					if(from_date_year == Year || to_date_year == Year ){
			 						//Check if from_date and to_date have same month
			 						if(from_date_month == to_date_month){
			 							// Check if current month from_date with selected month
			 							if(from_date_month == Month && from_date_year == Year){
			 								//console.log(from_date , i ,to_date );
				 							if(i >=from_date && i <= to_date && i > current_date){
			 									$('.day_'+i+' #seats'+i).remove();
							 					$('.day_'+i +' #offday_title'+i).remove();
							 					$('.day_'+i+' #not_allow'+i).show();
							 					$('.day_'+i).click(false);
							 					$('.day_'+i).css({'cursor':'not-allowed','background':'red','color':'white'});
				 							}	
			 							}
		 							}
		 							// if from_date and to_date dont have same month
		 							else{
		 								// when from_date month shows with to_month in next/multiple month
		 								if(from_date_month == Month && from_date_year == Year){
		 									if(i > current_date && i >= from_date){
		 										$('.day_'+i+' #seats'+i).remove();
							 					$('.day_'+i +' #offday_title'+i).remove();
							 					$('.day_'+i+' #not_allow'+i).show();
							 					$('.day_'+i).click(false);
							 					$('.day_'+i).css({'cursor':'not-allowed','background':'red','color':'white'});
		 									}
		 								}
		 								// When to_date month shows with from_month in previous month
		 								else if(to_date_month == Month && to_date_year == Year){
		 									if(i <= to_date){
		 										$('.day_'+i+' #seats'+i).remove();
							 					$('.day_'+i +' #offday_title'+i).remove();
							 					$('.day_'+i+' #not_allow'+i).show();
							 					$('.day_'+i).click(false);
							 					$('.day_'+i).css({'cursor':'not-allowed','background':'red','color':'white'});
		 									}
		 								}
		 								// When from_date and to_date have multipe month difference
		 								else{
		 									if(from_date_year == to_date_year){
		 										if(from_date_year == Year){
		 											if(Month > from_date_month && Month < to_date_month){
				 										$('.day_'+i+' #seats'+i).remove();
									 					$('.day_'+i +' #offday_title'+i).remove();
									 					$('.day_'+i+' #not_allow'+i).show();
									 					$('.day_'+i).click(false);
									 					$('.day_'+i).css({'cursor':'not-allowed','background':'red','color':'white'});	
		 											}
		 										}
		 									}
		 									else{
		 										if(Year == from_date_year){
		 											if(Month > from_date_month){
		 												$('.day_'+i+' #seats'+i).remove();
									 					$('.day_'+i +' #offday_title'+i).remove();
									 					$('.day_'+i+' #not_allow'+i).show();
									 					$('.day_'+i).click(false);
									 					$('.day_'+i).css({'cursor':'not-allowed','background':'red','color':'white'});
		 											}
		 										}
		 										else if(Year == to_date_year){
		 											if(Month < to_date_month){
		 												$('.day_'+i+' #seats'+i).remove();
									 					$('.day_'+i +' #offday_title'+i).remove();
									 					$('.day_'+i+' #not_allow'+i).show();
									 					$('.day_'+i).click(false);
									 					$('.day_'+i).css({'cursor':'not-allowed','background':'red','color':'white'});
		 											}
		 										}
		 									}		 											 											 									
		 								}
		 							}
			 					}
			 				}
			 		});
			 		}
		}
	})
}


$(document).on('click', '.main_dates', function(){
	
	var current_date = moment().date();
	var current_month = moment().month() + 1;
	var current_year = moment().year();
	var selected_date = parseInt($(this).children().first().text());
	var selected_month = $('#month').text();
	var number_selected_month = All_month.indexOf(selected_month) + 1;
	var selected_year = parseInt($('#year').text());
	var remaining = parseInt($(this).children().eq(2).text());
	var booked = $(this).children().eq(4).text() == '' ? 0:parseInt($(this).children().eq(4).text());
	var number_month = All_month.indexOf(selected_month) < 9 ? '0'+ (All_month.indexOf(selected_month) + 1) : All_month.indexOf(selected_month) + 1;
	var selected_full_date = selected_year + '-' + number_month + '-' + selected_date;


	if(selected_date == current_date){
		swal('OOps','Event Already Started Please Select Future Dates',  'error')
	}else if(selected_date < current_date && number_selected_month <= current_month &&  selected_year == current_year){
		swal('Back Dates Not Allowed','Please Select Future Dates',  'error')
	}else{
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
			  	studentsCount = studentsCount?parseInt(studentsCount):''
			  	if (studentsCount === "") {
					throw new Error("You need to type in your Students Count for Reservation!")
			        return false;
				}else if(studentsCount > remaining){
					throw new Error("Total Should Not be Greater Than Venue Capacity OF " + total );
			        return false;
				}else{
					return studentsCount;
				}
				}
			}).then((result) => {
				if(result.value){

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
									`);
				var studentsCount = $("#students_count").val();
				$("#students_count_reservation").val(studentsCount);
				var selected_date = $("#selected_date").val();
				$("#chosen_date").val(selected_date);

			   $("html, body").animate({ scrollTop: $(document).height() }, 1000);
		   	}
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
	var check_already_login = is_logged_in()
	if(check_already_login.success){
   		var div = `<div class="logged-in">
						${check_already_login.message}
	    			</div>`
	    	$("#logged-in").html(div);
	    	getReservation()
	$("html, body").animate({ scrollTop: $(document).height() }, 1000);
	return false;

	}
		$.ajax({
	    type: 'GET', 
	    url : "/event-login", 
	    success : function (data) {

	    	if(data.success){
	    		getReservation()
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
		var show_login = false;
      	$.ajax({
      	headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
	    type: 'POST', 
	    url : "/event-register",
	    data: $( this ).serializeArray() ,
	    success : function (data) {
	    	if(data.success){
	    		//console.log($("#logged-in"))
	    		$('#login').trigger('click');
	    		setTimeout(function(){
	    				    		var div = `<div class="logged-in" style="margin-bottom:10px;">
								${data.message}
	    				  </div>`
	    		$("#logged-in").prepend(div);
	    		$('.login-succes').addClass('d-none');
	    		$('.logged-in').addClass('alert-success');
	    		},1000)

	    		

	    	}
	    	else if(data.errors){
	    		$.each(data.errors,function(key,value){
	    			$('.login-succes').removeClass('d-none');
		    		$('.login-succes').removeClass('alert-success', 'd-none');
		    		$('.login-succes').addClass('alert-danger');
		    		$('.login-succes').html(value).show()
	    		});
	    		
	    	}
	    	else{
	    		$('.login-succes').removeClass('d-none');
	    		$('.login-succes').removeClass('alert-success', 'd-none');
	    		$('.login-succes').addClass('alert-danger');

	    		$('.login-succes').html(data.message).show()
	    		
	    		$("#logged-in").html(data);
	    	}
	 	
		//$("html, body").animate({ scrollTop: $(document).height() }, 1000);
	    },
	    error: function(data){
	    	$.each(data.responseJSON.errors,function(key,value){
	    			$('.login-succes').removeClass('d-none');
		    		$('.login-succes').removeClass('alert-success', 'd-none');
		    		$('.login-succes').addClass('alert-danger');
		    		$('.login-succes').html(value).show()
	    		});
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
	    		var div = `<div class="logged-in">
								${data.message}
	    				  </div>`
	    		$("#logged-in").html(div);
	    		$('.login-succes').addClass('d-none');
	    		$('#logged-in').addClass('alert-success');
	    		getReservation()
	    	}
	    	else if(data.errors){
	    		$.each(data.errors,function(key,value){
	    			$('.login-succes').removeClass('d-none');
		    		$('.login-succes').removeClass('alert-success', 'd-none');
		    		$('.login-succes').addClass('alert-danger');
		    		$('.login-succes').html(value).show()
	    		});
	    		
	    	}
    		else{
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
	var res = new Array();
		$.ajax({
		    type: 'GET', 
		    async: false,
		    url : "/is-logged-in", 
		    success : function (data) {
		    	res = data;
		    	
		    }
		});
	return res;		
}


function getReservation(){

	fetch('/check-bookings')
	.then(res => res.json())
	.then(response => {
		if(!response.success){
			getReservationForm()
		}else{
			$("#get-reservation").html("<span>You Have Already Reserved For Event and is Pending Approval</span>");			
		}
	})
	.catch(error => console.error('Error:', error));
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
	$('#reservation_venue_id').val($('#current_venue').val());	
	//console.log($('#current_venue').val(),$('#reservation_venue_id').val())
	$('#form_reservation').submit();	
})

$(document).on('change','#students_count', function() {
   alert('value changed');
});

$(document).on('submit','#form_reservation', function(e) {
	
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	var data = $(this).serializeArray();
	$.ajax({
		type: 'post',		
		data : new FormData($('#form_reservation')[0]),
		processData: false,
        contentType: false,
		url : '/book/reservation',
		success : function(response){
			var error = '';
			if(response.original){
				$.each(response.original, function(index, item){
				error += item + ' <br> ';
			})
			$('.reservation-error').removeClass('d-none');	
			$('.reservation-error').addClass('alert-danger');	
			$('.reservation-error').html(error);
			$('#terms_overlay').addClass('d-none');
			$('.terms_conditions').addClass('d-none');		
			}
			if(response.success){
				window.location = '/reservation-success';
			}		
		 }
	})	
	e.preventDefault();
 })

function getReservationForm(){
	fetch('/get-reservation')
	.then(res => res.text())
	.then(text => {
		$("#get-reservation").html(text);
		var studentsCount = $("#students_count").val();
		$("#students_count_reservation").val(studentsCount);
		var selected_date = $("#selected_date").val();
		$("#chosen_date").val(selected_date);
		//$('#students_count_reservation').prop('disabled', true);
	})
}

// async function getExcludeDates(){
	 
// 	var data = await getdates()

// 	return data;
// }


// function getdates(){

// 	 return new Promise(resolve => {
// 		fetch('/get-exclude-dates')
// 		.then(res => res.json())
// 		.then(res => {
// 			var datas = res;
// 			resolve(datas.data);
// 			//$('#students_count_reservation').prop('disabled', true);
// 		});
//   });
// }

function getExcludeDates(){
	var res = new Array();
		$.ajax({
		    type: 'POST', 
		    async: false,
		    data: {venue_id: $('#current_venue').val()},
		    url : "/get-exclude-dates", 
		    success : function (data) {
		    	res = data;
		    }
		});
	return res.data;		
}

function getRiseCapacity(){
	var res = new Array();
		$.ajax({
		    type: 'POST', 
		    async: false,
		    data: {venue_id: $('#current_venue').val()},
		    url : "/get-rise-capacity", 
		    success : function (data) {
		    	res = data;
		    }
		});
	return res.data;		
}

function getWorkDays(){
	var res = new Array();
		$.ajax({
		    type: 'POST', 
		    async: false,
		    data: {venue_id: $('#current_venue').val()},
		    url : "/get-work-days", 
		    success : function (data) {
		    	res = data;
		    }
		});
	return res;		
}
