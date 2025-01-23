{{-- resources/views/CaAs/FixShift.blade.php --}}
{{-- Halaman menampilkan SHIFT yang sudah diambil user --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shift</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-Shift bg-cover bg-center bg-no-repeat max-w-full overflow-hidden">

    {{-- Background dekorasi Anda --}}
    <img src="{{ asset('assets/Wall2.webp') }}" alt="Wall" class="fixed left-0 h-full w-auto hidden sm:block">
    <img src="{{ asset('assets/Wall-Mobile.webp') }}" alt="Wall" class="fixed inset-0 w-[200px] sm:hidden">
    {{-- Dst... (Silakan lanjutkan dekorasi sesuai snippet Anda) --}}

    <div class="absolute bg-BlackLayer w-full h-full z-20">
        <div class="container mx-auto py-5 font-crimson-text">
            {{-- Judul --}}
            <div class="inset-0 text-white text-center">
                <h2 class="font-crimson-text text-md lg:text-lg md:text-lg pb-1 font-bold">
                    Discover the light within
                </h2>
                <h1 class="text-xl md:text-2xl lg:text-2xl">Your Chosen Shift</h1>
            </div>

            {{-- Konten utama --}}
            <div class="flex relative justify-center -top-10">
                <img src="{{ asset('assets/Announcement Stone.webp') }}" alt="" class="h-[700px]">

                <div class="absolute text-justify mt-32 w-[230px] lg:w-[250px] text-white px-4">
                    @if ($shift)
                        <p class="lg:text-lg text-base font-bold mb-5">
                            Below is the shift you have chosen. Please note, you cannot change it anymore.
                        </p>
                        <p class="ml-3 lg:text-md text-sm font-im-fell-english">
                            Date: 
                            {{ \Carbon\Carbon::parse($shift->date)->format('l, jS F Y') }}
                        </p>
                        <p class="ml-3 lg:text-md text-sm font-im-fell-english">
                            Time: 
                            {{ substr($shift->time_start,0,5) }} - {{ substr($shift->time_end,0,5) }}
                        </p>
                        <p class="lg:text-lg text-base font-bold mt-5">
                            Please always re-check your shift and our official announcements for more info.
                        </p>
                    @else
                        <p class="lg:text-lg text-base font-bold mb-5">
                            You haven't picked any shift yet.
                        </p>
                        <p>
                            <a href="{{ route('caas.choose-shift') }}" class="underline">
                                Click here to choose shift
                            </a>
                        </p>
                    @endif
                </div>

                {{-- Tanda tangan / dekorasi --}}
                <div class="absolute bottom-[70px] ml-56 hidden lg:block">
                    <img src="{{ asset('assets/Sign DLOR.webp') }}" alt="Sign" class="w-[120px]">
                </div>
            </div>
        </div>
    </div>

    <x-sidebar />
    <x-home-button />

</body>
</html>
