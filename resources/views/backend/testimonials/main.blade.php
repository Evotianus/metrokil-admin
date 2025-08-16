@extends('layouts.app')

@section('title', 'Daftar Testimoni')

@section('content')
    <div class="container-xxl container-p-y">
        <div class="p-4 card bg-white blogs-table">
            <h2 class="text-lg">Daftar Testimoni</h2>
            <hr class="my-4">
            <div class="flex justify-between">
                <form action="{{ route('testimonials.index') }}" method="GET" class="flex">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="w-72 rounded-md placeholder:opacity-60 border-slate-300 focus:border-primary"
                        placeholder="Cari foto..." onkeypress="return event.keyCode !== 13 || this.form.submit()">
                </form>
                <a href="{{ route('testimonials.create') }}">
                    <x-primary-button>
                        <img src="{{ asset('assets/boxicons-2.1.4/svg/regular/bx-plus-white.svg') }}" class="mr-3"
                            width="20" alt="">
                        Tambah Testimoni
                    </x-primary-button>
                </a>
            </div>

            <div class="table-responsive text-nowrap mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Biodata</th>
                            <th>Deskripsi Review</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($testimonials as $testimonial)
                            <tr>
                                <td><strong>{{ $testimonial->name ?? 'None' }}</strong></td>
                                <td>{{ strlen(strip_tags($testimonial->bio)) > 50 ? substr(strip_tags($testimonial->bio), 0, 50) . '...' : strip_tags($testimonial->bio) }}
                                </td>
                                <td>{{ strlen(strip_tags($testimonial->review)) > 70 ? substr(strip_tags($testimonial->review), 0, 70) . '...' : strip_tags($testimonial->review) }}
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('testimonials.edit', $testimonial->id) }}"><i
                                                    class="bx bx-edit-alt me-1"></i> Edit</a>

                                            <form action="{{ route('testimonials.destroy', $testimonial->id) }}"
                                                method="POST" class="dropdown-item">
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
