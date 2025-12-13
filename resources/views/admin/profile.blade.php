@extends('main', ['excludeNavbar' => true, 'excludeFooter' => true])

@section('content')
<div class="min-h-screen bg-[#0E0E10] relative overflow-hidden">

    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute w-[600px] h-[600px] bg-purple-600/20 rounded-full blur-[140px] -top-20 -left-20"></div>
        <div class="absolute w-[600px] h-[600px] bg-blue-500/20 rounded-full blur-[160px] bottom-0 right-0"></div>
    </div>

    @include('admin.Layout.topbar')

    <div
        class="my-10 px-6"
        x-data="toastHandler()"
        x-init="
        if ($el.dataset.success) showNotif($el.dataset.success, 'success');
        if ($el.dataset.error) showNotif($el.dataset.error, 'error');
        "
        data-success="{{ session('success') }}"
        data-error="{{ session('error') }}">



        <div
            x-show="notification.show"
            x-transition:enter="transform transition ease-out duration-300"
            x-transition:enter-start="translate-y-3 opacity-0"
            x-transition:enter-end="translate-y-0 opacity-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed top-6 right-6 bg-[#1F1F22] border border-white/10 text-white px-5 py-3 rounded-xl shadow-lg z-[999]"
            x-cloak>

            <div class="flex items-center gap-3">
                <i :class="`fa-solid ${notification.icon} ${notification.color} text-xl`"></i>
                <span x-text="notification.message"></span>
            </div>
        </div>

        <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl py-8 px-4 md:p-8 shadow-2xl">
            <a href="javascript:history.back()" class="inline-flex items-center gap-2 text-gray-300 text-sm md:text-base leading-relaxed mb-10">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="w-6 h-6">
                    <path strokeLinecap="round" strokeLinejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                </svg>
                <span>Back</span>
            </a>

            <div class="flex items-center gap-6 mb-8">
                <div class="md:w-24 md:h-24 rounded-full overflow-hidden border border-white/30">
                    <img src="https://ui-avatars.com/api/?rounded=true&name={{ auth()->user()->name }}" alt="" class="w-full h-full object-cover">
                </div>

                <div>
                    <h2 class="text-lg md:text-2xl font-semibold text-white">{{ auth()->user()->name }}</h2>
                    <p class="text-gray-300 text-xs md:text-sm">{{ auth()->user()->email }}</p>
                    <span class="text-xs bg-white/20 px-3 py-1 rounded-full mt-2 inline-block">
                        Administrator
                    </span>
                </div>
            </div>

            <hr class="border-white/20 my-6">

            {{-- Update Profile Form --}}
            <h3 class="text-xl font-semibold mb-4 text-white">Update Profile</h3>

            <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="text-sm text-gray-300">Name</label>
                    <input type="text" name="name" value="{{ auth()->user()->name }}"
                        class="w-full mt-1 px-4 py-3 rounded-xl bg-white/10 border border-white/20
                           text-white placeholder-gray-300 focus:ring-2 focus:ring-[#bfa46f] outline-none">
                </div>

                <div>
                    <label class="text-sm text-gray-300">Email</label>
                    <input type="email" name="email" value="{{ auth()->user()->email }}"
                        class="w-full mt-1 px-4 py-3 rounded-xl bg-white/10 border border-white/20
                           text-white placeholder-gray-300 focus:ring-2 focus:ring-[#bfa46f] outline-none">
                </div>

                <button type="submit"
                    class="w-full py-3 rounded-xl bg-gradient-to-r from-[#bfa46f] to-[#a38c58]
                       hover:opacity-90 transition font-semibold text-white tracking-wider cursor-pointer">
                    Update Profile
                </button>
            </form>

            <hr class="border-white/20 my-8">

            <h3 class="text-xl font-semibold mb-4 text-white">Change Password</h3>

            <form action="{{ route('admin.profile.password') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="text-sm text-gray-300">Current Password</label>
                    <input type="password" name="current_password"
                        class="w-full mt-1 px-4 py-3 rounded-xl bg-white/10 border border-white/20
                           text-white placeholder-gray-300 focus:ring-2 focus:ring-[#bfa46f] outline-none">
                </div>

                <div>
                    <label class="text-sm text-gray-300">New Password</label>
                    <input type="password" name="password"
                        class="w-full mt-1 px-4 py-3 rounded-xl bg-white/10 border border-white/20
                           text-white placeholder-gray-300 focus:ring-2 focus:ring-[#bfa46f] outline-none">
                </div>

                <div>
                    <label class="text-sm text-gray-300">Confirmation Password</label>
                    <input type="password" name="password_confirmation" class="w-full mt-1 px-4 py-3 rounded-xl bg-white/10 border border-white/20
                           text-white placeholder-gray-300 focus:ring-2 focus:ring-[#bfa46f] outline-none">

                </div>

                <button type="submit"
                    class="w-full py-3 rounded-xl bg-gradient-to-r from-red-500 to-red-600
                       hover:opacity-90 transition font-semibold text-white tracking-wider cursor-pointer">
                    Change Password
                </button>

            </form>

            <hr class="border-white/20 my-8">

            <h3 class="text-xl font-semibold mb-4 text-red-400">Delete Account</h3>

            <button
                @click="deleteOpen = true"
                class="w-full py-3 rounded-xl bg-gradient-to-r from-red-600 to-red-700 hover:opacity-90 transition font-semibold text-white tracking-wider cursor-pointer">
                Delete My Account
            </button>

            {{-- DELETE ACCOUNT MODAL --}}
            <div x-show="deleteOpen" class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50">
                <div class="bg-gray-800 border border-white/20 rounded-2xl p-8 w-full max-w-md text-white relative" @click.outside="deleteOpen = false">
                    <h2 class="text-xl font-semibold mb-4 text-red-400">Confirm Delete</h2>
                    <p class="text-gray-300 text-sm mb-6">
                        Masukno Password pelan-pelan, <br>
                        Awakmu yakin arep nerusno tindakan? <br>
                        Yen bener diapus yo wes pamitan, <br>
                        Datamu hilang selawase… ra iso balikan 😬 <br><br>
                        -AI, 2025<br>
                        Mahkotamu masih di DC Cakung, King
                    </p>

                    <form action="{{ route('admin.profile.delete') }}" method="POST" class="space-y-4">
                        @csrf
                        @method('DELETE')

                        <div>
                            <label class="text-sm text-gray-300">Password</label>
                            <input
                                type="password"
                                name="password"
                                class="w-full mt-1 px-4 py-3 rounded-xl bg-white/10 border border-red-400/40
                               text-white placeholder-gray-300 focus:ring-2 focus:ring-red-500 outline-none">
                        </div>

                        <div class="flex gap-3 mt-6">
                            <button
                                type="button"
                                @click="deleteOpen = false"
                                class="flex-1 py-3 rounded-xl bg-gray-600/40 hover:bg-gray-600/60 transition">
                                Cancel
                            </button>

                            <button
                                type="submit"
                                class="flex-1 py-3 rounded-xl bg-red-600 hover:bg-red-700 transition font-semibold">
                                Delete
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('toastHandler', () => ({
            deleteOpen: false,

            notification: {
                show: false,
                message: '',
                icon: '',
                color: ''
            },

            showNotif(message, type = 'success') {
                this.notification.message = message;
                this.notification.show = true;

                if (type === 'success') {
                    this.notification.icon = 'fa-circle-check';
                    this.notification.color = 'text-green-400';
                } else {
                    this.notification.icon = 'fa-circle-xmark';
                    this.notification.color = 'text-red-400';
                }

                setTimeout(() => {
                    this.notification.show = false;
                }, 3000);
            }
        }))
    })
</script>

@endsection