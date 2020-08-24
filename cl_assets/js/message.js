jQuery(document).ready(function($) {
	$('.right-header-contentChat').scrollTop($('.right-header-contentChat')[0].scrollHeight);
	$(document).on('click', '.send_message', function(event) {
		event.preventDefault();
		var url = $('base').attr('href');
		var message_id = $(this).data('ng_message_id');
		var message = $('#message_box').val();
		if(message=='')
		{
			alert('Please Enter message');
			return false;
		}
		var dataString = 'message_id='+message_id+'&message='+message;
		$.ajax({ 
			url: url+'/send/message',
			type: 'POST',   
			data: dataString,
			headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				  },
		})
		.done(function(data) {
			$('#append_message_box').html(data);
			$('#message_box').val('');
			$('.right-header-contentChat').scrollTop($('.right-header-contentChat')[0].scrollHeight);
		})
		.fail(function(error) {
			console.log(error);
		});		
	});
	$(document).on('click', '.open_chat_vindeo', function(event) {
		event.preventDefault();
		var url = $('base').attr('href');
		var message_id = $(this).data('ng_message_id');		
		var dataString = 'message_id='+message_id;
		$.ajax({ 
			url: url+'/single/message',
			type: 'POST',   
			data: dataString,
			headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				  },
		})
		.done(function(data) {
			$('#append_message_box').html(data);
			$('.send_message').attr('data-ng_message_id',message_id);
			$('.right-header-contentChat').scrollTop($('.right-header-contentChat')[0].scrollHeight);
		})
		.fail(function(error) {
			console.log(error);
		});		
	});
});
setInterval(function() {
retrive_message_new();
},15000);
function retrive_message_new()
{
	var url = $('base').attr('href');
	var message_id = $('.send_message').data('ng_message_id');
	var dataString = 'message_id='+message_id
	$.ajax({ 
		url: url+'/retrive/new/message',
		type: 'POST',   
		data: dataString,
		headers: {
			    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  },
	})
	.done(function(data) {
		var result = $.parseJSON(data);
		$('#append_message_box').html(result.return_html);
		$('#append_new_list').html(result.newlist);
		$('.right-header-contentChat').scrollTop($('.right-header-contentChat')[0].scrollHeight);
	})
	.fail(function(error) {
		console.log(error);
	});	
}