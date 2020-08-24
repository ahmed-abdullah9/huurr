<!--<h3 style="color: #666666;padding: 16px !important;" class="skills__d" data-toggle="modal" data-target="#Porfolio">{{ __('freelancer.Portfolio') }} <a href="javascript:;"><i style="color: #666666;" class="fa fa-plus edite" aria-hidden="true"></i></a>-->
<!--  </h3>-->
<h3 style="color: #666666;padding: 16px !important;" class="skills__d" data-toggle="modal" data-target="#Porfolio">Portfolio <a href="javascript:;"><i style="color: #666666;" class="fa fa-plus edite" aria-hidden="true"></i></a>
</h3>

<?php 

//dd($all_portfolio);

if(!empty($all_portfolio))
{
foreach($all_portfolio as $portfolio)
{

?>
<div  class="col-md-6 col-sm-6 col-lg-6 left-pad portfolio-image"  data-toggle="modal" data-target="#Porfolio_<?php echo $portfolio->portfolio_id?>">
   <div class="col-md-6">
@if(!empty($portfolio->thumb_image))
<figure>
    @if(!empty(strpos($portfolio->thumb_image,"pdf")))
        <a target="_blank" href="{{url('/')}}/{{$portfolio->thumb_image}}">
            Click Me
        </a>
    @else
    <img src="{{ asset('/')}}/{{$portfolio->thumb_image }}" style="width:80px;height:80px;display: block;">
    @endif
<figcaption> <h3><?php echo $portfolio->project_title; ?></h3></figcaption>
</figure>
   @endif
   </div>
</div>
<form method="POST" action="{{ url('/portfolio/update') }}/{{ $portfolio->portfolio_id }}" enctype="multipart/form-data">
  {{ csrf_field() }}
<div class="modal fade" id="Porfolio_<?php echo $portfolio->portfolio_id?>" role="dialog" style="    z-index: 9999999;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 style="color: #666666;" class="modal-title">{{ __('freelancer.AddProject') }}</h4>
        </div>

        <div style="float:left;width:100%;" class="modal-body">
            <div style="float:left;width:100%;"  class="forms"> 
                <div class="col-lg-6 col-md-6 col-sm-6">
                  <input type="hidden" name="portfolio_id" value="<?php echo $portfolio->portfolio_id; ?>">
                  <div class="form-group row">
                      <label for="inputEmail" class="col-md-5 col-form-label form-label-color">{{ __('freelancer.ProjectTitle') }}</label>
                      <div class="col-md-7">
                          <input class="form-control all_inputs" type="text" name="project_title" value="<?php echo $portfolio->project_title; ?>" value="" required="">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="inputEmail" class="col-md-5 col-form-label form-label-color">{{ __('freelancer.ProjectOverview') }}</label>
                      <div class="col-md-7">
                          <textarea  class="form-control all_inputs" name="project_overview" required><?php echo $portfolio->project_overview; ?></textarea>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="inputEmail" class="col-md-5 col-form-label form-label-color">{{ __('freelancer.ThumbnailImage') }}</label>
                      <div class="col-md-7">
                          <input name="thumb_image" class="attchmentd_prt" onchange="loadFile(event)" data-img_id="image_preview_<?php echo $portfolio->portfolio_id ?>" type="file" value="">
                          <img id="image_preview_<?php echo $portfolio->portfolio_id ?>" src="{{ asset('/')}}/{{$portfolio->thumb_image }}" style="width: 150px !important;height;15Opx !important" alt="your image" />
                      </div>
                  </div>
                  <!--<script>-->
                  <!--  $(document).ready(function(){-->
                  <!--      $('#image_preview_fresh').hide();-->
                  <!--  });-->
                    
                  <!--  var loadFile = function(event) {-->
                  <!--    var output = document.getElementById('image_preview_fresh');-->
                  <!--    output.src = URL.createObjectURL(event.target.files[0]);-->
                  <!--    $('#image_preview_fresh').show();-->
                  <!--  };-->
                  <!--</script>-->
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6"> 
                
                
                  <!-- <p><label>Was this project done?</label> 
                  <select name="project_id">
                    <option value="1" <?php if($portfolio->project_id==1){ echo 'selected';} ?> > Select a contract</option>
                    <option value="2" <?php if($portfolio->project_id==2){ echo 'selected';} ?>> Select a contract</option>
                  </select>
                </p> -->
                <div class="form-group row">
                  <label for="inputEmail" class="col-md-5 col-form-label form-label-color">{{ __('freelancer.ProjectDone') }}sdfgsadfs</label>
                  <div class="col-md-7">
                      <select name="category_id" class="form-control all_inputs" required>
                        <option value="">{{ __('freelancer.Category') }}</option> 
                          @if(!empty($all_category))
                            @foreach($all_category as $category)
                              <option value="{{ $category->id }}" <?php if($portfolio->category_id==$category->id){ echo 'selected';} ?>>
                               <?php 
                               if(Lang::locale()=='en'){
                                $ctgr = $category->freelancer_skill;
                               }
                               else{
                                $ctgr = $category->ar_freelancer_skill;
                               }
                               echo $ctgr;
                               ?>
                             </option>
                            @endforeach
                          @endif
                      </select>
                  </div>
                </div>
                <!--<div class="form-group"><label>-->
                <!--  <input class="project_input" name="" type="text" placeholder="Category" disabled></label>-->
                <!--</div>-->
                
                <div class="form-group row">
                  <label for="inputEmail" class="col-md-5 col-form-label form-label-color">Project URL <span class="label_sm">(optional)</span></label>
                  <div class="col-md-7"> 
                      <input class="form-control all_inputs" name="project_url" type="text" value="<?php echo $portfolio->project_url ?>">
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="inputEmail" class="col-md-5 col-form-label form-label-color">Completion Date <span class="label_sm">(optional)</span></label>
                  <div class="col-md-7">
                      <input  name="completion_date" type="text" value="<?php echo $portfolio->completion_date ?>" class="datepicker form-control all_inputs" data-provide="datepicker">
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="inputEmail" class="col-md-5 col-form-label form-label-color">Skills <span class="label_sm">(optional)</span></label>
                  <div class="col-md-7">
                      <input class="form-control all_inputs" name="skills" type="text" value="<?php echo $portfolio->skills ?>">
                  </div>
                </div>
              </div>  
            </div> 
          </div>

        <div class="modal-footer">
            <div class="row">
              <div class="col-md-8">
                  <p style="margin-left:10px;">{{ __('freelancer.CopyrightMSG') }}</p> 
              </div>
              <div class="col-md-4">
                  <a href="" class="btn btn-default" data-dismiss="modal">{{ __('freelancer.Cancel') }}</a>
                  <button type="submit" class="btn btn-default btn-color" style="margin-top: -5px;position:relative;right:10px;">{{ __('freelancer.Update') }}</button>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</form>
<?php } } ?>


<form method="POST" action="{{ url('/profileupdate') }}/{{ $user_data->user_id }}" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="modal fade" id="Porfolio" role="dialog" style="z-index: 9999999;">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 style="color: #666666 !important;" class="modal-title main-form-title">{{ __('freelancer.AddProject') }}</h4>
</div>

<div class="modal-body">
  <div class="forms">	
  <style>
      .portolio_form label{
          margin-bottom:7px !important;
          margin-top:5px !important;
      }
      .select_option{
          padding-right: 50px !important;
          float: right;
          margin-left: -9px !important;
      }
      .modal-body label {
width: 41% !important;
}
.all_inputs{
border:1px solid;
border-radius:8px;
}
  </style>
  
  

      <div class="col-lg-6 col-md-6 col-sm-6 portolio_form"> 
          <div class="form-group row">
              <label for="inputEmail" class="col-md-5 col-form-label form-label-color">{{ __('freelancer.ProjectTitle') }}</label>
              <div class="col-md-7">
                  <input class="form-control all_inputs" type="text" name="project_title" value="" required="">
              </div>
          </div>
          <div class="form-group row">
              <label for="inputEmail" class="col-md-5 col-form-label form-label-color">{{ __('freelancer.ProjectOverview') }}</label>
              <div class="col-md-7">
                  <textarea  class="form-control all_inputs" name="project_overview" required></textarea>
              </div>
          </div>
          <div class="form-group row">
              <label for="inputEmail" class="col-md-5 col-form-label form-label-color">{{ __('freelancer.ThumbnailImage') }}</label>
              <div class="col-md-7">
                  <input name="thumb_image" class="attchmentd_prt" onchange="loadFile(event)" data-img_id="image_preview_fresh" type="file" value="">
                  <img id="image_preview_fresh" src="#" style="width: 150px !important;height;15Opx !important" alt="your image" />
              </div>
              <div class="pdf_priew">

              </div>

          </div>
  </div>
          <script>
            $(document).ready(function(){
                $('#image_preview_fresh').hide();
            });
            
            var loadFile = function(event) {
              var output = document.getElementById('image_preview_fresh');
                if (event.target.files[0].type == 'application/pdf') {
                    pdf_preview(event.target.files[0]);
                }
                else{
                    output.src = URL.createObjectURL(event.target.files[0]);
                    $('#image_preview_fresh').show();
                }
            };
          </script>
          
      <div class="col-lg-6 col-md-6 col-sm-6"> 
          <!-- <p><label>Was this project done?</label> 
                <select name="project_id">
                  <option value="1"> Select a contract</option>
                  <option value="2"> Select a contract</option>
                </select>
              </p> -->
              <div class="form-group row">
                  <label for="inputEmail" class="col-md-5 col-form-label form-label-color">{{ __('freelancer.ProjectDone') }}</label>
                  <div class="col-md-7">
                      <select name="category_id" class="form-control all_inputs" required>
                        <option value=""> {{ __('freelancer.Category') }}</option> 
                        @if(!empty($all_category))
                          @foreach($all_category as $category)
                            <option value="{{ $category->id }}"> 
                            <?php 
                               if(Lang::locale()=='en'){
                                $ctgr = $category->freelancer_skill;
                               }
                               else{
                                $ctgr = $category->ar_freelancer_skill;
                               }
                               echo $ctgr;
                               ?>
                            </option>
                          @endforeach
                        @endif
                      </select>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="inputEmail" class="col-md-5 col-form-label form-label-color">Project URL <span class="label_sm">(optional)</span></label>
                  <div class="col-md-7"> 
                      <input class="form-control all_inputs" name="project_url" type="text" value="">
                  </div>
              </div>
              <div class="form-group row">
                  <label for="inputEmail" class="col-md-5 col-form-label form-label-color">Completion Date <span class="label_sm">(optional)</span></label>
                  <div class="col-md-7">
                      <input  name="completion_date" type="text" class="datepicker form-control all_inputs" data-provide="datepicker">
                  </div>
              </div>
              <div class="form-group row">
                  <label for="inputEmail" class="col-md-5 col-form-label form-label-color">Skills <span class="label_sm">(optional)</span></label>
                  <div class="col-md-7">
                      <input class="form-control all_inputs"  name="skills" type="text" value="">
                  </div>
              </div>
	        {{--<p><label>--}}
              {{--<input name="" type="text" placeholder="Category" disabled></label></p>--}}

	    
    </div>  
  </div> 
  
</div>

<div class="modal-footer">
  <div class="row">
      <div class="col-md-8">
          <p style="margin-left:10px;">{{ __('freelancer.CopyrightMSG') }}</p> 
      </div>
      <div class="col-md-4">
          <a href="" class="btn btn-default" data-dismiss="modal">{{ __('freelancer.Cancel') }}</a>
          <button type="submit" class="btn btn-default btn-color" style="margin-top: -5px;position: relative;
right: 10px;">{{ __('freelancer.Update') }}</button>
      </div>
  </div>
  
</div>
</div>
</div>
</div>
</form>