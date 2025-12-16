@extends('main', ['excludeNavbar' => true])
@include('layout.navbarserv')

@section('content')
<section class="min-h-screen bg-gradient-to-br from-neutral-50 via-white to-neutral-100 py-16 mt-10">
    <div class="max-w-4xl mx-auto px-6">

        <div class="flex items-center gap-6 mb-10">
            <img
                src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=0D2B45&color=fff&size=256"
                class="w-24 h-24 rounded-full shadow-md ring-4 ring-white"
                alt="Avatar">

            <div>
                <h1 class="text-2xl font-semibold text-neutral-800">
                    {{ auth()->user()->name }}
                </h1>
                <p class="text-neutral-500 text-sm">
                    {{ auth()->user()->email }}
                </p>
            </div>
        </div>

        <div x-data="{ edit: false }"
            class="bg-white rounded-xl shadow-lg border border-neutral-200 overflow-hidden">

            <div class="flex items-center justify-between px-8 py-5 border-b">
                <h2 class="text-lg font-medium text-neutral-800">
                    Profile Information
                </h2>

                <button @click="edit = !edit"
                    class="text-sm font-medium text-[#02335B] hover:underline">
                    <span x-show="!edit">Edit</span>
                    <span x-show="edit">Cancel</span>
                </button>
            </div>

            <div x-show="!edit" class="px-8 py-6 space-y-6">
                <div>
                    <p class="text-xs text-neutral-500">Full Name</p>
                    <p class="text-neutral-800 font-medium">
                        {{ auth()->user()->name }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-neutral-500">Email Address</p>
                    <p class="text-neutral-800 font-medium">
                        {{ auth()->user()->email }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-neutral-500">Joined At</p>
                    <p class="text-neutral-800 font-medium">
                        {{ auth()->user()->created_at->format('d F Y') }}
                    </p>
                </div>
            </div>

            <form x-show="edit" method="POST" action="/profile/update"
                class="px-8 py-6 space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs text-neutral-500 mb-1">
                        Full Name
                    </label>
                    <input type="text" name="name"
                        value="{{ auth()->user()->name }}"
                        class="w-full rounded-md border-neutral-300 focus:border-[#02335B] focus:ring-[#02335B] text-sm">
                </div>

                <div>
                    <label class="block text-xs text-neutral-500 mb-1">
                        Email Address
                    </label>
                    <input type="email" name="email"
                        value="{{ auth()->user()->email }}"
                        class="w-full rounded-md border-neutral-300 focus:border-[#02335B] focus:ring-[#02335B] text-sm">
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" @click="edit = false"
                        class="px-5 py-2 text-sm border rounded-md hover:bg-neutral-100">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-5 py-2 text-sm text-white rounded-md bg-[#02335B] hover:opacity-90">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-10 text-right">
            <form method="POST" action="/logout">
                @csrf
                <button
                    class="text-sm font-semibold text-white px-4 py-2 bg-red-600 rounded-sm hover:shadow-lg hover:bg-transparent hover:text-red-600 hover:underline">
                    Logout Account
                </button>
            </form>
        </div>

    </div>
</section>
@endsection