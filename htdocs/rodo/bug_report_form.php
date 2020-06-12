<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form action="<?php echo basename($_SERVER['PHP_SELF']); ?>" method="post" >
            <div class="modal-body">
                
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Message:</label>
                    <textarea class="form-control" name="message-text" id="message-text" method="post"></textarea>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-lg btn-block btn-outline-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" value="send_bug" class="btn btn-secondary btn-lg btn-block">Send message</button>
            </div>
        </form>
    </div>
    </div>
</div>
</div>