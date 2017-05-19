@extends('layouts.admin')
@section('content')
@include('admin.dashboard.partials.header')
@include('admin.dashboard.partials.sidebar')
<section class="dashboard--main">
    <h1>Dashboard</h1>
    <h2>Gebruikers</h2>
    <div>
        <p class="registered--counter"></p>
        <p>Geregistreerde gebruikers</p>
    </div>
    <div>
        <p class="verified--counter"></p>
        <p>Geverifiëerde gebruikers</p>
    </div>
    <div>
        <p class="gold--counter"></p>
        <p>Gold gebruikers</p>
    </div>
    <div>
        <p class="blocked--counter"></p>
        <p>Geblokkeerde gebruikers</p>
    </div>
    <div>
        <p class="reported--counter"></p>
        <p>Rapporteringen</p>
    </div>
    <h2>Klusjes</h2>
    <div>
        <p class="task--counter"></p>
        <p>Actieve klusjes</p>
    </div>
    <div>
        <p class="closed--counter"></p>
        <p>Afgesloten klusjes</p>
    </div>
    <h2>Gesprekken</h2>
    <div>
        <p class="conversations--counter"></p>
        <p>Lopende gesprekken</p>
    </div>
    <div>
        <p class="messages--counter"></p>
        <p>Verstuurde berichtjes</p>
    </div>
</section>
<script type="text/javascript">
    function getData(){
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
        });
        $.get("/admin/getData", function(data, status){
            // We populate our divs with live data from the database
            // Users
            $('.registered--counter').text(data[0]);
            $('.verified--counter').text(data[1]);
            $('.gold--counter').text(data[2]);
            $('.blocked--counter').text(data[3]);
            $('.reported--counter').text(data[4]);
            // Tasks
            $('.task--counter').text(data[5]);
            $('.closed--counter').text(data[6]);
            // Messages
            $('.conversations--counter').text(data[7]);
            $('.messages--counter').text(data[8]);
        });
    }
    getData();
    window.setInterval(function(){
        getData();
    }, 300000);
</script>
@endsection
