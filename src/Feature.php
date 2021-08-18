<?php

namespace CharlGottschalk\FeatureToggle;

use CharlGottschalk\FeatureToggle\Traits\UserRoleTrait;

class Feature
{
    use UserRoleTrait;

    protected static function isOff(): bool
    {
        return !config('features.on');
    }

    protected static function allIsOn() {
        return config('features.all_on');
    }

    public static function enabled($feature)
    {
        if(self::isOff()) {
            return self::allIsOn();
        }

        return config('features.driver')::enabledByName($feature);
    }

    public static function enabledFor($feature, $roles = null): bool
    {
        if (self::isOff()) {
            return self::allIsOn();
        }

        return config('features.driver')::enabledForByName($feature, $roles);
    }
}