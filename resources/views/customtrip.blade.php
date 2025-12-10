@extends('main', ['excludeNavbar' => true])
@include('layout.navbarserv')

@section('content')

<div x-data="customTripForm()"
    class="relative bg-gradient-to-b from-[#faf6f0] via-[#f5ede3] to-[#fff9f0] text-[#1a1a1a] overflow-hidden">
    
    <!-- Hero Section with Parallax -->
    <div class="relative h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 1200 600" preserveAspectRatio="xMidYMid slice">
                <defs>
                    <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M 40 0 L 0 0 0 40" fill="none" stroke="#b79a5b" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="1200" height="600" fill="url(#grid)" />
            </svg>
        </div>

        <div class="container mx-auto px-6 md:px-16 text-center space-y-8 relative z-10">
            <div class="inline-block px-4 py-2 rounded-full bg-[#b79a5b]/10 border border-[#b79a5b]/30 backdrop-blur-sm">
                <p class="text-xs tracking-widest text-[#b79a5b] font-medium uppercase">Luxury Travel Curation</p>
            </div>

            <h1 class="text-4xl md:text-6xl lg:text-7xl font-light tracking-tight leading-tight">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#b79a5b] via-[#d4af86] to-[#f3e7c1]">
                    Design a Journey
                </span>
                <br>
                <span class="text-[#2b2b2b] font-light">That Remembers You</span>
            </h1>

            <p class="max-w-3xl mx-auto text-gray-600 text-base md:text-lg leading-relaxed font-light">
                Not a package. Not a plan. A carefully crafted experience—a journey shaped around the 
                profound feeling you want to bring home.
            </p>

            <div class="flex flex-col md:flex-row gap-4 justify-center pt-8">
                <button
                    @click="openCustom = true; document.body.classList.add('overflow-hidden')"
                    class="group px-10 py-4 bg-gradient-to-r from-[#b79a5b] to-[#d4af86] text-white font-semibold rounded-lg shadow-2xl hover:shadow-3xl hover:scale-105 transition-all duration-300 flex items-center justify-center gap-2 backdrop-blur-sm">
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Design My Journey
                </button>

                <a href="https://wa.me/6285727767777" target="_blank"
                    class="px-10 py-4 bg-white/50 backdrop-blur-sm border border-[#b79a5b]/30 text-[#2b2b2b] font-semibold rounded-lg hover:bg-white/80 transition-all duration-300 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.272-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.67-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.076 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421-7.403h-.004a9.87 9.87 0 00-4.781 1.149c-1.488.694-2.744 1.613-3.594 2.766-.85 1.153-1.307 2.437-1.309 3.763 0 3.585 2.487 6.9 6.156 7.813.565.149 1.159.226 1.756.226h.005c3.51 0 6.424-2.505 7.178-5.953.285-1.33.286-2.823 0-4.181-.751-3.446-3.67-5.985-7.178-5.984z" />
                    </svg>
                    Chat with Nina
                </a>
            </div>
        </div>
    </div>

    <div
        x-show="openCustom"
        x-transition.opacity.duration-300ms
        class="fixed inset-0 bg-black/40 backdrop-blur-md z-99 flex items-center justify-center p-4 overflow-y-auto"
        @click.self="openCustom = false; document.body.classList.remove('overflow-hidden')"
        style="display:none">

        <div
            class="bg-gradient-to-br from-[#1a1a1a] via-[#252525] to-[#1f1f1f] w-full max-w-2xl rounded-2xl shadow-2xl overflow-hidden border border-white/5 overflow-y-auto max-h-[90vh]"
            x-transition.scale.duration-300ms
            @click.stop>

            <div class="sticky top-0 bg-gradient-to-r from-[#b79a5b]/10 to-[#d4af86]/10 border-b border-white/5 px-8 py-6 flex items-center justify-between backdrop-blur-xl z-50">
                <div>
                    <h3 class="text-2xl text-white font-light tracking-tight">Craft Your Experience</h3>
                    <p class="text-xs text-gray-400 mt-1">Personalized luxury journey design</p>
                </div>
                <button
                    @click="openCustom = false; document.body.classList.remove('overflow-hidden')"
                    class="text-gray-400 hover:text-white transition p-2 hover:bg-white/10 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="p-8">
                <p class="text-gray-300 text-sm text-center mb-8 leading-relaxed">
                    Share your vision. The more transparent you are about your desires, the more authentic the experience we'll curate.
                </p>

                <form @submit.prevent="submitForm" class="space-y-6">

                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-semibold text-gray-300 uppercase tracking-wider">Full Name *</label>
                            <input
                                type="text"
                                x-model="form.name"
                                @blur="validate('name')"
                                :class="error.name ? 'border-red-500/50 bg-red-500/5' : 'border-white/10 hover:border-white/20'"
                                class="w-full px-4 py-3 rounded-lg bg-white/5 border backdrop-blur-sm focus:border-[#b79a5b] focus:bg-white/10 outline-none text-white transition placeholder-gray-500"
                                placeholder="John Doe">
                            <p x-show="error.name" class="text-red-400 text-xs mt-1" x-text="error.name"></p>
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-semibold text-gray-300 uppercase tracking-wider">Email Address *</label>
                            <input
                                type="email"
                                x-model="form.email"
                                @blur="validate('email')"
                                :class="error.email ? 'border-red-500/50 bg-red-500/5' : 'border-white/10 hover:border-white/20'"
                                class="w-full px-4 py-3 rounded-lg bg-white/5 border backdrop-blur-sm focus:border-[#b79a5b] focus:bg-white/10 outline-none text-white transition placeholder-gray-500"
                                placeholder="you@example.com">
                            <p x-show="error.email" class="text-red-400 text-xs mt-1" x-text="error.email"></p>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-semibold text-gray-300 uppercase tracking-wider">Phone / WhatsApp *</label>
                            <input
                                type="text"
                                x-model="form.phone"
                                @blur="validate('phone')"
                                :class="error.phone ? 'border-red-500/50 bg-red-500/5' : 'border-white/10 hover:border-white/20'"
                                class="w-full px-4 py-3 rounded-lg bg-white/5 border backdrop-blur-sm focus:border-[#b79a5b] focus:bg-white/10 outline-none text-white transition placeholder-gray-500"
                                placeholder="+62 812 3456 7890">
                            <p x-show="error.phone" class="text-red-400 text-xs mt-1" x-text="error.phone"></p>
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-semibold text-gray-300 uppercase tracking-wider">Preferred Contact</label>
                            <select x-model="form.contact" class="w-full px-4 py-3 rounded-lg bg-white/5 border border-white/10 hover:border-white/20 focus:border-[#b79a5b] focus:bg-white/10 outline-none text-white transition appearance-none cursor-pointer">
                                <option value="" class="bg-[#1a1a1a]">Select method</option>
                                <option value="Email" class="bg-[#1a1a1a]">Email</option>
                                <option value="WhatsApp" class="bg-[#1a1a1a]">WhatsApp</option>
                                <option value="Call" class="bg-[#1a1a1a]">Call</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-semibold text-gray-300 uppercase tracking-wider">Travel Dates</label>
                            <input type="text" x-model="form.dates" placeholder="e.g., March 15-25, 2024" class="w-full px-4 py-3 rounded-lg bg-white/5 border border-white/10 hover:border-white/20 focus:border-[#b79a5b] focus:bg-white/10 outline-none text-white transition placeholder-gray-500">
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-semibold text-gray-300 uppercase tracking-wider">Destination / Region</label>
                            <input type="text" x-model="form.destination" placeholder="e.g., Bali, Java, Raja Ampat" class="w-full px-4 py-3 rounded-lg bg-white/5 border border-white/10 hover:border-white/20 focus:border-[#b79a5b] focus:bg-white/10 outline-none text-white transition placeholder-gray-500">
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-semibold text-gray-300 uppercase tracking-wider">Traveling With</label>
                            <input type="text" x-model="form.pax" placeholder="e.g., Solo, Couple, Family of 4" class="w-full px-4 py-3 rounded-lg bg-white/5 border border-white/10 hover:border-white/20 focus:border-[#b79a5b] focus:bg-white/10 outline-none text-white transition placeholder-gray-500">
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-semibold text-gray-300 uppercase tracking-wider">Your Archetype</label>
                            <select x-model="form.archetype" class="w-full px-4 py-3 rounded-lg bg-white/5 border border-white/10 hover:border-white/20 focus:border-[#b79a5b] focus:bg-white/10 outline-none text-white transition appearance-none cursor-pointer">
                                <option value="" class="bg-[#1a1a1a]">Select archetype</option>
                                <option value="The Dreamer" class="bg-[#1a1a1a]">The Dreamer</option>
                                <option value="The Seeker" class="bg-[#1a1a1a]">The Seeker</option>
                                <option value="The Thrillborn" class="bg-[#1a1a1a]">The Thrillborn</option>
                                <option value="The Lover" class="bg-[#1a1a1a]">The Lover</option>
                                <option value="Other" class="bg-[#1a1a1a]">Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-semibold text-gray-300 uppercase tracking-wider">Budget (per person)</label>
                        <input type="text" x-model="form.budget" placeholder="e.g., $2,000 - $5,000" class="w-full px-4 py-3 rounded-lg bg-white/5 border border-white/10 hover:border-white/20 focus:border-[#b79a5b] focus:bg-white/10 outline-none text-white transition placeholder-gray-500">
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-semibold text-gray-300 uppercase tracking-wider">Your Intention or Vision</label>
                        <textarea x-model="form.intention" rows="4" placeholder="What feeling are you seeking? Share a memory, a mood, or a single word that defines this journey..." class="w-full px-4 py-3 rounded-lg bg-white/5 border border-white/10 hover:border-white/20 focus:border-[#b79a5b] focus:bg-white/10 outline-none text-white transition placeholder-gray-500 resize-none"></textarea>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-semibold text-gray-300 uppercase tracking-wider">Special Requests or Considerations</label>
                        <textarea x-model="form.special" rows="2" placeholder="Any dietary needs, accessibility requirements, or unique requests..." class="w-full px-4 py-3 rounded-lg bg-white/5 border border-white/10 hover:border-white/20 focus:border-[#b79a5b] focus:bg-white/10 outline-none text-white transition placeholder-gray-500 resize-none"></textarea>
                    </div>

                    <div class="bg-white/5 border border-white/10 rounded-lg p-4 space-y-3">
                        <label class="flex items-start gap-3 cursor-pointer group">
                            <input type="checkbox" x-model="form.consent" @change="validate('consent')" class="w-5 h-5 mt-0.5 rounded border-white/20 bg-white/5 accent-[#b79a5b] cursor-pointer">
                            <p class="text-xs text-gray-400 group-hover:text-gray-300 transition">I consent to BossKu International using my details to prepare a personalized travel proposal and follow up with recommendations.</p>
                        </label>
                        <p x-show="error.consent" class="text-red-400 text-xs ml-8" x-text="error.consent"></p>
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-gradient-to-r from-[#b79a5b] to-[#d4af86] hover:from-[#c9aa6b] hover:to-[#e0bb96] text-white font-semibold py-4 rounded-lg hover:shadow-2xl transition-all duration-300 flex items-center justify-center gap-2 group">
                        <span x-show="!loading" class="flex items-center gap-2">
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Send My Request
                        </span>
                        <span x-show="loading" class="flex items-center gap-2">
                            <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Processing…
                        </span>
                    </button>

                    <p class="text-xs text-gray-500 text-center">Our travel designers will review your request within 24 hours and craft a personalized proposal for you.</p>

                </form>
            </div>
        </div>
    </div>

    <section class="bg-gradient-to-r from-[#faf8f2] to-[#f5ede3] text-gray-800 py-24 border-t border-gray-200/50">
        <div class="container mx-auto px-6 md:px-16">
            <div class="max-w-3xl mx-auto text-center space-y-8">
                <h2 class="text-3xl md:text-4xl font-light tracking-tight">
                    Why <span class="text-[#b79a5b]">BossKu</span> is Different
                </h2>

                <p class="text-gray-700 text-lg leading-relaxed font-light">
                    Maybe you never saw the trip you wanted because it hasn't been designed yet. 
                    Tell us the <span class="font-semibold text-[#b79a5b]">feeling</span> you're searching for—not just the dates or the places—
                    and we'll curate a journey that transcends expectations.
                </p>

                <div class="bg-white/70 backdrop-blur-sm border border-gray-200/50 rounded-xl p-8 italic text-gray-700">
                    "We listen first. Then we craft. Then you travel transformed."
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gradient-to-b from-[#f3f0eb] to-[#ede5d9] text-gray-800 py-24">
        <div class="container mx-auto px-6 md:px-16 space-y-16">

            <div class="text-center space-y-4">
                <h2 class="text-4xl md:text-5xl font-light tracking-tight">
                    The <span class="text-[#b79a5b]">Process</span>
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Four intentional steps from vision to reality.</p>
            </div>

            <div class="grid md:grid-cols-4 gap-8">

                <div class="group relative">
                    <div class="absolute -inset-2 bg-gradient-to-r from-[#b79a5b]/20 to-[#d4af86]/20 rounded-xl opacity-0 group-hover:opacity-100 blur transition duration-300"></div>
                    <div class="relative bg-white/70 backdrop-blur-sm border border-gray-200/50 rounded-xl p-8 space-y-4 h-full hover:border-[#b79a5b]/30 transition">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-r from-[#b79a5b] to-[#d4af86] flex items-center justify-center text-white font-semibold">01</div>
                        <h3 class="text-lg font-semibold text-gray-800">Listen & Understand</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">Share your vision, mood, and dreams. We don't ask for a checklist—we ask for your soul.</p>
                    </div>
                </div>

                <div class="group relative">
                    <div class="absolute -inset-2 bg-gradient-to-r from-[#b79a5b]/20 to-[#d4af86]/20 rounded-xl opacity-0 group-hover:opacity-100 blur transition duration-300"></div>
                    <div class="relative bg-white/70 backdrop-blur-sm border border-gray-200/50 rounded-xl p-8 space-y-4 h-full hover:border-[#b79a5b]/30 transition">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-r from-[#b79a5b] to-[#d4af86] flex items-center justify-center text-white font-semibold">02</div>
                        <h3 class="text-lg font-semibold text-gray-800">Design & Propose</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">Our designers craft a thoughtful proposal with rhythm, taste, and purpose baked in.</p>
                    </div>
                </div>

                <div class="group relative">
                    <div class="absolute -inset-2 bg-gradient-to-r from-[#b79a5b]/20 to-[#d4af86]/20 rounded-xl opacity-0 group-hover:opacity-100 blur transition duration-300"></div>
                    <div class="relative bg-white/70 backdrop-blur-sm border border-gray-200/50 rounded-xl p-8 space-y-4 h-full hover:border-[#b79a5b]/30 transition">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-r from-[#b79a5b] to-[#d4af86] flex items-center justify-center text-white font-semibold">03</div>
                        <h3 class="text-lg font-semibold text-gray-800">Refine & Confirm</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">You refine and confirm. We adjust until it feels authentically, completely yours.</p>
                    </div>
                </div>

                <div class="group relative">
                    <div class="absolute -inset-2 bg-gradient-to-r from-[#b79a5b]/20 to-[#d4af86]/20 rounded-xl opacity-0 group-hover:opacity-100 blur transition duration-300"></div>
                    <div class="relative bg-white/70 backdrop-blur-sm border border-gray-200/50 rounded-xl p-8 space-y-4 h-full hover:border-[#b79a5b]/30 transition">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-r from-[#b79a5b] to-[#d4af86] flex items-center justify-center text-white font-semibold">04</div>
                        <h3 class="text-lg font-semibold text-gray-800">Travel & Transform</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">Travel with full presence. Return different. Keep what matters. Share your story.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="bg-gradient-to-r from-[#faf8f2] to-[#f5ede3] text-gray-800 py-24">
        <div class="container mx-auto px-6 md:px-16 space-y-12">
            <h2 class="text-4xl md:text-5xl text-center font-light">
                What You'll <span class="text-[#b79a5b]">Receive</span>
            </h2>

            <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <div class="bg-white/70 backdrop-blur-sm border border-gray-200/50 rounded-xl p-8 hover:border-[#b79a5b]/30 transition group">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-r from-[#b79a5b] to-[#d4af86] flex items-center justify-center text-white mb-4 group-hover:scale-110 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">Curated Itinerary</h3>
                    <p class="text-gray-600 text-sm">A high-level suggested itinerary designed around your vision and feelings.</p>
                </div>

                <div class="bg-white/70 backdrop-blur-sm border border-gray-200/50 rounded-xl p-8 hover:border-[#b79a5b]/30 transition group">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-r from-[#b79a5b] to-[#d4af86] flex items-center justify-center text-white mb-4 group-hover:scale-110 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4a6 6 0 016-6h4a6 6 0 016 6v4M9 7a3 3 0 100-6 3 3 0 000 6z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">Handpicked Accommodations</h3>
                    <p class="text-gray-600 text-sm">Curated stays with imagery, details, and personal notes from our team.</p>
                </div>

                <div class="bg-white/70 backdrop-blur-sm border border-gray-200/50 rounded-xl p-8 hover:border-[#b79a5b]/30 transition group">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-r from-[#b79a5b] to-[#d4af86] flex items-center justify-center text-white mb-4 group-hover:scale-110 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">Transparent Pricing</h3>
                    <p class="text-gray-600 text-sm">Estimated costs and multiple payment options tailored to your budget.</p>
                </div>

                <div class="bg-white/70 backdrop-blur-sm border border-gray-200/50 rounded-xl p-8 hover:border-[#b79a5b]/30 transition group">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-r from-[#b79a5b] to-[#d4af86] flex items-center justify-center text-white mb-4 group-hover:scale-110 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">Full Logistics Support</h3>
                    <p class="text-gray-600 text-sm">Flights, visas, transfers, insurance, and safety—handled with precision.</p>
                </div>
            </div>

            <div class="text-center pt-8">
                <p class="text-gray-600 italic">No pressure. You can refine, pause, or politely decline. We're here for your journey alone.</p>
            </div>
        </div>
    </section>

    <section class="bg-gradient-to-b from-[#f3f0eb] to-[#ede5d9] text-gray-800 py-24">
        <div class="container mx-auto px-6 md:px-16">
            <h2 class="text-4xl md:text-5xl text-center font-light mb-16">
                Why <span class="text-[#b79a5b]">BossKu</span>
            </h2>

            <div class="grid md:grid-cols-2 gap-10 max-w-5xl mx-auto">

                <div class="group bg-white/70 backdrop-blur-sm border border-gray-200/50 rounded-xl p-10 hover:shadow-2xl hover:border-[#b79a5b]/30 transition">
                    <div class="mb-4 text-4xl">🎨</div>
                    <h3 class="text-xl font-semibold text-[#b79a5b] mb-3 group-hover:text-[#d4af86] transition">People-First Design</h3>
                    <p class="text-gray-700 leading-relaxed">We build around your feelings, values, and desires—not templated itineraries. Each journey is a work of art.</p>
                </div>

                <div class="group bg-white/70 backdrop-blur-sm border border-gray-200/50 rounded-xl p-10 hover:shadow-2xl hover:border-[#b79a5b]/30 transition">
                    <div class="mb-4 text-4xl">🌍</div>
                    <h3 class="text-xl font-semibold text-[#b79a5b] mb-3 group-hover:text-[#d4af86] transition">Local Relationships</h3>
                    <p class="text-gray-700 leading-relaxed">Handpicked partners across every destination who live the culture and keep authenticity alive in every experience.</p>
                </div>

                <div class="group bg-white/70 backdrop-blur-sm border border-gray-200/50 rounded-xl p-10 hover:shadow-2xl hover:border-[#b79a5b]/30 transition">
                    <div class="mb-4 text-4xl">✈️</div>
                    <h3 class="text-xl font-semibold text-[#b79a5b] mb-3 group-hover:text-[#d4af86] transition">Operational Excellence</h3>
                    <p class="text-gray-700 leading-relaxed">Flights, visas, permits, transport, insurance, and contingencies—handled quietly so you can focus on the magic.</p>
                </div>

                <div class="group bg-white/70 backdrop-blur-sm border border-gray-200/50 rounded-xl p-10 hover:shadow-2xl hover:border-[#b79a5b]/30 transition">
                    <div class="mb-4 text-4xl">💳</div>
                    <h3 class="text-xl font-semibold text-[#b79a5b] mb-3 group-hover:text-[#d4af86] transition">Flexible Payments</h3>
                    <p class="text-gray-700 leading-relaxed">Multiple payment gateways, installment plans, and flexible cancellation policies. Travel on your timeline.</p>
                </div>

            </div>
        </div>
    </section>

    <section class="bg-gradient-to-r from-[#1a1a1a] via-[#252525] to-[#1f1f1f] text-white py-24 relative overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <svg class="w-full h-full" viewBox="0 0 1200 300" preserveAspectRatio="xMidYMid slice">
                <defs>
                    <linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#b79a5b;stop-opacity:0.1" />
                        <stop offset="100%" style="stop-color:#d4af86;stop-opacity:0.05" />
                    </linearGradient>
                </defs>
                <circle cx="100" cy="100" r="80" fill="url(#grad)" />
                <circle cx="1100" cy="200" r="100" fill="url(#grad)" />
            </svg>
        </div>

        <div class="container mx-auto px-6 md:px-16 text-center space-y-8 relative z-10">
            <h2 class="text-3xl md:text-4xl font-light">
                Ready to Design Your <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#b79a5b] to-[#f3e7c1]">Dream Journey</span>?
            </h2>

            <p class="text-gray-300 max-w-2xl mx-auto text-lg">
                Start with 5 minutes. Share your vision. Let us handle the rest.
            </p>

            <div class="flex flex-col md:flex-row gap-4 justify-center pt-8">
                <button
                    @click="openCustom = true; document.body.classList.add('overflow-hidden')"
                    class="px-10 py-4 bg-gradient-to-r from-[#b79a5b] to-[#d4af86] text-white font-semibold rounded-lg hover:shadow-2xl hover:scale-105 transition-all duration-300">
                    Begin Now
                </button>

                <a href="https://wa.me/6285727767777" target="_blank"
                    class="px-10 py-4 bg-white/10 backdrop-blur-sm border border-white/20 text-white font-semibold rounded-lg hover:bg-white/20 transition-all duration-300">
                    Chat with Nina
                </a>
            </div>

            <p class="text-xs text-gray-400 mt-8">No commitment. No pressure. Just possibilities.</p>
        </div>
    </section>

    <!-- Footer Note -->
    <section class="bg-[#0f0f0f] text-gray-600 py-8 border-t border-white/5">
        <div class="container mx-auto px-6 md:px-16 text-center text-xs">
            <p>BossKu International © 2024. <span class="text-[#b79a5b]">Designed by experience. Curated by meaning.</span></p>
        </div>
    </section>

</div>

<script>
    function customTripForm() {
        return {
            openCustom: false,
            loading: false,

            form: {
                name: '',
                email: '',
                phone: '',
                contact: '',
                dates: '',
                destination: '',
                pax: '',
                archetype: '',
                budget: '',
                intention: '',
                special: '',
                consent: false,
            },

            error: {},

            validate(field) {
                this.error[field] = null;

                if (field === 'name' && this.form.name.trim() === '') {
                    this.error.name = "Name is required.";
                }

                if (field === 'email') {
                    const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!pattern.test(this.form.email)) {
                        this.error.email = "Please enter a valid email address.";
                    }
                }

                if (field === 'phone') {
                    if (this.form.phone.trim() === '') {
                        this.error.phone = "Phone number is required.";
                    } else if (this.form.phone.length < 8) {
                        this.error.phone = "Phone number seems too short.";
                    }
                }

                if (field === 'consent') {
                    if (!this.form.consent) {
                        this.error.consent = "You must agree to continue.";
                    }
                }
            },

            submitForm() {
                this.loading = true;
                this.error = {};

                ['name', 'email', 'phone', 'consent'].forEach(f => this.validate(f));

                if (Object.keys(this.error).some(k => this.error[k])) {
                    this.loading = false;
                    return;
                }

                setTimeout(() => {
                    this.loading = false;
                    alert("✨ Your request has been received! Our travel designers will reach out within 24 hours to begin crafting your journey.");
                    this.openCustom = false;
                    document.body.classList.remove('overflow-hidden');
                    
                    // Reset form
                    this.form = {
                        name: '',
                        email: '',
                        phone: '',
                        contact: '',
                        dates: '',
                        destination: '',
                        pax: '',
                        archetype: '',
                        budget: '',
                        intention: '',
                        special: '',
                        consent: false,
                    };
                }, 1500);
            }
        }
    }
</script>

@endsection