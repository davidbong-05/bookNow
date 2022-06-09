<?php

namespace SocialiteProviders\UNIMASIdentity;

use SocialiteProviders\Manager\SocialiteWasCalled;

class UNIMASIdentityExtendSocialite
{
    /**
     * Register the provider.
     *
     * @param  \SocialiteProviders\Manager\SocialiteWasCalled $socialiteWasCalled
     */
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite('unimas_identity', Provider::class);
    }
}