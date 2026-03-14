<x-app-layout>
    <div class="max-w-2xl mx-auto px-4 py-12">
        <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-slate-900 leading-tight">Lengkapi Profil Anda</h2>
                <p class="mt-2 text-slate-600">Satu langkah lagi! Silakan lengkapi data profil Anda untuk dapat memulai psikotest.</p>
            </div>

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4 rounded-r-lg">
                    <ul class="list-disc list-inside text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nisn" class="block text-sm font-semibold text-slate-700">NISN</label>
                        <input id="nisn" name="nisn" type="text" required value="{{ old('nisn', $user->nisn) }}"
                            class="mt-1 block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150">
                    </div>

                    <div>
                        <label for="current_school" class="block text-sm font-semibold text-slate-700">Nama Sekolah Saat Ini</label>
                        <input id="current_school" name="current_school" type="text" required value="{{ old('current_school', $user->current_school) }}"
                            class="mt-1 block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150">
                    </div>

                    <div>
                        <label for="pob" class="block text-sm font-semibold text-slate-700">Tempat Lahir</label>
                        <input id="pob" name="pob" type="text" required value="{{ old('pob', $user->pob) }}"
                            class="mt-1 block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150">
                    </div>

                    <div>
                        <label for="dob" class="block text-sm font-semibold text-slate-700">Tanggal Lahir</label>
                        <input id="dob" name="dob" type="date" required value="{{ old('dob', $user->dob) }}"
                            class="mt-1 block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150">
                    </div>
                </div>

                <div>
                    <label for="address" class="block text-sm font-semibold text-slate-700">Alamat Rumah</label>
                    <textarea id="address" name="address" rows="3" required
                        class="mt-1 block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150">{{ old('address', $user->address) }}</textarea>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full flex justify-center py-4 px-4 border border-transparent text-sm font-bold rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 uppercase tracking-widest shadow-lg shadow-blue-200">
                        Simpan & Mulai Tes
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
