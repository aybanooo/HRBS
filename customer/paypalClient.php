<?php

namespace Sample;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment; //if want to go live change to ProductionEnvironment

ini_set('error_reporting', E_ALL); // or error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

class PayPalClient
{
    /**
     * Returns PayPal HTTP client instance with environment that has access
     * credentials context. Use this instance to invoke PayPal APIs, provided the
     * credentials have access.
     */
    public static function client()
    {
        return new PayPalHttpClient(self::environment());
    }

    /**
     * Set up and return PayPal PHP SDK environment with PayPal access credentials.
     * This sample uses SandboxEnvironment. In production, use LiveEnvironment.
     */
    public static function environment()
    {
        $clientId = getenv("CLIENT_ID") ?: "AVFvFuUKXMeSAJRgomChw5y-GVxtgyRGm2jAOBo5eVtGfd3mXa28RUQ7Niq6ae1mHhzI5LxvyP4zKH_e";
        $clientSecret = getenv("CLIENT_SECRET") ?: "EPK9ioSUQnynJaKOwrze5_woM7MmEDXzQdj3eY41k58IwaoHjYoCOJRlxuf1lA7w7eAySX_LY48jB5Rt";
        return new SandboxEnvironment($clientId, $clientSecret); //eto din papalitan ng production environment
    }
}
