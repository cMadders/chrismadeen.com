    <!-- Modal -->
    <div class="modal fade cgm-modal" id="dateModalCenter" tabindex="-1" role="dialog" aria-labelledby="dateModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered cgm-modal-dialogue" role="document">
        <div class="modal-content container-fluid">
            <div class="modal-header">
              <h5 class="modal-title" id="dateModalLongTitle">Choose Date Range</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body form-container row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 centered-items">
                    <label>Start</label>
                    <input type="date" class="form-control" id="modal_start_date">
                </div>
              <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 centered-items">
                <label>End</label>
                <input type="date" class="form-control" id="modal_end_date">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" id="date_modal_save">Save</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
      </div>
    </div>