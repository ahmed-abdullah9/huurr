<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'Freelancer') }}</title>

<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/nivo-lightbox.css') }}">
<link rel="stylesheet" href="{{ asset('css/nivo_themes/default/default.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<!-- google web font css --><link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('web-fonts/Helvetica/styles.css') }}">
<link rel="stylesheet" href="{{ asset('web-fonts/BradleyHandITC/styles.css') }}">
<link rel="stylesheet" href="{{ asset('web-fonts/Krungthep/stylesheet.css') }}">
<link rel="stylesheet" href="{{ asset('web-fonts/Krungthep/stylesheet.css') }}">
<link rel="stylesheet" href="{{ asset('css/message.css') }}">
</head>
<body data-spy="scroll" data-target=".navbar-collapse">

<!-- navigation -->
<header>
  <div class="top-bar">
    <div class="container">
      <div class=" col-md-7 col-sm-7 col-lg-7 phone"> <a href="#"><i class="fa fa-envelope" aria-hidden="true"></i> Suport@freelancer.com</a> <a href="#"><i class="fa fa-phone" aria-hidden="true"></i> 1234567890</a> </div>
      <div class=" col-md-2 col-sm-2 col-lg-2 text-right">
        <div class="translatore">
          <select>
            <option> <img src="{{ asset('images/flag.jpg') }}"> English
            <option>
          </select>
        </div>
      </div>
      <div class=" col-md-3 col-sm-3 col-lg-3 text-right">
        <ul class="social">
          <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
          <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
          <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
          <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
        </ul>
      </div>
    </div>
  </div>
  </div>
  @include('layouts/header_navbar')
</header>

<div class="container main-section">
  <div class="row">
    <div class="col-md-3 col-sm-3 col-xs-12 left-sidebar">
     
      <div class="left-chat">
        <ul id="append_new_list">
          <?php
          $user_id = Session::get('login_id');
          if(!empty($result))
          {
            foreach ($result as $msg) 
            {
              $count = [];
              if(!empty($msg->message))
              {
                  foreach ($msg->message as $message) 
                  {
                    if($message->message_sender_id!=$user_id && $message->receive_read==0)
                    {
                      $count[] = $message->message_content_id;
                    }
                  }
              }
              if($msg->sender_id == $user_id)
              {
                ?>
                <li>
                  <div class="chat-left-detail open_chat_vindeo" data-ng_message_id="<?php echo $msg->message_id; ?>">
                    <p class="col-md-8"><?php echo $msg->receivename; ?></p>
                    <span class="col-md-3">(<?php echo count($count); ?>) </span> </div>
                </li> 
                <?php
              }else
              {
                ?>
                <li>
                  <div class="chat-left-detail open_chat_vindeo" data-ng_message_id="<?php echo $msg->message_id; ?>">
                    <p class="col-md-8"><?php echo $msg->sendername; ?></p>
                    <span class="col-md-3">(<?php echo count($count); ?>) </span> </div>
                </li> 
                <?php                
              }
            }
          } ?>
                  
        </ul>
      </div>
    </div>
    <div class="col-md-9 col-sm-9 col-xs-12 right-sidebar">
      <?php
      $message_cont = []; 
        if(!empty($result))
        {
          $message_cont = (isset($result[0])?$result[0]:[]);
        }
       ?>
      <div class="row">
        <div class="col-md-12 right-header">
          <div class="right-header-detail">
            <?php
            if($message_cont)
            {
              if($message_cont->sender_id == $user_id)
              {
                echo '<p>'.$message_cont->receivename.'</p>';
              }else
              {
                echo '<p>'.$message_cont->sendername.'</p>';
              }
            }
             ?>            
             </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 right-header-contentChat">
          <ul id="append_message_box">
            <?php
            if(!empty($message_cont->message))
            {
              foreach ($message_cont->message as $chtMsg) 
              {
                if($chtMsg->message_sender_id!=$user_id)
                { 
                  $cls = 'rightside-left-chat';
                }else
                {
                  $cls = 'rightside-right-chat';
                }
                 ?>
                  <li>
                    <div class="<?php echo $cls; ?>"> 
                      <span><i class="fa fa-circle" aria-hidden="true"></i> <?php echo $chtMsg->name; ?> <small><?php echo date('M d,Y',strtotime($chtMsg->message_created)) ?> <?php echo date('h:i A',strtotime($chtMsg->message_time)) ?></small> </span>
                      <br>
                      <br>
                      <p><?php echo $chtMsg->message_content ?></p>
                    </div>
                  </li>
                  <?php 
                } 
              }else {
              ?>
                 <li>
                  <div class="rightside-left-chat">
                    <br>
                    <p>Not Any Message found in this chat</p>
                  </div>
                </li>
              <?php
            } ?>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 right-chat-textbox">
          <textarea id="message_box" class="form-control"></textarea>
          <a class="send_message" data-ng_message_id="<?php echo (!empty($message_cont)?$message_cont->message_id:0)?>"><i class="fa fa-arrow-right" aria-hidden="true"></i></a> </div>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-1 col-sm-1"></div>
    <div class="col-md-10 col-sm-10">
      <hr>
    </div>
    <div class="col-md-1 col-sm-1"></div>
  </div>
</div>
<footer>
  <div class="container">
       
    <div class="row">
      <div class="container">
        <div class="col-md-8 col-sm-8 lg-8 translatored">
          <div class="translatore Footer-localeSelector-btn"> English </div>
        </div>
        <div class="col-md-4 col-sm-4 lg-4 text-right">
          <ul class="social">
            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="container">
        <ul class="last-contry">
          <li><a href="#">South Arabia</a></li>
        </ul>
      </div>
    </div>
  </div>
</footer>

<a href="#top" class="go-top"><i class="fa fa-angle-up"></i></a> 

<!-- javascript js --> 
<script src="{{ asset('js/jquery.js') }}"></script> 
<script src="{{ asset('js/bootstrap.min.js') }}"></script> 
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ asset('js/message.js') }}"></script> 
</body>
</html>
