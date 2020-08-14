<?php

namespace App\Services;

/**
 * Class NTLMRequestService
 * @package App\Services
 */
class NTLMRequestService
{
    /**
     * @var string
     */
    private const USER_AGENT = 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Mobile Safari/537.36';

    /**
     * @var array
     */
    private const JSON_HEADERS = [
        'Accept:application/json',
        'Content-Type:application/json'
    ];

    /**
     * @var string
     */
    private string $credentials;

    /**
     * NTLMRequestService constructor.
     */
    public function __construct()
    {
        $this->credentials = config('ntlm-auth.username') . ':' . config('ntlm-auth.password');
    }

    /**
     * @return NTLMRequestService
     */
    public static function instantiate(): NTLMRequestService
    {
        return new static();
    }

    /**
     * @param string $url
     * @param array $params
     * @return array
     */
    public function sendGetRequest(string $url, array $params = []): array
    {
        $options = [
            CURLOPT_HTTPHEADER      => self::JSON_HEADERS,
            CURLOPT_USERAGENT       => self::USER_AGENT,
            CURLOPT_HTTPAUTH        => CURLAUTH_NTLM,
            CURLOPT_USERPWD         => $this->credentials,
            CURLOPT_VERBOSE         => true,
            CURLOPT_HEADER          => false,
            CURLOPT_SSL_VERIFYPEER  => false,
            CURLOPT_SSL_VERIFYHOST  => false,
            CURLINFO_HEADER_OUT     => true,
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_TIMEOUT         => 60,
            CURLOPT_CUSTOMREQUEST   => 'GET'
        ];

        if (! empty($params)) {
            $url = $url . '?' . http_build_query($params);
        }

        return $this->executeRequest($url, $options);
    }

    /**
     * @param string $url
     * @param array $data
     * @return array
     */
    public function sendPostRequest(string $url, array $data): array
    {
        $options = [
            CURLOPT_HTTPHEADER      => self::JSON_HEADERS,
            CURLOPT_USERAGENT       => self::USER_AGENT,
            CURLOPT_HTTPAUTH        => CURLAUTH_NTLM,
            CURLOPT_USERPWD         => $this->credentials,
            CURLOPT_POST            => true,
            CURLOPT_POSTFIELDS      => json_encode($data),
            CURLOPT_VERBOSE         => true,
            CURLOPT_HEADER          => false,
            CURLOPT_SSL_VERIFYPEER  => false,
            CURLOPT_SSL_VERIFYHOST  => false,
            CURLINFO_HEADER_OUT     => true,
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_TIMEOUT         => 60,
        ];

        return $this->executeRequest($url, $options);
    }

    /**
     * @param string $url
     * @param array $options
     * @return array
     */
    private function executeRequest(string $url, array $options): array
    {
        $curl = curl_init($url);

        if (is_resource($curl)) {
            curl_setopt_array($curl, $options);
            $response = (string) curl_exec($curl);
            curl_close($curl);
        }

        $response = json_decode($response ?? '', true);

        return $response;
    }
}
