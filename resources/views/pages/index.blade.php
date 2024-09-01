@extends('template.master')

@section('title','Home Page')

@section('content')
<h1>Hello, {{Auth::user()->name}}</h1>
<h2>Udah Kelar Bayar</h2>
@endsection