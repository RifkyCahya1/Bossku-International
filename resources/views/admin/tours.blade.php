@extends('main', ['excludeNavbar' => true, 'excludeFooter' => true])

@section('content')

<div class="min-h-screen bg-[#0E0E10] relative overflow-hidden">

    {{-- BACKGROUND --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute w-[600px] h-[600px] bg-purple-600/20 rounded-full blur-[140px] -top-20 -left-20"></div>
        <div class="absolute w-[600px] h-[600px] bg-blue-500/20 rounded-full blur-[160px] bottom-0 right-0"></div>
    </div>

    @include('admin.Layout.topbar')

    <div class="flex mx-auto mt-10 px-6 gap-8">

        @include('admin.Layout.sidebar')

        <main class="flex-1 text-white">

            <div class="flex items-center justify-between mb-6">
                <h2 class="text-3xl font-semibold">Manage Tours</h2>
            </div>

            <form method="GET" class="mb-6">
                <input
                    type="text"
                    name="search"
                    placeholder="Cari judul, kota, atau kode tour..."
                    value="{{ $search }}"
                    class="w-80 bg-white/10 border border-white/20 rounded-xl px-4 py-2 text-white placeholder-gray-400 focus:outline-none">
                <button class="ml-2 px-4 py-2 bg-purple-600 rounded-xl hover:bg-purple-700 transition">
                    Cari
                </button>
            </form>

            <div class="backdrop-blur-xl bg-white/5 border border-white/10 rounded-2xl p-6">

                <table class="w-full border-collapse">
                    <thead>
                        <tr class="text-gray-300 border-b border-white/10 text-left">
                            <th class="py-3">Kode Tour</th>
                            <th class="py-3">Nama</th>
                            <th class="py-3">Pax</th>
                            <th class="py-3">Harga</th>
                            <th class="py-3 text-right">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($tours as $t)
                        <tr class="border-b border-white/5 text-gray-200">

                            <td class="py-4 font-semibold">{{ $t->landtour }}</td>

                            <td>
                                {{ $t->judul ?? '-' }} <br>
                                <span class="text-gray-400 text-sm">{{ $t->kota }}</span>
                            </td>

                            <td>{{ $t->pax ?? 'N/A' }}</td>

                            <td class="py-3">
                                <span class="text-gray-500 text-sm italic">IDR {{ number_format($t->agent_twn) }}</span>
                            </td>

                            <td class="text-right">
                                <a href="#" class="text-blue-400 hover:underline mr-4">Detail</a>
                                <a href="#" class="text-purple-400 hover:underline">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

            <div class=" mt-4 mb-10 flex items-center justify-between text-white text-sm">
                <span>
                    Menampilkan {{ $tours->firstItem() }} - {{ $tours->lastItem() }} dari {{ $tours->total() }} produk
                </span>

                <div>
                    {{ $tours->links('admin.pagination.custom') }}
                </div>
            </div>


        </main>

    </div>

</div>

@endsection