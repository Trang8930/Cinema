@extends('.admin.layout')
@section('content')
<div class="page-holder w-100 d-flex flex-wrap">
  <div class="container-fluid px-xl-5">
    <section class="py-5">
      <div class="row">
       <div class="col-lg-12 mb-5">
        <div class="card">
          <div class="card-header">
            <h3 class="h6 text-uppercase mb-0">Chỉnh Sửa Phim</h3>
          </div>
          @foreach ($phim as $up)
          <div class="card-body">
            <form action="admin/formeditphim/{{$up->id}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
              {{ csrf_field() }}
             {{--  <input type="hidden" name="_token" value="{{ csrf_token() }} ?>"> --}}
              <div class="form-group row">
                <label class="col-md-3 form-control-label">Tên Phim</label>
                <div class="col-md-9">
                  <input id="inputHorizontalSuccess" name="tenphim" type="text" placeholder="Tên phim" value="{{$up->tenphim}}" class="form-control form-control-success ">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Tên Tiếng Anh</label>
                <div class="col-md-9">
                  <input id="inputHorizontalWarning" name="tenta" type="text" placeholder="Tên Tiếng Anh" value="{{$up->tentienganh}}" class="form-control form-control-warning ">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Ảnh Phim</label>
                <div class="col-md-9">
                  <input id="inputHorizontalWarning" name="anhphim" type="file" value="{{$up->image}}" class="form-control form-control-warning ">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Nhà Sản Xuất</label>
                <div class="col-md-9">
                  <input id="inputHorizontalWarning" name="nhasx" type="text" placeholder="Nhà sản xuất" value="{{$up->nsx}}" class="form-control form-control-warning ">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Thể loại</label>
                <div class="col-md-9">
                  <input id="inputHorizontalWarning" name="theloai" type="text" placeholder="Thể loại" value="{{$up->theloai}}" class="form-control form-control-warning ">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Quốc Gia</label>
                <div class="col-md-9">
                  <input id="inputHorizontalWarning" name="quocgia" type="text" placeholder="Quốc gia" value="{{$up->quocgia}}" class="form-control form-control-warning ">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Đạo Diễn</label>
                <div class="col-md-9">
                  <input id="inputHorizontalWarning" name="daodien" type="text" placeholder="Đại diễn" value="{{$up->daodien}}" class="form-control form-control-warning ">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Diễn Viên</label>
                <div class="col-md-9">
                  <input id="inputHorizontalWarning" name="dienvien" type="text" placeholder="Diễn viên" value="{{$up->dienvien}}" class="form-control form-control-warning ">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Thời lượng</label>
                <div class="col-md-9">
                  <input id="inputHorizontalWarning" name="thoiluong" type="text" placeholder="Thời lượng" value="{{$up->thoiluong}}" class="form-control form-control-warning ">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Ngày Khởi Chiếu</label>
                <div class="col-md-9">
                  <input id="inputHorizontalWarning" name="nkc" type="date" value="{{$up->ngaykhoichieu}}" class="form-control form-control-warning ">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Trạng Thái</label>
                <div class="col-md-9">
                 @if ($up->trangthai==1)
                 <div class="custom-control custom-radio custom-control-inline">
                  <input id="customRadioInline1" type="radio" name="radio" value="1" class="custom-control-input" checked>
                  <label for="customRadioInline1" class="custom-control-label">Phim Đang Chiếu</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input id="customRadioInline2" type="radio" name="radio" value="0" class="custom-control-input">
                  <label for="customRadioInline2" class="custom-control-label">Phim Sắp Chiếu</label>
                </div>
                @else
                <div class="custom-control custom-radio custom-control-inline">
                  <input id="customRadioInline1" type="radio" name="radio" value="1" class="custom-control-input">
                  <label for="customRadioInline1" class="custom-control-label">Phim Đang Chiếu</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input id="customRadioInline2" type="radio" name="radio" value="0" class="custom-control-input" checked>
                  <label for="customRadioInline2" class="custom-control-label">Phim Sắp Chiếu</label>
                </div>
                @endif

              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 form-control-label">Trailer</label>
              <div class="col-md-9">
                <textarea class="form-control " name="trailer" rows="5" id="trailerYT">{{$up->trailer}}</textarea><small class="form-text text-muted ml-3">Chú ý : Lấy mã nhúng video của YouTube</small>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 form-control-label">Nội Dung</label>
              <div class="col-md-9">
                <textarea class="form-control " name="nd" rows="5" id="noidung">{{$up->noidung}}</textarea>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 form-control-label">Giá Vé</label>
              <div class="col-md-9">
                <input id="inputHorizontalWarning" name="giave" type="text" placeholder="Giá vé" value="{{$up->giave}}" class="form-control form-control-warning ">
              </div>
            </div>
            @endforeach
            <div class="form-group row">       
                <div class="col-md-12 text-right">
                  <a href="{{route('qlyphim')}}" class="btn btn-danger">Hủy bỏ</a>
                <input type="submit" value="Cập nhật" class="btn btn-primary">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
</div>
@endsection