<div x-data="{ showAddModal: false, editUser: null }">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-semibold text-white dark:text-gray-800">Account Management</h2>

        @if (auth()->user()->role === 'superadmin')
        <button
            @click="showAddModal = true"
            class="px-4 py-2 text-sm rounded-lg bg-gradient-to-r from-[#bfa46f] to-[#a38c58] text-white hover:opacity-90 transition">
            + Tambah Akun
        </button>
        @endif
    </div>

    <!-- Tabel User -->
    <div class="overflow-x-auto rounded-lg shadow bg-white dark:bg-gray-800">
        <table class="min-w-full text-sm text-gray-700 dark:text-gray-200">
            <thead class="bg-gray-200 dark:bg-gray-700">
                <tr>
                    <th class="p-3 text-left">Nama</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Role</th>
                    <th class="p-3 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $u)
                <tr class="border-b dark:border-gray-700">
                    <td class="p-3">{{ $u->name }}</td>
                    <td class="p-3">{{ $u->email }}</td>
                    <td class="p-3 capitalize">{{ $u->role }}</td>
                    <td class="p-3 flex gap-2">

                        <!-- Hanya superadmin yang boleh edit & delete -->
                        @if (auth()->user()->role === 'superadmin')
                        <button
                            @click="editUser = {{ $u }};"
                            class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-xs">
                            Edit
                        </button>

                        <form method="POST" action="{{ route('account.destroy', $u->id) }}"
                            onsubmit="return confirm('Yakin hapus akun ini?')">
                            @csrf
                            @method('DELETE')
                            <button
                                class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-xs">
                                Hapus
                            </button>
                        </form>
                        @endif

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah -->
    <div
        x-show="showAddModal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">

        <div class="bg-white dark:bg-gray-900 p-6 rounded-lg w-full max-w-lg">
            <h3 class="text-lg font-semibold mb-4">Tambah Akun</h3>

            <form method="POST" action="{{ route('account.store') }}" class="space-y-4">
                @csrf

                <input type="text" name="name" placeholder="Nama" class="input-text">
                <input type="email" name="email" placeholder="Email" class="input-text">

                <select name="role" class="input-text">
                    <option value="admin">Admin</option>
                    <option value="superadmin">Superadmin</option>
                </select>

                <input type="password" name="password" placeholder="Password" class="input-text">

                <div class="flex justify-end gap-3">
                    <button @click="showAddModal = false"
                        type="button"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded">
                        Batal
                    </button>

                    <button class="px-4 py-2 bg-green-600 text-white rounded">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <template x-if="editUser">
        <div
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">

            <div class="bg-white dark:bg-gray-900 p-6 rounded-lg w-full max-w-lg">
                <h3 class="text-lg font-semibold mb-4">Edit Akun</h3>

                <form :action="`/admin/account/update/` + editUser.id" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <input type="text" name="name" class="input-text" :value="editUser.name">
                    <input type="email" name="email" class="input-text" :value="editUser.email">

                    <select name="role" class="input-text">
                        <option value="admin" :selected="editUser.role === 'admin'">Admin</option>
                        <option value="superadmin" :selected="editUser.role === 'superadmin'">Superadmin</option>
                    </select>

                    <input type="password" name="password" class="input-text" placeholder="Kosongkan jika tidak diganti">

                    <div class="flex justify-end gap-3">
                        <button @click="editUser = null"
                            type="button"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded">
                            Batal
                        </button>

                        <button class="px-4 py-2 bg-blue-600 text-white rounded">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </template>

</div>

<style>
    .input-text {
        @apply w-full px-3 py-2 border rounded outline-none dark:bg-gray-800 dark:border-gray-700;
    }
</style>