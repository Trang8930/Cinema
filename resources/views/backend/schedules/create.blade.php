@extends('backend.layouts.main')

@section('title', __('Create Schedule'))

@section('content')
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <h1 class="title-page text-success">
        {{ __('Create Schedule') }}
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
            <form role="form" method="POST" action="{{ route('schedules.store') }}" style="width: 50%">
              {!! csrf_field() !!}

              <div class="box-body">
                <div class="form-group has-feedback {{ $errors->has('cinema_id') ? ' has-error' : '' }}">
                    <label for="cinema_id">{{ __('Cinema') }}:</label>
                    <select name="cinema_id" class="select" id="cinema_id">
                        @foreach ($cinemas as $cinema)
                        <option value="{{$cinema->id}}" {{ (old('cinema_id') == $cinema->id) ? 'selected' : '' }}>{{$cinema->name}}</option>
                        @endforeach
                    </select>
                    <small class="text-danger">{{ $errors->first('room_id') }}</small>
                  </div>

                <div class="form-group has-feedback {{ $errors->has('room_id') ? ' has-error' : '' }}">
                  <label for="room_id">{{ __('Room') }}:</label>
                  <select name="room_id" class="select" id="room_id">
                      @foreach ($rooms as $room)
                      <option value="{{$room->id}}" {{ (old('room_id') == $room->id) ? 'selected' : '' }}>{{$room->name}}</option>
                      @endforeach
                  </select>
                  <small class="text-danger">{{ $errors->first('room_id') }}</small>
                </div>

                <div class="form-group has-feedback {{ $errors->has('film_id') ? ' has-error' : '' }}">
                    <label for="film_id">{{ __('Film') }}:</label>
                    <select name="film_id" class="select" id="film_id">
                        @foreach ($films as $film)
                        <option value="{{$film->id}}" {{ (old('film_id') == $film->id) ? 'selected' : '' }}>{{$film->name}}</option>
                        @endforeach
                    </select>
                    <small class="text-danger">{{ $errors->first('film_id') }}</small>

                    <label for="time_limit">{{ __('Time Limit') }}:</label>
                    <span id="time_limit">{{$timeLimit->time_limit}} minutes</span>
                </div>

                <div class="form-group has-feedback {{ $errors->has('date') ? ' has-error' : '' }}">
                  <label for="date">{{ __('Date') }}:</label>
                  <input type="date" name="date" value="" class="select" id="date-schedule" data-room="1">
                  <small class="text-danger">{{ $errors->first('date') }}</small>
                </div>
                
                <div class="form-group has-feedback {{ $errors->has('time_start') ? ' has-error' : '' }}">
                    <label for="time_start">{{ __('Time Start') }}:</label>
                    <input type="text" name="time_start" id="time_start" placeholder="Example: 07:05" class="select">
                    
                    <label for="time_finish">{{ __('Time Finish') }}:</label>
                    <span id="time_finish">0</span>
                    <input type="hidden" name="time_finish" id="time_finish_rq">
                    <div><small class="text-danger" id="error-time-start">{{ $errors->first('time_start') }}</small></div>
                </div>

              </div>
              
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{{ route('schedules.index') }}" class="btn btn-default">
                  {{ __('Back') }}
                </a>
                <button type="reset" class="btn btn-warning mr-10 btn-reset">{{ __('Reset') }}</button>
                <button type="submit" class="btn btn-primary mr-10 pull-right btn-submit">{{ __('Submit') }}</button>
              </div>
            </form>

            <div class="form-group pull-right" style="margin-top:-250px">
              <div>
                  <img class="img-schedule" {{empty($image) || $image == null ? $url = config('image.default_image') : $url = '/fe_images/' .$image}} src="{{ asset($url) }}" alt="">
              </div>
              <div>
                  @for($i = 8; $i <= 23; $i++)
                  <span style="margin-right: 7.5px">{{$i}}</span>
                  @endfor
              </div>

              <div class="timeline-schedule">
                <div></div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@section('script')
<script src="{{asset('js/schedule.js')}}"></script>
@endsection
