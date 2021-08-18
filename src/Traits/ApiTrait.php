<?php

namespace CharlGottschalk\FeatureToggle\Traits;

use GuzzleHttp\Client;

trait ApiTrait
{
    protected static $headers;

    protected static function setHeaders()
    {
        $headers = config('features.api.headers');

        if (is_array($headers)) {
            self::$headers = $headers;
        }

        if (is_object($headers) && method_exists($headers, 'getHeaders')) {
            self::$headers = $headers::getHeaders();
        }
    }

    protected static function getEndpoint($endpoint): string
    {
        return config('features.api.route') . $endpoint;
    }

    public static function get($endpoint, $params)
    {
        try {
            self::setHeaders();
            
            $client = new Client(['verify' => false]);

            $headerParams = [
                'headers' => self::$headers
            ];

            $endpoint .= '?' . http_build_query($params);

            $params += $headerParams;

            $response = $client->get(self::getEndpoint($endpoint), $params);

            return json_decode($response->getBody()->getContents());

        } catch (\Exception $e) {
            return (object) [
                'success' => false,
                'message' => 'Failure'
            ];
        }

    }

    public static function post($endpoint, $params = [])
    {
        self::setHeaders();

        try {

            $client = new Client(['verify' => false]);

            $content = [
                'headers' => self::$headers,
            ];

            $content['form_params'] = $params;

            $response = $client->request('post', self::getEndpoint($endpoint), $content);

            return json_decode($response->getBody()->getContents());

        } catch (\Exception $exception) {
            return [
                'success' => false,
                'message' => $exception->getMessage()
            ];
        }
    }
}
