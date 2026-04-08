@extends('main', ['excludeNavbar' => true, 'excludeFooter' => true])

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Mono&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: #F2F4F8;
    }

    /* Custom scrollbar */
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 10px;
    }

    /* Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fadeIn {
        animation: fadeIn 0.3s ease-out;
    }

    /* Status badges */
    .status-badge {
        transition: all 0.2s ease;
    }

    /* Card hover effects */
    .stat-card {
        transition: all 0.2s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px -5px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="flex min-h-screen">

    @include('admin.Layout.sidebar')

    <main class="flex-1 overflow-x-hidden px-5 py-6 sm:px-7 sm:py-7 lg:px-9 lg:py-8">

        {{-- Mobile topbar --}}
        <div class="flex items-center gap-3 mb-6 lg:hidden">
            <button id="toggleSidebar" class="w-10 h-10 rounded-xl bg-white border border-black/[0.07] shadow-sm flex items-center justify-center text-gray-600 hover:bg-gray-50 transition">
                <i class="fa-solid fa-bars text-sm"></i>
            </button>
            <div>
                <h1 class="text-lg font-extrabold text-gray-900 leading-tight">Leads Management</h1>
                <p class="text-xs text-gray-500">CRM & Pipeline Management</p>
            </div>
        </div>

        {{-- Desktop header --}}
        <div class="hidden lg:flex items-end justify-between mb-8">
            <div>
                <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Leads Management</h1>
                <p class="text-sm text-gray-500 mt-0.5">Kelola prospek, tracking conversation, dan monitoring conversion pipeline</p>
            </div>
            <div class="flex items-center gap-3">
                <button id="exportLeadsBtn" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-xl text-gray-700 text-sm font-medium hover:bg-gray-50 transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Export CSV
                </button>
                @can('manage-users')
                <button id="addLeadBtn" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-[#0ABFA3] to-[#05796A] rounded-xl text-white text-sm font-medium hover:shadow-lg transition-all hover:-translate-y-0.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Lead
                </button>
                @endcan
            </div>
        </div>

        {{-- CRM Stats Cards --}}
        <div class="grid grid-cols-2 lg:grid-cols-5 gap-3 sm:gap-4 mb-7">
            <div class="stat-card bg-white rounded-2xl p-4 sm:p-5 border border-black/[0.07] shadow-sm transition-all duration-200">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl bg-[#D4F5EE] flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#05796A]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <span class="text-[10px] font-bold bg-[#D4F5EE] text-[#05796A] px-2 py-0.5 rounded-full">Total</span>
                </div>
                <p class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight" id="totalLeads">0</p>
                <p class="text-xs text-gray-400 mt-0.5">Total Leads</p>
            </div>

            <div class="stat-card bg-white rounded-2xl p-4 sm:p-5 border border-black/[0.07] shadow-sm transition-all duration-200">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl bg-[#EDEDFF] flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#5B5BD6]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span class="text-[10px] font-bold bg-[#EDEDFF] text-[#5B5BD6] px-2 py-0.5 rounded-full">New</span>
                </div>
                <p class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight" id="newLeads">0</p>
                <p class="text-xs text-gray-400 mt-0.5">Belum Dihubungi</p>
            </div>

            <div class="stat-card bg-white rounded-2xl p-4 sm:p-5 border border-black/[0.07] shadow-sm transition-all duration-200">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl bg-[#FFF3C4] flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#A07800]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <span class="text-[10px] font-bold bg-[#FFF3C4] text-[#A07800] px-2 py-0.5 rounded-full">Contacted</span>
                </div>
                <p class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight" id="contactedLeads">0</p>
                <p class="text-xs text-gray-400 mt-0.5">Sudah Dihubungi</p>
            </div>

            <div class="stat-card bg-white rounded-2xl p-4 sm:p-5 border border-black/[0.07] shadow-sm transition-all duration-200">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl bg-[#D4F5EE] flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#05796A]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="text-[10px] font-bold bg-[#D4F5EE] text-[#05796A] px-2 py-0.5 rounded-full">Converted</span>
                </div>
                <p class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight" id="convertedLeads">0</p>
                <p class="text-xs text-gray-400 mt-0.5">Berhasil Konversi</p>
            </div>

            <div class="stat-card bg-white rounded-2xl p-4 sm:p-5 border border-black/[0.07] shadow-sm transition-all duration-200">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl bg-[#FFE8E8] flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#CC3B3B]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="text-[10px] font-bold bg-[#FFE8E8] text-[#CC3B3B] px-2 py-0.5 rounded-full">Lost</span>
                </div>
                <p class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight" id="lostLeads">0</p>
                <p class="text-xs text-gray-400 mt-0.5">Tidak Jadi</p>
            </div>
        </div>

        {{-- Pipeline Visualization --}}
        <div class="bg-white rounded-2xl border border-black/[0.07] shadow-sm mb-7 overflow-hidden">
            <div class="p-5 sm:p-6 border-b border-gray-100">
                <h2 class="text-sm font-bold text-gray-800 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-[#0ABFA3] shrink-0"></span>
                    Pipeline Funnel
                </h2>
            </div>
            <div class="p-5 sm:p-6">
                <div class="space-y-3">
                    <div>
                        <div class="flex justify-between text-xs text-gray-600 mb-1">
                            <span>New Leads</span>
                            <span id="newPercent">0%</span>
                        </div>
                        <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                            <div id="newBar" class="h-full bg-[#5B5BD6] rounded-full transition-all duration-500" style="width: 0%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-xs text-gray-600 mb-1">
                            <span>Contacted</span>
                            <span id="contactedPercent">0%</span>
                        </div>
                        <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                            <div id="contactedBar" class="h-full bg-[#FFBA08] rounded-full transition-all duration-500" style="width: 0%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-xs text-gray-600 mb-1">
                            <span>Qualified → Converted</span>
                            <span id="convertedPercent">0%</span>
                        </div>
                        <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                            <div id="convertedBar" class="h-full bg-[#0ABFA3] rounded-full transition-all duration-500" style="width: 0%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Search and Filter Section --}}
        <div class="bg-white rounded-2xl border border-black/[0.07] shadow-sm mb-7 overflow-hidden">
            <div class="p-5 sm:p-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" id="searchInput" placeholder="Search name, email, phone..."
                            class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:border-[#0ABFA3] focus:ring-2 focus:ring-[#0ABFA3]/20 transition">
                    </div>

                    <select id="statusFilter" class="px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-700 text-sm focus:outline-none focus:border-[#0ABFA3]">
                        <option value="">All Status</option>
                        <option value="New">New</option>
                        <option value="Contacted">Contacted</option>
                        <option value="Qualified">Qualified</option>
                        <option value="Converted">Converted</option>
                        <option value="Lost">Lost</option>
                    </select>

                    <select id="sourceFilter" class="px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-700 text-sm focus:outline-none focus:border-[#0ABFA3]">
                        <option value="">All Sources</option>
                        <option value="Website">Website</option>
                        <option value="WhatsApp">WhatsApp</option>
                        <option value="Instagram">Instagram</option>
                        <option value="Referral">Referral</option>
                        <option value="Direct">Direct</option>
                    </select>

                    <button id="resetFiltersBtn" class="px-4 py-2.5 bg-gray-100 rounded-xl text-gray-600 text-sm font-medium hover:bg-gray-200 transition">
                        Reset Filters
                    </button>
                </div>
            </div>
        </div>

        {{-- Leads Table --}}
        <div class="bg-white rounded-2xl border border-black/[0.07] shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50/50">
                            <th class="text-left py-4 px-5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Lead</th>
                            <th class="text-left py-4 px-5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Contact</th>
                            <th class="text-left py-4 px-5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Source</th>
                            <th class="text-left py-4 px-5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Interest</th>
                            <th class="text-left py-4 px-5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="text-left py-4 px-5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Last Contact</th>
                            <th class="text-left py-4 px-5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Handled By</th>
                            <th class="text-right py-4 px-5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody id="leadsTableBody" class="divide-y divide-gray-50">
                        <!-- Data akan diisi oleh JavaScript -->
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="border-t border-gray-100 px-5 py-4">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                    <span id="paginationInfo" class="text-sm text-gray-500"></span>
                    <div id="paginationButtons" class="flex gap-1.5"></div>
                </div>
            </div>
        </div>

    </main>
</div>

{{-- View Lead Modal --}}
<div id="viewModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
    <div class="bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto shadow-2xl animate-fadeIn">
        <div class="sticky top-0 bg-white border-b border-gray-100 px-6 py-4 flex items-center justify-between">
            <h3 class="text-lg font-bold text-gray-900">Lead Details</h3>
            <button onclick="closeViewModal()" class="p-1 hover:bg-gray-100 rounded-lg transition">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div id="viewModalContent" class="p-6">
            <!-- Content will be filled by JavaScript -->
        </div>
    </div>
</div>

{{-- Add/Edit Lead Modal --}}
<div id="leadModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
    <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto shadow-2xl animate-fadeIn">
        <div class="sticky top-0 bg-white border-b border-gray-100 px-6 py-4 flex items-center justify-between">
            <h3 id="modalTitle" class="text-lg font-bold text-gray-900">Add New Lead</h3>
            <button onclick="closeLeadModal()" class="p-1 hover:bg-gray-100 rounded-lg transition">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form id="leadForm" class="p-6 space-y-5">
            @csrf
            <input type="hidden" id="leadId" name="id">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                    <input type="text" id="fullName" name="full_name" required
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:border-[#0ABFA3] focus:ring-2 focus:ring-[#0ABFA3]/20">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email"
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:border-[#0ABFA3] focus:ring-2 focus:ring-[#0ABFA3]/20">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone *</label>
                    <input type="text" id="phone" name="phone" required
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:border-[#0ABFA3] focus:ring-2 focus:ring-[#0ABFA3]/20">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Company</label>
                    <input type="text" id="company" name="company"
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:border-[#0ABFA3] focus:ring-2 focus:ring-[#0ABFA3]/20">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Interest</label>
                    <input type="text" id="interest" name="interest"
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:border-[#0ABFA3] focus:ring-2 focus:ring-[#0ABFA3]/20">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Lead Type</label>
                    <select id="leadType" name="lead_type"
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:border-[#0ABFA3]">
                        <option value="">Select Type</option>
                        <option value="B2C">B2C</option>
                        <option value="B2B">B2B</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
                    <select id="priority" name="priority"
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:border-[#0ABFA3]">
                        <option value="">Select Priority</option>
                        <option value="Low">Low</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Source</label>
                    <select id="source" name="source"
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:border-[#0ABFA3]">
                        <option value="">Select Source</option>
                        <option value="Website">Website</option>
                        <option value="WhatsApp">WhatsApp</option>
                        <option value="Instagram">Instagram</option>
                        <option value="Referral">Referral</option>
                        <option value="Direct">Direct</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Estimated Value (IDR)</label>
                    <input type="number" id="estimatedValue" name="estimated_value"
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:border-[#0ABFA3] focus:ring-2 focus:ring-[#0ABFA3]/20">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Internal Notes</label>
                <textarea id="internalNotes" name="internal_notes" rows="3"
                    class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:border-[#0ABFA3] focus:ring-2 focus:ring-[#0ABFA3]/20 resize-none"></textarea>
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="closeLeadModal()"
                    class="px-4 py-2 bg-gray-100 rounded-xl text-gray-600 text-sm font-medium hover:bg-gray-200 transition">
                    Cancel
                </button>
                <button type="submit"
                    class="px-6 py-2 bg-gradient-to-r from-[#0ABFA3] to-[#05796A] rounded-xl text-white text-sm font-medium hover:shadow-lg transition">
                    Save Lead
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    let currentPage = 1;
    let currentSearch = '';
    let currentStatus = '';
    let currentSource = '';
    let allLeads = @json($leads ?? []);
    let statsData = @json($stats ?? []);

    // Initialize dashboard
    document.addEventListener('DOMContentLoaded', function() {
        updateStats();
        renderLeads();
        setupEventListeners();

        const toggleBtn = document.getElementById('toggleSidebar');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                if (typeof openSidebar === 'function') openSidebar();
            });
        }
    });

    function setupEventListeners() {
        document.getElementById('searchInput')?.addEventListener('input', (e) => {
            currentSearch = e.target.value;
            currentPage = 1;
            renderLeads();
        });

        document.getElementById('statusFilter')?.addEventListener('change', (e) => {
            currentStatus = e.target.value;
            currentPage = 1;
            renderLeads();
        });

        document.getElementById('sourceFilter')?.addEventListener('change', (e) => {
            currentSource = e.target.value;
            currentPage = 1;
            renderLeads();
        });

        document.getElementById('resetFiltersBtn')?.addEventListener('click', () => {
            currentSearch = '';
            currentStatus = '';
            currentSource = '';
            currentPage = 1;
            document.getElementById('searchInput').value = '';
            document.getElementById('statusFilter').value = '';
            document.getElementById('sourceFilter').value = '';
            renderLeads();
        });

        document.getElementById('addLeadBtn')?.addEventListener('click', () => {
            openLeadModal();
        });

        document.getElementById('leadForm')?.addEventListener('submit', saveLead);

        document.getElementById('exportLeadsBtn')?.addEventListener('click', exportLeads);
    }

    function updateStats() {
        const total = allLeads.length;
        const newLeads = allLeads.filter(l => l.status === 'New').length;
        const contacted = allLeads.filter(l => l.status === 'Contacted').length;
        const converted = allLeads.filter(l => l.status === 'Converted').length;
        const lost = allLeads.filter(l => l.status === 'Lost').length;

        document.getElementById('totalLeads').textContent = total;
        document.getElementById('newLeads').textContent = newLeads;
        document.getElementById('contactedLeads').textContent = contacted;
        document.getElementById('convertedLeads').textContent = converted;
        document.getElementById('lostLeads').textContent = lost;

        // Update pipeline percentages
        const newPercent = total > 0 ? ((newLeads / total) * 100).toFixed(1) : 0;
        const contactedPercent = total > 0 ? ((contacted / total) * 100).toFixed(1) : 0;
        const convertedPercent = total > 0 ? ((converted / total) * 100).toFixed(1) : 0;

        document.getElementById('newPercent').textContent = newPercent + '%';
        document.getElementById('contactedPercent').textContent = contactedPercent + '%';
        document.getElementById('convertedPercent').textContent = convertedPercent + '%';

        document.getElementById('newBar').style.width = newPercent + '%';
        document.getElementById('contactedBar').style.width = contactedPercent + '%';
        document.getElementById('convertedBar').style.width = convertedPercent + '%';
    }

    function getFilteredLeads() {
        return allLeads.filter(lead => {
            const matchesSearch = !currentSearch ||
                lead.name?.toLowerCase().includes(currentSearch.toLowerCase()) ||
                lead.email?.toLowerCase().includes(currentSearch.toLowerCase()) ||
                lead.phone?.includes(currentSearch);
            const matchesStatus = !currentStatus || lead.status === currentStatus;
            const matchesSource = !currentSource || lead.source === currentSource;
            return matchesSearch && matchesStatus && matchesSource;
        });
    }

    function renderLeads() {
        const filtered = getFilteredLeads();
        const itemsPerPage = 10;
        const totalPages = Math.ceil(filtered.length / itemsPerPage);
        const start = (currentPage - 1) * itemsPerPage;
        const paginatedLeads = filtered.slice(start, start + itemsPerPage);

        const tbody = document.getElementById('leadsTableBody');
        if (!tbody) return;

        if (paginatedLeads.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="8" class="py-12 text-center">
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <p class="text-gray-500 font-medium">Tidak ada data lead</p>
                            <button onclick="openLeadModal()" class="text-sm text-[#0ABFA3] hover:underline">+ Tambah lead baru</button>
                        </div>
                    </td>
                </tr>
            `;
            document.getElementById('paginationInfo').textContent = '';
            document.getElementById('paginationButtons').innerHTML = '';
            return;
        }

        tbody.innerHTML = paginatedLeads.map(lead => `
            <tr class="hover:bg-gray-50/50 transition group">
                <td class="py-4 px-5">
                    <p class="font-semibold text-gray-900">${escapeHtml(lead.name || '-')}</p>
                    <p class="text-xs text-gray-400">${escapeHtml(lead.company || 'Individual')}</p>
                </td>
                <td class="py-4 px-5">
                    <p class="text-sm text-gray-600">${escapeHtml(lead.email || '-')}</p>
                    <p class="text-xs text-gray-400">${escapeHtml(lead.phone || '-')}</p>
                </td>
                <td class="py-4 px-5">
                    <span class="inline-flex items-center gap-1.5 text-sm text-gray-600">
                        ${getSourceIcon(lead.source)}
                        ${escapeHtml(lead.source || '-')}
                    </span>
                </td>
                <td class="py-4 px-5">
                    <span class="text-sm text-gray-700">${escapeHtml(lead.interest || '-')}</span>
                </td>
                <td class="py-4 px-5">
                    ${getStatusBadge(lead.status)}
                </td>
                <td class="py-4 px-5">
                    <span class="text-sm text-gray-500">${formatDate(lead.last_contact)}</span>
                </td>
                <td class="py-4 px-5">
                    <span class="text-sm text-gray-600">${escapeHtml(lead.handled_by || 'Unassigned')}</span>
                </td>
                <td class="py-4 px-5 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <button onclick="viewLead(${lead.id})" class="p-2 text-gray-400 hover:text-[#5B5BD6] transition rounded-lg hover:bg-[#EDEDFF]" title="Detail">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                        <button onclick="editLead(${lead.id})" class="p-2 text-gray-400 hover:text-[#0ABFA3] transition rounded-lg hover:bg-[#D4F5EE]" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </button>
                        <button onclick="deleteLead(${lead.id})" class="p-2 text-gray-400 hover:text-[#CC3B3B] transition rounded-lg hover:bg-[#FFE8E8]" title="Hapus">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </td>
                          `).join('');

        // Update pagination info
        document.getElementById('paginationInfo').textContent =
            `Menampilkan ${start + 1} - ${Math.min(start + itemsPerPage, filtered.length)} dari ${filtered.length} lead`;

        // Render pagination buttons
        let paginationHtml = '';
        if (currentPage > 1) {
            paginationHtml += `<button onclick="changePage(${currentPage - 1})" class="px-3 py-1.5 rounded-lg bg-gray-100 text-gray-600 text-sm hover:bg-gray-200 transition">← Prev</button>`;
        }
        for (let i = 1; i <= Math.min(totalPages, 5); i++) {
            const isActive = i === currentPage;
            paginationHtml += `<button onclick="changePage(${i})" class="px-3 py-1.5 rounded-lg ${isActive ? 'bg-[#0ABFA3] text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'} transition text-sm">${i}</button>`;
        }
        if (currentPage < totalPages) {
            paginationHtml += `<button onclick="changePage(${currentPage + 1})" class="px-3 py-1.5 rounded-lg bg-gray-100 text-gray-600 text-sm hover:bg-gray-200 transition">Next →</button>`;
        }
        document.getElementById('paginationButtons').innerHTML = paginationHtml;
    }

    function changePage(page) {
        currentPage = page;
        renderLeads();
    }

    function getStatusBadge(status) {
        const statusConfig = {
            'New': {
                class: 'bg-[#EDEDFF] text-[#5B5BD6]',
                dot: 'bg-[#5B5BD6]'
            },
            'Contacted': {
                class: 'bg-[#FFF3C4] text-[#A07800]',
                dot: 'bg-[#A07800]'
            },
            'Qualified': {
                class: 'bg-[#D4F5EE] text-[#05796A]',
                dot: 'bg-[#05796A]'
            },
            'Converted': {
                class: 'bg-[#D4F5EE] text-[#05796A]',
                dot: 'bg-[#05796A]'
            },
            'Lost': {
                class: 'bg-[#FFE8E8] text-[#CC3B3B]',
                dot: 'bg-[#CC3B3B]'
            }
        };
        const config = statusConfig[status] || statusConfig['New'];
        return `<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium ${config.class}">
                    <span class="w-1.5 h-1.5 rounded-full ${config.dot}"></span>
                    ${status}
                </span>`;
    }

    function getSourceIcon(source) {
        const icons = {
            'Website': '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
            'WhatsApp': '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>',
            'Instagram': '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>',
            'Referral': '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg>'
        };
        return icons[source] || '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';
    }

    function formatDate(dateString) {
        if (!dateString) return '-';
        const date = new Date(dateString);
        const now = new Date();
        const diffHours = Math.floor((now - date) / (1000 * 60 * 60));
        if (diffHours < 24) return `${diffHours} jam lalu`;
        if (diffHours < 48) return 'kemarin';
        return date.toLocaleDateString('id-ID');
    }

    function escapeHtml(str) {
        if (!str) return '';
        return str.replace(/[&<>]/g, function(m) {
            if (m === '&') return '&amp;';
            if (m === '<') return '&lt;';
            if (m === '>') return '&gt;';
            return m;
        });
    }

    function viewLead(id) {
        const lead = allLeads.find(l => l.id === id);
        if (!lead) return;

        const modal = document.getElementById('viewModal');
        const content = document.getElementById('viewModalContent');

        content.innerHTML = `
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <label class="text-xs text-gray-400 uppercase tracking-wider">Full Name</label>
                        <p class="text-gray-900 font-medium mt-1">${escapeHtml(lead.name)}</p>
                    </div>
                    <div>
                        <label class="text-xs text-gray-400 uppercase tracking-wider">Email</label>
                        <p class="text-gray-900 mt-1">${escapeHtml(lead.email || '-')}</p>
                    </div>
                    <div>
                        <label class="text-xs text-gray-400 uppercase tracking-wider">Phone</label>
                        <p class="text-gray-900 mt-1">${escapeHtml(lead.phone || '-')}</p>
                    </div>
                    <div>
                        <label class="text-xs text-gray-400 uppercase tracking-wider">Company</label>
                        <p class="text-gray-900 mt-1">${escapeHtml(lead.company || '-')}</p>
                    </div>
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="text-xs text-gray-400 uppercase tracking-wider">Interest</label>
                        <p class="text-gray-900 mt-1">${escapeHtml(lead.interest || '-')}</p>
                    </div>
                    <div>
                        <label class="text-xs text-gray-400 uppercase tracking-wider">Source</label>
                        <p class="text-gray-900 mt-1">${escapeHtml(lead.source || '-')}</p>
                    </div>
                    <div>
                        <label class="text-xs text-gray-400 uppercase tracking-wider">Priority</label>
                        <p class="mt-1">${getPriorityBadge(lead.priority)}</p>
                    </div>
                    <div>
                        <label class="text-xs text-gray-400 uppercase tracking-wider">Estimated Value</label>
                        <p class="text-gray-900 mt-1">${lead.estimated_value ? 'Rp ' + Number(lead.estimated_value).toLocaleString('id-ID') : '-'}</p>
                    </div>
                </div>
            </div>
            <div class="mt-6 pt-6 border-t border-gray-100">
                <label class="text-xs text-gray-400 uppercase tracking-wider">Internal Notes</label>
                <div class="mt-2 p-4 bg-gray-50 rounded-xl text-gray-700 text-sm">
                    ${escapeHtml(lead.internal_notes) || 'No internal notes'}
                </div>
            </div>
            <div class="mt-6 flex justify-between">
                <button onclick="contactLead(${lead.id})" class="inline-flex items-center gap-2 px-4 py-2 bg-[#0ABFA3] text-white rounded-xl text-sm font-medium hover:bg-[#05796A] transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    Contact via WhatsApp
                </button>
                <div class="flex gap-3">
                    <button onclick="closeViewModal()" class="px-4 py-2 border border-gray-200 rounded-xl text-gray-600 text-sm font-medium hover:bg-gray-50 transition">
                        Close
                    </button>
                    <button onclick="editLead(${lead.id}); closeViewModal();" class="px-4 py-2 bg-gray-100 rounded-xl text-gray-700 text-sm font-medium hover:bg-gray-200 transition">
                        Edit Lead
                    </button>
                </div>
            </div>
        `;

        modal.classList.remove('hidden');
        modal.style.display = 'flex';
    }

    function getPriorityBadge(priority) {
        const config = {
            'High': 'bg-[#FFE8E8] text-[#CC3B3B]',
            'Medium': 'bg-[#FFF3C4] text-[#A07800]',
            'Low': 'bg-[#D4F5EE] text-[#05796A]'
        };
        const className = config[priority] || 'bg-gray-100 text-gray-600';
        return `<span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium ${className}">${priority || '-'}</span>`;
    }

    function closeViewModal() {
        const modal = document.getElementById('viewModal');
        modal.classList.add('hidden');
        modal.style.display = 'none';
    }

    function openLeadModal(lead = null) {
        const modal = document.getElementById('leadModal');
        const title = document.getElementById('modalTitle');
        const form = document.getElementById('leadForm');

        if (lead) {
            title.textContent = 'Edit Lead';
            document.getElementById('leadId').value = lead.id;
            document.getElementById('fullName').value = lead.name || '';
            document.getElementById('email').value = lead.email || '';
            document.getElementById('phone').value = lead.phone || '';
            document.getElementById('company').value = lead.company || '';
            document.getElementById('interest').value = lead.interest || '';
            document.getElementById('leadType').value = lead.lead_type || '';
            document.getElementById('priority').value = lead.priority || '';
            document.getElementById('source').value = lead.source || '';
            document.getElementById('estimatedValue').value = lead.estimated_value || '';
            document.getElementById('internalNotes').value = lead.internal_notes || '';
        } else {
            title.textContent = 'Add New Lead';
            form.reset();
            document.getElementById('leadId').value = '';
        }

        modal.classList.remove('hidden');
        modal.style.display = 'flex';
    }

    function editLead(id) {
        const lead = allLeads.find(l => l.id === id);
        if (lead) openLeadModal(lead);
    }

    function closeLeadModal() {
        const modal = document.getElementById('leadModal');
        modal.classList.add('hidden');
        modal.style.display = 'none';
    }

    async function saveLead(e) {
        e.preventDefault();

        const id = document.getElementById('leadId').value;
        const data = {
            name: document.getElementById('fullName').value,
            email: document.getElementById('email').value,
            phone: document.getElementById('phone').value,
            company: document.getElementById('company').value,
            interest: document.getElementById('interest').value,
            lead_type: document.getElementById('leadType').value,
            priority: document.getElementById('priority').value,
            source: document.getElementById('source').value,
            estimated_value: document.getElementById('estimatedValue').value,
            internal_notes: document.getElementById('internalNotes').value,
            _token: document.querySelector('input[name="_token"]')?.value || '{{ csrf_token() }}'
        };

        const url = id ? `/admin/leads/${id}` : '/admin/leads';
        const method = id ? 'PUT' : 'POST';

        try {
            const response = await fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': data._token
                },
                body: JSON.stringify(data)
            });

            if (response.ok) {
                closeLeadModal();
                window.location.reload();
            } else {
                const error = await response.json();
                alert(error.message || 'Gagal menyimpan lead');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan, silakan coba lagi');
        }
    }

    async function deleteLead(id) {
        if (confirm('Apakah Anda yakin ingin menghapus lead ini? Tindakan ini tidak dapat dibatalkan.')) {
            try {
                const response = await fetch(`/admin/leads/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                if (response.ok) {
                    window.location.reload();
                } else {
                    alert('Gagal menghapus lead');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan, silakan coba lagi');
            }
        }
    }

    async function contactLead(id) {
        const lead = allLeads.find(l => l.id === id);
        if (!lead || !lead.phone) {
            alert('Nomor telepon tidak tersedia');
            return;
        }

        let phone = lead.phone.replace(/[^0-9]/g, '');
        if (phone.startsWith('0')) phone = phone.slice(1);
        if (!phone.startsWith('62')) phone = '62' + phone;

        window.open(`https://wa.me/${phone}`, '_blank');

        try {
            await fetch(`/admin/leads/${id}/contact`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
        } catch (error) {
            console.error('Error updating contact:', error);
        }
    }

    function exportLeads() {
        const filtered = getFilteredLeads();
        const csvContent = [
            ['Name', 'Email', 'Phone', 'Company', 'Interest', 'Source', 'Status', 'Priority', 'Estimated Value'],
            ...filtered.map(lead => [
                lead.name || '',
                lead.email || '',
                lead.phone || '',
                lead.company || '',
                lead.interest || '',
                lead.source || '',
                lead.status || '',
                lead.priority || '',
                lead.estimated_value || ''
            ])
        ].map(row => row.map(cell => `"${String(cell).replace(/"/g, '""')}"`).join(',')).join('\n');

        const blob = new Blob([csvContent], {
            type: 'text/csv;charset=utf-8;'
        });
        const link = document.createElement('a');
        const url = URL.createObjectURL(blob);
        link.setAttribute('href', url);
        link.setAttribute('download', `leads_export_${new Date().toISOString().split('T')[0]}.csv`);
        link.style.visibility = 'hidden';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        URL.revokeObjectURL(url);
    }
</script>

@endsection