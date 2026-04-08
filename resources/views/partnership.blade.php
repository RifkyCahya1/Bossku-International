@extends('main')

@section('content')

<div x-data="partnershipForm()" class="min-h-screen bg-[#F7F5F0]">

    {{-- DECORATIVE TOP BAR --}}
    <div class="h-1 bg-gradient-to-r from-amber-400 via-yellow-300 to-amber-500"></div>

    {{-- HERO SECTION --}}
    <div class="relative overflow-hidden bg-white border-b border-stone-100">
        {{-- Subtle background texture --}}
        <div class="absolute inset-0 opacity-[0.03]"
            style="background-image: radial-gradient(circle at 1px 1px, #92400e 1px, transparent 0); background-size: 28px 28px;"></div>

        <div class="relative max-w-7xl mx-auto px-6 py-16 md:py-20 flex flex-col md:flex-row items-center gap-10">
            <div class="flex-1">
                <div class="inline-flex items-center gap-2 bg-amber-50 border border-amber-200 rounded-full px-4 py-1.5 mb-6">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                    <span class="text-amber-700 text-xs font-bold tracking-widest uppercase">Partnership Program</span>
                </div>
                <h1 class="font-['Playfair_Display',serif] text-4xl md:text-5xl font-700 text-stone-900 leading-tight mb-4">
                    Bergabung Bersama<br>
                    <span class="text-amber-500">BossKu Tours</span>
                </h1>
                <p class="text-stone-500 text-base md:text-lg leading-relaxed max-w-md">
                    Jadilah Community Partner kami. Rekomendasikan layanan runner support & travel kepada komunitas Anda — dan dapatkan fee referral setiap kali booking berhasil.
                </p>

                {{-- Benefits pills --}}
                <div class="flex flex-wrap gap-2 mt-6">
                    @foreach(['Rp 100.000/pax fee referral', 'Diskon Rp 150.000 untuk klien', 'Kode referral eksklusif', 'Transfer dalam 7 hari kerja'] as $benefit)
                    <span class="inline-flex items-center gap-1.5 bg-stone-50 border border-stone-200 rounded-full px-3 py-1 text-xs text-stone-600 font-medium">
                        <svg class="w-3 h-3 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        {{ $benefit }}
                    </span>
                    @endforeach
                </div>
            </div>

            {{-- Stats card --}}
            <div class="flex-shrink-0 bg-gradient-to-br from-amber-400 to-yellow-500 rounded-3xl p-8 shadow-xl shadow-amber-200 text-center min-w-[200px]">
                <p class="text-amber-900/70 text-xs font-semibold uppercase tracking-widest mb-4">Keuntungan Partner</p>
                <div class="space-y-4">
                    <div>
                        <p class="text-3xl font-['Playfair_Display',serif] font-bold text-amber-900">Rp 100K</p>
                        <p class="text-amber-800/80 text-xs mt-0.5">per pax booking lunas</p>
                    </div>
                    <div class="w-full h-px bg-amber-300/50"></div>
                    <div>
                        <p class="text-3xl font-['Playfair_Display',serif] font-bold text-amber-900">Rp 150K</p>
                        <p class="text-amber-800/80 text-xs mt-0.5">diskon untuk klien Anda</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- PROGRESS STEPS --}}
    <div class="bg-white border-b border-stone-100 sticky top-0 z-30 shadow-sm">
        <div class="max-w-5xl mx-auto px-6 py-4">
            <div class="flex items-center gap-2">
                @foreach(['Data Diri', 'Rekening', 'Motivasi', 'Konfirmasi'] as $i => $label)
                <div class="flex items-center gap-2 flex-1 min-w-0"
                    :class="{{ $i }} < currentStep ? 'opacity-100' : ({{ $i }} === currentStep ? 'opacity-100' : 'opacity-40')">
                    <div class="flex-shrink-0 w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold transition-all duration-300"
                        :class="{{ $i }} < currentStep ? 'bg-amber-400 text-amber-900' : ({{ $i }} === currentStep ? 'bg-amber-500 text-white ring-4 ring-amber-100' : 'bg-stone-100 text-stone-400')">
                        <span x-show="{{ $i }} < currentStep">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </span>
                        <span x-show="{{ $i }} >= currentStep">{{ $i + 1 }}</span>
                    </div>
                    <span class="text-xs font-medium text-stone-600 truncate hidden sm:block">{{ $label }}</span>
                    @if($i < 3)
                        <div class="flex-1 h-px bg-stone-200 mx-1 hidden sm:block"
                        :class="{{ $i }} < currentStep ? 'bg-amber-300' : 'bg-stone-200'">
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 py-10 md:py-14">

    {{-- SUCCESS STATE --}}
    <div x-show="submitted" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
        <div class="bg-white rounded-xl border border-stone-100 shadow-sm p-10 md:p-16 text-center max-w-2xl mx-auto">
            <div class="w-20 h-20 rounded-full bg-green-50 border-4 border-green-100 flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h2 class="font-['Playfair_Display',serif] text-3xl font-bold text-stone-900 mb-3">Pendaftaran Diterima!</h2>
            <p class="text-stone-500 leading-relaxed mb-6">
                Terima kasih telah mendaftar sebagai Community Partner BossKu Tours. Tim kami akan meninjau data Anda dan mengirimkan konfirmasi beserta <strong class="text-amber-600">kode referral eksklusif</strong> Anda dalam waktu <strong class="text-stone-700">1×24 jam kerja</strong>.
            </p>

            <div class="grid sm:grid-cols-2 gap-4 mb-8">
                <div class="bg-amber-50 border border-amber-100 rounded-2xl p-5 text-left">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="font-semibold text-amber-800 text-sm">Via Email</span>
                    </div>
                    <p class="text-amber-700 text-xs leading-relaxed">Konfirmasi dan kode referral akan dikirim ke email yang Anda daftarkan.</p>
                </div>
                <div class="bg-green-50 border border-green-100 rounded-2xl p-5 text-left">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z" />
                                <path d="M12 0C5.373 0 0 5.373 0 12c0 2.103.547 4.08 1.504 5.805L.051 23.613l5.947-1.559A11.944 11.944 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.817 9.817 0 01-5.003-1.369l-.358-.213-3.712.974.99-3.616-.233-.371A9.818 9.818 0 012.182 12C2.182 6.57 6.57 2.182 12 2.182S21.818 6.57 21.818 12 17.43 21.818 12 21.818z" />
                            </svg>
                        </div>
                        <span class="font-semibold text-green-800 text-sm">Via WhatsApp</span>
                    </div>
                    <p class="text-green-700 text-xs leading-relaxed">Tim kami juga akan menghubungi Anda melalui nomor WhatsApp yang terdaftar.</p>
                </div>
            </div>

            <div class="bg-stone-50 border border-stone-100 rounded-2xl p-5 mb-6 text-left">
                <p class="text-xs text-stone-400 font-semibold uppercase tracking-wider mb-3">Yang Anda Dapatkan</p>
                <ul class="space-y-2">
                    @foreach(['Kode referral unik khusus Anda', 'Materi promosi resmi BossKu Tours', 'Fee Rp 100.000/pax untuk setiap booking lunas', 'Diskon Rp 150.000/pax untuk klien yang menggunakan kode Anda', 'Transfer dalam 7 hari kerja setelah event selesai'] as $item)
                    <li class="flex items-start gap-2.5 text-sm text-stone-600">
                        <svg class="w-4 h-4 text-amber-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        {{ $item }}
                    </li>
                    @endforeach
                </ul>
            </div>

            <p class="text-xs text-stone-400">Pertanyaan? Hubungi kami di <a href="mailto:bosskutourandtravel@gmail.com" class="text-amber-600 hover:text-amber-700 underline underline-offset-2">bosskutourandtravel@gmail.com</a></p>
        </div>
    </div>

    {{-- MAIN FORM --}}
    <div x-show="!submitted">
        <form @submit.prevent="handleSubmit()" x-ref="mainForm">
            <div class="grid lg:grid-cols-3 gap-8">

                {{-- LEFT: FORM STEPS --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- STEP 0: Data Diri --}}
                    <div x-show="currentStep === 0" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                        <div class="bg-white rounded-xl border border-stone-100 shadow-sm p-6 md:p-8">
                            <div class="mb-6">
                                <p class="text-xs font-semibold text-amber-500 uppercase tracking-widest mb-1">Langkah 1 dari 4</p>
                                <h2 class="font-['Playfair_Display',serif] text-2xl font-bold text-stone-900">Data Diri</h2>
                                <p class="text-stone-400 text-sm mt-1">Informasi dasar yang digunakan untuk identifikasi akun partner Anda.</p>
                            </div>

                            <div class="grid sm:grid-cols-2 gap-4">
                                {{-- Nama --}}
                                <div class="space-y-1.5">
                                    <label class="block text-sm font-semibold text-stone-700">Nama Lengkap <span class="text-red-400">*</span></label>
                                    <input type="text" x-model="form.nama" @blur="touch('nama')" @input="errors.nama && validateField('nama')"
                                        placeholder="Nama sesuai identitas"
                                        :class="hasError('nama') ? 'border-red-300 bg-red-50 ring-1 ring-red-200' : 'border-stone-200 focus:border-amber-400 focus:ring-2 focus:ring-amber-100 bg-white'"
                                        class="w-full rounded-xl border px-4 py-3 text-stone-800 placeholder-stone-300 text-sm transition-all outline-none">
                                    <p x-show="hasError('nama')" x-text="errors.nama" class="text-xs text-red-500 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </p>
                                </div>

                                {{-- Perusahaan --}}
                                <div class="space-y-1.5">
                                    <label class="block text-sm font-semibold text-stone-700">Perusahaan / Komunitas <span class="text-stone-300 font-normal text-xs">(opsional)</span></label>
                                    <input type="text" x-model="form.perusahaan"
                                        placeholder="Nama organisasi (jika ada)"
                                        class="w-full rounded-xl border border-stone-200 focus:border-amber-400 focus:ring-2 focus:ring-amber-100 bg-white px-4 py-3 text-stone-800 placeholder-stone-300 text-sm transition-all outline-none">
                                </div>

                                {{-- Email --}}
                                <div class="space-y-1.5">
                                    <label class="block text-sm font-semibold text-stone-700">Alamat Email <span class="text-red-400">*</span></label>
                                    <div class="relative">
                                        <input type="email" x-model="form.email" @blur="touch('email')" @input="errors.email && validateField('email')"
                                            placeholder="nama@email.com"
                                            :class="hasError('email') ? 'border-red-300 bg-red-50 ring-1 ring-red-200 pr-10' : 'border-stone-200 focus:border-amber-400 focus:ring-2 focus:ring-amber-100 bg-white'"
                                            class="w-full rounded-xl border px-4 py-3 text-stone-800 placeholder-stone-300 text-sm transition-all outline-none">
                                        <div x-show="form.email && !errors.email && touched.email" class="absolute right-3 top-1/2 -translate-y-1/2">
                                            <svg class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                    </div>
                                    <p x-show="hasError('email')" x-text="errors.email" class="text-xs text-red-500"></p>
                                    <p x-show="!hasError('email')" class="text-xs text-stone-400">Konfirmasi & kode referral dikirim ke sini</p>
                                </div>

                                {{-- WhatsApp --}}
                                <div class="space-y-1.5">
                                    <label class="block text-sm font-semibold text-stone-700">Nomor WhatsApp <span class="text-red-400">*</span></label>
                                    <div class="flex gap-2">
                                        <div class="flex items-center gap-1.5 bg-stone-50 border border-stone-200 rounded-xl px-3 text-stone-500 text-sm font-medium flex-shrink-0">
                                            🇮🇩 +62
                                        </div>
                                        <input type="tel" x-model="form.whatsappDisplay"
                                            @input="formatWhatsapp($event)"
                                            @blur="touch('whatsapp')"
                                            placeholder="812-3456-7890"
                                            :class="hasError('whatsapp') ? 'border-red-300 bg-red-50 ring-1 ring-red-200' : 'border-stone-200 focus:border-amber-400 focus:ring-2 focus:ring-amber-100 bg-white'"
                                            class="flex-1 rounded-xl border px-4 py-3 text-stone-800 placeholder-stone-300 text-sm transition-all outline-none">
                                    </div>
                                    <p x-show="hasError('whatsapp')" x-text="errors.whatsapp" class="text-xs text-red-500"></p>
                                    <p x-show="!hasError('whatsapp')" class="text-xs text-stone-400">Tim kami akan menghubungi via WA</p>
                                </div>

                                {{-- Kota --}}
                                <div class="space-y-1.5 sm:col-span-2">
                                    <label class="block text-sm font-semibold text-stone-700">Kota / Domisili <span class="text-red-400">*</span></label>
                                    <input type="text" x-model="form.kota" @blur="touch('kota')" @input="errors.kota && validateField('kota')"
                                        placeholder="Contoh: Surabaya, Jakarta, Bandung..."
                                        :class="hasError('kota') ? 'border-red-300 bg-red-50 ring-1 ring-red-200' : 'border-stone-200 focus:border-amber-400 focus:ring-2 focus:ring-amber-100 bg-white'"
                                        class="w-full rounded-xl border px-4 py-3 text-stone-800 placeholder-stone-300 text-sm transition-all outline-none">
                                    <p x-show="hasError('kota')" x-text="errors.kota" class="text-xs text-red-500"></p>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end mt-4">
                            <button type="button" @click="nextStep(0)"
                                class="inline-flex items-center gap-2 bg-stone-900 hover:bg-stone-800 text-white px-6 py-3 rounded-xl font-semibold text-sm transition-all duration-200 hover:shadow-lg">
                                Lanjut ke Rekening
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- STEP 1: Rekening --}}
                    <div x-show="currentStep === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                        <div class="bg-white rounded-3xl border border-stone-100 shadow-sm p-6 md:p-8">
                            <div class="mb-6">
                                <p class="text-xs font-semibold text-amber-500 uppercase tracking-widest mb-1">Langkah 2 dari 4</p>
                                <h2 class="font-['Playfair_Display',serif] text-2xl font-bold text-stone-900">Informasi Rekening</h2>
                                <p class="text-stone-400 text-sm mt-1">Diperlukan untuk pencairan fee referral. Pastikan data akurat sesuai buku tabungan.</p>
                            </div>

                            {{-- Info banner --}}
                            <div class="flex items-start gap-3 bg-amber-50 border border-amber-100 rounded-2xl p-4 mb-6">
                                <svg class="w-5 h-5 text-amber-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                <div>
                                    <p class="text-xs font-semibold text-amber-800 mb-0.5">Data ini aman & terenkripsi</p>
                                    <p class="text-xs text-amber-700 leading-relaxed">Informasi rekening hanya digunakan untuk pencairan fee referral ke akun Anda. Tidak dibagikan ke pihak mana pun.</p>
                                </div>
                            </div>

                            <div class="grid sm:grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="block text-sm font-semibold text-stone-700">Nama Bank <span class="text-red-400">*</span></label>
                                    <select x-model="form.namaBank" @change="touch('namaBank')"
                                        :class="hasError('namaBank') ? 'border-red-300 bg-red-50 ring-1 ring-red-200' : 'border-stone-200 focus:border-amber-400 focus:ring-2 focus:ring-amber-100 bg-white'"
                                        class="w-full rounded-xl border px-4 py-3 text-stone-800 text-sm transition-all outline-none appearance-none cursor-pointer">
                                        <option value="" disabled selected>Pilih bank...</option>
                                        @foreach(['BCA', 'Mandiri', 'BRI', 'BNI', 'BSI', 'CIMB Niaga', 'Permata', 'Danamon', 'BTN', 'Bank Jago', 'SeaBank', 'Jenius (BTPN)', 'Lainnya'] as $bank)
                                        <option value="{{ $bank }}">{{ $bank }}</option>
                                        @endforeach
                                    </select>
                                    <p x-show="hasError('namaBank')" x-text="errors.namaBank" class="text-xs text-red-500"></p>
                                </div>

                                <div class="space-y-1.5">
                                    <label class="block text-sm font-semibold text-stone-700">Nomor Rekening <span class="text-red-400">*</span></label>
                                    <input type="text" x-model="form.nomorRekening" @blur="touch('nomorRekening')" @input="errors.nomorRekening && validateField('nomorRekening')"
                                        placeholder="Contoh: 1234567890"
                                        :class="hasError('nomorRekening') ? 'border-red-300 bg-red-50 ring-1 ring-red-200' : 'border-stone-200 focus:border-amber-400 focus:ring-2 focus:ring-amber-100 bg-white'"
                                        class="w-full rounded-xl border px-4 py-3 text-stone-800 placeholder-stone-300 text-sm transition-all outline-none">
                                    <p x-show="hasError('nomorRekening')" x-text="errors.nomorRekening" class="text-xs text-red-500"></p>
                                </div>

                                <div class="space-y-1.5 sm:col-span-2">
                                    <label class="block text-sm font-semibold text-stone-700">Nama di Rekening <span class="text-red-400">*</span></label>
                                    <input type="text" x-model="form.namaRekening" @blur="touch('namaRekening')" @input="errors.namaRekening && validateField('namaRekening')"
                                        placeholder="Sesuai buku tabungan / identitas"
                                        :class="hasError('namaRekening') ? 'border-red-300 bg-red-50 ring-1 ring-red-200' : 'border-stone-200 focus:border-amber-400 focus:ring-2 focus:ring-amber-100 bg-white'"
                                        class="w-full rounded-xl border px-4 py-3 text-stone-800 placeholder-stone-300 text-sm transition-all outline-none">
                                    <p x-show="hasError('namaRekening')" x-text="errors.namaRekening" class="text-xs text-red-500"></p>
                                    <p x-show="!hasError('namaRekening')" class="text-xs text-stone-400">Harus sama persis dengan nama di buku tabungan</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between mt-4">
                            <button type="button" @click="currentStep = 0"
                                class="inline-flex items-center gap-2 text-stone-500 hover:text-stone-800 px-4 py-3 rounded-xl font-medium text-sm transition-all">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                                Kembali
                            </button>
                            <button type="button" @click="nextStep(1)"
                                class="inline-flex items-center gap-2 bg-stone-900 hover:bg-stone-800 text-white px-6 py-3 rounded-xl font-semibold text-sm transition-all duration-200 hover:shadow-lg">
                                Lanjut ke Motivasi
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- STEP 2: Motivasi / Value --}}
                    <div x-show="currentStep === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                        <div class="bg-white rounded-3xl border border-stone-100 shadow-sm p-6 md:p-8">
                            <div class="mb-6">
                                <p class="text-xs font-semibold text-amber-500 uppercase tracking-widest mb-1">Langkah 3 dari 4</p>
                                <h2 class="font-['Playfair_Display',serif] text-2xl font-bold text-stone-900">Motivasi Bergabung</h2>
                                <p class="text-stone-400 text-sm mt-1">Ceritakan mengapa Anda cocok menjadi Community Partner BossKu Tours.</p>
                            </div>

                            <div class="space-y-1.5">
                                <label class="block text-sm font-semibold text-stone-700">
                                    Apa value yang bisa Anda bawa untuk kerja sama ini? <span class="text-red-400">*</span>
                                </label>
                                <textarea x-model="form.value" @blur="touch('value')" @input="errors.value && validateField('value')"
                                    rows="5"
                                    placeholder="Contoh: Saya adalah ketua komunitas lari Surabaya dengan 500+ anggota aktif. Saya rutin mengorganisasi perjalanan ke event lari nasional dan memiliki kepercayaan tinggi dari komunitas..."
                                    :class="hasError('value') ? 'border-red-300 bg-red-50 ring-1 ring-red-200' : 'border-stone-200 focus:border-amber-400 focus:ring-2 focus:ring-amber-100 bg-white'"
                                    class="w-full rounded-xl border px-4 py-3 text-stone-800 placeholder-stone-300 text-sm transition-all outline-none resize-none leading-relaxed"></textarea>

                                <div class="flex justify-between items-center">
                                    <p x-show="hasError('value')" x-text="errors.value" class="text-xs text-red-500"></p>
                                    <p x-show="!hasError('value')" class="text-xs text-stone-400">Minimal 10 karakter — semakin detail, semakin baik</p>
                                    <p class="text-xs ml-auto" :class="form.value.length >= 10 ? 'text-green-500 font-semibold' : 'text-stone-300'">
                                        <span x-text="form.value.length"></span> karakter
                                    </p>
                                </div>
                            </div>

                            {{-- Tips --}}
                            <div class="mt-6 p-4 bg-stone-50 rounded-2xl border border-stone-100">
                                <p class="text-xs font-semibold text-stone-500 uppercase tracking-wide mb-3">💡 Tips pengisian</p>
                                <ul class="space-y-1.5 text-xs text-stone-500">
                                    @foreach(['Sebutkan komunitas atau jaringan yang Anda miliki', 'Ceritakan pengalaman Anda mengikuti atau mengorganisasi event lari', 'Jelaskan mengapa komunitas Anda akan tertarik dengan layanan BossKu Tours'] as $tip)
                                    <li class="flex items-start gap-2">
                                        <span class="text-amber-400 flex-shrink-0">→</span>
                                        {{ $tip }}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="flex justify-between mt-4">
                            <button type="button" @click="currentStep = 1"
                                class="inline-flex items-center gap-2 text-stone-500 hover:text-stone-800 px-4 py-3 rounded-xl font-medium text-sm transition-all">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                                Kembali
                            </button>
                            <button type="button" @click="nextStep(2)"
                                class="inline-flex items-center gap-2 bg-stone-900 hover:bg-stone-800 text-white px-6 py-3 rounded-xl font-semibold text-sm transition-all duration-200 hover:shadow-lg">
                                Lanjut ke Konfirmasi
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- STEP 3: Review & Konfirmasi --}}
                    <div x-show="currentStep === 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                        {{-- Review Summary --}}
                        <div class="bg-white rounded-3xl border border-stone-100 shadow-sm p-6 md:p-8 mb-4">
                            <div class="mb-6">
                                <p class="text-xs font-semibold text-amber-500 uppercase tracking-widest mb-1">Langkah 4 dari 4</p>
                                <h2 class="font-['Playfair_Display',serif] text-2xl font-bold text-stone-900">Review & Konfirmasi</h2>
                                <p class="text-stone-400 text-sm mt-1">Periksa kembali data Anda sebelum mengirimkan pendaftaran.</p>
                            </div>

                            <div class="space-y-4">
                                {{-- Data Diri Summary --}}
                                <div class="border border-stone-100 rounded-2xl overflow-hidden">
                                    <div class="flex items-center justify-between bg-stone-50 px-4 py-3">
                                        <p class="text-xs font-semibold text-stone-500 uppercase tracking-wide">Data Diri</p>
                                        <button type="button" @click="currentStep = 0" class="text-xs text-amber-600 hover:text-amber-700 font-medium">Edit</button>
                                    </div>
                                    <div class="grid sm:grid-cols-2 divide-y sm:divide-y-0 sm:divide-x divide-stone-100">
                                        <div class="px-4 py-3">
                                            <p class="text-xs text-stone-400 mb-0.5">Nama</p>
                                            <p class="text-sm font-medium text-stone-800" x-text="form.nama || '—'"></p>
                                        </div>
                                        <div class="px-4 py-3">
                                            <p class="text-xs text-stone-400 mb-0.5">Email</p>
                                            <p class="text-sm font-medium text-stone-800" x-text="form.email || '—'"></p>
                                        </div>
                                        <div class="px-4 py-3 border-t border-stone-100">
                                            <p class="text-xs text-stone-400 mb-0.5">WhatsApp</p>
                                            <p class="text-sm font-medium text-stone-800" x-text="form.whatsapp ? '+62' + form.whatsapp : '—'"></p>
                                        </div>
                                        <div class="px-4 py-3 border-t border-stone-100">
                                            <p class="text-xs text-stone-400 mb-0.5">Kota</p>
                                            <p class="text-sm font-medium text-stone-800" x-text="form.kota || '—'"></p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Rekening Summary --}}
                                <div class="border border-stone-100 rounded-2xl overflow-hidden">
                                    <div class="flex items-center justify-between bg-stone-50 px-4 py-3">
                                        <p class="text-xs font-semibold text-stone-500 uppercase tracking-wide">Rekening</p>
                                        <button type="button" @click="currentStep = 1" class="text-xs text-amber-600 hover:text-amber-700 font-medium">Edit</button>
                                    </div>
                                    <div class="grid sm:grid-cols-3 divide-y sm:divide-y-0 sm:divide-x divide-stone-100">
                                        <div class="px-4 py-3">
                                            <p class="text-xs text-stone-400 mb-0.5">Bank</p>
                                            <p class="text-sm font-medium text-stone-800" x-text="form.namaBank || '—'"></p>
                                        </div>
                                        <div class="px-4 py-3">
                                            <p class="text-xs text-stone-400 mb-0.5">Nomor Rekening</p>
                                            <p class="text-sm font-medium text-stone-800" x-text="form.nomorRekening || '—'"></p>
                                        </div>
                                        <div class="px-4 py-3">
                                            <p class="text-xs text-stone-400 mb-0.5">Nama</p>
                                            <p class="text-sm font-medium text-stone-800" x-text="form.namaRekening || '—'"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Agreements --}}
                        <div class="bg-white rounded-3xl border border-stone-100 shadow-sm p-6 md:p-8 mb-4">
                            <h3 class="font-semibold text-stone-900 mb-4 flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Persetujuan & Komitmen
                            </h3>

                            <div class="space-y-3">
                                <label class="flex items-start gap-3 p-4 rounded-2xl border border-stone-100 hover:border-amber-200 hover:bg-amber-50/30 cursor-pointer transition-all"
                                    :class="agreements.accuracy ? 'border-amber-200 bg-amber-50/50' : ''">
                                    <input type="checkbox" x-model="agreements.accuracy" @change="validateAgreements()" class="w-4 h-4 mt-0.5 accent-amber-500 flex-shrink-0">
                                    <span class="text-sm text-stone-600 leading-relaxed">
                                        Seluruh data yang saya berikan adalah <strong class="text-stone-800">benar, akurat, dan dapat dipertanggungjawabkan</strong>. Saya memahami bahwa ketidaksesuaian data dapat menjadi dasar penolakan.
                                    </span>
                                </label>

                                <label class="flex items-start gap-3 p-4 rounded-2xl border border-stone-100 hover:border-amber-200 hover:bg-amber-50/30 cursor-pointer transition-all"
                                    :class="agreements.contact ? 'border-amber-200 bg-amber-50/50' : ''">
                                    <input type="checkbox" x-model="agreements.contact" @change="validateAgreements()" class="w-4 h-4 mt-0.5 accent-amber-500 flex-shrink-0">
                                    <span class="text-sm text-stone-600 leading-relaxed">
                                        Saya mengizinkan <strong class="text-stone-800">BossKu Tours</strong> menghubungi saya melalui email dan WhatsApp terdaftar untuk evaluasi dan konfirmasi kode referral.
                                    </span>
                                </label>

                                <label class="flex items-start gap-3 p-4 rounded-2xl border border-stone-100 hover:border-amber-200 hover:bg-amber-50/30 cursor-pointer transition-all"
                                    :class="agreements.terms ? 'border-amber-200 bg-amber-50/50' : ''">
                                    <input type="checkbox" x-model="agreements.terms" @change="validateAgreements()" class="w-4 h-4 mt-0.5 accent-amber-500 flex-shrink-0">
                                    <span class="text-sm text-stone-600 leading-relaxed">
                                        Saya telah membaca dan menyetujui
                                        <button type="button" @click.prevent="openTermsModal()" class="text-amber-600 hover:text-amber-700 font-semibold underline underline-offset-2 transition">
                                            Perjanjian Community Partner
                                        </button>
                                        termasuk sistem referral, fee, dan etika komunikasi.
                                    </span>
                                </label>
                            </div>

                            <div x-show="errors.agreements" class="mt-3 flex items-center gap-2 text-red-500 text-xs">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                <span x-text="errors.agreements"></span>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="flex justify-between items-center">
                            <button type="button" @click="currentStep = 2"
                                class="inline-flex items-center gap-2 text-stone-500 hover:text-stone-800 px-4 py-3 rounded-xl font-medium text-sm transition-all">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                                Kembali
                            </button>
                            <button type="submit"
                                :disabled="!allAgreementsChecked || isSubmitting"
                                :class="allAgreementsChecked && !isSubmitting
                                        ? 'bg-gradient-to-r from-amber-400 to-yellow-500 hover:from-amber-500 hover:to-yellow-600 text-stone-900 shadow-lg hover:shadow-xl hover:shadow-amber-200 hover:-translate-y-0.5'
                                        : 'bg-stone-100 text-stone-300 cursor-not-allowed'"
                                class="inline-flex items-center gap-2 px-8 py-3.5 rounded-xl font-bold text-sm transition-all duration-200">
                                <span x-show="!isSubmitting" class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    Kirim Pendaftaran
                                </span>
                                <span x-show="isSubmitting" class="flex items-center gap-2">
                                    <svg class="animate-spin h-4 w-4" viewBox="0 0 24 24" fill="none">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                                    </svg>
                                    Mengirim...
                                </span>
                            </button>
                        </div>
                    </div>

                </div>

                {{-- RIGHT SIDEBAR --}}
                <div class="hidden lg:block space-y-4">
                    {{-- How it works --}}
                    <div class="bg-white rounded-xl border border-stone-100 shadow-sm p-6 top-20">
                        <p class="text-xs font-semibold text-stone-400 uppercase tracking-widest mb-4">Alur Setelah Mendaftar</p>
                        <div class="space-y-4">
                            @php
                            $steps = [
                            ['icon' => '📋', 'title' => 'Pendaftaran diterima', 'desc' => 'Data Anda masuk ke sistem BossKu Tours'],
                            ['icon' => '🔍', 'title' => 'Evaluasi (1×24 jam)', 'desc' => 'Tim kami meninjau kelayakan partnership'],
                            ['icon' => '📧', 'title' => 'Konfirmasi via Email & WA', 'desc' => 'Anda menerima notifikasi persetujuan'],
                            ['icon' => '🎫', 'title' => 'Kode referral dikirim', 'desc' => 'Gunakan untuk ajak klien booking dengan diskon'],
                            ['icon' => '💰', 'title' => 'Fee cair otomatis', 'desc' => 'Transfer maks. 7 hari kerja post-event'],
                            ];
                            @endphp
                            @foreach($steps as $i => $step)
                            <div class="flex items-start gap-3">
                                <div class="flex-shrink-0 w-8 h-8 rounded-full bg-amber-50 flex items-center justify-center text-sm">{{ $step['icon'] }}</div>
                                <div>
                                    <p class="text-sm font-semibold text-stone-800">{{ $step['title'] }}</p>
                                    <p class="text-xs text-stone-400 mt-0.5">{{ $step['desc'] }}</p>
                                </div>
                            </div>
                            @if($i < count($steps) - 1)
                                <div class="ml-4 w-px h-4 bg-stone-100">
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>

                {{-- Referral info card --}}
                <div class="bg-gradient-to-br from-stone-900 to-stone-800 rounded-3xl p-6 text-white">
                    <p class="text-xs font-semibold text-stone-400 uppercase tracking-widest mb-3">Cara Kerja Kode Referral</p>
                    <div class="bg-stone-700/50 rounded-2xl p-3 mb-4 font-mono text-center text-amber-300 text-sm tracking-widest font-bold border border-stone-600">
                        BOSSKU-XXXXX
                    </div>
                    <ul class="space-y-2 text-xs text-stone-300">
                        <li class="flex items-start gap-2">
                            <span class="text-amber-400">→</span>
                            Bagikan kode ke calon peserta event lari
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-amber-400">→</span>
                            Mereka input saat booking — diskon <strong class="text-white">Rp 150K/pax</strong>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-amber-400">→</span>
                            Anda otomatis dapat fee <strong class="text-white">Rp 100K/pax</strong>
                        </li>
                    </ul>
                </div>
            </div>
    </div>
    </form>
</div>

{{-- FAQ Section --}}
<div x-show="!submitted" class="mt-16 mb-8">
    <div class="text-center mb-10">
        <p class="text-xs font-semibold text-amber-500 uppercase tracking-widest mb-2">Pertanyaan Umum</p>
        <h2 class="font-['Playfair_Display',serif] text-3xl font-bold text-stone-900">FAQ Partner</h2>
        <p class="text-stone-400 mt-2 text-sm max-w-xl mx-auto">Semua yang perlu Anda tahu tentang sistem referral dan kerja sama dengan BossKu Tours.</p>
    </div>

    <div class="grid md:grid-cols-2 gap-3 md:gap-4">
        @php
        $faqs = [
        ['q' => 'Bagaimana sistem referral dicatat?', 'a' => 'Referral dicatat otomatis berdasarkan kode referral yang digunakan saat booking. Sistem mencatat data booking, kode referral, dan timestamp untuk memastikan keadilan dan transparansi.'],
        ['q' => 'Bagaimana jika klien lupa pakai kode referral?', 'a' => 'Booking tanpa kode referral dapat dipertimbangkan jika: Partner mengawal proses sejak awal, memberi notifikasi awal ke tim BossKu Tours, dan calon peserta menyebut nama Partner di formulir. Keputusan akhir bersifat final.'],
        ['q' => 'Kapan fee referral dibayarkan?', 'a' => 'Fee dibayarkan maksimal 7 hari kerja setelah event lari selesai. Hanya untuk booking berstatus Lunas yang tetap valid hingga event berlangsung.'],
        ['q' => 'Bagaimana jika booking dibatalkan?', 'a' => 'Booking yang dibatalkan, gagal bayar, atau direfund tidak berhak atas fee referral — terlepas dari kapan pembatalannya terjadi.'],
        ['q' => 'Bolehkah saya membagi fee ke orang lain?', 'a' => 'Boleh. Pembagian fee adalah urusan internal Partner. BossKu Tours hanya mencatat dan membayar satu Partner terdaftar, dan tidak mengatur pembagian internal.'],
        ['q' => 'Apakah ini paket resmi dari penyelenggara event?', 'a' => 'Bukan. Runner Support & Travel Series adalah layanan perjalanan pendukung pelari yang independen. Tidak termasuk race entry, bib, atau jaminan slot lomba.'],
        ['q' => 'Siapa yang menangani customer?', 'a' => 'Seluruh komunikasi dan operasional ditangani langsung oleh tim BossKu Tours. Community Partner tidak berkewajiban menangani layanan pelanggan, penagihan, atau operasional lapangan.'],
        ['q' => 'Apakah nama saya ditampilkan ke publik?', 'a' => 'Tidak. Sistem referral bersifat internal, hanya digunakan untuk pencatatan dan perhitungan fee. Nama Partner tidak ditampilkan ke publik atau customer.'],
        ['q' => 'Bolehkah saya menggunakan materi promosi BossKu Tours?', 'a' => 'Boleh — untuk rekomendasi ke komunitas atau jaringan pribadi. Namun materi tidak boleh diubah tanpa persetujuan, dan tidak boleh membuat materi sendiri yang mencantumkan logo atau nama program.'],
        ['q' => 'Ke mana saya hubungi jika ada pertanyaan?', 'a' => 'Hubungi tim BossKu Tours melalui kontak WhatsApp resmi yang diberikan saat onboarding, atau email ke bosskutourandtravel@gmail.com.'],
        ];
        @endphp
        @foreach($faqs as $i => $faq)
        <div x-data="{ open: false }" class="bg-white border border-stone-100 rounded-2xl overflow-hidden hover:border-amber-200 transition-all duration-200">
            <button @click="open = !open" class="w-full flex items-start justify-between p-5 text-left group">
                <span class="font-semibold text-stone-800 text-sm pr-4 leading-snug flex items-start gap-3">
                    <span class="w-6 h-6 rounded-full bg-amber-50 text-amber-500 text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">{{ $i+1 }}</span>
                    {{ $faq['q'] }}
                </span>
                <svg class="w-4 h-4 text-stone-400 flex-shrink-0 mt-0.5 transition-transform duration-200 group-hover:text-amber-500" :class="{'rotate-180 text-amber-500': open}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="open" x-transition class="px-5 pb-5 pt-0">
                <div class="pl-9">
                    <p class="text-sm text-stone-500 leading-relaxed border-t border-stone-50 pt-3">{{ $faq['a'] }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-8 bg-stone-50 border border-stone-100 rounded-2xl p-6 text-center">
        <p class="text-stone-500 text-sm">
            Dokumen FAQ ini dibuat untuk menjaga kejelasan dan profesionalisme antara BossKu Tours dan Community Partner dalam program Runner Support & Travel Series.
        </p>
        <p class="text-stone-400 text-sm mt-2">
            Pertanyaan lain? Email kami di
            <a href="mailto:bosskutourandtravel@gmail.com" class="text-amber-600 hover:text-amber-700 font-medium underline underline-offset-2 transition">bosskutourandtravel@gmail.com</a>
        </p>
    </div>
</div>

{{-- Footer --}}
<div class="border-t border-stone-100 pt-6">
    <p class="text-center text-xs text-stone-300">© {{ date('Y') }} BossKu Tours — Partnership Registration</p>
</div>
</div>

{{-- TERMS MODAL --}}
<div x-show="openTerms" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4"
    style="background: rgba(28,28,28,0.55); backdrop-filter: blur(6px);"
    @click.self="closeTermsModal()" @keydown.escape.window="closeTermsModal()">

    <div class="bg-white w-full max-w-2xl rounded-3xl shadow-2xl overflow-hidden max-h-[90vh] flex flex-col"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        @click.stop>

        <div class="border-b border-stone-100 px-6 py-5 flex items-center justify-between flex-shrink-0">
            <div>
                <h3 class="font-['Playfair_Display',serif] text-lg font-bold text-stone-900">Perjanjian Community Partner</h3>
                <p class="text-xs text-stone-400 mt-0.5">Runner Support & Travel Series — BossKu Tours</p>
            </div>
            <button @click="closeTermsModal()" class="w-8 h-8 rounded-full bg-stone-100 hover:bg-stone-200 flex items-center justify-center text-stone-500 hover:text-stone-800 transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="overflow-y-auto flex-1 px-6 py-6" id="terms-modal-content">
            <div class="space-y-5 text-sm leading-relaxed text-stone-600">
                <div class="bg-amber-50 border border-amber-100 rounded-2xl p-4">
                    <p class="text-amber-800 font-semibold text-xs uppercase tracking-wide mb-2">Penjelasan Umum</p>
                    <p class="text-amber-700 text-xs leading-relaxed">Dokumen ini mengatur kerja sama antara <strong>BossKu Tours</strong> dan <strong>Community Partner</strong> dalam kegiatan rekomendasi layanan perjalanan pendukung pelari. Perjanjian ini <strong>bukan</strong> kerja sama sponsorship atau afiliasi dengan penyelenggara event lari mana pun.</p>
                </div>

                @php
                $termSections = [
                ['title' => '1. Ruang Lingkup Kerja Sama', 'content' => 'Partner membantu merekomendasikan paket Runner Support & Travel Series kepada komunitas atau relasi pribadi melalui kode referral unik. Partner tidak bertindak sebagai penjual, agen resmi, atau perwakilan penyelenggara event maupun BossKu Tours.'],
                ['title' => '2. Sistem Referral & Pelacakan', 'content' => 'Setiap Partner menerima satu kode referral unik. Atribusi diutamakan berdasarkan kode yang digunakan saat booking. Booking tanpa kode dapat dipertimbangkan jika Partner mengawal proses sejak awal, memberi notifikasi ke tim, dan calon peserta menyebut nama Partner. Keputusan BossKu Tours bersifat final.'],
                ['title' => '3. Fee Referral', 'content' => 'Fee sebesar Rp 100.000 per pax diberikan untuk booking berstatus Lunas yang diakui sebagai referral. Dihitung berdasarkan jumlah pax aktual. Booking yang dibatalkan, gagal bayar, atau direfund tidak berhak atas fee.'],
                ['title' => '3A. Diskon untuk Peserta', 'content' => 'Peserta yang booking menggunakan kode referral Partner mendapat potongan Rp 150.000 per pax, hanya berlaku jika kode tercatat dalam sistem dan booking diakui sebagai referral sesuai ketentuan.'],
                ['title' => '4. Sub-Referral & Pembagian Internal', 'content' => 'BossKu Tours hanya mencatat dan membayar satu Partner terdaftar. Pembagian fee ke pihak lain adalah tanggung jawab internal Partner. BossKu Tours tidak menerapkan sistem multi-level atau MLM.'],
                ['title' => '5. Etika Komunikasi', 'content' => 'Partner wajib menyampaikan informasi sesuai materi resmi, tidak mengklaim kerja sama resmi dengan penyelenggara event, dan tidak menjanjikan race entry, bib, slot lomba, atau akses area terbatas.'],
                ['title' => '5A. Materi Promosi', 'content' => 'Partner boleh menggunakan materi promosi resmi untuk rekomendasi non-berbayar. Dilarang memodifikasi materi atau membuat materi sendiri yang mencantumkan logo/nama program tanpa persetujuan tertulis.'],
                ['title' => '6. Pembayaran Fee', 'content' => 'Fee dibayarkan maksimal 7 hari kerja setelah event selesai, ke rekening Partner yang terdaftar, untuk booking berstatus Lunas yang tetap valid hingga event berlangsung.'],
                ['title' => '7. Penghentian Kerja Sama', 'content' => 'BossKu Tours berhak menghentikan kerja sama jika Partner menyampaikan informasi menyesatkan, menyalahgunakan sistem referral, atau melakukan tindakan yang merugikan reputasi BossKu Tours.'],
                ['title' => '8. Penutup', 'content' => 'Perjanjian ini berlaku sejak tanggal disetujui melalui sistem registrasi, berdasarkan prinsip kepercayaan, transparansi, dan profesionalisme.'],
                ];
                @endphp

                @foreach($termSections as $section)
                <div>
                    <h4 class="font-semibold text-stone-900 mb-2">{{ $section['title'] }}</h4>
                    <p>{{ $section['content'] }}</p>
                </div>
                @endforeach

                <div class="pt-4 border-t border-stone-100">
                    <p class="text-xs text-stone-400">Kontak: <a href="mailto:bosskutourandtravel@gmail.com" class="text-amber-600">bosskutourandtravel@gmail.com</a></p>
                </div>
            </div>
        </div>

        <div class="border-t border-stone-100 px-6 py-4 flex justify-end gap-3 flex-shrink-0">
            <button @click="closeTermsModal()" class="px-4 py-2 rounded-xl text-stone-600 hover:text-stone-800 text-sm font-medium transition">Tutup</button>
            <button @click="agreements.terms = true; validateAgreements(); closeTermsModal()"
                class="px-5 py-2 rounded-xl bg-amber-400 hover:bg-amber-500 text-stone-900 font-semibold text-sm transition">
                Saya Setuju
            </button>
        </div>
    </div>
</div>

</div>

<style>
    [x-cloak] {
        display: none !important;
    }

    body.modal-open {
        overflow: hidden;
    }

    select {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%239ca3af' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 16px;
        padding-right: 40px;
    }
</style>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('partnershipForm', () => ({
            currentStep: 0,
            isSubmitting: false,
            submitted: false,
            openTerms: false,
            scrollPosition: 0,
            touched: {},

            form: {
                nama: '',
                perusahaan: '',
                email: '',
                whatsapp: '',
                whatsappDisplay: '',
                kota: '',
                nomorRekening: '',
                namaRekening: '',
                namaBank: '',
                value: ''
            },

            errors: {
                nama: '',
                email: '',
                whatsapp: '',
                kota: '',
                nomorRekening: '',
                namaRekening: '',
                namaBank: '',
                value: '',
                agreements: ''
            },

            agreements: {
                accuracy: false,
                contact: false,
                terms: false
            },

            get allAgreementsChecked() {
                return this.agreements.accuracy && this.agreements.contact && this.agreements.terms;
            },

            hasError(field) {
                return this.touched[field] && this.errors[field];
            },

            touch(field) {
                this.touched[field] = true;
                this.validateField(field);
            },

            formatWhatsapp(event) {
                let val = event.target.value.replace(/\D/g, '');
                this.form.whatsapp = val;
                this.form.whatsappDisplay = val;
                if (this.touched.whatsapp) this.validateField('whatsapp');
            },

            validateField(field) {
                this.errors[field] = '';
                const v = this.form[field];

                const rules = {
                    nama: () => !v.trim() ? 'Nama lengkap wajib diisi' : v.length < 2 ? 'Nama terlalu pendek' : '',
                    email: () => !v.trim() ? 'Email wajib diisi' : !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v) ? 'Format email tidak valid' : '',
                    whatsapp: () => {
                        const n = this.form.whatsapp;
                        if (!n) return 'Nomor WhatsApp wajib diisi';
                        if (!/^[0-9]+$/.test(n)) return 'Hanya boleh berisi angka';
                        if (n.length < 8 || n.length > 13) return 'Panjang nomor tidak valid';
                        return '';
                    },
                    kota: () => !v.trim() ? 'Kota domisili wajib diisi' : '',
                    nomorRekening: () => !v.trim() ? 'Nomor rekening wajib diisi' : !/^[0-9]+$/.test(v) ? 'Hanya angka' : '',
                    namaRekening: () => !v.trim() ? 'Nama di rekening wajib diisi' : '',
                    namaBank: () => !v ? 'Pilih nama bank' : '',
                    value: () => !v.trim() ? 'Pertanyaan ini wajib diisi' : v.trim().length < 10 ? 'Minimal 10 karakter' : '',
                };

                if (rules[field]) this.errors[field] = rules[field]();
            },

            validateAgreements() {
                this.errors.agreements = this.allAgreementsChecked ? '' : 'Centang semua persetujuan untuk melanjutkan';
            },

            validateStep(step) {
                const stepFields = [
                    ['nama', 'email', 'whatsapp', 'kota'],
                    ['namaBank', 'nomorRekening', 'namaRekening'],
                    ['value'],
                    []
                ];
                let valid = true;
                stepFields[step].forEach(f => {
                    this.touched[f] = true;
                    this.validateField(f);
                    if (this.errors[f]) valid = false;
                });
                return valid;
            },

            nextStep(from) {
                if (!this.validateStep(from)) return;
                this.currentStep = from + 1;
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            },

            openTermsModal() {
                this.scrollPosition = window.scrollY;
                this.openTerms = true;
                document.body.classList.add('modal-open');
            },

            closeTermsModal() {
                this.openTerms = false;
                document.body.classList.remove('modal-open');
                window.scrollTo(0, this.scrollPosition);
            },

            async handleSubmit() {
                this.validateAgreements();
                if (!this.allAgreementsChecked) return;

                this.isSubmitting = true;
                try {
                    const response = await fetch('/partnership', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            ...this.form,
                            perusahaan: this.form.perusahaan || null,
                            agreements: this.agreements
                        })
                    });

                    if (response.ok) {
                        this.submitted = true;
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                    } else {
                        const data = await response.json().catch(() => ({}));
                        this.showToast(data.message || 'Terjadi kesalahan. Silakan coba lagi.', 'error');
                    }
                } catch (error) {
                    this.showToast('Koneksi gagal. Periksa jaringan Anda.', 'error');
                } finally {
                    this.isSubmitting = false;
                }
            },

            showToast(message, type = 'info') {
                const el = document.createElement('div');
                el.className = `fixed bottom-6 right-6 px-5 py-3 rounded-2xl shadow-lg z-50 text-sm font-medium transition-all ${
                type === 'error' ? 'bg-red-500 text-white' : 'bg-stone-900 text-white'
            }`;
                el.textContent = message;
                document.body.appendChild(el);
                setTimeout(() => el.remove(), 4000);
            }
        }));
    });
</script>

@endsection