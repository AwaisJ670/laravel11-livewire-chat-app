<?php

namespace App\Livewire;

use App\Events\MessageSendEvent;
use App\Models\Message;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class ChatApp extends Component
{
    public $senderID;
    public $receiverID;
    public $message = '';
    public $messages = [];
    public $users = [];
    public function render()
    {
        return view('livewire.chat-app');
    }

    public function mount($user_id){
        $this->senderID = auth()->user()->id;
        $this->receiverID = $user_id;

        $messages = Message::where(function ($query){
            $query->where('sender_id',$this->senderID)
            ->where('receiver_id',$this->receiverID);
        })->orWhere(function ($query){
            $query->where('sender_id',$this->receiverID)
            ->where('receiver_id',$this->senderID);
        })->with('sender:id,name','receiver:id,name')
        ->get();

        foreach ($messages as $message) {
            $this->appendChatMessage($message);
        }
        // dd($this->messages,$user_id);
        $this->users =  User::where('id' ,'!=' , auth()->user()->id)->select('id','name')->get();
    }

    public function sendMessage(){
        // dd($this->message);

        $chatMessage = new Message();
        $chatMessage->sender_id = $this->senderID;
        $chatMessage->receiver_id = $this->receiverID;
        $chatMessage->message = $this->message;
        $chatMessage->save();
        $this->appendChatMessage($chatMessage);
        broadcast(new MessageSendEvent($chatMessage))->toOthers();

        $this->message = '';

    }

    #[On('echo-private:chat-app.{senderID},MessageSendEvent')]
    public function listenMessage($event){
        $chatMessage = Message::whereId($event['message']['id'])
        ->with('sender:id,name','receiver:id,name')
        ->first();

        $this->appendChatMessage($chatMessage);
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
