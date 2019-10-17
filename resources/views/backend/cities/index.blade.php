@extends('backend.layouts.main')

@section('title', __('Cities'))

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ __('List Cities')  }}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('home.index') }}"><i class="fa fa-dashboard"></i>{{ __('HomePage')  }}</a></li>
        <li class="active">{{ __('Cities') }}</li>
      </ol>
    </section>
      <!-- Main content -->
        <section class="content">
        <input type="hidden" value="{{request()->has('check') ? request()->check : ''}}" id="show-message">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              {{-- Modal --}}
               @include('backend.cities.partials.create-modal')
               @include('backend.cities.partials.update-modal')
               @include('backend.layouts.partials.delete-modal')
             {{-- \Modal --}}

              <section>
                <div class="create-area">
                  <a href="#" class="btn btn-primary glyphicon glyphicon-plus create-city"
                  data-toggle="modal" data-target="#createCityModal"></a>
                </div>
              </section>
             <div class="box-body">
              <table id="table-datatable" class="table table-bordered table-hover col-xs-12">
                <thead>
                  <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Option') }}</th>
                  </tr>
                </thead>
                @if($cities != null)
                <tbody>
                    @foreach ($cities as $city)
                    <tr>
                        <td>{{ $city->id }}</td>
                        <td id="name-city-{{ $city->id }}">{{ $city->name }}</td>
                        <td class="text-center col-sm-1">
                            <a href="#" class="glyphicon glyphicon-pencil bg-green option update-city" 
                            data-toggle="modal" data-target="#updateCityModal"
                            data-name="{{$city->name}}"
                            data-id="{{$city->id}}"></a>

                            <form action="{{ route('cities.destroy', $city->id) }}" method="POST" >
                                @method('DELETE')
                                @csrf
                                <button type="button"
                                class="glyphicon glyphicon-remove bg-purple option btn-delete"
                                data-title="{{__('Delete City')}}"
                                data-content="{{__('Do you want to delete all of city,  <b>') . $city->name . '</b>'}}"
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
                      @if($cities instanceof \Illuminate\Pagination\AbstractPaginator)
                        {{  $cities ->links() }}
                      @endif
                    </ul>
                  </nav>
                </div>
                <!-- /.pagination -->
                <section>
                  <div class="create-area pull-right">
                    <a href="#" class="btn btn-primary glyphicon glyphicon-plus create-city"
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

@section('script')
<script src="{{ asset('js/city.js') }}"></script>
@endsection
