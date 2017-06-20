<div id="profiel-verwijderen" class="modal fade" role="dialog">
  <div class="modals-box">
    <!-- Modal content-->
    <div class="modal-content task-report-modal modals-content">
      <div class="modals-header">
        <button type="button" class="close modals-close" data-dismiss="modal"><img src="/assets/img/close-dark.png" alt="" style="width: 50%; margin-left: auto"></button>
        <h3 class="modals-title">Account verwijderen: </h3>
      </div>
      <div class="modal-body">
        <form class="report-user-form" id="report-user-form" action="/account/verwijderen" method="post">
            {!! csrf_field() !!}
            <input type="hidden" name="userID" value="{{\Auth::user()->id}}">
            <h4>Ben je zeker dat je je account wil verwijderen? We kunnen uw data niet meer terughalen na het verwijderen.</h4>
        </form>
      </div>
      <div class="modals-footer">
        <button type="submit" form="report-user-form" style="padding-left: .75em; padding-right: .75em;" class="btn modals-btn">Account Verwijderen</button>
      </div>
    </div>
  </div>
</div>
