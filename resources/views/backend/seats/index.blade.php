@extends('backend.layouts.main')

@section('title', __('Seats'))

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ __('List Seats')  }}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('home.index') }}"><i class="fa fa-dashboard"></i>{{ __('HomePage')  }}</a></li>
        <li class="active">{{ __('Seats') }}</li>
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
                <div class="create-area pull-left">
                    <a href="{{route('seats.create')}}" class="btn btn-primary glyphicon glyphicon-plus create-city"></a>
                </div>

                <div class="filter create-area pull-right">
                  <form action="{{ route('seats.index') }}" method="GET">
                    @csrf
                    <label>{{ __('Room') }}:</label>
                    <select name="room_id" class="select room_id">
                        <option value="">All</option>
                        @foreach ($cinemas as $cinema)
                        <optgroup label="{{$cinema->name}}">
                          {{$rooms = $cinema->rooms}}
                          @foreach ($rooms as $room)
                            <option value="{{$room->id}}" {{ (old('room_id', request()->room_id) == $room->id) ? 'selected' : '' }}>{{$room->name}}</option>
                          @endforeach
                        </optgroup>
                        @endforeach
                    </select>

                    <button type="submit">Filter</button>
                  </form>
                </div>
            </section>
            
            <div class="box-body clr">
              <table id="table-datatable" class="table table-bordered table-hover col-xs-12">
                <thead>
                  <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Room') }}</th>
                    <th>{{ __('Y Seats') }}</th>
                    <th>{{ __('X Seats') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Option') }}</th>
                  </tr>
                </thead>
                @if($seats != null)
                <tbody>
                    @foreach ($seats as $seat)
                    <tr>
                        <td>{{ $seat->id }}</td>
                        <td id="name-city-{{ $seat->id }}">{{ $seat->room->name }}</td>
                        <td>{{ $seat->y_seats }}</td>
                        <td>{{ $seat->x_seats }}</td>
                        <td class="text-center">
                            @if ($seat->status == App\Models\Seat::IS_AVAILABLE)
                            <a href="#" id="status-{{$seat->id}}" 
                              class="btn-change-status btn btn-success" 
                              data-title="{{__('Change Status')}}"
                              data-content="{{__('Do you want to change status of <b>') . $seat->name . '</b>'}}"
                              data-id='{{$seat->id}}'
                              data-toggle="modal"
                              data-target="#changeStatusModal">
                              Available
                            </a>
                            @else
                            <a href="#" id="status-{{$seat->id}}" 
                              class="btn-change-status btn btn-default text-center" 
                              data-title="{{__('Change Status')}}"
                              data-content="{{__('Do you want to change status of <b>') . $seat->name . '</b>'}}"
                              data-id='{{$seat->id}}'
                              data-toggle="modal"
                              data-target="#changeStatusModal" >
                              Not
                            </a>
                            @endif                            
                        </td>
                        <td class="text-center col-sm-1">
                            <a href="{{ route('seats.edit', $seat->id) }}" class="glyphicon glyphicon-pencil bg-green option"></a>

                            <form action="{{ route('seats.destroy', $seat->id) }}" method="POST" >
                                @method('DELETE')
                                @csrf
                                <button type="button"
                                class="glyphicon glyphicon-remove bg-purple option btn-delete"
                                data-title="{{__('Delete Seat')}}"
                                data-content="{{__('Do you want to delete Seat-<b>') . $seat->y_seats.$seat->x_seats . '</b>'}}"
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
                <!-- .pagination -->
                <div class="text-center">
                  <nav aria-label="...">
                    <ul class="pagination">
                      @if($seats instanceof \Illuminate\Pagination\AbstractPaginator)
                        {{  $seats->appends(['page' => \Request::get('page'), 'room_id' => \Request::get('room_id')])->links() }}
                      @endif
                    </ul>
                  </nav>
                </div>
                <!-- /.pagination -->
                <section>
                  <div class="create-area pull-right">
                    <a href="{{route('seats.create')}}" class="btn btn-primary glyphicon glyphicon-plus create-city"></a>
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
@section("script")
<script src="{{asset('js/seat.js')}}"></script>
@endsection

