@extends('layouts.app')

@section('title', 'Tambah Layanan')
<link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet'
        type='text/css' />
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_        editor.pkgd.min.js'>
</script>
@section('content')
    <div class="container-xxl container-p-y">

        <div class="mb-3 flex justify-between items-center">
            <div class="flex flex-col">
                <h2 class="text-2xl">Tambah Layanan</h2>
                <p class="mt-2 text-lg">Buat Layanan Metrokil</p>
            </div>
            <div class="flex gap-3 h-fit">
                <a href="{{ route('services.index') }}" class="btn bg-primary-subtle text-primary">Batal</a>
                <x-primary-button id="btn-submit">Tambah Layanan</x-primary-button>
            </div>
        </div>

        <div class="card bg-white py-4 px-7">
            <h2 class="text-lg">Data Layanan</h2>
            <form action="/services" method="POST" id="blog-form" class="my-4 flex flex-col" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="grid grid-cols-6 gap-3">
                    <div class="col-span-4">
                        <div class="flex flex-col gap-2">
                            <label for="title">Nama</label>
                            <input type="text" name="name" id="nama"
                                class="input-text border-slate-400 rounded-md placeholder:opacity-60 focus:ring-primary"
                                placeholder="Nama Layanan...">
                        </div>
                    </div>
                    <div class="col-span-2">
                        <div class="flex flex-col gap-2">
                            <label for="title">Harga layanan per meter (Rp)</label>
                            <input type="text" name="price" id="nama"
                                class="input-text border-slate-400 rounded-md placeholder:opacity-60 focus:ring-primary"
                                placeholder="Harga Layanan...">
                        </div>
                    </div>
                    <div class="col-span-6">
                        <div class="flex flex-col gap-2">
                            <label for="title">Benefits</label>
                            <input type="text" name="benefits" id="benefits"
                                class="input-text border-slate-400 rounded-md placeholder:opacity-60 focus:ring-primary"
                                placeholder="Benefit Layanan...">
                        </div>
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
