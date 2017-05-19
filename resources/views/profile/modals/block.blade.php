<div id="blockModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Rapporteer: {{$pd->name}}</h4>
      </div>
      <div class="modal-body">
        <form class="report-user-form" id="report-user-form" action="/profiel/{{$pd->id}}/rapporteren" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="blocked_id" value="{{$pd->id}}">
            <input type="hidden" name="blocker_id" value="{{\Auth::user()->id}}">
            <p>Reden voor rapportering:</p>
            {{-- Dropdown radio group --}}
            <div class="form-group">
                <select name="block_category" class="form-control" id="sel1">
                    <option value="1">Misbruik Regels</option>
                    <option value="2">Grof gedrag t.o.v. anderen</option>
                    <option value="3">Plaatsing van offensieve klusjes</option>
                </select>
            </div>
            <p>Extra informatie voor rapportering:</p>
            {{-- textarea --}}
            <div class="form-group">
                <textarea name="block_reason" rows="8" cols="80"></textarea>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="report-user-form" class="btn btn-danger">Gebruiker Rapporteren</button>
      </div>
    </div>
  </div>
</div>
