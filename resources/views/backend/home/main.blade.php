@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <section class="container-xxl container-p-y">
        <main class="grid grid-rows-2">
            <article class="grid grid-cols-2">
                <div class="grid grid-cols-2 gap-4">
                        <div class="card bg-white border-b-primary border-2">
                            <div class="card-body">
                                <div class="flex items-center gap-3 w-fit">
                                    <div class="icon bg-primary-subtle w-fit p-2 rounded-md">
                                        <img src="{{ asset('assets/boxicons-2.1.4/svg/regular/bx-conversation-primary.svg') }}"
                                            class="filter-primary" alt="">
                                    </div>
                                    <h2 class="text-2xl text-black font-semibold">{{ $blogCount }}</h2>
                                </div>
                                <p class="mt-2">Total Blogs</p>
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
                                <p class="mt-2">Total Testimonials</p>
                            </div>
                        </div>
                        <div class="card bg-white border-b-danger border-b-2">
                            <div class="card-body">
                                <div class="flex items-center gap-3 w-fit">
                                    <div class="icon bg-danger-subtle w-fit p-2 rounded-md">
                                        <img src="{{ asset('assets/boxicons-2.1.4/svg/regular/bx-cog-danger.svg') }}"
                                            class="filter-primary" alt="">
                                    </div>
                                    <h2 class="text-2xl text-black font-semibold">{{ $serviceCount }}</h2>
                                </div>
                                <p class="mt-2">Total Layanan</p>
                            </div>
                        </div>
                        <div class="card bg-white border-b-secondary border-b-2">
                            <div class="card-body">
                                <div class="flex items-center gap-3 w-fit">
                                    <div class="icon bg-secondary-subtle w-fit p-2 rounded-md">
                                        <img src="{{ asset('assets/boxicons-2.1.4/svg/regular/bx-cog-secondary.svg') }}"
                                            class="filter-primary" alt="">
                                    </div>
                                    <h2 class="text-2xl text-black font-semibold">{{ $galleryCount }}</h2>
                                </div>
                                <p class="mt-2">Total Gallery</p>
                            </div>
                        </div>
                    </div>
                    <aside class="pl-4">
                        <div class="card bg-white border-borderColor border-2 h-full">
                            <div class="card-body">
                                <div class="grid grid-rows-2 items-center gap-3 w-full">
                                    <h3 class="text-2xl"> Metrokil Reviews</h3>
                                    <div class="grid grid-cols-2">
                                        <h3>Circle</h3>
                                        <h3>Legend</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>
            </article>

            <article class="mt-4">
                <div class="card bg-white border-borderColor border-2 h-full grid grid-rows-4">
                        <h1 class="text-2xl mt-4 mx-4">Blogs</h1>
                        <h2 class="col-span-2 mt-4 mx-4">test</h2>
                </div>
            </article>
        </main>
    </section>
@endsection
