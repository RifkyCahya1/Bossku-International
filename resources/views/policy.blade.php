@extends('main', ['excludeNavbar' => true])
@include('layout.navbarserv')

@section('content')
<section class="relative overflow-hidden bg-gradient-to-br from-neutral-50 via-white to-neutral-100">

    <!-- Decorative background -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-40 -left-40 w-[520px] h-[520px] bg-indigo-200/40 blur-[120px]"></div>
        <div class="absolute top-1/3 -right-40 w-[520px] h-[520px] bg-purple-200/40 blur-[120px]"></div>
    </div>

    <div class="relative max-w-5xl mx-auto px-6 py-24">
        <!-- Header -->
        <div class="text-center mb-16">
            <p class="text-sm uppercase tracking-widest text-neutral-500">Legal & Trust</p>
            <h1 class="mt-3 text-4xl md:text-5xl font-light text-neutral-900">Privacy Policy</h1>
            <p class="mt-6 text-neutral-600 max-w-2xl mx-auto">
                We value your privacy and are committed to protecting your personal data. This Privacy Policy explains how we collect, use, and safeguard your information.
            </p>
        </div>

        <!-- Content Card -->
        <div class="bg-white/80 backdrop-blur-xl border border-neutral-200 rounded-3xl shadow-[0_20px_60px_-20px_rgba(0,0,0,0.15)] p-10 md:p-14 space-y-12">

            <div class="space-y-4">
                <h2 class="text-2xl font-medium text-neutral-900">1. Information We Collect</h2>
                <p class="text-neutral-600 leading-relaxed">
                    We may collect personal information such as your name, email address, phone number, travel preferences, payment details, and other information you voluntarily provide when using our services, making bookings, or contacting us.
                </p>
            </div>

            <div class="space-y-4">
                <h2 class="text-2xl font-medium text-neutral-900">2. How We Use Your Information</h2>
                <p class="text-neutral-600 leading-relaxed">
                    Your information is used to process bookings, manage payments, provide customer support, personalize your travel experience, improve our services, and communicate important updates related to your reservations or our platform.
                </p>
            </div>

            <div class="space-y-4">
                <h2 class="text-2xl font-medium text-neutral-900">3. Data Sharing & Disclosure</h2>
                <p class="text-neutral-600 leading-relaxed">
                    We do not sell your personal data. Information may be shared with trusted partners such as payment gateways, tour operators, or service providers solely for operational purposes and only to the extent necessary to deliver our services.
                </p>
            </div>

            <div class="space-y-4">
                <h2 class="text-2xl font-medium text-neutral-900">4. Data Security</h2>
                <p class="text-neutral-600 leading-relaxed">
                    We implement appropriate technical and organizational security measures to protect your personal data against unauthorized access, alteration, disclosure, or destruction.
                </p>
            </div>

            <div class="space-y-4">
                <h2 class="text-2xl font-medium text-neutral-900">5. Cookies & Tracking Technologies</h2>
                <p class="text-neutral-600 leading-relaxed">
                    Our website may use cookies and similar technologies to enhance user experience, analyze traffic, and improve functionality. You may control cookie preferences through your browser settings.
                </p>
            </div>

            <div class="space-y-4">
                <h2 class="text-2xl font-medium text-neutral-900">6. Your Rights</h2>
                <p class="text-neutral-600 leading-relaxed">
                    You have the right to access, correct, update, or request deletion of your personal data. You may also object to certain data processing activities in accordance with applicable data protection laws.
                </p>
            </div>

            <div class="space-y-4">
                <h2 class="text-2xl font-medium text-neutral-900">7. Third-Party Links</h2>
                <p class="text-neutral-600 leading-relaxed">
                    Our website may contain links to third-party websites. We are not responsible for the privacy practices or content of those external sites.
                </p>
            </div>

            <div class="space-y-4">
                <h2 class="text-2xl font-medium text-neutral-900">8. Policy Updates</h2>
                <p class="text-neutral-600 leading-relaxed">
                    We may update this Privacy Policy from time to time to reflect changes in legal requirements or our practices. Any updates will be posted on this page with a revised effective date.
                </p>
            </div>

            <div class="space-y-4">
                <h2 class="text-2xl font-medium text-neutral-900">9. Contact Us</h2>
                <p class="text-neutral-600 leading-relaxed">
                    If you have any questions or concerns regarding this Privacy Policy or how we handle your personal data, please contact us through our official communication channels.
                </p>
            </div>

        </div>

        <!-- Footer note -->
        <p class="mt-12 text-center text-sm text-neutral-500">
            Last updated: {{ date('F d, Y') }}
        </p>
    </div>
</section>
@endsection