<x-layouts.admin title="Audit Trail Logs | Modern Jewellery House">
    <div class="flex items-center justify-between pb-2 border-b border-slate-200">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Administrative Activity Logs</h1>
            <p class="text-xs text-slate-500 mt-1">Immutable security audit record tracking product changes, stock adjustments, and refunds.</p>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-200">
            <form action="{{ route('admin.activity-logs.index') }}" method="GET" class="flex gap-3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by action, user name, IP..." 
                       class="flex-1 bg-slate-50 border border-slate-300 rounded-lg px-3 py-2 text-xs text-slate-900 focus:outline-none">
                <button type="submit" class="px-4 py-2 bg-slate-900 text-white rounded-lg text-xs font-semibold">Search</button>
            </form>
        </div>

        <table class="w-full text-left text-xs">
            <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider font-semibold border-b border-slate-200">
                <tr>
                    <th class="py-3 px-4">Timestamp</th>
                    <th class="py-3 px-4">Administrator</th>
                    <th class="py-3 px-4">Action Summary</th>
                    <th class="py-3 px-4">Target Entity</th>
                    <th class="py-3 px-4">IP Address</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 font-medium">
                @forelse($logs as $log)
                    <tr class="hover:bg-slate-50/70">
                        <td class="py-3 px-4 font-mono text-[11px] text-slate-500 whitespace-nowrap">
                            {{ $log->created_at->format('M d, Y h:i A') }}
                        </td>
                        <td class="py-3 px-4 font-bold text-slate-900">
                            {{ $log->user->name ?? 'System' }}
                        </td>
                        <td class="py-3 px-4 text-slate-800">
                            {{ $log->action }}
                        </td>
                        <td class="py-3 px-4 font-mono text-[11px] text-slate-500">
                            {{ class_basename($log->entity_type) ?: '—' }} {{ $log->entity_id ? '#' . $log->entity_id : '' }}
                        </td>
                        <td class="py-3 px-4 font-mono text-[11px] text-slate-600">
                            {{ $log->ip_address }}
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="py-12 text-center text-slate-400">No activity logs recorded.</td></tr>
                @endforelse
            </tbody>
        </table>

        @if($logs->hasPages())
            <div class="p-4 border-t border-slate-200">
                {{ $logs->links() }}
            </div>
        @endif
    </div>
</x-layouts.admin>