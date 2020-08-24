<h3 class="font-color font-weight"  data-toggle="modal"  data-target="#Languages">{{ __('freelancer.Languages') }} <a href="javascript:;"><i class="fa fa-plus edite font-color font-weight" aria-hidden="true"></i></a></h3>

 @if(isset($all_languages)&&$all_languages!='')
    <ul class="Availablelity">
   
    @foreach($all_languages as $lang)
      <li style="padding: 10px;"><a href="javascript:;"><b>{{ $lang->lang_name }}:</b> {{ $lang->lang_skill }}</a>

        <a data-toggle="modal" data-target="#lang{{$lang->id}}" href="javascript:;"><i class="fa fa-pencil-square-o edit-language" aria-hidden="true"></i></a>

      </li>
      @endforeach
    </ul>
@endif

   @if(isset($all_languages)&&$all_languages!='')
    @foreach($all_languages as $lang)
      @include('user.edit_lang_popup', array('id' => $lang->id, 'lang_name' => $lang->lang_name, 'lang_skill' => $lang->lang_skill))
    @endforeach
  @endif

<div class="modal fade" id="Languages" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="main-form-title">{{ __('freelancer.AddLanguage') }}</h4>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ url('/profileupdate') }}/{{ $user_data->user_id }}">
            {{ csrf_field() }}
            <div class="forms">	
		          <div class="form-group">
                <label class="form-label-color">{{ __('freelancer.Language') }}</label>
                  <input class="lang_input" type="text" name="lang_name" placeholder="e.g:English" value="" required="">
                </div>
		          <div class="form-group">
                <label  class="form-label-color">{{ __('freelancer.Proficiency') }}</label>
               </div>
               <ul class="lang">
               <div class="form-group"> 
		              <input type="radio" name="lang_skill" value="Basic" /> 
		             <b class="font-color font-weight">{{ __('freelancer.Basic') }}</b></br>
                            <p class="p-left">
                      {{ __('freelancer.BasicDescription') }}
                            </p>

                   <br>
		          </div> 

		          <div class="form-group"><input type="radio" name="lang_skill" value="Conversational"> 
		            <b class="font-color font-weight"> {{ __('freelancer.Conversational') }}</b></br>
                        <p class="p-left">
                 {{ __('freelancer.ConversationalDescription') }}
                        </p>

                      <br>
		           </div> 

		          <div class="form-group">
                <input type="radio" name="lang_skill" value="Fluent"> 
		            <b class="font-color font-weight">{{ __('freelancer.Fluent') }}</b></br>
                          <p class="p-left">
		              {{ __('freelancer.FluentDescription') }}
                          </p>
                      <br>
		          </div>

      		    <div class="form-group"> 
                <input type="radio" name="lang_skill" value="Native or Bilingual">
      		     <b class="font-color font-weight">{{ __('freelancer.Native') }}</b></br>
                      <p class="p-left">
      		       {{ __('freelancer.NativeDescription') }}
                      </p>

                    <br>
      		    </div>
            </ul>
            </div> 
          </div>
        <div class="modal-footer">
            <a href="" class="btn btn-default" data-dismiss="modal">{{ __('freelancer.Cancel') }}</a>
          <button type="submit" class="btn btn-default btn-color">{{ __('freelancer.Update') }}</button>
        </div>
        </form>
      </div>
    </div>
  </div>