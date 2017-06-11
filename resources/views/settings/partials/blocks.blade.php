<div style="float: right; width: 60%; margin-right: 50px; color: #677578;">
    <h1>Persoonlijke rapporteringen</h1>
    @foreach($myblocks as $myblock)
        <div class="user-block">
            <h4>{{$myblock->name}}</h4>
            <p class="block--reason"><b>Reden:</b> {{$myblock->block_reason}}</p>
            <p class="block--time">{{ timeAgo($myblock->created_at) }}</p>
            <a href="/admin/block/{{$myblock->blocked_id}}/unblock">Opheffen</a>
        </div>
    @endforeach
</div>
