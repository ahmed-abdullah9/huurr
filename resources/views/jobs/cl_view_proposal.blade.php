<div class="table-header-title x_panel">
    <div class="x_title">
        <h2>Terms </h2>
        <br/>
        <div class="clearfix"></div>
        <p>What is the amount you'd like to bid for this job?</p>
    </div>
    <div class="x_content"> <br />
        <form class="form-horizontal form-label-left input_mask">
            <div class="form-group horizontal">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Bid </label>
                <div class="form-group col-md-5 col-sm-5 col-xs-7">
                    @if($jobs->job_time_type=='hourly')  <label style="text-align:right;float:right;display: inline;line-height: 30px;" for="bid_amount">/hr</label> @endif
                    <input type="text" class="form-control" style="display: inline;width: 140px;" id="bid_amount"  value="{{ $proposals->bid_amount }}" disabled="disabled">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">VAT Fee</label>
                <div class="col-md-5 col-sm-5 col-xs-7">
                    <input type="text" style="display: inline;width: 140px;" class="form-control" value="%{{$vat}}" disabled="disabled">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">You'll be Charged</label>
                <div class="col-md-5 col-sm-5 col-xs-7">
                    <input type="text" class="form-control" style="display: inline;width: 140px;" value="{{ $proposals->bid_amount+($vat/100*$proposals->bid_amount) }}" disabled="disabled">
                    @if($jobs->job_time_type=='hourly') /hr @endif
                </div>
            </div>
            @php
                $attchments=json_decode($proposals->attachment_file);
            if (empty($attchments)){
            $attchments=array();
            }

            @endphp
            @if(sizeof($attchments)>0)
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Proposal Attachments </label>
                <div class="col-md-5 col-sm-5 col-xs-7">
                    <ul>
                        @for($i=0;$i<sizeof($attchments);$i++)
                        <li>
                            <a href="{{asset($attchments[$i])}}" download>File {{$i+1}}</a>
                        </li>
                            @endfor
                    </ul>
                </div>
            </div>
            @endif
            <div class="ln_solid"></div>
            
        </form>
    </div>
</div>