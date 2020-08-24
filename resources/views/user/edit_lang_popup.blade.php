<div class="modal fade" id="lang{{$id}}" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color: #666666 !important;">Update Language</h4>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ url('/profileupdate') }}/{{ $user_data->user_id }}">
            {{ csrf_field() }}
            <div class="forms">	
		          <div class="form-group">
                <label class="form-label-color">Language</label>
                  <input type="hidden" name="id" value="{{$id}}">
                  <input type="text" class="lang_input" name="lang_name" required="" value="{{$lang_name}}">
              </div> 		 		 
		          <div class="form-group">
                <label class="form-label-color">Proficiency</label>
               </div>
               <ul class="lang">
               <div class="form-group"> 
		              <input type="radio" name="lang_skill" value="Basic" 
                  @if($lang_skill == 'Basic')
                  checked
                  @endif
                   /> 
		             <b class="font-color font-weight">Basic</b></br>
                            <span class="font-color">
                      I am only able to communicate in this language through written communication
                            </span>

		          </div> 

		          <div class="form-group"><input type="radio" name="lang_skill" value="Conversational"
                @if($lang_skill == 'Conversational')
                  checked
                  @endif
                > 
		           <b class="font-color font-weight">Conversational</b></br>
                        <span class="font-color">
                  I know this language well enough to verbally discuss project details with a client
                        </span>

		           </div> 

		          <div class="form-group">
                <input type="radio" name="lang_skill" value="Fluent"
                @if($lang_skill == 'Fluent')
                  checked
                  @endif
                > 
		              <b class="font-color font-weight">Fluent</b></br>
                          <span class="font-color">
		              I have complete command of this language with perfect grammar
                          </span>

		          </div>

      		    <div class="form-group"> 
                <input type="radio" name="lang_skill" value="Native or Bilingual"
                @if($lang_skill == "Native or Bilingual")
                  checked
                  @endif
                > 
      		     <b class="font-color font-weight">Native or Bilingual</b></br>
      		        <span class="font-color">I have complete command of this language, including breadth of vocabulary, idioms, and colloquialisms
                    </span>

      		    </div>
            </ul>
            </div> 
          </div>
        <div class="modal-footer">
             <a href="" class="btn btn-default" data-dismiss="modal">Cancel</a>
          <button type="submit" class="btn btn-default btn-color">Update</button>

        </div>
        </form>
      </div>
    </div>
  </div>