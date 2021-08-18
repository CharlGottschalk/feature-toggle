<?php

namespace CharlGottschalk\FeatureToggle\Transformers\Drivers;

use CharlGottschalk\FeatureToggle\Transformers\FeatureTransformer;

class ApiTransformer implements TransformerInterface {

    public function transformResults($results) {

        return (object) [
            'data' => $this->transformFeatures($results->data),
            'pagination' => $this->transformPagination($results->pagination)
        ];
    }

    public function transformFeature($result) {
        return FeatureTransformer::transformSingle($result);
    }

    public function transformFeatures($data) {
        return FeatureTransformer::transformMany($data);
    }

    public function transformPagination($results) {
        return [
            'current_page' => $results->current_page,
            'last_page' => $results->last_page,
            'taken' => $results->taken,
            'total' => $results->total,
            'urls' => [
                'previous_page' => $results->urls->previous_page,
                'next_page' => $results->urls->next_page
            ]
        ];
    }
}
