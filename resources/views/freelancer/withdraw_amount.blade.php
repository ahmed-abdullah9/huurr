@include('include.header_fr')
<div class="row">
    <h2 align="center">Withdraw Payment Request</h2>
   <div class="col-md-offset-2 col-md-6">
   <form style="padding-top: 20px;" method="post" action="{{url('fr/payment/request')}}">
       <input style="height: 30px;" type="text" disabled value="${{$amount}}">
       <input type="hidden" name="fr_bank_info_id" value="{{encrypt($fr_bank_info->id)}}">
       <input type="hidden" name="amount" value="{{encrypt($amount)}}">
       <button class="btn">Send Request</button>
   </form>
   </div>
</div>
@include('include.footer_fr')