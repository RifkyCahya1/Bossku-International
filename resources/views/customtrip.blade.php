@extends('main')

@section('content')

<section class="max-w-4xl mx-auto py-20 px-6" x-data="{loading:false, submitted:false}">

    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold tracking-tight text-gray-900">Create Your Luxury Custom Trip</h1>
        <p class="text-lg text-gray-600 mt-3">Tailored journeys for international travelers seeking exclusive experiences.</p>
    </div>

    <form @submit.prevent="loading=true; setTimeout(()=>{submitted=true; loading=false}, 1500)" class="bg-white/60 backdrop-blur-xl shadow-xl rounded-3xl p-10 border border-white/40">

        <!-- Personal Info -->
        <div class="mb-10">
            <h2 class="text-xl font-semibold mb-4 text-gray-900">Personal Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block mb-1 text-sm font-medium">Full Name</label>
                    <input type="text" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-black/30 focus:border-black/40" required />
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium">Email Address</label>
                    <input type="email" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-black/30 focus:border-black/40" required />
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium">Country of Residence</label>
                    <input type="text" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-black/30 focus:border-black/40" required />
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium">Phone Number (WhatsApp)</label>
                    <input type="text" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-black/30 focus:border-black/40" required />
                </div>
            </div>
        </div>

        <!-- Trip Preferences -->
        <div class="mb-10">
            <h2 class="text-xl font-semibold mb-4 text-gray-900">Trip Preferences</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block mb-1 text-sm font-medium">Destination City</label>
                    <input type="text" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-black/30 focus:border-black/40" required />
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium">Preferred Travel Date</label>
                    <input type="date" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-black/30 focus:border-black/40" />
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium">Duration (days)</label>
                    <input type="number" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-black/30 focus:border-black/40" />
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium">Budget per Person (USD)</label>
                    <input type="number" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-black/30 focus:border-black/40" />
                </div>
            </div>
        </div>

        <!-- Experience Selection -->
        <div class="mb-10">
            <h2 class="text-xl font-semibold mb-4 text-gray-900">Experience Style</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <label class="border cursor-pointer group border-gray-300 rounded-2xl p-6 text-center hover:shadow-xl hover:bg-gray-50 transition-all">
                    <input type="checkbox" class="hidden peer" />
                    <div class="peer-checked:text-black peer-checked:font-semibold">Luxury Relaxation</div>
                </label>

                <label class="border cursor-pointer group border-gray-300 rounded-2xl p-6 text-center hover:shadow-xl hover:bg-gray-50 transition-all">
                    <input type="checkbox" class="hidden peer" />
                    <div class="peer-checked:text-black peer-checked:font-semibold">Adventure & Nature</div>
                </label>

                <label class="border cursor-pointer group border-gray-300 rounded-2xl p-6 text-center hover:shadow-xl hover:bg-gray-50 transition-all">
                    <input type="checkbox" class="hidden peer" />
                    <div class="peer-checked:text-black peer-checked:font-semibold">Cultural Experience</div>
                </label>
            </div>
        </div>

        <!-- Additional Notes -->
        <div class="mb-10">
            <label class="block mb-1 text-sm font-medium">Additional Requests or Notes</label>
            <textarea class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-black/30 focus:border-black/40" rows="5"></textarea>
        </div>

        <!-- Submit -->
        <button type="submit" class="w-full py-4 rounded-2xl bg-black text-white text-lg font-semibold hover:bg-gray-800 transition-all flex items-center justify-center" x-show="!loading && !submitted">
            Submit Custom Trip Request
        </button>

        <!-- Loading -->
        <div x-show="loading" class="w-full text-center py-4 text-gray-600 text-lg">Processing your request...</div>

        <!-- Success Message -->
        <div x-show="submitted" class="text-center py-6">
            <h3 class="text-2xl font-semibold text-gray-900">Your request has been submitted!</h3>
            <p class="text-gray-600 mt-2">Our team will contact you shortly with your custom-made itinerary.</p>
        </div>

    </form>

</section>
@endsection