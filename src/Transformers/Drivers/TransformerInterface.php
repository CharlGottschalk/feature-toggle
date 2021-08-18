<?php

namespace CharlGottschalk\FeatureToggle\Transformers\Drivers;

interface TransformerInterface {

    public function transformResults($results);
    public function transformFeature($result);
    public function transformFeatures($data);
    public function transformPagination($results);
}
