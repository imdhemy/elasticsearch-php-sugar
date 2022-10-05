<?php

declare(strict_types=1);

namespace Imdhemy\EsSugar\Responses;

/**
 * Class AcknowledgedResponse
 * This class is used to represent the response of an acknowledged request
 */
class AcknowledgedResponse implements ResponseInterface
{
    /**
     * Returns the response data as an array
     *
     * @return array
     */
    public function asArray(): array
    {
        return [
            'acknowledged' => true,
        ];
    }
}
