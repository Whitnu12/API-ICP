@extends('layout.admin_layout')
@section('content')
@if(Auth::guard('admin')->check())
    <h2>Welcome, {{ Auth::guard('admin')->user()->nama }}</h2>
    
@endif
@endsection