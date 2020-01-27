@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h3 class="d-inline-block">Order</h3>
        </div>
        <div class="card-body">
            @if ($orders->count() > 0)
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Consumer</th>
                            <th>Produk</th>
                            <th>Kategori</th>
                            <th>Qty</th>
                            <th>Total harga</th>
                            <th>Status Order</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{$order->consumers->nama_konsumer}}</td>
                                <td>{{$order->produks->name}}</td>
                                <td>{{$order->produks->kategori->name}}</td>
                                <td>{{$order->qty}}</td>
                                <td>@rupiah($order->total_harga)</td>
                                <td>
                                    <form action="{{route('order.update', $order->id)}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="status_order" id="status_order">
                                            <option value="3"
                                                @if ($order->status_order == 3)
                                                    selected
                                                @endif>
                                                Paid
                                            </option>

                                            <option value="2"
                                                @if ($order->status_order == 2)
                                                    selected
                                                @endif>
                                                Unpaid
                                            </option>

                                            <option value="1"
                                                @if ($order->status_order == 1)
                                                    selected
                                                @endif>
                                                Pending
                                            </option>

                                            <option value="0"
                                            @if ($order->status_order == 0)
                                                    selected
                                                @endif>
                                                Cancel
                                            </option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-secondary">Edit</button>
                                    </form>
                                </td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h3 class="text-center">
                    Belum ada order.
                </h3>
            @endif
        </div>
    </div>
@endsection

{{-- @section('scripts')
   <script>
        function deleteHandler(id){
            const form = document.querySelector('#deleteOrderForm');
            const modalBody = document.querySelector('#modal-body');
            form.action = '/order/' + id;
            $('#deleteModalLabel').html('Hapus order?');
            $('#deleteModal').modal('show');
    }
   </script> --}}
{{-- @endsection --}}
