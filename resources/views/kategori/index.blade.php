@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h3 class="d-inline-block">Kategori</h3>
                <a href="{{route('kategori.create')}}" class="btn btn-md btn-success float-right">Create Kategori</a>
        </div>
        <div class="card-body">
            @if ($categories->count() > 0)
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Nama Kategori</th>
                            <th>Produk</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $kategori)
                            <tr>
                                <td>{{$kategori->name}}</td>
                                <td>{{$kategori->produks->count()}}</td>
                                <td></td>
                                <td>
                                <a href="{{route('kategori.edit', $kategori->id)}}" class="btn btn-sm btn-secondary">Edit</a>
                                <button onclick="deleteHandler({{$kategori->id}})" class="btn btn-sm btn-secondary">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h3 class="text-center">
                    Belum ada kategori.
                </h3>
            @endif

        <form action="" method="POST" id="deleteKategoriForm">
            @csrf
            @method("DELETE")
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Hapus Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="font-weight-bold text-center" id="modal-body">
                            Kamu yakin?
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Ngak jadi deh</button>
                    <button type="submit" class="btn btn-danger">Yep!</button>
                    </div>
                </div>
                </div>
            </div>
        </form>

        </div>
    </div>
@endsection

@section('scripts')
   <script>
        function deleteHandler(id){
            const form = document.querySelector('#deleteKategoriForm');
            const modalBody = document.querySelector('#modal-body');
            form.action = '/kategori/' + id;
            $('#deleteModalLabel').html('Hapus kategori?');
            $('#deleteModal').modal('show');
    }
   </script>
@endsection
