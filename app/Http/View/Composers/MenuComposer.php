<?php

namespace App\Http\View\Composers;

use App\Models\SiteMenu;
use Illuminate\View\View;

class MenuComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        // Get main navigation menu items
        $mainMenu = SiteMenu::getMenuItems('main');
        
        // Get footer menu items
        $footerMenu = SiteMenu::getMenuItems('footer');
        
        // Get mobile-specific menu items (fallback to main if empty)
        $mobileMenu = SiteMenu::getMenuItems('mobile');
        if ($mobileMenu->isEmpty()) {
            $mobileMenu = $mainMenu;
        }

        $view->with([
            'mainMenu' => $mainMenu,
            'footerMenu' => $footerMenu,
            'mobileMenu' => $mobileMenu,
        ]);
    }
}
