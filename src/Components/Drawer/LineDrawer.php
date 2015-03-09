<?php

namespace DrawingTool\Components\Drawer;

use DrawingTool\Components\Canvas;
use DrawingTool\Components\Shape\Shape;

class LineDrawer extends Drawer
{
    public function draw(Canvas $canvas, Shape $line)
    {
        $coordinates = $line->getCoordinates();
        if ($coordinates['x1'] == $coordinates['x2']) {
            $this->drawVerticalLine($canvas, $line);
        }
        elseif ($coordinates['y1'] == $coordinates['y2']) {
            $this->drawHorizontalLine($canvas, $line);
        }
        else {
            throw new \LogicException('Currently only horizontal and vertical lines supported');
        }
    }

    /**
     * Draws a vertical line on the canvas grid.
     *
     * @param Canvas $canvas
     * @param Shape $line
     */
    private function drawVerticalLine(Canvas $canvas, Shape $line)
    {
        // Get line coordinates.
        $coordinates = $line->getCoordinates();
        // Get canvas grid.
        $grid = $canvas->getGrid();
        // Get the line distance between the coordinates.
        $line_distance = $line->getLineDistance();

        for ($row = 0; $row < $line_distance; $row++)
        {
            $grid[$coordinates['y1'] + $row][$coordinates['x1']] = 'x';
        }

        // Write data to the canvas grid.
        $canvas->setGrid($grid);
    }

    /**
     * Draws a horizontal line on the canvas grid.
     *
     * @param Canvas $canvas
     * @param Shape $line
     */
    private function drawHorizontalLine(Canvas $canvas, Shape $line)
    {
        // Get line coordinates.
        $coordinates = $line->getCoordinates();
        // Get canvas grid.
        $grid = $canvas->getGrid();
        // Get the line distance between the coordinates.
        $line_distance = $line->getLineDistance();

        for ($col = 0; $col < $line_distance; $col++)
        {
            $grid[$coordinates['y1']][$coordinates['x1'] + $col] = 'x';
        }

        // Write data to the canvas grid.
        $canvas->setGrid($grid);
    }
}