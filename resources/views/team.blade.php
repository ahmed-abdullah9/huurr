@include( 'include/header' )
<style>

    span{
        font-size:15px;
    }
    a{
        text-decoration:none;
    }
    .box{
        padding:60px 0px;
    }

    .box-part{
        background:#FFF;
        border-radius:0;
        cursor: pointer;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,.16);
    }
    .text{
        margin:20px 0px;
    }
    .card-img{
        width: 100%;clip-path: polygon(0 0,100% 0,100% 100%,10px 100%,0 calc(100% - 16px));

    }
    .box-part:hover{
        /*border: solid 1px #CCC;*/
        -moz-box-shadow: 0 0 10px #ccc;
        -webkit-box-shadow: 0 0 10px #ccc;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,.16);
    }
    .linkin-btn{
        height: 60px;
        width: 60px;
        display: block;
        border: 1px solid blue;
        border-radius: 50%;
        text-align: center;
        padding-top:5px ;
    }
    .linkin-btn-text{
        font-size: 26px;
        font-weight: bolder;
        color: blue;
    }
    .linkin-btn-text:hover{
        color: white;
    }
    .linkin-btn:hover{
        background: blue;
    }
    /*.my-hover:hover{*/
        /*border: solid 1px #CCC;*/
        /*-moz-box-shadow: 1px 1px 5px #999;*/
        /*-webkit-box-shadow: 1px 1px 5px #999;*/
        /*box-shadow: 1px 1px 5px #999;*/
    /*}*/
</style>
<div style="margin-top: 100px;" class="box">
    <div class="container">
        <div class="row">
            @foreach($teams as $team)
            <div data-linkedin="{{$team->linkedin}}" style="padding:10px 30px;" @if(app()->getLocale() == 'ar' ) data-name="{{$team->ar_name}}"  @else data-name="{{$team->name}}" @endif @if(app()->getLocale() == 'ar' ) data-designation="{{$team->ar_designation}}"  @else data-designation="{{$team->designation}}" @endif  class="col-lg-4 col-md-4 col-sm-4 col-xs-12 team my-hover" data-src="{{url('/')}}/public/teamImages/{{$team->image}}"  @if(app()->getLocale() == 'ar' ) data-description="{{$team->ar_description}}"    @else data-description="{{$team->description}}" @endif>
                <div  class="box-part">
                    <img class="card-img"  src="{{asset('public/teamImages')}}/{{$team->image}}">
                <div style="padding: 10px;">
                    @if(app()->getLocale() == 'en')
                    <h2 >{{$team->name}}</h2>
                     <h4  class="text-muted">{{$team->designation}}</h4>
                    <a href="#"  style="color: blue;font-size: large;">View Bio</a>
                        @else
                        <h2 >{{$team->ar_name}}</h2>
                        <h4  class="text-muted">{{$team->ar_designation}}</h4>
                        <a href="#"  style="color: blue;font-size: large;">عرض السيرة الذاتية</a>
                    @endif
                </div>
                </div>

            </div>
            @endforeach
        </div>
    </div>
</div>
<div style="overflow: scroll !important;" id="exampleModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
<input type="hidden" id="totalIndex" readonly>
        <input type="hidden" id="currentIndex" readonly>
        <!-- Modal content-->
        <div class="modal-content">
            <div  class="modal-header">
                <button  type="button" class="dismiss_modal close" data-dismiss="modal">&times;</button>
                <div class="next_prev"><button onclick="prevTeam()" id="previous" style="padding: 5px;width: 50px;border: 1px solid grey;"><</button><button id="next" onclick="nextTeam()" style="padding: 5px;width: 50px;border: 1px solid grey;"> > </button></div>
            </div>
            <div class="modal-body">
               <div class="row">
                   <div  class="col-md-6 modal_img">
                       <img style="margin-top: 15px;" class="card-img modal-img" src="https://bs-uploads.toptal.io/blackfish-uploads/components/about_page/team_section/item/content/image_file/image/57917/bill_tsingos-293a0c5f36330bfaf47102f32d4acdac.jpg">
                   </div>
                   <div class="col-md-6">
                       <p id="name" class="modal_team_name"> Taso Du Val</p>
                       <p id="designation"  class="text-muted modal_team_name">CEO</p>
                       <p id="description">
                       As Toptal’s Chief Executive Officer, Taso manages Toptal’s core team of hundreds of team members distributed throughout the world, with a focus on innovation. Since Toptal was founded in 2010, Taso has led it to become the largest high-skilled, on-demand talent network in the world. Taso serves on the board of multiple organizations, advising on talent strategy and innovation for Fortune 100s and nonprofits. Taso has guest lectured at Harvard Business School, Wharton, and Oxford on talent management and entrepreneurship.
                       </p>
                   </div>
               </div>
            </div>
            <div class="modal-footer">
                <a target="_blank" id="linkedIn" href="#" style="@if(app()->getLocale() == 'ar') float:right; @else float: left; @endif" class="linkin-btn"><span class="linkin-btn-text">in</span></a>
            </div>
        </div>

    </div>
</div>
<script>
    function prevTeam(){
        var nextIndex=parseInt($("#currentIndex").val())-1;
        if(nextIndex>=0){
            $("#currentIndex").val(nextIndex);
            var element=$('.team').get(nextIndex);
            var description=element.getAttribute('data-description');
            var img=element.getAttribute('data-src');
            var name=element.getAttribute('data-name');
            var designation=element.getAttribute('data-designation');
            var linked=element.getAttribute('data-linkedin');
            $("#name").html(name);
            $("#designation").html(designation);
            $("#description").html(description);
            $(".modal-img").attr('src',img);
            $("#linkedIn").attr('href',linked);
        }
    }
    function nextTeam(){
            var nextIndex=parseInt($("#currentIndex").val())+1;
            if(nextIndex<=$("#totalIndex").val()){
                $("#currentIndex").val(nextIndex);
                var element=$('.team').get(nextIndex);
                var description=element.getAttribute('data-description');
                var img=element.getAttribute('data-src');
                var name=element.getAttribute('data-name');
                var designation=element.getAttribute('data-designation');
                var linked=element.getAttribute('data-linkedin');
                $("#name").html(name);
                $("#designation").html(designation);
                $("#description").html(description);
                $(".modal-img").attr('src',img);
                $("#linkedIn").attr('href',linked);
            }
    }
    $(document).ready(function(){
        var total = $('.row .col-lg-4').length-1;
            $("#totalIndex").val(total);
        $('.team').click(function(e){
            var currentIndex=($(this).index());
            $("#currentIndex").val(currentIndex);
            $("#exampleModal").modal("hide");
            var description=$(this).attr("data-description");
            var img=$(this).attr("data-src");
            var name=$(this).attr("data-name");
            var designation=$(this).attr("data-designation");
            var linked=$(this).attr("data-linkedin");
            $("#description").html('');
            $("#name").html('');
            $("#designation").html('');
            $("#name").html(name);
            $("#designation").html(designation);
            $("#description").html(description);
            $(".modal-img").attr('src',img);
            $("#linkedIn").attr('href',linked);
            $("#exampleModal").modal("show");
            //console.log($(this).attr("data-index"));
        })
    })
</script>
@include ('include/footer')