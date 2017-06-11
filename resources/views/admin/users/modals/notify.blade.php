<div id="notify-user-{{$id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nieuwe globale notificatie</h4>
      </div>
      <div class="modal-body">
        <form class="notify--user-form" id="notify--user-form" action="/admin/notify/user/{{$id}}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="notification_msg">Bericht:</label>
                <textarea name="notification_msg" id="notification_msg" class="form-control" form="notify--user-form" rows="4" cols="80"></textarea>
            </div>
            <div class="form-group">
                <label for="notification_url">URL:</label>
                <input type="text" name="notification_url" id="notification_url" class="form-control" form="notify--user-form" value="">
            </div>
            <input type="hidden" name="notification_user" id="notification_user" value="{{$id}}">
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="notify--user-form" class="btn btn-success">Notificatie verzenden</button>
      </div>
    </div>
  </div>
</div>
