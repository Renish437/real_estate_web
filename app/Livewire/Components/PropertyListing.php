<?php

namespace App\Livewire\Components;

use App\Models\Property;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title("Property Listings")]
class PropertyListing extends Component
{
     use WithPagination;
    public $search='';
    public $minPrice = '';
    public $maxPrice= '';
    public $type = '';
    public $city = '';
    public $listingType ='';
    public $minBedrooms = '';
    public $featuredOnly =false;

    //sorting
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    public $viewMode = 'grid';
    public $page = 1;

    protected $paginationTheme = 'tailwind'; // (keep your theme)
protected $updatesQueryString = true;
public $preventScroll = true;

    protected $queryString = [
        'search'=>['except'=>''],
         'type'=>['except'=>''],
         'listingType'=>['except'=>''],
         'city'=>['except'=>''],
         'minPrice'=>['except'=>''],
         'maxPrice'=>['except'=>''],
         'featuredOnly'=>['except'=>false],
         'sortBy'=>['except'=>'created_at'],
         'sortDirection'=>['except'=>'desc'],
          'page'=>['except'=>''],
    ];
   public function updatingSearch(){
    $this->resetPage();
   }
   public function updatingType(){
    $this->resetPage();
   }
   public function updatingListingType(){
    $this->resetPage();
   }
   public function updatingCity(){
    $this->resetPage();
   }
   public function updatingMinPrice(){
    $this->resetPage();
   }
   public function updatingMaxPrice(){
    $this->resetPage();
   }
   public function updatingMinBedrooms(){
    $this->resetPage();
   }
   public function updatingFeaturedOnly(){
    $this->resetPage();
   }

   public function sortBy($field){
    if($this->sortBy === $field){
        $this->sortDirection = $this->sortDirection === 'asc'?'desc':'asc';
    }else{
        $this->sortBy = $field;
        $this->sortDirection='asc';
    }
    $this->resetPage();
   }
   // Clear filters
   public function clearFilters(){
    $this->reset(['search','minPrice','maxPrice','type','listingType','minBedrooms','featuredOnly','sortBy','sortDirection']);
    $this->resetPage();
   }
   // Change View mode
   public function setViewMode($mode){
    $this->viewMode=$mode;
   }
   // Computed properties
   
    #[Computed]
    public function properties()
    {
        return Property::query()
            ->available()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%')
                        ->orWhere('address', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->type, fn($query) => $query->byType($this->type))
            ->when(
                $this->listingType,
                fn($query) =>
                $this->listingType === 'sale'
                ? $query->forSale()
                : $query->forRent()
            )
            ->when($this->city, fn($query) => $query->inCity($this->city))
            ->when($this->minPrice, fn($query) => $query->where('price', '>=', $this->minPrice))
            ->when($this->maxPrice, fn($query) => $query->where('price', '<=', $this->maxPrice))
            ->when($this->minBedrooms, fn($query) => $query->withBedrooms($this->minBedrooms))
            ->when($this->featuredOnly, fn($query) => $query->featured())
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(6);
    }
   #[Computed]
   public function propertyTypes(){
    return Property::getPropertyTypes();

   }
   #[Computed]
   public function listingTypes(){
    return Property::getListingTypes();

   }
   #[Computed]
   public function cities(){
    return Property::query()->available()->select('city')->distinct()->orderBy('city')->pluck('city');

   }

    public function render()
    {
        return view('livewire.components.property-listing',[
            'properties'=>$this->properties(),
            'propertyTypes'=>$this->propertyTypes(),
            'listingTypes'=>$this->listingTypes(),
            'cities'=>$this->cities(),
            'search'=>$this->search,
            'type'=>$this->type,
            'listingType'=>$this->listingType,
            'city'=>$this->city,
            'minPrice'=>$this->minPrice,
            'maxPrice'=>$this->maxPrice,
            'minBedrooms'=>$this->minBedrooms,
            'featuredOnly'=>$this->featuredOnly


        ]);
    }
}
