<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Masmerise\Toaster\Toaster;

class PostIndex extends Component
{
    use WithFileUploads;
    public $isModalOpen = false;
    public $filterCategory;

    public $postID;

    #[Rule('required', 'Name is required')]
    #[Rule('min:3', message: 'Isi Name Minimal 3 Karakter')]
    public $title;
    #[Rule('required', 'Category ID is required')]
    public $category_id;
    #[Rule('required', message: 'Masukkan Gambar Post')]
    #[Rule('image', message: 'File Harus Gambar')]
    #[Rule('max:1024', message: 'Ukuran File Maksimal 1MB')]
    public $image;
    #[Rule('required', 'Content is required')]
    public $content;

    public function render()
    {
        $listCategory = Category::where('is_active', true)->get();
        $data = Post::get();
        return view('livewire.post-index', [
            'data' => $data,
            'listCategory' => $listCategory,
        ]);
    }
    public function create()
    {
        $this->openModal();
    }
    public function openModal()
    {
        $this->isModalOpen = true;
    }
    public function closeModal()
    {
        $this->reset();
        $this->isModalOpen = false;
    }

    public function store()
    {
        $this->validate();
        $this->image->storeAs('public/posts', $this->image->hashName(),'public');
        if ($this->postID) {
            Post::where('id', $this->postID)
                ->update([
                    'title' => $this->title,
                    'slug' => Str::of($this->title)->slug('-'),
                    'image' => $this->image->hashName(),
                    'content' => $this->content,
                    'category_id' => $this->category_id,
                ]);
            $msg = 'update';
        } else {
            Post::create([
                'title' => $this->title,
                'slug' => Str::of($this->title)->slug('-'),
                'image' => $this->image->hashName(),
                'content' => $this->content,
                'category_id' => $this->category_id,
            ]);
            $msg = 'insert';
        }
        Toaster::success('Data Berhasil di'.$msg);
        $this->closeModal();
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $this->postID = $post->id;
        $this->title = $post->title;
        $this->category_id = $post->category_id;
        $this->content = $post->content;
        $this->image = $post->image;
        $this->openModal();
    }

    public function delete($id)
    {

        $post = Post::find($id);
        Storage::delete('public/posts/'. $post->image);
        Post::destroy($id);
        Toaster::error('Data berhasil didelete');
    }
}
