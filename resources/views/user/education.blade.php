<h3 style="color:#666666 !important;font-weight: normal;border-bottom: none;border-top: 1px solid #B2B2B2 !important;padding-top: 20px !important;font-size: 24px;" data-toggle="modal" data-target="#Education">{{ __('freelancer.Education') }}
      <a href="javascript:;"><i style="color:#666666 !important; " class="fa fa-plus edite" aria-hidden="true"></i>
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
  <form action="{{ url('/profileupdate') }}/{{ $user_data->user_id }}" method="POST">
    {{ csrf_field() }}
    <div class="modal fade" id="Education" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 style="color:#666666 !important;" class="modal-title">{{ __('freelancer.AddEducation') }}</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><label>{{ __('freelancer.School') }}</label>
                            <input class="project_input" name="school" type="text" value="" required>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p><label>{{ __('freelancer.Degree') }}</label>
                            <input class="project_input" name="degree" type="text" value="" required>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p><label>{{ __('freelancer.DatesAttended') }}</label>
                            <select name="from" required>
                                <option value="">{{ __('freelancer.From') }}</option>
                                @for($i=2025; $i>1940; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p>
                            <label>Expected Graduation year</label>
                            <select name="to" required>
                                <option value="">To</option>

                                @for($i=2025; $i>1940; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </p>
                    </div>
            </div>
                <div class="row">
                    <div class="col-md-6">
                        <p><label>{{ __('freelancer.AreaOfStudyOptional') }}</label>
                            <input class="project_input" name="area_of_study" data-provide="datepicker">
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p><label>{{ __('freelancer.DescriptionOptional') }}</label>
                            <textarea style="border-radius: 8px;" name="description" type="text" value=""></textarea>
                        </p>
                    </div>
                </div>
                {{--<div class="forms">	--}}
                    {{----}}
                {{--</div> --}}
              </div>

            <div class="modal-footer">
                <a href="" class="btn btn-default">{{ __('freelancer.Cancel') }}</a>
              <button type="submit" class="btn btn-default btn-color">{{ __('freelancer.Update') }}</button>

            </div>
          </div><!-- end modal-content -->

        </div>
      </div>
    </form>