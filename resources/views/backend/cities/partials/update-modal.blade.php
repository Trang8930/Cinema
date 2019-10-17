<!-- Modal -->
<div class="modal fade" id="updateCityModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 class="modal-title">Update City</h2>
        </div>
        <form action="{{route('cities.store')}}" method="POST">
          @csrf
            <div class="modal-body form-group has-feedback">
                <label for="nameCityUpdate">{{ __('Name') }}</label>
                <input type="text" class="form-control" name= "name" id="nameCityUpdate" placeholder="{{ __('Enter Name') }}" value="{{ old('name') }}">
                <small class="text-danger"></small>
              </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary btn-confirm" data-status="true" id="updateCity">{{__('Update')}}</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Close')}}</button>
            </div>
        </form>
      </div>
      
    </div>
</div>
