<?php

namespace DrawingTool\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BucketFillCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('B')
            ->setDescription('Fill the entire connected area')
            ->addArgument(
                'x',
                InputArgument::REQUIRED,
                'Which is the x coordinate?'
            )
            ->addArgument(
                'y',
                InputArgument::REQUIRED,
                'Which is the y coordinate?'
            )
            ->addArgument(
                'c',
                InputArgument::REQUIRED,
                'Which is the color?'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Get x and y coordinates and color.
        $x = $input->getArgument('x');
        $y = $input->getArgument('y');
        $c = $input->getArgument('c');

        if (is_numeric($x) && is_numeric($y)) {
            // Get the Canvas helper.
            $helper = $this->getHelper('canvas');
            if ($helper->has()) {
                $canvas = $helper->getCanvas();
                $canvas->floodFill($x, $y, $c);
            }
            else {
                throw new \LogicException('You must create a canvas before perform a flood fill');
            }
        }
        else {
            throw new \InvalidArgumentException('x and y coordinates must be int values');
        }

        $output->writeln($canvas->render());
    }
}