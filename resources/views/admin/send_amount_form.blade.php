@include('include.header_admin')
<div class="container">
    <div class="row">
        @if(Session::has('info'))
            <p class="alert alert-info">{{ Session::get('info') }}</p>
        @endif
        <div class="col-md-offset-1 col-md-8 col-xs-12 table-responsive">
            <h2 align="center">Freelancer Bank Info.</h2>
            <table class="table table-hover">
                <tbody>
                <tr>
                    <td>First Name</td>
                    <td><b>{{$fr_bank_info->first_name}}</b></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><b>{{$fr_bank_info->last_name}}</b></td>
                </tr>
                <tr>
                    <td>BirthPlace</td>
                    <td><b>{{$fr_bank_info->birth_place}}</b></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><b>{{$fr_bank_info->fr_email}}</b></td>
                </tr>
                <tr>
                    <td>Bank Name</td>
                    <td><b>{{$fr_bank_info->bank_name}}</b></td>
                </tr>
                <tr>
                    <td>Bank Address</td>
                    <td><b>{{$fr_bank_info->bank_address}}</b></td>
                </tr>
                <tr>
                    <td>Bank Account</td>
                    <td><b>{{$fr_bank_info->bank_account_no}}</b></td>
                </tr>
                <tr>
                    <td>Amount</td>
                    <td><b>${{$request_info->amount_request}}</b></td>
                </tr>
                <form method="post" action="{{url('fr_amount/tranfer/')}}" enctype="multipart/form-data">
                <tr>
                    <td>
                        <label for="files">Upload Bank Receipents</label>
                        <input id="files" type="file" name="bank_rec">
                    </td>
                    <td><output id="list"></output></td>
                    <input type="hidden" name="request_id" value="{{encrypt($request_info->id)}}">
                </tr>
                <tr>
                    <td colspan="2"><button class="pull-right">Send to freelancer</button></td>
                </tr>
            </form>
                </tbody>
            </table>

        </div>
    </div>
</div>
<script>
    function handleFileSelect(evt) {
        var files = evt.target.files; // FileList object

        // Loop through the FileList and render image files as thumbnails.
        for (var i = 0, f; f = files[i]; i++) {

            if (!f.type.match('image.*')) {
                continue;
            }

            var reader = new FileReader();

            reader.onload = (function(theFile) {
                return function(e) {
                    // Render thumbnail.
                    var span = document.createElement('span');
                    span.innerHTML = ['<img class="thumb" src="', e.target.result,
                        '" title="', escape(theFile.name), '"/>'].join('');
                    document.getElementById('list').insertBefore(span, null);
                };
            })(f);

            reader.readAsDataURL(f);
        }
    }

    document.getElementById('files').addEventListener('change', handleFileSelect, false);
</script>
@include('include.footer_admin')