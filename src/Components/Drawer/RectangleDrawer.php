<?php

namespace DrawingTool\Components\Drawer;

use DrawingTool\Components\Canvas;
use DrawingTool\Components\Shape\Line;
use DrawingTool\Components\Shape\Shape;

class RectangleDrawer extends Drawer
{
    public function draw(Canvas $canvas, Shape $rectangle)
    {
        $coordinates = $rectangle->getCoordinates();
        $rectangleLines = array(
            'topLine' => new Line($coordinates['x1'], $coordinates['y1'], $coordinates['x2'], $coordinates['y1']),
            'bottomLine' => new Line($coordinates['x1'], $coordinates['y2'], $coordinates['x2'], $coordinates['y2']),
            'leftLine' => new Line($coordinates['x1'], $coordinates['y1'], $coordinates['x1'], $coordinates['y2']),
            'rightLine' => new Line($coordinates['x2'], $coordinates['y1'], $coordinates['x2'], $coordinates['y2']),
        );

        foreach ($rectangleLines as $rectangleLine) {
            $rectangleLine->getDrawer()->draw($canvas, $rectangleLine);
        }
    }
}