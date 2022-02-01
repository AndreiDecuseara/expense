<div class="px-4">
    {{-- <div class="absolute z-0 w-screen h-screen" id="particles-js"></div> --}}
    <div class="container m-auto text-center">
      <h1 class="my-4 mt-10 text-4xl text-center text-green-600 md:mt-0 md:text-5xl"><b>Your name is important for us</b></h1>
      <div class="w-full pt-10 m-auto mt-10">
        <div class="w-full max-w-sm m-auto mt-10 mx:mt-0">
            <form wire:submit.prevent="saveUser" class="flex items-center py-2 mb-2 border-b border-teal-500">
                <input wire:model="userName" class="w-full px-2 py-1 mr-3 leading-tight text-gray-700 bg-transparent border-none appearance-none focus:outline-none" type="text" placeholder="Your Name ..." aria-label="Full name">
                <button type="submit" class="flex-shrink-0 px-2 py-1 text-sm text-white bg-teal-500 border-4 border-teal-500 rounded hover:bg-teal-700 hover:border-teal-700" type="button">
                    Start
                </button>
                <a href="/" class="flex-shrink-0 px-2 py-1 text-sm text-teal-500 border-4 border-transparent rounded hover:text-teal-800" type="button">
                Cancel
                </a>
            </form>
        </div>
      </div>
    </div>
  </div>
