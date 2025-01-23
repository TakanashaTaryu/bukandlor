{{-- resources/views/CaAs/ChooseShift.blade.php --}}
{{-- Halaman di mana CAAS bisa memilih shift (jika belum pernah pilih) --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Shift</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-Shift bg-cover bg-center bg-no-repeat max-w-full min-h-screen overflow-hidden">
    @if(session('error'))
    <div class="bg-red-500 text-white p-3 mb-2 rounded">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="bg-green-500 text-white p-3 mb-2 rounded">
        {{ session('success') }}
    </div>
@endif

    {{-- Background layer hitam semi-transparan --}}
    <div class="absolute flex flex-col items-center justify-center bg-BlackLayer w-full h-full z-30 font-im-fell-english overflow-hidden">

        {{-- Judul --}}
        <div class="inset-0 text-white text-center mt-12">
            <h2 class="font-crimson-text text-lg lg:text-xl md:text-xl pb-1 font-bold">
                Discover the light within
            </h2>
            <h1 class="text-2xl md:text-3xl lg:text-3xl">
                Choose Your Shift
            </h1>
        </div>

        {{-- Container tabel --}}
        <div class="bg-Table mx-auto my-5 w-[95%] h-full rounded-2xl text-shift text-xs lg:text-xl md:text-xl">
            <div class="flex m-5 justify-between h-5 lg:h-8 md:h-8">
                {{-- Show Entries (opsional, jika mau simple pagination) --}}
                <div class="flex space-x-2 items-center">
                    <p>Show</p>
                    <div class="w-12 h-full text-center bg-white border-black border-[1px] rounded-full">
                        <p>10</p>
                    </div>
                    <p>Entries</p>
                </div>
                {{-- Search box (opsional) --}}
                <input
                    type="text"
                    id="shift"
                    class="w-36 lg:w-60 md:w-60 h-full px-4 bg-white border-black border-[1px] rounded-full"
                    placeholder="Search..."
                >
            </div>

            {{-- Tabel Shift --}}
            <div class="flex m-5 bg-white text-center">
                <table class="table-auto border-black border-[1px] w-full border-spacing-0">
                    <thead>
                        <tr class="h-10 lg:h-12 md:h-12">
                            <th class="border-[1px] border-black">No</th>
                            <th class="border-[1px] border-black">Shift</th>
                            <th class="border-[1px] border-black">Date</th>
                            <th class="border-[1px] border-black">Time</th>
                            <th class="border-[1px] border-black">Quota</th>
                            <th class="border-[1px] border-black">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Looping data $shifts dari controller --}}
                        @forelse($shifts as $index => $shift)
                            <tr class="h-10 lg:h-14 md:h-14">
                                <td class="border-[1px] border-black">
                                    {{ $index + 1 }}.
                                </td>
                                <td class="border-[1px] border-black">
                                    {{ $shift->shift_no }}
                                </td>
                                <td class="border-[1px] border-black">
                                    {{-- Format tanggal sesuai keperluan --}}
                                    {{ \Carbon\Carbon::parse($shift->date)->format('d/m/Y') }}
                                </td>
                                <td class="border-[1px] border-black">
                                    {{ substr($shift->time_start,0,5) }} - {{ substr($shift->time_end,0,5) }}
                                </td>
                                <td class="border-[1px] border-black">
                                    {{-- Sisa kuota = shift->kuota - jml pendaftar --}}
                                    @php
                                        $taken = $shift->plottingans->count(); // pastikan 'plottingans' di-load
                                        $sisa = $shift->kuota - $taken;
                                    @endphp
                                    {{ $sisa }} / {{ $shift->kuota }}
                                </td>
                                <td class="border-[1px] border-black">
                                    {{-- Tombol "Choose" untuk konfirmasi pilih shift --}}
                                    @if($sisa > 0)
                                        <button
                                            class="bg-AddButton px-1.5 py-1 text-center rounded-lg text-white"
                                            onclick="showShift( {{ $shift->id }} )"
                                        >
                                            Choose
                                        </button>
                                    @else
                                        <span class="text-red-500">Full</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="border-[1px] border-black py-2">
                                    No shifts available
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Komponen pop-up konfirmasi --}}
                <x-confirm-shift />
            </div>
        </div>
    </div>

    {{-- Sidebar & Home-Button (sesuai komponen di project Anda) --}}
    <x-sidebar />
    <x-home-button />

    {{-- Script JS untuk menampilkan popup dan set form SHIFT --}}
    <script>
        // Kita asumsikan di confirm-shift.blade.php ada form POST /shift/pick
        // dan input hidden bernama shift_id
        function showShift(shiftId) {
            // Set input hidden di popup
            const hiddenInput = document.getElementById('shift_id_input');
            hiddenInput.value = shiftId;

            // Tampilkan popup
            document.getElementById('popupShift').classList.remove('hidden');
        }
        function hideShift() {
            document.getElementById('popupShift').classList.add('hidden');
        }
    </script>

</body>
</html>
