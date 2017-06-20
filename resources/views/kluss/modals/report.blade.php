<div id="kluss-{{$kl->id}}-report" class="modal fade" role="dialog">
  <div class="modals-box">
    <!-- Modal content-->
    <div class="modal-content task-report-modal modals-content">
      <div class="modals-header">
        <button type="button" class="close modals-close" data-dismiss="modal"><img src="/assets/img/close-dark.png" alt=""></button><!--&times;-->
        <h3 class="modals-title">Help ons begrijpen wat er gaande is</h3>
        <p class="modals-text">
            Wij bij KLUSS doen er alles aan om een aangename en efficiënte, maar vooral betrouwbare voor buurtbewoners te creëren
            om te klussen en te laten klussen. Helaas kan het soms voorvallen dat gebruikers zich ongepast of aanstootgevend gedragen of afspraken niet nakomen.
            Dit willen we uiteraard ten allen tijde vermijden.
        </p>
        <p class="modals-text">
            Indien je dit klusje als onaangenaam ervaart, kan je dit klusje of de maker van het klusje rapporteren. De meldingen kunnen de beheerders
            zo snel mogelijk nakijken en indien nodig actie ondernemen in de vorm van een stopzetting van het account.
        </p>
        <h4 class="modals-title_small">Wat zou je graag doen?</h4>
      </div>
      <div class="modals-body">
          <form action="/kluss/{{$kl->id}}/rapporteren" id="kluss-{{$kl->id}}-rapporteren" method="post">
              {!! csrf_field() !!}
              <div class="radio-report-group">
                  <input type="radio" name="reason" id="reason-inappr" value="inappropriate"><label for="reason-inappr">Dit hoort niet thuis op de KLUSS website</label><br>
                  <input type="radio" name="reason" id="reason-spam" value="spam"><label for="reason-spam">Het is spam</label><br>
              </div>
              <input type="hidden" name="blocker_id" id="blocker_id" value="{{\Auth::user()->id}}">
      </div>
      <div class="modals-footer">
        <button type="submit" form="kluss-{{$kl->id}}-rapporteren" class="btn-sendreport btn-success">Rapporteer</button>
        </form>
      </div>
    </div>
  </div>
</div>
