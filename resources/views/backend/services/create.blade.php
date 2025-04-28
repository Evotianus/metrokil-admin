@extends('layouts.app')

@section('title', 'Tambah Layanan')
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
                            <input type="number" name="price" id="nama"
                                class="input-text border-slate-400 rounded-md placeholder:opacity-60 focus:ring-primary"
                                placeholder="Harga Layanan...">
                        </div>
                    </div>
                    <div class="col-span-6">
                        <div class="flex flex-col gap-2">
                            <label for="benefits">Benefits</label>
                            <div id="benefits-container">
                                <div class="benefit-input-group flex items-center gap-2 mb-2">
                                    <input type="text" name="benefits[]"
                                        class="benefit-input input-text border-slate-400 rounded-md placeholder:opacity-60 focus:ring-primary w-full"
                                        placeholder="Benefit Layanan...">
                                    <button type="button"
                                        class="add-benefit-btn bg-green-500 text-white px-3 py-1 rounded">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-6">
                    <div class="flex flex-col gap-2">
                        <label for="title">Description</label>
                        <input type="text" name="description" id="description"
                            class="input-text border-slate-400 rounded-md placeholder:opacity-60 focus:ring-primary"
                            placeholder="Deskripsi Layanan...">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        // Initialize Froala editor
        let btnSubmit = document.querySelector('#btn-submit');
        let blogForm = document.querySelector('#blog-form');
        let benefitsContainer = document.querySelector('#benefits-container');

        // Add event listener to the initial "+" button
        document.querySelector('.add-benefit-btn').addEventListener('click', addBenefitField);

        // Function to add a new benefit field
        function addBenefitField() {
            const newGroup = document.createElement('div');
            newGroup.className = 'benefit-input-group flex items-center gap-2 mb-2';

            newGroup.innerHTML = `
                <input type="text" name="benefits[]"
                    class="benefit-input input-text border-slate-400 rounded-md placeholder:opacity-60 focus:ring-primary w-full"
                    placeholder="Benefit Layanan...">
                <button type="button" class="remove-benefit-btn bg-red-500 text-white px-3 py-1 rounded">-</button>
            `;

            benefitsContainer.appendChild(newGroup);

            // Add event listener to the new remove button
            newGroup.querySelector('.remove-benefit-btn').addEventListener('click', function() {
                benefitsContainer.removeChild(newGroup);
            });
        }

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

            // Get all benefit inputs
            const benefitInputs = document.querySelectorAll('.benefit-input');

            // Check if at least one benefit is filled
            let hasBenefit = false;
            benefitInputs.forEach(input => {
                if (input.value.trim() !== '') {
                    hasBenefit = true;
                }
            });

            // Validate fields
            if (!blogForm.name.value || !blogForm.price.value || !hasBenefit) {
                alert('Please fill all the required fields');
                return;
            }

            // Submit the form
            blogForm.submit();
        });
    </script>

@endsection
