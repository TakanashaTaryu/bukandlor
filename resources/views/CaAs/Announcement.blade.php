<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcement</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
@php
    $user = Auth::user();
    $announcement = App\Models\Announcement::find(1);
    $message = $announcement 
        ? ($user->caasStage->status === "Fail" ? $announcement->fail_message : $announcement->success_message)
        : "Unknown";
    $link = ($announcement && $user->caasStage->status !== "Fail") ? $announcement->link : "";
    $name = $user->profile->name ?? $user->nim;

    // Tentukan header text & warna berdasarkan status
    $status = $user->caasStage->status ?? 'Unknown';
    $headerText = 'Congratulations';   // default
    $headerColor = 'text-green-600';   // default warna hijau

    if (strtolower($status) === 'fail') {
        $headerText = "We are Sorry";
        $headerColor = 'text-red-600';
    }
@endphp
<body class="bg-Announcement bg-cover bg-center bg-fixed bg-no-repeat min-h-screen max-w-full scroll-x-hide text-primary overflow-hidden flex items-center justify-center relative">

    <img src="assets/Shadow Right.webp" alt="Shadow" class="fixed right-0 top-0 w-1/2 h-full">
    <img src="assets/BatsAnimated.webp" alt="Bats" class="fixed -top-72 -left-72 w-[750px] scale-x-[-1] opacity-60">
    <img src="assets/Crystals.webp" alt="Crystal" class="fixed w-[1400px] h-auto min-w-[1000px] ml-[150px] bottom-0">
    <img src="assets/Waterfall.webp" alt="Waterfall" class="fixed min-w-[800px] h-full top-0 md:h-full">
    <img src="assets/Magic Tree.webp" alt="Magic Tree" class="fixed w-[650px] h-auto min-w-max lg:-right-28 -right-52 bottom-5">
    <img src="assets/Lower.webp" alt="Wall" class="fixed -bottom-5 w-full lg:h-full h-[500px]">

    <div class="container max-w-xl mx-auto py-5 font-crimson-text">
        <div class="flex relative justify-center">
            <img src="assets/Announcement Stone.webp" alt="" class="h-[700px] min-h-max">
            <div class="absolute text-justify mt-28 ml-[160px] mr-[150px]">
                <h1 class="text-center lg:text-3xl text-3xl font-bold">Announcement</h1>
                <hr class="mt-2 border-primary w-3/5 mx-auto mb-2 lg:mb-2">
                 <!-- Header conditional (Congratulations / Sorry) -->
                 <h2 class="text-md lg:text-lg font-bold mb-5">
                    <span class="{{ $headerColor }}">{{ $headerText }},</span>
                    <br>
                    <span class="text-black">{{ $name }}</span>
                </h2>
                <p class="text-xs lg:text-sm text-justify font-im-fell-english">
                    {!! $message !!}
                    <br>
                    <a href="{{ e($link) }}" class="text-blue-500 underline hover:text-blue-700">{{ $link }}</a>
                </p>
            </div>
            <div class="absolute bottom-28 mr-16">

                <!-- TODO BUAT SHIFT/GEM -->
                
                <button class="relative text-primary transition-all duration-300 ease-in-out transform hover:scale-105 hover:brightness-150 active:scale-95 list-none">
                    <img src="assets/Button Pink.webp" alt="No" class="w-[150px]">
                    <p class="absolute inset-0 flex items-center justify-center text-lg font-bold">Shift</p>
                </button>

            </div>
            <div class="absolute bottom-[70px] ml-56">
                <img src="assets/Sign DLOR.webp" alt="" class="w-[120px]">
            </div>
        </div>
    </div>
    <x-sidebar></x-sidebar>
    <x-home-button></x-home-button>
    
</body>
</html>