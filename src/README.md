Drawing Tool
============
This is a basic drawing tool written in PHP as a part of a code challenge. Hurry up to clone it because I will remove it.

Requirements
------------
PHP needs to be a minimum version of PHP 5.3.9

Commands
--------
- __C w h__ Create a new canvas of width w and height h.
- __L x1 y1 x2 y2__ Create a new line from (x1, y1) to (x2, y2). Only horizontal and vertical lines supported.
- __R x1 y1 x2 y2__ Create a new rectangle whose upper left corner is (x1, y1) and lower right corner is (x2, y2).
- __B x y c Fill__ the entire area connected to (x, y).

Usage
-----
You can run the drawing tool with the following command:

     $ cd path/to/DrawingTool/
     $ ./bin/drawingtool
     
Tests
-----
You can run the unit tests with the following command:

     $ cd path/to/DrawingTool/
     $ ./vendor/bin/phpunit