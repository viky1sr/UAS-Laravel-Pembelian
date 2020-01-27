@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            <h3 class="d-inline-block">Produk</h3>
                <button class="btn btn-md btn-danger float-right ml-2" onclick="DeleteAllHandler()">Delete All</button>
                <a href="{{route('produk.create')}}" class="btn btn-md btn-success float-right">Create produk</a>
        </div>
        <div class="card-body">
            @if ($produks->count() > 0)
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produks as $produk)
                        <tr>
                            <td>{{$produk->name}}</td>
                            <td>{{$produk->kategori->name}}</td>
                            <td>@rupiah($produk->harga)</td>
                            <td>{{$produk->stok}}</td>
                            <td></td>
                            <td>
                            <a href="{{route('produk.edit', $produk->id)}}" class="btn btn-sm btn-secondary">Edit</a>
                            <button onclick="deleteHandler({{$produk->id}})" class="btn btn-sm btn-secondary">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <h3 class="text-center">
                Belum ada produk.
            </h3>
        @endif

        <form action="" method="POST" id="deleteProdukForm">
            @csrf
            @method("DELETE")
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Hapus Produk</h5>
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
            const form = document.querySelector('#deleteProdukForm');
            const modalBody = document.querySelector('#modal-body');
            form.action = '/produk/' + id;
            $('#deleteModalLabel').html('Hapus produk?');
            $('#deleteModal').modal('show');
    }

     function DeleteAllHandler(){
            const form = document.querySelector('#deleteProdukForm');
            const modalBody = document.querySelector('#modal-body');
            form.action = '{{route('produk.deleteAll')}}';
            form.method= 'DELETE'
            $('#deleteModalLabel').html('Hapus semua produk?');
            $('#deleteModal').modal('show');
    }
   </script>
@endsection
