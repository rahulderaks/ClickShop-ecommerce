<?php


namespace Dompdf\Positioner;

use Dompdf\FrameDecorator\AbstractFrameDecorator;
use Dompdf\FrameDecorator\Inline as InlineFrameDecorator;
use Dompdf\Exception;

/**
 * Positions inline frames
 *
 * @package dompdf
 */
class Inline extends AbstractPositioner
{

    /**
     * @param AbstractFrameDecorator $frame
     * @throws Exception
     */
    function position(AbstractFrameDecorator $frame)
    {
        /**
         * Find our nearest block level parent and access its lines property.
         * @var BlockFrameDecorator
         */
        $p = $frame->find_block_parent();



        if (!$p) {
            throw new Exception("No block-level parent found.  Not good.");
        }

        $f = $frame;

        $cb = $f->get_containing_block();
        $line = $p->get_current_line_box();

        // Skip the page break if in a fixed position element
        $is_fixed = false;
        while ($f = $f->get_parent()) {
            if ($f->get_style()->position === "fixed") {
                $is_fixed = true;
                break;
            }
        }

        $f = $frame;

        if (!$is_fixed && $f->get_parent() &&
            $f->get_parent() instanceof InlineFrameDecorator &&
            $f->is_text_node()
        ) {
            $min_max = $f->get_reflower()->get_min_max_width();

            // If the frame doesn't fit in the current line, a line break occurs
            if ($min_max["min"] > ($cb["w"] - $line->left - $line->w - $line->right)) {
                $p->add_line();
            }
        }

        $f->set_position($cb["x"] + $line->w, $line->y);
    }
}
