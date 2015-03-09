<?php

namespace DrawingTool\Command;

use DrawingTool\Components\Shape\Rectangle;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateRectangleCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('R')
            ->setDescription('Create a new rectangle on canvas')
            ->addArgument(
                'x1',
                InputArgument::REQUIRED,
                'Which is the x1 coordinate?'
            )
            ->addArgument(
                'y1',
                InputArgument::REQUIRED,
                'Which is the y1 coordinate?'
            )
            ->addArgument(
                'x2',
                InputArgument::REQUIRED,
                'Which is the x2 coordinate?'
            )
            ->addArgument(
                'y2',
                InputArgument::REQUIRED,
                'Which is the y2 coordinate?'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Get the rectangle coordinates.
        $x1 = $input->getArgument('x1');
        $y1 = $input->getArgument('y1');
        $x2 = $input->getArgument('x2');
        $y2 = $input->getArgument('y2');

        if (is_numeric($x1) && is_numeric($y1) && is_numeric($x2) && is_numeric($y2)) {
            $helper = $this->getHelper('canvas');

            if ($helper->has()) {
                $canvas = $helper->getCanvas();
                // Create a new rectangle with coordinates.
                $rectangle = new Rectangle($x1, $y1, $x2, $y2);
                // Add the shape to the canvas.
                $canvas->addShape($rectangle);
            }
            else {
                throw new \LogicException('You must create a canvas before draw a rectangle');
            }
        }
        else {
            throw new \InvalidArgumentException('Rectangle coordinates must be int values');
        }

        $output->writeln($canvas->render());
    }
}