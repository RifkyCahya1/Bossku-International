@extends('main')

@section('content')
<div
    x-data="partnershipForm()"
    class="relative min-h-screen overflow-hidden bg-gradient-to-br from-black via-neutral-900 to-black text-slate-100">

    <div class="absolute -top-40 -right-40 w-[500px] h-[500px] bg-amber-400/20 blur-3xl rounded-full"></div>
    <div class="absolute bottom-40 left-40 w-[400px] h-[400px] bg-amber-400/10 blur-3xl rounded-full"></div>

    <div class="relative max-w-5xl mx-auto px-4 sm:px-6 py-12 md:py-20">

        <!-- HEADER -->
        <div class="text-center mb-10 md:mb-14">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-semibold text-white mb-4">
                Partnership Registration
            </h1>
            <p class="text-slate-400 max-w-2xl mx-auto text-sm md:text-base">
                Pendaftaran partner BossKu Tours.
                Kami hanya melanjutkan diskusi dengan partner yang sesuai.
            </p>
        </div>

        <!-- STEP INDICATOR -->
        <div class="flex justify-center mb-8 md:mb-12">
            @foreach (['Data Dasar & Konfirmasi'] as $i => $label)
            <div class="text-center max-w-xs">
                <div class="mx-auto w-12 h-12 flex items-center justify-center rounded-full border-2 transition bg-gradient-to-br from-amber-400 to-yellow-500 text-black font-semibold shadow-lg">
                    {{ $i+1 }}
                </div>
                <p class="mt-3 text-sm font-medium text-amber-400">
                    {{ $label }}
                </p>
            </div>
            @endforeach
        </div>

        <!-- FORM CONTAINER -->
        <div class="bg-black/50 backdrop-blur-lg border border-white/10 rounded-3xl p-6 md:p-10 shadow-2xl mb-16">
            <form @submit.prevent="submitForm()" class="space-y-8 md:space-y-10" x-ref="mainForm">

                <!-- Bagian A: Data Dasar -->
                <div class="space-y-6">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 bg-amber-400 rounded-full"></div>
                        <h2 class="text-lg md:text-xl font-semibold text-amber-400">
                            Data Dasar Partner
                        </h2>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4 md:gap-6">
                        <!-- Nama Lengkap -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-slate-300">Nama Lengkap *</label>
                            <input
                                type="text"
                                x-model="form.nama"
                                @blur="validateField('nama')"
                                placeholder="Masukkan nama lengkap"
                                :class="errors.nama ? 'border-red-500 ring-1 ring-red-500' : 'border-white/10'"
                                class="w-full rounded-xl bg-black/30 border p-3 md:p-4 text-slate-100 placeholder-slate-500 focus:border-amber-400 focus:ring-2 focus:ring-amber-400/30 transition text-sm md:text-base">
                            <p x-show="errors.nama" class="text-xs md:text-sm text-red-400" x-text="errors.nama"></p>
                        </div>

                        <!-- Perusahaan/Komunitas -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-slate-300">Nama Perusahaan / Komunitas *</label>
                            <input
                                type="text"
                                x-model="form.perusahaan"
                                @blur="validateField('perusahaan')"
                                placeholder="Masukkan nama perusahaan/komunitas"
                                :class="errors.perusahaan ? 'border-red-500 ring-1 ring-red-500' : 'border-white/10'"
                                class="w-full rounded-xl bg-black/30 border p-3 md:p-4 text-slate-100 placeholder-slate-500 focus:border-amber-400 focus:ring-2 focus:ring-amber-400/30 transition text-sm md:text-base">
                            <p x-show="errors.perusahaan" class="text-xs md:text-sm text-red-400" x-text="errors.perusahaan"></p>
                        </div>

                        <!-- Email -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-slate-300">Email *</label>
                            <input
                                type="email"
                                x-model="form.email"
                                @blur="validateField('email')"
                                placeholder="contoh@email.com"
                                :class="errors.email ? 'border-red-500 ring-1 ring-red-500' : 'border-white/10'"
                                class="w-full rounded-xl bg-black/30 border p-3 md:p-4 text-slate-100 placeholder-slate-500 focus:border-amber-400 focus:ring-2 focus:ring-amber-400/30 transition text-sm md:text-base">
                            <p x-show="errors.email" class="text-xs md:text-sm text-red-400" x-text="errors.email"></p>
                        </div>

                        <!-- WhatsApp -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-slate-300">No. WhatsApp *</label>
                            <input
                                type="tel"
                                x-model="form.whatsapp"
                                @blur="validateField('whatsapp')"
                                placeholder="6281234567890"
                                :class="errors.whatsapp ? 'border-red-500 ring-1 ring-red-500' : 'border-white/10'"
                                class="w-full rounded-xl bg-black/30 border p-3 md:p-4 text-slate-100 placeholder-slate-500 focus:border-amber-400 focus:ring-2 focus:ring-amber-400/30 transition text-sm md:text-base">
                            <p x-show="errors.whatsapp" class="text-xs md:text-sm text-red-400" x-text="errors.whatsapp"></p>
                        </div>

                        <!-- Kota -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-slate-300">Kota / Domisili *</label>
                            <input
                                type="text"
                                x-model="form.kota"
                                @blur="validateField('kota')"
                                placeholder="Masukkan kota domisili"
                                :class="errors.kota ? 'border-red-500 ring-1 ring-red-500' : 'border-white/10'"
                                class="w-full rounded-xl bg-black/30 border p-3 md:p-4 text-slate-100 placeholder-slate-500 focus:border-amber-400 focus:ring-2 focus:ring-amber-400/30 transition text-sm md:text-base">
                            <p x-show="errors.kota" class="text-xs md:text-sm text-red-400" x-text="errors.kota"></p>
                        </div>

                        <!-- Jenis Entitas -->
                        <div class="md:col-span-2 space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-1">Jenis Entitas</label>
                                <p class="text-xs text-slate-400">Pilih jenis entitas yang paling sesuai dengan bisnis Anda.</p>
                            </div>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 md:gap-3">
                                @foreach (['Travel','Hotel','Brand','Community','Corporate','Other'] as $item)
                                <label class="flex items-center gap-2 md:gap-3 bg-black/30 border border-white/10 rounded-lg md:rounded-xl px-3 py-2 md:px-4 md:py-3 hover:border-amber-400/50 transition cursor-pointer">
                                    <input
                                        type="checkbox"
                                        value="{{ $item }}"
                                        x-model="form.jenis_entitas"
                                        class="accent-amber-500 w-4 h-4 md:w-5 md:h-5">
                                    <span class="text-xs md:text-sm text-slate-300">{{ $item }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Divider -->
                <div class="border-t border-white/10 my-6 md:my-8"></div>

                <!-- Bagian B: Pertanyaan Utama -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 bg-amber-400 rounded-full"></div>
                        <h2 class="text-lg md:text-xl font-semibold text-amber-400">
                            Pertanyaan Utama
                        </h2>
                    </div>

                    <p x-show="errors.value" class="text-sm text-red-400 mb-2" x-text="errors.value"></p>

                    <div class="space-y-3">
                        <p class="text-slate-300 text-sm md:text-base">
                            Apa value yang bisa Anda bawa untuk kerja sama dengan BossKu Tours? *
                        </p>
                        <textarea
                            x-model="form.value"
                            @blur="validateField('value')"
                            rows="4"
                            placeholder="Ceritakan value yang bisa Anda bawa untuk kerja sama dengan BossKu Tours (minimal 10 karakter)..."
                            :class="errors.value ? 'border-red-500 ring-1 ring-red-500' : 'border-white/10'"
                            class="w-full rounded-xl bg-black/30 border p-4 text-slate-100 placeholder-slate-500 focus:border-amber-400 focus:ring-2 focus:ring-amber-400/30 transition text-sm md:text-base min-h-[120px]">
                        </textarea>
                        <div class="flex justify-between items-center">
                            <p class="text-xs text-slate-400">Minimal 10 karakter</p>
                            <p class="text-sm" :class="form.value.length >= 10 ? 'text-green-400' : 'text-slate-400'">
                                <span x-text="form.value.length"></span>/10
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Divider -->
                <div class="border-t border-white/10 my-6 md:my-8"></div>

                <!-- Bagian C: Konfirmasi -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 bg-amber-400 rounded-full"></div>
                        <h2 class="text-lg md:text-xl font-semibold text-amber-400">
                            Konfirmasi & Komitmen
                        </h2>
                    </div>

                    <p x-show="errors.agreements" class="text-sm text-red-400 mb-2" x-text="errors.agreements"></p>

                    <div class="space-y-3 md:space-y-4">
                        <label class="flex items-start gap-3 p-4 rounded-xl border border-white/10 hover:bg-white/5 transition bg-black/30">
                            <input
                                type="checkbox"
                                x-model="agreements.accuracy"
                                @change="validateAgreements()"
                                class="accent-amber-500 w-5 h-5 mt-1 flex-shrink-0">
                            <span class="text-sm text-slate-300 leading-relaxed">
                                Saya dengan ini menyatakan bahwa seluruh data, informasi, dan dokumen yang saya berikan adalah
                                <strong class="text-amber-300">benar, akurat, sah, dan dapat dipertanggungjawabkan secara hukum</strong>.
                                Saya memahami bahwa setiap ketidaksesuaian data dapat menjadi dasar penolakan kerja sama.
                            </span>
                        </label>

                        <label class="flex items-start gap-3 p-4 rounded-xl border border-white/10 hover:bg-white/5 transition bg-black/30">
                            <input
                                type="checkbox"
                                x-model="agreements.contact"
                                @change="validateAgreements()"
                                class="accent-amber-500 w-5 h-5 mt-1 flex-shrink-0">
                            <span class="text-sm text-slate-300 leading-relaxed">
                                Saya memberikan persetujuan kepada <strong class="text-amber-300">BossKu Tours</strong> untuk menghubungi
                                saya melalui email, WhatsApp, atau media komunikasi resmi lainnya terkait proses evaluasi dan diskusi lanjutan.
                            </span>
                        </label>

                        <label class="flex items-start gap-3 p-4 rounded-xl border border-white/10 hover:bg-white/5 transition bg-black/30">
                            <input
                                type="checkbox"
                                x-model="agreements.terms"
                                @change="validateAgreements()"
                                class="accent-amber-500 w-5 h-5 mt-1 flex-shrink-0">
                            <span class="text-sm text-slate-300 leading-relaxed">
                                Saya telah membaca dan menyetujui
                                <button
                                    type="button"
                                    @click.prevent="openTermsModal()"
                                    class="text-amber-400 hover:text-amber-300 underline underline-offset-2 transition">
                                    Terms & Conditions
                                </button>
                                yang berlaku.
                            </span>
                        </label>
                    </div>

                    <div x-show="step === 1 && !allAgreementsChecked"
                        x-transition
                        class="mt-4 p-3 md:p-4 bg-red-500/10 border border-red-500/20 rounded-xl">
                        <p class="text-red-400 text-sm flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            Harap centang semua persetujuan sebelum mengirimkan pendaftaran.
                        </p>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-6 md:pt-8 border-t border-white/10">
                    <div class="flex justify-center">
                        <button
                            type="submit"
                            x-show="step === 1"
                            :disabled="!allAgreementsChecked || isSubmitting"
                            :class="allAgreementsChecked && !isSubmitting
                                ? 'bg-gradient-to-r from-amber-400 to-yellow-500 hover:from-amber-500 hover:to-yellow-600 text-black font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5'
                                : 'bg-gradient-to-r from-gray-700 to-gray-800 text-gray-400 cursor-not-allowed'"
                            class="px-8 md:px-12 py-3 md:py-4 rounded-xl transition-all duration-300 min-w-[200px]">
                            <span x-show="!isSubmitting" class="flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Submit Registration
                            </span>
                            <span x-show="isSubmitting" class="flex items-center justify-center gap-2">
                                <svg class="animate-spin h-5 w-5" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none" />
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
                                </svg>
                                Processing...
                            </span>
                        </button>
                    </div>
                    <p class="text-center text-xs text-slate-500 mt-4">
                        Data Anda akan dijaga kerahasiaannya sesuai dengan kebijakan privasi kami.
                    </p>
                </div>

            </form>
        </div>

        <!-- FAQ SECTION -->
        <div class="mb-16">
            <h2 class="text-2xl md:text-3xl font-semibold text-white text-center mb-8 md:mb-12">
                Frequently Asked Questions
            </h2>

            <div class="grid md:grid-cols-2 gap-4 md:gap-6">
                <!-- Kolom 1 -->
                <div class="space-y-4 md:space-y-6">
                    <!-- FAQ 1 -->
                    <div x-data="{ open: false }" class="bg-black/40 backdrop-blur border border-white/10 rounded-xl md:rounded-2xl overflow-hidden">
                        <button @click="open = !open" class="w-full flex items-center justify-between p-4 md:p-6 text-left hover:bg-white/5 transition">
                            <span class="font-medium text-slate-200 text-sm md:text-base">
                                Apa syarat untuk menjadi partner?
                            </span>
                            <svg class="w-4 h-4 md:w-5 md:h-5 text-amber-400 transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition class="overflow-hidden">
                            <div class="px-4 md:px-6 pb-4 md:pb-6 pt-2 border-t border-white/10">
                                <p class="text-slate-400 text-sm leading-relaxed">
                                    Kami mencari partner yang memiliki passion di bidang travel dan olahraga, memiliki basis audiens yang relevan, serta memiliki komitmen untuk memberikan pengalaman terbaik kepada pelanggan.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div x-data="{ open: false }" class="bg-black/40 backdrop-blur border border-white/10 rounded-xl md:rounded-2xl overflow-hidden">
                        <button @click="open = !open" class="w-full flex items-center justify-between p-4 md:p-6 text-left hover:bg-white/5 transition">
                            <span class="font-medium text-slate-200 text-sm md:text-base">
                                Berapa lama proses seleksi?
                            </span>
                            <svg class="w-4 h-4 md:w-5 md:h-5 text-amber-400 transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition class="overflow-hidden">
                            <div class="px-4 md:px-6 pb-4 md:pb-6 pt-2 border-t border-white/10">
                                <p class="text-slate-400 text-sm leading-relaxed">
                                    Proses seleksi biasanya 5-7 hari kerja setelah pendaftaran. Tim kami akan menghubungi via WhatsApp atau email untuk diskusi lebih lanjut jika diperlukan.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div x-data="{ open: false }" class="bg-black/40 backdrop-blur border border-white/10 rounded-xl md:rounded-2xl overflow-hidden">
                        <button @click="open = !open" class="w-full flex items-center justify-between p-4 md:p-6 text-left hover:bg-white/5 transition">
                            <span class="font-medium text-slate-200 text-sm md:text-base">
                                Apakah ada biaya pendaftaran?
                            </span>
                            <svg class="w-4 h-4 md:w-5 md:h-5 text-amber-400 transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition class="overflow-hidden">
                            <div class="px-4 md:px-6 pb-4 md:pb-6 pt-2 border-t border-white/10">
                                <p class="text-slate-400 text-sm leading-relaxed">
                                    <strong class="text-amber-400">Tidak ada biaya pendaftaran</strong> untuk menjadi partner. Semua proses seleksi dan diskusi awal gratis.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kolom 2 -->
                <div class="space-y-4 md:space-y-6">
                    <!-- FAQ 4 -->
                    <div x-data="{ open: false }" class="bg-black/40 backdrop-blur border border-white/10 rounded-xl md:rounded-2xl overflow-hidden">
                        <button @click="open = !open" class="w-full flex items-center justify-between p-4 md:p-6 text-left hover:bg-white/5 transition">
                            <span class="font-medium text-slate-200 text-sm md:text-base">
                                Jenis partnership apa yang tersedia?
                            </span>
                            <svg class="w-4 h-4 md:w-5 md:h-5 text-amber-400 transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition class="overflow-hidden">
                            <div class="px-4 md:px-6 pb-4 md:pb-6 pt-2 border-t border-white/10">
                                <div class="space-y-2 text-slate-400 text-sm">
                                    <p class="mb-2">Kami menawarkan beberapa jenis partnership:</p>
                                    <ul class="space-y-1 pl-2">
                                        <li class="flex items-start gap-2">
                                            <div class="w-1.5 h-1.5 bg-amber-400 rounded-full mt-1.5"></div>
                                            <span><strong class="text-amber-300">Referral Partner:</strong> Komisi dari referensi klien</span>
                                        </li>
                                        <li class="flex items-start gap-2">
                                            <div class="w-1.5 h-1.5 bg-amber-400 rounded-full mt-1.5"></div>
                                            <span><strong class="text-amber-300">Community Partner:</strong> Kerja sama dengan komunitas</span>
                                        </li>
                                        <li class="flex items-start gap-2">
                                            <div class="w-1.5 h-1.5 bg-amber-400 rounded-full mt-1.5"></div>
                                            <span><strong class="text-amber-300">Corporate Partner:</strong> Event perusahaan</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 5 -->
                    <div x-data="{ open: false }" class="bg-black/40 backdrop-blur border border-white/10 rounded-xl md:rounded-2xl overflow-hidden">
                        <button @click="open = !open" class="w-full flex items-center justify-between p-4 md:p-6 text-left hover:bg-white/5 transition">
                            <span class="font-medium text-slate-200 text-sm md:text-base">
                                Bagaimana sistem komisi?
                            </span>
                            <svg class="w-4 h-4 md:w-5 md:h-5 text-amber-400 transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition class="overflow-hidden">
                            <div class="px-4 md:px-6 pb-4 md:pb-6 pt-2 border-t border-white/10">
                                <p class="text-slate-400 text-sm leading-relaxed">
                                    Sistem komisi transparan dengan persentase dari nilai penjualan. Pembayaran dilakukan setelah klien melunasi. Laporan penjualan dapat diakses real-time.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 6 -->
                    <div x-data="{ open: false }" class="bg-black/40 backdrop-blur border border-white/10 rounded-xl md:rounded-2xl overflow-hidden">
                        <button @click="open = !open" class="w-full flex items-center justify-between p-4 md:p-6 text-left hover:bg-white/5 transition">
                            <span class="font-medium text-slate-200 text-sm md:text-base">
                                Setelah submit form, apa yang terjadi?
                            </span>
                            <svg class="w-4 h-4 md:w-5 md:h-5 text-amber-400 transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition class="overflow-hidden">
                            <div class="px-4 md:px-6 pb-4 md:pb-6 pt-2 border-t border-white/10">
                                <p class="text-slate-400 text-sm leading-relaxed">
                                    Anda akan menerima email konfirmasi. Tim kami akan meninjau aplikasi dalam 1-3 hari kerja. Jika sesuai, kami akan hubungi via WhatsApp.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Additional -->
            <div class="text-center mt-8 md:mt-12">
                <p class="text-slate-400 text-sm md:text-base">
                    Masih punya pertanyaan? Hubungi kami di
                    <a href="mailto:bosskutourandtravel@gmail.com" class="text-amber-400 hover:text-amber-300 underline underline-offset-2 transition">
                        bosskutourandtravel@gmail.com
                    </a>
                </p>
            </div>
        </div>

        <!-- FOOTER -->
        <div class="border-t border-white/10 pt-8">
            <p class="text-center text-xs text-slate-500">
                © {{ date('Y') }} BossKu Tours — Partnership Registration
            </p>
        </div>

    </div>

    <!-- TERMS MODAL -->
    <div x-show="openTerms"
        x-transition.opacity
        x-cloak
        class="fixed inset-0 z-[9999] flex items-center justify-center p-4"
        :class="openTerms ? 'overflow-hidden' : ''"
        style="background-color: rgba(0, 0, 0, 0.8); backdrop-filter: blur(4px);"
        @click.self="closeTermsModal()"
        @keydown.escape.window="closeTermsModal()"
        @wheel.prevent.stop
        @touchmove.prevent.stop>

        <div
            class="bg-gradient-to-br from-black via-zinc-900 to-black w-full max-w-3xl rounded-3xl shadow-2xl overflow-hidden border border-amber-500/20 max-h-[90vh] flex flex-col"
            x-transition.scale.duration-300ms
            @click.stop>

            <!-- MODAL HEADER -->
            <div class="sticky top-0 bg-gradient-to-r from-amber-500/10 to-yellow-500/10 border-b border-white/10 px-6 py-5 flex items-center justify-between backdrop-blur-xl z-10 shrink-0">
                <h3 class="text-lg font-semibold text-amber-400">
                    Syarat & Ketentuan Partnership - BossKu Tours
                </h3>
                <button
                    @click="closeTermsModal()"
                    class="text-slate-400 hover:text-amber-400 text-xl transition p-1"
                    aria-label="Tutup modal">
                    &times;
                </button>
            </div>

            <!-- MODAL CONTENT -->
            <div class="overflow-y-auto flex-1 p-6" id="terms-modal-content" @wheel.stop @touchmove.stop>
                <div class="space-y-5 text-sm leading-relaxed">
                    <p class="text-justify">
                        Dengan mengajukan pendaftaran sebagai calon partner, Anda menyetujui seluruh ketentuan yang tercantum di bawah ini. Syarat dan Ketentuan ini mengatur hubungan antara Anda dan <strong class="text-amber-400">PT. BossKu Tours Indonesia</strong> ("Kami").
                    </p>

                    <h4 class="font-semibold text-amber-400">1. Definisi</h4>
                    <ul class="space-y-2 pl-4 list-disc">
                        <li><strong>Calon Partner</strong>: Individu, perusahaan, atau organisasi yang mengajukan pendaftaran melalui formulir ini.</li>
                        <li><strong>Partnership</strong>: Kerja sama resmi yang terbentuk setelah penandatanganan perjanjian tertulis.</li>
                        <li><strong>Data Pribadi</strong>: Informasi identitas, kontak, kapasitas, dan informasi lain yang diberikan dalam formulir.</li>
                    </ul>

                    <h4 class="font-semibold text-amber-400">2. Proses Pendaftaran</h4>
                    <p class="text-justify">
                        Pengisian formulir ini merupakan langkah awal ekspresi minat dan <strong>tidak menjamin</strong> pembentukan hubungan partnership. Kami berhak melakukan evaluasi, verifikasi data, dan wawancara lanjutan sebelum memutuskan untuk melanjutkan proses kerja sama.
                    </p>

                    <h4 class="font-semibold text-amber-400">3. Akurasi Data</h4>
                    <p class="text-justify">
                        Calon Partner bertanggung jawab penuh atas kebenaran, keakuratan, dan keabsahan seluruh data yang diberikan. Setiap ketidaksesuaian, pemalsuan, atau penipuan data dapat mengakibatkan penolakan atau pembatalan proses tanpa pemberitahuan lebih lanjut dan dapat dikenakan sanksi hukum sesuai peraturan yang berlaku.
                    </p>

                    <h4 class="font-semibold text-amber-400">4. Kerahasiaan Informasi</h4>
                    <p class="text-justify">
                        Data yang dikirimkan akan diperlakukan sebagai informasi rahasia dan hanya digunakan untuk tujuan evaluasi internal. Kami tidak akan membagikan data kepada pihak ketiga tanpa persetujuan tertulis, kecuali diwajibkan oleh hukum.
                    </p>

                    <h4 class="font-semibold text-amber-400">5. Hak Kekayaan Intelektual</h4>
                    <p class="text-justify">
                        Seluruh materi, konsep, program, merek dagang, dan hak kekayaan intelektual BossKu Tours tetap menjadi hak milik penuh Kami. Tidak ada hak atau lisensi yang diberikan secara implisit melalui proses pendaftaran ini.
                    </p>

                    <h4 class="font-semibold text-amber-400">6. Hubungan Kerja Sama</h4>
                    <p class="text-justify">
                        Hubungan partnership resmi hanya terbentuk setelah penandatanganan perjanjian tertulis yang disepakati kedua belah pihak. Tidak ada kewajiban hukum atau komitmen finansial yang timbul sebelum penandatanganan perjanjian.
                    </p>

                    <h4 class="font-semibold text-amber-400">7. Penolakan & Pembatalan</h4>
                    <p class="text-justify">
                        Kami berhak menolak atau membatalkan pendaftaran kapan saja dengan alasan yang tidak perlu diungkapkan. Keputusan Kami bersifat final dan tidak dapat diganggu gugat.
                    </p>

                    <h4 class="font-semibold text-amber-400">8. Komunikasi</h4>
                    <p class="text-justify">
                        Dengan mendaftar, Anda menyetujui untuk dihubungi melalui email, WhatsApp, atau media komunikasi resmi lainnya untuk keperluan verifikasi, klarifikasi, dan diskusi lebih lanjut.
                    </p>

                    <h4 class="font-semibold text-amber-400">9. Perubahan Ketentuan</h4>
                    <p class="text-justify">
                        Kami berhak mengubah, memodifikasi, atau memperbarui Syarat dan Ketentuan ini kapan saja tanpa pemberitahuan sebelumnya. Versi terbaru akan selalu tersedia di situs resmi Kami.
                    </p>

                    <h4 class="font-semibold text-amber-400">10. Hukum yang Berlaku</h4>
                    <p class="text-justify">
                        Syarat dan Ketentuan ini diatur dan ditafsirkan berdasarkan hukum Republik Indonesia. Setiap sengketa yang timbul akan diselesaikan melalui jalur musyawarah, dan jika tidak tercapai kesepakatan, akan diserahkan kepada pengadilan yang berwenang di Jakarta.
                    </p>

                    <div class="pt-4 border-t border-white/10 mt-4">
                        <p class="text-xs text-slate-400">
                            <strong>Tanggal Efektif:</strong> {{ date('d F Y') }}<br>
                            <strong>Versi:</strong> 1.0<br>
                            <strong>Kontak Pertanyaan:</strong> bosskutourandtravel@gmail.com
                        </p>
                    </div>
                </div>
            </div>

            <!-- MODAL FOOTER -->
            <div class="sticky bottom-0 bg-gradient-to-t from-black to-transparent px-6 py-4 border-t border-white/10 text-right shrink-0">
                <button
                    @click="closeTermsModal()"
                    class="px-6 py-2 rounded-xl bg-amber-500/10 text-amber-400 hover:bg-amber-500/20 transition">
                    Saya Memahami
                </button>
            </div>
        </div>
    </div>

</div>

<style>
    body.modal-open {
        overflow: hidden;
        position: fixed;
        width: 100%;
        height: 100%;
    }

    button:disabled {
        cursor: not-allowed;
        opacity: 0.6;
    }

    [x-cloak] {
        display: none !important;
    }

    /* Smooth scrolling for terms modal */
    #terms-modal-content {
        scroll-behavior: smooth;
    }
</style>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('partnershipForm', () => ({
            step: 1,
            isSubmitting: false,
            touched: false,
            openTerms: false,
            scrollPosition: 0,

            form: {
                nama: '',
                perusahaan: '',
                email: '',
                whatsapp: '',
                kota: '',
                jenis_entitas: [],
                value: ''
            },

            errors: {
                nama: '',
                perusahaan: '',
                email: '',
                whatsapp: '',
                kota: '',
                value: '',
                agreements: ''
            },

            agreements: {
                accuracy: false,
                contact: false,
                terms: false
            },

            get allAgreementsChecked() {
                return this.agreements.accuracy &&
                    this.agreements.contact &&
                    this.agreements.terms;
            },

            validateField(field) {
                const value = this.form[field];
                this.errors[field] = '';

                switch (field) {
                    case 'nama':
                        if (!value.trim()) this.errors.nama = 'Nama lengkap wajib diisi';
                        else if (value.length < 2) this.errors.nama = 'Nama terlalu pendek';
                        break;

                    case 'perusahaan':
                        if (!value.trim()) this.errors.perusahaan = 'Nama perusahaan/komunitas wajib diisi';
                        else if (value.length < 2) this.errors.perusahaan = 'Nama terlalu pendek';
                        break;

                    case 'email':
                        if (!value.trim()) this.errors.email = 'Email wajib diisi';
                        else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                            this.errors.email = 'Format email tidak valid';
                        }
                        break;

                    case 'whatsapp':
                        if (!value.trim()) this.errors.whatsapp = 'Nomor WhatsApp wajib diisi';
                        else if (!/^[0-9]+$/.test(value)) {
                            this.errors.whatsapp = 'Hanya boleh berisi angka';
                        } else if (!value.startsWith('62')) {
                            this.errors.whatsapp = 'Harus diawali dengan 62 (Indonesia)';
                        } else if (value.length < 10 || value.length > 15) {
                            this.errors.whatsapp = 'Panjang nomor tidak valid';
                        }
                        break;

                    case 'kota':
                        if (!value.trim()) this.errors.kota = 'Kota domisili wajib diisi';
                        break;

                    case 'value':
                        if (!value.trim()) this.errors.value = 'Pertanyaan utama wajib diisi';
                        else if (value.trim().length < 10) this.errors.value = 'Minimal 10 karakter';
                        break;
                }
            },

            validateAgreements() {
                if (!this.allAgreementsChecked) {
                    this.errors.agreements = 'Semua konfirmasi harus dicentang';
                } else {
                    this.errors.agreements = '';
                }
            },

            isStepValid(showError = false) {
                const fields = ['nama', 'perusahaan', 'email', 'whatsapp', 'kota', 'value'];
                if (showError) {
                    fields.forEach(f => this.validateField(f));
                    this.validateAgreements();
                }

                const fieldsValid = fields.every(f => this.form[f].trim()) &&
                    !fields.some(f => this.errors[f]);

                return fieldsValid && this.allAgreementsChecked;
            },

            showNotification(message, type = 'info') {
                const notification = document.createElement('div');
                notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 ${
                    type === 'error' ? 'bg-red-600' : 'bg-amber-500'
                } text-white`;
                notification.textContent = message;
                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.remove();
                }, 3000);
            },

            openTermsModal() {
                this.scrollPosition = window.scrollY || document.documentElement.scrollTop;
                this.openTerms = true;
                document.body.classList.add('modal-open');
                document.body.style.top = `-${this.scrollPosition}px`;
                this.$nextTick(() => {
                    const closeBtn = this.$el.querySelector('[aria-label="Tutup modal"]');
                    if (closeBtn) closeBtn.focus();
                });
            },

            closeTermsModal() {
                this.openTerms = false;
                document.body.classList.remove('modal-open');
                document.body.style.top = '';
                window.scrollTo(0, this.scrollPosition);
            },

            async submitForm() {
                if (!this.isStepValid()) {
                    this.showNotification('Harap lengkapi semua data dengan benar', 'error');
                    return;
                }

                this.isSubmitting = true;

                try {
                    // Kirim data ke server
                    const response = await fetch('/api/partnership', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            ...this.form,
                            agreements: this.agreements
                        })
                    });

                    if (response.ok) {
                        this.showNotification('Pendaftaran berhasil! Tim kami akan menghubungi Anda.', 'success');
                        this.resetForm();
                        this.step = 1;
                    } else {
                        throw new Error('Server error');
                    }
                } catch (error) {
                    this.showNotification('Terjadi kesalahan. Silakan coba lagi.', 'error');
                    console.error('Submit error:', error);
                } finally {
                    this.isSubmitting = false;
                }
            },

            resetForm() {
                this.form = {
                    nama: '',
                    perusahaan: '',
                    email: '',
                    whatsapp: '',
                    kota: '',
                    jenis_entitas: [],
                    value: ''
                };
                this.errors = {};
                this.agreements = {
                    accuracy: false,
                    contact: false,
                    terms: false
                };
            }
        }));
    });
</script>
@endsection