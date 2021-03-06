<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use App\Models\Like as Likes;

class Like extends Component
{
    public $item;
    public $isMyLike;
    public $likes;
    public $likes_count;

    public function mount()
    {
        $this->isMyLike = !!$this->getMyLike();
        $this->likes = $this->getLikes();
        $this->likes_count = $this->item->likes_count;
    }

    protected function getMyLike()
    {
        return $this->item->likes->where('authorable_type', User::class)->where('authorable_id', auth()->user()->id)->first();
    }

    protected function getLikes()
    {
        return $this->item->likes;
    }

    public function toogleLike()
    {
        if(!!$this->isMyLike){
            $this->getMyLike()->delete();
        } else {
            $this->item->likes()->create(['authorable_type'=> User::class, 'authorable_id'=> auth()->user()->id]);
        }
        $this->item->load('likes.authorable')->loadCount('likes');
        $this->isMyLike = !!$this->getMyLike();
        $this->likes = $this->getLikes();
        $this->likes_count = $this->item->likes_count;
    }

    public function render()
    {
        return view('livewire.like');
    }
}
