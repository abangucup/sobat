<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                    <div class="header-title">
                        <h3 class="mb-0">@yield('header')</h3>
                    </div>
                </div>
                <ul class="navbar-nav header-right">
                    <li class="nav-item dropdown notification_dropdown">
                        <a class="nav-link " href="javascript:void(0);" data-bs-toggle="dropdown">
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11 14.4375C9.1025 14.4375 7.5625 12.8975 7.5625 11C7.5625 9.1025 9.1025 7.5625 11 7.5625C12.8975 7.5625 14.4375 9.1025 14.4375 11C14.4375 12.8975 12.8975 14.4375 11 14.4375ZM11 8.9375C9.86333 8.9375 8.9375 9.86333 8.9375 11C8.9375 12.1367 9.86333 13.0625 11 13.0625C12.1367 13.0625 13.0625 12.1367 13.0625 11C13.0625 9.86333 12.1367 8.9375 11 8.9375Z"
                                    fill="var(--primary)" />
                                <path
                                    d="M13.9424 20.3408C13.7499 20.3408 13.5574 20.3133 13.3649 20.2674C12.7966 20.1116 12.3199 19.7541 12.0174 19.2499L11.9074 19.0666C11.3666 18.1316 10.6241 18.1316 10.0833 19.0666L9.98242 19.2408C9.67992 19.7541 9.20325 20.1208 8.63492 20.2674C8.05742 20.4233 7.46158 20.3408 6.95742 20.0383L5.38075 19.1308C4.82158 18.8099 4.41825 18.2874 4.24409 17.6549C4.07909 17.0224 4.16158 16.3716 4.48242 15.8124C4.74825 15.3449 4.82159 14.9233 4.66575 14.6574C4.50992 14.3916 4.11575 14.2358 3.57492 14.2358C2.23659 14.2358 1.14575 13.1449 1.14575 11.8066V10.1933C1.14575 8.85494 2.23659 7.7641 3.57492 7.7641C4.11575 7.7641 4.50992 7.60827 4.66575 7.34244C4.82159 7.0766 4.75742 6.65494 4.48242 6.18744C4.16158 5.62827 4.07909 4.96827 4.24409 4.34494C4.40909 3.71244 4.81242 3.18994 5.38075 2.8691L6.96658 1.9616C8.00242 1.34744 9.36825 1.70494 9.99158 2.7591L10.1016 2.94244C10.6424 3.87744 11.3849 3.87744 11.9258 2.94244L12.0266 2.76827C12.6499 1.70494 14.0158 1.34744 15.0608 1.97077L16.6374 2.87827C17.1966 3.1991 17.5999 3.7216 17.7741 4.3541C17.9391 4.9866 17.8566 5.63744 17.5357 6.1966C17.2699 6.6641 17.1966 7.08577 17.3524 7.3516C17.5083 7.61744 17.9024 7.77327 18.4433 7.77327C19.7816 7.77327 20.8724 8.8641 20.8724 10.2024V11.8158C20.8724 13.1541 19.7816 14.2449 18.4433 14.2449C17.9024 14.2449 17.5083 14.4008 17.3524 14.6666C17.1966 14.9324 17.2607 15.3541 17.5357 15.8216C17.8566 16.3808 17.9482 17.0408 17.7741 17.6641C17.6091 18.2966 17.2057 18.8191 16.6374 19.1399L15.0516 20.0474C14.7033 20.2399 14.3274 20.3408 13.9424 20.3408ZM10.9999 16.9491C11.8158 16.9491 12.5766 17.4624 13.0991 18.3699L13.1999 18.5441C13.3099 18.7366 13.4933 18.8741 13.7133 18.9291C13.9333 18.9841 14.1533 18.9566 14.3366 18.8466L15.9224 17.9299C16.1608 17.7924 16.3441 17.5633 16.4174 17.2883C16.4908 17.0133 16.4541 16.7291 16.3166 16.4908C15.7941 15.5924 15.7299 14.6666 16.1333 13.9608C16.5366 13.2549 17.3708 12.8516 18.4158 12.8516C19.0024 12.8516 19.4699 12.3841 19.4699 11.7974V10.1841C19.4699 9.6066 19.0024 9.12994 18.4158 9.12994C17.3708 9.12994 16.5366 8.7266 16.1333 8.02077C15.7299 7.31494 15.7941 6.3891 16.3166 5.49077C16.4541 5.25244 16.4908 4.96827 16.4174 4.69327C16.3441 4.41827 16.1699 4.19827 15.9316 4.0516L14.3458 3.1441C13.9516 2.90577 13.4291 3.04327 13.1908 3.4466L13.0899 3.62077C12.5674 4.52827 11.8066 5.0416 10.9908 5.0416C10.1749 5.0416 9.41408 4.52827 8.89158 3.62077L8.79075 3.43744C8.56158 3.05244 8.04825 2.91494 7.65408 3.1441L6.06825 4.06077C5.82992 4.19827 5.64658 4.42744 5.57325 4.70244C5.49992 4.97744 5.53658 5.2616 5.67408 5.49994C6.19658 6.39827 6.26075 7.3241 5.85742 8.02994C5.45408 8.73577 4.61992 9.1391 3.57492 9.1391C2.98825 9.1391 2.52075 9.6066 2.52075 10.1933V11.8066C2.52075 12.3841 2.98825 12.8608 3.57492 12.8608C4.61992 12.8608 5.45408 13.2641 5.85742 13.9699C6.26075 14.6758 6.19658 15.6016 5.67408 16.4999C5.53658 16.7383 5.49992 17.0224 5.57325 17.2974C5.64658 17.5724 5.82075 17.7924 6.05908 17.9391L7.64492 18.8466C7.83742 18.9658 8.06658 18.9933 8.27742 18.9383C8.49742 18.8833 8.68075 18.7366 8.79992 18.5441L8.90075 18.3699C9.42325 17.4716 10.1841 16.9491 10.9999 16.9491Z"
                                    fill="var(--primary)" />
                            </svg>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <div id="DZ_W_TimeLine02" class="widget-timeline dz-scroll style-1  p-3 height370">
                                <ul class="timeline">
                                    <li>
                                        <div class="timeline-badge primary"></div>
                                        <a class="timeline-panel text-muted" href="javascript:void(0);">
                                            <span>10 minutes ago</span>
                                            <h6 class="mb-0">Youtube, a video-sharing website, goes live <strong
                                                    class="text-primary">$500</strong>.</h6>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="timeline-badge info">
                                        </div>
                                        <a class="timeline-panel text-muted" href="javascript:void(0);">
                                            <span>20 minutes ago</span>
                                            <h6 class="mb-0">New order placed <strong
                                                    class="text-info">#XF-2356.</strong></h6>
                                            <p class="mb-0">Quisque a consequat ante Sit amet magna at
                                                volutapt...</p>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="timeline-badge danger">
                                        </div>
                                        <a class="timeline-panel text-muted" href="javascript:void(0);">
                                            <span>30 minutes ago</span>
                                            <h6 class="mb-0">john just buy your product <strong
                                                    class="text-warning">Sell $250</strong></h6>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="timeline-badge success">
                                        </div>
                                        <a class="timeline-panel text-muted" href="javascript:void(0);">
                                            <span>15 minutes ago</span>
                                            <h6 class="mb-0">StumbleUpon is acquired by eBay. </h6>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="timeline-badge warning">
                                        </div>
                                        <a class="timeline-panel text-muted" href="javascript:void(0);">
                                            <span>20 minutes ago</span>
                                            <h6 class="mb-0">Mashable, a news website and blog, goes live.</h6>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="timeline-badge dark">
                                        </div>
                                        <a class="timeline-panel text-muted" href="javascript:void(0);">
                                            <span>20 minutes ago</span>
                                            <h6 class="mb-0">Mashable, a news website and blog, goes live.</h6>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown notification_dropdown">
                        <a class="nav-link bell-icon " href="javascript:void(0);" role="button"
                            data-bs-toggle="dropdown">
                            <svg class="bell-animi" width="22" height="22" viewBox="0 0 22 22" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.0183 18.8193C8.88246 18.8193 6.74663 18.4801 4.72079 17.8018C3.95079 17.5359 3.36413 16.9951 3.10746 16.2893C2.84163 15.5834 2.93329 14.8043 3.35496 14.1076L4.40913 12.3568C4.62913 11.9901 4.83079 11.2568 4.83079 10.8259V8.17676C4.83079 4.76676 7.6083 1.98926 11.0183 1.98926C14.4283 1.98926 17.2058 4.76676 17.2058 8.17676V10.8259C17.2058 11.2476 17.4075 11.9901 17.6275 12.3659L18.6725 14.1076C19.0666 14.7676 19.14 15.5651 18.8741 16.2893C18.6083 17.0134 18.0308 17.5634 17.3066 17.8018C15.29 18.4801 13.1541 18.8193 11.0183 18.8193ZM11.0183 3.36426C8.36913 3.36426 6.20579 5.51842 6.20579 8.17676V10.8259C6.20579 11.4951 5.93079 12.4851 5.59163 13.0626L4.53746 14.8134C4.33579 15.1526 4.28079 15.5101 4.39996 15.8126C4.50996 16.1243 4.78496 16.3626 5.16079 16.4909C8.99246 17.7743 13.0533 17.7743 16.885 16.4909C17.215 16.3809 17.4716 16.1334 17.5908 15.8034C17.71 15.4734 17.6825 15.1159 17.4991 14.8134L16.445 13.0626C16.0966 12.4668 15.8308 11.4859 15.8308 10.8168V8.17676C15.8308 5.51842 13.6766 3.36426 11.0183 3.36426Z"
                                    fill="var(--primary)" />
                                <path
                                    d="M12.7232 3.61203C12.6591 3.61203 12.5949 3.60286 12.5307 3.58453C12.2649 3.5112 12.0082 3.4562 11.7607 3.41953C10.9816 3.3187 10.2299 3.3737 9.52407 3.58453C9.2674 3.66703 8.9924 3.58453 8.81823 3.39203C8.64407 3.19953 8.58907 2.92453 8.6899 2.67703C9.06573 1.71453 9.9824 1.08203 11.0274 1.08203C12.0724 1.08203 12.9891 1.70536 13.3649 2.67703C13.4566 2.92453 13.4107 3.19953 13.2366 3.39203C13.0991 3.5387 12.9066 3.61203 12.7232 3.61203Z"
                                    fill="var(--primary)" />
                                <path
                                    d="M11.0183 20.9092C10.1108 20.9092 9.23081 20.5425 8.58914 19.9008C7.94748 19.2592 7.58081 18.3792 7.58081 17.4717H8.95581C8.95581 18.0125 9.17581 18.5442 9.56081 18.9292C9.94581 19.3142 10.4775 19.5342 11.0183 19.5342C12.155 19.5342 13.0808 18.6083 13.0808 17.4717H14.4558C14.4558 19.3692 12.9158 20.9092 11.0183 20.9092Z"
                                    fill="var(--primary)" />
                            </svg>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end of-visible">
                            <div class="dropdown-header">
                                <h4 class="title mb-0">Notification</h4>
                                <a href="javascript:void(0);" class="d-none"><i class="flaticon-381-settings-6"></i></a>
                            </div>
                            <div id="DZ_W_Notification1" class="widget-media dz-scroll p-3" style="height:380px;">
                                <ul class="timeline">
                                    <li>
                                        <div class="timeline-panel">
                                            <div class="media me-2">
                                                <img alt="image" width="50" src="images/avatar/1.jpg">
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mb-1">Dr sultads Send you Photo</h6>
                                                <small class="d-block">29 July 2020 - 02:26 PM</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="timeline-panel">
                                            <div class="media me-2 media-info">
                                                KG
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mb-1">Resport created successfully</h6>
                                                <small class="d-block">29 July 2020 - 02:26 PM</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="timeline-panel">
                                            <div class="media me-2 media-success">
                                                <i class="fa fa-home"></i>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mb-1">Reminder : Treatment Time!</h6>
                                                <small class="d-block">29 July 2020 - 02:26 PM</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="timeline-panel">
                                            <div class="media me-2">
                                                <img alt="image" width="50" src="images/avatar/1.jpg">
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mb-1">Dr sultads Send you Photo</h6>
                                                <small class="d-block">29 July 2020 - 02:26 PM</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="timeline-panel">
                                            <div class="media me-2 media-danger">
                                                KG
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mb-1">Resport created successfully</h6>
                                                <small class="d-block">29 July 2020 - 02:26 PM</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="timeline-panel">
                                            <div class="media me-2 media-primary">
                                                <i class="fa fa-home"></i>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mb-1">Reminder : Treatment Time!</h6>
                                                <small class="d-block">29 July 2020 - 02:26 PM</small>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <a class="all-notification" href="javascript:void(0);">See all notifications <i
                                    class="ti-arrow-end"></i></a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown header-profile2">
                            <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <div class="header-info2 d-flex align-items-center">
                                    <div class="d-flex align-items-center sidebar-info">
                                        <div>
                                            <h4 class="mb-0">{{ Auth::user()->biodata->nama_lengkap }}</h4>
                                            <span class="d-block text-end">{{ Auth::user()->role }}</span>
                                        </div>
                                    </div>
                                    <img src="{{ Auth::user()->biodata->foto != null ? Auth::user()->biodata->foto : asset('assets/images/png/logo_kesehatan.png') }}"
                                        alt="">
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" style="">
                                <a href="app-profile.html" class="dropdown-item ai-icon ">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                        class="svg-main-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24" />
                                            <path
                                                d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                            <path
                                                d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                                fill="var(--primary)" fill-rule="nonzero" />
                                        </g>
                                    </svg>
                                    <span class="ms-2">Profile </span>
                                </a>
                                <a href="{{ route('logout') }}" class="dropdown-item ai-icon">
                                    <svg class="ms-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg>
                                    <span class="ms-2">Logout </span>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

</div>