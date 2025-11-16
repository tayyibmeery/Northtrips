<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ItineraryTemplate;
use App\Models\ItineraryDay;
use Carbon\Carbon;

class EidSpecialSeeder extends Seeder
{
    public function run()
    {
        $template = ItineraryTemplate::create([
            'name' => 'Eid Special 2025 - Skardu & Basho Valley',
            'title' => 'Eid Special 2025 - Summer Special Trip Toward Khaplu Baltistan',
            'subtitle' => '7 DAYS TRIP TO SKARDU & BASHO / DEOSAI THE LAND OF GIANTS',
            'trip_code' => 'EID-001',
            'season' => 'eid_special',
            'duration_days' => 7,
            'duration_nights' => 6,
            'description' => 'A comprehensive 7-day tour exploring the majestic landscapes of Skardu, Shigar, Mantokha, and either Basho Valley or Deosai Plains. Experience the beauty of Shangrilla Resort, Upper Kachura Lake, Cold Desert, and the historical Thoksikhar Palace.',
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
            'payment_terms' => "50% advance payment required for booking\nRemaining payment at time of departure\nSend payment screenshot via WhatsApp with names and CNIC numbers\nBank: Soneri Bank LTD - ASIF KALEEM - 20002740002\nEasyPaisa: 0343-1428730",
            'cancellation_policy' => "50% refund if cancelled 7+ days before event\n30% refund if cancelled 4+ days before event\n0% refund if cancelled less than 2 days before event\nNo refunds for natural disasters or unforeseen circumstances",
            'terms_conditions' => "Participants must carry original CNIC\nStrict ethical conduct - zero tolerance for drugs/weapons\nInform about participants below 10 or above 50 years\nNotify about special medical requirements\nParticipants responsible for their valuables\nRoute may change due to weather/road conditions\nCompany reserves right to alter itinerary for safety",
            'featured' => true,
            'is_active' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Create itinerary days
        $days = [
            [
                'day_number' => 0,
                'title' => 'Departure from Lahore to Islamabad',
                'description' => 'Meet and greet guests. Departure from Lahore towards Islamabad with short stay at Bhera/Mian G. Reach Islamabad for overnight stay.',
                'activities' => 'Travel, Briefing',
                'meals' => 'None',
                'accommodation' => 'Travel in coach',
                'order' => 0
            ],
            [
                'day_number' => 1,
                'title' => 'Islamabad to Chilas via Naran/Babusar Top',
                'description' => 'Pick participants from Islamabad. Move towards Balakot for breakfast. Continue drive towards Chilas via Besar Naran. Visit Lalusar Lake & Babusar Top. Reach Chilas for dinner and overnight stay.',
                'activities' => 'Sightseeing, Photography',
                'meals' => 'Breakfast, Dinner',
                'accommodation' => 'Hotel in Chilas',
                'order' => 1
            ],
            [
                'day_number' => 2,
                'title' => 'Chilas to Skardu via Juglot & Stak Nala',
                'description' => 'Breakfast at hotel. Move towards Skardu valley. Stop at Nanga Parbat viewpoint and mountain junction point. Visit Shangrilla Resort and Upper Kachura Lake. Reach Skardu and transfer to hotel.',
                'activities' => 'Sightseeing, Photography, Lake Visit',
                'meals' => 'Breakfast, Dinner',
                'accommodation' => 'Hotel in Skardu',
                'order' => 2
            ],
            [
                'day_number' => 3,
                'title' => 'Skardu - Manthokha Waterfall - Shigar Valley',
                'description' => 'Breakfast at hotel. Visit Manthokha Waterfall, Mehdiabad Valley, and Sermik Valley. Explore Shigar Valley including Cold Desert, Shigar Fort, and Amburiq Mosque. Return to hotel for bonfire and overnight stay.',
                'activities' => 'Waterfall Visit, Fort Exploration, Desert Experience',
                'meals' => 'Breakfast, Dinner',
                'accommodation' => 'Hotel in Skardu',
                'order' => 3
            ],
            [
                'day_number' => 4,
                'title' => 'Basho Valley / Deosai National Park Excursion',
                'description' => 'Breakfast at hotel. Full day excursion to either Basho Valley or Deosai National Park. Visit suspension bridge, waterfall, Heart Rock, Camel Rock, Basho River and forest. Return to Skardu for overnight stay.',
                'activities' => 'Valley Exploration, Photography, Nature Walk',
                'meals' => 'Breakfast, Dinner',
                'accommodation' => 'Hotel in Skardu',
                'order' => 4
            ],
            [
                'day_number' => 5,
                'title' => 'Skardu to Naran via Babusar Top',
                'description' => 'Breakfast at hotel. Departure towards Naran. Stopover at Astak Nala and Besar Naran. Visit Babusar Top. Reach Naran for dinner and overnight stay.',
                'activities' => 'Travel, Sightseeing',
                'meals' => 'Breakfast, Dinner',
                'accommodation' => 'Hotel in Naran',
                'order' => 5
            ],
            [
                'day_number' => 6,
                'title' => 'Naran to Lahore/Islamabad',
                'description' => 'Breakfast at hotel. Optional visit to Saif-ul-Malook Lake if time allows. Departure towards home with short stay at Kiwai waterfall. Lunch at Abbottabad or Islamabad. Arrival at Islamabad 07:00 PM, Lahore 11:30 PM.',
                'activities' => 'Travel, Optional Lake Visit',
                'meals' => 'Breakfast',
                'accommodation' => 'None - End of services',
                'order' => 6
            ]
        ];

        foreach ($days as $day) {
            $template->days()->create($day);
        }

        $this->command->info('✅ Eid Special 2025 itinerary seeded successfully!');
    }
}
