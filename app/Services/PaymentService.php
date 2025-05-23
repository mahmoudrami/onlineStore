    <?php

    namespace App\Http\Services;

    use GuzzleHttp\Client;
    use GuzzleHttp\Psr7\Request;

    // use http\Client;

    class PaymentService
    {

        private $base_url;
        private $request_client;
        private $headers;


        public function __construct(Client $request_client)
        {
            $this->request_client = $request_client;
            $this->base_url = env('payment_base_url');

            $this->headers = [
                'Content-Type' => 'application/json',
                'authorization' => 'Bearer ' . env('payment_token')
            ];
        }

        // url from website method POST $data the sent from gateway
        private function buildRequest($url, $method, $data = [])
        {
            $request = new Request($method, $this->base_url . '/' . $url, $this->headers);

            if (!$data) {
                return false;
            }

            $response = $this->request_client->send($request, [
                'json' => $data
            ]);

            if ($response->getStatusCode() != 200) {
                return false;
            }

            $response = json_decode($response->getBody(), true);
            return $response;
        }


        public function sendPayment($data)
        {
            return $this->buildRequest('v2/sendPayment', 'POST', $data);
        }

        public function getPaymentStatus($data)
        {
            // return $data;
            return $this->buildRequest('v2/getPaymentStatus', 'POST', $data);
        }
    }
