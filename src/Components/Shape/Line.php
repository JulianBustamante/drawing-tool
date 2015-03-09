<?php

namespace DrawingTool\Components\Shape;

use DrawingTool\Components\Drawer\LineDrawer;

class Line extends Shape {
    public function __construct($x1, $y1, $x2, $y2) {
        parent::__construct($x1, $y1, $x2, $y2);
        // Initialize the shape drawer.
        $this->drawer = new LineDrawer();
    }

    /**
     * Returns the line distance given the coordinates.
     * @return float
     */
    public function getLineDistance() {
        $coordinates = $this->getCoordinates();
        // Get x difference.
        $dx = $coordinates['x2'] - $coordinates['x1'];
        // Get y difference.
        $dy = $coordinates['y2'] - $coordinates['y1'];

        return sqrt(pow($dx, 2) + pow($dy, 2)) + 1;
    }
}
