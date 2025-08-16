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
                <h2 class="text-2xl">Testimoni</h2>
                {{-- <p class="mt-2 text-lg">Buat Gallery untuk website Metrokil</p> --}}
            </div>
            <div class="flex gap-3 h-fit">
                <a href="{{ route('galleries.index') }}" class="btn bg-primary-subtle text-primary">Batal</a>
                <x-primary-button id="btn-submit">Tambahkan</x-primary-button>
            </div>
        </div>

        <div class="card bg-white py-4 px-7">
            <h2 class="text-lg">Tambah Testimoni</h2>
            <form action="/testimonials" method="POST" id="blog-form" class="my-4 flex flex-col">
                @csrf
                @method('POST')
                <div class="flex flex-col gap-2">
                    <label for="title">Nama</label>
                    <input type="text" name="name" id="title"
                        class="input-text border-slate-400 rounded-md placeholder:opacity-60 focus:ring-primary"
                        placeholder="Masukkan nama...">
                </div>
                <div class="flex flex-col gap-2 mt-3">
                    <label for="title">Biodata</label>
                    <input type="text" name="bio" id="bio"
                        class="input-text border-slate-400 rounded-md placeholder:opacity-60 focus:ring-primary"
                        placeholder="Masukkan biodata...">
                </div>
                <div class="flex flex-col gap-2 mt-3">
                    <label for="title">Deskripsi Review</label>
                    <textarea name="review" id="review"
                        class="input-text border-slate-400 rounded-md placeholder:opacity-60 focus:ring-primary"
                        placeholder="Masukkan deskripsi review..." rows=5></textarea>
                </div>
            </form>
        </div>
    </div>
    <script>
        let btnSubmit = document.getElementById('btn-submit');
        let blogForm = document.getElementById('blog-form');

        btnSubmit.addEventListener('click', (e) => {
            e.preventDefault();

            if (!blogForm.name.value || !blogForm.bio.value || !blogForm.review.value) {
                alert('Please fill all the fields');
                return;
            }

            blogForm.submit();
        });
    </script>

@endsection
