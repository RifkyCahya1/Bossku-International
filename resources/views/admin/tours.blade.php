@extends('main', ['excludeNavbar' => true, 'excludeFooter' => true])

@section('content')

<div class="flex min-h-screen bg-gray-50 font-['Plus_Jakarta_Sans',sans-serif]">

    @include('admin.Layout.sidebar')

    <main class="flex-1 overflow-x-hidden px-5 py-6 sm:px-7 sm:py-7 lg:px-9 lg:py-8">

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Itinerary Management</h1>
                <p class="text-sm text-gray-500 mt-0.5">Kelola semua rencana perjalanan yang telah dibuat</p>
            </div>
            <a href="{{ route('admin.itinerary-builder.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-[#0ABFA3] to-[#05796A] rounded-xl text-white text-sm font-medium hover:shadow-lg transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Buat Itinerary Baru
            </a>
        </div>

        <div class="bg-white rounded-2xl border border-black/5 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50/50">
                            <th class="text-left py-4 px-5 text-xs font-semibold text-gray-500">Kode</th>
                            <th class="text-left py-4 px-5 text-xs font-semibold text-gray-500">Judul</th>
                            <th class="text-left py-4 px-5 text-xs font-semibold text-gray-500">Durasi</th>
                            <th class="text-left py-4 px-5 text-xs font-semibold text-gray-500">Titik Wisata</th>
                            <th class="text-left py-4 px-5 text-xs font-semibold text-gray-500">Status</th>
                            <th class="text-left py-4 px-5 text-xs font-semibold text-gray-500">Dibuat</th>
                            <th class="text-right py-4 px-5 text-xs font-semibold text-gray-500">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($itineraries as $itinerary)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="py-4 px-5">
                                <span class="font-mono text-sm font-semibold text-gray-900">{{ $itinerary->code }}</span>
                            </td>
                            <td class="py-4 px-5">
                                <p class="font-semibold text-gray-900">{{ $itinerary->title }}</p>
                                <p class="text-xs text-gray-400 mt-0.5">{{ Str::limit($itinerary->description, 50) }}</p>
                            </td>
                            <td class="py-4 px-5">
                                <span class="text-sm text-gray-600">{{ $itinerary->duration_days }} hari</span>
                            </td>
                            <td class="py-4 px-5">
                                <span class="text-sm text-gray-600">{{ count($itinerary->waypoints ?? []) }} tempat</span>
                            </td>
                            <td class="py-4 px-5">
                                @php
                                $statusClass = $itinerary->status == 'published' ? 'bg-[#D4F5EE] text-[#05796A]' :
                                ($itinerary->status == 'draft' ? 'bg-gray-100 text-gray-600' : 'bg-[#FFE8E8] text-[#CC3B3B]');
                                @endphp
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium {{ $statusClass }}">
                                    <span class="w-1.5 h-1.5 rounded-full"></span>
                                    {{ ucfirst($itinerary->status) }}
                                </span>

                            </td>
                            <td class="py-4 px-5">
                                <span class="text-sm text-gray-500">{{ $itinerary->created_at->format('d M Y') }}</span>
                            </td>
                            <td class="py-4 px-5 text-right">
                                <div class="flex items-center justify-end gap-2">

                                    {{-- Toggle Status Button --}}
                                    @if(in_array(Auth::user()->role, ['admin', 'superadmin']))
                                    <button onclick="toggleStatus('{{ $itinerary->id }}', '{{ $itinerary->status }}')"
                                        class="p-2 transition rounded-lg {{ $itinerary->status == 'published' 
                                        ? 'text-[#05796A] bg-[#D4F5EE] hover:bg-[#0ABFA3] hover:text-white' 
                                        : 'text-gray-400 hover:text-[#05796A] hover:bg-[#D4F5EE]' }}"
                                        title="{{ $itinerary->status == 'published' ? 'Unpublish' : 'Publish' }}">
                                        @if($itinerary->status == 'published')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        @else
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                        </svg>
                                        @endif
                                    </button>
                                    @endif

                                    <a href="{{ route('admin.itinerary-builder.edit', $itinerary->id) }}"
                                        class="p-2 text-gray-400 hover:text-[#0ABFA3] transition rounded-lg hover:bg-[#D4F5EE]" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>

                                    <button onclick="deleteItinerary('{{ $itinerary->id }}')"
                                        class="p-2 text-gray-400 hover:text-[#CC3B3B] transition rounded-lg hover:bg-[#FFE8E8]" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <p class="text-gray-500 font-medium">Belum ada itinerary</p>
                                    <a href="{{ route('admin.itinerary-builder.create') }}" class="text-sm text-[#0ABFA3] hover:underline">
                                        + Buat itinerary pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($itineraries->hasPages())
            <div class="border-t border-gray-100 px-5 py-4">
                {{ $itineraries->links() }}
            </div>
            @endif
        </div>

    </main>
</div>

<script>
    function deleteItinerary(id) {
        if (confirm('Apakah Anda yakin ingin menghapus itinerary ini?')) {
            fetch(`/admin/itinerary-builder/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => response.json()).then(result => {
                if (result.success) {
                    location.reload();
                } else {
                    alert(result.message);
                }
            });
        }
    }

    function toggleStatus(id, currentStatus) {
        const newStatus = currentStatus === 'published' ? 'draft' : 'published';
        const label = newStatus === 'published' ? 'Publish' : 'Unpublish';

        if (!confirm(`Yakin ingin ${label} itinerary ini?`)) return;

        // ── Tampilkan loading overlay ──
        const overlay = document.createElement('div');
        overlay.id = 'statusLoadingOverlay';
        overlay.style.cssText = `
        position:fixed;inset:0;z-index:9999;
        background:rgba(0,0,0,0.35);backdrop-filter:blur(3px);
        display:flex;align-items:center;justify-content:center;
    `;
        overlay.innerHTML = `
        <div style="
            background:white;border-radius:20px;padding:32px 40px;
            display:flex;flex-direction:column;align-items:center;gap:16px;
            box-shadow:0 20px 60px rgba(0,0,0,0.2);min-width:220px;
        ">
            <div style="
                width:48px;height:48px;border-radius:50%;
                border:4px solid #E5E7EB;border-top-color:#0ABFA3;
                animation:spin 0.7s linear infinite;
            "></div>
            <div style="text-align:center;">
                <p style="font-weight:700;font-size:14px;color:#111827;margin:0 0 4px;">
                    ${label === 'Publish' ? '🚀 Mempublish...' : '📦 Mengarsipkan...'}
                </p>
                <p style="font-size:12px;color:#6B7280;margin:0;">Mohon tunggu sebentar</p>
            </div>
        </div>
    `;
        document.body.appendChild(overlay);

        fetch(`/admin/itinerary-builder/${id}/toggle-status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ||
                        '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    status: newStatus
                })
            })
            .then(r => r.json())
            .then(result => {
                // Hapus overlay
                overlay.remove();

                if (result.success) {
                    // ── Success toast ──
                    showStatusToast(
                        newStatus === 'published' ?
                        '✅ Itinerary berhasil dipublish!' :
                        '📦 Itinerary dikembalikan ke draft.',
                        '#0ABFA3'
                    );
                    setTimeout(() => location.reload(), 1200);
                } else {
                    showStatusToast('❌ ' + (result.message || 'Gagal mengubah status'), '#EF4444');
                }
            })
            .catch(err => {
                overlay.remove();
                showStatusToast('❌ Terjadi kesalahan koneksi', '#EF4444');
                console.error(err);
            });
    }

    function showStatusToast(msg, color) {
        const toast = document.createElement('div');
        toast.style.cssText = `
        position:fixed;bottom:28px;right:28px;z-index:10000;
        padding:14px 22px;background:${color};color:white;
        border-radius:14px;font-size:13px;font-weight:600;
        box-shadow:0 6px 24px rgba(0,0,0,0.18);
        animation:slideUpToast .3s ease;max-width:320px;
    `;
        toast.textContent = msg;
        document.body.appendChild(toast);
        setTimeout(() => {
            toast.style.animation = 'fadeOutToast .3s ease forwards';
            setTimeout(() => toast.remove(), 300);
        }, 2500);
    }
</script>

<style>
    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    @keyframes slideUpToast {
        from {
            opacity: 0;
            transform: translateY(12px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeOutToast {
        to {
            opacity: 0;
            transform: translateY(8px);
        }
    }
</style>

@endsection