<div class="form-group {{$errors->has($name) ? ' has-error' : ''}}">
    {{ Form::label($name, $label_name, ['class' => 'control-label'])  }}
    {{ Form::file($name, array_merge(['class' => 'form-control'])) }}
    @if ($errors->has($name))
        <span class="help-block">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
</div>