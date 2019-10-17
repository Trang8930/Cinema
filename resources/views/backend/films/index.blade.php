@extends('backend.layouts.main')

@section('title', __('Films'))

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ __('List Films')  }}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('home.index') }}"><i class="fa fa-dashboard"></i>{{ __('HomePage')  }}</a></li>
        <li class="active">{{ __('Films') }}</li>
      </ol>
    </section>
      <!-- Main content -->
        <section class="content">
        <input type="hidden" value="{{request()->has('check') ? request()->check : ''}}" id="show-message">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              {{-- Modal --}}
               @include('backend.layouts.partials.delete-modal')
               @include('backend.films.partials.modal')
               @include('backend.films.partials.import_modal')
             {{-- \Modal --}}

            @if(\Auth::user()->id == 1)
              <section>
                <div class="create-area">
                  <div>
                      <form action="{{route('films.import')}}" method="POST" id="import-film" class="{{ $errors->has('import_data') ? ' has-error' : '' }}" enctype="multipart/form-data">
                      @csrf
                        <input type="file" name="import_data" style="display:inline">
                        <small class="text-danger">{{ $errors->first('import_data') }}</small>
                        <button type="button" class="btn btn-success" id="import-btn" 
                          data-title="{{__('Import Data')}}"
                          data-content="{{__('Do you want to import file?')}}"
                          data-toggle="modal"
                          data-target="#importFile">Import</button>
                      </form>
                  </div>
                  <a href="{{ route('films.create') }}" class="btn btn-primary glyphicon glyphicon-plus"></a>
                </div>
              </section>
            @endif
             <div class="box-body">
              <table id="table-datatable" class="table table-bordered table-hover col-xs-12">
                <thead>
                  <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Year') }}</th>
                    <th>{{ __('Price') }}</th>
                    <th>{{ __('Author') }}</th>
                    <th>{{ __('Actor') }}</th>
                    <th>{{ __('Genre') }}</th>
                    <th>{{ __('Time Limit') }}</th>
                    <th>{{ __('Kind') }}</th>
                    <th>{{ __('Score') }}</th>
                    <th>{{ __('Image') }}</th>
                    <th>{{ __('Is Active') }}</th>
                    <th>{{ __('Option') }}</th>
                  </tr>
                </thead>
                @if($films != null)
                <tbody>
                    @foreach ($films as $film)
                    <tr class="text-center">
                        <td>{{ $film->id }}</td>
                        <td>{{ $film->name }}</td>
                        <td>{{ $film->year }}</td>
                        <td>{{ $film->price }}</td>
                        <td>{{ $film->author }}</td>
                        <td>{{ $film->actor }}</td>
                        <td>{{ $film->genre }}</td>
                        <td>{{ $film->time_limit }}</td>
                        <td>{{ $film->kind }}</td>
                        <td>{{ $film->avg_rating }}</td>
                        <td><img {{ $film->image != null ? $url= "/fe_images/".$film->image : $url=config('image.default_image') }} src="{{asset($url)}}" alt="" width="60px" height="50px"></td>
                        {{-- <td><iframe width="120px" height="100px" {{ $film->video_url != null ? $video=$film->video_url : $video=config('image.default_video') }} src="https://www.youtube.com/embed/{{$video}}" 
                            frameborder="0" class="video-js" data-id="$film-id" id="video-"></iframe></td> --}}
                      <td class="text-center">
                          @if ($film->is_active == App\Models\Film::IS_ACTIVE)
                          <a href="#" id="active-{{$film->id}}" 
                            class="btn-change-active btn btn-warning" 
                            data-title="{{__('Change Active')}}"
                            data-content="{{__('Do you want to change is_active of <b>') . $film->name . '</b>'}}"
                            data-id='{{$film->id}}'
                            data-toggle="modal"
                            data-target="#changeActiveModal">
                            Active
                          </a>
                          @else
                          <a href="#" id="active-{{$film->id}}" 
                            class="btn-change-active btn btn-default text-center" 
                            data-title="{{__('Change Active')}}"
                            data-content="{{__('Do you want to change is_active of <b>') . $film->name . '</b>'}}"
                            data-id='{{$film->id}}'
                            data-toggle="modal"
                            data-target="#changeActiveModal" >
                            Not
                          </a>
                          @endif                            
                        </td>
                        @if(\Auth::user()->id == 1)
                        <td class="text-center col-sm-1">
                            <a href="{{ route('films.edit', $film->id) }}" class="glyphicon glyphicon-pencil bg-green option update-city"></a>

                            <form action="{{ route('films.destroy', $film->id) }}" method="POST" >
                                @method('DELETE')
                                @csrf
                                <button type="button"
                                class="glyphicon glyphicon-remove bg-purple option btn-delete"
                                data-title="{{__('Delete film')}}"
                                data-content="{{__('Do you want to delete all of film,  <b>') . $film->name . '</b>'}}"
                                data-toggle="modal"
                                data-target="#confirmModalDelete">
                                </button>
                            </form>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
                @endif
              </table>
                <!-- .pagination -->
                <div class="text-center">
                  <nav aria-label="...">
                    <ul class="pagination">
                      @if($films instanceof \Illuminate\Pagination\AbstractPaginator)
                        {{  $films ->links() }}
                      @endif
                    </ul>
                  </nav>
                </div>
                <!-- /.pagination -->
                @if(\Auth::user()->id == 1)
                <section>
                  <div class="create-area pull-right">
                    <a href="{{ route('films.create') }}" class="btn btn-primary glyphicon glyphicon-plus"></a>
                  </div>
                </section>
                @endif
              </div>
            </div>
          </div>
        </div>
      </section>
  </div>
  <!-- /.content-wrapper -->
@endsection

@section('script')
<script src="{{ asset('js/film.js') }}"></script>
@endsection
