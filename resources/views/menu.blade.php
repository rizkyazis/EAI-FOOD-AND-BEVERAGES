@extends('layouts.app')
@section('content')
<style>
  .menu-image{
  object-fit: cover;
  max-height: 180px;
}
</style>

<div class="container" style='margin-top:100px'>
    <div class="row">
        @foreach ($menu as $item)
        <div class="col-6 col-md-3">
            <div class="card">
                <img src="/images/menu/{{$item->image}}" class="card-img-top menu-image" alt="{{$item->name}}">
                <div class="card-body">
                    <h5 class="card-title">{{$item->name}}</h5>
                    <p class="card-text">{{$item->type}}</p>
                    <p class="card-text text-success">{{$item->price}}</p>
                    <a href="#" class="btn btn-primary">Detail</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
