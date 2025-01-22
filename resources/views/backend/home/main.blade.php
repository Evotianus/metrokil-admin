@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container-xxl container-p-y">
        <div class="grid grid-cols-3 gap-4">
            <div class="card bg-white border-b-primary border-b-2">
                <div class="card-body">
                    <div class="flex items-center gap-3 w-fit">
                        <div class="icon bg-primary-subtle w-fit p-2 rounded-md">
                            <img src="{{ asset('assets/boxicons-2.1.4/svg/regular/bx-conversation-primary.svg') }}"
                                class="filter-primary" alt="">
                        </div>
                        <h2 class="text-2xl text-black font-semibold">5</h2>
                    </div>
                    <p class="mt-2">Total Blog</p>
                </div>
            </div>
            <div class="card bg-white border-b-warning border-b-2">
                <div class="card-body">
                    <div class="flex items-center gap-3 w-fit">
                        <div class="icon bg-warning-subtle w-fit p-2 rounded-md">
                            <img src="{{ asset('assets/boxicons-2.1.4/svg/solid/bxs-quote-left-warning.svg') }}"
                                class="filter-primary" alt="">
                        </div>
                        <h2 class="text-2xl text-black font-semibold">5</h2>
                    </div>
                    <p class="mt-2">Total Testimonial</p>
                </div>
            </div>
            <div class="card bg-white border-b-danger border-b-2">
                <div class="card-body">
                    <div class="flex items-center gap-3 w-fit">
                        <div class="icon bg-danger-subtle w-fit p-2 rounded-md">
                            <img src="{{ asset('assets/boxicons-2.1.4/svg/regular/bx-cog-danger.svg') }}"
                                class="filter-primary" alt="">
                        </div>
                        <h2 class="text-2xl text-black font-semibold">5</h2>
                    </div>
                    <p class="mt-2">Total Layanan</p>
                </div>
            </div>
        </div>
    </div>
@endsection
