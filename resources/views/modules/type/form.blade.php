{!! Form::model($model, [
    'route' => $model->exists ? ['type.update', $model->id] : 'type.store',
    'method' => $model->exists ? 'PUT' : 'POST'
]) !!}


    <div class="form-group">
        <label for="" class="control-label">Type</label>
        {!! Form::text('type', null, ['class' => 'form-control', 'id' => 'type']) !!}
    </div>


{!! Form::close() !!}
