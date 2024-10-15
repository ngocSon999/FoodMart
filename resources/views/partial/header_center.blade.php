<div class="container-fluid">
    <div class="row py-3">
        <div class="d-flex  justify-content-center justify-content-sm-between align-items-center">
            <nav class="main-menu d-flex navbar navbar-expand-lg">

                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasNavbar"
                        aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header justify-content-center">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close">
                        </button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="dropdown" style="margin-top: 10px;">
                            @if(empty($slug))
                                @foreach($trademarks as $key => $trademark)
                                    @if($key === 0 &&  $trademark->name)
                                        <span style="color: black; cursor: pointer; margin-right: 12px" class="dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ $trademark->name }}
                                        </span>
                                    @endif
                                @endforeach
                            @else
                                @foreach($trademarks as $key => $trademark)
                                    @if($slug !== '' && $slug === $trademark->slug)
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ $trademark->name }}
                                        </button>
                                    @endif
                                @endforeach
                            @endif
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                @foreach($trademarks as $trademark)
                                    @if($trademark->parent_id == null)
                                        <li>
                                            <a class="dropdown-item" href="{{ route('web.home', ['slug' => $trademark->slug]) }}">
                                                {{ $trademark->name }}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>


                        <ul class="navbar-nav justify-content-end menu-list list-unstyled d-flex gap-md-3 mb-0">
                            @if(empty($slug))
                                @foreach($trademarks as $key => $trademark)
                                    @foreach($trademarks as $item)
                                        @if($trademark->id === $item->parent_id && $key === 0)
                                            <li class="nav-item active">
                                                <a href="{{ route('web.trademark.slug', ['trademark' => $trademark->slug, 'slug' => $item->slug]) }}" class="nav-link">{{ $item->name }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                @endforeach
                            @else
                                @foreach($trademarks as $key => $trademark)
                                    @foreach($trademarks as $item)
                                        @if($trademark->id === $item->parent_id && $trademark->slug == $slug)
                                            <li class="nav-item active">
                                                <a href="{{ route('web.trademark.slug', ['trademark' => $trademark->slug, 'slug' => $slug]) }}" class="nav-link">{{ $item->name }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endif
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" role="button" id="pages"
                                   data-bs-toggle="dropdown" aria-expanded="false">Pages</a>
                                <ul class="dropdown-menu" aria-labelledby="pages">
                                    <li><a href="index.html" class="dropdown-item">About Us </a></li>
                                    <li><a href="index.html" class="dropdown-item">Shop </a></li>
                                    <li><a href="index.html" class="dropdown-item">Single Product </a></li>
                                    <li><a href="index.html" class="dropdown-item">Cart </a></li>
                                    <li><a href="index.html" class="dropdown-item">Checkout </a></li>
                                    <li><a href="index.html" class="dropdown-item">Blog </a></li>
                                    <li><a href="index.html" class="dropdown-item">Single Post </a></li>
                                    <li><a href="index.html" class="dropdown-item">Styles </a></li>
                                    <li><a href="index.html" class="dropdown-item">Contact </a></li>
                                    <li><a href="index.html" class="dropdown-item">Thank You </a></li>
                                    <li><a href="index.html" class="dropdown-item">My Account </a></li>
                                    <li><a href="index.html" class="dropdown-item">404 Error </a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#brand" class="nav-link">Brand</a>
                            </li>
                            <li class="nav-item">
                                <a href="#sale" class="nav-link">Sale</a>
                            </li>
                            <li class="nav-item">
                                <a href="#blog" class="nav-link">Blog</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
