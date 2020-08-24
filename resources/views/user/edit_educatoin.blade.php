<h3  data-toggle="modal" data-target="#Education">Education 
      <a href="javascript:;"><i class="fa fa-plus edite" aria-hidden="true"></i>
      </a>
    </h3>

    <ul>
      @if(!empty($all_education))
        @foreach($all_education as $education)
        <li>
            <a class="edit-education" educatoin_id="{{ $education->id }}" href="">{{ $education->degree }}</a>
        </li>
        @endforeach
      @endif
    </ul>
  <form action="{{ url('/profileupdate') }}/{{ Auth::user()->id }}" method="POST">
    {{ csrf_field() }}
    <div class="modal fade" id="Education" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Add Education</h4>
            </div>
<?php $option = \DB::table('admin_option')->select('*')->first() ?>
            <div class="modal-body">
                <div class="forms">	
    		            <p><label>School</label>
                    <input name="school" type="text" value="" required> </p> 		 		 
    		 
    		            <p><label>Dates Attended</label> 
                      <select name="from" required>
                        <option value="">From</option>
                        @for($i=$option->date_to; $i>$option->date_from; $i--)
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                    </p>

    		            <p>
                      <select name="to" required>
                        <option value=""> To (Expected Graduation Year)</option>

                        @for($i=$option->date_to; $i>$option->date_from; $i--)
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                    </p>

    		            <p><label>Degree</label> 
                      <input name="degree" type="text" value="" required>
                    </p>

    		            <p><label>Area of Study (optional)</label> 
                      <input name="area_of_study" data-provide="datepicker">
                    </p>

    			         <p><label>Description (optional)</label> 
                    <textarea name="description" type="text" value=""></textarea>
                  </p>
                </div> 
              </div>

            <div class="modal-footer">
              <button type="submit" class="btn btn-default">Update</button>
    		      <a href="" class="btn-btn-default">Cancel</a>
            </div>
          </div><!-- end modal-content -->

        </div>
      </div>
    </form>