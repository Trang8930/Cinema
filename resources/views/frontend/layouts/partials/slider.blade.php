<div id="overlay" style="display: none;"></div>
  <div class="container">
    <div class="row">
    <div class="header-nav-wrapper">
      <div class="col-md-4 col-sm-4 col-xs-4">
      <div class="logo">
        <a href="https://www.galaxycine.vn/">
        <img src="/theme/galaxy-logo.png" alt="Galaxy Cinema" class="hidden-xs hidden-sm">
        <img src="/theme/galaxy-logo-mobile.png" alt="Galaxy Cinema" class="hidden-lg hidden-md">
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
          <li>
          <a id="loginLink" href="https://www.galaxycine.vn/#" ng-show="!userInfo.memberId" ng-click="openLogin()"><i class="fa fa-user"></i>Đăng nhập</a>
          </li>
          <li class="language hidden-xs">
          <a href="https://www.galaxycine.vn/" class="active">VN</a>
          <span>|</span>
          <a href="https://www.galaxycine.vn/en/">EN</a>
          </li>
        </ul>
        </div>
      </div>
      <div class="primary-nav-wrapper hidden-lg hidden-md">
        <div class="secondary-nav-wrapper">
        <ul class="secondary-nav">
          <li>
          <a id="loginLinkMobile" href="https://www.galaxycine.vn/#" ng-show="!userInfo.memberId" ng-click="openLogin()"><i class="icon-user"></i>Đăng nhập</a>
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
      <li><a href="https://www.galaxycine.vn/lich-chieu">Mua vé</a></li>
      <li class="sub-nav">
        <a href="javascript:;">Phim</a>
        <div id="sub-menu">
        <ul class="undefined">
          <li><a href="https://www.galaxycine.vn/phim-dang-chieu">Phim đang chiếu</a></li>
          <li><a href="https://www.galaxycine.vn/phim-sap-chieu">Phim sắp chiếu</a></li>
        </ul>
        </div>
        <div id="sub-menu-movie" class="hidden-sm hidden-xs">
        <div class="visible-lg-block">
          <div class="row submenu-title">
          <div class="col-sm-12">
            <h3><a href="https://www.galaxycine.vn/phim-dang-chieu">Phim đang chiếu</a></h3>
          </div>
          </div>
          <div class="row movies-group-header">
          <div ng-repeat="movie in item.movieShowing | limitTo:4" class="col-sm-3 ng-scope">
            <article style="background-image: url(https://galaxycine.vn/media/2019/9/3/450x300_1567492110333.jpg)" class="article-movie-header">
            <a href="https://www.galaxycine.vn/dat-ve/nguoi-la-oi" style="width:100%;">
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
          <div ng-repeat="movie in item.movieShowing | limitTo:4" class="col-sm-3 ng-scope">
            <article style="background-image: url(https://galaxycine.vn/media/2019/9/3/450x300_1567492110333.jpg)" class="article-movie-header">
              <a href="https://www.galaxycine.vn/dat-ve/nguoi-la-oi" style="width:100%;">
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
          <div ng-repeat="movie in item.movieShowing | limitTo:4" class="col-sm-3 ng-scope">
            <article style="background-image: url(https://galaxycine.vn/media/2019/9/3/450x300_1567492110333.jpg)" class="article-movie-header">
              <a href="https://www.galaxycine.vn/dat-ve/nguoi-la-oi" style="width:100%;">
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
          <div ng-repeat="movie in item.movieShowing | limitTo:4" class="col-sm-3 ng-scope">
            <article style="background-image: url(https://galaxycine.vn/media/2019/9/3/450x300_1567492110333.jpg)" class="article-movie-header">
              <a href="https://www.galaxycine.vn/dat-ve/nguoi-la-oi" style="width:100%;">
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
            <h3><a href="https://www.galaxycine.vn/phim-sap-chieu">Phim sắp chiếu</a></h3>
            </div>
          </div>
          <div class="row movies-group-header">
            <div ng-repeat="movie in item.movieCommingSoon | limitTo:4" class="col-sm-3 ng-scope">
            <article style="background-image: url(https://galaxycine.vn/media/2019/9/12/450x300_1568282812114.jpg)" class="article-movie-header">
              <a href="https://www.galaxycine.vn/dat-ve/anna" style="width:100%;">
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
            <div ng-repeat="movie in item.movieCommingSoon | limitTo:4" class="col-sm-3 ng-scope">
              <article style="background-image: url(https://galaxycine.vn/media/2019/9/12/450x300_1568282812114.jpg)" class="article-movie-header">
              <a href="https://www.galaxycine.vn/dat-ve/anna" style="width:100%;">
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
            <div ng-repeat="movie in item.movieCommingSoon | limitTo:4" class="col-sm-3 ng-scope">
              <article style="background-image: url(https://galaxycine.vn/media/2019/9/12/450x300_1568282812114.jpg)" class="article-movie-header">
              <a href="https://www.galaxycine.vn/dat-ve/anna" style="width:100%;">
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
            <div ng-repeat="movie in item.movieCommingSoon | limitTo:4" class="col-sm-3 ng-scope">
              <article style="background-image: url(https://galaxycine.vn/media/2019/9/12/450x300_1568282812114.jpg)" class="article-movie-header">
                <a href="https://www.galaxycine.vn/dat-ve/anna" style="width:100%;">
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
          <li><a href="https://www.galaxycine.vn/dien-anh">Thể loại phim</a></li>
          <li><a href="https://www.galaxycine.vn/dien-vien">Diễn viên</a></li>
          <li><a href="https://www.galaxycine.vn/dao-dien">Đạo diễn</a></li>
          <li><a href="https://www.galaxycine.vn/binh-luan-phim">Bình luận phim</a></li>
          <li><a href="https://www.galaxycine.vn/movie-blog">Blog điện ảnh</a></li>
        </ul>
        </div>
      </li>
      <li class="sub-nav">
        <a href="javascript:;">Sự kiện</a>
        <div id="sub-menu">
        <ul class="undefined">
          <li><a href="https://www.galaxycine.vn/khuyen-mai">Ưu đãi</a></li>
          <li><a href="https://www.galaxycine.vn/phim-hay">Phim hay tháng</a></li>
        </ul>
        </div>
      </li>
      <li><a href="https://www.galaxycine.vn/rap-gia-ve">Rạp/Giá Vé</a></li>
      <li><a href="https://www.galaxycine.vn/gop-y">Hỗ trợ</a></li>
      <li><a href="https://www.galaxycine.vn/chinh-sach">Thành viên</a></li>
      </ul>
    </nav>
    </div>
  </div>
  <div class="navicon">
    <a href="https://www.galaxycine.vn/#" class="nav-toggle"><span></span></a>
  </div>