<?php

namespace Dinvoice\Space;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Dinvoice\Models\Setting;

// Implementation taken from Akaunting - https://github.com/akaunting/akaunting
trait SiteApi
{

    protected static function getRemote($url, $data = array())
    {
        $base = 'https://devlopy.tn/';

        $client = new Client(['verify' => false, 'base_uri' => $base]);

        $headers['headers'] = array(
            'Accept'        => 'application/json',
            'Referer'       => url('/'),
            'dinvoice'        => Setting::getSetting('version')
        );

        $data['http_errors'] = false;

        $data = array_merge($data, $headers);

        try {
            $result = $client->get($url, $data);
        } catch (RequestException $e) {
            $result = $e;
        }

        return $result;
    }
}
