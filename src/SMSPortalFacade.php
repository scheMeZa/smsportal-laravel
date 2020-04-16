<?php

namespace ScheMeZa\SMSPortal;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ScheMeZa\SMSPortal\Skeleton\SkeletonClass
 */
class SMSPortalFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'SMSPortal';
    }
}
