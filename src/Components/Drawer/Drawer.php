<?php

namespace DrawingTool\Components\Drawer;

use DrawingTool\Components\Canvas;
use DrawingTool\Components\Shape\Shape;

abstract class Drawer {
    abstract function draw(Canvas $canvas, Shape $shape);
}