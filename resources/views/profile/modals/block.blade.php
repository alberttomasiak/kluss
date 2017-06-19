<div id="blockModal" class="modal fade" role="dialog">
  <div class="modals-box">
    <!-- Modal content-->
    <div class="modal-content task-report-modal modals-content">
      <div class="modals-header">
        <button type="button" class="close modals-close" data-dismiss="modal"><img src="/assets/img/close-dark.png" alt="" style="width: 50%; margin-left: auto"></button>
        <h4 class="modals-title">Rapporteer: {{$user->name}}</h4>
      </div>
      <div class="modal-body">
        <form class="report-user-form" id="report-user-form" action="/profiel/{{$user->id}}/rapporteren" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="blocked_id" value="{{$user->id}}">
            <input type="hidden" name="blocker_id" value="{{\Auth::user()->id}}">
            <p>Reden voor rapportering:</p>
            {{-- Dropdown radio group --}}
            <div class="form-group">
                <select name="block_category" class="form-control" id="sel1" style="height: 45px;">
                    @foreach($block_categories as $block_category)
                        <option value="{{$block_category->id}}">{{$block_category->name}}</option>
                    @endforeach
                </select>
            </div>
            <p>Extra informatie voor rapportering:</p>
            {{-- textarea --}}
            <div class="form-group">
                <textarea name="block_reason" class="form-control modals-textbox" id="comment" rows="8" style="text-indent: .5em; height: 5em;" cols="20" placeholder="Extra informatie..."></textarea>
            </div>
        </form>
      </div>
      <div class="modals-footer">
        <button type="submit" form="report-user-form" class="btn modals-btn">Gebruiker Rapporteren</button>
      </div>
    </div>
  </div>
</div>
