<div class="nav-header">
    <a href="index.html" class="brand-logo">
        <img src="{{ asset('assets/images/png/' . (Auth::user()->role == 'distributor' ? 'logo_kota.png' : 'logo_kesehatan.png')) }}"
            width="50" alt="">
        <div class="brand-title">
            <h1 class="mb-0">SOBAT</h1>
        </div>

    </a>
    <div class="nav-control">
        <div class="hamburger">
            <span class="line"></span><span class="line"></span><span class="line"></span>
            <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="22" y="11" width="4" height="4" rx="2" fill="#2A353A" />
                <rect x="11" width="4" height="4" rx="2" fill="#2A353A" />
                <rect x="22" width="4" height="4" rx="2" fill="#2A353A" />
                <rect x="11" y="11" width="4" height="4" rx="2" fill="#2A353A" />
                <rect x="11" y="22" width="4" height="4" rx="2" fill="#2A353A" />
                <rect width="4" height="4" rx="2" fill="#2A353A" />
                <rect y="11" width="4" height="4" rx="2" fill="#2A353A" />
                <rect x="22" y="22" width="4" height="4" rx="2" fill="#2A353A" />
                <rect y="22" width="4" height="4" rx="2" fill="#2A353A" />
            </svg>
        </div>
    </div>
</div>