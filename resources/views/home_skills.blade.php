@extends('layouts.app')

@section('content')
<!-- home section -->
<div id="home">
<div class="container">
    <div class="row">
        <div class=" col-md-12 col-sm-12 col-lg-12">
            <h1>Home Skills. </h1>      
            <ul>
            	<?php if(!empty($skills))
            	{
            		foreach ($skills as $skl) {
            			echo '<li><h3>'.$skl->name.'</h3></li>';
            		}
            	} ?>
            	
            </ul>       
        </div>
        </div>
    </div>
</div>
@endsection