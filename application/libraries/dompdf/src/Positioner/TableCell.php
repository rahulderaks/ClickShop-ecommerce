<?php


namespace Dompdf\Positioner;

use Dompdf\FrameDecorator\AbstractFrameDecorator;
use Dompdf\FrameDecorator\Table;

/**
 * Positions table cells
 *
 * @package dompdf
 */
class TableCell extends AbstractPositioner
{

    /**
     * @param AbstractFrameDecorator $frame
     */
    function position(AbstractFrameDecorator $frame)
    {
        $table = Table::find_parent_table($frame);
        $cellmap = $table->get_cellmap();
        $frame->set_position($cellmap->get_frame_position($frame));
    }
}
