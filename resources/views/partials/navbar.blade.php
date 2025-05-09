<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard') }}">Arsip Desa</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                        <span class="nav-link text-white">{{ auth()->user()->name }}</span>
                    </li>

                    <li class="nav-item">
    @if(auth()->user()->profil)
        <a class="nav-link" >
            <i class="bi bi-person-circle" title="Lihat Profil"></i>
        </a>
    @else
        <a class="nav-link" href="">Buat Profil</a>
    @endif
</li>


                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-link nav-link" type="submit">Logout</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
