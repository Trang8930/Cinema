@extends('backend.layouts.main')

@section('title', __('Booking'))

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ __('List Booking Tickets')  }}
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
            <section>
                <div class="filter create-area pull-right">
                  <form action="{{ route('bookings.index') }}" method="GET">
                    @csrf
                    <label>{{ __('Date') }}:</label>
                    <select name="created_at" class="select">
                        <option value="">All</option>
                        @foreach ($createdAts as $val)
                            <option value="{{ $val }}" {{ $created == $val ? 'selected' : '' }}>{{ $val }}</option>
                        @endforeach
                    </select>

                    <button type="submit">Filter</button>
                  </form>
                </div>
            </section>
            
            <div class="box-body clr">
                <form action="{{route('bookings.export')}}" method="GET">
                    @csrf
                    <table id="table-datatable" class="table table-bordered table-hover col-xs-12">
                        <thead>
                        <tr>
                            <th>{{ __('ID') }}</th>
                            <th>{{ __('User') }}</th>
                            <th>{{ __('Total') }}</th>
                            <th>{{ __('Date') }}</th>
                        </tr>
                        </thead>
                        @if($bookings != null)
                        <tbody>
                                @foreach ($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->id }}</td>
                                    <td>{{ $booking->user_id != null ? $booking->user->fullname : null}}</td>
                                    <td>{{ $booking->total_price }}</td>
                                    <td>{{ date_format($booking->created_at, 'Y-m-d') }}</td>
                                </tr>
                                @endforeach
                        </tbody>
                        @endif
                    </table>
                    <input type="text" value="{{ $created }}" name="created" style="display:none">
                    <button type="submit" class="btn btn-primary">Export</button>
                </form>
                <!-- .pagination -->
                <div class="text-center">
                  <nav aria-label="...">
                    <ul class="pagination">
                      @if($bookings instanceof \Illuminate\Pagination\AbstractPaginator)
                        {{  $bookings->appends(['page' => \Request::get('page')])->links() }}
                      @endif
                    </ul>
                  </nav>
                </div>
                <!-- /.pagination -->
              </div>
            </div>
          </div>
        </div>
      </section>
  </div>
  <!-- /.content-wrapper -->
@endsection
{{-- @section("script")
<script src="{{asset('js/booking.js')}}"></script>
@endsection --}}

