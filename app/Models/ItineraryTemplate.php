<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItineraryTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'subtitle',
        'trip_code',
        'season',
        'duration_days',
        'duration_nights',
        'description',
        'selected_included_services',
        'selected_excluded_services',
        'selected_experience_highlights',
        'selected_important_information',
        'selected_quick_facts',
        'pricing_options',
        'payment_terms',
        'cancellation_policy',
        'terms_conditions',
        'is_active',
        'featured',
        'cover_image',
        'pdf_template'
    ];

    protected $casts = [
        'selected_included_services' => 'array',
        'selected_excluded_services' => 'array',
        'selected_experience_highlights' => 'array',
        'selected_important_information' => 'array',
        'selected_quick_facts' => 'array',
        'pricing_options' => 'array',
        'is_active' => 'boolean',
        'featured' => 'boolean',
    ];

    /**
     * Get the itinerary days for the template
     */
    public function days()
    {
        return $this->hasMany(ItineraryDay::class)->orderBy('day_number');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeBySeason($query, $season)
    {
        return $query->where('season', $season);
    }

    public function getSeasonBadgeAttribute()
    {
        $badges = [
            'summer' => 'badge bg-warning',
            'winter' => 'badge bg-info',
            'spring' => 'badge bg-success',
            'autumn' => 'badge bg-orange',
            'year_round' => 'badge bg-secondary',
            'eid_special' => 'badge bg-danger'
        ];

        return $badges[$this->season] ?? 'badge bg-secondary';
    }

    public function generateTripCode()
    {
        $prefix = strtoupper(substr($this->season, 0, 3));
        $number = static::where('season', $this->season)->count() + 1;
        return $prefix . '-' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }

    // Helper methods to get related data
    public function getIncludedServicesData()
    {
        if (!$this->selected_included_services) return collect();
        return IncludedService::whereIn('id', $this->selected_included_services)
            ->active()
            ->ordered()
            ->get();
    }

    public function getExcludedServicesData()
    {
        if (!$this->selected_excluded_services) return collect();
        return ExcludedService::whereIn('id', $this->selected_excluded_services)
            ->active()
            ->ordered()
            ->get();
    }

    public function getExperienceHighlightsData()
    {
        if (!$this->selected_experience_highlights) return collect();
        return ExperienceHighlight::whereIn('id', $this->selected_experience_highlights)
            ->active()
            ->ordered()
            ->get();
    }

    public function getImportantInformationData()
    {
        if (!$this->selected_important_information) return collect();
        return ImportantInformation::whereIn('id', $this->selected_important_information)
            ->active()
            ->ordered()
            ->get();
    }

    public function getQuickFactsData()
    {
        if (!$this->selected_quick_facts) return collect();
        return QuickFact::whereIn('id', $this->selected_quick_facts)
            ->active()
            ->ordered()
            ->get();
    }


    
}
