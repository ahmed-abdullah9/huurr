
    <!-- footer content -->
    <footer>
      <div class="copyright-info">
        <p class="center"><a href="https://huurr.com">Huurr</a> </p>
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
            <h4 class="modal-title" id="myModalLabel">New Calender Entry</h4>
          </div>
          <div class="modal-body">
            <div id="testmodal" style="padding: 5px 20px;">
              <form id="antoform" class="form-horizontal calender" role="form">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Title</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="title" name="title">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Description</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" style="height:55px;" id="descr" name="descr"></textarea>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary antosubmit">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    <div id="CalenderModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel2">Edit Calender Entry</h4>
          </div>
          <div class="modal-body">
            <div id="testmodal2" style="padding: 5px 20px;">
              <form id="antoform2" class="form-horizontal calender" role="form">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Title</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="title2" name="title2">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Description</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" style="height:55px;" id="descr2" name="descr"></textarea>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary antosubmit2">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    <div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew"></div>
    <div id="fc_edit" data-toggle="modal" data-target="#CalenderModalEdit"></div>
    
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



<script src="<?php echo asset('/cl_assets') ?>/js/bootstrap.min.js"></script> 

<script src="<?php echo asset('/cl_assets') ?>/js/nprogress.js"></script> 



<!-- bootstrap progress js --> 

<script src="<?php echo asset('/cl_assets') ?>/js/progressbar/bootstrap-progressbar.min.js"></script> 

<script src="<?php echo asset('/cl_assets') ?>/js/nicescroll/jquery.nicescroll.min.js"></script> 

<!-- icheck --> 

<script src="<?php echo asset('/cl_assets') ?>/js/icheck/icheck.min.js"></script>

@if(LaravelLocalization::getCurrentLocaleDirection() == 'ltr')

  <script src="<?php echo asset('/cl_assets') ?>/js/custom.js"></script>

@else

  <script src="<?php echo asset('/cl_assets') ?>/js/custom_rtl.js"></script>

@endif





<script src="<?php echo asset('/cl_assets') ?>/js/calendar/fullcalendar.min.js"></script> 

<!-- pace --> 

<script src="<?php echo asset('/cl_assets') ?>/js/pace/pace.min.js"></script> 



<script src="<?php echo asset('/cl_assets') ?>/js/datatables/jquery.dataTables.min.js"></script>

<script src="<?php echo asset('/cl_assets') ?>/js/datatables/dataTables.bootstrap.js"></script>

<script src="<?php echo asset('/cl_assets') ?>/js/datatables/dataTables.buttons.min.js"></script>

<script src="<?php echo asset('/cl_assets') ?>/js/datatables/buttons.bootstrap.min.js"></script>

<script src="<?php echo asset('/cl_assets') ?>/js/datatables/jszip.min.js"></script>

<script src="<?php echo asset('/cl_assets') ?>/js/datatables/pdfmake.min.js"></script>

<script src="<?php echo asset('/cl_assets') ?>/js/datatables/vfs_fonts.js"></script>

<script src="<?php echo asset('/cl_assets') ?>/js/datatables/buttons.html5.min.js"></script>

<script src="<?php echo asset('/cl_assets') ?>/js/datatables/buttons.print.min.js"></script>

<script src="<?php echo asset('/cl_assets') ?>/js/datatables/dataTables.fixedHeader.min.js"></script>

<script src="<?php echo asset('/cl_assets') ?>/js/datatables/dataTables.keyTable.min.js"></script>

<script src="<?php echo asset('/cl_assets') ?>/js/datatables/dataTables.responsive.min.js"></script>

<script src="<?php echo asset('/cl_assets') ?>/js/datatables/responsive.bootstrap.min.js"></script>

<script src="<?php echo asset('/cl_assets') ?>/js/datatables/dataTables.scroller.min.js"></script>



<script src="{{ asset('js/script.js') }}"></script>

<script src="{{ asset('js/custom.js') }}"></script>



<script>

    $(window).load(function() {



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

        select: function(start, end, allDay) {

          $('#fc_create').click();



          started = start;

          ended = end



          $(".antosubmit").on("click", function() {

            var title = $("#title").val();

            if (end) {

              ended = end

            }

            categoryClass = $("#event_type").val();



            if (title) {

              calendar.fullCalendar('renderEvent', {

                  title: title,

                  start: started,

                  end: end,

                  allDay: allDay

                },

                true // make the event "stick"

              );

            }

            $('#title').val('');

            calendar.fullCalendar('unselect');



            $('.antoclose').click();



            return false;

          });

        },

        eventClick: function(calEvent, jsEvent, view) {

          //alert(calEvent.title, jsEvent, view);



          $('#fc_edit').click();

          $('#title2').val(calEvent.title);

          categoryClass = $("#event_type").val();



          $(".antosubmit2").on("click", function() {

            calEvent.title = $("#title2").val();



            calendar.fullCalendar('updateEvent', calEvent);

            $('.antoclose2').click();

          });

          calendar.fullCalendar('unselect');

        },

        editable: true,

        events: [{

          title: 'All Day Event',

          start: new Date(y, m, 1)

        }, {

          title: 'Long Event',

          start: new Date(y, m, d - 5),

          end: new Date(y, m, d - 2)

        }, {

          title: 'Meeting',

          start: new Date(y, m, d, 10, 30),

          allDay: false

        }, {

          title: 'Lunch',

          start: new Date(y, m, d + 14, 12, 0),

          end: new Date(y, m, d, 14, 0),

          allDay: false

        }, {

          title: 'Birthday Party',

          start: new Date(y, m, d + 1, 19, 0),

          end: new Date(y, m, d + 1, 22, 30),

          allDay: false

        }, {

          title: 'Click for Google',

          start: new Date(y, m, 28),

          end: new Date(y, m, 29),

          url: 'http://google.com/'

        }]

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
                "paging": false,
                dom: "Bfrtip",
                  "language": {
                      "url":url,
                  },
                buttons: [{

                  extend: "copy",

                  className: "btn-sm"

                }, {

                  extend: "csv",

                  className: "btn-sm"

                }, {

                  extend: "excel",

                  className: "btn-sm"

                }, {

                  extend: "pdf",

                  className: "btn-sm"

                }, {

                  extend: "print",

                  className: "btn-sm"

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

            $('#datatable').dataTable({
                "language": {
                    "url":url,
                }
            });

            $('#datatable-keytable').DataTable({

              keys: true,
                "language": {
                    "url":url,
                }

            });

            $('#datatable-responsive').DataTable({

    "bSort": false,
                "language": {
                    "url":url,
                }

  });

            $('#datatable-scroller').DataTable({

              ajax: "js/datatables/json/scroller-demo.json",

              deferRender: true,

              scrollY: 380,

              scrollCollapse: true,

              scroller: true,

              "bSort": false,
                "language": {
                    "url":url,
                }

            });

            var table = $('#datatable-fixed-header').DataTable({

              fixedHeader: true,

              "bSort": false,
                "language": {
                    "url":url,
                }

            });

          });

          TableManageButtons.init();

        </script>

</body>

</html>

