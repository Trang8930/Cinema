@extends('master')
@section('title','Movie Star')
@section('content')

<div class="container mt-4">
    @if($result->isNotEmpty())
    <h4 class="pdc-hover" style="text-decoration: none;color: black">Kết quả tìm kiểm với
        <span style="color: red">{{$search}}</span>
    </h4>
    <div class="row">
        @foreach ($result as $pdc)
        <div class="col-sm-3 col-md-3 col-xs-6">
            <div class="moviedangchieu">
                <img src="/anhda4/phim/{{$pdc->image}}" width="100%" height="350px">
                <a href="{{url('phim',$pdc->id)}}">
                    <div class="decription-hover overlay">
                        <div class="decription-content">
                            <button class="btn btn-outline-danger">MUA VÉ</button>
                        </div>
                    </div>
                </a>
            </div>
            <div class="tieudephimdc mt-2">
                <h6 class="text-uppercase mb-0">{{$pdc->tenphim}}</h6>
                <h6 class="text-uppercase en">
                    {!!str_replace($search,'<strong>'.$search.'</strong>', $pdc->tentienganh)!!}
                </h6>
            </div>
        </div>
        @endforeach


    </div>
    @else
    <h4 class="pdc-hover">Không tìm thấy kết quả tìm kiếm với <span style="color: red">{{$search}}</span></h4>
    @endif
</div>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <a href="" class="text-dark">
                <h3 class="psc">Review Phim</h3>
            </a>
            @foreach ($review as $r)
            <div class="blog row mt-3 mb-4">
                <div class="col-md-4">
                    <a href="review/{{$r->id}}"><img src="/anhda4/tintuc/{{$r->image}}" width="170px"></a>
                </div>
                <div class="col-md-8"><a href="review/{{$r->id}}" style="text-decoration: none; color:black">
                        <h5>{{$r->tieude}}</h5>
                    </a></div>
            </div>
            @endforeach

        </div>
        <div class="col-md-6 col-xs-12">
            <a href="" class="text-dark">
                <h3 class="psc">Blog</h3>
            </a>
            @foreach ($blog as $b)
            <div class="blog row mt-3 mb-4">
                <div class="col-md-4">
                    <a href="blog/{{$b->id}}"><img src="/anhda4/tintuc/{{$b->image}}" width="170px"></a>
                </div>
                <div class="col-md-8"><a href="blog/{{$b->id}}" style="text-decoration: none; color:black">
                        <h5>{{$b->tieude}}</h5>
                    </a></div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<div class="container mt-3">
    <div class="gioithieu">
        <h3 class="psc">GIỚI THIỆU</h3>
        <div>
            <p>STAR MOVIE là một trong những công ty tư nhân đầu tiên về điện ảnh được thành lập từ năm 2003, đã khẳng
                định thương hiệu là 1 trong 10 địa điểm vui chơi giải trí được yêu thích nhất. Ngoài hệ thống rạp chiếu
                phim hiện đại, thu hút hàng triệu lượt người đến xem, STAR MOVIE còn hấp dẫn khán giả bởi không khí thân
                thiện cũng như chất lượng dịch vụ hàng đầu.</p>
            <p>Đặt vé tại STAR MOVIE dễ dàng chỉ sau vài thao tác vô cùng đơn giản. Để mua vé, hãy vào tab Mua vé. Quý
                khách có thể chọn Mua vé theo phim, theo rạp, theo ngày tùy cách nào tiện lợi nhất cho bản thân.Sau đó,
                tiến hành mua vé theo các bước hướng dẫn. Chỉ trong vài phút, quý khách sẽ nhận được tin nhắn và email
                phản hồi Đặt vé thành công của STAR MOVIE. Quý khách có thể dùng tin nhắn lấy vé tại quầy vé của STAR
                MOVIE hoặc quét mã QR để một bước vào rạp mà không cần tốn thêm bất kỳ công đoạn nào nữa.</p>
            <p>Nếu chưa quyết định sẽ xem phim mới nào, hãy tham khảo các bộ phim hay trong mục Phim Đang Chiếu cũng như
                Phim Sắp Chiếu tại rạp chiếu phim bằng cách vào mục Bình Luận Phim ở Góc Điện Ảnh để đọc những bài bình
                luận chân thật nhất, tham khảo và cân nhắc. Sau đó, quý khách hãy đặt vé bằng box Mua Vé Nhanh ngay ở
                đầu trang để chọn được suất chiếu và chỗ ngồi vừa ý nhất.</p>
            <p>Hiện nay, STAR MOVIE đang ngày càng phát triển hơn nữa với các chương trình đặc sắc, các khuyến mãi hấp
                dẫn, đem đến cho khán giả những bộ phim bom tấn của thế giới và Việt Nam nhanh chóng và sớm nhất.</p>
        </div>
    </div>
</div>
@endsection