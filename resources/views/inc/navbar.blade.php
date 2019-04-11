

本网站不能在中国大陆地区使用，大部分内容只在用户所在国显示
  <nav class="navbar navbar-expand-md navbar-dark  navbar-laravel" style="background-color: green;">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>


            <!-- customized Navbar -->
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="/"> <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                    <a class="nav-link" href="/ptmiss">业余客串</a>
                  </li>
              <li class="nav-item">
                <a class="nav-link" href="/massage">按摩</a>
              </li>
              <li class="nav-item">
                    <a class="nav-link" href="/baoyang">包养</a>
                  </li>
              
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  其它
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="/escort">伴游</a>
                  <a class="dropdown-item" href="/bussE">商务陪伴</a>
                  <a class="dropdown-item" href="/other">other</a>
                  
                </div>
              </li>
              <li class="nav-item">
                <li class="nav-item">
                  <a class="nav-link" href="/help">帮助</a>
                </li>
            </ul>
            <!-- Right Side Of Navbar -->
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('登录') }}</a>
                    </li>
                    <li class="nav-item">
                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ __('注册') }}</a>
                        @endif
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>