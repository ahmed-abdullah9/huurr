jQuery(document).ready(function()
{
    // setInterval(function () {
    //     retrie_notification();
    // }, 10000);
$.each($('ul li'), function()
       {
	if($(this).find('a').attr('href')==window.location.href)
    {
	$(this).addClass('active');
}
});
});
function retrie_notification()
{
    $.ajax({
        url: BASE_URL+'/fr/notification',
        type: 'GET',
    })
        .done(function(data) {
        	var ht='';
            if(data!='false') {
                $.each(data['messages'], function (index, value) {
                    ht += '<li> <span> <span><b>' + value.name + '</b></span>&nbsp;&nbsp;&nbsp; <span class="time"><b>' + value.date + '</b></span> </span><br> <span class="message"> ' + value.message + ' </span> <a class="delete_notify" style="text-align: right;cursor: pointer;font-size: 16px;" data-notify_id="' + value.id + '">X</a> </li>';
                });
                $('.badge').html('');
                $('#menu1').html('');
              var count=data['count'];
                $('.badge').append(count);
                $('#menu1').append(ht);
            }else{
            	ht+='<li><a>There Is no Any Notification</a></li>';
                $('#menu1').html('');
                $('.badge').html('');
                $('#menu1').html(ht);
			}
        })
        .fail(function(error) {
            console.log(error);
        });
}
// ISOTOPE FILTER
jQuery(document).ready(function($){
	if ( $('.iso-box-wrapper').length > 0 ) { 

	    var $container 	= $('.iso-box-wrapper'), 
	    	$imgs 		= $('.iso-box img');



	    $container.imagesLoaded(function () {

	    	$container.isotope({
				layoutMode: 'fitRows',
				itemSelector: '.iso-box'
	    	});

	    	$imgs.load(function(){
	    		$container.isotope('reLayout');
	    	})

	    });

	    //filter items on button click

	    $('.filter-wrapper li a').click(function(){

	        var $this = $(this), filterValue = $this.attr('data-filter');

			$container.isotope({ 
				filter: filterValue,
				animationOptions: { 
				    duration: 750, 
				    easing: 'linear', 
				    queue: false, 
				}              	 
			});	            

			// don't proceed if already selected 

			if ( $this.hasClass('selected') ) { 
				return false; 
			}

			var filter_wrapper = $this.closest('.filter-wrapper');
			filter_wrapper.find('.selected').removeClass('selected');
			$this.addClass('selected');

	      return false;
	    }); 

	}

/*
* Ajax request for edit educatoin
*/


$("a.edit-education").click(function(event){
	event.preventDefault();
	var educatoin_id = $(this).attr('educatoin_id');

	var data = {
		'id' : educatoin_id		
	};
	
	$.ajax({
		url : 'educationedit',
		method : 'GET',
		datatype: 'json',
		data : data

	});
});

});


// HIDE MOBILE MENU AFTER CLIKING ON A LINK
   $('.navbar-collapse a').click(function(){
        $(".navbar-collapse").collapse('hide');
    });


// SCROLLTO THE TOP
$(document).ready(function() {
	// Show or hide the sticky footer button
	$(window).scroll(function() {
		if ($(this).scrollTop() > 200) {
			$('.go-top').fadeIn(200);
		} else {
			$('.go-top').fadeOut(200);
		}
	});		
	// Animate the scroll to top
	$('.go-top').click(function(event) {
		event.preventDefault();
	
		$('html, body').animate({scrollTop: 0}, 300);
	})
});
jQuery(document).ready(function($) {
	$(document).on('click', '.addnewbtn', function(event) {
		event.preventDefault();
		var empty = false;
		$.each($('.addskilone'), function(index, val) {
			 if($(this).find('input').val()=='')
			 {
			 	empty=true;
			 }
		});
		if(empty==true)
		{
			alert('Please fill previous field for add more');
			return false;
		}
		$('.addskillbox').append('<div class="addskilone"><input name="job_skills[]" class="form-control c-form" type="text" placeholder="Type here" /><a href="javascript:void(0);" class="remove_skil">X</a></div>')
	});
	$(document).on('click', '.remove_skil', function(event) {
		event.preventDefault();
		$(this).closest('.addskilone').remove();
	});
	$(document).on('keyup', '#hourly_rate', function(event) {
		var value = $(this).val();
		var job_cahrges=$('#job_charges').val();
		var ttv = value*job_cahrges/100;
		var ftt = value-ttv;
		var cst = currency_symbol + ttv;
		if($("#will_be_paid").hasClass("client_amount")){
			var ftt =parseInt(value)+ttv;
			$("#will_be_paid").val(ftt);
		}
		else{
			$("#will_be_paid").val(ftt);
		}
        $("#service_fee").val(cst);
	});
	$(document).on('keyup', '#hourly_rate', function(event) {
		if(!$.isNumeric($(this).val()))
		{
			$(this).val('').trigger('change');
			return false;
		}
	});
	$(document).on('click', '.upload_profile_image', function(event) {
		$('#profile_image').click();
	});
	$(document).on('change', '#profile_image', function(event) {
		var formdata = new FormData();
		console.log($('#profile_image')[0].files[0]);
		formdata.append('profile_image',$('#profile_image')[0].files[0]);
		var url = $('#profile_update_url').val();

		$.ajax({
			url: url,
			type: 'POST',
			data: formdata,
			processData: false,
   			contentType: false,
   			headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				  },
		})
		.done(function(data) {
			$('#display_profile_image').attr('src',data);
            location.reload();
        })
		.fail(function(error) {
			console.log(error);
		})
		.always(function() {
			console.log("complete");
		});
		
	});
	$(document).on('click', '.delete_notify', function(event) {
		event.preventDefault();
		var notify_id = $(this).data('notify_id');
		var url = $('base').attr('href');
		var $this = $(this);
		var noti_count = $('.info-number span.bg-green').text();
		$.ajax({
			url: BASE_URL+'/delete_notify',
			type: 'POST',
			data: {id: notify_id},
			headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				  },
		})
		.done(function() {
			$('.info-number span.bg-green').text(noti_count-1)
			$this.closest('li').remove();
		})
		.fail(function() {
			console.log("error");
		});		
	});
	// $(document).on('click', '.start_registration', function(event) {
	// 	event.preventDefault();
	// 	$("#site_loader").fadeIn();
	// 	var error_check = false;
	// 	$('.error').css('display','none');
	// 	$('#common-error').html('').css('font-size','16px');
	// 	$.each($('.input_val'), function(index, val) {
	// 		if($(this).val()=='')
	// 		{
	// 			var id = $(this).attr('id');
	// 			$('#'+id+'-error').css('display','block');
	// 			error_check = true;
	// 		}
	// 	});
	// 	if(error_check==true)
	// 	{
	// 		$("#site_loader").fadeOut();
	// 		return false;
	// 	}
	// 	var dataString = $(this).closest('form').serialize();
	// 	var url = $('base').attr('href');
	// 	$.ajax({
	// 		url: url+'/register',
	// 		type: 'POST',
	// 		data: dataString,
	// 	})
	// 	.done(function(data) {
	// 		$("#site_loader").fadeOut();
	// 		var result = $.parseJSON(data);
	// 		if(result.status==true)
	// 		{
	// 			$('.hide_form, .start_registration').hide('fast');
	// 			$('#common-error').css('display','block').css('font-size','30px').css('color','green').html(result.message);
	// 			$('.login-form')[0].reset();
	// 			return false;
	// 		}else {
	// 			$('#common-error').css('display','block').css('color','red').html(result.message);
	// 			return false;
	// 		}
    //
	// 	})
	// 	.fail(function(error) {
	// 		$("#site_loader").fadeOut();
	// 		console.log(error);
	// 	});
	//
	// });
	$(document).on('click', '.save_job', function(event) {
		event.preventDefault();
		$this = $(this);
		var url = $('base').attr('href');
		var job_id = $(this).data('ng_bind');
		var dataString = 'job_id='+job_id;
		$.ajax({ 
			url: BASE_URL+'/save/job',
			type: 'POST',   
			data: dataString,
			headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				  },
		})
		.done(function(data) {
			if(data==1)
			{
				$this.addClass('saved_job_active');
				alert('job Saved Successfully')
			}else {
				$this.removeClass('saved_job_active');
				alert('Job is Already Saved')
				window.reload();
			}
		})
		.fail(function(error) {
			console.log(error);
		});
		
	});
	$(document).on('click', '.save_freelancer', function(event) {
		event.preventDefault();
		$this = $(this);
		var url = $('base').attr('href');
		var user_id = $(this).data('ng_bind');
		var dataString = 'user_id='+user_id;
		$.ajax({ 
			url: BASE_URL+'/save/freelancer',
			type: 'POST',   
			data: dataString,
			headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				  },
		})
		.done(function(data) {
			if(data==1)
			{
				alert('freelancer Saved Successfully');
				$this.addClass('saved_job_active');
			}else {
                alert('freelancer already Saved');
				$this.removeClass('saved_job_active');
			}
		})
		.fail(function(error) {
			console.log(error);
		});
		
	});
	$(document).on('click', '.hire_freelancer_for_job', function(event) {
		var url = $('base').attr('href');
		var user_id = $(this).data('freelancer_id');
		var job_id = $(this).data('job_id');
		var dataString = 'user_id='+user_id+'&job_id='+job_id;
		$.ajax({ 
			url: url+'/hire/freelancer',
			type: 'POST',   
			data: dataString,
			headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				  },
		})
		.done(function(data) {
			if(data=='invited')
			{
				alert('You already hired this freelancer');
			}
				alert('User hired successfully');
				window.location.reload();
				return false;
			
		})
		.fail(function(error) {
			console.log(error);
		});
		
	});
	$(document).on('click', '.invite_send_freelancer', function(event) {
		event.preventDefault();
		var url = $('base').attr('href');
		var dataString = $(this).closest('form').serialize();
		$.ajax({ 
			url: BASE_URL+'/invite_free/freelancer',
			type: 'POST',   
			data: dataString,
			headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				  },
		})
		.done(function(data) {
			console.log(data);
			if(data=='message')
			{
				alert('Please Enter message');
				return false;
			}
			if(data=='price')
			{
				alert('Please Enter price');
				return false;
			}		
			else if(data=='job')
			{
				alert('Please select job or post new job');
				return false;
			}else if(data=='invited')
			{
				alert('You already invited this freelancer for this job');
			}else
			{
				alert('Invitation send successfully');
				window.location.reload();
				return false;
			}
		})
		.fail(function(error) {
			console.log(error);
		});
		
	});
	$(document).on('click', '.click_event', function(event) {
		event.preventDefault();
		$('#attachments').click();
	});
	
	$(document).on('click', '.remove_skil', function(event) {
		event.preventDefault();
		$(this).closest('.skil_box').remove();
	});
	$(document).on('change','.attchmentd',function() {
	  readURL(this);
	});
	$('#removeButton').remove();
	$(document).on('change','.attchmentd_prt',function(){
		var img_id = $(this).data('img_id');
		readURL2(this, img_id);
	});
	$(document).on('click', '.remove_clsQ', function(event) {
		$(this).closest('.new_question').remove();	
	});
	$(document).on('click', '#addButton', function(event) {
		var empty = false;
		$.each($('.new_question'), function(index, val) {
			 if($(this).find('input').val()=='')
			 {
			 	empty=true;
			 }
		});
		if(empty==true)
		{
			alert('Please fill previous field for add more');
			return false;
		}
		$("#TextBoxesGroup").append('<div class="new_question"><br><input type="text" id="textbox1" name="job_questions[]" class="form-control c-form" style="float:left;"><a class="remove_clsQ btn btn-primary">X</a></div>')
	});
	$(document).on('change', '.sl_name_1', function(event) {
		event.preventDefault();
		if($(this).is(':checked'))
		{
			$('.input_check_box_text').hide().val(1);
		}else {
			$('.input_check_box_text').show().val('');
		}
	});
	$(document).on('change', '.sl_name_2', function(event) {
		event.preventDefault();
		if($(this).is(':checked'))
		{
			$('.input_check_box_text').show().val('');
		}else {
			$('.input_check_box_text').hide().val(1);
		}
	});
});
function invite_for_interview(proposal_id, user_id)
	{
		var url = $('base').attr('href');
		var dataString = 'user_id='+user_id+'&proposal_id='+proposal_id;
		$.ajax({ 
			url: url+'/invite_user',
			type: 'POST',   
			data: dataString,
			headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				  },
		})
		.done(function(data) {
			alert('invited');
			window.location.reload();
		})
		.fail(function(error) {
			console.log(error);
		});
	}
	function Offer_job(proposal_id, user_id)
	{
		var url = $('base').attr('href');
		var dataString = 'user_id='+user_id+'&proposal_id='+proposal_id;
		$.ajax({ 
			url: url+'/Offer_job',
			type: 'POST',   
			data: dataString,
			headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				  },
		})
		.done(function(data) {
			alert('offered');
			window.location.reload();
		})
		.fail(function(error) {
			console.log(error);
		});
	}
	function claimJob(){
        var data=$('#claimJob').serializeArray();
        $.ajax({
            url: BASE_URL+'/cl/claimJob',
            type: 'POST',
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        }).done(function(data) {
            	var ht='';
                if(data=='reason'){
                	ht+="<p class='alert alert-danger'>please Select Reason</p>";
				}
				else
					if (data=='hire_free_id'){
                        ht+="<p class='alert alert-danger'>Something is going wrong</p>";
					}
					else if (data=='already')
						{
							alert("hello world");
                            setTimeout(function(){
                                window.location.reload();
                            }, 7000);
                            ht+="<p class='alert alert-danger'>your submited Claimed already</p>";
					}
					else{
                        setTimeout(function(){
                            window.location.reload();
                        }, 7000);
                        ht+="<p class='alert alert-success'>your claim submited successfully</p>";
					}
                $('.claim-common-messages').html('');
                $('.claim-common-messages').html(ht);
                $(".claim-common-messages").show();
                setTimeout(function(){
                    $('.claim-common-messages').hide();
                }, 7000);
            })
            .fail(function(error) {
                console.log(error);
            });
    }
    function disClaim(job_id,proposal_id){
        $.ajax({
            url: BASE_URL+'/cl/disclaimJob',
            type: 'POST',
            data: {'job_id':job_id,'proposal_id':proposal_id},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        }).done(function(data) {
        	var ht=''
                if(data=='already'){
                    window.location.reload();
                    ht+="<p class='alert alert-danger'>You have already Disclaim job</p>";
                }
                else
                if (data=='ok'){
                    window.location.reload();
                    ht+="<p class='alert alert-success'>Job is Disclaimed Successfully</p>";

                }
                else if (data=='error')
                {
                    window.location.reload();
                    ht+="<p class='alert alert-success'>Something is going wrong try again</p>";

                }
            $('.common-messages').html('');
            $('.common-messages').html(ht);
            $("#common-messages").modal("show");
            setTimeout(function(){
                $('#common-messages').modal('hide')
            }, 7000);
            }).fail(function(error) {
                console.log(error);
            });
    }
	function post_to_complete(proposal_id, user_id)
	{
		var url = $('base').attr('href');
		var dataString = 'user_id='+user_id+'&proposal_id='+proposal_id;
		$.ajax({ 
			url: BASE_URL+'/post_to_complete',
			type: 'POST',   
			data: dataString,
			headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				  },
		})
		.done(function(data) {
			window.location.reload();
            ht+="<p class='alert alert-success'>You have Ended Contract Successfully</p>";
            $('.common-messages').html('');
            $('.common-messages').html(ht);
            $("#common-messages").modal("show");
            setTimeout(function(){
                $('#common-messages').modal('hide')
            }, 7000);
		})
		.fail(function(error) {
			console.log(error);
		});
	}
	function start_contract(proposal_id, user_id)
	{
		var url = $('base').attr('href');
		var dataString = 'user_id='+user_id+'&proposal_id='+proposal_id;
		$.ajax({ 
			url: BASE_URL+'/start_contract',
			type: 'POST',   
			data: dataString,
			headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				  },
		})
		.done(function(data) {
			alert('started');
			window.location.reload();
		})
		.fail(function(error) {
			console.log(error);
		});
	}
	function accept_for_interview(proposal_id, user_id)
	{
		var url = $('base').attr('href');
		var dataString = 'user_id='+user_id+'&proposal_id='+proposal_id;
		$.ajax({ 
			url: BASE_URL+'/accept_for_interview',
			type: 'POST',   
			data: dataString,
			headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				  },
		})
		.done(function(data) {
			alert('Accepted');
			window.location.href = BASE_URL+'/proposals';
		})
		.fail(function(error) {
			console.log(error);
		});
	}

	function accept_offer(proposal_id, user_id)
	{
		var url = $('base').attr('href');
		var dataString = 'user_id='+user_id+'&proposal_id='+proposal_id;
		$.ajax({ 
			url: BASE_URL+'/accept_offer',
			type: 'POST',   
			data: dataString,
			headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				  },
		})
		.done(function(data) {
			window.location.reload();
            var ht='';
            ht+="<p class='alert alert-success'>Offer is accepted successfully</p>";
            $('.common-messages').html('');
            $('.common-messages').html(ht);
            $("#common-messages").modal("show");
            setTimeout(function(){
                $('#common-messages').modal('hide')
            }, 7000);
		})
		.fail(function(error) {
			console.log(error);
		});
	}
	function decline_propsals(proposal_id, user_id)
	{
		var url = $('base').attr('href');
		var dataString = 'user_id='+user_id+'&proposal_id='+proposal_id;
		$.ajax({ 
			url: BASE_URL+'/decline_propsals',
			type: 'POST',   
			data: dataString,
			headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				  },
		})
		.done(function(data) {
			alert('decline');
			window.location.reload();
		})
		.fail(function(error) {
			console.log(error);
		});
	}
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#image_preview').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}
function readURL2(input, img_id)
{
	if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#'+img_id).attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}
function value_sub(action)
{
	jQuery('#action').hide().val(action).attr('type','submit').click();
}
jQuery(document).ready(function($){
  var RatingAray = {};
  $('.stars li').on('mouseover', function(){
    var onStar = parseInt($(this).data('value'), 10);
    $(this).parent().children('li').each(function(e){
      if (e < onStar) {
        $(this).addClass('hover');
      }
      else {
        $(this).removeClass('hover');
      }
    });
  }).on('mouseout', function(){
    $(this).parent().children('li').each(function(e){
      $(this).removeClass('hover');
    });
  });
  $('.stars li').on('click', function(){
    var onStar = parseInt($(this).data('value'), 10);
    var stars = $(this).parent().children('li');
    for (i = 0; i < stars.length; i++) {
      $(stars[i]).removeClass('selected');
    }
    for (i = 0; i < onStar; i++) {
      $(stars[i]).addClass('selected');
    }
    var dt_n = $(this).closest('ol.stars').data('rating_n');
    RatingAray[dt_n] = onStar;
    var input_score  = 0;
    var devider = 0;
    $.each(RatingAray, function(index, val) {
       input_score += val;
       devider++;
    });
    var rating_round = Math.round(input_score/devider);
    $('.skil_rating').val(rating_round);
    $('.skil_rating_html').text(rating_round);
  });
  $(document).on('click', '.end-contract', function(event) {
  	event.preventDefault();
  	var dataString = $(this).closest('form').serialize();
  	var url = $(this).closest('form').attr('action');
  	if ($('.skil_rating').val()=='') {
  		alert('Please select star rating');
  		return false;
  	}
  	if ($('.reason_ending').val()=='') {
  		alert('Please select Ending Reason Of project');
  		return false;
  	}
  	if ($('.comment').val()=='') {
  		alert('Please Enter Comment');
  		return false;
  	}

  	$.ajax({
  		url: url,
  		type: 'POST',
  		data: dataString,
  		headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				  },
  	})
  	.done(function(data) {
  		console.log(data);
  		alert('Feedback submitted successfully');
  		window.location.reload();
  	})
  	.fail(function(error) {
  		console.log(error);
  	});

  });
});