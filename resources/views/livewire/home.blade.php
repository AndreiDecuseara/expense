<div class="px-4">
  {{-- <div class="absolute z-0 w-screen h-screen" id="particles-js"></div> --}}
  <div class="container m-auto text-center">
    <h1 class="my-4 text-4xl text-center text-green-600 md:text-5xl"><b>{{$user ? 'Welcome, '.$user->name : 'Retro app'}}</b></h1>
    <div class="w-full pt-10 m-auto mt-10 md:w-1/2 ">
      <div class="flex justify-between">
        <a href="/new-group" class="z-10 flex items-center px-4 py-3 transition duration-1000 ease-in-out bg-white rounded-lg shadow-inner md:px-8 hover:shadow-xl flex-column">
          <p class="ml-1 text-sm md:text-xl text-orange-400" >Personal</p>
        </a>
        <a href="/acces-group" class="z-10 flex items-center px-4 py-3  transition duration-1000 ease-in-out bg-white rounded-lg shadow-inner md:px-8 hover:shadow-xl flex-column">
          <p class="ml-1 text-sm md:text-xl text-green-600" >Acces a group</p>
        </a>
        <a href="/new-group" class="z-10 flex items-center px-4 py-3 transition duration-1000 ease-in-out bg-white rounded-lg shadow-inner md:px-8 hover:shadow-xl flex-column">
          <p class="ml-1 text-sm md:text-xl text-blue-400" >New group</p>
        </a>
      </div>
      <div class="flex justify-between mt-10">
          @if($user)
            <div class="w-full m-auto">
                <p class="mb-4 text-xl text-center text-green-600"><b>Your Active Groups</b></p>
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                      <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                          <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                              <tr>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                  Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                  Members
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                    Actions
                                </th>
                              </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($user->rooms as $group)
                              <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{route('group', ['group' => $group->slug, 'user' => $user->id])}}" class="text-sm text-gray-900">{{$group->name}}</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                  <div class="text-sm text-gray-900">{{$group->cards->count() == 0 ? 'No one here' : $group->cards->count()}}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-red-600"><a href="#"> Delete </a></div>
                                </td>
                              </tr>
                            @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
          @endif
      </div>
    </div>
    @push('js')
      <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
      <script>
        particlesJS.load('particles-js', 'assets/particles.json', function() {
          console.log('callback - particles.js config loaded');
        });
      </script>
    @endpush
  </div>
</div>
