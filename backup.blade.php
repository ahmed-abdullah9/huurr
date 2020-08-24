@include ('include/header_cl')
<link rel="stylesheet" href="{{ asset('css/message.css') }}">
<script>
    var Base_URL='<?php echo Illuminate\Support\Facades\URL::to('/'); ?>';
</script>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3> Inbox Design <small> Some examples to get you started </small> </h3>
        </div>
        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
            <button class="btn btn-default" type="button">Go!</button>
            </span> </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> Inbox Design<small>User Mail</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a href="#"><i class="fa fa-chevron-up"></i></a> </li>
                        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a> </li>
                                <li><a href="#">Settings 2</a> </li>
                            </ul>
                        </li>
                        <li><a href="#"><i class="fa fa-close"></i></a> </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-3 mail_list_column append_new_list">
                            <?php

                            $user_id = Session::get('login_id');
                            if(!empty($result))
                            {
                            foreach ($result as $msg)
                            {
                            $count = [];
                            $last_message = '';
                            if(!empty($msg->message))
                            {
                                foreach ($msg->message as $message)
                                {
                                    $last_message = $message->message_content;
                                    if($message->message_sender_id!=$user_id && $message->receive_read==0)
                                    {
                                        $count[] = $message->message_content_id;

                                    }
                                }
                            }
                            if($msg->sender_id == $user_id)
                            {
                            ?>
                            <div class="mail_list open_chat_vindeo" data-ng_message_id="<?php echo $msg->message_id; ?>">
                                <div class="left"> <i class="fa fa-circle"></i> <i class="fa fa-edit"></i> </div>
                                <div class="right">
                                    <h3><?php echo $msg->receivename; ?> (<?php echo count($count); ?>) <small>3.00 PM</small></h3>
                                    <p><?php echo $last_message ?></p>
                                </div>
                            </div>
                            <?php
                            }else
                            {
                            ?>
                            <div class="mail_list open_chat_vindeo" data-ng_message_id="<?php echo $msg->message_id; ?>">
                                <div class="left"> <i class="fa fa-circle"></i> <i class="fa fa-edit"></i> </div>
                                <div class="right">
                                    <h3><?php echo $msg->sendername; ?> (<?php echo count($count); ?>) <small>3.00 PM</small></h3>
                                    <p><?php echo $last_message ?></p>
                                </div>
                            </div>
                            <?php
                            }
                            }
                            } ?>

                        </div>
                        <!-- /MAIL LIST -->

                        <!-- CONTENT MAIL -->
                        <div class="col-sm-9 mail_view">
                            <div class="inbox-body">
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
                        <!-- /CONTENT MAIL -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include ('include/footer_cl')
<script src="{{ asset('js/message.js') }}"></script>
