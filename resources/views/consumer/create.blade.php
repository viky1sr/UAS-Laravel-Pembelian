@extends('layouts.app')


@section('content')
    <div class="card card-default">
        <div class="card-header">
        <h3 class="d-inline-block">{{isset($consumer) ? 'Ubah Consumer' : 'Buat Consumer'}}</h3>
        </div>
        <div class="card-body">
            @include('partials.error')
            <form action="{{isset($consumer) ? route('consumer.update', $consumer->id) : route('consumer.store')}}" method="POST">
                    @csrf
                    @if (isset($consumer))
                        @method('PUT')
                    @endif
                    <div class="form-group">
                        <label for="nama_konsumer">Nama Consumer</label>
                        <input type="text" id="nama_konsumer" name="nama_konsumer" class="form-control" value="{{old('nama_konsumer', isset($consumer) ? $consumer->nama_konsumer : '')}}">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" id="alamat" name="alamat" class="form-control" value="{{old('alamat', isset($consumer) ? $consumer->alamat : '')}}">
                    </div>
                    <button type="submit" class="btn btn-md btn-success">
                        {{isset($consumer) ? 'Edit Consumer' : 'Buat Consumer'}}
                    </button>
                </form>
        </div>
    </div>
@endsection

