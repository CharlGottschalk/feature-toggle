<?php

namespace CharlGottschalk\FeatureToggle\Transformers;

class Transformer {

    public static function transformResults($results) {
        return config('features.driver')::transformer()->transformResults($results);
    }

    public static function transformFeature($result) {
        return config('features.driver')::transformer()->transformFeature($result);
    }
}
