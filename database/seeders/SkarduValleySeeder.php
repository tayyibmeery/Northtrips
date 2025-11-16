<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ItineraryTemplate;
use App\Models\ItineraryDay;
use Carbon\Carbon;

class SkarduValleySeeder extends Seeder
{
    public function run()
    {
        $template = ItineraryTemplate::create([
            'name' => '6 Days Trip to Naran Kaghan Skardu Valley',
            'title' => '6 Days Trip to Naran Kaghan Skardu Valley',
            'subtitle' => 'Shangrilla, Manthokha Waterfall, Basho Valley / Deosai NP Baltistan',
            'trip_code' => 'SUM-003',
            'season' => 'summer',
            'duration_days' => 6,
            'duration_nights' => 5,
            'description' => 'An extended adventure combining the beauty of Kaghan Valley with the grandeur of Skardu, Baltistan. Explore Shangrilla Resort, Upper Kachura Lake, Katpana Desert, Shigar Fort, and the majestic Basho Valley or Deosai National Park.',
            'selected_included_services' => [1, 2, 3, 4, 5, 6, 7, 8],
            'selected_excluded_services' => [1, 2, 3, 4, 5, 6],
            'selected_experience_highlights' => [1, 2, 3, 4, 5, 6],
            'selected_important_information' => [1, 2, 3, 4, 5, 6],
            'selected_quick_facts' => [1, 2, 3, 4, 5, 6],
            'pricing_options' => [
                'standard_solo' => 28499,
                'standard_couple' => 69999,
                'deluxe_solo' => 39999,
                'deluxe_couple' => 99999,
                'premium_solo' => 49999,
                'premium_couple' => 99999
            ],
            'payment_terms' => "30-50% advance payment required\nBank: Soneri Bank LTD - ASIF KALEEM - 20002740002\nEasyPaisa: 0343-1428730\nSend screenshot with CNIC details",
            'cancellation_policy' => "Standard company cancellation policy applies",
            'terms_conditions' => "Zero tolerance for drugs/intoxication\nCompany reserves right to cancel trip with full refund\nItinerary may change due to weather/politics/transport\nSmoking prohibited in transport\nValid CNIC/Passport required\nNon-slippery shoes recommended\nNot responsible for personal injury/loss/damage",
            'featured' => true,
            'is_active' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Create itinerary days
        $days = [
            [
                'day_number' => 0,
                'title' => 'Lahore to Islamabad',
                'description' => 'Meet and greet guests. Departure from Lahore towards Islamabad with short stay at Bhera/Mian G. Reach Islamabad for the night.',
                'activities' => 'Travel, Briefing',
                'meals' => 'None',
                'accommodation' => 'Travel in coach',
                'order' => 0
            ],
            [
                'day_number' => 1,
                'title' => 'Islamabad to Chilas via Naran',
                'description' => 'Pick participants from Islamabad. Move towards Balakot for breakfast. Continue drive towards Chilas via Besar Naran. Visit Lalusar Lake & Babusar Top. Reach Chilas for dinner and overnight stay.',
                'activities' => 'Sightseeing, Mountain Views',
                'meals' => 'Breakfast, Dinner',
                'accommodation' => 'Hotel in Chilas',
                'order' => 1
            ],
            [
                'day_number' => 2,
                'title' => 'Chilas to Skardu via Juglot',
                'description' => 'Breakfast at hotel. Move towards Skardu valley. Stop at Nanga Parbat viewpoint and mountain junction point. Visit Shangrilla Resort and Upper Kachura Lake. Reach Skardu and transfer to hotel.',
                'activities' => 'Lake Visit, Resort Exploration',
                'meals' => 'Breakfast, Dinner',
                'accommodation' => 'Hotel in Skardu',
                'order' => 2
            ],
            [
                'day_number' => 3,
                'title' => 'Skardu - Manthokha Waterfall - Shigar Valley',
                'description' => 'Breakfast at hotel. Visit Manthokha Waterfall, Mehdiabad Valley, and Sermik Valley. Explore Shigar Valley including Cold Desert, Shigar Fort, and Amburiq Mosque. Return to hotel for bonfire.',
                'activities' => 'Waterfall, Fort, Desert Exploration',
                'meals' => 'Breakfast, Dinner',
                'accommodation' => 'Hotel in Skardu',
                'order' => 3
            ],
            [
                'day_number' => 4,
                'title' => 'Basho Valley / Deosai National Park',
                'description' => 'Breakfast at hotel. Full day excursion to Basho Valley or Deosai National Park. Visit suspension bridge, waterfall, Heart Rock, Camel Rock, and Basho Forest. Alternatively explore Sheosar Lake in Deosai. Return to Skardu.',
                'activities' => 'Valley Exploration, Photography',
                'meals' => 'Breakfast, Dinner',
                'accommodation' => 'Hotel in Skardu',
                'order' => 4
            ],
            [
                'day_number' => 5,
                'title' => 'Skardu to Naran',
                'description' => 'Breakfast at hotel. Departure towards Naran. Stopover at Astak Nala. Continue drive with short stay at Babusar Top & Besar Naran. Reach Naran for dinner and overnight stay.',
                'activities' => 'Travel, Sightseeing',
                'meals' => 'Breakfast, Dinner',
                'accommodation' => 'Hotel in Naran',
                'order' => 5
            ],
            [
                'day_number' => 6,
                'title' => 'Naran to Home via Saif-ul-Malook',
                'description' => 'Breakfast at hotel. Optional visit to Saif-ul-Malook Lake if time allows. Departure towards home with short stay at Kiwai waterfall. Travel all day towards Islamabad/Lahore. Drop guests at respective points.',
                'activities' => 'Optional Lake Visit, Travel',
                'meals' => 'Breakfast',
                'accommodation' => 'None - End of services',
                'order' => 6
            ]
        ];

        foreach ($days as $day) {
            $template->days()->create($day);
        }

        $this->command->info('✅ 6 Days Skardu Valley itinerary seeded successfully!');
    }
}
