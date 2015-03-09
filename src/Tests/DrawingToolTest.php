<?php

namespace DrawingTool\Tests;

use DrawingTool\Command\CreateCanvasCommand;
use DrawingTool\Command\CreateLineCommand;
use DrawingTool\Command\CreateRectangleCommand;
use DrawingTool\Command\BucketFillCommand;
use DrawingTool\Helper\CanvasHelper;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

/*
 * This file is part of the Huge Code Challenge and is used to perform unit test
 * of the Drawing Tool.
 */

class DrawingToolTest extends \PHPUnit_Framework_TestCase
{
    private $application;
    private $canvas         = "----------------------\n|                    |\n|                    |\n|                    |\n|                    |\n----------------------\n";
    private $horizontalLine = "----------------------\n|                    |\n|xxxxxx              |\n|                    |\n|                    |\n----------------------\n";
    private $verticalLine   = "----------------------\n|                    |\n|xxxxxx              |\n|     x              |\n|     x              |\n----------------------\n";
    private $rectangle      = "----------------------\n|               xxxxx|\n|xxxxxx         x   x|\n|     x         xxxxx|\n|     x              |\n----------------------\n";
    private $bucketFill     = "----------------------\n|oooooooooooooooxxxxx|\n|xxxxxxooooooooox   x|\n|     xoooooooooxxxxx|\n|     xoooooooooooooo|\n----------------------\n";

    private $actual = "----------------------
|                    |
|                    |
|                    |
|                    |
----------------------";

    /**
     * Sets up the fixture.
     */
    public function setUp()
    {
        $this->application = new Application();
        // Add the available commands.
        $this->application->addCommands(array(
                new CreateCanvasCommand(),
                new CreateLineCommand(),
                new CreateRectangleCommand(),
                new BucketFillCommand(),
            )
        );

        $helperSet = $this->application->getHelperSet();
        $helperSet->set(new CanvasHelper());
    }

    /**
     * Function to test the Drawing tools commands.
     */
    public function testDrawingTool()
    {
        // (Create Canvas) Testing C command: C 20 4.
        $command = $this->application->find('C');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command' => $command->getName(),
            'width' => 20,
            'height' => 4,
            ), array(
            'verbosity' => true,
        ));
        $this->assertEquals($this->canvas, $commandTester->getDisplay());

        // (Create horizontal line) Testing L command: L 1 2 6 2.
        $command = $this->application->find('L');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command' => $command->getName(),
            'x1' => 1,
            'y1' => 2,
            'x2' => 6,
            'y2' => 2,
        ), array(
            'verbosity' => true,
        ));
        $this->assertEquals($this->horizontalLine, $commandTester->getDisplay());

        // (Create vertical line) Testing L command: L 6 3 6 4.
        $command = $this->application->find('L');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command' => $command->getName(),
            'x1' => 6,
            'y1' => 3,
            'x2' => 6,
            'y2' => 4,
        ), array(
            'verbosity' => true,
        ));
        $this->assertEquals($this->verticalLine, $commandTester->getDisplay());

        // (Create rectangle) Testing R command: R 16 1 20 3.
        $command = $this->application->find('R');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command' => $command->getName(),
            'x1' => 16,
            'y1' => 1,
            'x2' => 20,
            'y2' => 3,
        ), array(
            'verbosity' => true,
        ));
        $this->assertEquals($this->rectangle, $commandTester->getDisplay());

        // (Bucket fill) Testing B command: B 10 3 o.
        $command = $this->application->find('B');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command' => $command->getName(),
            'x' => 10,
            'y' => 3,
            'c' => 'o',
        ), array(
            'verbosity' => true,
        ));
        $this->assertEquals($this->bucketFill, $commandTester->getDisplay());
    }
}