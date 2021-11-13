<!-- BEGIN Aside -->
<div class="aside">
    <div class="aside-header">
        <h3 class="aside-title">{{ env('APP_NAME', 'My App') }}</h3>
        <div class="aside-addon">
            <button class="btn btn-label-primary btn-icon btn-lg" data-toggle="aside">
                <i class="fa fa-times aside-icon-minimize"></i>
                <i class="fa fa-thumbtack aside-icon-maximize"></i>
            </button>
        </div>
    </div>
    <div class="aside-body">
        @php ($role = Auth::user()->role)

        <!-- BEGIN Menu -->
        <div class="menu">
            <div class="menu-item">
                <a href="{{ route('report') }}" class="menu-item-link {{ request()->is('/') ? 'active' : '' }}">
                    <div class="menu-item-icon">
                        <i class="fa fa-desktop"></i>
                    </div>
                    <span class="menu-item-text">Laporan</span>
                </a>
            </div>
            @if ($role === 'admin' || $role === 'kasir')
                <div class="menu-item">
                    <a href="{{ route('transaction') }}" class="menu-item-link {{ request()->is('transaction*') ? 'active' : '' }}">
                        <div class="menu-item-icon">
                            <i class="fa fa-dollar-sign"></i>
                        </div>
                        <span class="menu-item-text">Transaksi</span>
                    </a>
                </div>
            @endif
            @if ($role === 'admin')
                <div class="menu-item">
                    <a href="{{ route('outlet') }}" class="menu-item-link {{ request()->is('outlet*') ? 'active' : '' }}">
                        <div class="menu-item-icon">
                            <i class="fa fa-cog"></i>
                        </div>
                        <span class="menu-item-text">Konfigurasi Outlet</span>
                    </a>
                </div>
            @endif
        </div>
        <!-- END Menu -->

    </div>
</div>
<!-- END Aside -->