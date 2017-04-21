@if(\Session::has('success'))
    <div class="callout callout-success">
        <h4>congratulations!</h4>
        {{ \Session::get('success') }}

    </div>
@elseif(\Session::has('danger'))
    <div class="callout callout-success">
        <h4>congratulations!</h4>
        {{ \Session::get('danger') }}

    </div>
@endif