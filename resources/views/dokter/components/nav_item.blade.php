<li class="nav-item">
    <a href="/dokter/dashboard" class="nav-link {{ request()->is('dokter/dashboard') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
    </a>
</li>
<li class="nav-item">
    <a href="/dokter/jadwal-periksa" class="nav-link {{ request()->is('dokter/jadwal-periksa') ? 'active' : '' }}">
        <i class="nav-icon fas fa-calendar-check"></i>
        <p>Jadwal Periksa</p>
    </a>
</li>
<li class="nav-item">
    <a href="/dokter/memeriksa" class="nav-link {{ request()->is('dokter/memeriksa') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-md"></i>
        <p>Memeriksa</p>
    </a>
</li>
<li class="nav-item">
    <a href="/dokter/riwayat-periksa" class="nav-link {{ request()->is('dokter/riwayat-periksa') ? 'active' : '' }}">
        <i class="nav-icon fas fa-notes-medical"></i>
        <p>Riwayat Pasien</p>
    </a>
</li>
<li class="nav-item">
    <a href="/dokter/profil" class="nav-link {{ request()->is('dokter/profil') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-circle"></i>
        <p>Profile</p>
    </a>
</li>
