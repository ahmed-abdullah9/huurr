@extends('layouts.app')

@section('content')
<section class="login-section register-section">
<div class="container">
<div class="head_of_section">
<h2>Lifetime Billing with Each Client</h3>
<span class="text-right dates"> <a href="" class="Download"> Download CSV</a>
</span>
</div>


<div class="urnings">
      <table border = "0" width = "100%" class="urn-table">
         <thead>
            <tr  class="tops">
               <td class = "Client"><strong>Client</strong></td>             
			   <td class = "Client"><strong>Total Billed</strong></td>
            </tr>
         </thead>
         

         
         <tbody>
            <tr>
               <td>Dan Edgliy</td>
               <td>$4.80</td>
            </tr>
			  <tr>
               <td>360 Strenth LLC  </td>
               <td>$4.80</td>
            </tr>
			  <tr>
               <td>360 Strenth LLC  </td>
               <td>$4.80</td>
            </tr>
			  <tr>
               <td>360 Strenth LLC  </td>
               <td>$4.80</td>
            </tr>
			  <tr>
               <td>360 Strenth LLC  </td>
               <td>$4.80</td>
            </tr>			
         </tbody>
		 
         
      </table>
<p class="Report">Report Update Weekly</p>
</div>


</div>
</section>
@endsection