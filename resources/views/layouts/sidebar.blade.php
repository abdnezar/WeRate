<!DOCTYPE html>
<html>
    <head>
        <meta name="propeller" content="e14c4d6ab032bd5408bf22a27a5d4c8f">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>WeRate</title>
         @include('includes.cssfiles.bootstrap')
         @include('includes.jsfiles.bootstrap')
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    </head>

    <body>
        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3> Admin DashBoard </h3>
                </div>

                <ul class="list-unstyled components">
                    <p>WeRate Dashboard</p>
                    <li class="active">
                        <a href="{{ URL('/') }}"><i class="fas fa-home"></i> Home</a>
                        <a style="margin-top: 5px" href="{{ URL('/stores') }}"><i class="fas fa-user"></i> See As Guest</a>
                        <a id="btnAddAction" href="#homeSubmenu" style="margin-top: 5px" data-toggle="collapse" aria-expanded="false"><i id="btnAddActionIcon" class="fas fa-arrow-circle-down"></i> Make Action</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li><a href="{{ URL('genre/create') }}">Mangae Genres</a></li>
                            <li><a href="{{ URL('store/manage') }}">Manage Stores</a></li>
                            <li><a href="{{ URL('store/create') }}">Add Store</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="list-unstyled CTAs">
                    <li><a href="#" class="download btn-disabled">Send Email</a></li>
                    <li><a href="#" class="article">Call Support</a></li>
                </ul>
            </nav>

            <!-- Page Content Holder -->
            <div id="content">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <nav class="navbar navbar-default">
                            <div class="container-fluid">
                                <div class="navbar-header">
                                    <button type="button" id="sidebarCollapse" class="navbar-btn">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </button>
                                </div>
                                <div style="width: 95%;text-align: center;">@yield('title')</div>
                            </div>
                        </nav>
                        </div>
                    </div>
                </div>
                
                @if (session('updateResult'))
                    @if (session('updateResult') == 1)
                        <div class="alert alert-success  alert-dismissible fade show" data-dismiss="alert">Updated Successfully</div>
                    @else
                        <div class="alert alert-danger  alert-dismissible fade show" data-dismiss="alert"> Updated Failed</div>
                    @endif
                    {{session(['updateResult'=>null])}}

                @elseif(session('insertResult'))
                    @if(session('insertResult') == 1)
                        <div class="alert alert-success alert-dismissible fade show" data-dismiss="alert"> Added Successfully </div>
                    @elseif(session('insertResult') == 2)
                        <div class="alert alert-danger alert-dismissible fade show" data-dismiss="alert"> Add Failed, Please Choose Store Logo (jpg-png-jpeg-gif) accepted</div>
                    @elseif(session('insertResult') == 3)
                        <div class="alert alert-danger alert-dismissible fade show" data-dismiss="alert"> Add Failed, Store Logo Size Too Large( Maximum 2 Megabyte), Please Choose Anthor One</div>
                    @endif
                    {{session(['insertResult'=>null])}}

                @elseif(session('deleteResult'))
                    @if (session('deleteResult') == 1)
                        <div class="alert alert-success alert-dismissible fade show" data-dismiss="alert"> Deleted Successfully </div>
                    @else
                        <div class="alert alert-danger alert-dismissible fade show" data-dismiss="alert"> Delete Failed</div>
                    @endif
                    {{session(['deleteResult'=>null])}}

                @elseif(session('restoreResult'))
                    @if (session('restoreResult') == 1)
                        <div class="alert alert-success alert-dismissible fade show" data-dismiss="alert"> Restored Successfully </div>
                    @else
                        <div class="alert alert-danger alert-dismissible fade show" data-dismiss="alert"> Restore Failed</div>
                    @endif
                    {{session(['restoreResult'=>null])}}

                @elseif(session('rateResult'))
                    @if (session('rateResult') == 1)
                        <div class="alert alert-success alert-dismissible fade show" data-dismiss="alert"> Store Rated Successfully </div>
                    @else
                        <div class="alert alert-danger alert-dismissible fade show" data-dismiss="alert"> Rating Failed</div>
                    @endif
                    {{session(['rateResult'=>null])}}

                @elseif(session('searchResult'))
                    @if (session('searchResult') == 1)
                        <div class="alert alert-danger alert-dismissible fade show" data-dismiss="alert"> Should Enter Market Name </div>
                        {{session(['searchResult'=>null])}}
                    @endif
                @endif

                @foreach ($errors->all() as $message)
                    <div class="alert alert-danger alert-dismissible fade show" data-dismiss="alert"> {{$message}} </div>
                @endforeach

                <div>@yield('content')</div>
                
                {{-- @yield('htmlContent') --}}
            </div>
        </div>


        
         <script type="text/javascript">
             $(document).ready(function () {
                 $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                     $(this).toggleClass('active');
                 });

                 $isClicked = 0;
                 $('#btnAddAction').click(function () {
                     if ($isClicked == 0) {
                        $('#btnAddActionIcon').removeClass('fas fa-arrow-circle-down');
                        $('#btnAddActionIcon').addClass('fas fa-arrow-circle-up');
                        $isClicked = 1;
                     } else {
                        $('#btnAddActionIcon').removeClass('fas fa-arrow-circle-up');
                        $('#btnAddActionIcon').addClass('fas fa-arrow-circle-down');
                        $isClicked = 0;
                     }
                 });
                
                });
         </script>
    </body>
</html>
