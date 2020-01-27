@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h3 class="d-inline-block">Consumer</h3>
                <a href="{{route('consumer.create')}}" class="btn btn-md btn-success float-right">Create Consumer</a>
        </div>
        <div class="card-body">
            @if ($consumers->count() > 0)
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Nama Consumer</th>
                            <th>Alamat</th>
                            <th>Order</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        @foreach ($consumers as $consumer)
                                <td>{{$consumer->nama_konsumer}}</td>
                                <td>{{$consumer->alamat}}</td>
                                <td>{{$consumer->orders->count()}}</td>
                                <td></td>
                                <td>
                                <a href="{{route('consumer.edit', $consumer->id)}}" class="btn btn-sm btn-secondary">Edit</a>
                                <button onclick="deleteHandler({{$consumer->id}})" class="btn btn-sm btn-secondary">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h3 class="text-center">
                    Belum ada consumer.
                </h3>
            @endif

        <form action="" method="POST" id="deleteConsumerForm">
            @csrf
            @method("DELETE")
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Hapus Consumer</h5>
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
            const form = document.querySelector('#deleteConsumerForm');
            const modalBody = document.querySelector('#modal-body');
            form.action = '/consumer/' + id;
            $('#deleteModalLabel').html('Hapus consumer?');
            $('#deleteModal').modal('show');
    }
   </script>
@endsection
