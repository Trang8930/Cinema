@extends('backend.layouts.main')

@section('title', __('Update Room'))

@section('content')
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <h1 class="title-page text-success">
        {{ __('Update Room') }}
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
            <form role="form" method="POST" action="{{ route('rooms.update', $room->id) }}">
              {!! csrf_field() !!}
              @method('PUT')
              <div class="box-body">
                <div class="form-group has-feedback {{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name">{{ __('Name') }}</label>
                  <input type="text" class="form-control" name= "name" id="name" placeholder="{{ __('Example: Superman Room') }}" value="{{ $room->name }}" style="width:400px">
                  <small class="text-danger">{{ $errors->first('name') }}</small>
                </div>

                <div class="form-group has-feedback {{ $errors->has('city_id') ? ' has-error' : '' }}">
                  <label for="city_id">{{ __('City') }}:</label>
                  <span><b>{{$cityName}}</b></span>
                </div>

                <div class="form-group has-feedback {{ $errors->has('cinema_id') ? ' has-error' : '' }}">
                  <label for="cinema_id">{{ __('Cinema') }}:</label>
                  <select name="cinema_id" class="select" id="cinema_id" {{\Auth::user()->id != \App\Models\User::ID_MASTER ? "disabled" : ""}}>
                      @foreach ($cinemas as $cinema)
                        <option value="{{$cinema->id}}" {{ ($room->cinema_id == $cinema->id) ? 'selected' : '' }}
                          {{\Auth::user()->id != \App\Models\User::ID_MASTER ? "disabled" : ""}}>{{$cinema->name}}</option>
                      @endforeach
                  </select>
                  <small class="text-danger">{{ $errors->first('cinema_id') }}</small>
                </div>

                <div class="form-group has-feedback {{ $errors->has('seats_amount') ? ' has-error' : '' }}">
                    <label for="seats_amount">{{ __('Seat Amount') }}</label>
                    <select name="seats_amount" class="select" id="seats_amount">
                        @for ($i = 1; $i <= 15; $i++)
                            <option value={{$i}} {{count($arrSeats) == $i ? "selected" : ""}}>{{$i}}</option>
                        @endfor
                    </select>
                    <button id="btn-confirm-seat" type="button">OK</button>
                    <small class="text-danger">{{ $errors->first('seats_amount') }}</small>
                </div>
            </div>
            <div class="list-seats form-group">
              <table class="table table-bordered table-hover col-xs-12 table-seats">
                  <thead>
                      <tr>
                          <th>{{__('Name Rows')}}</th>
                          <th>{{__('Amount')}}</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach($arrSeats as $key => $value)
                      <tr>
                      <td>{{$key}}</td>
                      <td>
                        <select name="{{$key}}" class='select'>
                          @for($i = 1; $i <= $value; $i++)
                        <option value="{{$i}}" {{$value == $i ? "selected" : ""}}>{{$i}}</option>
                          @endfor
                        </select>
                      </td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
            </div>
              <!-- /.box-body -->
            <div class="box-footer">
              <a href="{{ route('rooms.index') }}" class="btn btn-default">
                {{ __('Back') }}
              </a>
              <button type="reset" class="btn btn-warning mr-10 btn-reset" onclick="location.reload()">{{ __('Reset') }}</button>
              <button type="submit" class="btn btn-primary mr-10 pull-right">{{ __('Submit') }}</button>
            </div>
            </form>

           
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
@section('script')
<script src="{{ asset('js/room.js') }}"></script>
@endsection

