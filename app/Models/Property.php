<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Property extends Model
{
    use HasFactory;
    //
    protected $fillable = [
    'title',
    'slug',
    'description',
    'type',
    'listing_type',
    'status',
    'price',
    'price_per_sqft',
    'address',
    'state',
    'city',
    'country',
    'postal_code',
    'latitude',
    'longitude',
    'bedrooms',
    'bathrooms',
    'hall',
    'other_rooms_count',
    'total_area',
    'built_year',
    'furnished',
    'parking',
    'parking_spaces',
    'features',
    'images',
    'meta_title',
    'meta_description',
    'is_featured',
    'is_active',
    'featured_until',
    'contact_name',
    'contact_phone',
    'contact_email',
];
protected $casts = [
    'features' => 'array',
    'images' => 'array',
    'furnished' => 'boolean',
    'hall' => 'boolean',
    'parking' => 'boolean',
    'is_featured' => 'boolean',
    'is_active' => 'boolean',
    'featured_until' => 'datetime',
    'price'=>'decimal:2',
    'price_per_sqft'=>'decimal:2',
    'latitude'=>'decimal:8',
    'longitude'=>'decimal:8' 
];

public function enquires(){
    return $this->hasMany(Enquiry::class);
}

public function getRouteKeyName()
{
    return 'slug';
}
//scopes

#[Scope]
public function available(Builder $query){
  return $query->where('status','available')->where('is_active',true);
}
#[Scope]
public function forSale(Builder $query){
    return $query->where('listing_type','sale');
}
#[Scope]
public function forRent(Builder $query){
    return $query->where('listing_type','rent');
}
#[Scope]
public function featured(Builder $query){
    return $query->where('is_featured',true)->where('is_active',true)->where('featured_until','>=',now());
}
#[Scope]
public function inCity(Builder $query,string $city){
    return $query->where('city','like',"%$city%");
}
#[Scope]
public function priceBetween(Builder $query,$min,$max){
    return $query->whereBetween('price',[$min,$max]);
}
#[Scope]
public function byType(Builder $query,string $type){
    return $query->whereBetween('type',$type);
}
#[Scope]
public function withBedrooms(Builder $query,int $bedrooms){
    return $query->whereBetween('bedrooms','>=',$bedrooms);
}


// Accessor
public function getFormattedPriceAttribute():string{
    return 'NPR'.number_format($this->price,0);
}
public function getFullAddressAttribute():string{
    return "$this->address, $this->city, $this->state, $this->country";
}

public function getMainImageAttribute(): ?string{
    $images= $this->images;
    return $images && count($images)>0?$images[0]:null;
}
public function getImageUrlAttribute()
{
    $mainImage = $this->main_image;
    return $mainImage ? Storage::url($mainImage) : null;
}
public function getStatusColorAttribute():string{
    return match($this->status){
        'available'=>'success',
        'sold'=>'danger',
        'rented'=>'warning',
        'pending'=>'info',
        'draft'=>'secondary',
        default=>'secondary'
    };

}
 public function getTypeIconAttribute()
    {
        return match ($this->type) {
            'apartment'  => '🏢',
            'house'      => '🏠',
            'condo'      => '🏬',
            'land'       => '🌄',
            'townhouse'  => '🏘️',
            'villa'      => '🏡',
            'commercial' => '🏭',
            default      => '🏚️', // fallback
        };
    }

    // Helper methods
    public function isFeatured():bool{
        if(!$this->is_featured){
            return false;
        }
        return !$this->featured_until || $this->featured_until->isFuture();
    }
    public function isAvailable():bool{
        return $this->status =='available' && $this->is_active;
    }
    public function calculatePricePerSqft():void{
        if($this->total_area && $this->total_area>0){
            $this->price_per_sqft = $this->price / $this->total_area;
            $this->save();
        }
    }

    public function addFeature(string $feature):void{
        $features = $this->features ?? [];
        if(!in_array($feature,$features)){
            $features[]=$feature;
            $this->features = $features;
            $this->save();

        }
    }
    public function removeFeature(string $feature):void{
        $features = $this->features ?? [];
        $this->features = array_values(array_diff($features,[$feature]));
        $this->save();

    }
    public function hasFeature(string $feature):bool
    {
        return in_array($feature,$this->features ?? []);
    }
    //   public static function getPropertyTypes(): array
    // {
    //     return [
    //         'apartment'  => ['label' => 'Apartment',  'icon' => '🏢'],
    //         'house'      => ['label' => 'House',      'icon' => '🏠'],
    //         'condo'      => ['label' => 'Condo',      'icon' => '🏬'],
    //         'land'       => ['label' => 'Land',       'icon' => '🌄'],
    //         'townhouse'  => ['label' => 'Townhouse',  'icon' => '🏘️'],
    //         'villa'      => ['label' => 'Villa',      'icon' => '🏡'],
    //         'commercial' => ['label' => 'Commercial', 'icon' => '🏭'],
    //     ];
    // }
 public static function getPropertyTypes(): array
{
    return [
        'apartment'  => 'Apartment',
        'house'      => 'House',
        'condo'      => 'Condo',
        'land'       => 'Land',
        'townhouse'  => 'Townhouse',
        'villa'      => 'Villa',
        'commercial' => 'Commercial',
    ];
}
public static function getListingTypes():array{
    return [
        'sale'=>'For Sale',
        'rent'=>'For Rent'
    ];
}
public static function getStatuses(): array
{
    return [
        'available' => 'Available',
        'sold'      => 'Sold',
        'pending'   => 'Pending',
        'draft'     => 'Draft',
        'rented'    => 'Rented',
    ];
}


public function getDescription(): string
{
    return $this->description;
}





}
