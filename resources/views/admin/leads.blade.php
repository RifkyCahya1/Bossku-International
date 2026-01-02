@extends('main', ['excludeNavbar' => true, 'excludeFooter' => true])

@section('content')
<div
    x-data="leadDashboard(@js($stats), @js($leads))"
    class="min-h-screen bg-[#0E0E10] relative overflow-hidden text-white">


    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute w-[620px] h-[620px] bg-purple-600/20 rounded-full blur-[160px] -top-32 -left-32"></div>
        <div class="absolute w-[620px] h-[620px] bg-blue-500/20 rounded-full blur-[180px] bottom-0 right-0"></div>
    </div>

    @include('admin.Layout.topbar')

    <div class="relative flex max-w-[1600px] mx-auto py-16 px-8 gap-10">

        @include('admin.Layout.sidebar')

        <!-- MAIN -->
        <main class="flex-1 space-y-10">

            <!-- Header -->
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-semibold tracking-tight">Leads Management</h1>
                    <p class="mt-1 text-sm text-gray-400">
                        Track prospects, conversations, and conversions
                    </p>
                </div>
                <div class="flex gap-3">
                    <button class="rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm hover:bg-white/10">
                        Export CSV
                    </button>
                    @can('manage-users')
                    <button
                        @click="openAddModal = true"
                        class="rounded-xl bg-white text-black px-4 py-2 text-sm font-medium hover:bg-gray-200">
                        Add Lead
                    </button>
                    @endcan
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <template x-for="stat in stats" :key="stat.label">
                    <div class="relative overflow-hidden rounded-2xl border border-white/10 bg-white/5 backdrop-blur-xl p-6">
                        <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent pointer-events-none"></div>

                        <p class="text-sm text-gray-400" x-text="stat.label"></p>
                        <p class="mt-2 text-3xl font-semibold" x-text="stat.value"></p>
                        <p class="mt-1 text-xs"
                            x-show="stat.trend !== 0"
                            :class="stat.trend > 0 ? 'text-emerald-400' : 'text-rose-400'">

                            <span x-text="stat.trend > 0 ? '+' + stat.trend : stat.trend"></span>% this month
                        </p>
                    </div>
                </template>
            </div>

            <!-- Filters -->
            <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-xl p-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <input type="text" placeholder="Search name, email, phone"
                        class="w-full rounded-xl bg-black/30 border-white/10 text-sm text-white placeholder-gray-400 focus:ring-0 focus:border-white/30">

                    <select class="w-full rounded-xl bg-black/30 border-white/10 text-sm focus:ring-0">
                        <option>Status: All</option>
                        <option>New</option>
                        <option>Contacted</option>
                        <option>Qualified</option>
                        <option>Converted</option>
                        <option>Lost</option>
                    </select>

                    <select class="w-full rounded-xl bg-black/30 border-white/10 text-sm focus:ring-0">
                        <option>Source: All</option>
                        <option>Website</option>
                        <option>WhatsApp</option>
                        <option>Instagram</option>
                        <option>Referral</option>
                    </select>

                    <button class="rounded-xl bg-white text-black text-sm font-medium hover:bg-gray-200">
                        Apply Filter
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-hidden rounded-2xl border border-white/10 bg-white/5 backdrop-blur-xl">
                <table class="w-full text-sm">
                    <thead class="bg-white/5 text-gray-400">
                        <tr>
                            <th class="px-6 py-4 text-left font-medium">Lead</th>
                            <th class="px-6 py-4 text-left font-medium">Source</th>
                            <th class="px-6 py-4 text-left font-medium">Interest</th>
                            <th class="px-6 py-4 text-left font-medium">Status</th>
                            <th class="px-6 py-4 text-left font-medium">Last Contact</th>
                            <th class="px-6 py-4 text-left font-medium">Handled By</th>
                            <th class="px-6 py-4 text-right font-medium">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        <template x-for="lead in leads" :key="lead.id">
                            <tr class="hover:bg-white/5 transition">
                                <td class="px-6 py-4">
                                    <p class="font-medium" x-text="lead.name"></p>
                                    <p class="text-xs text-gray-400" x-text="lead.email"></p>
                                </td>
                                <td class="px-6 py-4 text-gray-300" x-text="lead.source"></td>
                                <td class="px-6 py-4 text-gray-300" x-text="lead.interest"></td>
                                <td class="px-6 py-4">
                                    <span class="rounded-full px-3 py-1 text-xs font-medium"
                                        :class="statusClass(lead.status)"
                                        x-text="lead.status"></span>
                                </td>
                                <td class="px-6 py-4 text-gray-400" x-text="lead.last_contact"></td>
                                <td class="px-6 py-4 text-gray-300" x-text="lead.handled_by"></td>
                                <td class="px-6 py-4 text-right">
                                    <button
                                        @click="openViewLead(lead)"
                                        class="text-sm hover:underline text-gray-300">
                                        View
                                    </button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>

        </main>
    </div>

    <!-- VIEW LEAD MODAL -->
    <div
        x-show="openViewModal"
        x-transition.opacity
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm"
        @keydown.escape.window="openViewModal = false"
        style="display: none;">
        <div
            @click.outside="openViewModal = false"
            class="w-full max-w-3xl rounded-2xl border border-white/10 bg-[#121214] p-8 shadow-2xl">

            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-xl font-semibold tracking-tight">Lead Details</h2>
                    <p class="text-sm text-gray-400">Detail informasi prospek</p>
                </div>

                <button
                    @click="openViewModal = false"
                    class="text-gray-400 hover:text-white transition">
                    ✕
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">

                <div class="space-y-4">
                    <div>
                        <p class="text-gray-400">Full Name</p>
                        <p class="font-medium" x-text="selectedLead.name"></p>
                    </div>

                    <div>
                        <p class="text-gray-400">Email</p>
                        <p x-text="selectedLead.email ?? '—'"></p>
                    </div>

                    <div>
                        <p class="text-gray-400">Phone</p>
                        <p x-text="selectedLead.phone ?? '—'"></p>
                    </div>

                    <div>
                        <p class="text-gray-400">Company</p>
                        <p x-text="selectedLead.company ?? '—'"></p>
                    </div>

                    <div>
                        <p class="text-gray-400">Source</p>
                        <p x-text="selectedLead.source ?? '—'"></p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <p class="text-gray-400">Interest</p>
                        <p x-text="selectedLead.interest ?? '—'"></p>
                    </div>

                    <div>
                        <p class="text-gray-400">Lead Type</p>
                        <p x-text="selectedLead.lead_type ?? '—'"></p>
                    </div>

                    <div>
                        <p class="text-gray-400">Priority</p>
                        <span
                            class="inline-block rounded-full px-3 py-1 text-xs font-medium"
                            :class="priorityClass(selectedLead.priority)"
                            x-text="selectedLead.priority ?? '—'"></span>
                    </div>

                    <div>
                        <p class="text-gray-400 mb-1">Status</p>

                        <select
                            x-model="selectedLead.status"
                            @change="updateStatus(selectedLead)"
                            class="rounded-xl bg-black/40 border border-white/10 text-sm px-3 py-2 w-full">
                            <option class="bg-gray-800">New</option>
                            <option class="bg-gray-800">Contacted</option>
                            <option class="bg-gray-800">Qualified</option>
                            <option class="bg-gray-800">Converted</option>
                            <option class="bg-gray-800">Lost</option>
                        </select>
                    </div>


                    <div>
                        <p class="text-gray-400">Estimated Value</p>
                        <p>
                            Rp
                            <span
                                x-text="selectedLead.estimated_value
                                ? Number(selectedLead.estimated_value).toLocaleString('id-ID')
                                : '—'"></span>
                        </p>
                    </div>
                </div>

            </div>
            <div>
                <p class="text-gray-400">Handled By</p>
                <p class="font-medium" x-text="selectedLead.handled_by"></p>
            </div>


            <div class="mt-6">
                <p class="text-sm text-gray-400 mb-1">Internal Notes</p>
                <div class="rounded-xl border border-white/10 bg-black/40 p-4 text-sm text-gray-200">
                    <p x-text="selectedLead.internal_notes ?? 'No internal notes'"></p>
                </div>
            </div>

            <div class="flex justify-between items-center mt-8">

                <button
                    @click="contactLead(selectedLead)"
                    class="rounded-xl bg-emerald-500/90 px-4 py-2 text-sm font-medium text-black hover:bg-emerald-400 transition">
                    Contact
                </button>

                <button
                    @click="openViewModal = false"
                    class="rounded-xl border border-white/10 px-4 py-2 text-sm text-gray-300 hover:bg-white/5">
                    Close
                </button>
            </div>


        </div>
    </div>


    <div
        x-show="openAddModal"
        x-transition.opacity
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm"
        @keydown.escape.window="openAddModal = false"
        style="display: none;">
        <div
            @click.outside="openAddModal = false"
            class="w-full max-w-2xl rounded-2xl border border-white/10 bg-[#121214] p-8 shadow-2xl">

            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold tracking-tight">Add New Lead</h2>
                <button
                    @click="openAddModal = false"
                    class="text-gray-400 hover:text-white transition">
                    ✕
                </button>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('admin.leads.store') }}" class="space-y-5">
                @csrf

                <!-- Basic Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input
                        name="full_name"
                        required
                        placeholder="Full Name"
                        class="w-full rounded-xl bg-black/40 border border-white/10 px-4 py-2 text-sm text-white placeholder-gray-500 focus:border-white/30 focus:ring-0">

                    <input
                        name="email"
                        type="email"
                        placeholder="Email"
                        class="w-full rounded-xl bg-black/40 border border-white/10 px-4 py-2 text-sm text-white placeholder-gray-500 focus:border-white/30 focus:ring-0">

                    <div x-data="phoneInput()" class="space-y-1">
                        <label class="text-xs text-gray-400">Phone / WhatsApp</label>

                        <input type="hidden" name="phone" :value="fullPhone">

                        <div class="relative flex gap-2">

                            <!-- Country Picker -->
                            <button
                                type="button"
                                @click="open = !open"
                                class="flex items-center gap-2 rounded-xl bg-black/40 border border-white/10 px-3 py-2 text-sm text-white hover:border-white/30">
                                <span x-text="selected.flag"></span>
                                <span x-text="selected.code"></span>
                                <svg class="w-4 h-4 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Phone Input -->
                            <input
                                x-model="number"
                                @input="sanitize"
                                placeholder="812xxxxxxx"
                                class="flex-1 rounded-xl bg-black/40 border border-white/10 px-4 py-2 text-sm text-white placeholder-gray-500 focus:border-white/30">

                            <!-- Dropdown -->
                            <div
                                x-show="open"
                                @click.outside="open = false"
                                x-transition
                                class="absolute z-50 top-12 left-0 w-72 rounded-xl border border-white/10 bg-[#0f0f12] shadow-2xl">

                                <input
                                    x-model="search"
                                    placeholder="Search country..."
                                    class="w-full bg-black/40 px-3 py-2 text-sm text-white placeholder-gray-500 border-b border-white/10">

                                <div class="max-h-60 overflow-y-auto">
                                    <template x-for="c in filtered" :key="c.code">
                                        <button
                                            type="button"
                                            @click="select(c)"
                                            class="w-full flex items-center gap-3 px-4 py-2 text-sm hover:bg-white/5 text-left">
                                            <span x-text="c.flag"></span>
                                            <span class="flex-1" x-text="c.name"></span>
                                            <span class="text-gray-400" x-text="c.code"></span>
                                        </button>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input
                        name="company"
                        placeholder="Company"
                        class="w-full rounded-xl bg-black/40 border border-white/10 px-4 py-2 text-sm text-white placeholder-gray-500 focus:border-white/30 focus:ring-0">
                </div>

                <!-- Interest -->
                <input
                    name="interest"
                    placeholder="Interest (Tour / Visa / etc)"
                    class="w-full rounded-xl bg-black/40 border border-white/10 px-4 py-2 text-sm text-white placeholder-gray-500 focus:border-white/30 focus:ring-0">

                <!-- Lead Meta -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <select
                        name="lead_type"
                        required
                        class="w-full rounded-xl bg-black/40 border border-white/10 px-4 py-2 text-sm text-white focus:border-white/30 focus:ring-0">
                        <option class="bg-gray-800" value="">Lead Type</option>
                        <option class="bg-gray-800" value="B2C">B2C</option>
                        <option class="bg-gray-800" value="B2B">B2B</option>
                    </select>

                    <select
                        name="priority"
                        required
                        class="w-full rounded-xl bg-black/40 border border-white/10 px-4 py-2 text-sm text-white focus:border-white/30 focus:ring-0">
                        <option class="bg-gray-800" value="">Priority</option>
                        <option class="bg-gray-800" value="Low">Low</option>
                        <option class="bg-gray-800" value="Medium">Medium</option>
                        <option class="bg-gray-800" value="High">High</option>
                    </select>

                    <input
                        name="estimated_value"
                        type="number"
                        placeholder="Estimated Budget   "
                        class="w-full rounded-xl bg-black/40 border border-white/10 px-4 py-2 text-sm text-white placeholder-gray-500 focus:border-white/30 focus:ring-0">
                </div>

                <!-- Source -->
                <input
                    name="source"
                    placeholder="Source (Website / WA / IG)"
                    class="w-full rounded-xl bg-black/40 border border-white/10 px-4 py-2 text-sm text-white placeholder-gray-500 focus:border-white/30 focus:ring-0">

                <!-- Notes -->
                <textarea
                    name="internal_notes"
                    rows="3"
                    placeholder="Internal notes..."
                    class="w-full rounded-xl bg-black/40 border border-white/10 px-4 py-2 text-sm text-white placeholder-gray-500 focus:border-white/30 focus:ring-0 resize-none"></textarea>

                <!-- Actions -->
                <div class="flex justify-end gap-3 pt-4">
                    <button
                        type="button"
                        @click="openAddModal = false"
                        class="rounded-xl border border-white/10 px-4 py-2 text-sm text-gray-300 hover:bg-white/5 transition">
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="rounded-xl bg-white px-6 py-2 text-sm font-medium text-black hover:bg-gray-200 transition">
                        Save Lead
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function leadDashboard(statsData, leadsData) {
        return {
            openAddModal: false,
            openViewModal: false,
            selectedLead: {},

            stats: statsData,
            leads: leadsData,

            openViewLead(lead) {
                this.selectedLead = lead
                this.openViewModal = true
            },

            contactLead(lead) {
                const phone = lead.phone ?
                    lead.phone.replace(/[^0-9]/g, '') :
                    ''

                if (!phone || phone.length < 8) {
                    alert('Nomor WA ora valid cuk 😭')
                    return
                }

                window.open(`https://wa.me/${phone}`, '_blank')

                fetch(`/admin/leads/${lead.id}/contact`, {
                        method: 'POST',
                        credentials: 'same-origin',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(res => {
                        if (!res.ok) throw 'Gagal contact'
                        // 🔥 auto refresh
                        location.reload()
                    })
                    .catch(err => {
                        alert('Contact gagal cok 😭')
                        console.error(err)
                    })
            },

            updateStatus(lead) {
                fetch(`/admin/leads/${lead.id}/status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        status: lead.status
                    })
                }).then(res => {
                    if (!res.ok) alert('Gagal update status')
                })
            },

            statusClass(status) {
                return {
                    'bg-blue-100 text-blue-700': status === 'New',
                    'bg-amber-100 text-amber-700': status === 'Contacted',
                    'bg-indigo-100 text-indigo-700': status === 'Qualified',
                    'bg-emerald-100 text-emerald-700': status === 'Converted',
                    'bg-rose-100 text-rose-700': status === 'Lost',
                }
            },

            priorityClass(priority) {
                return {
                    'bg-emerald-100 text-emerald-700': priority === 'Low',
                    'bg-amber-100 text-amber-700': priority === 'Medium',
                    'bg-rose-100 text-rose-700': priority === 'High',
                }
            }
        }
    }
</script>

<script>
    function phoneInput() {
        return {
            open: false,
            search: '',
            number: '',
            selected: {
                name: 'Indonesia',
                code: '+62',
                flag: '🇮🇩'
            },

            countries: [{
                    name: 'Indonesia',
                    code: '+62',
                    flag: '🇮🇩'
                },
                {
                    name: 'Singapore',
                    code: '+65',
                    flag: '🇸🇬'
                },
                {
                    name: 'Malaysia',
                    code: '+60',
                    flag: '🇲🇾'
                },
                {
                    name: 'Japan',
                    code: '+81',
                    flag: '🇯🇵'
                },
                {
                    name: 'Australia',
                    code: '+61',
                    flag: '🇦🇺'
                },
                {
                    name: 'United States',
                    code: '+1',
                    flag: '🇺🇸'
                },
            ],

            get filtered() {
                return this.countries.filter(c =>
                    c.name.toLowerCase().includes(this.search.toLowerCase())
                )
            },

            select(c) {
                this.selected = c
                this.open = false
                this.search = ''
            },

            sanitize() {
                // hapus selain angka
                this.number = this.number.replace(/\D/g, '')
                // hapus leading 0
                if (this.number.startsWith('0')) {
                    this.number = this.number.slice(1)
                }
            },

            get fullPhone() {
                if (!this.number) return ''
                return this.selected.code + this.number
            }
        }
    }
</script>



@endsection