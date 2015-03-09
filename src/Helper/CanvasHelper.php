<?php

namespace DrawingTool\Helper;

use DrawingTool\Components\Canvas;
use Symfony\Component\Console\Helper\Helper;
use Symfony\Component\Console\Helper\HelperInterface;

/**
 * The Canvas class provides helpers to handle canvas.
 */
class CanvasHelper extends Helper implements HelperInterface
{
    private $canvas;

    /**
     * Returns the canonical name of this helper.
     *
     * @return string The canonical name
     *
     * @api
     */
    public function getName()
    {
        return 'canvas';
    }

    /**
     * Returns the current canvas instance.
     *
     * @return mixed
     */
    public function getCanvas() {
        return $this->canvas;
    }

    /**
     * Sets a canvas instance.
     *
     * @param Canvas $canvas
     */
    public function setCanvas(Canvas $canvas) {
        $this->canvas = $canvas;
    }

    /**
     * Checks if a canvas has been created.
     */
    public function has() {
        if ($this->canvas instanceof Canvas) {
            return true;
        }
        return false;
    }
}