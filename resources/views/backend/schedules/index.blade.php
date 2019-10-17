@extends('backend.layouts.main')

@section('title', __('Schedules'))

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ __('List Schedules')  }}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('home.index') }}"><i class="fa fa-dashboard"></i>{{ __('HomePage')  }}</a></li>
        <li class="active">{{ __('Schedules') }}</li>
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
                  <a href="{{route('schedules.create')}}" class="btn btn-primary glyphicon glyphicon-plus create-city"></a>
                </div>
              </section>
             <div class="box-body">
              <table id="table-datatable" class="table table-bordered table-hover col-xs-12">
                <thead>
                  <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Room') }}</th>
                    <th>{{ __('Film') }}</th>
                    <th>{{ __('Time Start') }}</th>
                    <th>{{ __('Time Finish') }}</th>
                    <th>{{ __('Date') }}</th>
                    <th>{{ __('Option') }}</th>
                  </tr>
                </thead>
                @if($schedules != null)
                <tbody>
                    @foreach ($schedules as $schedule)
                    <tr>
                        <td>{{ $schedule->id }}</td>
                        <td>{{ $schedule->room->name }}</td>
                        <td>{{ $schedule->film->name }}</td>
                        <td>{{ $schedule->time_start }}</td>
                        <td>{{ $schedule->time_finish }}</td>
                        <td>{{ \Carbon\Carbon::parse($schedule->date)->format('d-m-Y') }}</td>
                        <td class="text-center col-sm-1">
                            <a href="{{ route('schedules.edit', $schedule->id) }}" class="glyphicon glyphicon-pencil bg-green option"></a>

                            <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" >
                                @method('DELETE')
                                @csrf
                                <button type="button"
                                class="glyphicon glyphicon-remove bg-purple option btn-delete"
                                data-title="{{__('Delete Schedule')}}"
                                data-content="{{__('Do you want to delete Schedule,  <b>No ') . $schedule->id . '</b>'}}"
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
                      @if($schedules instanceof \Illuminate\Pagination\AbstractPaginator)
                        {{  $schedules ->links() }}
                      @endif
                    </ul>
                  </nav>
                </div>
                <!-- /.pagination -->
                <section>
                  <div class="create-area pull-right">
                    <a href="{{route('schedules.create')}}" class="btn btn-primary glyphicon glyphicon-plus create-city"></a>
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

@section('script')
<script src="{{ asset('js/city.js') }}"></script>
@endsection
