<div id="klusje-{{$appr->id}}-afwijzen" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Klusje afwijzen: {{$appr->title}}</h4>
      </div>
      <div class="modal-body">
        <form class="denyTask" id="denyTask-{{$appr->id}}" action="/admin/klusje/{{$appr->id}}/afwijzen" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="taskID" id="taskID" value="{{$appr->id}}">
            <div class="form-group">
                <label for="denyReason">Reden voor afwijzing:</label>
                <textarea name="denyReason" form="denyTask-{{$appr->id}}" id="denyReason" class="form-control" rows="4" cols="80"></textarea>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="denyTask-{{$appr->id}}" class="btn btn-danger">Klusje afwijzen</button>
      </div>
    </div>
  </div>
</div>
