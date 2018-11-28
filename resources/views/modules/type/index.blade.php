@extends('layouts.app')

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Datatable
          <a href="{{ route('type.create') }}" class="btn btn-success pull-right modal-show" style="margin-top: -8px;" title="Create Type"><i class="icon-plus"></i> Create</a>
      </h3>
    </div>
    <div class="panel-body">
          <table id="datatable" class="table table-hover" style="width:100%">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Type</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  
              </tbody>
              <tfoot>
                  <tr>
                      <th>No</th>
                      <th>Type</th>
                      <th></th>
                  </tr>
              </tfoot>
          </table>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $('#datatable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('table.Type') }}",
            columns: [
                {data: 'DT_Row_Index', name: 'id'},
                {data: 'type', name: 'type'},
                {data: 'action', name: 'action'}
            ]
        });
    </script>
@endpush