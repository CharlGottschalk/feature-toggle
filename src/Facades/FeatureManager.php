<?php

namespace CharlGottschalk\FeatureToggle\Facades;

use Illuminate\Support\Facades\Facade;

class FeatureManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'featureManager';
    }
}
