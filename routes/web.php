<?php

use App\Livewire\Components\PropertyListing;
use App\Livewire\PropertyDetailPage;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('properties.index');
});
Route::get('/properties',PropertyListing::class)->name('properties.index');

Route::get('properties/{property:slug}',PropertyDetailPage::class)->name('property.show');
