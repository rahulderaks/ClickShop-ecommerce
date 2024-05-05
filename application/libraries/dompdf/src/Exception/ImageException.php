<?php

namespace Dompdf\Exception;

use Dompdf\Exception;

/**
 * Image exception thrown by DOMPDF
 *
 * @package dompdf
 */
class ImageException extends Exception
{

    /**
     * Class constructor
     *
     * @param string $message Error message
     * @param int $code       Error code
     */
    function __construct($message = null, $code = 0)
    {
        parent::__construct($message, $code);
    }

}
