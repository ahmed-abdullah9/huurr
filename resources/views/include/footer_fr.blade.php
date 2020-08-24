<!-- footer content -->

<footer style="z-index: 10;">
  <div class="copyright-info">
    <!--<p class="pull-right"><a href="https://huurr.com">Huurr</a> </p> -->
  </div>
  <div class="clearfix"></div>
</footer>
<!-- /footer content --> 

<!-- Start Calender modal -->
<div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">{{ __('freelancer.NewCalenderEntry') }}</h4>
      </div>
      <div class="modal-body">
        <div id="testmodal" style="padding: 5px 20px;">
          <form id="antoform" class="form-horizontal calender" role="form">
            <div class="form-group">
              <label class="col-sm-3 control-label">{{ __('freelancer.Title') }}</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="title" name="title">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">{{ __('freelancer.Description') }}</label>
              <div class="col-sm-9">
                <textarea class="form-control" style="height:55px;" id="descr" name="descr"></textarea>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default antoclose" data-dismiss="modal">{{ __('freelancer.Close') }}</button>
        <button type="button" class="btn btn-primary antosubmit">{{ __('freelancer.SaveChanges') }}</button>
      </div>
    </div>
  </div>
</div>
<div id="CalenderModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel2">{{ __('freelancer.EditCalenderEntry') }}</h4>
      </div>
      <div class="modal-body">
        <div id="testmodal2" style="padding: 5px 20px;">
          <form id="antoform2" class="form-horizontal calender" role="form">
            <div class="form-group">
              <label class="col-sm-3 control-label">{{ __('freelancer.Title') }}</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="title2" name="title">
              </div>
            </div>
            <input type="hidden" name="id" id="calendar_event_id" value="0">
            <div class="form-group">
              <label class="col-sm-3 control-label">{{ __('freelancer.Description') }}</label>
              <div class="col-sm-9">
                <textarea class="form-control" style="height:55px;" id="edit_descr" name="description"></textarea>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="delete-calendar-event" class="btn btn-primary btn-danger">{{ __('freelancer.Delete') }}</button>
        <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">{{ __('freelancer.Close') }}</button>

        <button type="button" class="btn btn-primary antosubmit2">{{ __('freelancer.SaveChanges') }}</button>

      </div>
    </div>
  </div>
</div>
<div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew"></div>
<div id="fc_edit" data-toggle="modal" data-target="#CalenderModalEdit"></div>
<input type="hidden" value="0" name="calender_counter_stop_repeats" id="calender_counter_stop_repeats">

<!-- End Calender modal --> 
<!-- /page content -->
</div>
</div>
<div id="custom_notifications" class="custom-notifications dsp_none">
  <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
  </ul>
  <div class="clearfix"></div>
  <div id="notif-group" class="tabbed_notifications"></div>
</div>

<script src="<?php echo asset('/fr_assets/'); ?>/js/bootstrap.min.js"></script>
<script src="<?php echo asset('/fr_assets/'); ?>/js/nprogress.js"></script>

<!-- bootstrap progress js --> 
<script src="<?php echo asset('/fr_assets/'); ?>/js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="<?php echo asset('/fr_assets/'); ?>/js/nicescroll/jquery.nicescroll.min.js"></script>
<!-- icheck --> 
<!-- icheck --> 

<script src="<?php echo asset('/cl_assets') ?>/js/icheck/icheck.min.js"></script>

@if(LaravelLocalization::getCurrentLocaleDirection() == 'ltr')

  <script src="<?php echo asset('/cl_assets') ?>/js/custom.js"></script>

@else

  <script src="<?php echo asset('/cl_assets') ?>/js/custom_rtl.js"></script>

@endif

<script src="<?php echo asset('/fr_assets/'); ?>/js/moment/moment.min.js"></script>
<script src="<?php echo asset('/fr_assets/'); ?>/js/calendar/fullcalendar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.1/lang/ar.js"></script>
<!-- pace --> 
<script src="<?php echo asset('/cl_assets/'); ?>/js/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo asset('/cl_assets/'); ?>/js/datatables/dataTables.bootstrap.js"></script>
<script src="<?php echo asset('/cl_assets/'); ?>/js/datatables/dataTables.buttons.min.js"></script>
<script src="<?php echo asset('/cl_assets/'); ?>/js/datatables/buttons.bootstrap.min.js"></script>
<script src="<?php echo asset('/cl_assets/'); ?>/js/datatables/jszip.min.js"></script>
<script src="<?php echo asset('/cl_assets/'); ?>/js/datatables/pdfmake.min.js"></script>
<script src="<?php echo asset('/cl_assets/'); ?>/js/datatables/vfs_fonts.js"></script>
<script src="<?php echo asset('/cl_assets/'); ?>/js/datatables/buttons.html5.min.js"></script>
<script src="<?php echo asset('/fr_assets/'); ?>/js/datatables/buttons.print.min.js"></script>
<script src="<?php echo asset('/fr_assets/'); ?>/js/datatables/dataTables.fixedHeader.min.js"></script>
<script src="<?php echo asset('/fr_assets/'); ?>/js/datatables/dataTables.keyTable.min.js"></script>
<script src="<?php echo asset('/cl_assets/'); ?>/js/datatables/dataTables.responsive.min.js"></script>
<script src="<?php echo asset('/fr_assets/'); ?>/js/datatables/responsive.bootstrap.min.js"></script>
<script src="<?php echo asset('/fr_assets/'); ?>/js/datatables/dataTables.scroller.min.js"></script>
<script src="<?php echo asset('/fr_assets/'); ?>/js/pace/pace.min.js"></script>
<script src="{{ asset('js/nivo-lightbox.min.js') }}"></script> 

<script src="{{ asset('js/script.js') }}"></script> 
<script src="{{ asset('js/custom.js') }}"></script> 

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(window).load(function() {
    var languag = '<?php echo app()->getLocale(); ?>';
      var date = new Date();
      var d = date.getDate();
      var m = date.getMonth();
      var y = date.getFullYear();
      var started;
      var categoryClass;

      var calendar = $('#calendar').fullCalendar({
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,agendaWeek,agendaDay'
        },
        selectable: true,
        selectHelper: true,
          lang: languag,
        select: function(start, end, allDay) {
          $('#fc_create').click();
            var started  = $.fullCalendar.moment(start).stripTime().format();
            var ended    = $.fullCalendar.moment(end).stripTime().format();

          $(".antosubmit").on("click", function() {
            var title = $("#title").val();
            var descr = $("#descr").val();

            categoryClass = $("#event_type").val();

            if (title) {
              calendar.fullCalendar('renderEvent', {
                  title: title,
                  start: started,
                  end: end,
                 // event_id:event_id,
                  allDay: allDay
                },
                true // make the event "stick"
              );
                var params = "title="+title+"&started="+started+"&ended="+ended+"&description="+descr;
                $.post("<?php echo url('add/calender'); ?>",params, function(data, status){
                    $('#title').val('');
                    $('#descr').val('');
                    location.reload();
                });
            }

          });
        },
        eventClick: function(calEvent, jsEvent, view) {
            var event_id = calEvent.event_id;
          $('#fc_edit').click();
          $('#title2').val(calEvent.title);
            $('#edit_descr').val(calEvent.description);
            $('#calendar_event_id').val(event_id);
          categoryClass = $("#event_type").val();

          $(".antosubmit2").on("click", function() {
           // calEvent.title = $("#title2").val();
              //calendar.fullCalendar('updateEvent', calEvent);
              $('.antoclose2').click();
            var post_data = "id="+calEvent.event_id+"&title="+calEvent.title;
              $.post("<?php echo url('update/calender'); ?>",$("#antoform2").serialize(), function(data, status){
                  location.reload();
              });

          });

          $("#delete-calendar-event").on("click", function() {
              $('.antoclose2').click();
              calEvent.title ='';
              var post_data = "id="+event_id;
              $.post("<?php echo url('delete/calender'); ?>",post_data, function(data, status){
                  location.reload();
              });

          });

          calendar.fullCalendar('unselect');
        },
        editable: true,
        events: [<?php if (!empty($events)) { foreach ($events as $event) {
          ?>
          {
          title: '<?php echo $event->title; ?>',
          start: '<?php echo $event->start_date; ?>',
          end: '<?php echo $event->end_date; ?>',
          event_id:'<?php echo $event->id; ?>',
          description:'<?php echo $event->description; ?>'
        },
          <?php
        }} else {
          ?>
          {
          title: 'All Day Event',
          start: new Date(y, m, 1)
        },
          <?php
        } ?>]
      });
    });
  </script>
  <script>
          var handleDataTableButtons = function() {
              "use strict";
              var url='';
              if(Lang=='en'){
                  url="//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json";
              }
              else{
                  url="//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json";
              }
              0 !== $("#datatable-buttons").length && $("#datatable-buttons").DataTable({
                      "language": {
                          "url":url,
                      },
                dom: "Bfrtip",
                buttons: [{
                  extend: "copy",
                  className: "btn-sm btn-color btn-round"
                }, {
                  extend: "csv",
                  className: "btn-sm btn-color btn-round"
                }, {
                  extend: "excel",
                  className: "btn-sm btn-color btn-round"
                }, {
                  extend: "pdf",
                  className: "btn-sm btn-color btn-round"
                }, {
                  extend: "print",
                  className: "btn-sm btn-color btn-round"
                }],
                responsive: !0,
              })
            },
            TableManageButtons = function() {
              "use strict";
              return {
                init: function() {
                  handleDataTableButtons()
                }
              }
            }();
        </script>
        <script type="text/javascript">
          $(document).ready(function() {
              var url='';
              if(Lang=='en'){
                  url="//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json";
              }
              else{
                  url="//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json";
              }
            $('#datatable').dataTable();
            $('#datatable-keytable').DataTable({
              keys: true
            });
            $('#datatable-responsive').DataTable({"bSort": false,
                "language": {
                    "url":url,
                },



            });
            $('#datatable-scroller').DataTable({
              ajax: "js/datatables/json/scroller-demo.json",
              deferRender: true,
              scrollY: 380,
              scrollCollapse: true,
              scroller: true,
              "bSort": false
            });
            var table = $('#datatable-fixed-header').DataTable({
              fixedHeader: true,
              "bSort": false
            });


              $(document).ready(function () {
                  $("#submit_form_button").click(function(e){
                      e.preventDefault();
                  })

                  $('#is_online_offline').change(function () {
                      if ($('#is_online_offline').is(":checked"))
                      {
                          var is_online = "is_online=1"
                          $(".profile_img").addClass('online');
                      }
                      else
                      {
                          var is_online = "is_online=0"
                          $(".profile_img").removeClass('online');
                      }
                      $.post("<?php echo url('update/online_status'); ?>",is_online,function(){

                      },'json');
                  });


              });
          });
          TableManageButtons.init();
        </script>
        
<style>
    .navbar-fixed-top
    {
        position:static!important;
        
    }
    
</style>
        
</body></html>