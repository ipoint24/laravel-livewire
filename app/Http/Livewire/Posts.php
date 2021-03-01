<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;

class Posts extends Component
{
    use WithPagination;

    public $title, $body, $post_id, $user_id;
    public $isOpen = 0;
    public $active;

    protected $listeners = [
        'postSelected'
    ];

    public function postSelected($postId)
    {
        $this->active = $postId;
    }

    public function loadList()
    {
        $posts = Post::with('user')->paginate(10);
        return $posts;
    }

    public function render()
    {
        $posts = $this->loadList();
        /*
        return view('livewire.posts.posts',[
            'posts' => $posts,
        ])->layout('layouts.default');
        */
        return view('livewire.posts.posts-list', [
            'posts' => $posts,
        ])->layout('layouts.default');

    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields()
    {
        $this->title = '';
        $this->body = '';
        $this->post_id = '';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function openModal()
    {
        $this->isOpen = true;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        $this->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        Post::updateOrCreate(['id' => $this->post_id], [
            'title' => $this->title,
            'body' => $this->body,
            'user_id' => auth()->user()->id
        ]);

        $type = "success";
        $message = $this->post_id ? 'Post Updated Successfully.' : 'Post Created Successfully.';
        $title = "UpdateOrCreate-Title";
        /*
        session()->flash('message',
            $this->post_id ? 'Post Updated Successfully.' : 'Post Created Successfully.');

        $this->emitTo('notifications', 'flash_message', $type, $message);
        */
        $this->emit('alert', ['type' => $type, 'message' => $message, 'title' => $title]);
        $this->closeModal();
        $this->resetInputFields();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function closeModal()
    {
        $this->isOpen = false;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->post_id = $id;
        $this->title = $post->title;
        $this->body = $post->body;

        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Post::find($id)->delete();
        // session()->flash('message', 'Post Deleted Successfully.');
        $type = "success";
        $title = "Überschrift";
        $message = 'Post Deleted Successfully.';
        $this->emit('alert', ['type' => $type, 'message' => $message, 'title' => $title]);
    }

    public function paginationView()
    {
        return 'components.section.pagination-links';
    }
}
