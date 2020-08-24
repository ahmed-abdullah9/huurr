jQuery(document).ready(function(event) {
   getallConversation();
    setTimeout(function(){ defaultfrmessages(); }, 2000);
    setInterval(function(){ getclnewMessages();}, 2000);
    setInterval(function(){ getallConversation();}, 5000);

});
function getallConversation(){
       var search=$(".search-text").val();
    $.ajax({
        url:BASE_URL+'/cl/getConversation',
        type: 'GET',
        data:{'search':search},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    })
        .done(function(data) {
        	ht='';
        	var online="";
            $.each(data, function( index, value ) {
                if(value.freelancer_online==1){
                    online="online";
                }
                else{
                    online="";
                }
            ht+='<li onclick="showMessages(this)" data-freelancer-id='+value.freelancer_id+' class="contact">\
                <div class="wrap">\
                <span class="contact-status '+online+'"></span>\
                <img src='+BASE_URL+'/'+value.freelancer_image+' alt="" />\
                <div class="meta">\
                <p class="name">'+value.freelancer_name+'</p>\
            <p class="preview">new messages(<span class="badge">'+value.new_message+'</span>) </p>\
            </div>\
            </div>\
            </li>';
            });
            $("#contacts ul").html("");
            $("#contacts ul").append(ht);
            //defaultfrmessages();
        })
        .fail(function(error) {
            console.log(error);
        });
}
function sendclMessage(){
        var fr_id=$("#fr_id").val();
        var message=$(".freeancer_message").val();
        var data=$('#client_message_form').serialize();
        $(".freeancer_message").val("");
        $.ajax({
            url:BASE_URL+'/cl/cl_sendMessage',
            type: 'POST',
            data:{'freelancer_id':fr_id,'message':message},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        })
            .done(function(data) {
                var ht="";
                $.each(data, function( index, value ) {
                    if(fr_id==value.receive_id){
                        ht+="<li class='sent'>\
                   <img src='http://emilcarlsson.se/assets/harveyspecter.png' alt='' />\
                    <p>"+value.message_contents+"</p>\
                    </li>";
                    }
                    else{
                        ht+="<li class='replies'>\
                    <img src="+BASE_URL+'/'+value.freelancer_image+" alt='' />\
                    <p>"+value.message_contents+"</p>\
                </li>";
                    }

                });
                $(".messages ul").append(ht);
            })
            .fail(function(error) {
                console.log(error);
            });

}
$(".freeancer_message").on('keydown', function(e) {
    if (e.which == 13) {
        event.preventDefault();
        sendclMessage();
    }
});
   $(".cl_sendMessage").click(function (event) {
	   event.preventDefault();
       sendclMessage();
   });
   function getclnewMessages(){
       fr_id=$(".freelancer_id").val();
       var ht="";
       $.ajax({
           url:BASE_URL+'/cl/getclnewMessages',
           type: 'POST',
           data:{'freelancer_id':fr_id},
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
       })
           .done(function(data) {
               $.each(data, function( index, value ) {
                   if(fr_id==value.receive_id){
                       ht+="<li class='sent'>\
                   <img src="+BASE_URL+"/fr_assets/images/user.png' alt='' />\
                    <p>"+value.message_contents+"</p>\
                    </li>";
                   }
                   else{
                       ht+="<li class='replies'>\
                    <img src="+BASE_URL+'/'+value.freelancer_image+" alt='' />\
                    <p>"+value.message_contents+"</p>\
                </li>";
                   }

               });
               $(".messages ul").append(ht);
           })
           .fail(function(error) {
               console.log(error);
           });
   }
   function defaultfrmessages(){
       $("#contacts ul li:first-child").addClass('active');
       var freelancer_id =  $("#contacts ul li:first-child").attr("data-freelancer-id");
       $(".freelancer_id").val(freelancer_id);
       var ht="";
       var ht1="";
       $.ajax({
           url:BASE_URL+'/cl/get_frMessages',
           type: 'POST',
           data:{'freelancer_id':freelancer_id},
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
       })
           .done(function(data) {
               $.each(data, function( index, value ) {
                   if(fr_id==value.receive_id){
                       ht+="<li class='sent'>\
                   <img src='"+BASE_URL+"/fr_assets/images/user.png' alt='' />\
                    <p>"+value.message_contents+"</p>\
                    </li>";
                       ht1="<img src="+BASE_URL+'/'+value.freelancer_image+" alt='' />\
                        <p>"+value.freelancer_name+"</p>\
                    <div class='social-media'>\
                        </div>";
                   }
                   else{
                       ht+="<li class='replies'>\
                    <img src="+BASE_URL+'/'+value.freelancer_image+" alt='' />\
                    <p>"+value.message_contents+"</p>\
                </li>";
                       ht1="<img src="+BASE_URL+'/'+value.freelancer_image+" alt='' />\
                        <p>"+value.freelancer_name+"</p>\
                    <div class='social-media'>\
                        </div>";
                   }

               });
               $(".contact-profile").html("");
               $(".contact-profile").append(ht1);
               $(".messages ul").html("");
               $(".messages ul").append(ht);
               $(".messages").animate({ scrollTop: 2000 }, "fast");
               getallConversation();
           })
           .fail(function(error) {
               console.log(error);
           });

   }
function  showMessages(freelancer_id){
	$(".contact").click(function() {
		$(this).addClass('active');
    });
    var fr_id = freelancer_id.getAttribute("data-freelancer-id");
    $(".freelancer_id").val(fr_id);
    var ht="";
    var ht1="";
    $.ajax({
        url:BASE_URL+'/cl/get_frMessages',
        type: 'POST',
		data:{'freelancer_id':fr_id},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    })
        .done(function(data) {
            $.each(data, function( index, value ) {
                if(fr_id==value.receive_id){
                    ht+="<li class='sent'>\
                   <img src='"+BASE_URL+"/fr_assets/images/user.png' alt='' />\
                    <p>"+value.message_contents+"</p>\
                    </li>";
                    ht1="<img src="+BASE_URL+'/'+value.freelancer_image+" alt='' />\
                        <p>"+value.freelancer_name+"</p>\
                    <div class='social-media'>\
                        </div>";
				}
				else{
                    ht+="<li class='replies'>\
                    <img src="+BASE_URL+'/'+value.freelancer_image+" alt='' />\
                    <p>"+value.message_contents+"</p>\
                </li>";
                    ht1="<img src="+BASE_URL+'/'+value.freelancer_image+" alt='' />\
                        <p>"+value.freelancer_name+"</p>\
                    <div class='social-media'>\
                        </div>";
				}

            });
            $(".contact-profile").html("");
            $(".contact-profile").append(ht1);
            $(".messages ul").html("");
            $(".messages ul").append(ht);
            $(".messages").animate({ scrollTop: 2000 }, "fast");
            getallConversation();
        })
        .fail(function(error) {
            console.log(error);
        });

}