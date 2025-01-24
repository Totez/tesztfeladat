<div class="modal fade" id="projectModal" tabindex="-1" aria-labelledby="projectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
            <p id="modalProjectName"></p>
            <div id="timer" style="font-size:35px;">
                <span id="hour">00</span>:<span id="minute">00</span>:<span id="second">00</span>
            </div>

            <textarea class="d-none form-control" id="modalProjectMemo"></textarea>
        </div>
        <div class="modal-footer">

            <div class="row w-100">
                <div class="col-6">
                    <button id="startButton" class="form-control btn btn-success">Start</button>
                </div>
                <div class="col-6">
                    <button id="stopButton" class="form-control btn btn-danger" disabled>Stop</button>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
