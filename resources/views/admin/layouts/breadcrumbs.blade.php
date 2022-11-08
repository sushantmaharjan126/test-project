
    <h4 class="fw-bold py-3 mb-4">
        @yield('title')
    </h4>
    
    @if(Request::segment(2) !== 'dashboard' && Request::segment(2) != null)
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    Dashboard
                </li>
                @if(Request::segment(3) != null)
                    <li class="breadcrumb-item">
                        {{ ucwords(Request::segment(2)) }}       
                    </li>
                @endif
                <li class="breadcrumb-item active">@yield('title')</li>
                
            </ol>
        </nav>
    @endif


