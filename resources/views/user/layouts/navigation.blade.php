<nav x-data="{ open: false }"
     class="sticky top-0 z-50 backdrop-blur-xl"
     style="
        background: linear-gradient(
            to bottom,
            rgba(2,6,23,.85),
            rgba(2,6,23,.65)
        );
        border-bottom: 1px solid var(--border-soft);
     ">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            {{-- ================= LEFT ================= --}}
            <div class="flex items-center gap-10">

                <a href="{{ route('beranda') }}" class="flex items-center gap-3 group">
                    <x-application-logo class="h-9 w-auto transition group-hover:scale-105"
                        style="fill: var(--primary);" />
                    <span class="font-bold tracking-wide text-lg"
                          style="color: var(--text-main);">
                        Toko Online
                    </span>
                </a>

                <div class="hidden sm:flex items-center gap-6">
                    @php
                        function navActive($route) {
                            return request()->routeIs($route)
                                ? 'nav-premium active'
                                : 'nav-premium';
                        }
                    @endphp

                    <a href="{{ route('beranda') }}" class="{{ navActive('beranda') }}">Beranda</a>
                    <a href="{{ route('cart.index') }}" class="{{ navActive('cart.*') }}">Keranjang</a>
                    <a href="{{ route('about') }}" class="{{ navActive('about') }}">Tentang Kami</a>

                    @auth
                        <a href="{{ route('user.orders') }}" class="{{ navActive('user.orders*') }}">
                            📦 Riwayat Pesanan
                        </a>
                    @endauth
                </div>
            </div>

            {{-- ================= RIGHT ================= --}}
            <div class="hidden sm:flex items-center gap-4">

                @auth
                    <div class="relative" x-data="{ openUser: false }">
                        <button @click="openUser = !openUser"
                            class="flex items-center gap-3 px-3 py-2 rounded-xl transition hover:scale-[1.02]"
                            style="background: var(--bg-card); border:1px solid var(--border-soft);">

                            {{-- AVATAR FOTO --}}
                            @if(Auth::user()->profile_photo)
                                <img src="{{ Auth::user()->profile_photo_url }}"
                                     alt="avatar"
                                     class="w-8 h-8 rounded-full object-cover border">
                            @else
                                <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm"
                                     style="background: var(--primary); color:white;">
                                    {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                                </div>
                            @endif

                            <span class="font-medium"
                                  style="color: var(--text-main);">
                                {{ Auth::user()->name }}
                            </span>

                            <svg class="w-4 h-4 opacity-60" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                            </svg>
                        </button>

                        {{-- DROPDOWN --}}
                        <div x-show="openUser" x-transition @click.away="openUser=false"
                             class="absolute right-0 mt-3 w-48 rounded-xl overflow-hidden shadow-2xl"
                             style="background: var(--bg-card); border:1px solid var(--border-soft);">

                            <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                👤 Profile
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item text-danger w-full text-left">
                                    🚪 Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth

                @guest
                    <a href="{{ route('login') }}"
                       class="btn btn-primary px-5 py-2 rounded-xl shadow-sm">
                        Login
                    </a>
                @endguest
            </div>

            {{-- ================= HAMBURGER ================= --}}
            <div class="sm:hidden">
                <button @click="open = !open"
                        class="text-xl px-3 py-2 rounded-lg"
                        style="color: var(--text-main);">
                    ☰
                </button>
            </div>
        </div>
    </div>

    {{-- ================= MOBILE MENU ================= --}}
    <div x-show="open" x-transition
         class="sm:hidden px-4 py-5 space-y-2"
         style="background: var(--bg-soft); border-top:1px solid var(--border-soft);">

        <a href="{{ route('beranda') }}" class="mobile-link">Beranda</a>
        <a href="{{ route('cart.index') }}" class="mobile-link">Keranjang</a>
        <a href="{{ route('about') }}" class="mobile-link">Tentang Kami</a>

        @auth
            <div class="flex items-center gap-3 mb-3">
                @if(Auth::user()->profile_photo)
                    <img src="{{ Auth::user()->profile_photo_url }}"
                         class="w-10 h-10 rounded-full object-cover border">
                @else
                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold"
                         style="background: var(--primary); color:white;">
                        {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                    </div>
                @endif

                <div class="text-sm font-medium" style="color: var(--text-main);">
                    {{ Auth::user()->name }}
                </div>
            </div>

            <a href="{{ route('user.orders') }}" class="mobile-link">📦 Riwayat Pesanan</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="mobile-link text-danger w-full text-left">
                    Logout
                </button>
            </form>
        @endauth

        @guest
            <a href="{{ route('login') }}" class="mobile-link">Login</a>
        @endguest
    </div>
</nav>