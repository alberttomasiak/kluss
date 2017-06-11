@extends('layouts.admin')
@section('content')
    <div class="users--overview">
        <h1>Globale Meldingen</h1>
        <div class="settings-outer">
        <h2>Overzicht</h2>
        <a href="#addGlobalNotification" data-toggle="modal" role="button" class="addSettingModal add--setting-btn">+</a>
        @include('admin.notifications.modals.add')
        <div class="settings-overview">
            <div class="settings-titles">
                <h6>Bericht</h6>
                <h6>URL</h6>
                <h6>Channel</h6>
            </div>
            @foreach($notifications as $notification)
                <div class="settings-div">
                    <div class="settings-key">
                        <p>{{$notification->message}}</p>
                    </div>
                    <div class="settings-value">
                        <p>{{$notification->url}}</p>
                    </div>
                    <div class="">
                        <p>{{$notification->channel}}</p>
                    </div>
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
