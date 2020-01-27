@extends('layouts.app')


@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h3 class="d-inline-block">{{isset($produk) ? 'Edit Produk' : 'Buat Produk'}}</h3>
        </div>
        <div class="card-body">
            @include('partials.error')
            <form action="{{isset($produk) ? route('produk.update', $produk->id) : route('produk.store')}}" method="POST">
                @csrf
                @if (isset($produk))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="name">Nama Produk</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{old('name', isset($produk) ? $produk->name : '')}}">
                </div>

                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" id="harga" name="harga" class="form-control" value="{{old('harga', isset($produk) ? $produk->harga : '')}}">
                </div>

                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="number" id="stok" name="stok" class="form-control" value="{{old('stok', isset($produk) ? $produk->stok : '')}}">
                </div>

                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control">
                        @foreach ($categories as $kategori)
                            <option value="{{$kategori->id}}"
                                @if (isset($produk))
                                    @if ($kategori->id === $produk->kategori_id)
                                        selected
                                    @endif
                                @endif
                                >
                                {{$kategori->name}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-md btn-success">{{isset($produk) ? 'Edit Produk' : 'Buat Produk'}}</button>
            </form>
        </div>
    </div>
@endsection

