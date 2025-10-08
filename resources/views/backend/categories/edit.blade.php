@extends('layouts.app')

@section('title', 'Ubah Kategori')
@section('content')
    <div class="container-xxl container-p-y">

        <div class="mb-3 flex justify-between items-center">
            <div class="flex flex-col">
                <h2 class="text-2xl">Ubah Kategori</h2>
                {{-- <p class="mt-2 text-lg">Buat Kategori Metrokil</p> --}}
            </div>
            <div class="flex gap-3 h-fit">
                <a href="{{ route('categories.index') }}" class="btn bg-primary-subtle text-primary">Batal</a>
                <x-primary-button id="btn-submit">Simpan perubahan</x-primary-button>
            </div>
        </div>

        <div class="card bg-white py-4 px-7">
            <h2 class="text-lg">Ubah Kategori</h2>
            <form action="{{ route('categories.update', $category->id) }}" method="POST" id="blog-form" class="my-4 flex flex-col" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid gap-3">
                    <div class="flex flex-col gap-2">
                        <label for="title">Nama</label>
                        <input type="text" name="name" id="nama"
                            class="input-text border-slate-400 rounded-md placeholder:opacity-60 focus:ring-primary"
                            placeholder="Nama Kategori..." value="{{ old('name', $category->name) }}">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        // Initialize Froala editor
        let btnSubmit = document.querySelector('#btn-submit');
        let blogForm = document.querySelector('#blog-form');

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
