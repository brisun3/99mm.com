<!DOCTYPE html>
<html lang="zh-Hans">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- my Scripts -->
    
 
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
    .modal-backdrop
    {
        opacity:0.82 !important;
    }
    </style>
    <!--goole maps-->
    <style>
    
      /* Optional: Makes the sample page fill the window. */
      
      </style>
    <!--goole maps-->
    
</head>
<body>
    
      
      <!-- Modal -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              本网站需年满18周岁才能进入，否则属非法使用！
            </div>
            <div class="modal-footer">
              
              <button type="button" class="btn btn-primary" data-dismiss="modal">我已年满18周岁,让我进去。</button>
            </div>
          </div>
        </div>
      </div>
      
      

     
    
    <script>
    $(document).ready(function(){

        if (document.cookie.indexOf('visited=true') == -1) {
            var fifteenDays = 1000*60*60*24*15;
            var expires = new Date((new Date()).valueOf() + fifteenDays);
            document.cookie = "visited=true;expires=" + expires.toUTCString();
            $('#flag').trigger('click');
         $('#myModal').modal('toggle');
        }
    
    });
    </script>
    
 
                
    
        @include('inc.navbar')
        <!--<main class="py-4">-->
            
        @include('inc.messages')
        @yield('content')
            
            
        <!--</main>-->
    
</body>
</html>
