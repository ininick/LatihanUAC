@extends('template.master')

@section('title', 'Login Page')

@section('content')
<div class="container">
    <form action="{{route('loginPost')}}" method="POST">
        @if(Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{session('error')}}
          </div>
        @endif
        @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{session('success')}}
          </div>
        @endif
        @csrf
        @method('post')
        <div class="mb-3">
          <label for="inputEmail" class="form-label">@lang('auth.email')</label>
          <input type="email" class="form-control" name='email' id="inputEmail" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
          <label for="inputPassword" class="form-label">@lang('auth.password')</label>
          <input type="password" class="form-control" name="password" id="inputPassword">
        </div>

        <div class="mb-5">
            <button type="submit" class="btn btn-success w-100">@lang('auth.login')</button>
        </div>
      </form>
</div>

@endsection
