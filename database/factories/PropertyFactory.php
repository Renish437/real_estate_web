<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       
            //
        $faker = FakerFactory::create('en_US');

        // Predefined Nepali data sets
        $nepaliCities = [
            'Kathmandu', 'Lalitpur', 'Bhaktapur', 'Pokhara', 'Biratnagar',
            'Birgunj', 'Bharatpur', 'Butwal', 'Dharan', 'Hetauda',
            'Nepalgunj', 'Janakpur', 'Itahari', 'Dhangadhi', 'Birtamod'
        ];

        $nepaliStates = [
            'Province 1', 'Madhesh Province', 'Bagmati Province',
            'Gandaki Province', 'Lumbini Province', 'Karnali Province', 'Sudurpashchim Province'
        ];

        $nepaliAddresses = [
            'Putalisadak', 'Baneshwor', 'Satdobato', 'Jawalakhel', 'Lakeside', 
            'New Road', 'Boudha', 'Kumaripati', 'Durbarmarg', 'Sundhara',
            'Chakrapath', 'Kuleshwor', 'Thamel', 'Kalanki', 'Koteshwor'
        ];

        $title = $faker->randomElement([
            'Luxury Apartment in Kathmandu',
            'Modern Family House in Lalitpur',
            'Cozy Villa near Pokhara Lake',
            'Commercial Space in New Baneshwor',
            'Spacious Land for Sale in Bhaktapur',
            'Affordable Flat for Rent in Butwal',
            'Elegant Townhouse in Bharatpur',
        ]);

        $type = $faker->randomElement(['apartment', 'house', 'condo', 'land', 'townhouse', 'villa', 'commercial']);
        $listingType = $faker->randomElement(['sale', 'rent']);
        $status = $faker->randomElement(['available', 'sold', 'pending', 'draft', 'rented']);
        $price = $faker->randomFloat(2, 5000000, 100000000); // 50 lakh – 10 crore
        $totalArea = $faker->numberBetween(500, 5000);

        return [
            // Basic Info
            'title' => $title,
            'slug' => Str::slug($title) . '-' . Str::random(5),
            'description' => $faker->paragraphs(3, true),
            'type' => $type,
            'listing_type' => $listingType,
            'status' => $status,

            // Pricing
            'price' => $price,
            'price_per_sqft' => round($price / $totalArea, 2),

            // Location (Nepali context)
            'address' => $faker->randomElement($nepaliAddresses),
            'state' => $faker->randomElement($nepaliStates),
            'city' => $faker->randomElement($nepaliCities),
            'country' => 'Nepal',
            'postal_code' => $faker->postcode(),
            'latitude' => $faker->latitude(26.0, 30.0),
            'longitude' => $faker->longitude(80.0, 88.5),

            // Property Details
            'bedrooms' => $faker->numberBetween(1, 6),
            'bathrooms' => $faker->numberBetween(1, 5),
            'hall' => $faker->numberBetween(0, 2),
            'other_rooms_count' => $faker->numberBetween(0, 3),
            'total_area' => $totalArea,
            'built_year' => $faker->year(),
            'furnished' => $faker->boolean(),
            'parking' => $faker->boolean(),
            'parking_spaces' => $faker->numberBetween(0, 3),

            // JSON fields
            'features' => json_encode($faker->randomElements([
                '24-hour Security', 'Private Garden', 'Swimming Pool', 'Balcony',
                'Backup Generator', 'Solar Panel', 'Gym', 'CCTV Surveillance'
            ], $faker->numberBetween(2, 5))),
            'images' => json_encode([
                $faker->imageUrl(800, 600, 'real-estate', true, 'Property'),
                $faker->imageUrl(800, 600, 'interior', true, 'Interior'),
                $faker->imageUrl(800, 600, 'architecture', true, 'Exterior'),
            ]),

            // SEO
            'meta_title' => $title,
            'meta_description' => $faker->sentence(15),

            // Visibility
            'is_featured' => $faker->boolean(25),
            'is_active' => $faker->boolean(95),
            'featured_until' => $faker->optional()->dateTimeBetween('now', '+45 days'),

            // Contact Info
            'contact_name' => $faker->name(),
            'contact_phone' => '+977-' . $faker->numberBetween(9800000000, 9899999999),
            'contact_email' => $faker->safeEmail(),
        ];
    }
}
