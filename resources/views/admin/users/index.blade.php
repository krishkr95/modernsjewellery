<x-layouts.admin title="Admin Users | Modern Jewellery House">
    <div class="flex items-center justify-between pb-2 border-b border-slate-200">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Administrative Staff & Access</h1>
            <p class="text-xs text-slate-500 mt-1">Manage executive accounts, staff permissions, and role delegations.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Create Admin Form -->
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm space-y-4 text-xs">
            <h3 class="font-bold text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-2">Add Admin / Staff</h3>
            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-3">
                @csrf
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Full Name *</label>
                    <input type="text" name="name" required placeholder="e.g. Marcus Thorne" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Email *</label>
                    <input type="email" name="email" required placeholder="m.thorne@modernjewelleryhouse.com" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Password *</label>
                    <input type="password" name="password" required minlength="8" placeholder="••••••••" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs font-mono">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Role Permission *</label>
                    <select name="role_id" required class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs font-semibold">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="w-full py-2.5 bg-slate-900 text-white rounded font-bold uppercase tracking-wider text-xs">
                    Create Account
                </button>
            </form>
        </div>

        <!-- Users Table -->
        <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider font-semibold border-b border-slate-200">
                    <tr>
                        <th class="py-3 px-4">User</th>
                        <th class="py-3 px-4">Role Badge</th>
                        <th class="py-3 px-4">Last Activity</th>
                        <th class="py-3 px-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @forelse($users as $usr)
                        <tr class="hover:bg-slate-50/70">
                            <td class="py-3 px-4">
                                <span class="font-bold text-slate-900 block">{{ $usr->name }}</span>
                                <span class="text-[11px] text-slate-400 font-mono">{{ $usr->email }}</span>
                            </td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider 
                                    {{ $usr->role?->name === 'SUPER_ADMIN' ? 'bg-amber-100 text-amber-800' : 'bg-slate-100 text-slate-700' }}">
                                    {{ $usr->role?->name ?? 'STAFF' }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-slate-500 text-[11px]">
                                {{ $usr->last_login_at ? $usr->last_login_at->diffForHumans() : 'Active session' }}
                            </td>
                            <td class="py-3 px-4 text-right">
                                @if($usr->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $usr) }}" method="POST" class="inline" onsubmit="return confirm('Revoke user access?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-600 font-semibold hover:underline">Revoke</button>
                                    </form>
                                @else
                                    <span class="text-[10px] text-slate-400 font-mono italic">Current Session</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="py-8 text-center text-slate-400">No users found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.admin>