<div class="px-4 pb-4">
    {{-- <div class="absolute z-0 w-screen h-screen" id="particles-js"></div> --}}
    <div class="container h-screen m-auto text-center">
        <h1 class="my-4 text-4xl text-center text-green-600 md:text-5xl"><b>Welcome to your personal expense</b>
        </h1>
      <div class="w-full pt-10 pb-10 m-auto mt-10" >
        <div class="md:flex">
            <div class="w-full md:w-3/4">
                <form wire:submit.prevent="savePoint" class=" md:w-1/2">
                    <div class="flex items-center py-2 mb-2 border-b border-teal-500" x-data = "{anonim : @entangle('anonim')}"">
                        <input wire:model.defer="pointCard" class="w-3/4 px-2 py-1 mr-3 leading-tight text-gray-700 bg-transparent border-none appearance-none focus:outline-none" type="text" placeholder="Expense description ...">
                        <span class="h-10 border-l border-teal-500"></span>

                        <span class="ml-4 text-gray-500 sm:text-sm">
                            $
                        </span>
                        <input wire:model.defer="priceCard" class="w-1/4 px-2 py-1 pl-3 mr-3 -ml-2 leading-tight text-center text-gray-700 bg-transparent border-none rounded appearance-none focus:outline-none" type="number" placeholder="0">
                        <button type="submit" class="flex-shrink-0 px-2 py-1 text-sm rounded " type="button" :class="anonim ? 'text-white bg-black border-4 border-black hover:bg-blue-900 hover:border-blue-900' : 'text-white bg-teal-500 border-4 border-teal-500 hover:bg-teal-700 hover:border-teal-700'">
                            Send
                        </button>
                    </div>
                </form>
            </div>
            <div class="w-full px-4 py-4 mt-8 text-left bg-white rounded-lg shadow-xl md:mt-4 md:mx-20 md:w-1/2">
                <p class="pb-4 m-auto text-2xl text-center text-teal-500">Your card</p>
                @if($card)
                    @foreach($cardInfo as $value => $info)
                    <div class="flex items-center">
                        <div class="w-1 h-1 mt-1 mr-2 bg-teal-500 rounded-full"></div>
                        <div>{{$info}} </div>
                        <button wire:click="deleteInfo({{$value}})"> <i class="ml-2 text-red-500 las la-times-circle"></i></button>
                    </div>
                    @endforeach
                @else
                    <div>Nothing here now 🤷‍♂️️</div>
                @endif
            </div>
        </div>
      </div>
    </div>
  </div>
  {{-- @push('js')
    <script>
        $( document ).ready(function() {
            var refresh = setInterval(function(){
                Livewire.emit('refreshThis')
            }, 2000);
        });
    </script>
@endpush --}}

