
@if(request()->segment(1) !=="admin" && request()->segment(2) !=="login")
<body id="body-pd">
    <header class="header mb-5" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="moon" > <i class="fa-solid fa-moon"></i> </div>
        <div class="sun" style="display:none"> <i class="fa-solid fa-sun"></i> </div>
    
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> 
                <a href="/" class="nav_logo"> 
                    <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">Calendar</span> 
                </a>
                <div class="nav_list"> 
                    <a href="/" class="nav_link active"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a>
                   
                        @if(Auth::user()->user_type =='Admin')
                        <a href="{{route('addAdmin.page')}}" class="nav_link"> 
                            <i class='bx bx-user nav_icon'></i>
                            <span class="nav_name">Users</span>
                        </a>
                        @endif
                   
                </div>
            </div> 
            <a href="{{route('admin.logout')}}" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> </a>
        </nav>
    </div>
   
</body>
@endif