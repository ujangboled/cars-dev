<table class="table table-hover">
    <tr>
        <th>id</th>
        <th>Name</th>
        <th>Merk</th>
        <th>Type</th>
        <th>QTY</th>
        <th>Price</th>
        <th></th>
    </tr>
    <tr>
        <td>{{ $model->id }}</td>
        <td>{{ $model->name }}</td>
        <td>{{ $model->brand }}</td>
        <td>{{ $model->id_type }}</td>
        <td>{{ $model->qty }}</td>
        <td>{{ $model->cost }}</td>
        <th></th>
    </tr>
</table>