@extends('main')

@section('content')
<section class="min-h-screen bg-gradient-to-b from-slate-50 to-white flex items-center justify-center py-12 px-6">
    <div class="w-full max-w-4xl bg-white/80 backdrop-blur-lg shadow-2xl rounded-3xl p-10 border border-gray-100 transition hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] duration-300">
        <h1 class="text-3xl font-semibold text-gray-800 mb-2 text-center">Buat Perjalanan Impianmu 🌍</h1>
        <p class="text-gray-500 text-center mb-8">Isi detail perjalananmu dan biarkan kami merancang itinerary terbaik untukmu.</p>

        <form id="customTripForm" class="space-y-6">
            <div>
                <label class="block text-gray-700 font-medium mb-1">Nama Lengkap</label>
                <input type="text" name="nama" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition" placeholder="Masukkan nama lengkapmu" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="email" name="email" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition" placeholder="Masukkan email aktifmu" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Destinasi Impian</label>
                <input type="text" name="destinasi" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition" placeholder="Contoh: Jepang, Bali, Eropa" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Tanggal Berangkat</label>
                    <input type="date" name="tanggal_berangkat" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Durasi Perjalanan (hari)</label>
                    <input type="number" name="durasi" min="1" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition" placeholder="Contoh: 5" required>
                </div>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Budget (per orang)</label>
                <select name="budget" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition" required>
                    <option value="">Pilih kisaran budget</option>
                    <option value="economy">💸 Rp5 - 10 juta (Hemat)</option>
                    <option value="midrange">💼 Rp10 - 20 juta (Menengah)</option>
                    <option value="luxury">💎 Rp20 juta ke atas (Eksklusif)</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Jenis Pengalaman</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-2">
                    @foreach(['Alam', 'Budaya', 'Kuliner', 'Petualangan', 'Relaksasi', 'Belanja'] as $item)
                    <label class="flex items-center gap-2 bg-gray-50 hover:bg-blue-50 border border-gray-200 px-4 py-3 rounded-xl cursor-pointer transition">
                        <input type="checkbox" name="preferensi[]" value="{{ strtolower($item) }}" class="accent-blue-600">
                        <span class="text-gray-700">{{ $item }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Catatan Tambahan</label>
                <textarea name="catatan" rows="4" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition" placeholder="Tulis detail khusus seperti makanan halal, hotel bintang 4+, atau itinerary santai..."></textarea>
            </div>

            <div class="text-center pt-4">
                <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-full font-semibold text-lg shadow-lg hover:bg-blue-700 active:scale-95 transition-all duration-200">Kirim Permintaan Trip ✈️</button>
            </div>
        </form>
    </div>
</section>

<script>
    document.getElementById('customTripForm').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Terima kasih! Permintaan custom trip kamu sedang diproses. Tim kami akan menghubungimu segera. 🌟');
    });
</script>
@endsection