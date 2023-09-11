 <div class="bg-blue-500 fixed w-full top-0">
     <nav class="flex container mx-auto p-2 text-white items-center justify-between">
         <div>
             <a class=" flex items-center" href="/"><span><img class="w-12 rounded-full " src="{{asset('storage/images/wecare.png')}}" /></span>
                 <span class="text-2xl ml-2 uppercase">wecare</span>
             </a>
         </div>
         <div class="flex ">
             @auth
             <div class="mr-2 p-2"><a href="/dashboard">
                       {{Auth::user()->name}}, {{Auth::user()->role->description}}
                 </a></div>
             <div class="mr-2 hover:bg-pink-500 rounded-lg p-2"><a href="/dashboard">Dashboard</a></div>
             <div class="mr-2 hover:bg-pink-500 rounded-lg p-2"><a href="/logout">Logout</a></div>
             @else
             <div><a href="/login">Login</a></div>
             @endauth

         </div>
     </nav>
 </div>
