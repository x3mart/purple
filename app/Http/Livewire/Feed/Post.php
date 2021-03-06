<?php

namespace App\Http\Livewire\Feed;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

use Livewire\Component;

class Post extends Component
{
    use WithFileUploads;

    public $post, $user, $text, $photo, $link, $showCommentsButton, $commentsCount;
    public $deleted = 0;
    public $commentsIsLoaded = 0;
    public $commentsIsShown = 0;
    public $editPost = 0;
    public $showMore = 1;

    public function mount()
    {
        $this->showCommentsButton = $this->getButton();
        $this->commentsCount = $this->post->comments_count;
        $this->text = $this->getText();
    }

    protected $listeners = ['commentDeleted' => 'freshComments', 'commentAdded' => 'showNewComment'];

    public function deletePost()
    {
        if($this->user->can('delete', $this->post)){
            $this->deleted = $this->post->delete();
        }
    }

    public function savePost()
    {
        $this->post->text = $this->text;
        $this->post->save();
        $this->editPost = 0;
        $this->showMore = 1;
    }

    protected function getButton()
    {
        if (!$this->commentsIsShown) {
            return '<a href="#" @click.prevent="show_comments = !show_comments"  class="more-comments" wire:click="toggleComments">Показать комментарии </a><div wire:loading.class="comments-loading"> + </div>';
        } else {
            return '<a href="#" @click.prevent="show_comments = !show_comments"  class="more-comments" wire:click="toggleComments">Скрыть комментарии </a><div wire:loading.class="comments-loading"> - </div>';
        }
    }

    public function freshComments()
    {
        $this->post->load('comments.likes.authorable', 'comments.authorable');
    }

    protected function getText()
    {
       return $this->post->text;
    }

    public function savePhoto()
    {
        $this->validate([
            'photo' => 'image|max:2048', // 2MB Max
        ]);
        $this->link = $this->photo->store('summernote');
        $img = Image::make($this->link);
        if ($img->width() > 1024){
            $img->resize(1024, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save();
        }
        $this->emit('photoSaved', $this->link);
    }

    public function deletePhoto($name)
    {
        Storage::delete($name);
    }

    public function showNewComment()
    {
        if (!$this->commentsIsShown){
            $this->commentsIsShown = !$this->commentsIsShown;
        }
        $this->showComments();
    }

    public function toggleComments()
    {
        $this->commentsIsShown = !$this->commentsIsShown;
        $this->showComments();
    }

    protected function showComments()
    {
        $this->freshComments();
        $this->showCommentsButton = $this->getButton();
        if (!$this->commentsIsLoaded){
            $this->commentsIsLoaded = !$this->commentsIsLoaded;
        }
    }

    public function toggleEdit()
    {
        $this->editPost = !$this->editPost;
    }

    public function render()
    {
        return view('livewire.feed.post');
    }
}
