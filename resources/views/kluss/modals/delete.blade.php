<div id="kluss-{{$kl->id}}-verwijderen" class="modal fade" role="dialog">
  <div class="modals-box">
    <!-- Modal content-->
    <div class="modal-content task-report-modal modals-content">
      <div class="modals-header">
        <button type="button" class="close" data-dismiss="modal"><img src="/assets/img/close-dark.png" alt="" style="width: 50%; margin-left: auto; opacity: 1;"></button>
        <h3 class="modals-title">Klusje "{{$kl->title}}" verwijderen</h3>
      <div class="modals-body">
          <form action="/kluss/{{$kl->id}}/verwijderen" id="kluss-verwijderen" method="post">
              {!! csrf_field() !!}
              <p>Ben je zeker dat je het klusje wil verwijderen?</p>
              <input type="hidden" name="blocker_id" id="blocker_id" value="{{\Auth::user()->id}}">
      </div>
      <div class="modals-footer" style="display: flex;">
          <button type="button" class="btn-modalcancel" data-dismiss="modal">Annuleren</button>
        <button type="submit" form="kluss-verwijderen" class="btn-sendreport">Verwijderen</button>
        </form>
      </div>
    </div>
  </div>
</div>
