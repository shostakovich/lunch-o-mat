@if(Session::has('notification'))
    <div class="alert" role="alert">{{ Session::get('notification') }}</div>
@endif
