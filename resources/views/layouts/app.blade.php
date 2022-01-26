<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Group Expense Tracker System</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Khula&family=Poppins&family=Nunito+Sans&display=swap" rel="stylesheet">

    {{-- Icons --}}
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <!-- Styles -->
    @livewireStyles
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="font-poppins bg-slate-100">
    <div class="relative mx-auto">
        @livewire('layouts.navbar', ['roomCode' => $roomCode ?? ''])
        {{ $slot }}

    </div>
    @livewire('layouts.footer')
    @livewireScripts
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('js')
</body>

</html>
