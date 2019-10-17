@extends('frontend.layouts.main')

@section('title', __('Trang chủ'))

@section('content')
  <script>
    $(document).ready(function () {
    $('#main-carousel .item-slide').click(function (e) {
      var obj = $(this);
      if (e.target.tagName == 'A' || e.target.tagName == 'BUTTON') {
      e.preventDefault();
      return;
      }
      if (obj.hasClass('item-slide')) {
      window.location.href = obj.attr('link');
      return;
      }
    });
    $('#main-carousel .carousel-control').click(function (e) {
      var obj = $(this);
      if (obj.hasClass('carousel-control')) {
      $(".carousel").carousel(obj.data('slide'));
      }
    });
    $('.carousel').bcSwipe({ threshold: 50});
    })
  </script>

  <div id="main-carousel" data-ride="carousel" data-interval="3000" class="carousel slide">
    <div role="listbox" class="carousel-inner">
    <div href="/dat-ve/love-battle" link="/dat-ve/love-battle" class="item item-slide active">
      <img src="/theme/2048x682_1568280843793.jpg" class="hidden-xs hidden-sm">
      <img src="/theme/1042x347_1568280849689.jpg" class="hidden-md hidden-lg">
      <div class="container content-wrap">
      </div>
    </div>
    <div href="/dat-ve/love-battle" link="/dat-ve/love-battle" class="item item-slide">
      <img src="/theme/2048x682_1568280843793.jpg" class="hidden-xs hidden-sm">
      <img src="/theme/1042x347_1568280849689.jpg" class="hidden-md hidden-lg">
      <div class="container content-wrap">
      </div>
    </div>
    <a role="button" data-slide="prev" ng-non-bindable="" class="left carousel-control hidden-xs hidden-sm">
      <span aria-hidden="true" class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a role="button" data-slide="next" ng-non-bindable="" class="right carousel-control hidden-xs hidden-sm">
      <span aria-hidden="true" class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
    </div>
    <div class="container">
    <div class="row">
      <div class="col-md-12">
      <div class="tab-movies">
        <div class="tab-movies-line">
        <ul class="nav nav-tabs movie-home">
          <li class="active"><a href="https://www.galaxycine.vn/#tab_default_1" data-toggle="tab">Phim đang chiếu</a></li>
          <li><a href="https://www.galaxycine.vn/#tab_default_2" data-toggle="tab">Phim sắp chiếu</a></li>
        </ul>
        <div class="tab-content">
          <div id="tab_default_1" class="tab-pane active">
          <div class="row movies-group animated fadeInUp">
            @foreach ($films as $film)
              <div class="col-md-4 col-sm-4 col-xs-6 movie-item">
                <div class="article-movie-home">
                  <img src="/fe_images/{{$film->image}}">
                  <a href="#">
                  <div class="decription-hover overlay">
                    <div class="movies-content">
                    <i class="icon-c16"></i>
                    <div class="group">
                      <div class="btn secondary-white">mua vé</div>
                    </div>
                    </div>
                  </div>
                  </a>
                </div>
                <div class="title-movie">
                  <h4 class="upper-text">{{$film->name}}</h4>
                  <h4 class="vn upper-text"></h4>
                </div>
              </div>
            @endforeach
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 pull-right">
            <a href="/phim-dang-chieu" class="btn secondary fl-right">Xem thêm</a>
            </div>
          </div>
          </div>
          <div id="tab_default_2" class="tab-pane">
          <div class="row movies-group animated fadeInUp">
            <div class="col-md-4 col-sm-4 col-xs-6 movie-item">
              <div class="article-movie-home">
              <img src="/theme/450x300_1567492110333.jpg">
              <a href="https://www.galaxycine.vn/dat-ve/nguoi-la-oi">
                <div class="decription-hover overlay">
                <div class="movies-content">
                  <i class="icon-c16"></i>
                  <div class="group">
                  <div class="btn secondary-white">mua vé</div>
                  </div>
                </div>
                </div>
              </a>
              </div>
              <div class="title-movie">
              <h4 class="upper-text">Người Lạ Ơi</h4>
              <h4 class="vn upper-text"></h4>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 pull-right">
            <a href="/phim-dang-chieu" class="btn secondary fl-right">Xem thêm</a>
            </div>
          </div>
          </div>
        </div>
        </div>
      </div>
      </div>
    </div>
    </div>
  </div>
  
  <div class="container">
    <section id="comment-blog">
      <div class="row">
        <div class="col-md-6 col-xs-12">
          <a href="https://www.galaxycine.vn/binh-luan-phim" class="title-block">
            <h3>Bình luận phim</h3>
          </a>
          <article class="blog">
            <div class="movie-thumb">
            <a href="https://www.galaxycine.vn/binh-luan-phim/preview-bad-boys-for-life-nhung-ga-trai-hu-chinh-thuc-quay-tro-lai-man-anh-rong" class="has-overlay"><img src="/theme/450x300_1568255955763.jpg">
            </a>
            </div>
            <h5>
            <a href="https://www.galaxycine.vn/binh-luan-phim/preview-bad-boys-for-life-nhung-ga-trai-hu-chinh-thuc-quay-tro-lai-man-anh-rong">
              [Preview] Bad Boys For Life: "Những Gã Trai Hư" Chính Thức Quay Trở Lại Màn Ảnh Rộng
            </a>
            </h5>
            <div class="blog-content hidden-xs">
            <p>
              <span style="font-size:14px;">
              <span style="font-family:Arial,Helvetica,sans-serif;">
                Thương hiệu hành động Bad Boys (Những Chàng Trai Hư) với bộ đôi ngôi sao Will Smith và Martin Lawrence sẽ tái ngộ khán giả trong phần ba mang tên Bad Boys For Life (Những Gã Trai Hư Trọn Đời).</span>
              </span>
            </p>
            </div>
          </article>
        </div>
        <div class="col-md-6 col-xs-12">
          <a href="https://www.galaxycine.vn/movie-blog" class="title-block">
            <h3>Blog điện ảnh</h3>
          </a>
          <article class="blog">
            <div class="movie-thumb">
            <a href="https://www.galaxycine.vn/movie-blog/it-he-lo-nhung-diem-khac-biet-giua-phim-va-tieu-thuyet" class="has-overlay">
              <img src="/theme/450x300c_1568272640591.jpg">
            </a>
            </div>
            <h5>
            <a href="https://www.galaxycine.vn/movie-blog/it-he-lo-nhung-diem-khac-biet-giua-phim-va-tieu-thuyet">IT: Sự Biến Mất Của Nhân Vật Này Đã Thay Đổi Kết Thúc Phim</a>
            </h5>
            <div class="blog-content hidden-xs">
            <p>
              <span style="font-size:14px;">
              <span style="font-family:Arial,Helvetica,sans-serif;">
                <span style="line-height:115%">
                <span style="line-height:115%">Đạo diễn Andrés Muschietti đã chia sẻ những&nbsp;điểm khác biệt giữa tiểu thuyết gốc và phiên bản phim về tên hề ma quái Pennywise.
                </span>
                </span>
              </span>
              </span>
            </p>
            </div>
          </article>
        </div>
      </div>
    </section>

    <div class="row">
      <div class="col-md-12 col-xs-12">
        <section id="promotion">
          <a href="https://www.galaxycine.vn/khuyen-mai" class="title-block">
            <h3>Tin khuyến mãi</h3>
          </a>
          <div class="row promotion">
            <div class="col-md-3 col-sm-4 col-xs-6 promotion-item">
              <div class="promotion-item-home">
                <a href="https://www.galaxycine.vn/khuyen-mai/cap-nhat-thong-tin-g-star-2019">
                <img src="/theme/300x450_1560498889489.jpg">
                </a>
                <div class="decription-hover overlay hidden-xs">
                <a href="https://www.galaxycine.vn/khuyen-mai/cap-nhat-thong-tin-g-star-2019">
                  <div class="info">
                  <h2>Cập Nhật Thông Tin G-Star 2019</h2>
                  <p></p>
                  <p>
                    <span style="font-size:14px;">
                    <span style="font-family:Arial,Helvetica,sans-serif;"><!--| -->
                      <span style="line-height:115%">
                      <span style="line-height:115%">
                        Để <b>Galaxy Cinema</b> có thể trao thêm nhiều ưu đãi tới các khách hàng thành viên Gstars, từ 14.06-07.07.2019, quý khách hàng vui lòng cập nhật đầy đủ những thông tin cần có.
                      </span>
                      </span>
                    </span>
                    </span>
                  </p>
                  <p></p>
                  </div>
                </a>
                <div class="group">
                  <a href="https://www.galaxycine.vn/khuyen-mai/cap-nhat-thong-tin-g-star-2019"></a>
                  <a href="https://www.galaxycine.vn/khuyen-mai/cap-nhat-thong-tin-g-star-2019" class="btn secondary-white">chi tiết</a>
                </div>
                </div>
              </div>
            </div>
          </div>  
        </section>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 col-xs-12">
        <section id="content-seo">
          <h3>Galaxy Cinema</h3>
          <div class="row content-seo">
            <div class="col-md-12">
              <div class="content-text">
                <p style="margin-top:0in; margin-right:0in; margin-bottom:10.0pt; margin-left:0in; text-align:justify"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><a href="https://www.galaxycine.vn/"><b><span style="font-size:10.5pt"><span style="font-family:&quot;Cambria&quot;,&quot;serif&quot;">Galaxy Cinema</span></span></b></a><span style="font-size:10.5pt"><span style="font-family:&quot;Cambria&quot;,&quot;serif&quot;">&nbsp;là một trong những công ty tư nhân đầu tiên về điện ảnh được thành lập từ năm 2003, đã khẳng định thương hiệu là 1 trong 10 địa điểm vui chơi giải trí được yêu thích nhất. Ngoài hệ thống rạp chiếu phim hiện đại, thu hút hàng triệu lượt người đến xem, <a href="https://www.galaxycine.vn/"><b>Galaxy Cinema</b></a> còn hấp dẫn khán giả bởi không khí thân thiện cũng như chất lượng dịch vụ hàng đầu.</span></span></span></span></p>

                <p style="margin-top:0in; margin-right:0in; margin-bottom:10.0pt; margin-left:0in; text-align:justify"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><span style="font-size:10.5pt"><span style="font-family:&quot;Cambria&quot;,&quot;serif&quot;">Đến website <a href="https://www.galaxycine.vn/"><i>galaxycine.vn</i></a>, quý khách sẽ được cập nhật nhanh chóng các <a href="https://www.galaxycine.vn/phim-dang-chieu"><i>phim hay nhất</i></a> <a href="https://www.galaxycine.vn/phim-dang-chieu"><i>phim mới nhất</i></a> đang chiếu hoặc sắp chiếu. <a href="https://www.galaxycine.vn/lich-chieu"><i>Lịch chiếu</i></a> tại mọi hệ thống <a href="https://www.galaxycine.vn/"><i>rạp chiếu phim</i> </a>của <a href="https://www.galaxycine.vn/"><b>Galaxy Cinema</b></a> cũng được cập nhật đầy đủ hàng ngày hàng giờ trên<i> trang chủ</i>. </span></span></span></span></p>

                <p style="margin-top:0in; margin-right:0in; margin-bottom:10.0pt; margin-left:0in; text-align:justify"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><span style="font-size:10.5pt"><span style="font-family:&quot;Cambria&quot;,&quot;serif&quot;">Đặt vé tại <b><a href="https://www.galaxycine.vn/">Galaxy Cinema</a> </b>dễ dàng chỉ sau vài thao tác vô cùng đơn giản. Để mua vé, hãy vào tab Mua vé. Quý khách có thể chọn Mua vé theo phim, theo rạp, theo ngày tùy cách nào tiện lợi nhất cho bản thân.Sau đó, tiến hành mua vé theo các bước hướng dẫn. Chỉ trong vài phút, quý khách sẽ nhận được tin nhắn và email phản hồi <i>Đặt vé thành công</i> của <a href="https://www.galaxycine.vn/"><b>Galaxy Cinema</b></a>. Quý khách có thể dùng tin nhắn lấy vé tại quầy vé của<a href="https://www.galaxycine.vn/"> <b>Galaxy Cinema</b></a> hoặc quét mã QR để một bước vào rạp mà không cần tốn thêm bất kỳ công đoạn nào nữa.</span></span></span></span></p>

                <p style="margin-top:0in; margin-right:0in; margin-bottom:10.0pt; margin-left:0in; text-align:justify"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><span style="font-size:10.5pt"><span style="font-family:&quot;Cambria&quot;,&quot;serif&quot;">Nếu bạn đã chọn được <a href="https://www.galaxycine.vn/phim-dang-chieu"><i>phim hay</i></a> để xem, hãy đặt vé cực nhanh bằng box <i>Mua Vé Nhanh</i> ngay từ <a href="https://www.galaxycine.vn/"><i>Trang Chủ</i></a>. Chỉ cần một phút, tin nhắn và email phản hồi của <b><a href="https://www.galaxycine.vn/">Galaxy Cinema</a> </b>sẽ gửi ngay vào điện thoại và hộp mail của bạn. </span></span></span></span></p>

                <p style="margin-top:0in; margin-right:0in; margin-bottom:10.0pt; margin-left:0in; text-align:justify"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><span style="font-size:10.5pt"><span style="font-family:&quot;Cambria&quot;,&quot;serif&quot;">Nếu chưa quyết định sẽ xem <i>phim mới</i> nào, hãy tham khảo các bộ<a href="https://www.galaxycine.vn/phim-dang-chieu"> <i>phim hay</i></a> trong mục<a href="https://www.galaxycine.vn/phim-dang-chieu"> <i>Phim Đang Chiếu</i></a> cũng như <a href="https://www.galaxycine.vn/phim-sap-chieu"><i>Phim Sắp Chiếu</i> </a>tại <a href="https://www.galaxycine.vn/"><i>rạp chiếu phim</i></a> bằng cách vào mục <a href="https://www.galaxycine.vn/binh-luan-phim"><i>Bình Luận Phim</i></a> ở <i><a href="http://beta.galaxycine.vn/dien-anh">Góc Điện Ảnh</a> </i>để đọc những bài bình luận chân thật nhất, tham khảo và cân nhắc. Sau đó, quý khách hãy đặt vé bằng box <i>Mua Vé Nhanh</i> ngay ở đầu trang để chọn được suất chiếu và chỗ ngồi vừa ý nhất. &nbsp;</span></span></span></span></p>

                <p style="margin-top:0in; margin-right:0in; margin-bottom:10.0pt; margin-left:0in; text-align:justify"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><a href="https://www.galaxycine.vn/"><b><span style="font-size:10.5pt"><span style="font-family:&quot;Cambria&quot;,&quot;serif&quot;">Galaxy Cinema</span></span></b></a><span style="font-size:10.5pt"><span style="font-family:&quot;Cambria&quot;,&quot;serif&quot;"> luôn có những chương trình<a href="https://www.galaxycine.vn/khuyen-mai"> <i>khuyến mãi</i>, <i>ưu đãi</i></a>, quà tặng vô cùng hấp dẫn như <i>giảm giá</i> vé, tặng vé xem phim miễn phí, tặng Combo, tặng quà phim… &nbsp;dành cho quý khách. </span></span></span></span></p>

                <p style="margin-top:0in; margin-right:0in; margin-bottom:10.0pt; margin-left:0in; text-align:justify"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><span style="font-size:10.5pt"><span style="font-family:&quot;Cambria&quot;,&quot;serif&quot;">Trang web <i>galaxycine.vn</i> còn có mục <i>Góc Điện Ảnh</i> - sở hữu lượng dữ liệu về phim, diễn viên và đạo diễn, giúp quý khách dễ dàng chọn được phim mình yêu thích và nâng cao kiến thức về điện ảnh của bản thân. Ngoài ra, vào mỗi tháng, <a href="https://www.galaxycine.vn/"><strong>Galaxy Cinema</strong> </a>cũng giới thiệu các <a href="https://www.galaxycine.vn/phim-sap-chieu"><i>phim sắp chiếu</i></a> hot nhất trong mục <a href="https://www.galaxycine.vn/phim-hay"><i>Phim Hay Tháng</i> </a>để quý khách sớm có sự tính toán.</span></span></span></span></p>

                <p style="margin-top:0in; margin-right:0in; margin-bottom:10.0pt; margin-left:0in; text-align:justify"><span style="font-size:12pt"><span style="font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><span style="font-size:10.5pt"><span style="font-family:&quot;Cambria&quot;,&quot;serif&quot;">Hiện nay, <a href="https://www.galaxycine.vn/"><strong><span style="font-family:&quot;Cambria&quot;,&quot;serif&quot;">Galaxy Cinema</span></strong></a> đang ngày càng phát triển hơn nữa với các chương trình đặc sắc, các khuyến mãi hấp dẫn, đem đến cho khán giả những bộ phim bom tấn của thế giới và Việt Nam nhanh chóng và sớm nhất.</span></span></span></span></p>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
@endsection
