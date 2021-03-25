<?php


namespace Cardoso\ViralLoops\Model\Connect;

use GuzzleHttp\ClientFactory;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\ResponseFactory;
use Cardoso\ViralLoops\Model\Config;

class Api
{
    /**
     * API headers
     * @var array
     */
    private $headers = [
        'Content-Type' => 'application/json'
    ];

    /**
     * @var ClientFactory
     */
    protected $clientFactory;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var ResponseFactory
     */
    protected $responseFactory;

    /**
     * RequestApi constructor.
     * @param ClientFactory $clientFactory
     * @param ResponseFactory $responseFactory
     * @param Config $config
     */
    public function __construct(
        ClientFactory $clientFactory,
        ResponseFactory $responseFactory,
        Config $config
    ) {
        $this->clientFactory = $clientFactory;
        $this->responseFactory = $responseFactory;
        $this->config = $config;
    }

    /**
     * @param string $method
     * @param string $path
     * @param array $payload
     * @return array
     */
    public function request(string $method, string $path, array $payload) : array
    {
        $url = $this->config->getUrl() . $path;
        $client = $this->clientFactory->create();
        try {
            $result = $client->request($method, $url, [
                'headers' => $this->headers,
                'json' => $payload
            ]);
        } catch (GuzzleException $e) {
            return $this->getClientError($e);
        }
        return $this->getClientData($result);
    }

    /**
     * @param $result
     * @return array
     */
    protected function getClientData($result) : array
    {
        return [
            'code' => $result->getStatusCode(),
            'body' => $result->getBody()->getContents()
        ];
    }

    /**
     * @param \Exception $e
     * @return array
     */
    protected function getClientError(\Exception $e): array
    {
        return [
            'code' => $e->getCode(),
            'body' => $e->getMessage()
        ];
    }
}
