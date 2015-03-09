<?php

namespace DrawingTool\Components\Shape;

class Shape {
    private $coordinates = array();
    protected $drawer;

    public function __construct($x1, $y1, $x2, $y2) {
        $this->coordinates = array(
            'x1' => $x1,
            'y1' => $y1,
            'x2' => $x2,
            'y2' => $y2,
        );
    }

    /**
     * Returns the drawer associated to this shape.
     */
    public function getDrawer() {
        return $this->drawer;
    }

    /**
     * @return array
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }

    /**
     * @param array $coordinates
     */
    public function setCoordinates($coordinates)
    {
        $this->coordinates = $coordinates;
    }
}