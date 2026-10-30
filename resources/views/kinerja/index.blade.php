<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            {{ auth()->user()->isAdmin() ? 'Rekap Progres Kinerja Pegawai' : 'Progres & Riwayat Kinerja Saya' }}
        </h2>
    </x-slot>

    <form class="mb-5 flex gap-2" method="GET">
        @if (auth()->user()->isAdmin())
            <select class="rounded border" name="user_id">
                <option value="">Semua Pegawai</option>
                @foreach ($users as $u)
                    <option value="{{ $u->id }}" @selected(request('user_id') == $u->id)>{{ $u->name }}</option>
                @endforeach
            </select>
        @endif

        <input class="rounded border" name="periode_bulan" value="{{ $bulan }}">
        <input class="rounded border" name="periode_tahun" value="{{ $tahun }}">
        <button class="rounded bg-slate-700 px-3 text-white">Filter</button>
    </form>

    <form class="mb-5 grid gap-3 rounded bg-white p-4 shadow md:grid-cols-6" method="POST">
        @csrf

        @if (auth()->user()->isAdmin())
            <select class="rounded border" name="user_id" required>
                <option value="">Pegawai</option>
                @foreach ($users as $u)
                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                @endforeach
            </select>
        @else
            <p class="py-2 text-sm text-slate-600">Tambahkan progres untuk akun Anda sendiri.</p>
        @endif

        <select class="rounded border" name="kecakapan_id">
            @foreach ($kecakapans as $k)
                <option value="{{ $k->id }}">{{ $k->nama_kecakapan }}</option>
            @endforeach
        </select>
        <input class="rounded border" name="nilai" type="number" min="0" max="100" placeholder="Progres 0-100" required>
        <input type="hidden" name="periode_bulan" value="{{ $bulan }}">
        <input type="hidden" name="periode_tahun" value="{{ $tahun }}">
        <button class="rounded bg-sky-700 px-3 text-white">
            {{ auth()->user()->isAdmin() ? 'Simpan Nilai' : 'Simpan Progres' }}
        </button>
    </form>

    <div class="grid gap-4 md:grid-cols-3">
        @forelse ($nilai as $n)
            <div class="rounded bg-white p-4 shadow">
                <p class="font-semibold">{{ $n->kecakapan->nama_kecakapan }}</p>
                @if (auth()->user()->isAdmin())
                    <small>{{ $n->user->name }}</small>
                @endif
                <p class="mt-3 text-3xl text-sky-700">{{ $n->nilai }}%</p>
                <p class="text-sm text-slate-500">Bobot: {{ $n->kecakapan->bobot_nilai }}%</p>
            </div>
        @empty
            <p>Belum ada progres pada periode ini.</p>
        @endforelse
    </div>
</x-app-layout>
