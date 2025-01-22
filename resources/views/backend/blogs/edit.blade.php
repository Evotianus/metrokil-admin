@extends('layouts.app')

@section('title', 'Ubah Blog')

@section('content')
    <div class="container-xxl container-p-y">

        <div class="mb-3 flex justify-between items-center">
            <div class="flex flex-col">
                <h2 class="text-2xl">Ubah Blog</h2>
                <p class="mt-2 text-lg">Ubah blog untuk website Metrokil</p>
            </div>
            <div class="flex gap-3 h-fit">
                <a href="{{ route('blogs.index') }}" class="btn bg-primary-subtle text-primary">Batal</a>
                <x-primary-button id="btn-update">Simpan Perubahan</x-primary-button>
            </div>
        </div>

        <div class="card bg-white py-4 px-7">
            <h2 class="text-lg">Data Blog</h2>
            <form action="{{ route('blogs.update', $blog->id) }}" method="POST" id="blog-form" class="my-4 flex flex-col"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-6 gap-3">
                    <div class="col-span-4">
                        <div class="flex flex-col gap-2">
                            <label for="title">Judul</label>
                            <input type="text" name="title" id="title"
                                class="input-text border-slate-400 rounded-md placeholder:opacity-60 focus:ring-primary"
                                placeholder="Judul blog" value="{{ old('title', $blog->title) }}">
                        </div>
                    </div>
                    <div class="col-span-2">
                        <div class="flex flex-col gap-2">
                            <label for="category">Kategori</label>
                            <select name="category" id="category"
                                class="input-text border-slate-400 rounded-md placeholder:opacity-60 focus:ring-primary">
                                <option value="" disabled>-- Pilih Kategori --</option>
                                <option value="news" {{ old('category', $blog->category) == 'news' ? 'selected' : '' }}>
                                    Berita</option>
                                <option value="information"
                                    {{ old('category', $blog->category) == 'information' ? 'selected' : '' }}>Informasi
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-2 mt-3">
                    <label for="image">Gambar</label>
                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-file"
                            class="flex flex-col items-center justify-center w-full h-64 border-2 border-slate-300 border-dashed rounded-lg cursor-pointer relative"
                            id="image-box"
                            style="background-image: url('{{ $blog->image_path ? Storage::url($blog->image_path) : '' }}'); background-size: contain; background-position: center; background-repeat: no-repeat;">
                            <div id="placeholder-content"
                                class="{{ $blog->image_path ? 'hidden' : 'flex flex-col items-center justify-center pt-5 pb-6' }}">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click
                                        to upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                                    800x400px)</p>
                            </div>
                            <input id="dropzone-file" type="file" class="hidden" accept="image/*" name="image"
                                onchange="previewImage(event)" />
                        </label>
                    </div>
                </div>
                <div class="flex flex-col gap-2 mt-3">
                    <label for="description">Deskripsi</label>
                    <div id="froala">{{ old('description', $blog->description) }}</div>
                </div>
            </form>
        </div>
    </div>
    <script>
        // Initialize Froala editor
        var editor = new FroalaEditor('#froala');

        let btnUpdated = document.querySelector('#btn-update');
        let blogForm = document.querySelector('#blog-form');

        // Preview image function
        function previewImage(event) {
            const fileInput = event.target;
            const imageBox = document.getElementById('image-box');
            const placeholderContent = document.getElementById('placeholder-content');

            if (fileInput.files && fileInput.files[0]) {
                const file = fileInput.files[0];
                const reader = new FileReader();

                reader.onload = function(e) {
                    placeholderContent.style.display = 'none'; // Hide placeholder
                    imageBox.style.backgroundImage = `url(${e.target.result})`;
                    imageBox.style.backgroundSize = 'contain';
                    imageBox.style.backgroundPosition = 'center';
                    imageBox.style.backgroundRepeat = 'no-repeat';
                };

                reader.readAsDataURL(file);
            }
        }

        // Handle form submission
        btnUpdated.addEventListener('click', (e) => {
            e.preventDefault(); // Prevent default button behavior

            // Set Froala content to a hidden input
            const descriptionInput = document.createElement('input');
            descriptionInput.type = 'hidden';
            descriptionInput.name = 'description';
            descriptionInput.value = editor.html.get();
            blogForm.appendChild(descriptionInput);

            blogForm.submit();
        });
    </script>
@endsection
