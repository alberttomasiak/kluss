@extends('layouts.admin')
@section('content')
@include('admin.dashboard.partials.header')
@include('admin.dashboard.partials.sidebar')
<section class="dashboard--main">
    <h1>Dashboard</h1>
    <div class="dashboard--block">
        <p class="registered--counter"></p>
        <p>Geregistreerde gebruikers</p>
    </div>
    <div class="dashboard--block">
        <p class="active--counter"></p>
        <p>Actieve gebruikers</p>
    </div>
    <div class="dashboard--block">
        <p class="task--counter"></p>
        <p>Actieve klusjes</p>
    </div>
    <div class="gold--block">
        <p class="gold--counter"></p>
        <p>Gold gebruikers</p>
    </div>
</section>
<script type="text/javascript">
    function getData(){
        
    }
    getData();
    window.setInterval(function(){
        getData();
    }, 60000);
</script>
@endsection
