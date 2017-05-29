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
                        {{$setting->key}}
                    </div>
                    <div class="settings-value">
                        {{$setting->value}}
                    </div>
                </div>
            @endforeach
        </div>
        {{$settings->links()}}
        </div>
    </div>
@endsection
