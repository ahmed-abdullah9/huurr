jQuery(document).ready(function($) {
    getallConversation();
    setTimeout(function(){ defaultfrmessages(); }, 2000);
    setInterval(function() {
        getclnewMessages();
    },2000);
    setInterval(function() {
        getallConversation();
    },5000);
    // setInterval(function(){ getclnewMessages() }, 1000);
});

function getallConversation(){

    $.ajax({
        url:BASE_URL+'/fr/getConversation',
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    })
        .done(function(data) {
            ht='';
            $.each(data, function( index, value ) {
                ht+='<li onclick="showMessages(this)" data-client-id='+value.client_id+' class="contact">\
                <div class="wrap">\
                <span class="contact-status"></span>\
                <img src="'+BASE_URL+'/fr_assets/images/user.png" alt="" />\
                <div class="meta">\
                <p class="name">'+value.client_name+'</p>\
            <p class="preview">new messages <span class="badge-danger">'+value.new_message+'</span></p>\
            </div>\
            </div>\
            </li>';
            });
            $("#contacts ul").html("");
            $("#contacts ul").append(ht);
            // defaultfrmessages();
        })
        .fail(function(error) {
            console.log(error);
        });
}
function sendfrMessage(){
    var cl_id=$("#cl_id").val();
    var message=$(".freeancer_message").val();
    var data=$('#client_message_form').serialize();
    $(".freeancer_message").val("");
    $.ajax({
        url:BASE_URL+'/fr/fr_sendMessage',
        type: 'POST',
        data:{'client_id':cl_id,'message':message},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    })
        .done(function(data) {
            $(".messages").animate({ scrollTop: $(document).height() }, "fast");
            var ht="";
            console.log('message send')
            $.each(data, function( index, value ) {
                if(cl_id==value.sender_id){
                    ht+="<li class='replies'>\
                     <img src='"+BASE_URL+"/fr_assets/images/user.png' alt='' />\
                    <p>"+value.message_contents+"</p>\
                </li>";
                }
                else{
                    ht+="<li class='sent'>\
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
function defaultfrmessages() {
    $("#contacts ul li:first-child").addClass('active');
    var cl_id = $("#contacts ul li:first-child").attr("data-client-id");
    $(".client_id").val(cl_id);
    var ht="";
    $.ajax({
        url:BASE_URL+'/fr/get_clMessages',
        type: 'POST',
        data:{'client_id':cl_id},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    })
        .done(function(data) {
            $.each(data, function( index, value ) {
                if(cl_id==value.sender_id){
                    ht+="<li class='replies'>\
                     <img src='"+BASE_URL+"/fr_assets/images/user.png' alt='' />\
                    <p>"+value.message_contents+"</p>\
                </li>";
                    ht1="<img src='"+BASE_URL+"/fr_assets/images/user.png' alt='' />\
                        <p>"+value.client_name+"</p>\
                    <div class='social-media'>\
                        </div>";
                }
                else{
                    ht+="<li class='sent'>\
                   <img src="+BASE_URL+'/'+value.freelancer_image+" alt='' />\
                    <p>"+value.message_contents+"</p>\
                    </li>";
                }

            });
            $(".contact-profile").html("");
            $(".contact-profile").append(ht1);
            $(".messages ul").html("");
            $(".messages ul").append(ht);
            $(".messages").animate({ scrollTop: $(document).height() }, "fast");
            getallConversation();
        })
        .fail(function(error) {
            console.log(error);
        });
}
$(".freeancer_message").on('keydown', function(e) {
    if (e.which == 13) {
        event.preventDefault();
        sendfrMessage();
    }
});
$(".cl_sendMessage").click(function (event) {
    event.preventDefault();
    sendfrMessage();
});
function getclnewMessages(){
    cl_id=$(".client_id").val();
    var ht="";
    $.ajax({
        url:BASE_URL+'/fr/get_clnewMessages',
        type: 'POST',
        data:{'client_id':cl_id},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    })
        .done(function(data) {
            $.each(data, function( index, value ) {
                if(cl_id==value.sender_id){
                    ht+="<li class='replies'>\
                     <img src='"+BASE_URL+"/fr_assets/images/user.png' alt='' />\
                    <p>"+value.message_contents+"</p>\
                </li>";
                }
                else{
                    ht+="<li class='sent'>\
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
function  showMessages(client_id){
    $(".contact").click(function() {
        $(this).addClass('active');
    });
    var cl_id = client_id.getAttribute("data-client-id");
    $(".client_id").val(cl_id);
    var ht="";
    $.ajax({
        url:BASE_URL+'/fr/get_clMessages',
        type: 'POST',
        data:{'client_id':cl_id},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    })
        .done(function(data) {
            $.each(data, function( index, value ) {
                if(cl_id==value.sender_id){
                    ht+="<li class='replies'>\
                     <img src='"+BASE_URL+"/fr_assets/images/user.png' alt='' />\
                    <p>"+value.message_contents+"</p>\
                </li>";
                }
                else{
                    ht+="<li class='sent'>\
                   <img src="+BASE_URL+'/'+value.freelancer_image+" alt='' />\
                    <p>"+value.message_contents+"</p>\
                    </li>";
                }

            });
            $(".messages ul").html("");
            $(".messages ul").append(ht);
            $(".messages").animate({ scrollTop: $(document).height() }, "fast");
            getallConversation();
        })
        .fail(function(error) {
            console.log(error);
        });

}