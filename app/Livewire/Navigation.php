<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Facades\DB;


class Navigation extends Component
{
    public function render()
    {
        $categories = Category::all();

        // Esta selección cuenta los posts que ha escrito cada uno 
        $conteoPostsPorUsuario = Post::selectRaw('user_id, COUNT(*) as cantidad')
            ->groupBy('user_id')
            ->get();
            
        return view('livewire.navigation', compact('categories','conteoPostsPorUsuario'));
    }
}
