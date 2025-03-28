@extends('layouts.app')

@section('title', 'Daftar Gallery')

@section('content')
    <div class="container-xxl container-p-y">
        <div class="p-4 card bg-white blogs-table">
            <h2 class="text-lg">Services</h2>
            <hr class="my-4">
            <div class="flex justify-between">
                <form action="{{ route('services.index') }}" method="GET" class="flex">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="w-72 rounded-md placeholder:opacity-60 border-slate-300 focus:border-primary"
                        placeholder="Cari layanan..." onkeypress="return event.keyCode !== 13 || this.form.submit()">
                </form>
                <a href="{{ route('services.create') }}">
                    <x-primary-button>
                        <img src="{{ asset('assets/boxicons-2.1.4/svg/regular/bx-plus-white.svg') }}" class="mr-3"
                            width="20" alt="">
                        Tambah Layanan
                    </x-primary-button>
                </a>
            </div>

            <div class="table-responsive text-nowrap mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Layanan</th>
                            <th>Harga</th>
                            <th>Benefits</th>
                            <th>Deskripsi</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($services as $service)
                            <tr>
                                <td><strong>{{ \Str::limit($service->name, 15) ?? 'None' }}</strong></td>
                                <td>
                                    <span class="badge bg-label-primary me-1">{{  \Str::limit($service->price, 20) }}</span>
                                </td>  
                                <td>{{ substr(strip_tags($service->description), 0, 60) }}</td>
                                <td>
                                        <span class="badge bg-label-primary me-1">{{  \Str::limit($service->benefits, 20) }}</span>
                                </td> 
                                <td>
                                    <span class="badge bg-label-primary me-1">{{  \Str::limit($service->deskripsi, 20) }}</span>
                                </td>    
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('services.edit', $service->id) }}"><i
                                                    class="bx bx-edit-alt me-1"></i> Edit</a>

                                            <form action="{{ route('services.destroy', $service->id) }}" method="POST"
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
