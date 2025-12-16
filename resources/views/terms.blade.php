@extends('main')

@section('content')
<section class="relative overflow-hidden bg-gradient-to-br from-neutral-50 via-white to-neutral-100">

    <!-- soft luxury accents -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-40 -left-40 w-[520px] h-[520px] bg-indigo-200/40 blur-[160px] rounded-full"></div>
        <div class="absolute top-1/3 -right-40 w-[420px] h-[420px] bg-purple-200/30 blur-[140px] rounded-full"></div>
    </div>

    <div class="relative max-w-5xl mx-auto px-6 py-28">
        <!-- Header -->
        <div class="mb-20">
            <p class="text-xs uppercase tracking-[0.35em] text-neutral-500 mb-4">Legal & Policy</p>
            <h1 class="text-4xl md:text-5xl font-semibold text-neutral-900 mb-6">Terms & Conditions</h1>
            <p class="max-w-2xl text-neutral-600">These terms outline the rules, responsibilities, and legal boundaries governing the use of our platform, services, and travel products.</p>
        </div>

        <!-- Content -->
        <div class="space-y-5" x-data="{ open: null }">

            <!-- Item -->
            <div class="rounded-2xl border border-neutral-200 bg-white shadow-sm transition hover:shadow-md">
                <button @click="open === 1 ? open = null : open = 1" class="w-full flex items-center justify-between px-8 py-6 text-left">
                    <h2 class="text-lg font-medium text-neutral-900">1. Definitions & Scope of Services</h2>
                    <span class="text-neutral-400" x-text="open === 1 ? '–' : '+'"></span>
                </button>
                <div x-show="open === 1" x-collapse class="px-8 pb-8 text-neutral-600">
                    In these Terms & Conditions, “we”, “our”, and “us” refer to the platform operator. “User”, “you”, or “customer” refers to any individual or entity accessing or using our services. Our platform functions as an intermediary providing travel-related information, booking assistance, and digital services, while actual travel services are fulfilled by third-party providers.
                </div>
            </div>

            <div class="rounded-2xl border border-neutral-200 bg-white shadow-sm transition hover:shadow-md">
                <button @click="open === 2 ? open = null : open = 2" class="w-full flex items-center justify-between px-8 py-6 text-left">
                    <h2 class="text-lg font-medium text-neutral-900">2. Eligibility & Account Usage</h2>
                    <span class="text-neutral-400" x-text="open === 2 ? '–' : '+'"></span>
                </button>
                <div x-show="open === 2" x-collapse class="px-8 pb-8 text-neutral-600">
                    Users must be legally capable of entering binding agreements. Any misuse, fraudulent activity, or unauthorized access to our systems may result in suspension or termination of access without prior notice.
                </div>
            </div>

            <div class="rounded-2xl border border-neutral-200 bg-white shadow-sm transition hover:shadow-md">
                <button @click="open === 3 ? open = null : open = 3" class="w-full flex items-center justify-between px-8 py-6 text-left">
                    <h2 class="text-lg font-medium text-neutral-900">3. Booking & Reservations</h2>
                    <span class="text-neutral-400" x-text="open === 3 ? '–' : '+'"></span>
                </button>
                <div x-show="open === 3" x-collapse class="px-8 pb-8 text-neutral-600">
                    All bookings made through our platform are subject to confirmation from the respective travel providers. Availability, prices, itineraries, and inclusions may change without prior notice until full payment is completed.
                </div>
            </div>

            <div class="rounded-2xl border border-neutral-200 bg-white shadow-sm transition hover:shadow-md">
                <button @click="open === 4 ? open = null : open = 4" class="w-full flex items-center justify-between px-8 py-6 text-left">
                    <h2 class="text-lg font-medium text-neutral-900">4. Pricing & Payments</h2>
                    <span class="text-neutral-400" x-text="open === 4 ? '–' : '+'"></span>
                </button>
                <div x-show="open === 4" x-collapse class="px-8 pb-8 text-neutral-600">
                    Prices displayed on our website are listed in the applicable currency and may exclude taxes, service fees, or additional charges unless stated otherwise. Payment terms, deposits, and deadlines will be communicated prior to confirmation.
                </div>
            </div>

            <div class="rounded-2xl border border-neutral-200 bg-white shadow-sm transition hover:shadow-md">
                <button @click="open === 5 ? open = null : open = 5" class="w-full flex items-center justify-between px-8 py-6 text-left">
                    <h2 class="text-lg font-medium text-neutral-900">5. Cancellations & Refunds</h2>
                    <span class="text-neutral-400" x-text="open === 5 ? '–' : '+'"></span>
                </button>
                <div x-show="open === 5" x-collapse class="px-8 pb-8 text-neutral-600">
                    Cancellation and refund policies vary depending on the tour provider, destination, and booking type. Any eligible refunds will be processed according to the provider’s stated timelines and conditions.
                </div>
            </div>

            <div class="rounded-2xl border border-neutral-200 bg-white shadow-sm transition hover:shadow-md">
                <button @click="open === 6 ? open = null : open = 6" class="w-full flex items-center justify-between px-8 py-6 text-left">
                    <h2 class="text-lg font-medium text-neutral-900">6. Changes & Amendments</h2>
                    <span class="text-neutral-400" x-text="open === 6 ? '–' : '+'"></span>
                </button>
                <div x-show="open === 6" x-collapse class="px-8 pb-8 text-neutral-600">
                    Changes to confirmed bookings may incur additional charges and are subject to availability. We reserve the right to amend itineraries due to operational, safety, or external circumstances beyond our control.
                </div>
            </div>

            <div class="rounded-2xl border border-neutral-200 bg-white shadow-sm transition hover:shadow-md">
                <button @click="open === 7 ? open = null : open = 7" class="w-full flex items-center justify-between px-8 py-6 text-left">
                    <h2 class="text-lg font-medium text-neutral-900">7. User Responsibilities</h2>
                    <span class="text-neutral-400" x-text="open === 7 ? '–' : '+'"></span>
                </button>
                <div x-show="open === 7" x-collapse class="px-8 pb-8 text-neutral-600">
                    You are responsible for ensuring the accuracy of personal information provided, including passport validity, visa requirements, health documentation, and adequate travel insurance.
                </div>
            </div>

            <div class="rounded-2xl border border-neutral-200 bg-white shadow-sm transition hover:shadow-md">
                <button @click="open === 8 ? open = null : open = 8" class="w-full flex items-center justify-between px-8 py-6 text-left">
                    <h2 class="text-lg font-medium text-neutral-900">8. Limitation of Liability</h2>
                    <span class="text-neutral-400" x-text="open === 8 ? '–' : '+'"></span>
                </button>
                <div x-show="open === 8" x-collapse class="px-8 pb-8 text-neutral-600">
                    We shall not be liable for any loss, injury, delay, or damage caused by third-party services, force majeure events, or circumstances beyond our reasonable control.
                </div>
            </div>

            <div class="rounded-2xl border border-neutral-200 bg-white shadow-sm transition hover:shadow-md">
                <button @click="open === 9 ? open = null : open = 9" class="w-full flex items-center justify-between px-8 py-6 text-left">
                    <h2 class="text-lg font-medium text-neutral-900">9. Intellectual Property</h2>
                    <span class="text-neutral-400" x-text="open === 9 ? '–' : '+'"></span>
                </button>
                <div x-show="open === 9" x-collapse class="px-8 pb-8 text-neutral-600">
                    All content, branding, design assets, and materials on this website are protected by applicable intellectual property laws and may not be used without prior written consent.
                </div>
            </div>

            <div class="rounded-2xl border border-neutral-200 bg-white shadow-sm transition hover:shadow-md">
                <button @click="open === 10 ? open = null : open = 10" class="w-full flex items-center justify-between px-8 py-6 text-left">
                    <h2 class="text-lg font-medium text-neutral-900">10. Privacy & Data Protection</h2>
                    <span class="text-neutral-400" x-text="open === 10 ? '–' : '+'"></span>
                </button>
                <div x-show="open === 10" x-collapse class="px-8 pb-8 text-neutral-600">
                    Your use of this website is governed by our Privacy Policy, which explains how we collect, process, and protect your personal information.
                </div>
            </div>

            <div class="rounded-2xl border border-neutral-200 bg-white shadow-sm transition hover:shadow-md">
                <button @click="open === 11 ? open = null : open = 11" class="w-full flex items-center justify-between px-8 py-6 text-left">
                    <h2 class="text-lg font-medium text-neutral-900">11. Governing Law</h2>
                    <span class="text-neutral-400" x-text="open === 11 ? '–' : '+'"></span>
                </button>
                <div x-show="open === 11" x-collapse class="px-8 pb-8 text-neutral-600">
                    These Terms & Conditions shall be governed by and interpreted in accordance with the laws of the Republic of Indonesia.
                </div>
            </div>

            <div class="rounded-2xl border border-neutral-200 bg-white shadow-sm transition hover:shadow-md">
                <button @click="open === 12 ? open = null : open = 12" class="w-full flex items-center justify-between px-8 py-6 text-left">
                    <h2 class="text-lg font-medium text-neutral-900">12. Updates to Terms</h2>
                    <span class="text-neutral-400" x-text="open === 12 ? '–' : '+'"></span>
                </button>
                <div x-show="open === 12" x-collapse class="px-8 pb-8 text-neutral-600">
                    We reserve the right to update or modify these Terms & Conditions at any time. Continued use of our services constitutes acceptance of the updated terms.
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-20 pt-8 border-t border-neutral-200 text-sm text-neutral-500">
            Last updated <span class="text-neutral-700">2025</span>
        </div>
    </div>
</section>
@endsection