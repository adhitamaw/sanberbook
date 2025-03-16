<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container position-relative d-flex align-items-center">

      <a href="/" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="{{asset('template/assets/img/logo.png') }}" alt=""> -->
        <h1 class="sitename">SanberBook</h1><span>.</span>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="/">Home</a></li>
          <li><a href="{{ route('genres.index') }}">Genre</a></li>
          <li><a href="{{ route('books.index') }}">Books</a></li>
          
          @auth
              
              <li class="dropdown has-dropdown">
                  <a href="#" class="d-flex align-items-center">
                      <span>{{ auth()->user()->name }}</span> 
                      <i class="bi bi-chevron-down ms-1"></i>
                  </a>
                  <ul class="dropdown-menu">
                      <li>
                          <form action="{{ route('logout') }}" method="POST" class="px-3">
                              @csrf
                              <button type="submit" class="btn btn-danger w-100">Logout</button>
                          </form>
                      </li>
                  </ul>
              </li>
          @else
              <li><a href="{{ route('login') }}">Login</a></li>
              <li><a href="{{ route('register') }}">Register</a></li>
          @endauth
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      

    </div>
  </header>

<style>
@media (max-width: 991px) {
    .navmenu ul li.has-dropdown .dropdown-menu {
        position: static;
        display: block;
        padding: 10px 0;
        opacity: 1;
        visibility: visible;
        background: transparent;
        box-shadow: none;
    }

    .navmenu ul li.has-dropdown .dropdown-menu form {
        padding: 0 20px;
    }

    .navmenu.show {
        display: block;
    }
}
</style>