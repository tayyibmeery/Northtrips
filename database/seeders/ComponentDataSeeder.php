<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\IncludedService;
use App\Models\ExcludedService;
use App\Models\ExperienceHighlight;
use App\Models\ImportantInformation;
use App\Models\QuickFact;

class ComponentDataSeeder extends Seeder
{
    public function run()
    {
        // Start transaction for better error handling
        DB::beginTransaction();

        try {
            // Included Services
            $includedServices = [
                ['title' => 'Luxury AC Transportation', 'description' => 'Grand Cabin/Coaster with experienced driver', 'icon' => '🚐', 'order' => 1],
                ['title' => 'Premium Hotel Accommodations', 'description' => 'Quality hotels with all basic amenities', 'icon' => '🏨', 'order' => 2],
                ['title' => 'Quality Meals', 'description' => 'Breakfast & Dinner included daily', 'icon' => '🍽️', 'order' => 3],
                ['title' => 'Professional Tour Guide', 'description' => 'Experienced local guide throughout the trip', 'icon' => '👨‍💼', 'order' => 4],
                ['title' => 'All Toll Taxes & Fuel', 'description' => 'All road taxes and fuel expenses covered', 'icon' => '⛽', 'order' => 5],
                ['title' => 'First Aid Medical Kit', 'description' => 'Basic first aid and medical assistance', 'icon' => '🩹', 'order' => 6],
                ['title' => 'Bonfire with Music', 'description' => 'Evening bonfire with musical entertainment', 'icon' => '🔥', 'order' => 7],
                ['title' => 'All Scheduled Sightseeing', 'description' => 'All planned sightseeing and activities', 'icon' => '🏞️', 'order' => 8],
            ];

            foreach ($includedServices as $service) {
                IncludedService::create($service);
            }

            $this->command->info('✅ Included Services seeded successfully!');

            // Excluded Services
            $excludedServices = [
                ['title' => 'Personal Expenses', 'description' => 'Shopping, souvenirs, and personal items', 'icon' => '🛍️', 'order' => 1],
                ['title' => 'Extra Meals & Beverages', 'description' => 'Lunch and additional food/drinks', 'icon' => '🥤', 'order' => 2],
                ['title' => 'Travel Insurance', 'description' => 'Medical and travel insurance coverage', 'icon' => '📄', 'order' => 3],
                ['title' => 'Optional Activity Charges', 'description' => 'Extra activities not in itinerary', 'icon' => '🎯', 'order' => 4],
                ['title' => 'Entry Fees & Permits', 'description' => 'Museum entries and special permits', 'icon' => '🎫', 'order' => 5],
                ['title' => '4x4 Jeep & Special Transport', 'description' => 'Off-road and special vehicle charges', 'icon' => '🚙', 'order' => 6],
            ];

            foreach ($excludedServices as $service) {
                ExcludedService::create($service);
            }

            $this->command->info('✅ Excluded Services seeded successfully!');

            // Experience Highlights
            $highlights = [
                ['title' => 'Majestic Mountain Views', 'description' => 'Breathtaking views of Himalayan ranges', 'icon' => '🏔️', 'order' => 1],
                ['title' => 'Crystal Clear Lakes', 'description' => 'Visit to pristine high-altitude lakes', 'icon' => '🏞️', 'order' => 2],
                ['title' => 'Cultural Immersion', 'description' => 'Experience local culture and traditions', 'icon' => '🎎', 'order' => 3],
                ['title' => 'Adventure Activities', 'description' => 'Trekking, hiking, and outdoor adventures', 'icon' => '🥾', 'order' => 4],
                ['title' => 'Photography Opportunities', 'description' => 'Stunning landscapes for photography', 'icon' => '📸', 'order' => 5],
                ['title' => 'Local Cuisine', 'description' => 'Authentic local food experiences', 'icon' => '🍲', 'order' => 6],
            ];

            foreach ($highlights as $highlight) {
                ExperienceHighlight::create($highlight);
            }

            $this->command->info('✅ Experience Highlights seeded successfully!');

            // Important Information
            $importantInfo = [
                ['title' => 'Valid CNIC/Passport Required', 'description' => 'Must carry original identification document', 'icon' => '🆔', 'order' => 1],
                ['title' => 'Advance Booking Required', 'description' => '30-50% advance payment for reservation', 'icon' => '💰', 'order' => 2],
                ['title' => 'Ethical Code of Conduct', 'description' => 'Strict adherence to company policies', 'icon' => '⚖️', 'order' => 3],
                ['title' => 'Zero Tolerance Policy', 'description' => 'No drugs, alcohol, or weapons allowed', 'icon' => '🚫', 'order' => 4],
                ['title' => 'Weather Contingency', 'description' => 'Plans may change due to weather conditions', 'icon' => '🌦️', 'order' => 5],
                ['title' => 'Health Considerations', 'description' => 'Inform about medical conditions in advance', 'icon' => '❤️', 'order' => 6],
            ];

            foreach ($importantInfo as $info) {
                ImportantInformation::create($info);
            }

            $this->command->info('✅ Important Information seeded successfully!');

            // Quick Facts
            $quickFacts = [
                ['fact' => 'Group Size', 'value' => '12-25 Travelers', 'icon' => '👥', 'order' => 1],
                ['fact' => 'Difficulty Level', 'value' => 'Moderate', 'icon' => '⚡', 'order' => 2],
                ['fact' => 'Best For', 'value' => 'Adventure Enthusiasts', 'icon' => '🌟', 'order' => 3],
                ['fact' => 'Age Group', 'value' => '15-55 Years', 'icon' => '🎂', 'order' => 4],
                ['fact' => 'Experience', 'value' => 'Professional Guides', 'icon' => '🎓', 'order' => 5],
                ['fact' => 'Support', 'value' => '24/7 Customer Care', 'icon' => '📞', 'order' => 6],
            ];

            foreach ($quickFacts as $fact) {
                QuickFact::create($fact);
            }

            $this->command->info('✅ Quick Facts seeded successfully!');

            // Commit transaction
            DB::commit();

            $this->command->info('🎉 All component data seeded successfully!');

        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();
            $this->command->error('❌ Seeding failed: ' . $e->getMessage());
            throw $e;
        }
    }
}
