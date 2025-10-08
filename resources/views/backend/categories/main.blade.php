@extends('layouts.app')

@section('title', 'Daftar Layanan')

@section('content')
    <div class="container-xxl container-p-y">
        <div class="p-4 card bg-white blogs-table">
            <h2 class="text-lg">Kategori</h2>
            <hr class="my-4">
            <div class="flex justify-between">
                <form action="{{ route('categories.index') }}" method="GET" class="flex">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="w-72 rounded-md placeholder:opacity-60 border-slate-300 focus:border-primary"
                        placeholder="Cari kategori..." onkeypress="return event.keyCode !== 13 || this.form.submit()">
                </form>
                <a href="{{ route('categories.create') }}">
                    <x-primary-button>
                        <img src="{{ asset('assets/boxicons-2.1.4/svg/regular/bx-plus-white.svg') }}" class="mr-3"
                            width="20" alt="">
                        Tambah Kategori
                    </x-primary-button>
                </a>
            </div>

            <div class="table-responsive text-nowrap mt-4">
                <table class="table">
                    <colgroup>
                        <col style="width:75%">
                        <col style="width:25%; min-width:140px">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Warna</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($categories as $category)
                            <tr>
                                <td><strong>{{ \Str::limit($category->name, 15) ?? '-' }}</strong></td>
                                <td>
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded" style="background-color: {{ $category->color }};"></div>
                                        <span>{{ $category->color }}</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('categories.edit', $category->id) }}"><i
                                                    class="bx bx-edit-alt me-1"></i> Edit</a>

                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
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
