@extends('backend.layouts.main')

@section('title', __('Update Film'))

@section('content')
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <h1 class="title-page text-success">
        {{ __('Update Film') }}
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
            <form role="form" method="POST" action="{{ route('films.update', $film->id) }}" enctype='multipart/form-data'>
              {!! csrf_field() !!}
              @method('PUT')

              <div class="box-body">
                <div class="form-group has-feedback {{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name">{{ __('Name') }}</label>
                  <input type="text" class="form-control" name= "name" id="name" placeholder="{{ __('Enter Name') }}" value="{{ old('name', $film->name) }}">
                  <small class="text-danger">{{ $errors->first('name') }}</small>
                </div>

                <div class="form-group has-feedback {{ $errors->has('year') ? ' has-error' : '' }}">
                  <label for="year">{{ __('Year') }}</label>
                  <input type="year" class="form-control" name= "year" id="year" placeholder="{{ __('Enter Year') }}" value="{{ old('year', $film->year) }}">
                  <small class="text-danger">{{ $errors->first('year') }}</small>
                </div>

                <div class="form-group has-feedback {{ $errors->has('price') ? ' has-error' : '' }}">
                  <label for="price">{{ __('Price') }}</label>
                  <input type="number" class="form-control" name= "price" id="price" placeholder="{{ __('Enter Price') }}" value="{{ old('price', $film->price) }}">
                  <small class="text-danger">{{ $errors->first('price') }}</small>
                </div>

                <div class="form-group has-feedback {{ $errors->has('author') ? ' has-error' : '' }}">
                  <label for="author">{{ __('Author') }}</label>
                  <input type="text" class="form-control" name= "author" id="author" placeholder="{{ __('Enter Author') }}" value="{{ old('author', $film->author) }}">
                  <small class="text-danger">{{ $errors->first('author') }}</small>
                </div>

                <div class="form-group has-feedback {{ $errors->has('actor') ? ' has-error' : '' }}">
                  <label for="actor">{{ __('Actor') }}</label>
                  <input type="text" class="form-control" name= "actor" id="actor" placeholder="{{ __('Enter Actor') }}" value="{{ old('actor', $film->actor) }}">
                  <small class="text-danger">{{ $errors->first('actor') }}</small>
                </div>

                <div class="form-group has-feedback {{ $errors->has('genre') ? ' has-error' : '' }}">
                  <label for="genre">{{ __('Genre') }}</label>
                @foreach(\App\Models\Film::$genre as $genre => $value)
                  <input type="checkbox" name="genre[]" value="{{$genre}}" {{in_array($genre,$genres) ? 'checked' : ''}}>{{$value}}
                @endforeach
                  <small class="text-danger">{{ $errors->first('genre') }}</small>
                </div>

                <div class="form-group has-feedback {{ $errors->has('time_limit') ? ' has-error' : '' }}">
                  <label for="time_limit">{{ __('Time Limit') }}</label>
                  <input type="text" class="form-control" name= "time_limit" id="time_limit" placeholder="{{ __('Example: 120') }}" value="{{ old('time_limit', $film->time_limit) }}">
                  <small class="text-danger">{{ $errors->first('time_limit') }}</small>
                </div>

                <div class="form-group has-feedback {{ $errors->has('kind') ? ' has-error' : '' }}">
                  <label for="kind">{{ __('Kind') }}</label>
                  @foreach(\App\Models\Film::$kind as $kind => $value)
                  <input type="checkbox" name="kind[]" value="{{$kind}}" {{in_array($kind,$kinds) ? 'checked' : ''}}>{{$value}}
                  @endforeach
                  <small class="text-danger">{{ $errors->first('kind') }}</small>
                </div>

                <div class="form-group has-feedback {{ $errors->has('image') ? ' has-error' : '' }}">
                  <label for="image">{{ __('Image') }}</label>
                  <p id="show-img">
                    <img id="img-db" class="img-100-100" src="/fe_images/{{$film->image}}">
                    <img id="img-local" class="img-100-100" src="">
                  </p>
                  <input type="file" class="form-control" name= "image" id="image" placeholder="{{ __('Enter Image') }}" value="{{ old('image') }}">
                  <small class="text-danger">{{ $errors->first('image') }}</small>
                </div>

                <div class="form-group has-feedback {{ $errors->has('video_url') ? ' has-error' : '' }}">
                  <label for="video_url">{{ __('Video Url') }}</label>
                  <input type="text" class="width-210" value="https://www.youtube.com/embed/" disabled>
                  <input type="text" class="" name="video_url" id="video_url" placeholder="{{ __('Example: 9JvqTwbJXEY') }}" value="{{ old('video_url', $film->video_url) }}">
                  <small class="text-danger">{{ $errors->first('video_url') }}</small>
                </div>

                <div class="form-group has-feedback {{ $errors->has('video_url') ? ' has-error' : '' }}">
                    <label for="content" >{{ __('Content') }}</label> <br>
                    <textarea name="content" id="content" cols="100" rows="5">{{ old('video_url', $film->content) }}</textarea>
                    <small class="text-danger">{{ $errors->first('content') }}</small>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{{ route('films.index') }}" class="btn btn-default">
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
