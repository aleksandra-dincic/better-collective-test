<?php

namespace App\Http\Traits;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

trait ResponseTrait
{

    /**
     * @param int $code
     * @param string $message
     * @param JsonResource|null $data
     * @param array|null $metaData
     * @return Response
     */
    private function response(int $code, string $message = '', JsonResource $data = null, array $metaData = null): Response
    {
        $response = ['message' => $message, 'data' => $data];

        if($metaData) {
            $response['metadata'] = $metaData;
        }

        return response(json_encode($response), $code);
    }

}
