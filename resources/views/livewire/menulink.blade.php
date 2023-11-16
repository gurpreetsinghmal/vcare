<div>
        @if(Auth::user()->role->id>4)
         <div >
                <span>Reporting Stats - {{$block->block->name}}</span>
                <div class="grid mb-2 grid-cols-4 gap-3 text-white">
                        
                        <div class="bg-rose-400 p-3 rounded-lg h-16 flex justify-between">
                                <span>Pending ANC1</span><span class="font-bold text-white text-xl">{{$stat["anc1"]}}</span>
                        </div>
                        <div class="bg-rose-400 p-3 rounded-lg h-16 flex justify-between">
                                <span>Pending ANC2</span><span class="font-bold text-white text-xl">{{$stat["anc2"]}}</span>
                        </div>
                        <div class="bg-rose-400 p-3 rounded-lg h-16 flex justify-between">
                                <span>Pending ANC3</span><span class="font-bold text-white text-xl">{{$stat["anc3"]}}</span>
                        </div>
                        <div class="bg-rose-400 p-3 rounded-lg h-16 flex justify-between">
                                <span>Pending ANC4</span><span class="font-bold text-white text-xl">{{$stat["anc4"]}}</span>
                        </div>
                       

                </div>
                <div class="grid grid-cols-2 gap-3 text-white mb-2">
                <div class="bg-blue-400 p-3 rounded-lg h-16 flex justify-between">
                                <span>Total Cases</span><span class="font-bold text-white text-xl">{{$stat["total"]}}</span>
                        </div>
                        <div class="bg-green-400 p-3 rounded-lg h-16 flex justify-between">
                                <span>Delivered Cases</span><span class="font-bold text-white text-xl">{{$stat["delivered"]}}</span>
                        </div>
                </div>
         </div>        
        @endif

                        <div class="mb-2 p-3 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                                <a href="/mapping" class="bg-pink-800 p-2 text-white rounded-md">Mapping</a>
                                <a href="/changepwd" class="bg-pink-800 p-2  text-white rounded-md">Change Password</a>
                        </div>
                </div>