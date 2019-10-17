@extends('backend.layouts.main')

@section('title', __('Update Seat'))

@section('content')
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <h1 class="title-page text-success">
        {{ __('Update Seat') }}
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
            @if ($seat != null)
            <form role="form" method="POST" action="{{ route('seats.update', $seat->id) }}">
              {!! csrf_field() !!}
              @method('PUT')

              <div class="box-body">
                <div class="form-group has-feedback">
                    <label for="y_seats">{{ __('Seat') }}:</label>
                    <select name="y_seats" class="select">
                      @foreach (config('define.y_seats') as $ySeat)
                      <option value="{{$ySeat}}" {{ (old('y_seats', $seat->y_seats) == $ySeat) ? 'selected' : '' }}>{{$ySeat}}</option>
                      @endforeach
                  </select>

                  <select name="x_seats" class="select">
                    @for ($i = 1; $i <= 15; $i++)
                    <option value="{{$i}}" {{ (old('x_seats',$seat->x_seats) == $i) ? 'selected' : '' }}>{{$i}}</option>
                    @endfor
                  </select>
                </div>

                <div class="form-group has-feedback">
                    <label for="room_id">{{ __('Seat') }}:</label>
                    <select name="room_id" class="select">
                      @foreach ($rooms as $room)
                      <option value="{{$room->id}}" {{ (old('room_id', $seat->room_id) == $room->id) ? 'selected' : '' }}>{{$room->name}}</option>
                      @endforeach
                  </select>
                </div>

                <div class="form-group has-feedback">
                  <label>{{ __('Status') }}:</label>
                  <input type="radio" name="status" {{$seat->status == App\Models\Seat::IS_AVAILABLE ? 'checked' : ''}} value="1"> Available
                  <input type="radio" name="status" {{$seat->status == App\Models\Seat::NOT_AVAILABLE ? 'checked' : ''}} value="0"> Not
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
            @else 
            <h3>Seats is not exist</h3>
            @endif
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
