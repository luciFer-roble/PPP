@if(count($errors))
    <div class="form-group">
        <div class="alert alert-danger" style="
        /*background-color: #f4424e !important; border-color: #f4424e !important;*/
        opacity: 0.7 !important;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error  }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif