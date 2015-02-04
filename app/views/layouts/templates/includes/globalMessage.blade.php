<!-- display Error Messages if they are set -->
@if(Session::has('message'))
    <div class="beta-error-message alert alert-info">
        {{Session::get('message','<p>:message</p>')}}
    </div>
    @endif

