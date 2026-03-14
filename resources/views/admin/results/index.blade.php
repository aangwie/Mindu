<x-admin-layout>
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-slate-900">Hasil Psikotest</h2>
        <p class="text-slate-600 font-medium">Pantau semua rekomendasi karir siswa.</p>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-xl flex items-center shadow-sm">
            <div class="shrink-0 text-emerald-500 mr-3">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
            </div>
            <p class="text-sm font-bold text-emerald-800">{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Siswa</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest text-center">R-I-A-S-E-C</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Rekomendasi</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @if(count($results) > 0)
                        @foreach($results as $result)
                            <tr class="hover:bg-slate-50/50 transition duration-150">
                                <td class="px-6 py-4">
                                    <div>
                                        <p class="text-sm font-bold text-slate-900">{{ $result->testSession->user->full_name }}</p>
                                        <p class="text-xs text-slate-500">{{ $result->testSession->completed_at ? $result->testSession->completed_at->format('d M Y, H:i') : '-' }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center space-x-1">
                                        <span class="text-[10px] font-bold px-1.5 py-0.5 bg-red-100 text-red-700 rounded" title="Realistic">{{ $result->score_r }}</span>
                                        <span class="text-[10px] font-bold px-1.5 py-0.5 bg-blue-100 text-blue-700 rounded" title="Investigative">{{ $result->score_i }}</span>
                                        <span class="text-[10px] font-bold px-1.5 py-0.5 bg-purple-100 text-purple-700 rounded" title="Artistic">{{ $result->score_a }}</span>
                                        <span class="text-[10px] font-bold px-1.5 py-0.5 bg-green-100 text-green-700 rounded" title="Social">{{ $result->score_s }}</span>
                                        <span class="text-[10px] font-bold px-1.5 py-0.5 bg-yellow-100 text-yellow-700 rounded" title="Enterprising">{{ $result->score_e }}</span>
                                        <span class="text-[10px] font-bold px-1.5 py-0.5 bg-slate-100 text-slate-700 rounded" title="Conventional">{{ $result->score_c }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-indigo-100 text-indigo-700">
                                        {{ $result->recommendation }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center items-center space-x-3">
                                        <a href="{{ route('student.result', $result) }}" class="text-blue-600 hover:text-blue-900 transition p-2 hover:bg-blue-50 rounded-lg" title="Lihat">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </a>
                                        <a href="{{ route('download-result', $result) }}" class="text-slate-600 hover:text-slate-900 transition p-2 hover:bg-slate-50 rounded-lg" title="Download PDF">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        </a>
                                        <form action="{{ route('admin.results.destroy', $result) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus hasil tes ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 transition p-2 hover:bg-red-50 rounded-lg" title="Hapus">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-slate-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    <p class="text-slate-500 font-medium">Belum ada hasil tes yang tercatat.</p>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        @if($results->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                {{ $results->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
