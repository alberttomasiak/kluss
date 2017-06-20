<div id="setting-{{$setting->id}}-edit" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Instelling bewerken: {{$setting->key}}</h4>
      </div>
      <div class="modal-body">
        <form class="edit-setting" id="edit-setting-{{$setting->id}}" action="/admin/setting/{{$setting->id}}/edit" method="post">
            {!! csrf_field() !!}
            <input type="hidden" name="settingID" id="settingID" value="{{$setting->id}}">
            <div class="form-group">
                <label for="settingKey">Naam setting (geen spaties)</label>
                <input type="text" name="settingKey" id="settingKey" class="form-control" placeholder="Naam setting" value="{{$setting->key}}">
            </div>
            <div class="form-group">
                <label for="settingValue">Waarde setting</label>
                <input type="text" name="settingValue" id="settingValue" class="form-control" placeholder="Waarde setting" value="{{$setting->value}}">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="edit-setting-{{$setting->id}}" class="btn btn-success">Instelling bewerken</button>
      </div>
    </div>
  </div>
</div>
