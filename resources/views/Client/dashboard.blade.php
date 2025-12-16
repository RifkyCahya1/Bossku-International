@extends('main', ['excludeNavbar' => true])
@include('layout.navbarserv')

@section('content')
<div class="relative overflow-hidden bg-gradient-to-br from-neutral-50 via-white to-neutral-100 py-12">
 
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-40 -left-40 w-[520px] h-[520px] bg-indigo-300/30 blur-[160px]"></div>
        <div class="absolute top-1/3 -right-40 w-[520px] h-[520px] bg-amber-300/30 blur-[160px]"></div>
    </div>
 
    <div class="relative max-w-7xl mx-auto px-6 py-14">
        <h1 class="text-3xl md:text-4xl font-semibold tracking-tight text-neutral-900">Welcome back, {{ auth()->user()->name }}</h1>
        <p class="mt-2 text-neutral-500">Here’s a quick overview of your account & activity.</p>
    </div>
 
    <div class="max-w-7xl mx-auto px-6 -mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="rounded-2xl bg-white border border-neutral-200 shadow-sm p-6">
            <p class="text-sm text-neutral-500">Total Bookings</p>
            <p class="mt-2 text-3xl font-semibold text-neutral-900">12</p>
        </div>
        <div class="rounded-2xl bg-white border border-neutral-200 shadow-sm p-6">
            <p class="text-sm text-neutral-500">Upcoming Trips</p>
            <p class="mt-2 text-3xl font-semibold text-neutral-900">3</p>
        </div>
        <div class="rounded-2xl bg-white border border-neutral-200 shadow-sm p-6">
            <p class="text-sm text-neutral-500">Total Spent</p>
            <p class="mt-2 text-3xl font-semibold text-neutral-900">$2,450</p>
        </div>
    </div>
 
    <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 lg:grid-cols-3 gap-8">
   
        <div class="lg:col-span-2 rounded-2xl bg-white border border-neutral-200 shadow-sm p-6">
            <h2 class="text-xl font-semibold text-neutral-900 mb-6">Recent Bookings</h2>

            <div class="space-y-4">
                <div class="flex items-center justify-between rounded-xl bg-neutral-50 border border-neutral-200 p-4">
                    <div>
                        <p class="font-medium text-neutral-900">Japan Autumn Tour</p>
                        <p class="text-sm text-neutral-500">Departure: 12 Oct 2026</p>
                    </div>
                    <span class="text-sm px-3 py-1 rounded-full bg-emerald-100 text-emerald-600">Confirmed</span>
                </div>

                <div class="flex items-center justify-between rounded-xl bg-neutral-50 border border-neutral-200 p-4">
                    <div>
                        <p class="font-medium text-neutral-900">Bali Luxury Escape</p>
                        <p class="text-sm text-neutral-500">Departure: 3 Aug 2026</p>
                    </div>
                    <span class="text-sm px-3 py-1 rounded-full bg-amber-100 text-amber-600">Pending</span>
                </div>
            </div>
        </div>
 
        <div class="rounded-2xl bg-white border border-neutral-200 shadow-sm p-6">
            <h2 class="text-xl font-semibold text-neutral-900 mb-6">Profile</h2>

            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-gradient-to-br from-indigo-500 to-amber-400 flex items-center justify-center text-white font-semibold">
                    {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                </div>
                <div>
                    <p class="font-medium text-neutral-900">{{ auth()->user()->name }}</p>
                    <p class="text-sm text-neutral-500">{{ auth()->user()->email }}</p>
                </div>
            </div>

            <div class="mt-6 space-y-3">
                <a href="/Profile" class="block w-full text-center rounded-xl border border-neutral-300 py-3 text-sm hover:bg-neutral-100 transition">Edit Profile</a>
                <form method="POST" action="/logout">
                    @csrf
                    <button
                        class="block w-full text-center rounded-xl bg-gradient-to-r from-amber-400 to-amber-300 text-neutral-900 py-3 text-sm font-semibold">
                        Logout Account
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection