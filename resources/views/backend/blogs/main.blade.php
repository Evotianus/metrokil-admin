@extends('layouts.app')

@section('title', 'Daftar Blog')

@section('content')
    <div class="container-xxl container-p-y">
        <div class="p-4 card bg-white blogs-table">
            <h2 class="text-lg">Blogs</h2>
            <style>
                /* Local badge style: background uses RGB var with alpha while text remains opaque */
                .category-badge {
                    display: inline-block;
                    padding: .45rem .5rem;
                    border-radius: .375rem;
                    background-color: rgba(var(--cat-rgb, 0,0,0), 0.12);
                    color: var(--cat, #000);
                    font-weight: 500;
                }
            </style>
            <hr class="my-4">
            <div class="flex justify-between">
                <form action="{{ route('blogs.index') }}" method="GET" class="flex">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="w-72 rounded-md placeholder:opacity-60 border-slate-300 focus:border-primary"
                        placeholder="Cari blog..." onkeypress="return event.keyCode !== 13 || this.form.submit()">
                </form>
                <a href="{{ route('blogs.create') }}">
                    <x-primary-button>
                        <img src="{{ asset('assets/boxicons-2.1.4/svg/regular/bx-plus-white.svg') }}" class="mr-3"
                            width="20" alt="">
                        Tambah Blog
                    </x-primary-button>
                </a>
            </div>

            <div class="table-responsive text-nowrap mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Kategori</th>
                            <th>Pembuat</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($blogs as $blog)
                            <tr>
                                <td><strong>{{ \Str::limit($blog->title, 30) }}</strong></td>
                                <td>{{ \Str::limit(strip_tags($blog->description), 40) }}</td>
                                {{-- <td>
                                    @if ($blog->category == 'news')
                                        <span class="badge bg-label-primary me-1">Berita</span>
                                    @else
                                        <span class="badge bg-label-warning me-1">Informasi</span>
                                    @endif
                                </td> --}}
                                <td>
                                    @php
                                        if (! function_exists('__hex2rgb')) {
                                            function __hex2rgb($hex) {
                                                $hex = ltrim($hex, '#');
                                                if (strlen($hex) === 3) {
                                                    $r = hexdec(str_repeat($hex[0], 2));
                                                    $g = hexdec(str_repeat($hex[1], 2));
                                                    $b = hexdec(str_repeat($hex[2], 2));
                                                } else {
                                                    $r = hexdec(substr($hex, 0, 2));
                                                    $g = hexdec(substr($hex, 2, 2));
                                                    $b = hexdec(substr($hex, 4, 2));
                                                }
                                                return "$r,$g,$b";
                                            }
                                        }
                                    @endphp
                                    <span class="badge category-badge" style="--cat: {{ $blog->category->color }}; --cat-rgb: {{ __hex2rgb($blog->category->color) }};">{{ $blog->category->name }}</span>
                                </td>
                                <td>{{ $blog->user->name }}
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('blogs.edit', $blog->id) }}"><i
                                                    class="bx bx-edit-alt me-1"></i> Edit</a>

                                            <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST"
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
