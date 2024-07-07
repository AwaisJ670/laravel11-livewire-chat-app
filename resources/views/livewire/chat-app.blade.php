<div class="min-h-screen flex flex-col">
    <div class="flex flex-grow container-fluid mx-auto shadow-lg rounded-lg w-full">
        <!-- Chatting -->
        <div class="flex flex-row justify-between bg-white w-full h-full">
            <!-- chat list -->
            <div class="flex flex-col w-2/5 border-r-2 overflow-y-auto">
                <!-- user list -->
                @foreach ($users as $user)
                    <div class="flex flex-row py-4 px-2 justify-center items-center border-b-2">
                        <div class="w-1/4">
                            <img class="object-cover h-12 w-12 rounded-full" src="{{ asset('manlogo.svg') }}">
                        </div>
                        <div class="w-full">
                            <div class="text-lg font-semibold">
                                <a href="{{ route('chatApp',$user->id) }}">
                                    {{ $user->name }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- end user list -->
            </div>
            <!-- end chat list -->
            <!-- message -->
            <div class="w-full px-5 flex flex-col justify-between">
                <div class="flex flex-col mt-5 flex-grow overflow-y-auto">
                    @foreach ($messages as $message)
                        @if ($message['sender'] != auth()->user()->name)
                        <div class="flex justify-start mb-4">
                            <img class="object-cover h-8 w-8 rounded-full" src="{{ asset('manlogo.svg') }}">
                            <div class="ml-2 py-3 px-4 bg-gray-400 rounded-br-3xl rounded-tr-3xl rounded-tl-xl text-white max-w-lg break-words">
                                 {{ $message['message'] }}
                            </div>
                        </div>
                        @else
                        <div class="flex justify-end mb-4">
                            <div class="mr-2 py-3 px-4 bg-blue-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white max-w-lg break-words">
                                {{ $message['message'] }}
                            </div>
                            <img class="object-cover h-8 w-8 rounded-full" src="{{ asset('womenlogo.svg') }}">
                        </div>

                        @endif
                    @endforeach
                </div>
                <form wire:submit.prevent="sendMessage" class="mt-5 w-full">
                    <div class="py-5 flex items-center space-x-2 w-full">
                        <input class="flex-grow bg-gray-300 py-3 px-3 rounded-xl" type="text"
                            placeholder="Enter message here..." wire:model="message" />
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl">
                            Send
                        </button>
                    </div>
                </form>
            </div>
            <!-- end message -->
        </div>
    </div>
</div>
