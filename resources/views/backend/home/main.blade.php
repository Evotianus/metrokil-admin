@extends('layouts.app')

@section('title', 'Home')

@section('content')
<section class="container-xxl container-p-y">
    <main class="flex flex-col lg:grid lg:grid-rows-2 gap-4">
        
        <!-- Bagian Cards + Aside -->
        <article class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            
            <!-- 4 Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                <div class="card bg-white border-b-primary border-2">
                    <div class="card-body">
                        <div class="flex items-center gap-3 w-fit">
                            <div class="icon bg-primary-subtle w-fit p-2 rounded-md">
                                <img src="{{ asset('assets/boxicons-2.1.4/svg/regular/bx-conversation-primary.svg') }}" class="filter-primary" alt="">
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
                                <img src="{{ asset('assets/boxicons-2.1.4/svg/solid/bxs-quote-left-warning.svg') }}" class="filter-primary" alt="">
                            </div>
                            <h2 class="text-2xl text-black font-semibold">{{ $testimonialCount }}</h2>
                        </div>
                        <p class="mt-2">Total Testimonials</p>
                    </div>
                </div>
                <div class="card bg-white border-b-danger border-b-2">
                    <div class="card-body">
                        <div class="flex items-center gap-3 w-fit">
                            <div class="icon bg-danger-subtle w-fit p-2 rounded-md">
                                <img src="{{ asset('assets/boxicons-2.1.4/svg/regular/bx-cog-danger.svg') }}" class="filter-primary" alt="">
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
                                <img src="{{ asset('assets/boxicons-2.1.4/svg/regular/bx-cog-secondary.svg') }}" class="filter-primary" alt="">
                            </div>
                            <h2 class="text-2xl text-black font-semibold">{{ $galleryCount }}</h2>
                        </div>
                        <p class="mt-2">Total Gallery</p>
                    </div>
                </div>
            </div>

            <!-- Aside Pie Chart -->
            <aside class="pl-0 lg:pl-4">
                <div class="card bg-white border-borderColor border-2 h-full">
                    <div class="card-body">
                        <div class="w-full">
                            <h3 class="text-2xl mb-4">Metrokil Reviews</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 items-center gap-4">
                                <!-- Chart -->
                                <div class="w-40 h-40 mx-auto relative">
                                    <canvas id="reviewsChart"></canvas>
                                </div>
                                <!-- Legend -->
                                <div class="flex flex-col gap-2 sm:pl-2">
                                    <div class="flex items-center gap-2">
                                        <span class="w-4 h-4 rounded-full bg-blue-500"></span>
                                        <p>Positif</p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="w-4 h-4 rounded-full bg-yellow-400"></span>
                                        <p>Netral</p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="w-4 h-4 rounded-full bg-red-500"></span>
                                        <p>Negatif</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

        </article>

        <!-- Bagian Blog Table -->
        <article class="mt-4">
            <div class="rounded-xl bg-white border-borderColor border-2 h-full flex flex-col">
                <div class="mt-4 mx-4 flex flex-wrap items-center gap-2">
                    <h1 class="text-2xl">Blogs</h1>
                    <div class="rounded-full w-12 h-6 bg-primary-subtle flex justify-center">
                        <p class="flex justify-center items-center h-full">{{ $blogCount }}</p>
                    </div>
                </div>

                <!-- Search -->
                <div class="mt-4 mx-4">
                    <div class="flex items-center bg-white rounded-lg border-2 border-borderColor px-2">
                        <i class="bx bx-search fs-4 lh-0"></i>
                        <form action="{{ route('home.index') }}" method="GET" class="flex flex-1">
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   class="bg-white border-none w-full focus:outline-none focus:ring-0"
                                   placeholder="Search..."
                                   onkeypress="return event.keyCode !== 13 || this.form.submit()">
                        </form>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-responsive text-nowrap mt-8">
                    <table class="table w-full">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Kategori</th>
                                <th>Pembuat</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($blogs as $blog)
                            <tr>
                                <td><strong>{{ \Str::limit($blog->title, 30) }}</strong></td>
                                <td>{{ \Str::limit(strip_tags($blog->description), 40) }}</td>
                                <td>
                                    @if ($blog->category == 'news')
                                        <span class="badge bg-label-primary me-1">Berita</span>
                                    @else
                                        <span class="badge bg-label-warning me-1">Informasi</span>
                                    @endif
                                </td>
                                <td>{{ $blog->user->name }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('blogs.edit', $blog->id) }}">
                                                <i class="bx bx-edit-alt me-1"></i> Edit
                                            </a>
                                            <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="dropdown-item">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">
                                                    <i class="bx bx-trash me-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="my-4 mx-4 flex justify-center sm:justify-end">
                        {{ $blogs->links() }}
                    </div>
                </div>
            </div>
        </article>
    </main>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const ctx = document.getElementById('reviewsChart').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Positif', 'Netral', 'Negatif'],
            datasets: [{
                data: [45, 30, 25],
                backgroundColor: ['#3B82F6', '#FACC15', '#EF4444'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }
        }
    });
});
</script>
@endsection
