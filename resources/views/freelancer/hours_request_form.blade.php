@include('include.header_fr')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
<div class="container">
    <div class="row">
        <div style="margin-top: 20px;" class="col-md-offset-1 col-md-11">
            <h2 style="padding-bottom: 30px;" class="main-form-title">Hours Request to Client</h2>
                <form  method="post" action="{{url('/fr_request/hours/post')}}">

                    <div style="width: 300px;" class='input-group date' id='datetimepicker1'>
                        <label for="from" class="form-label-color">From:</label>
                        <input name="from" type='text' id="from" class="form-control" />
                        <span class="input-group-addon">
                        <span  class="glyphicon glyphicon-calendar"></span>
                   </span>
                    </div>
                    <div style="width: 300px;" class='input-group date' id='datetimepicker2'>
                        <label for="to" class="form-label-color">To:</label>
                        <input name="to"  type='text' id="to" class="form-control" />
                        <span class="input-group-addon">
                        <span  class="glyphicon glyphicon-calendar"></span>
                   </span>
                    </div>
                    <input type="hidden" name="job_id" value="{{$job_id}}">

                    <div style="width: 300px;">
                        <label for="hours" class="form-label-color">Hours:</label>
                        <input  type='text' id="hours" name="hours" class="form-control" required readonly/>
                    </div>
                    <input  style="margin-top: 20px;" class="btn btn-round btn-color" type="submit" value="Submit">
                </form>
            <script type="text/javascript">
                $(function() {
                    var from=$('#datetimepicker1').datetimepicker();
                    var to=$('#datetimepicker2').datetimepicker();
                });

                $("form").click(function(){
                    var from=$('#from').val();
                    var to=$('#to').val();
                    var diff=0;
                    var timeStart = new Date(from);
                    var timeEnd = new Date(to);
                    var hours=0;
                    hours =  two_date_diff_check(timeStart,timeEnd,'hours');
                    if(hours!='NaN'){
                        $('#hours').val(hours);
                    }
                });
            </script>
        </div>
    </div>
</div>

@include('include.footer_fr')