<?php

namespace DrawingTool;

use Symfony\Component\Console\Application as Console;
use Symfony\Component\Console\Shell;
use DrawingTool\Command\BucketFillCommand;
use DrawingTool\Command\CreateCanvasCommand;
use DrawingTool\Command\CreateLineCommand;
use DrawingTool\Command\CreateRectangleCommand;
use DrawingTool\Helper\CanvasHelper;

class Application
{
    private $console;

    /**
     * Constructor.
     */
    public function __construct() {
        $this->console = new Console('Drawing Tool', '1.0');
        // Add the available commands.
        $this->console->addCommands(array(
            new CreateCanvasCommand(),
            new CreateLineCommand(),
            new CreateRectangleCommand(),
            new BucketFillCommand(),
            )
        );
        // Get default helpers.
        $helperSet = $this->console->getHelperSet();
        $helperSet->set(new CanvasHelper());

        $shell = new Shell($this->console);
        // Run the console in shell mode.
        $shell->run();
    }

    /**
     * @return Console
     */
    public function getConsole()
    {
        return $this->console;
    }
}