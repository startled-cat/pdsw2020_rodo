<div class="modal fade" id="changePassModal" tabindex="-1" role="dialog" aria-labelledby="changePassModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="changePassModalLabel">Change password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form>
            <div class="form-group">
            <label for="recipient-name" class="col-form-label">Old password:</label>
            <input type="password" class="form-control" id="oldpass">
            </div>
            <div class="form-group">
            <label for="message-text" class="col-form-label">New password:</label>
            <input type="password" class="form-control" id="newpass">
            </div>
        </form>
        </div>
        <div id="changePassResponseInfo"></div>
        <div class="modal-footer">
        <button type="button" class="btn btn-light btn-lg btn-block btn-outline-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-secondary btn-lg btn-block" style="margin-top:0" id="changePasswordButton">Change</button>
        </div>
    </div>
    </div>
</div>