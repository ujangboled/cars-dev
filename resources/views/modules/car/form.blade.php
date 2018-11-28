{!! Form::model($model, [
    'route' => $model->exists ? ['cars.update', $model->id] : 'cars.store',
    'method' => $model->exists ? 'PUT' : 'POST'
]) !!}

    <div class="form-group">
        <label for="" class="control-label">Name</label>
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
    </div>

    <div class="form-group">
        <label for="" class="control-label">Merk</label>
        {!! Form::text('brand', null, ['class' => 'form-control', 'id' => 'brand']) !!}
    </div>

    <div class="form-group">
        <label for="" class="control-label">Type</label>
        <!-- {!! Form::text('id_type', null, ['class' => 'form-control', 'id' => 'id_type']) !!} -->
        {!! Form::select('id_type', $get_type->all(), null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="" class="control-label">QTY</label>
        {!! Form::number('qty', null, ['class' => 'form-control', 'id' => 'qty']) !!}
    </div>

    <div class="form-group">
        <label for="" class="control-label">Price</label>
        {!! Form::number('cost', null, ['class' => 'form-control', 'id' => 'cost']) !!}
    </div>


{!! Form::close() !!}
