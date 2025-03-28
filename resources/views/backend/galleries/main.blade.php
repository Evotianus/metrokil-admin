@extends('layouts.app')

@section('title', 'Daftar Gallery')

@section('content')
    <div class="container-xxl container-p-y">
        <div class="p-4 card bg-white blogs-table">
            <h2 class="text-lg">Galleries</h2>
            <hr class="my-4">
            <div class="flex justify-between">
                <form action="{{ route('galleries.index') }}" method="GET" class="flex">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="w-72 rounded-md placeholder:opacity-60 border-slate-300 focus:border-primary"
                        placeholder="Cari foto..." onkeypress="return event.keyCode !== 13 || this.form.submit()">
                </form>
                <a href="{{ route('galleries.create') }}">
                    <x-primary-button>
                        <img src="{{ asset('assets/boxicons-2.1.4/svg/regular/bx-plus-white.svg') }}" class="mr-3"
                            width="20" alt="">
                        Tambah Foto
                    </x-primary-button>
                </a>
            </div>

            <div class="table-responsive text-nowrap mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Image</th>
                            <th>Deskripsi</th>
                            <th>Kategori</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($galleries as $gallery)
                            <tr>
                                <td><strong>{{ \Str::limit($gallery->name, 15) ?? 'None' }}</strong></td>
                                <td><img src="http://localhost:8000/storage/{{ $gallery->image_url }}" alt="" class="w-48"></td>
                                <td>{{ substr(strip_tags($gallery->description), 0, 60) }}</td>
                                <td>
                                        <span class="badge bg-label-primary me-1">{{  \Str::limit($gallery->category, 20) }}</span>
                                </td>   
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('galleries.edit', $gallery->id) }}"><i
                                                    class="bx bx-edit-alt me-1"></i> Edit</a>

                                            <form action="{{ route('galleries.destroy', $gallery->id) }}" method="POST"
                                                class="dropdown-item">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">
                                                    <i class="bx bx-trash me-1"></i>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
