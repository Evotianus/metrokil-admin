@extends('layouts.app')

@section('title', 'Tambah Gallery')
<link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet'
        type='text/css' />
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js'>
</script>
@section('content')
    <div class="container-xxl container-p-y">

        <div class="mb-3 flex justify-between items-center">
            <div class="flex flex-col">
                <h2 class="text-2xl">Tambah Foto</h2>
                <p class="mt-2 text-lg">Buat Gallery untuk website Metrokil</p>
            </div>
            <div class="flex gap-3 h-fit">
                <a href="{{ route('galleries.index') }}" class="btn bg-primary-subtle text-primary">Batal</a>
                <x-primary-button id="btn-submit">Tambah Foto</x-primary-button>
            </div>
        </div>

        <div class="card bg-white py-4 px-7">
            <h2 class="text-lg">Data Gallery</h2>
            <form action="/galleries" method="POST" id="blog-form" class="my-4 flex flex-col" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="grid grid-cols-6 gap-3">
                    <div class="col-span-4">
                        <div class="flex flex-col gap-2">
                            <label for="title">Nama</label>
                            <input type="text" name="name" id="title"
                                class="input-text border-slate-400 rounded-md placeholder:opacity-60 focus:ring-primary"
                                placeholder="Nama Foto">
                        </div>
                    </div>
                    <div class="col-span-2">
                        <div class="flex flex-col gap-2">
                            <label for="category">Kategori</label>
                            <select name="category" id="category"
                                class="input-text border-slate-400 rounded-md placeholder:opacity-60 focus:ring-primary">
                                <option value="" disabled selected>-- Pilih Kategori --</option>
                                <option value="Penyuntikan Anti Rayap Kusen Jendela">Penyuntikan Anti Rayap Kusen Jendela</option>
                                <option value="Penyuntikan Anti Rayap Kusen Pintu">Penyuntikan Anti Rayap Kusen Pintu</option>
                                <option value="Penyuntikan Anti Rayap Dinding Keramik Kamar Mandi">Penyuntikan Anti Rayap Dinding Keramik Kamar Mandi</option>
                                <option value="Penyuntikan Anti Rayap Lantai Dasar">Penyuntikan Anti Rayap Lantai Dasar</option>
                                <option value="Lubang Penyuntikan Anti Rayap Sebelum Ditambal">Lubang Penyuntikan Anti Rayap Sebelum Ditambal</option>
                                <option value="Lubang Penyuntikan Anti Rayap Setelah Ditambal">Lubang Penyuntikan Anti Rayap Setelah Ditambal</option>
                                <option value="Penyuntikan Anti Rayap Di Atas Lemari">Penyuntikan Anti Rayap Di Atas Lemari</option>
                                <option value="Penyemprotan Anti Rayap Plafon Gypsum">Penyemprotan Anti Rayap Plafon Gypsum</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-2 mt-3">
                    <label for="image">Gambar</label>
                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-file"
                            class="flex flex-col items-center justify-center w-full h-64 border-2 border-slate-300 border-dashed rounded-lg cursor-pointer relative"
                            id="image-box">
                            <div id="placeholder-content" class="flex flex-col items-center justify-center pt-5 pb-6">
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
                    <div id="froala"></div>
                </div>
            </form>
        </div>
    </div>
    <script>
        // Initialize Froala editor
        var editor = new FroalaEditor('#froala');
        let btnSubmit = document.querySelector('#btn-submit');
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
        btnSubmit.addEventListener('click', (e) => {
            e.preventDefault(); // Prevent default button behavior

            // Validate fields
            if (!blogForm.title.value || !blogForm.category.value || !blogForm.image.value || !editor.html.get()) {
                alert('Please fill all the fields');
                return;
            }

            // Set Froala content to a hidden input
            const descriptionInput = document.createElement('input');
            descriptionInput.type = 'hidden';
            descriptionInput.name = 'description';
            descriptionInput.value = editor.html.get();
            blogForm.appendChild(descriptionInput);

            // Submit the form
            blogForm.submit();
        });
    </script>

@endsection
