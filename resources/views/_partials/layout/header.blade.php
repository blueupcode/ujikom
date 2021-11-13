<div class="header">
    <div class="header-holder header-holder-desktop">
        <div class="header-container container-fluid">
            <div class="header-wrap header-wrap-block justify-content-start">
                <h2 class="header-title">{{ Auth::user()->outlet->nama }}</h2>
            </div>
            <div class="header-wrap">
                <a href="{{ route('handleLogout') }}" class="btn btn-label-danger btn-widest btn-lg">Logout</a>
            </div>
        </div>
    </div>
    <div class="header-holder header-holder-mobile">
        <div class="header-container container-fluid">
            <div class="header-wrap">
                <button class="btn btn-label-primary btn-icon">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <div class="header-wrap header-wrap-block">
                <h2 class="header-title">{{ Auth::user()->outlet->nama }}</h2>
            </div>
            <div class="header-wrap">
                <a href="{{ route('handleLogout') }}" class="btn btn-label-danger btn-icon">
                    <i class="fa fa-sign-out"></i>
                </a>
            </div>
        </div>
    </div>
</div>