@include ('include/header_admin')


<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>{{ __('admin.Freelancer') }}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form id="filterdata" class="form-inline">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <select name="sub_category" class="form-control">
                            <option value="">Search by SubCategory:</option>
                            @foreach($subCategories as $sub)
                            <option value="{{$sub->id}}">{{$sub->freelancer_skill}}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <select name="status" class="form-control">
                            <option value="">Search by Status:</option>
                              <option value="1">Verfied</option>
                            <option value="2">UnVerfied</option>
                            <option value="3">Approved</option>
                            <option value="4">Suspended</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-sm-4">
                        <div class="form-group">
                            <input type="text" class="form-control" name="search" id="search" placeholder="search....">
                            <label for="search">Search:</label>
                        </div>

                </div>
            </div>

                    <div style="margin-top: 10px;" class="form-group">
                        <select name="export" class="form-control">
                            <option value="">Export:</option>
                            <option value="csv">CSV</option>
                        </select>
                    </div>
            </form>

            <script>
                $(document).ready(function(){
                    $("#filterdata").on("click", function() {
                        var url = $(this).attr('href');
                        $.ajax({
                            url:url,
                            type:"POST",
                            data:$("#filterdata").serialize(),

                        }).done(function (data) {
                            $('.articles').html(data);
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
                           $('.articles').html(data);
                       }).fail(function () {
                           console.log('Articles could not be loaded.');
                       });
                    });
                });
            </script>
            <br/>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <br>

                @if(Session::has('message')==="Freelancer is Aproved Successfully")
                    <h5 class="message" align="center" style="color:#933f3f;">{{ __('admin.aprove_freelancer') }}</h5>
                @elseif(Session::has('message')==="Freelancer is Reject Successfully")
                    <h5 class="message" align="center" style="color:#933f3f;">Freelancer is Rejected Successfully</h5>

                @endif

                @if (count($freelancer) > 0)
                <section class="articles">
                    @include('admin.test')

                </section>
                @endif

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
                $('.articles').html(data);
            }).fail(function () {
                alert('could not be loaded.');
            });
        }
    });
</script>

@include ('include/footer_admin')
