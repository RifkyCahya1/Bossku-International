<footer class="relative bg-gradient-to-bl from-[#1a1a1a] via-[#111] to-[#0a0a0a] text-gray-300 overflow-hidden">
    <!-- Decorative Elements - lebih minimalis -->
    <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>
    <div class="absolute top-1/4 -right-32 w-64 h-64 rounded-full bg-gradient-to-br from-white/3 to-transparent blur-2xl opacity-50"></div>
    <div class="absolute bottom-1/4 -left-32 w-64 h-64 rounded-full bg-gradient-to-tr from-indigo-900/5 to-transparent blur-2xl opacity-50"></div>

    <div class="relative container mx-auto px-4 md:px-8 lg:px-16 py-12">
        <!-- Success Notification - lebih proporsional -->
        @if(session('subscription_success'))
        <div class="mb-8 p-4 bg-gradient-to-r from-green-900/15 via-emerald-900/10 to-green-900/15 backdrop-blur-sm border border-green-800/30 rounded-lg text-green-300 shadow-lg shadow-green-900/5" id="subscription-notification">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-3 text-green-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-sm font-medium">{{ session('subscription_success') }}</span>
                </div>
                <button type="button" class="text-green-400/60 hover:text-green-300 transition-colors text-lg ml-4" onclick="document.getElementById('subscription-notification').remove()">
                    &times;
                </button>
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12">
            <div class="lg:col-span-7 xl:col-span-8">
                <!-- Logo -->
                <div class="mb-6">
                    <img src="{{ asset('img/Bossku.tours.png') }}"
                        alt="BOSSKU"
                        class="w-44 md:w-48 lg:w-52 brightness-110 contrast-110">
                </div>

                <!-- Newsletter Section -->
                <div class="mb-10">
                    <h4 class="text-xs uppercase tracking-[0.3em] text-gray-400 mb-5 font-light">
                        Stay in the Loop
                    </h4>

                    <h3 class="text-2xl md:text-3xl lg:text-4xl font-light text-white leading-tight mb-5 max-w-2xl">
                        <span class="bg-gradient-to-r from-white via-gray-100 to-gray-300 bg-clip-text text-transparent">
                            Journeys worth remembering.<br>
                            Stories worth opening.
                        </span>
                    </h3>

                    <p class="text-base md:text-lg text-gray-400/80 leading-relaxed mb-8 max-w-2xl">
                        No spam. No noise. Just thoughtfully curated travel inspiration,
                        exclusive routes, and rare departures delivered when it actually matters.
                    </p>

                    <!-- Subscription Form -->
                    <div class="relative max-w-2xl">
                        <form id="subscription-form" class="space-y-3">
                            @csrf
                            <div class="flex flex-col sm:flex-row gap-3">
                                <!-- Email Input -->
                                <div class="relative group flex-1">
                                    <input
                                        type="email"
                                        name="email"
                                        id="subscribe-email"
                                        placeholder="Your email address"
                                        required
                                        class="w-full px-5 py-3 rounded-lg bg-white/[0.03] border border-white/10 text-sm md:text-base text-white placeholder-gray-500/60 focus:outline-none focus:border-indigo-500/40 focus:bg-white/[0.04] focus:shadow-md focus:shadow-indigo-500/5 transition-all duration-200 group-hover:border-white/15 backdrop-blur-sm">
                                </div>

                                <!-- Subscribe Button -->
                                <button
                                    type="submit"
                                    id="subscribe-btn"
                                    class="relative px-6 py-3 rounded-lg bg-gradient-to-r from-white to-gray-200 text-black text-sm font-semibold hover:from-gray-200 hover:to-white hover:shadow-lg hover:shadow-white/10 transition-all duration-200 flex items-center justify-center group overflow-hidden min-w-[140px]">

                                    <span class="absolute inset-0 bg-gradient-to-r from-gray-200 to-white opacity-0 group-hover:opacity-100 transition-opacity duration-200"></span>
                                    <span id="btn-text" class="relative z-10 flex items-center justify-center">
                                        Subscribe
                                        <svg class="w-3.5 h-3.5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </span>
                                    <svg id="loading-spinner" class="hidden w-4 h-4 ml-2 text-gray-600 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </button>
                            </div>

                            <!-- Error Message -->
                            <div id="email-error" class="text-red-400/80 text-xs mt-1 hidden px-1"></div>
                        </form>

                        <!-- Success Message -->
                        <div id="success-message" class="mt-4 p-4 bg-gradient-to-r from-green-900/15 via-emerald-900/10 to-green-900/15 backdrop-blur-sm border border-green-800/30 rounded-lg text-green-300 shadow-lg shadow-green-900/5 hidden"></div>
                    </div>
                </div>
            </div>

            <!-- Links Columns - dengan alignment yang lebih rapi -->
            <div class="lg:col-span-5 xl:col-span-4">
                <div class="grid grid-cols-2 md:grid-cols-3 ">
                    <!-- Explore Column -->
                    <div>
                        <h4 class="text-[11px] uppercase tracking-[0.25em] text-gray-400 mb-5 font-light">
                            Explore
                        </h4>
                        <ul class="space-y-3">
                            <li>
                                <a href="/Tour" class="text-sm text-gray-400 hover:text-white transition-colors duration-200 block py-1.5">
                                    Tour Packages
                                </a>
                            </li>
                            <li>
                                <a href="/Custom-Form" class="text-sm text-gray-400 hover:text-white transition-colors duration-200 block py-1.5">
                                    Custom My Trip
                                </a>
                            </li>
                            <li>
                                <a href="/Explore" class="text-sm text-gray-400 hover:text-white transition-colors duration-200 block py-1.5">
                                    Destinations Map
                                </a>
                            </li>
                            <li>
                                <a href="/Experience" class="text-sm text-gray-400 hover:text-white transition-colors duration-200 block py-1.5">
                                    Experience
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Information Column -->
                    <div>
                        <h4 class="text-[11px] uppercase tracking-[0.25em] text-gray-400 mb-5 font-light">
                            Information
                        </h4>
                        <ul class="space-y-3">
                            <li>
                                <a href="/About" class="text-sm text-gray-400 hover:text-white transition-colors duration-200 block py-1.5">
                                    About Us
                                </a>
                            </li>
                            <li>
                                <a href="/FAQ" class="text-sm text-gray-400 hover:text-white transition-colors duration-200 block py-1.5">
                                    FAQ
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-sm text-gray-400 hover:text-white transition-colors duration-200 block py-1.5">
                                    Sponsorship
                                </a>
                            </li>
                            <li>
                                <a href="/partnership" class="text-sm text-gray-400 hover:text-white transition-colors duration-200 block py-1.5">
                                    Partnership
                                </a>
                            </li>
                            <li>
                                <a href="/terms" class="text-sm text-gray-400 hover:text-white transition-colors duration-200 block py-1.5">
                                    Terms & Conditions
                                </a>
                            </li>
                            <li>
                                <a href="/privacy" class="text-sm text-gray-400 hover:text-white transition-colors duration-200 block py-1.5">
                                    Privacy Policy
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Associated By Column -->
                    <div class="md:col-span-1">
                        <h4 class="text-[11px] uppercase tracking-[0.25em] text-gray-400 mb-5 font-light">
                            Associated By
                        </h4>

                        <div class="space-y-6">
                            <div class="relative">
                                <img src="{{ asset('img/Asita.png') }}"
                                    alt="ASITA"
                                    class="w-28 md:w-32 opacity-70 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-300">
                            </div>

                            <div class="relative">
                                <img src="{{ asset('img/Astindo.png') }}"
                                    alt="ASTINDO"
                                    class="w-28 md:w-32 opacity-70 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-300">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="pt-4 border-t border-white/10">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <!-- Copyright -->
                <div class="text-xs text-gray-500/70 text-center md:text-left order-2 md:order-1">
                    <p>
                        © 2024–2025 BOSSKU.TOURS. Crafted with intention.
                    </p>
                </div>

                <!-- Social Media untuk mobile -->
                <div class="order-1 md:order-2 mb-4 md:mb-0">
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-gray-500/70 hidden sm:inline">Follow:</span>
                        <div class="flex gap-3">
                            <a href="#" class="w-8 h-8 rounded-full bg-white/[0.03] border border-white/10 flex items-center justify-center text-gray-400 hover:text-white hover:bg-white/[0.06] transition-all duration-200">
                                <i class="fab fa-facebook-f text-xs"></i>
                            </a>
                            <a href="https://www.instagram.com/bossku.tours/" target="_blank" class="w-8 h-8 rounded-full bg-white/[0.03] border border-white/10 flex items-center justify-center text-gray-400 hover:text-white hover:bg-white/[0.06] transition-all duration-200">
                                <i class="fab fa-instagram text-xs"></i>
                            </a>
                            <a href="https://wa.me/6285727767777" target="_blank" class="w-8 h-8 rounded-full bg-white/[0.03] border border-white/10 flex items-center justify-center text-gray-400 hover:text-white hover:bg-white/[0.06] transition-all duration-200">
                                <i class="fab fa-whatsapp text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script>
    // Enhanced subscription form script with better UX
    document.getElementById('subscription-form').addEventListener('submit', async function(e) {
        e.preventDefault();

        const emailInput = document.getElementById('subscribe-email');
        const emailError = document.getElementById('email-error');
        const btn = document.getElementById('subscribe-btn');
        const btnText = document.getElementById('btn-text');
        const spinner = document.getElementById('loading-spinner');
        const successMessage = document.getElementById('success-message');

        // Reset state
        emailError.classList.add('hidden');
        emailError.textContent = '';
        successMessage.classList.add('hidden');

        // Email validation
        const email = emailInput.value.trim();
        if (!email) {
            emailError.textContent = 'Please enter your email address';
            emailError.classList.remove('hidden');
            emailInput.focus();
            return;
        }

        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            emailError.textContent = 'Please enter a valid email address';
            emailError.classList.remove('hidden');
            emailInput.focus();
            return;
        }

        // Show loading state
        btn.disabled = true;
        btnText.innerHTML = 'Subscribing...';
        spinner.classList.remove('hidden');

        try {
            const formData = new FormData();
            formData.append('email', email);
            formData.append('_token', document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}');

            const response = await fetch('/subscribe', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            });

            const contentType = response.headers.get("content-type");
            if (!contentType || !contentType.includes("application/json")) {
                const text = await response.text();
                throw new Error(`Server returned HTML instead of JSON. Status: ${response.status}`);
            }

            const data = await response.json();

            if (data.success) {
                successMessage.innerHTML = `
                    <div class="flex items-start">
                        <div class="w-8 h-8 rounded-full bg-green-900/20 flex items-center justify-center mr-3 flex-shrink-0">
                            <svg class="w-4 h-4 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-green-300 text-base mb-1">Thank you for subscribing!</div>
                            <div class="text-green-200/90 text-sm">${data.message}</div>
                        </div>
                    </div>
                `;
                successMessage.classList.remove('hidden');
                emailInput.value = '';

                // Auto-hide success message after 6 seconds
                setTimeout(() => {
                    successMessage.style.opacity = '0';
                    setTimeout(() => {
                        successMessage.classList.add('hidden');
                        successMessage.style.opacity = '1';
                    }, 300);
                }, 6000);
            } else {
                emailError.textContent = data.message || 'Subscription failed. Please try again.';
                emailError.classList.remove('hidden');
            }
        } catch (error) {
            console.error('Subscription error:', error);
            emailError.textContent = error.message.includes('HTML') ?
                'Server error. Please check your connection and try again.' :
                'An unexpected error occurred. Please try again later.';
            emailError.classList.remove('hidden');
        } finally {
            btn.disabled = false;
            btnText.innerHTML = 'Subscribe <svg class="w-3.5 h-3.5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>';
            spinner.classList.add('hidden');
        }
    });

    // Add focus effects to email input
    const emailField = document.getElementById('subscribe-email');
    emailField.addEventListener('focus', function() {
        this.parentElement.classList.add('ring-1', 'ring-indigo-500/20');
    });

    emailField.addEventListener('blur', function() {
        this.parentElement.classList.remove('ring-1', 'ring-indigo-500/20');
    });
</script>