<script src="{{ asset('bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('bower_components/moment/min/moment-with-locales.min.js') }}"></script>
<script src="{{ asset('bower_components/moment/min/moment-with-locales.js') }}"></script>
<!-- Modal -->
<div class="modal fade" id="booking-ticket" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title">Cinemas List</h2>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <ul class="modal-date"></ul>
          <ul class="modal-city"></ul>
          <div class="modal-cinema"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-confirm" data-dismiss="modal">{{__('Close')}}</button>
        </div>
      </div>
      
    </div>
</div>
<script src="{{asset('fe_js/booking_film.js')}}"></script>