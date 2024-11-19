<?php

use App\Livewire\CategoryIndex;
use App\Livewire\HomeIndex;
use App\Livewire\PostIndex;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeIndex::class)->name('home.index');

Route::get('category',CategoryIndex::class)->name('category.index');


Route::get('posts',PostIndex::class)->name('posts.index');
