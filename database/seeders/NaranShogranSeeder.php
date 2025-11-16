<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ItineraryTemplate;
use App\Models\ItineraryDay;
use Carbon\Carbon;

class NaranShogranSeeder extends Seeder
{
    public function run()
    {
        $template = ItineraryTemplate::create([
            'name' => '3 Days Trip to Naran - Shogran - Saif-ul-Malook',
            'title' => '3 Days Trip to Naran - Shogran - Saif-ul-Malook Lake',
            'subtitle' => 'Females | Families | Bachelors | Couples All Are Invited',
            'trip_code' => 'SUM-001',
            'season' => 'summer',
            'duration_days' => 3,
            'duration_nights' => 2,
            'description' => 'A perfect weekend getaway to the beautiful valleys of Naran, Shogran, and the magical Saif-ul-Malook Lake. Experience the stunning landscapes of Kaghan Valley with comfortable accommodation and quality meals.',
            'selected_included_services' => [1, 2, 3, 4, 5, 6, 7],
            'selected_excluded_services' => [1, 2, 3, 4],
            'selected_experience_highlights' => [1, 2, 4, 5],
            'selected_important_information' => [1, 2, 3, 5],
            'selected_quick_facts' => [1, 2, 3, 4],
            'pricing_options' => [
                'standard_solo' => 16500,
                'standard_couple' => 34999,
                'deluxe_solo' => 19500,
                'deluxe_couple' => 39999
            ],
            'payment_terms' => "50% advance payment required\nRemaining payment at time of departure\nRegistration deadline: 5 days before departure",
            'cancellation_policy' => "Standard company cancellation policy applies",
            'terms_conditions' => "Itinerary may change for participant comfort or due to circumstances\nParticipants responsible for personal belongings\nFollow guide instructions for safety",
            'featured' => true,
            'is_active' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Create itinerary days
        $days = [
            [
                'day_number' => 0,
                'title' => 'Departure from Lahore',
                'description' => '10:00 PM departure from Lahore towards northern areas.',
                'activities' => 'Travel',
                'meals' => 'None',
                'accommodation' => 'Travel in coach',
                'order' => 0
            ],
            [
                'day_number' => 1,
                'title' => 'Islamabad Pickup - Balakot - Shogran - Naran - Saif-ul-Malook',
                'description' => 'Pickup from Islamabad at 03:00 AM. Breakfast in Balakot. Short stay at Kiwai Waterfall. Visit Shogran & Siri Paye (optional). Arrival in Naran. Departure for Saif-ul-Malook Lake. Return to Naran for dinner and overnight stay.',
                'activities' => 'Waterfall Visit, Lake Exploration, Sightseeing',
                'meals' => 'Breakfast, Dinner',
                'accommodation' => 'Hotel in Naran',
                'order' => 1
            ],
            [
                'day_number' => 2,
                'title' => 'Babusar Top - Lalusar Lake - Kunhar River',
                'description' => 'Breakfast at hotel. Departure for Babusar Top. Visit Batakundi and Lalusar Lake. Full day excursion at Babusar side. Return to Naran. Optional rafting at Kunhar River. BBQ dinner and overnight stay.',
                'activities' => 'Mountain Exploration, Photography, Optional Rafting',
                'meals' => 'Breakfast, BBQ Dinner',
                'accommodation' => 'Hotel in Naran',
                'order' => 2
            ],
            [
                'day_number' => 3,
                'title' => 'Return to Lahore/Islamabad',
                'description' => 'Breakfast at hotel. Departure for Lahore at 10:00 AM. Short stay at Kiwai waterfall. Lunch at Abbottabad or Islamabad. Arrival at Islamabad 07:00 PM, Lahore 11:30 PM.',
                'activities' => 'Travel, Sightseeing',
                'meals' => 'Breakfast',
                'accommodation' => 'None - End of services',
                'order' => 3
            ]
        ];

        foreach ($days as $day) {
            $template->days()->create($day);
        }

        $this->command->info('✅ 3 Days Naran-Shogran itinerary seeded successfully!');
    }
}
