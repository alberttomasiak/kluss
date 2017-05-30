@extends('layouts.admin')
@section('content')
    <div class="users--overview">
        <h1>Globale Instellingen</h1>
        <div class="settings-outer">
        <h2>Overzicht</h2>
        <a href="#addSettingModal" data-toggle="modal" role="button" class="addSettingModal add--setting-btn">+</a>
        @include('admin.settings.modals.add')
        <div class="settings-overview">
            <div class="settings-titles">
                <h6>Key</h6>
                <h6>Value</h6>
            </div>
            @foreach($settings as $setting)
                <div class="settings-div">
                    <div class="settings-key">
                        <p>{{$setting->key}}</p>
                    </div>
                    <div class="settings-value">
                        <p>{{$setting->value}}</p>
                        <a href="#setting-{{$setting->id}}-edit" data-toggle="modal" role="button" data-id="{{$setting->id}}" class="btn opener-translation btn-warning">Bewerken</a>
                    </div>
                </div>
                @include('admin.settings.modals.edit', ['id' => $setting->id ])
            @endforeach
        </div>
        {{$settings->links()}}
        </div>
    </div>
    <script type="text/javascript">
        // $('.opener-translation').click(function(){
        //     var id = (this).data('id');
        //     $('.modal-footer .edit').data('value', id);
        // });
    </script>
@endsection
