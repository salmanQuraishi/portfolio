<div>
    <!-- Preloader Area Start -->
    <div class="preloader">
        <svg viewbox="0 0 1000 1000" preserveaspectratio="none">
            <path id="preloaderSvg" d="M0,1005S175,995,500,995s500,5,500,5V0H0Z"></path>
        </svg>

        <div class="preloader-heading">
            <div class="load-text">
                @foreach (str_split($settings->preloader) as $letter)
                    <span>{{ $letter }}</span>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Preloader Area End -->

    <!-- start: Back To Top -->
    <div class="progress-wrap" id="scrollUp">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewbox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"></path>
        </svg>
    </div>
    <!-- end: Back To Top -->

    <!-- HEADER START -->
    <header class="tj-header-area header-absolute">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex align-items-center">
                {{-- <div class="col-12 d-flex flex-wrap align-items-center"> --}}
                    <div class="logo-box">
                        <a href="{{route('home')}}">
                            <img src="{{$settings->logo}}" alt="{{$settings->title}}">
                        </a>
                    </div>

                    <div class="header-menu" id="headerMenu">
                        <nav>
                            <ul>
                                @foreach ($menuData['headerMenu'] as $menuItem)
                                    @php
                                        if ($menuItem->menu_link == '/') {
                                            $isActive = Request::path() == '/' ? 'current-menu-ancestor' : '';
                                        } else {
                                            $isActive = Request::is(trim($menuItem->menu_link, '/')) ? 'current-menu-ancestor' : '';
                                        }
                                    @endphp
                                    <li class="{{ $isActive }}">
                                        <a href="{{ url($menuItem->menu_link) }}">{{ $menuItem->menu_name }}</a>
                                    </li>
                                @endforeach
                            </ul>                            
                        </nav>
                    </div>
                    <div class="mobile-menu d-lg-none"></div>
                    <div class="header-button">
                        <a href="contact" class="btn tj-btn-primary">Contact Us!</a>
                    </div>
                    <div class="menu-bar d-lg-none">
                        <button>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <header class="tj-header-area header-2 header-sticky sticky-out">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex align-items-center">
                {{-- <div class="col-12 d-flex flex-wrap align-items-center"> --}}
                    <div class="logo-box">
                        <a href="{{route('home')}}">
                            <img src="{{$settings->logo}}" alt="">
                        </a>
                    </div>

                    <div class="header-menu">
                        <nav>
                            <ul>
                                @foreach ($menuData['headerMenu'] as $menuItem)
                                    <li><a href="{{$menuItem->menu_link}}">{{$menuItem->menu_name}}</a></li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                    <div class="mobile-menu d-lg-none"></div>
                    <div class="header-button">
                        <a href="contact" class="btn tj-btn-primary">Contact Us!</a>
                    </div>
                    <div class="menu-bar d-lg-none">
                        <button>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- HEADER END -->
</div>