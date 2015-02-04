<h2>Roster</h2>
<ul class="list-group">

    <li class="list-group-item">
        <a href="#">Edit Team Roster</a>
    </li>
</ul><!-- include -->
<!-- include -->
<h2>Games</h2>
<ul class="list-group">


    <li class="list-group-item">
        {{link_to_route('games-create','Create Games',$event->id)}}
    </li>


    <li class="list-group-item">
        {{link_to_route('games-show','View Games',$event->id)}}
    </li>

    <li class="list-group-item">
        <a href="#">View My Games (Guest)</a>
    </li>
</ul><!-- include -->

<h2>Teams</h2>
<ul class="list-group">

    <li class="list-group-item">
    {{link_to_route('events-show','View Teams',$event->id,'View Teams')}}
    </li>
</ul><!-- include -->



