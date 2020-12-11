@extends('layouts.app')
@section('content')
<body>
    <div id="page-title">
		  <div id="page-title-inner">
          <div class="container text-center">
          </div>
  		</div>	
    </div>
<div class="container">
    <div class="row">
        <div class="col-lg">
        <div class="card mb-3">
        <h1 class="card-title text-center" >Seafood </h1>
    <img src="{{'/images/menu/gadogado.jpeg'}}" class="card-img-top">
    <div class="card-body">
        <p class="card-text text-justify">Gado-gado (Indonesian or Betawi) is an Indonesian salad of slightly boiled, blanched or steamed vegetables and hard-boiled eggs, boiled potato, fried tofu and tempeh, and lontong (rice wrapped in a banana leaf), served with a peanut sauce dressing.</p>
        <p class="card-text tect-justify">Price: Rp. 25.000</p>
        <a href="#" class="btn btn-primary">Back</a>
        <a href="#" class="btn btn-primary">Order</a>
    </div>
</div>
</div>
</body>
@push('script')
@endpush
@endsection