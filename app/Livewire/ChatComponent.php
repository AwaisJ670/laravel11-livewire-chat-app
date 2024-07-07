<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\User;
use Livewire\Component;

class ChatComponent extends Component
{
    public $user;
    public $senderId;
    public $receiverId;
    public $message = '';
    public $messages = [];

    public function render()
    {
        return view('livewire.chat-component');
    }

    public function mount($user_id){
        // dd($user_id);
        $this->senderId = auth()->user()->id;
        $this->receiverId = $user_id;

        $messages = Message::where(function ($query){
            $query->where('sender_id',$this->senderId)
            ->where('receiver_id',$this->receiverId);
        })->orWhere(function ($query){
            $query->where('sender_id',$this->receiverId)
            ->where('receiver_id',$this->senderId);
        })->with('sender:id,name','receiver:id,name')
        ->get();

        foreach ($messages as $message) {
            $this->appendChatMessage($message);
        }
        dd($messages->toArray(),$this->messages);

        $this->user= User::whereId($user_id)->first();
    }

    public function sendMessage(){
        // dd($this->message);

        $chatMessage = new Message();
        $chatMessage->sender_id = $this->senderId;
        $chatMessage->receiver_id = $this->receiverId;
        $chatMessage->message = $this->message;

        $chatMessage->save();

        $this->message = '';
    }

    public function appendChatMessage($message){
        $this->messages[] = [
            'id' => $message->id,
            'message' => $message->message,
            'sender' => $message->sender->name,
            'receiver' => $message->receiver->name
        ];
    }
}
