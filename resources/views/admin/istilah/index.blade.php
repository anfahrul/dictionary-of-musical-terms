@extends('admin.index')

@section('main-content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"> {{ $title }} </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <a href="/admin/terms/create" type="button" class="btn btn-primary">
        Tambah Data
      </a>
    </div>
</div>

@if (session()->has('success'))
<div class="alert alert-primary" role="alert">
    {{ session('success') }}
</div>
@endif

<table id="myTable" class="table table-striped table-hover display">
    <thead class="table-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($musicTerms as $term)
        <tr>
            <th scope="row">{{ $term['id'] }}</th>
            <td>{{ $term['title'] }}</td>
            <td>{{ $term['description'] }}</td>
            <td>
                <div class="d-flex justify-content-start">
                    <a href="/admin/terms/{{ $term['id'] }}/edit" class="btn btn-sm btn-outline-warning me-1" title="Edit"><i class="ti ti-edit"></i></a>
                    <form action="/admin/terms/{{ $term['id'] }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus"><i class="ti ti-trash-x"></i></button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
      </tbody>
</table>
@endsection

@section('script')
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable({
                "pageLength": 6,
                "order": [[1, 'asc']],
                "searching": false
            });
        });
    </script>
@endsection
