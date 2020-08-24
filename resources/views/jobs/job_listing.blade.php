@include ('include/header_cl')

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel" id="response">
     @if(sizeof($jobs)>0)
     @include('jobs.table.job_listing')
     @endif
    </div>
  </div>
<script>
$(document).ready(function()
{
//    var url ="<?php echo url('joblist')?>";
//             $.ajax({
//                 url:url,
//             }).done(function (data) {
//               // data = JSON.parse(data);
//               $('#response').html(data);
//             }).fail(function () {
//                 console.log('Articles could not be loaded.');
//             });

            $(document).on('click', '.pagination a', function(e) {
             e.preventDefault(); 
            if($('.pagination').hasClass('jobs')){
              $(".freelancer.pagination li").removeClass('active');
            }
            // else if($('.pagination').hasClass('hire_freelancer')){
            //   $(".hire_freelancer .pagination li").removeClass('active');
            // }
            // else if($('.pagination').hasClass('saved_freelancer')){
            //   $(". saved_freelancer.pagination li").removeClass('active');
            // }
           
            var url = $(this).attr('href');
        
            $(this).parent().addClass('active');
            // var search=$("#search").val();
            // url=url+"&find="+search;
            getData(url);
            
            window.history.pushState("", "", url);
        });
        function getData(url){
            $.ajax({
                url :url,
                type:"POST",
                data:$("#filterdata").serialize(),
            }).done(function (data) {
                $('#response').html(data);
             
            }).fail(function () {
                console.log('could not be loaded.');
            });
        }

})
</script>
@include ('include/footer_cl')
