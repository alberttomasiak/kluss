@extends('layouts.admin')
@section('content')
    <div class="users--overview">
        <h1>Globale Meldingen</h1>
        <div class="settings-outer">
        <h2>Overzicht</h2>
        <a href="#addGlobalNotification" data-toggle="modal" role="button" class="addGlobalNotification add--setting-btn">+</a>
        @include('admin.notifications.modals.add')
        <div class="settings-overview">
            @foreach($notifications as $notification)
                <div class="settings-div">
                    <p>heyo</p>
                </div>
            @endforeach
        </div>
        {{$notifications->links()}}
        </div>
    </div>
    <script type="text/javascript">
        // $('.opener-translation').click(function(){
        //     var id = (this).data('id');
        //     $('.modal-footer .edit').data('value', id);
        // });
    </script>
@endsection
