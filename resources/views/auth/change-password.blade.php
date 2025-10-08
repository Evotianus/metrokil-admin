@extends('layouts.app')

@section('title', 'Tambah Layanan')
@section('content')
    <div class="container-xxl container-p-y">

        <div class="mb-3 flex justify-between items-center">
            <div class="flex flex-col">
                <h2 class="text-2xl">Pengaturan</h2>
                {{-- <p class="mt-2 text-lg">Buat Layanan Metrokil</p> --}}
            </div>
            <div class="flex gap-3 h-fit">
                <a href="{{ route('home.index') }}" class="btn bg-primary-subtle text-primary">Batal</a>
                <x-primary-button id="btn-submit">Ubah</x-primary-button>
            </div>
        </div>

        <div class="card bg-white py-4 px-7">
            <h2 class="text-lg">Ubah Sandi</h2>
            <form action="/settings/change-password" method="POST" id="blog-form" class="my-4 flex flex-col">
                @csrf
                @method('POST')
                <div class="col-span-4">
                    <div class="flex flex-col gap-2">
                        <label for="title">Password Saat Ini</label>
                        <input type="password" name="current_password" id="current_password"
                            class="input-text border-slate-400 rounded-md placeholder:opacity-60 focus:ring-primary"
                            placeholder="Password saat ini...">
                    </div>
                </div>
                <div class="col-span-6 mt-3">
                    <div class="flex flex-col gap-2">
                        <label for="title">Password Baru</label>
                        <input type="text" name="new_password" id="new_password"
                            class="input-text border-slate-400 rounded-md placeholder:opacity-60 focus:ring-primary"
                            placeholder="Password baru...">
                    </div>
                </div>
                <div class="col-span-6 mt-3">
                    <div class="flex flex-col gap-2 mb-2">
                        <label for="title">Ulangi Password Baru</label>
                        <input type="text" name="new_password_confirmation" id="new_password_confirmation"
                            class="input-text border-slate-400 rounded-md placeholder:opacity-60 focus:ring-primary"
                            placeholder="Ulangi password baru...">
                    </div>
                    <span class="alert text-red-500" style="color: red;"></span>
                </div>
            </form>
        </div>
    </div>
    <script>
        let btnSubmit = document.querySelector('#btn-submit');
        let blogForm = document.querySelector('#blog-form');

        let currentPassword = document.querySelector('#current_password');
        let newPassword = document.querySelector('#new_password');
        let newPasswordConfirmation = document.querySelector('#new_password_confirmation');

        let alertMessage = document.querySelector('.alert');

        newPasswordConfirmation.addEventListener('input', () => {
            console.log('Checking password match...');
            if (newPassword.value !== newPasswordConfirmation.value) {
                newPasswordConfirmation.setCustomValidity("Passwords do not match");
                newPasswordConfirmation.classList.add('border-red-500');
                alertMessage.classList.add('text-red-500');
                alertMessage.textContent = "Password tidak sesuai!";
            } else {
                newPasswordConfirmation.setCustomValidity("");
                alertMessage.textContent = "";
            }
        });

        btnSubmit.addEventListener('click', (e) => {
            e.preventDefault();

            if (!blogForm.current_password.value || !blogForm.new_password.value || !blogForm.new_password_confirmation.value) {
                alert('Tolong lengkapi data!');
                return;
            }

            blogForm.submit();
        });
    </script>

@endsection
