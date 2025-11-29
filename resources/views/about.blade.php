@extends('main', ['excludeNavbar' => true])
@include('layout.navbarserv')

@section('content')

<main class="min-h-screen flex flex-col">
    <section class="relative overflow-hidden">
        <div class="absolute inset-0">
            <svg class="w-full h-full" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <defs>
                    <linearGradient id="g1" x1="0%" x2="100%" y1="0%" y2="100%">
                        <stop offset="0%" stop-color="#f8fafc" />
                        <stop offset="100%" stop-color="#eef2ff" />
                    </linearGradient>
                </defs>
                <path fill="url(#g1)" d="M0,224L48,213.3C96,203,192,181,288,170.7C384,160,480,160,576,170.7C672,181,768,203,864,197.3C960,192,1056,160,1152,149.3C1248,139,1344,149,1392,154.7L1440,160L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path>
            </svg>
        </div>

        <div class="relative max-w-7xl mx-auto px-6 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <p class="text-sm uppercase tracking-widest text-gray-500">The Soul Behind Bossku</p>
                    <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">Born from legacy. Driven by meaning.<br class="hidden md:inline"> Designed for travelers who feel more than they say.</h1>

                    <p class="text-lg text-gray-600 max-w-prose">We design journeys that restore something inside you — not merely take you somewhere new. For curious travelers who want to feel again.</p>

                    <div class="flex items-center gap-4">
                        <a href="#" class="inline-flex items-center px-6 py-3 bg-black text-white rounded-2xl shadow-lg text-sm font-semibold hover:opacity-95">See Our Packages</a>
                        <a href="#story" class="inline-flex items-center px-4 py-3 border border-gray-200 rounded-2xl text-sm text-gray-700 hover:bg-gray-50">Read Our Story</a>
                    </div>

                    <div class="mt-6 flex items-center gap-6">
                        <div class="flex-shrink-0">
                            <div class="text-xs text-gray-500">Years</div>
                            <div class="text-2xl font-bold">15+</div>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="text-xs text-gray-500">Trusted Trips</div>
                            <div class="text-2xl font-bold">Thousands</div>
                        </div>
                    </div>
                </div>

                <div class="relative pb-24">
                    <div class="rounded-4xl overflow-hidden shadow-[0_30px_60px_rgba(15,23,42,0.12)] ring-1 ring-yellow-50 bg-gradient-to-br from-white/80 to-gray-50">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1470252649378-9c29740c9fa8?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Sunrise landscape" class="w-full h-96 object-cover">
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-black/10 to-black/25"></div>

                        </div>

                        <!-- premium badges -->
                        <div class="absolute -left-6 -bottom-10 w-48 md:w-60 mt-20">
                            <div class="space-y-4">
                                <div class="bg-gradient-to-br from-white/70 to-gray-50 backdrop-blur-sm rounded-2xl p-4 shadow-xl border border-yellow-50">
                                    <div class="text-xs text-gray-400 uppercase tracking-wider">Hidden gems</div>
                                    <div class="font-semibold text-gray-900">Experiences found through trusted relationships</div>
                                </div>

                                <div class="bg-white/55 backdrop-blur rounded-2xl p-4 shadow-md border border-gray-100">
                                    <div class="text-xs text-gray-400 uppercase tracking-wider">Bespoke service</div>
                                    <div class="font-semibold text-gray-900">Concierge planning & local stewardship</div>
                                </div>
                            </div>
                        </div>

                        <!-- elegant accent ribbon -->
                        <div class="absolute top-6 right-6">
                            <div class="inline-flex items-center gap-2 bg-gradient-to-r from-black/50 to-transparent rounded-full px-3 py-1.5 shadow-sm border border-black/50">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M10 1l2.6 5.3L18 8l-4 3.1L15 17 10 14.2 5 17l1-5.9L2 8l5.4-1.7L10 1z"/></svg>
                                <span class="text-xs text-white font-bold">Curated Luxury</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="story" class="scroll-mt-16 max-w-6xl mx-auto px-6 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 items-start">
            <article class="lg:col-span-2 space-y-6">
                <h2 class="text-3xl font-extrabold">🌄 Our Story</h2>
                <p class="text-gray-700 leading-relaxed">Bossku began with one simple truth: <em>travel isn’t about distance — it’s about depth.</em> For more than 15 years, our parent company has guided thousands across Indonesia and beyond. But Bossku grew from a question that refused to stay quiet: <strong>What if a journey could restore something inside us — not just take us somewhere new?</strong></p>
                <p class="text-gray-700 leading-relaxed">We watched travelers arrive tired, restless, numb from routine… and leave awake, grateful, more themselves. That transformation became our compass.</p>
            </article>

            <aside class="space-y-4 p-6 bg-white rounded-2xl shadow-md ring-1 ring-gray-100">
                <h3 class="text-lg font-semibold">What We Believe</h3>
                <p class="text-sm text-gray-600">We believe nothing lasts — and that’s exactly why it matters. Moments fade, memories shift, seasons change.</p>

                <dl class="mt-4 space-y-3">
                    <div>
                        <dt class="text-sm font-medium">• Impermanence</dt>
                        <dd class="text-xs text-gray-500">Every journey is temporary — that’s why it's sacred.</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium">• Gratitude</dt>
                        <dd class="text-xs text-gray-500">Meaning appears when you slow down enough to feel it.</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium">• Authenticity</dt>
                        <dd class="text-xs text-gray-500">We create trips that tell the truth, not perform it.</dd>
                    </div>
                </dl>
            </aside>
        </div>
    </section>

    <section class="bg-white/60 py-12">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-3xl font-extrabold mb-6">🌏 What We Do</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="p-6 bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-md ring-1 ring-gray-100">
                    <h4 class="font-semibold">Premium Tour Packages</h4>
                    <p class="text-sm text-gray-600 mt-2">Domestic & international journeys crafted for depth.</p>
                </div>
                <div class="p-6 bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-md ring-1 ring-gray-100">
                    <h4 class="font-semibold">Custom-designed Trips</h4>
                    <p class="text-sm text-gray-600 mt-2">Individuals, couples, families & corporate groups.</p>
                </div>
                <div class="p-6 bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-md ring-1 ring-gray-100">
                    <h4 class="font-semibold">Visa & Ticketing</h4>
                    <p class="text-sm text-gray-600 mt-2">Flight ticketing, visa & passport services.</p>
                </div>
                <div class="p-6 bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-md ring-1 ring-gray-100">
                    <h4 class="font-semibold">Hidden-gem Experiences</h4>
                    <p class="text-sm text-gray-600 mt-2">Curated local discoveries through trusted partners.</p>
                </div>
            </div>

            <div class="mt-8 text-sm text-gray-600">Everything we design begins with a single question: <em>“What feeling are you searching for?”</em></div>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-6 py-12">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h3 class="text-2xl font-extrabold">🤝 Why People Trust Us</h3>
                <ul class="mt-4 space-y-3 text-gray-700">
                    <li><strong>15 years of operational expertise</strong> backed by a parent company with deep industry roots.</li>
                    <li><strong>Local connections & authentic partners</strong> that open doors to rare experiences.</li>
                    <li><strong>Human-first service</strong> where clarity, honesty, and care guide every step.</li>
                    <li><strong>Meaning before marketing</strong> — our philosophy shapes what we design.</li>
                </ul>
            </div>

            <div class="flex gap-6">
                <div class="text-center p-4 bg-white rounded-2xl shadow ring-1 ring-gray-100">
                    <div class="text-2xl font-bold">15+</div>
                    <div class="text-xs text-gray-500">Years</div>
                </div>
                <div class="text-center p-4 bg-white rounded-2xl shadow ring-1 ring-gray-100">
                    <div class="text-2xl font-bold">Thousands</div>
                    <div class="text-xs text-gray-500">Trusted Trips</div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gradient-to-t from-white to-gray-50 py-16">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h3 class="text-2xl font-extrabold">🌙 A Note From Us</h3>
            <p class="mt-4 text-gray-700">Bossku isn’t built to follow trends. It’s built for travelers who seek sincerity in a noisy world — those who want their next journey to matter. If you feel that calling, maybe it’s time to explore what Indonesia can awaken in you.</p>

            <div class="mt-8 flex justify-center gap-4">
                <a href="#team" class="px-6 py-3 bg-black text-white rounded-2xl shadow hover:opacity-95">Meet the Team</a>
                <a href="#" class="px-6 py-3 border border-gray-200 rounded-2xl text-sm text-gray-700">See Our Packages</a>
            </div>
        </div>
    </section>
    
    <section id="team" class="scroll-mt-16 max-w-6xl mx-auto px-6 py-12" x-data="teamModal()">
        <h3 class="text-2xl font-extrabold">Meet the Team</h3>
        <p class="text-sm text-gray-600 mt-2">A small, dedicated team that crafts big moments.</p>

        <div class="mt-6 grid grid-cols-2 sm:grid-cols-4 gap-6">
            <template x-for="member in members" :key="member.id">
                <button @click="open(member)" class="bg-white rounded-2xl p-4 shadow hover:shadow-lg text-left text-sm">
                    <div class="flex items-center gap-3">
                        <img :src="member.avatar" alt="" class="w-12 h-12 rounded-full object-cover ring-1 ring-gray-100">
                        <div>
                            <div class="font-medium" x-text="member.name"></div>
                            <div class="text-xs text-gray-500" x-text="member.role"></div>
                        </div>
                    </div>
                </button>
            </template>
        </div>

        <!-- modal -->
        <div x-show="isOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="fixed inset-0 bg-black/40" @click="close()"></div>
            <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full p-6 z-10">
                <div class="flex justify-between items-start gap-4">
                    <div class="flex items-center gap-4">
                        <img :src="selected.avatar" alt="" class="w-16 h-16 rounded-full object-cover ring-1 ring-gray-100">
                        <div>
                            <h4 class="font-bold" x-text="selected.name"></h4>
                            <div class="text-sm text-gray-500" x-text="selected.role"></div>
                        </div>
                    </div>
                    <button @click="close()" class="text-gray-400 hover:text-gray-600">✕</button>
                </div>

                <div class="mt-4 text-gray-700" x-text="selected.bio"></div>
            </div>
        </div>
    </section>
</main>

<script>
    function teamModal() {
        return {
            isOpen: false,
            selected: {
                id: null,
                name: '',
                role: '',
                avatar: '',
                bio: ''
            },
            members: [{
                    id: 1,
                    name: 'Alya Rahma',
                    role: 'Founder & Curator',
                    avatar: '{{ asset("images/team/alya.jpg") }}',
                    bio: 'Founder and lead curator. She believes travel can be a practice of attention.'
                },
                {
                    id: 2,
                    name: 'Bima Santoso',
                    role: 'Head of Operations',
                    avatar: '{{ asset("images/team/bima.jpg") }}',
                    bio: 'Ensures trips run smoothly — logistics, partners, and local relationships.'
                },
                {
                    id: 3,
                    name: 'Sari Dewi',
                    role: 'Guest Experience',
                    avatar: '{{ asset("images/team/sari.jpg") }}',
                    bio: 'Designs on-ground moments that help travelers connect and reflect.'
                },
                {
                    id: 4,
                    name: 'Rafi H',
                    role: 'Partnerships',
                    avatar: '{{ asset("images/team/rafi.jpg") }}',
                    bio: 'Builds local partnerships so our guests see places others don\'t.'
                }
            ],
            open(member) {
                this.selected = member;
                this.isOpen = true
            },
            close() {
                this.isOpen = false
            }
        }
    }
</script>


@endsection