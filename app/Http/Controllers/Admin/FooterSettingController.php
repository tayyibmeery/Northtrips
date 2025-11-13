<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterSetting;
use Illuminate\Http\Request;

class FooterSettingController extends Controller
{
    public function edit()
    {
        $footerSetting = FooterSetting::getSettings();

        // Ensure we have arrays for the view
        $footerSetting->ensureArrayFields();

        return view('admin.footer-settings.edit', compact('footerSetting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'company_links' => 'nullable|array',
            'company_links.*.name' => 'required|string|max:255',
            'company_links.*.url' => 'required|string|max:255',
            'support_links' => 'nullable|array',
            'support_links.*.name' => 'required|string|max:255',
            'support_links.*.url' => 'required|string|max:255',
            'payment_methods' => 'nullable|array',
            'languages' => 'nullable|array',
            'languages.*.code' => 'required|string|max:10',
            'languages.*.name' => 'required|string|max:255',
            'currencies' => 'nullable|array',
            'currencies.*.code' => 'required|string|max:10',
            'currencies.*.symbol' => 'required|string|max:5',
            'currencies.*.name' => 'required|string|max:255',
            'default_language' => 'required|string|max:255',
            'default_currency' => 'required|string|max:10',
            'copyright_text' => 'required|string|max:500',
            'show_designer_credit' => 'boolean',
            'show_back_to_top' => 'boolean',
        ]);

        $footerSetting = FooterSetting::getSettings();

        // Process the data
        $data = $request->only([
            'default_language',
            'default_currency',
            'copyright_text',
            'show_designer_credit',
            'show_back_to_top'
        ]);

        // Process arrays
        $data['company_links'] = $this->processLinks($request->company_links ?? []);
        $data['support_links'] = $this->processLinks($request->support_links ?? []);
        $data['payment_methods'] = $request->payment_methods ?? [];
        $data['languages'] = $this->processLanguages($request->languages ?? []);
        $data['currencies'] = $this->processCurrencies($request->currencies ?? []);

        $footerSetting->update($data);

        return redirect()->route('admin.footer-settings.edit')
            ->with('success', 'Footer settings updated successfully.');
    }

    /**
     * Process links array to remove empty entries
     */
    private function processLinks($links)
    {
        return array_filter($links, function($link) {
            return !empty($link['name']) && !empty($link['url']);
        });
    }

    /**
     * Process languages array to remove empty entries
     */
    private function processLanguages($languages)
    {
        return array_filter($languages, function($language) {
            return !empty($language['code']) && !empty($language['name']);
        });
    }

    /**
     * Process currencies array to remove empty entries
     */
    private function processCurrencies($currencies)
    {
        return array_filter($currencies, function($currency) {
            return !empty($currency['code']) && !empty($currency['symbol']) && !empty($currency['name']);
        });
    }
}
