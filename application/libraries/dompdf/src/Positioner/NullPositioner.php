<?php


namespace Dompdf\Positioner;

use Dompdf\FrameDecorator\AbstractFrameDecorator;

/**
 * Dummy positioner
 *
 * @package dompdf
 */
class NullPositioner extends AbstractPositioner
{

    /**
     * @param AbstractFrameDecorator $frame
     */
    function position(AbstractFrameDecorator $frame)
    {
        return;
    }
}
