@extends('main', ['title' => 'Booking Tour'])

@section('content')
<div class="relative min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-900 via-gray-800 to-black overflow-hidden">
    <!-- Background -->
    <div class="absolute inset-0">
        <img src="{{ asset('img/travel-bg.jpg') }}" alt="Travel Background" class="w-full h-full object-cover opacity-30">
        <div class="absolute inset-0 bg-gradient-to-br from-black/70 via-gray-900/70 to-black/80"></div>
    </div>

    <!-- Booking Card -->
    <div x-data="{ step: 1 }" class="relative z-10 w-full max-w-2xl bg-white/10 backdrop-blur-md rounded-2xl shadow-2xl p-8 border border-white/20">
        <h2 class="text-center text-3xl font-semibold text-white tracking-wide mb-8">🛫 Booking Tour Sekarang</h2>

        <!-- Step Indicator -->
        <div class="flex justify-center space-x-4 mb-6">
            <template x-for="i in 3" :key="i">
                <div :class="{
                    'w-10 h-10 flex items-center justify-center rounded-full border-2 transition-all': true,
                    'border-[#c8a85b] bg-[#c8a85b] text-white': step === i,
                    'border-gray-400 text-gray-400': step !== i
                }" x-text="i"></div>
            </template>
        </div>

        <!-- Step 1 -->
        <div x-show="step === 1" x-transition>
            <div class="space-y-4">
                <div>
                    <label class="text-gray-300 text-sm">Nama Lengkap</label>
                    <input type="text" placeholder="Masukkan nama anda" class="mt-1 w-full p-3 rounded-xl bg-white/10 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#c8a85b]">
                </div>
                <div>
                    <label class="text-gray-300 text-sm">Email</label>
                    <input type="email" placeholder="Masukkan email aktif" class="mt-1 w-full p-3 rounded-xl bg-white/10 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#c8a85b]">
                </div>
                <div>
                    <label class="text-gray-300 text-sm">Nomor Telepon</label>
                    <input type="tel" placeholder="08xxxxxxxxxx" class="mt-1 w-full p-3 rounded-xl bg-white/10 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#c8a85b]">
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button @click="step++" class="px-6 py-3 bg-[#c8a85b] hover:bg-[#b8964f] text-white rounded-xl transition-all font-semibold">Lanjut</button>
            </div>
        </div>

        <!-- Step 2 -->
        <div x-show="step === 2" x-transition>
            <div class="space-y-4">
                <div>
                    <label class="text-gray-300 text-sm">Destinasi</label>
                    <select class="mt-1 w-full p-3 rounded-xl bg-white/10 text-white focus:outline-none focus:ring-2 focus:ring-[#c8a85b]">
                        <option value="" disabled selected>Pilih destinasi</option>
                        <option>Bali</option>
                        <option>Singapura</option>
                        <option>Thailand</option>
                        <option>Japan</option>
                    </select>
                </div>
                <div>
                    <label class="text-gray-300 text-sm">Tanggal Keberangkatan</label>
                    <input type="date" class="mt-1 w-full p-3 rounded-xl bg-white/10 text-white focus:outline-none focus:ring-2 focus:ring-[#c8a85b]">
                </div>
                <div>
                    <label class="text-gray-300 text-sm">Jumlah Peserta</label>
                    <input type="number" min="1" class="mt-1 w-full p-3 rounded-xl bg-white/10 text-white focus:outline-none focus:ring-2 focus:ring-[#c8a85b]">
                </div>
            </div>

            <div class="flex justify-between mt-6">
                <button @click="step--" class="px-6 py-3 bg-gray-600 hover:bg-gray-500 text-white rounded-xl transition-all font-semibold">Kembali</button>
                <button @click="step++" class="px-6 py-3 bg-[#c8a85b] hover:bg-[#b8964f] text-white rounded-xl transition-all font-semibold">Lanjut</button>
            </div>
        </div>

        <!-- Step 3 -->
        <div x-show="step === 3" x-transition>
            <div class="text-center text-white space-y-4">
                <h3 class="text-2xl font-semibold">Konfirmasi Data</h3>
                <p class="text-gray-400 text-sm">Pastikan semua data sudah benar sebelum dikirim.</p>
                <div class="mt-6 space-y-2">
                    <p><span class="font-semibold text-[#c8a85b]">Nama:</span> <span>—</span></p>
                    <p><span class="font-semibold text-[#c8a85b]">Destinasi:</span> <span>—</span></p>
                    <p><span class="font-semibold text-[#c8a85b]">Tanggal:</span> <span>—</span></p>
                </div>
            </div>

            <div class="flex justify-between mt-8">
                <button @click="step--" class="px-6 py-3 bg-gray-600 hover:bg-gray-500 text-white rounded-xl transition-all font-semibold">Kembali</button>
                <button class="px-6 py-3 bg-[#c8a85b] hover:bg-[#b8964f] text-white rounded-xl transition-all font-semibold">Kirim Booking</button>
            </div>
        </div>
    </div>
</div>
@endsection