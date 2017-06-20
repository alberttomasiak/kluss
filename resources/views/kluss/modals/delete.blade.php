<div id="kluss-{{$kl->id}}-verwijderen" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content task-report-modal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">Klusje "{{$kl->title}}" verwijderen</h3>
      <div class="modal-body">
          <form action="/kluss/{{$kl->id}}/verwijderen" id="kluss-{{$kl->id}}-verwijderen" method="post">
              {!! csrf_field() !!}
              <p>Ben je zeker dat je het klusje wil verwijderen?</p>
              <input type="hidden" name="blocker_id" id="blocker_id" value="{{\Auth::user()->id}}">
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
        <button type="submit" form="kluss-{{$kl->id}}-rapporteren" class="btn btn-danger">Verwijderen</button>
        </form>
      </div>
    </div>
  </div>
</div>
