<?php

namespace Dompdf\Positioner;

use Dompdf\FrameDecorator\AbstractFrameDecorator;

/**
 * Base AbstractPositioner class
 *
 * Defines postioner interface
 *
 * @access  private
 * @package dompdf
 */
abstract class AbstractPositioner
{

    /**
     * @param AbstractFrameDecorator $frame
     * @return mixed
     */
    abstract function position(AbstractFrameDecorator $frame);

    /**
     * @param AbstractFrameDecorator $frame
     * @param $offset_x
     * @param $offset_y
     * @param bool $ignore_self
     */
    function move(AbstractFrameDecorator $frame, $offset_x, $offset_y, $ignore_self = false)
    {
        list($x, $y) = $frame->get_position();

        if (!$ignore_self) {
            $frame->set_position($x + $offset_x, $y + $offset_y);
        }

        foreach ($frame->get_children() as $child) {
            $child->move($offset_x, $offset_y);
        }
    }
}
