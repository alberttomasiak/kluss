<div id="addGlobalNotification" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nieuwe globale notificatie</h4>
      </div>
      <div class="modal-body">
        <form class="add--notification" id="add--notification" action="/admin/notification/add" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="notification_msg">Bericht:</label>
                <textarea name="notification_msg" id="notification_msg" class="form-control" form="add--notification" rows="4" cols="80"></textarea>
            </div>
            <div class="form-group">
                <label for="notification_url">URL:</label>
                <input type="text" name="notification_url" id="notification_url" class="form-control" form="add--notification" value="">
            </div>
            <input type="hidden" name="notification_user" id="notification_user" value="{{\Auth::user()->id}}">
            <input type="hidden" name="notification_channel" id="notification_channel" value="global-notifications">
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="add--notification" class="btn btn-success">Notificatie verzenden</button>
      </div>
    </div>
  </div>
</div>
