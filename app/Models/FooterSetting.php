<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_links',
        'support_links',
        'payment_methods',
        'languages',
        'currencies',
        'default_language',
        'default_currency',
        'copyright_text',
        'show_designer_credit',
        'show_back_to_top',
    ];

    protected $casts = [
        'company_links' => 'array',
        'support_links' => 'array',
        'payment_methods' => 'array',
        'languages' => 'array',
        'currencies' => 'array',
        'show_designer_credit' => 'boolean',
        'show_back_to_top' => 'boolean',
    ];

    /**
     * Get default footer settings or create if not exists
     */
    public static function getSettings()
    {
        $settings = self::first();

        if (!$settings) {
            $settings = self::createDefaultSettings();
        } else {
            // Ensure arrays are properly cast
            $settings->ensureArrayFields();
        }

        return $settings;
    }

    /**
     * Ensure all array fields are properly cast
     */
    public function ensureArrayFields()
    {
        $arrayFields = ['company_links', 'support_links', 'payment_methods', 'languages', 'currencies'];

        foreach ($arrayFields as $field) {
            if (is_string($this->$field)) {
                $this->$field = json_decode($this->$field, true) ?? [];
            } elseif (is_null($this->$field)) {
                $this->$field = [];
            }
        }
    }

    /**
     * Create default footer settings
     */
    public static function createDefaultSettings()
    {
        $defaultCompanyLinks = [
            ['name' => 'About', 'url' => '/about'],
            ['name' => 'Careers', 'url' => '/careers'],
            ['name' => 'Blog', 'url' => '/blog'],
            ['name' => 'Press', 'url' => '/press'],
            ['name' => 'Gift Cards', 'url' => '/gift-cards'],
            ['name' => 'Magazine', 'url' => '/magazine'],
        ];

        $defaultSupportLinks = [
            ['name' => 'Contact', 'url' => '/contact'],
            ['name' => 'Legal Notice', 'url' => '/legal'],
            ['name' => 'Privacy Policy', 'url' => '/privacy-policy'],
            ['name' => 'Terms and Conditions', 'url' => '/terms'],
            ['name' => 'Sitemap', 'url' => '/sitemap'],
            ['name' => 'Cookie policy', 'url' => '/cookie-policy'],
        ];

        $defaultPaymentMethods = ['visa', 'mastercard', 'amex', 'paypal', 'discover', 'apple_pay'];

        $defaultLanguages = [
            ['code' => 'en', 'name' => 'English'],
            ['code' => 'ar', 'name' => 'Arabic'],
            ['code' => 'de', 'name' => 'German'],
            ['code' => 'el', 'name' => 'Greek'],
        ];

        $defaultCurrencies = [
            ['code' => 'USD', 'symbol' => '$', 'name' => 'US Dollar'],
            ['code' => 'EUR', 'symbol' => '€', 'name' => 'Euro'],
            ['code' => 'INR', 'symbol' => '₹', 'name' => 'Indian Rupee'],
            ['code' => 'GBP', 'symbol' => '£', 'name' => 'British Pound'],
        ];

        return self::create([
            'company_links' => $defaultCompanyLinks,
            'support_links' => $defaultSupportLinks,
            'payment_methods' => $defaultPaymentMethods,
            'languages' => $defaultLanguages,
            'currencies' => $defaultCurrencies,
            'default_language' => 'English',
            'default_currency' => 'USD',
            'copyright_text' => 'North Trips & Travel, All right reserved.',
            'show_designer_credit' => true,
            'show_back_to_top' => true,
        ]);
    }

    /**
     * Get payment method icon class
     */
    public static function getPaymentIcon($method)
    {
        $icons = [
            'visa' => 'fab fa-cc-visa',
            'mastercard' => 'fab fa-cc-mastercard',
            'amex' => 'fab fa-cc-amex',
            'paypal' => 'fab fa-cc-paypal',
            'discover' => 'fab fa-cc-discover',
            'apple_pay' => 'fab fa-cc-apple-pay',
            'credit_card' => 'fas fa-credit-card',
        ];

        return $icons[$method] ?? 'fas fa-credit-card';
    }

    /**
     * Override to ensure arrays are properly encoded
     */
    public function setCompanyLinksAttribute($value)
    {
        $this->attributes['company_links'] = is_array($value) ? json_encode($value) : $value;
    }

    public function setSupportLinksAttribute($value)
    {
        $this->attributes['support_links'] = is_array($value) ? json_encode($value) : $value;
    }

    public function setPaymentMethodsAttribute($value)
    {
        $this->attributes['payment_methods'] = is_array($value) ? json_encode($value) : $value;
    }

    public function setLanguagesAttribute($value)
    {
        $this->attributes['languages'] = is_array($value) ? json_encode($value) : $value;
    }

    public function setCurrenciesAttribute($value)
    {
        $this->attributes['currencies'] = is_array($value) ? json_encode($value) : $value;
    }
}
