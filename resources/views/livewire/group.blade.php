<div class="px-4 pb-4">
    {{-- <div class="absolute z-0 w-screen h-screen" id="particles-js"></div> --}}
    <div class="container h-screen m-auto text-center">
        <h1 class="my-4 text-4xl text-center text-green-600 md:text-5xl"><b>Welcome to group: {{$group->name}}</b>
        </h1>
      <h1 class="my-4 text-xl text-center">{{ $user->isAdmin($group->slug) ? 'You are admin, ' : 'You are Member, '}} {{$user->name}}</h1>
      @if($user->isAdmin($group->slug))
        <button x-data="{ endTrip : @entangle('endTrip')}" @if($group->end_trip == 0) wire:click='reveal' @else wire:click='closeReveal' @endif
            class="px-6 py-3 mr-4 text-white rounded-lg shadow-xl" :class="endTrip == 0 ? 'bg-green-600' : 'bg-red-600'" >
            @if($group->end_trip == 0) Reaveal cards 🔒️ <i class="las la-arrow-right"></i> 🔓️
            @else Close reaveal 🔓️ <i class="las la-arrow-right"></i> 🔒️ @endif
        </button>
      @endif
      @if($group->end_trip == 1 && !$user->isAdmin($group->slug))
        <p class="text-xl text-green-600"> <b>Trip ended! Check the expenses! Enjoy 🎉️ </b></p>
      @endif
      @if($group->end_trip == 1 && $user->isAdmin($group->slug))
        <p class="mt-5 text-xl text-green-600"> <b>Trip ended!  Check the expenses! Enjoy 🎉️ </b></p>
      @endif
      <div class="w-full pt-10 pb-10 m-auto mt-10">
        @if($user->isAdmin($group->slug))
            <div class="md:gap-8 md:grid md:grid-cols-4">
                @foreach($group->cards as $card)
                    <div class="px-4 py-4 my-6 text-left duration-300 bg-white rounded-lg shadow-xl md:my-0 hover:-translate-y-4 transform-gpu">
                        <p class="pb-4 m-auto text-2xl text-center text-teal-500">{{$card->user->name}}'s card</p>
                        @foreach(json_decode($card->point_card) as $value => $info)
                        <div class="flex items-center">
                            <div class="w-1 h-1 mt-1 mr-2 bg-teal-500 rounded-full"></div>
                            <div>{{$info}}</div>
                        </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        @else
            @if($group->end_trip == 0)
                <div class="md:flex">
                    <div class="w-full md:w-3/4">
                        <form wire:submit.prevent="savePoint" class=" md:w-1/2">
                            <div class="flex items-center py-2 mb-2 border-b border-teal-500" x-data = "{anonim : @entangle('anonim')}"">
                                <input wire:model.defer="pointCard" class="w-3/4 px-2 py-1 mr-3 leading-tight text-gray-700 bg-transparent border-none appearance-none focus:outline-none" type="text" placeholder="Expense description ...">
                                <span class="border-l h-10 border-teal-500"></span>
                                
                                <span class="text-gray-500 sm:text-sm ml-4">
                                    $
                                </span>
                                <input wire:model.defer="priceCard" class="w-1/4 text-center pl-3  rounded px-2 py-1 -ml-2 mr-3 leading-tight text-gray-700 bg-transparent border-none appearance-none focus:outline-none" type="number" placeholder="0">
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
            @else
                <div class="md:grid md:grid-cols-4 md:gap-8">
                    @foreach($group->cards as $card)
                        <div class="px-4 py-4 my-6 text-left duration-300 bg-white rounded-lg shadow-xl md:my-0 hover:-translate-y-4 transform-gpu">
                            <p class="pb-4 m-auto text-2xl text-center text-teal-500">{{$card->user->name}}'s card</p>
                            @foreach(json_decode($card->point_card) as $value => $info)
                            <div class="flex items-center" x-data="{ like: false}">
                                <div class="w-1 h-1 mt-1 mr-2 bg-teal-500 rounded-full"></div>
                                <div>{{$info}}</div> 
                            </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @endif
        @endif
      </div>
    </div>
  </div>
  @push('js')
    <script>
        $( document ).ready(function() {
            var refresh = setInterval(function(){
                Livewire.emit('refreshThis')
            }, 2000);
        });
    </script>
@endpush

