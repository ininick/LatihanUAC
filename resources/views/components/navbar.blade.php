<nav class="navbar navbar-expand-lg bg-body-tertiary">

    <div class="container-fluid">
      <a class="navbar-brand" href="{{route('index')}}">Job Friends</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('index')}}">@lang('components.home')</a>
          </li>
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              @lang('components.friends')
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">@lang('components.friend_list')</a></li>
              <li><a class="dropdown-item" href="#">@lang('components.message')</a></li>
              <li><a class="dropdown-item" href="#">@lang('components.wishlist')</a></li>
            </ul>
          </li>
                    
        </ul>
        
          
        <ul class="navbar-nav">
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{route('login')}}">@lang('components.login')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('register')}}">@lang('components.register')</a>
                </li>
            @endguest
            @auth
            <form action="{{route('profile')}}" method="GET">
                <button type="submit" class="btn btn-warning me-3">@lang('components.profile')</button>
            </form>
                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    @method('post')
                    <button type="submit" class="btn btn-danger">@lang('components.logout')</button>
                </form>
            @endauth
        </ul>
      </div>
    </div>
  </nav>