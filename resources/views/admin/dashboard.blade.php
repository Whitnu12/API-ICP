@extends('layout.admin_layout')
@section('content')
@if(Auth::guard('admin')->check())
    <h2 class="text-xl">Welcome, {{ Auth::guard('admin')->user()->nama }}</h2>
    
@endif
<div class=" flex ">
    <h1> Coba </h1>
    <div class="">
        <div class="">

        </div>
    </div>
</div>

@endsection