<?php
namespace DrawingTool\Components;

use DrawingTool\Components\Shape\Shape;

class Canvas
{
    /**
     * @var string
     */
    private $paddingChar = ' ';
    /**
     * @var string
     */
    private $horizontalBorderChar = '-';
    /**
     * @var string
     */
    private $verticalBorderChar = '|';
    /**
     * @var string
     */
    private $eolChar = "\n";
    /**
     * @var int
     */
    private $width;
    /**
     * @var int
     */
    private $height;
    /**
     * @var array
     */
    private $grid = array();
    /**
     * @var array DrawingTool\Components\Shape\Shape
     */
    private $shapes = array();

    /**
     * Min canvas width.
     */
    const MIN_WIDTH = 3;

    /**
     * Min canvas height.
     */
    const MIN_HEIGHT = 1;

    /**
     * Constructor.
     *
     * @param int $width
     *   The canvas width.
     * @param int $height
     *   The canvas height.
     */
    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;

        // Check if dimensions are valid.
        $this->areValidDimensions($width, $height);
        // Create the initial canvas grid.
        $this->createGrid();
    }

    /**
     * Returns the rendered canvas grid with the shapes added.
     */
    public function render() {
        // Draw shapes on canvas.
        $this->drawShapes();

        $render = '';
        foreach ($this->grid as $row) {
            $render .= implode('', $row) . $this->eolChar;
        }

        return rtrim($render);
    }

    /**
     * Creates a new canvas grid according to set dimensions.
     */
    public function createGrid() {
        for ($row = 0; $row <= $this->getHeight() + 1; $row++)
        {
            for ($col = 0; $col <= $this->getWidth() + 1; $col++)
            {
                if ($row == 0 || $row == $this->getHeight() + 1)
                {
                    $this->grid[$row][$col] = $this->horizontalBorderChar;
                }
                elseif ($col == 0 || $col == $this->getWidth() + 1)
                {
                    $this->grid[$row][$col] = $this->verticalBorderChar;
                }
                else
                {
                    $this->grid[$row][$col] = $this->paddingChar;
                }
            }
        }
    }

    /**
     * Returns current canvas grid.
     *
     * @return array
     */
    public function getGrid()
    {
        return $this->grid;
    }

    /**
     * Sets a grid value.
     *
     * @param array $grid
     */
    public function setGrid(array $grid)
    {
        $this->grid = $grid;
    }

    /**
     * Modify the canvas grid drawing the added shapes.
     */
    public function drawShapes() {
        $shapes = $this->getShapes();
        if (!empty($shapes)) {
            foreach ($shapes as $shape) {
                $shape->getDrawer()->draw($this, $shape);
            }
        }
    }

    /**
     * Checks if the canvas dimensions are valid.
     *
     * @param int $width
     *  The width of the canvas.
     * @param int $height
     *  The height of the canvas
     * @return bool
     */
    public function areValidDimensions($width, $height) {
        if ($width >= self::MIN_WIDTH && $height >= self::MIN_HEIGHT) {
            return true;
        }
        else {
            throw new \LogicException('The canvas dimensions are not valid, must be at least 3x1.');
        }
    }

    /**
     * Returns canvas width.
     *
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Returns canvas height.
     *
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Sets the canvas width.
     *
     * @param int $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * Sets the canvas height.
     *
     * @param int $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * Set canvas dimensions.
     *
     * @param int $width
     * @param int $height
     */
    public function setDimensions($width, $height) {
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * Add a shape to the canvas.
     *
     * @param Shape $shape
     *  The shape instance to add on canvas.
     * @param bool $reset
     *  Remove the added shapes.
     */
    public function addShape(Shape $shape, $reset = false)
    {
        // TODO Check if the added shape is out of canvas dimensions.
        if ($reset)
        {
            $this->shapes = array();
        }

        $this->shapes[] = $shape;
    }

    /**
     * Performs a bucket fill over the canvas.
     *
     * @param $x
     *  The x coordinate.
     * @param $y
     *  The y coordinate.
     * @param $color
     *  The color to paint the area.
     */
    public function floodFill($x, $y, $color) {
        if ($this->alreadyFilled($x, $y)) {
            return;
        }

        $this->grid[$y][$x + 1] = $color;

        $this->floodFill($x, $y - 1, $color);
        $this->floodFill($x + 1, $y, $color);
        $this->floodFill($x, $y + 1, $color);
        $this->floodFill($x - 1, $y, $color);
    }

    /**
     * Checks if the point in the given coordinates is already filled.
     * @param $x
     * @param $y
     * @return bool
     */
    public function alreadyFilled($x, $y)
    {
        if ($this->grid[$y][$x + 1] == " ")
        {
            return false;
        }
        return true;
    }

    /**
     * Returns the available shapes added to the canvas.
     *
     * @return array
     */
    public function getShapes()
    {
        return $this->shapes;
    }
}
