<?php

use App\Models\SiteMenu;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $parent = SiteMenu::where('location', 'footer')
            ->where('label', 'Products & Services')
            ->whereNull('parent_id')
            ->first();

        // Update existing Sanaa Cards to use formal external URL
        $sanaaCards = SiteMenu::where('location', 'footer')
            ->where('label', 'Sanaa Cards')
            ->first();

        if ($sanaaCards) {
            $sanaaCards->update([
                'route_name' => null,
                'url' => 'https://cards.sanaa.ug',
                'is_external' => true,
            ]);
        }

        // Add Sanaa AI link
        if ($parent && !SiteMenu::where('location', 'footer')->where('label', 'Sanaa AI')->exists()) {
            SiteMenu::create([
                'location' => 'footer',
                'label' => 'Sanaa AI',
                'url' => 'https://ai.sanaa.co',
                'parent_id' => $parent->id,
                'sort_order' => 5,
                'is_external' => true,
                'is_active' => true,
            ]);
        }
    }

    public function down(): void
    {
        $sanaaCards = SiteMenu::where('location', 'footer')
            ->where('label', 'Sanaa Cards')
            ->first();

        if ($sanaaCards) {
            $sanaaCards->update([
                'route_name' => 'sanaa-cards.index',
                'url' => null,
                'is_external' => false,
            ]);
        }

        SiteMenu::where('location', 'footer')
            ->where('label', 'Sanaa AI')
            ->delete();
    }
};
