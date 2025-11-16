<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ItineraryTemplate;
use App\Models\ItineraryDay;
use Carbon\Carbon;

class ShogranTripSeeder extends Seeder
{
    public function run()
    {
        $template = ItineraryTemplate::create([
            'name' => '2 Days Trip Towards Shogran',
            'title' => '2 Days Trip Towards Shogran',
            'subtitle' => 'Quick Getaway to Beautiful Meadows',
            'trip_code' => 'SUM-002',
            'season' => 'summer',
            'duration_days' => 2,
            'duration_nights' => 1,
            'description' => 'A short and sweet escape to the breathtaking meadows of Shogran and Siri Paye. Perfect for those looking for a quick break from city life with comfortable transportation and accommodation.',
            'selected_included_services' => [1, 2, 3, 4, 5, 6, 7],
            'selected_excluded_services' => [1, 2, 4],
            'selected_experience_highlights' => [1, 2, 4, 5],
            'selected_important_information' => [1, 2, 5],
            'selected_quick_facts' => [1, 2, 4],
            'pricing_options' => [
                'standard_solo' => 11000,
                'standard_couple' => 25000,
                'without_jeep_solo' => 14000,
                'without_jeep_quad' => 16500
            ],
            'payment_terms' => "Advance payment required\nSend screenshot with participant details",
            'cancellation_policy' => "Standard company cancellation policy applies",
            'terms_conditions' => "Plan can be changed for participant comfort\nItinerary can be altered due to circumstances\nFollow safety guidelines",
            'featured' => false,
            'is_active' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Create itinerary days
        $days = [
            [
                'day_number' => 1,
                'title' => 'Departure - Shogran - Siri Paye',
                'description' => 'Reporting time at 09:00 PM, departure from Lahore at 10:00 PM via Motorway. Breakfast at Balakot/Kiwai/Shogran 07:00-10:00 AM. Transfer to jeep for Shogran. Trekking to Siri Paye, stay for 1 hour. Return to Shogran for dinner, bonfire, and overnight stay.',
                'activities' => 'Trekking, Photography, Bonfire',
                'meals' => 'Breakfast, Dinner',
                'accommodation' => 'Hotel in Shogran',
                'order' => 1
            ],
            [
                'day_number' => 2,
                'title' => 'Sharan Forest - Return Journey',
                'description' => 'Wake up at 08:00 AM. Transfer to jeep for Sharan Forest. Full day excursion at Sharan Forest. Optional camping at Sharan Forest. Return journey with breakfast at Kiwai waterfall or Shogran hotel. Short stay at Kiwai Waterfall. Optional visit to Khanpur Dam. Way back to Islamabad/Lahore.',
                'activities' => 'Forest Exploration, Photography, Optional Camping',
                'meals' => 'Breakfast',
                'accommodation' => 'None - End of services',
                'order' => 2
            ]
        ];

        foreach ($days as $day) {
            $template->days()->create($day);
        }

        $this->command->info('✅ 2 Days Shogran itinerary seeded successfully!');
    }
}
