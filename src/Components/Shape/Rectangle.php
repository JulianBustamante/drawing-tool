<?php

namespace DrawingTool\Components\Shape;

use DrawingTool\Components\Drawer\RectangleDrawer;

class Rectangle extends Shape {
    public function __construct($x1, $y1, $x2, $y2) {
        parent::__construct($x1, $y1, $x2, $y2);
        // Initialize the shape drawer.
        $this->drawer = new RectangleDrawer();
    }
}