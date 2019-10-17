@extends('backend.layouts.main')

@section('title', __('Create Seat'))

@section('content')
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <h1 class="title-page text-success">
        {{ __('Create Seat') }}
      </h1>
      <div class="row margin-center">
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title lead">{{ __('Enter information') }}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="{{ route('seats.store') }}">
              {!! csrf_field() !!}

              <div class="box-body">
                <div class="form-group has-feedback {{ $errors->has('y_seats') ? ' has-error' : '' }}">
                    <label for="y_seats">{{ __('Seat') }}:</label>
                    <select name="y_seats" class="select">
                      @foreach (config('define.y_seats') as $ySeat)
                      <option value="{{$ySeat}}" {{ (old('y_seats') == $ySeat) ? 'selected' : '' }}>{{$ySeat}}</option>
                      @endforeach
                  </select>
                  <small class="text-danger">{{ $errors->first('y_seats') }}</small>

                  <select name="x_seats" class="select">
                    @for ($i = 1; $i <= 15; $i++)
                    <option value="{{$i}}" {{ (old('x_seats') == $i) ? 'selected' : '' }}>{{$i}}</option>
                    @endfor
                  </select>
                  <small class="text-danger">{{ $errors->first('x_seats') }}</small>
                </div>

                <div class="form-group has-feedback {{ $errors->has('room_id') ? ' has-error' : '' }}">
                    <label for="room_id">{{ __('Seat') }}:</label>
                    <select name="room_id" class="select">
                      @foreach ($rooms as $room)
                      <option value="{{$room->id}}" {{ (old('room_id') == $room->id) ? 'selected' : '' }}>{{$room->name}}</option>
                      @endforeach
                  </select>
                  <small class="text-danger">{{ $errors->first('room_id') }}</small>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{{ route('seats.index') }}" class="btn btn-default">
                  {{ __('Back') }}
                </a>
                <button type="reset" class="btn btn-warning mr-10 btn-reset">{{ __('Reset') }}</button>
                <button type="submit" class="btn btn-primary mr-10 pull-right">{{ __('Submit') }}</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
