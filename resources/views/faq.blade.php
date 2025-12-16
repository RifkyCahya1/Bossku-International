@extends('main')

@section('content')

<section x-data="faqPage()" class="min-h-screen bg-[#0E0E10] text-white px-6 md:px-20 py-24">
    <!-- Header -->
    <div class="max-w-3xl mx-auto text-center mb-20">
        <h1 class="text-4xl md:text-5xl font-semibold tracking-tight">Frequently Asked Questions</h1>
        <p class="text-white/60 mt-4 text-lg">Clear answers. No fluff. Just what you need before traveling.</p>
    </div>

    <!-- FAQ List -->
    <div class="max-w-4xl mx-auto space-y-4">
        <template x-for="(item, index) in faqs" :key="index">
            <div class="bg-white/5 border border-white/10 rounded-2xl backdrop-blur-md overflow-hidden transition-all">
                <button @click="toggle(index)"
                    class="w-full flex justify-between items-center px-6 py-5 text-left">
                    <span class="text-lg font-medium" x-text="item.q"></span>
                    <svg :class="active === index ? 'rotate-45' : ''" class="w-5 h-5 transition-transform"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14" />
                    </svg>
                </button>

                <div x-show="active === index" x-collapse
                    class="px-6 pb-6 text-white/70 leading-relaxed">
                    <p x-text="item.a"></p>
                </div>
            </div>
        </template>
    </div>

    <!-- CTA -->
    <div class="max-w-3xl mx-auto text-center mt-24">
        <p class="text-white/60 mb-6">Still have questions?</p>
        <a href="https://wa.me/628112557728" target="_blank"
            class="inline-flex items-center gap-2 bg-white text-black px-8 py-4 rounded-full font-medium hover:bg-white/90 transition">
            Contact Our Travel Consultant
        </a>
    </div>
</section>

<script>
    function faqPage() {
        return {
            active: null,
            faqs: [{
                    q: 'How do I book a tour package?',
                    a: 'You can book directly through our website or contact our travel consultant via WhatsApp. Once confirmed, we will guide you through the payment and preparation process.'
                },
                {
                    q: 'Are the tour prices fixed?',
                    a: 'Prices may vary depending on availability, travel dates, seasonal demand, and airline or hotel policies. The final price will always be confirmed before payment.'
                },
                {
                    q: 'What happens after I make a payment?',
                    a: 'Once your payment is confirmed, we will send you a detailed itinerary, booking confirmations, and travel guidelines via email or WhatsApp.'
                },
                {
                    q: 'Can I request a custom trip?',
                    a: 'Yes. We offer tailor-made trips based on your preferences, budget, travel dates, and special requests. Our team will curate the best possible itinerary for you.'
                },
                {
                    q: 'Is my payment secure?',
                    a: 'Absolutely. All transactions are processed through secure and trusted payment gateways that comply with industry security standards.'
                },
                {
                    q: 'Do you offer refunds or cancellations?',
                    a: 'Refund and cancellation policies depend on the airline, hotel, and service provider. We will clearly explain the applicable policy before you proceed with booking.'
                },
                {
                    q: 'Can I change my travel dates after booking?',
                    a: 'Date changes are subject to availability and provider policies. Additional charges may apply depending on the changes requested.'
                },
                {
                    q: 'Do you assist with visa applications?',
                    a: 'Yes. We provide visa consultation and assistance for selected destinations, including required documents and application guidance.'
                },
                {
                    q: 'Are flights and hotels included in the package?',
                    a: 'Package inclusions vary by product. Each tour clearly states what is included and excluded, such as flights, accommodation, meals, and activities.'
                },
                {
                    q: 'How far in advance should I book my trip?',
                    a: 'We recommend booking as early as possible to secure availability and better pricing, especially during peak travel seasons.'
                },
                {
                    q: 'Who can I contact during the trip if I need help?',
                    a: 'You will have access to our support team or local partners during your trip to ensure a smooth and worry-free travel experience.'
                }
            ],
            toggle(index) {
                this.active = this.active === index ? null : index;
            }
        }
    }
</script>


@endsection