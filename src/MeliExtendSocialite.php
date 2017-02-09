<?php

namespace DGtal\SocialiteProviders\Meli;

use SocialiteProviders\Manager\SocialiteWasCalled;

class MeliExtendSocialite
{
    /**
     * Execute the provider.
     */
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite('meli', __NAMESPACE__.'\Provider');
    }
}
