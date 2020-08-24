@include ('include/header_admin')
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2 style="display: inline;">{{__('client.post_job')}} </h2>
            @if(Session::has('info'))
                <div style="display: inline;float: right;" class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ Session::get('info') }}
                </div>
            @elseif(Session::has('message'))
                <div style="display: inline;float: right;" class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form id="filterdata">
            <div style="margin: 20px;" class="row">
                <div class="col-md-2"><select style="height: 30px;" name="limit">
                        <option value="">
                            select limit
                        </option>
                        <option value="10">
                            10
                        </option>
                        <option value="20">
                            20
                        </option>
                        <option value="30">
                            30
                        </option>
                        <option value="50">
                            50
                        </option>
                        <option value="100">
                            100
                        </option>
                    </select></div>
                <div class="col-md-3">
                    {{--<div style="cursor: pointer;" class='input-group date' id='datetimepicker1'>--}}
                        {{--<input  type='text' class="form-control" />--}}
                        {{--<span class="input-group-addon">--}}
                        {{--<span class="glyphicon glyphicon-calendar"></span>--}}
                    {{--</span>--}}
                    {{--</div>--}}
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-3"><label for="search">search:</label><input id="search" name="search" type="text"></div>
            </div>
            </form>
            <script type="text/javascript">
                $(function () {
                    $('#datetimepicker1').datetimepicker();
                });
            </script>
            <section id="myTable">
            @include('admin.tables.job_listing')
            </section>
        </div>
    </div>
</div>
<script type="text/javascript">

    $(function() {
        $('body').on('click', '.pagination a', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $(".pagination li").removeClass('active');
            $(this).parent().addClass('active');
            getArticles(url);
            window.history.pushState("", "", url);
        });

        function getArticles(url){
            $.ajax({
                url : url
            }).done(function (data) {
                $('#myTable').html(data);
            }).fail(function () {
                alert('could not be loaded.');
            });
        }
        $("#filterdata").on("change", function() {
            var url = $(this).attr('href');
            $.ajax({
                url:url,
                type:"POST",
                data:$("#filterdata").serialize(),

            }).done(function (data) {
                $('#myTable').html(data);
            }).fail(function () {
                console.log('Articles could not be loaded.');
            });
        });
        $("#filterdata").on("keyup", function() {
            var url = $(this).attr('href');
            $.ajax({
                url:url,
                type:"POST",
                data:$("#filterdata").serialize(),

            }).done(function (data) {
                $('#myTable').html(data);
            }).fail(function () {
                console.log('Articles could not be loaded.');
            });
        });
    });
</script>

@include ('include/footer_admin')
