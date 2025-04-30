<li class="nav-item">
    <a href="/pasien/dashboard" class="nav-link {{ request()->is('pasien/dashboard') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
    </a>
</li>
<li class="nav-item">
    <a href="/pasien/periksa" class="nav-link {{ request()->is('pasien/periksa') ? 'active' : '' }}">
        <i class="nav-icon fas fa-solid fa-hospital"></i>
        <p>Periksa</p>
    </a>
</li>
<li class="nav-item">
                            <a href="{{ route('pasien.riwayat') }}" class="nav-link {{ request()->is('pasien/riwayat') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-history"></i>
                                <p>Riwayat Janji</p>
                            </a>
                        </li>
