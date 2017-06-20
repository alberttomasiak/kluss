<div id="addSettingModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nieuwe globale instelling toevoegen</h4>
      </div>
      <div class="modal-body">
        <form class="add--setting-form" id="add--setting-form" action="/admin/setting/add" method="post">
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="settingKey">Naam setting (geen spaties)</label>
                <input type="text" name="settingKey" id="settingKey" class="form-control" placeholder="Naam setting" value="">
            </div>
            <div class="form-group">
                <label for="settingValue">Waarde setting</label>
                <input type="text" name="settingValue" id="settingValue" class="form-control" placeholder="Waarde setting" value="">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="add--setting-form" class="btn btn-success">Instelling toevoegen</button>
      </div>
    </div>
  </div>
</div>
