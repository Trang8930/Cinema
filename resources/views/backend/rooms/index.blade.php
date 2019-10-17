@extends('backend.layouts.main')

@section('title', __('Rooms'))

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ __('List Rooms')  }}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('home.index') }}"><i class="fa fa-dashboard"></i>{{ __('HomePage')  }}</a></li>
        <li class="active">{{ __('Rooms') }}</li>
      </ol>
    </section>
      <!-- Main content -->
        <section class="content">
        <input type="hidden" value="{{request()->has('check') ? request()->check : ''}}" id="show-message">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              {{-- Modal --}}
               {{-- @include('backend.cities.partials.create-modal')
               @include('backend.cities.partials.update-modal') --}}
               @include('backend.layouts.partials.delete-modal')
             {{-- \Modal --}}

              <section>
                <div class="create-area">
                  <a href="{{route('rooms.create')}}" class="btn btn-primary glyphicon glyphicon-plus create-city"></a>
                </div>
              </section>
             <div class="box-body">
              <table id="table-datatable" class="table table-bordered table-hover col-xs-12">
                <thead>
                  <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Room') }}</th>
                    <th>{{ __('Cinema') }}</th>
                    <th>{{ __('Seats Available') }}</th>
                    <th>{{ __('Seats Amount') }}</th>
                    <th>{{ __('Option') }}</th>
                  </tr>
                </thead>
                @if($rooms != null)
                <tbody>
                    @foreach ($rooms as $room)
                    <tr>
                        <td>{{ $room->id }}</td>
                        <td>{{ $room->name }}</td>
                        <td>{{ $room->cinema->name }}</td>
                        <td>{{ $room->seats_available }}</td>
                        <td>{{ $arrAmount[$room->name] }}</td>
                        <td class="text-center col-sm-1">
                            <a href="{{route('rooms.edit', $room->id)}}" class="glyphicon glyphicon-pencil bg-green option"></a>

                            <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" >
                                @method('DELETE')
                                @csrf
                                <button type="button"
                                class="glyphicon glyphicon-remove bg-purple option btn-delete"
                                data-title="{{__('Delete Room')}}"
                                data-content="{{__('Do you want to delete Room,  <b>') . $room->name . '</b>'}}"
                                data-toggle="modal"
                                data-target="#confirmModalDelete">
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                @endif
              </table>
                <section>
                  <div class="create-area pull-right">
                    <a href="{{route('rooms.create')}}" class="btn btn-primary glyphicon glyphicon-plus create-city"
                    data-toggle="modal" data-target="#createCityModal"></a>
                  </div>
                </section>
              </div>
            </div>
          </div>
        </div>
      </section>
  </div>
  <!-- /.content-wrapper -->
@endsection
