@extends('layouts.app')


@section('content')
    <div class="card card-default">
        <div class="card-header">
        <h3 class="d-inline-block">{{isset($kategori) ? 'Ubah Kategori' : 'Buat Kategori'}}</h3>
        </div>
        <div class="card-body">
            @include('partials.error')
            <form action="{{isset($kategori) ? route('kategori.update', $kategori->id) : route('kategori.store')}}" method="POST">
                @csrf
                @if (isset($kategori))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="name">Nama Kategori</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{isset($kategori) ? $kategori->name : ''}}">
                </div>
                <button type="submit" class="btn btn-md btn-success">
                    {{isset($kategori)     ? 'Edit kategori' : 'Buat Kategori'}}
                </button>
            </form>
        </div>
    </div>
@endsection

