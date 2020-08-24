@include ('include/header_cl')
<div style="padding-bottom: 80px;padding-top: 20px;">
  <div style="padding-bottom: 10px;" id="frame">
    <div id="sidepanel">
      <div id="profile">
        <div class="wrap">
          <img id="profile-img" src="<?php echo ((isset($user_profile->profile_image) && !empty($user_profile->profile_image))?url('/').'/'.$user_profile->profile_image:asset('/fr_assets/images/user.png')); ?>" class="online" alt="" />
          <p>{{Session::get('name')}}</p>
          <i class="fa fa-chevron-down expand-button" aria-hidden="true"></i>
          <div id="status-options">
            <ul>
              <li id="status-online" class="active"><span class="status-circle"></span> <p>Online</p></li>
              <li id="status-away"><span class="status-circle"></span> <p>Away</p></li>
              <li id="status-busy"><span class="status-circle"></span> <p>Busy</p></li>
              <li id="status-offline"><span class="status-circle"></span> <p>Offline</p></li>
            </ul>
          </div>
          <div id="expanded">
            <label for="twitter"><i class="fa fa-facebook fa-fw" aria-hidden="true"></i></label>
            <input name="twitter" type="text" value="mikeross" />
            <label for="twitter"><i class="fa fa-twitter fa-fw" aria-hidden="true"></i></label>
            <input name="twitter" type="text" value="ross81" />
            <label for="twitter"><i class="fa fa-instagram fa-fw" aria-hidden="true"></i></label>
            <input name="twitter" type="text" value="mike.ross" />
          </div>
        </div>
      </div>
      <div style="margin-bottom:30px;" id="search">
        <label class="position_l_10" for=""><i class="fa fa-search" aria-hidden="true"></i></label>
        <input type="text" class="padding_r_10" name="search-text" class="search-text" placeholder="{{__('freelancer.search_contacts')}}" />
      </div>
      <div id="contacts">
        <ul>

        </ul>
      </div>
      {{--<div id="bottom-bar">--}}
      {{--<button id="addcontact"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> <span>Add contact</span></button>--}}
      {{--<button id="settings"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span>Settings</span></button>--}}
      {{--</div>--}}
    </div>
    <div class="content">
      <div class="contact-profile">
        {{--<img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />--}}
        {{--<p>Harvey Specter</p>--}}
        <div class="social-media">
          {{--<i class="fa fa-facebook" aria-hidden="true"></i>--}}
          {{--<i class="fa fa-twitter" aria-hidden="true"></i>--}}
          {{--<i class="fa fa-instagram" aria-hidden="true"></i>--}}
        </div>
      </div>
      <div class="messages">
        <ul>

        </ul>
      </div>
      <div class="message-input" style="z-index: 0;">
        <form id="client_message_form" method="post">
        <div class="wrap" style="display: flex;flex-direction: row;">
          <input style="width: 92%;height: 50px;" type="text" name="message" class="freeancer_message" placeholder="{{__('freelancer.write_message')}}" />
           <input type="hidden" id="fr_id" name="freelancer_id" class="freelancer_id">
          {{--<i class="fa fa-paperclip attachment" aria-hidden="true"></i>--}}
          <button  class="cl_sendMessage"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script><script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
<script >$(".messages").animate({ scrollTop: $(document).height() }, "fast");

    $("#profile-img").click(function() {
        $("#status-options").toggleClass("active");
    });

    $(".expand-button").click(function() {
        $("#profile").toggleClass("expanded");
        $("#contacts").toggleClass("expanded");
    });

    $("#status-options ul li").click(function() {
        $("#profile-img").removeClass();
        $("#status-online").removeClass("active");
        $("#status-away").removeClass("active");
        $("#status-busy").removeClass("active");
        $("#status-offline").removeClass("active");
        $(this).addClass("active");

        if($("#status-online").hasClass("active")) {
            $("#profile-img").addClass("online");
        } else if ($("#status-away").hasClass("active")) {
            $("#profile-img").addClass("away");
        } else if ($("#status-busy").hasClass("active")) {
            $("#profile-img").addClass("busy");
        } else if ($("#status-offline").hasClass("active")) {
            $("#profile-img").addClass("offline");
        } else {
            $("#profile-img").removeClass();
        };

        $("#status-options").removeClass("active");
    });

    function newMessage() {
        message = $(".message-input input").val();
        if($.trim(message) == '') {
            return false;
        }
        $('<li class="sent"><img src="http://emilcarlsson.se/assets/mikeross.png" alt="" /><p>' + message + '</p></li>').appendTo($('.messages ul'));
        $('.message-input input').val(null);
        $('.contact.active .preview').html('<span>You: </span>' + message);
        $(".messages").animate({ scrollTop: $(document).height() }, "fast");
    };

    $('.submit').click(function() {
        newMessage();
    });


    //# sourceURL=pen.js
</script>
@include ('include/footer_cl')
<script src="{{ asset('js/message.js') }}"></script>
