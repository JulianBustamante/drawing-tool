<?php

namespace DrawingTool\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use DrawingTool\Components\Canvas;

class CreateCanvasCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('C')
            ->setDescription('Create a new canvas')
            ->addArgument(
                'width',
                InputArgument::REQUIRED,
                'Which is the canvas width?'
            )
            ->addArgument(
                'height',
                InputArgument::REQUIRED,
                'Which is the canvas height?'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Get width and height canvas values.
        $width = $input->getArgument('width');
        $height = $input->getArgument('height');

        if (is_numeric($width) && is_numeric($height)) {
            // Get the Canvas helper.
            $helper = $this->getHelper('canvas');
            // Get the current canvas instance or null if it's not initialized.
            $canvas = $helper->getCanvas();

            if ($canvas instanceof Canvas) {
                // TODO If something was drawn on the canvas we must resize it or it's not allowed(?)
                $canvas->setDimensions($width, $height);
            }
            else {
                $canvas = new Canvas($width, $height);
                $helper->setCanvas($canvas);
            }

            $output->writeln($canvas->render());
        }
        else {
            throw new \InvalidArgumentException('Canvas width and height must be int values');
        }
    }
}