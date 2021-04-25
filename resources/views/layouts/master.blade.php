<!DOCTYPE html>
<html lang="en">

@include('layouts.includes.head')
@yield('custom-css')

<body class="">
  <div class="wrapper ">
    @include('layouts.includes.sidebar')
    <div class="main-panel">
      <!-- Navbar -->
      @include('layouts.includes.navbar')

      <div class="content">
        <div class="container-fluid">
          @yield('content')
        </div>
      </div>
    </div>
  </div>
  @include('layouts.includes.filtres')

  @include('layouts.includes.js')
  @yield('custom-js')
</body>

</html>