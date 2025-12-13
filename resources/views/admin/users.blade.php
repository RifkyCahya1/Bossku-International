@extends('main', ['excludeNavbar' => true, 'excludeFooter' => true])

@section('content')

<div class="min-h-screen bg-[#0E0E10] relative overflow-hidden">

    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute w-[600px] h-[600px] bg-purple-600/20 rounded-full blur-[140px] -top-20 -left-20"></div>
        <div class="absolute w-[600px] h-[600px] bg-blue-500/20 rounded-full blur-[160px] bottom-0 right-0"></div>
    </div>

    @include('admin.Layout.topbar')

    <div class="flex max-w-7xl mx-auto mt-10 px-6 gap-8">

        @include('admin.Layout.sidebar')

        <main class="flex-1 text-white" x-data="userPage()">
            <div class=" flex items-center justify-between mb-6">
                <h2 class="text-3xl font-semibold">Manage Users</h2>

                @can('manage-users')
                <button @click="addUserOpen = true"
                    class="bg-purple-600 hover:bg-purple-700 px-5 py-3 rounded-xl font-semibold transition flex items-center gap-2">
                    <i class="fa-solid fa-user-plus"></i> Add User
                </button>
                @endcan

            </div>

            <div class="mb-6 flex items-center gap-4">

                <!-- Search -->
                <input
                    x-model="search"
                    type="text"
                    placeholder="Search name/email..."
                    class="px-4 py-2 bg-white/10 border border-white/20 rounded-xl text-white w-60" />

                <!-- Filter Role -->
                <select
                    x-model="filterRole"
                    class="px-8 py-2 bg-white/10 border border-white/20 rounded-xl text-white">
                    <option class="text-black" value="">All Roles</option>
                    <option class="text-black" value="admin">Admin</option>
                    <option class="text-black" value="superadmin">Superadmin</option>
                    <option class="text-black" value="user">User</option>
                </select>
            </div>

            <div class="backdrop-blur-xl bg-white/5 border border-white/10 rounded-2xl p-6">

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-gray-300 border-b border-white/10">
                            <th class="py-3">Name</th>
                            <th class="py-3">Email</th>
                            <th class="py-3">Role</th>
                            <th class="py-3 text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <template x-for="u in filteredUsers" :key="u.id">
                            <tr class="border-b border-white/5 text-gray-200">
                                <td class="py-4" x-text="u.name"></td>
                                <td x-text="u.email"></td>
                                <td class="capitalize" x-text="u.role"></td>

                                <td class="text-right">
                                    <button
                                        @click="editUser(u)"
                                        class="text-blue-400 hover:underline mr-4">
                                        Edit
                                    </button>

                                    <button
                                        @click="confirmDelete(u.id)"
                                        class="text-red-400 hover:underline">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </template>

                    </tbody>

                </table>
            </div>

            <!-- Modal -->
            <div
                x-show="openDeleteModal"
                x-cloak
                class="fixed inset-0 flex items-center justify-center bg-black/60 z-50">
                <div class="bg-gray-800 text-white w-full max-w-md rounded-xl p-6 shadow-lg">

                    <h2 class="text-lg font-semibold mb-3">Hapus User?</h2>
                    <p class="text-sm text-gray-300 mb-5">
                        Yakin Pengen dihapus? Data e ga iso balik lohh huehue
                    </p>

                    <div class="flex justify-end gap-3">

                        <button
                            @click="openDeleteModal = false"
                            class="px-4 py-2 rounded-lg bg-gray-600 hover:bg-gray-500">
                            Batal
                        </button>

                        <form x-bind:action="'{{ url('/admin/users/delete') }}/' + deleteId" method="POST">
                            @csrf
                            @method('DELETE')

                            <button class="px-4 py-2 bg-red-600 rounded-lg hover:bg-red-700">
                                Hapus
                            </button>
                        </form>


                    </div>
                </div>
            </div>

            <div x-show="addUserOpen"
                class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50">

                <div class="bg-[#1A1A1D] rounded-2xl p-8 w-full max-w-lg border border-white/10"
                    @click.away="addUserOpen = false">

                    <h3 class="text-2xl font-semibold mb-4">Add New User</h3>

                    <form action="{{ route('admin.user.store') }}" method="POST" class="space-y-5">
                        @csrf

                        <div>
                            <label class="block mb-1 text-gray-300">Name</label>
                            <input type="text" name="name" required
                                class="w-full bg-white/10 border border-white/20 rounded-xl p-3 text-white">
                        </div>

                        <div>
                            <label class="block mb-1 text-gray-300">Email</label>
                            <input type="email" name="email" required
                                class="w-full bg-white/10 border border-white/20 rounded-xl p-3 text-white">
                        </div>

                        <div>
                            <label class="block mb-1 text-gray-300">Password</label>
                            <input type="password" name="password" required
                                class="w-full bg-white/10 border border-white/20 rounded-xl p-3 text-white">
                        </div>

                        <div>
                            <label class="block mb-1 text-gray-300">Role</label>
                            <select name="role"
                                class="w-full bg-white/10 border border-white/20 rounded-xl p-3 text-white">
                                <option class="text-black" value="admin">Admin</option>
                                <option class="text-black" value="superadmin">Superadmin</option>
                            </select>
                        </div>

                        <div class="flex justify-end mt-6">
                            <button type="button" @click="addUserOpen = false"
                                class="px-5 py-2 rounded-xl bg-white/10 text-gray-300 hover:bg-white/20 mr-3">
                                Cancel
                            </button>

                            <button class="px-6 py-2 bg-purple-600 rounded-xl hover:bg-purple-700">
                                Add User
                            </button>
                        </div>
                    </form>

                </div>
            </div>

            <div x-show="editUserOpen"
                class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50">

                <div class="bg-[#1A1A1D] rounded-2xl p-8 w-full max-w-lg border border-white/10">

                    <h3 class="text-2xl font-semibold mb-4">Edit User</h3>

                    <form :action="'/admin/users/update/' + editData.id" method="POST" class="space-y-5">
                        @csrf

                        <div>
                            <label class="block mb-1 text-gray-300">Name</label>
                            <input type="text" name="name" x-model="editData.name"
                                class="w-full bg-white/10 border border-white/20 rounded-xl p-3 text-white">
                        </div>

                        <div>
                            <label class="block mb-1 text-gray-300">Email</label>
                            <input type="email" name="email" x-model="editData.email"
                                class="w-full bg-white/10 border border-white/20 rounded-xl p-3 text-white">
                        </div>

                        <div>
                            <label class="block mb-1 text-gray-300">Role</label>
                            <select name="role" x-model="editData.role"
                                class="w-full bg-white/10 border border-white/20 rounded-xl p-3 text-white">
                                <option class="text-black" value="user">User</option>
                                <option class="text-black" value="admin">Admin</option>
                                <option class="text-black" value="superadmin">Superadmin</option>
                            </select>
                        </div>

                        <div class="flex justify-end mt-6">
                            <button type="button" @click="editUserOpen = false"
                                class="px-5 py-2 rounded-xl bg-white/10 text-gray-300 hover:bg-white/20 mr-3">
                                Cancel
                            </button>

                            <button class="px-6 py-2 bg-blue-600 rounded-xl hover:bg-blue-700">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Notification -->
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
                    <i class="fa-solid fa-circle-check text-green-400 text-xl"></i>
                    <span x-text="notification.message"></span>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    function userPage() {
        return {
            search: '',
            filterRole: '',
            users: JSON.parse(`@json($users)`),

            addUserOpen: false,
            editUserOpen: false,
            openDeleteModal: false,

            deleteId: null,

            editData: {
                id: null,
                name: '',
                email: '',
                role: '',
            },

            notification: {
                show: false,
                message: '',
            },

            get filteredUsers() {
                let s = this.search.toLowerCase();

                return this.users.filter(u => {
                    let matchSearch =
                        u.name.toLowerCase().includes(s) ||
                        u.email.toLowerCase().includes(s);

                    let matchRole =
                        this.filterRole === '' || u.role === this.filterRole;

                    return matchSearch && matchRole;
                });
            },

            editUser(user) {
                this.editData = {
                    ...user
                };
                this.editUserOpen = true;
            },

            confirmDelete(id) {
                this.deleteId = id;
                this.openDeleteModal = true;
            },

            showNotification(msg) {
                this.notification.message = msg;
                this.notification.show = true;

                setTimeout(() => {
                    this.notification.show = false;
                }, 2500);
            }
        }
    }
</script>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('notify', {
            msg: null
        });
    });
</script>

@if(session('success'))
<script>
    document.addEventListener("alpine:init", () => {
        const msg = "{{ session('success') }}";
        const main = document.querySelector("main");

        if (main && main._x_dataStack) {
            main._x_dataStack[0].showNotification(msg);
        }
    });
</script>
@endif


@endsection