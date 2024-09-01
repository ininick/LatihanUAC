@extends('template.master')

@section('title', 'Register Page')

@section('content')
<div class="container">
    <form action="{{route('registerPost')}}" method="POST">
        @if(Session::has('error'))
        @if(is_array(session('error')))
            @foreach (session('error') as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @else
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
    @endif
    
        @csrf
        @method('post')
        <div class="mb-3">
            <label for="inputName" class="form-label">@lang('auth.name')</label>
            <input type="name" class="form-control" name='name' id="inputName" aria-describedby="emailHelp">
          </div>

        <div class="mb-3">
          <label for="inputEmail" class="form-label">@lang('auth.email')</label>
          <input type="email" class="form-control" name='email' id="inputEmail" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
          <label for="inputPassword" class="form-label">@lang('auth.password')</label>
          <input type="password" class="form-control" name="password" id="inputPassword">
        </div>

        <div class="mb-3">
            <label for="inputPasswordConfirmation" class="form-label">@lang('auth.confirm')</label>
            <input type="password" class="form-control" name="password_confirmation" id="inputPasswordConfirmation">
        </div>
        
        <div class="mb-3">
            <label for="inputGender" class="form-label">@lang('auth.gender')</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="gendermale" value="Male" checked>
                <label class="form-check-label" for="gendermale">
                    @lang('auth.male')
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="genderfemale" value="Female" checked>
                <label class="form-check-label" for="genderfemale">
                    @lang('auth.female')
                </label>
            </div>
        </div>
        
        <div class="mb-3">
            <label for="inputInterest" class="form-label">@lang('auth.interest')</label>
            <div class="d-flex flex-row">
                <div class="d-flex flex-column">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="interest[]" type="checkbox" id="interest1" value="technology">
                        <label class="form-check-label" for="interest1">Technology</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" name="interest[]" type="checkbox" id="interest2" value="medical">
                        <label class="form-check-label" for="interest2">Medical</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" name="interest[]" type="checkbox" id="interest5" value="artist">
                        <label class="form-check-label" for="interest5">Artist</label>
                      </div>
                </div>
                <div class="d-flex flex-column">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="interest[]" type="checkbox" id="interest3" value="education">
                        <label class="form-check-label" for="interest3">Education</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" name="interest[]" type="checkbox" id="interest4" value="political">
                        <label class="form-check-label" for="interest4">Political</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" name="interest[]" type="checkbox" id="interest6" value="military">
                        <label class="form-check-label" for="interest6">Military</label>
                      </div>
                </div>
            </div>
           
        </div>

        <div class="mb-3">
            <label for="basic-url" class="form-label">Linkedin</label>
            <div class="input-group">
              <span class="input-group-text" id="basic-addon3">https://www.linkedin.com/in/</span>
              <input type="text" class="form-control" name="linkedin" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
            </div>
            <div class="form-text" id="basic-addon4">Insert yout linkedin here.</div>
          </div>

        <div class="mb-3">
            <label for="inputPhone" class="form-label">@lang('auth.phone')</label>
            <input type="number" class="form-control" name="phone" id="inputPhone">
        </div>

        <div class="mb-3">
            <label for="educationlevel" class="form-label">@lang('auth.education')</label>
            <select class="form-select" aria-label="Default select example"id= "educationlevel" name='education'>
                <option selected>@lang('auth.highschool')</option>
                <option value="1">@lang('auth.associate')</option>
                <option value="2">@lang('auth.bachelor')</option>
                <option value="3">@lang('auth.master')</option>
                <option value="4">@lang('auth.doctoral')</option>
            </select>
        </div>
        <div class="mb-5">
            <button type="submit" class="btn btn-success w-100">@lang('auth.register')</button>
        </div>
      </form>
</div>

@endsection
