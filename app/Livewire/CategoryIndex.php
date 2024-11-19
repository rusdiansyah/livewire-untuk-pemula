<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Support\Str;
use Masmerise\Toaster\Toaster;

class CategoryIndex extends Component
{
    public $isModalOpen = false;

    public $filterIsActive;
    public $categoryID;

    #[Rule('required', 'Name is required')]
    #[Rule('min:3', message: 'Isi Name Minimal 3 Karakter')]
    public $name;
    public $is_active;

    public function render()
    {
        $data = Category::when($this->filterIsActive,function($query){
            if($this->filterIsActive=="Active")
            {
                $query->where('is_active',operator: 1);
            }
            if($this->filterIsActive=="inActive")
            {
                $query->where('is_active',operator: 0);
            }
        })
        ->get();

        return view('livewire.category-index', [
            'data' => $data
        ]);
    }

    public function create()
    {
        $this->openModal();
    }

    public function edit($id)
    {
        $category = Category::find($id);
        $this->categoryID = $category->id;
        $this->name = $category->name;
        $this->is_active = $category->is_active;
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
        if ($this->categoryID) {
            Category::where('id',$this->categoryID)
            ->update([
                'name' => $this->name,
                'slug' => Str::of($this->name)->slug('-'),
                'is_active' => $this->is_active ? 1 : 0,
            ]);
            $msg = 'update';
        } else {
            Category::create([
                'name' => $this->name,
                'slug' => Str::of($this->name)->slug('-'),
                'is_active' => $this->is_active ? 1 : 0,
            ]);
            $msg = 'insert';
        }
        Toaster::success('Data Berhasil di'.$msg);
        $this->closeModal();
    }

    public function delete($id)
    {
        Category::destroy($id);
        Toaster::error('Data berhasil didelete');
    }

    public function toggleComplete($id)
    {
        $category = Category::find($id);
        $category->is_active = !$category->is_active;
        $category->save();
        Toaster::success('Status Active Berhasil diupdate');
    }
}
