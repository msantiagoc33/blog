<?php

namespace App\Livewire\Admin;

use App\Models\Image;
use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;

class PostsIndex extends Component
{
    use WithPagination;
    public $indice = 0;

    protected function updatingSearch(){
        $this->resetPage();
    }
    public function render()
    {

        $posts = Post::where('user_id', auth()->user()->id)
            ->latest('id')
            ->paginate(5);

        $imagenes = Image::all();

        return view('livewire.admin.posts-index', compact('posts', 'imagenes'));
    }
}
