<div id="overlay" style="display: none;"></div>
  <div class="container">
    <div class="row">
    <div class="header-nav-wrapper">
      <div class="col-md-4 col-sm-4 col-xs-4">
      <div class="logo">
        <a href="/">
        <!-- <img src="/theme/galaxy-logo.png" alt="Galaxy Cinema" class="hidden-xs hidden-sm">
        <img src="/theme/galaxy-logo-mobile.png" alt="Galaxy Cinema" class="hidden-lg hidden-md"> -->
        <img src="/theme/logoweb.png" alt="Cinema" class="hidden-xs hidden-sm">
        <img src="/theme/LOGO.png" alt="Cinema" class="hidden-lg hidden-md">
        </a>
      </div>
      </div>
      <div class="col-md-8 col-sm-8 col-xs-8">
      <div class="primary-nav-wrapper desktop hidden-xs hidden-sm">
        <div class="search">
            <galaxy-search-bar class="ng-isolate-scope">
            <form id="search-form" ng-submit="submit()" class="ng-pristine ng-valid">
                <div class="input-append">
                    <input id="btn-search-header" placeholder="Tìm tên phim, diễn viên..." class="search-box ng-pristine ng-untouched ng-valid ng-empty" type="text" autocomplete="off" ng-model="searchKey" ng-model-options="{ updateOn: &quot;default blur&quot;, debounce: { default: 500, blur: 0 } }" ,="" ng-change="search(searchKey)">
                    <button type="submit" class="search-btn"><i class="fa fa-search"></i></button>
                    <!-- ngIf: dataSearch && dataSearch.items && dataSearch.items.length>0 -->
                </div>
            </form>
            </galaxy-search-bar>
        </div>
        <div class="secondary-nav-wrapper">
            <ul class="secondary-nav">
              @guest
                <li>
                  <a href="/login"><i class="fa fa-sign-in"></i>Đăng nhập</a>
                </li>
                <li>
                  <a href="/register"><i class="fa fa-sign-out"></i>Đăng ký</a>
                </li>
              @else  
                <li>
                  <div ng-if="userInfo.memberId" class="dropdown ng-scope">
                    <a href="#" data-toggle="dropdown" aria-expanded="false" class="dropdown-toggle ng-scope">
                      <i class="glyphicon glyphicon-user"></i><span class="ng-binding"> {{\Auth::user()->fullname}}</span>
                    </a>
                    <div class="dropdown-menu">
                      <a href="{{ route('users.show', Auth::user()->access_token) }}" class="dropdown-item">Tài khoản</a>
                      <form action="{{ route('logout') }}" method="POST">
                          {{csrf_field()}}
                          <button type="submit" name="logout" class="dropdown-item">
                            {{__('Đăng xuất')}}
                          </button>
                      </form>
                    </div>
                  </div>
                </li>
              @endguest  
              <li class="language hidden-xs">
              <a href="/" class="active">VN</a>
              <span>|</span>
              <a href="/en/">EN</a>
              </li>
            </ul>
        </div>
      </div>
      <div class="primary-nav-wrapper hidden-lg hidden-md">
        <div class="secondary-nav-wrapper">
            <ul class="secondary-nav">
                <li>
                  <a href="/login"><i class="icon-user"></i>Đăng nhập</a>
                </li>
            </ul>
        </div>
      </div>
      </div>
    </div>
    </div>
  </div>
  <div ng-controller="controller" class="galaxy-nav ng-scope">
    <div class="container">
        <div class="search hidden-lg hidden-md">
        <galaxy-search-bar class="ng-isolate-scope">
            <form id="search-form" ng-submit="submit()" class="ng-pristine ng-valid">
                <div class="input-append">
                    <input id="btn-search-header" placeholder="Tìm tên phim, diễn viên..." class="search-box ng-pristine ng-untouched ng-valid ng-empty" type="text" autocomplete="off" ng-model="searchKey" ng-model-options="{ updateOn: &quot;default blur&quot;, debounce: { default: 500, blur: 0 } }" ,="" ng-change="search(searchKey)">
                    <button type="submit" class="search-btn"><i class="fa fa-search"></i></button>
                    <!-- ngIf: dataSearch && dataSearch.items && dataSearch.items.length>0 -->
                </div>
            </form>
        </galaxy-search-bar>
        </div>
        <nav>
        <ul class="primary-nav">
            <li><a href="/lich-chieu">Mua vé</a></li>
            <li class="sub-nav">
                <a href="javascript:;">Phim</a>
                <div id="sub-menu">
                    <ul class="undefined">
                    <li><a href="/phim-dang-chieu">Phim đang chiếu</a></li>
                    <li><a href="/phim-sap-chieu">Phim sắp chiếu</a></li>
                    </ul>
                </div>
                <div id="sub-menu-movie" class="hidden-sm hidden-xs">
                    <div class="visible-lg-block">
                    <div class="row submenu-title">
                    <div class="col-sm-12">
                        <h3><a href="/phim-dang-chieu">Phim đang chiếu</a></h3>
                    </div>
                    </div>
                    <div class="row movies-group-header">
                    <div ng-repeat="movie in item.movieShowing | limitTo:4" class="col-sm-3 ng-scope">
                        <article style="background-image: url(https://galaxycine.vn/media/2019/9/3/450x300_1567492110333.jpg)" class="article-movie-header">
                        <a href="/dat-ve/nguoi-la-oi" style="width:100%;">
                        <figure>
                        <figcaption class="overlay">
                            <div class="movies-content-header">
                            <galaxy-icon-movie ng-age="movie.age" class="ng-isolate-scope"></galaxy-icon-movie>
                            <div class="group">
                            <div class="btn secondary-white btn-header">Mua vé</div>
                            </div>
                            </div>
                        </figcaption>
                        </figure>
                        </a>
                        </article>
                        <div class="title-movie-header">
                        <h4 class="upper-text ng-binding">Người Lạ Ơi</h4>
                        <h4 class="vn upper-text ng-binding"></h4>
                        </div>
                    </div> 
                    <div class="row submenu-title">
                        <div class="col-sm-12">
                        <h3><a href="/phim-sap-chieu">Phim sắp chiếu</a></h3>
                        </div>
                    </div>
                    <div class="row movies-group-header">
                        <div ng-repeat="movie in item.movieCommingSoon | limitTo:4" class="col-sm-3 ng-scope">
                            <article style="background-image: url(https://galaxycine.vn/media/2019/9/12/450x300_1568282812114.jpg)" class="article-movie-header">
                            <a href="/dat-ve/anna" style="width:100%;">
                            <figure>
                                <figcaption class="overlay">
                                <div class="movies-content-header">
                                <galaxy-icon-movie ng-age="movie.age" class="ng-isolate-scope"></galaxy-icon-movie>
                                <div class="group">
                                <div class="btn secondary-white btn-header">Mua vé</div>
                                </div>
                                </div>
                                </figcaption>
                            </figure>
                            </a>
                            </article>
                            <div class="title-movie-header">
                            <h4 class="upper-text ng-binding">Anna</h4>
                            <h4 class="vn upper-text ng-binding">Sát Thủ Anna</h4>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
                </div> 
            </li>
            <li class="sub-nav">
                <a href="javascript:;">Góc điện ảnh</a>
                <div id="sub-menu">
                    <ul class="undefined">
                    <li><a href="/dien-anh">Thể loại phim</a></li>
                    <li><a href="/dien-vien">Diễn viên</a></li>
                    <li><a href="/dao-dien">Đạo diễn</a></li>
                    <li><a href="/binh-luan-phim">Bình luận phim</a></li>
                    <li><a href="/movie-blog">Blog điện ảnh</a></li>
                    </ul>
                </div>
            </li>
            <li class="sub-nav">
                <a href="javascript:;">Sự kiện</a>
                <div id="sub-menu">
                    <ul class="undefined">
                    <li><a href="/khuyen-mai">Ưu đãi</a></li>
                    <li><a href="/phim-hay">Phim hay tháng</a></li>
                    </ul>
                </div>
            </li>
            <li><a href="/rap-gia-ve">Rạp/Giá Vé</a></li>
            <li><a href="/gop-y">Hỗ trợ</a></li>
            <li><a href="/chinh-sach">Thành viên</a></li>
        </ul>
        </nav>
    </div>
  </div>
  <div class="navicon">
    <a href="/#" class="nav-toggle"><span></span></a>
  </div>