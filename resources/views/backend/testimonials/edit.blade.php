@extends('layouts.app')

@section('title', 'Ubah Gallery')
<link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet'
    type='text/css' />
<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js'>
</script>
@section('content')
    <div class="container-xxl container-p-y">

        <div class="mb-3 flex justify-between items-center">
            <div class="flex flex-col">
                <h2 class="text-2xl">Ubah foto</h2>
                <p class="mt-2 text-lg">Ubah foto untuk website Metrokil</p>
            </div>
            <div class="flex gap-3 h-fit">
                <a href="{{ route('testimonials.index') }}" class="btn bg-primary-subtle text-primary">Batal</a>
                <x-primary-button id="btn-update">Simpan Perubahan</x-primary-button>
            </div>
        </div>

        <div class="card bg-white py-4 px-7">
            <h2 class="text-lg">Data Testimoni</h2>
            <form action="{{ route('testimonials.update', $testimonial->id) }}" method="POST" id="testimonial-form"
                class="my-4 flex flex-col">
                @csrf
                @method('PUT')
                <div class="flex flex-col gap-2">
                    <label for="title">Nama</label>
                    <input type="text" name="name" id="title"
                        class="input-text border-slate-400 rounded-md placeholder:opacity-60 focus:ring-primary"
                        placeholder="Nama Testimoni" value="{{ old('name', $testimonial->name) }}">
                </div>
                <div class="flex flex-col gap-2 mt-3">
                    <label for="title">Biodata</label>
                    <input type="text" name="bio" id="bio"
                        class="input-text border-slate-400 rounded-md placeholder:opacity-60 focus:ring-primary"
                        placeholder="Masukkan biodata..." value="{{ old('bio', $testimonial->bio) }}">
                </div>
                <div class="flex flex-col gap-2 mt-3">
                    <label for="title">Deskripsi Review</label>
                    <textarea name="review" id="review"
                        class="input-text border-slate-400 rounded-md placeholder:opacity-60 focus:ring-primary"
                        placeholder="Masukkan deskripsi review..." rows=5>{{ old('review', $testimonial->review) }}</textarea>
                </div>
            </form>
        </div>
    </div>
    <script>
        let btnUpdate = document.getElementById('btn-update');
        let testimonialForm = document.getElementById('testimonial-form');
        btnUpdate.addEventListener('click', (e) => {
            e.preventDefault();

            if (!testimonialForm.name.value || !testimonialForm.bio.value || !testimonialForm.review.value) {
                alert('Please fill all the fields');
                return;
            }

            testimonialForm.submit();
        });
    </script>
@endsection
