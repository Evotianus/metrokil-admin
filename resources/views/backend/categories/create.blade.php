@extends('layouts.app')

@section('title', 'Tambah Kategori')
@section('content')
    <div class="container-xxl container-p-y">

        <div class="mb-3 flex justify-between items-center">
            <div class="flex flex-col">
                <h2 class="text-2xl">Kategori</h2>
                {{-- <p class="mt-2 text-lg">Buat Kategori Metrokil</p> --}}
            </div>
            <div class="flex gap-3 h-fit">
                <a href="{{ route('categories.index') }}" class="btn bg-primary-subtle text-primary">Batal</a>
                <x-primary-button id="btn-submit">Tambahkan</x-primary-button>
            </div>
        </div>

        <div class="card bg-white py-4 px-7">
            <h2 class="text-lg">Tambah Kategori</h2>
            <form action="/categories" method="POST" id="blog-form" class="my-4 flex flex-col" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="flex w-full gap-3">
                    <div class="w-full">
                        <div class="flex flex-col gap-2">
                            <label for="title">Nama</label>
                            <input type="text" name="name" id="nama"
                                class="input-text border-slate-400 rounded-md placeholder:opacity-60 focus:ring-primary"
                                placeholder="Nama Kategori...">
                        </div>
                        <div class="flex flex-col gap-2 mt-3">
                            <label for="title">Warna</label>
                            <input type="color" name="color" id="color"
                                class="input-text border-slate-400 rounded-md placeholder:opacity-60 focus:ring-primary"
                                placeholder="Warna Kategori...">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        // Handle form submission
        btnSubmit.addEventListener('click', (e) => {
            e.preventDefault();

            // Validate fields
            if (!blogForm.name.value.trim()) {
                alert('Please fill all the required fields');
                return;
            }

            // Submit the form
            blogForm.submit();
        });
    </script>

@endsection
