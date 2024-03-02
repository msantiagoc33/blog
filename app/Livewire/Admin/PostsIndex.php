<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;

class PostsIndex extends Component
{
    use WithPagination;

    protected function updatingSearch(){
        $this->resetPage();
    }
    public function render()
    {
        $posts = Post::where('user_id', auth()->user()->id)
            ->latest('id')
            ->paginate();

        return view('livewire.admin.posts-index', compact('posts'));
    }
}
