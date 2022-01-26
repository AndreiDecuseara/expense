<nav class="px-4 py-8 md:h-14">
    <div class="float-right pr-4 text-center md:text-left">
        @if($roomCode)
            <span class="px-8 py-3 mr-4 text-sm text-white bg-green-600 rounded-lg shadow-xl">Group code: <b>{{$roomCode}}</b></span>
        @endif
        @if(\Request::route()->getName() != '/')
            <a class="px-6 py-3 text-white bg-green-600 rounded-lg shadow-xl md:mr-4" href="/"><i class="las la-chevron-left"></i></a>
        @endif
    </div>
</nav>
