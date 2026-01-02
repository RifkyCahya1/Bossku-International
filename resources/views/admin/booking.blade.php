@extends('main', ['excludeNavbar' => true, 'excludeFooter' => true])

@section('content')

<div class="min-h-screen bg-[#0E0E10] relative overflow-hidden text-white">

    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute w-[620px] h-[620px] bg-purple-600/20 rounded-full blur-[160px] -top-32 -left-32"></div>
        <div class="absolute w-[620px] h-[620px] bg-blue-500/20 rounded-full blur-[180px] bottom-0 right-0"></div>
    </div>

    @include('admin.Layout.topbar')

    <div class="flex mx-auto mt-10 px-6 gap-8" x-data="{ open:false, booking:null }">

        @include('admin.Layout.sidebar')

        <div class="flex-1">

            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-2xl font-semibold">Booking List</h1>
                    <p class="text-sm text-gray-400">Data pemesanan masuk</p>
                </div>
            </div>

            <div class="bg-white/5 backdrop-blur rounded-xl border border-white/10 overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-white/10 text-gray-300">
                        <tr>
                            <th class="px-6 py-4 text-left">Customer</th>
                            <th class="px-6 py-4">Invoice</th>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">Pax</th>
                            <th class="px-6 py-4">Total</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-white/5">
                        @foreach ($payments as $p)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4">
                                <div class="font-medium">{{ $p->name }}</div>
                                <div class="text-xs text-gray-400">{{ $p->email }}</div>
                            </td>

                            <td class="px-6 py-4 text-center">
                                {{ $p->invoice_number }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                {{ \Carbon\Carbon::parse($p->date)->format('d M Y') }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                {{ $p->guests }} pax
                            </td>

                            <td class="px-6 py-4 text-center font-semibold">
                                Rp {{ number_format($p->total) }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full text-xs
                                @if($p->status == 'PENDING') bg-yellow-500/20 text-yellow-400
                                @elseif($p->status == 'PAID') bg-green-500/20 text-green-400
                                @else bg-red-500/20 text-red-400 @endif">
                                    {{ $p->status }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-center">
                                <button
                                    @click="open=true; booking=@js($p)"
                                    class="px-4 py-2 rounded-lg bg-indigo-600/80 hover:bg-indigo-600">
                                    Detail
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>


            <div class=" mt-4 mb-10 flex items-center justify-between text-white text-sm">
                <span>
                    Menampilkan {{ $payments->firstItem() }} - {{ $payments->lastItem() }} dari {{ $payments->total() }} produk
                </span>

                <div>
                    {{ $payments->links('admin.pagination.custom') }}
                </div>
            </div>
        </div>
        <div
            x-show="open"
            x-transition
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur">

            <div @click.outside="open=false"
                class="w-full max-w-lg bg-[#121216] rounded-2xl p-8 border border-white/10">

                <h2 class="text-xl font-semibold mb-6">Detail Booking</h2>

                <div class="space-y-3 text-sm text-gray-300">
                    <p><span class="text-gray-400">Nama:</span> <span x-text="booking.name"></span></p>
                    <p><span class="text-gray-400">Email:</span> <span x-text="booking.email"></span></p>
                    <p><span class="text-gray-400">Invoice:</span> <span x-text="booking.invoice_number"></span></p>
                    <p><span class="text-gray-400">Total:</span> Rp <span x-text="new Intl.NumberFormat('id-ID').format(booking.total)"></span></p>
                    <p><span class="text-gray-400">Tanggal:</span> <span x-text="new Date(booking.date).toLocaleDateString('id-ID', { year: 'numeric', month: 'short', day: '2-digit' })"></span></p>
                    <p><span class="text-gray-400">Status:</span> <span x-text="booking.status"></span></p>
                </div>

                <div class="flex justify-end gap-3 mt-8">
                    <form :action="`/admin/booking/${booking.id}/paid`" method="POST">
                        @csrf
                        <button class="px-4 py-2 rounded-lg bg-green-600/80 hover:bg-green-600">
                            Tandai PAID
                        </button>
                    </form>

                    <form :action="`/admin/booking/${booking.id}/failed`" method="POST">
                        @csrf
                        <button class="px-4 py-2 rounded-lg bg-red-600/80 hover:bg-red-600">
                            FAILED
                        </button>
                    </form>

                    <button
                        @click="open=false"
                        class="px-4 py-2 rounded-lg bg-white/10 hover:bg-white/20">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection