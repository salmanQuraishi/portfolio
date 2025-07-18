<div>
    <footer class="tj-footer-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="footer-logo-box">
                        <a href="#"><img src="assets/img/logo/logo.png" alt=""></a>
                    </div>
                    <div class="footer-menu">
                        <nav>
                            <ul>
                                @foreach ($menuData['footerMenu'] as $menuItem)
                                <li><a href="{{ url($menuItem->menu_link) }}">{{ $menuItem->menu_name }}</a></li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                    <div class="copy-text">
                        <p>&copy; {{ date('Y') }} All rights reserved by <a href="javascript:void(0)">{{ $settings->title }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
