# Horse Racing Simulator
A php web application that simulates horse racing. 

## Features

- A "create race" button which generates a new race of 8 random horses
- A button "progress" which advances all races by 10 "seconds" until all horses in the
race have completed 1500m
- Any currently running races, showing distance covered, horse position, current time
- The last 5 race results (top 3 positions and times to complete 1500m)
- The best ever time, and the stats of the horse that generated it

## Implementation Details for Application:

- Each horse has 3 stats: speed, strength, endurance
- Each stat ranges from 0.0 to 10.0
- A horse's speed is their base speed (5 m/s) + their speed stat (in m/s)
- Endurance represents how many hundreds of meters they can run at their best
speed, before the weight of the jockey slows them down
- A jockey slows the horse down by 5 m/s, but this effect is reduced by the horse's
strength * 8 as a percentage
- Each race is run by 8 randomly generated horses, over 1500m
- Up to 3 races are allowed at the same time

## Requirements

- PHP 5.3.7

## Installation

Clone repository to your server

git clone https://github.com/BilalGill/horse_racing_simulator.git

Create mysql Database
Query : CREATE DATABASE horse_racing; (where "horse_racing" is db_name)

Run Database Schema
Path : /migration/horse_racing_schema.sql


composer install



## Assumptions

- You already have setup Apache2, PHP and mysql database on system
- For every race new horces are generated 


## Usage Examples (on localhost)

- http://localhost/horse_racing_simulator/index.php/Horse_racing

## Variation:

- You can also run by any number of horses but by default it is 8. You can configure it from /Application/Config/Constant "NUMBER_OF_HORSES_IN_RACE".


## Assignment Specific Work Directories:
  These are the files where I have done my work related to this assignment and all other directories are generated by framework Codeignitor.
- |-- application
-        |-- controllers
-        |-- config
-            |-- autoload
-            |-- config
-            |-- constants
-            |-- database
-        |-- helpers
-        |-- views
-        |-- models


## Configuration Note
- If you changed the directory name of this application then you have to update "$config['base_url']" in "application/config/config.php" file

## Code Abbreviation
- CN_ = Column Name
- TBL_ = Table Name


## Contribute

Create your own feature branch, commit open PR. Better to add tests related to your code.
'''
#For running tests (if phpunit is already setup on system), just run following command in root directory.
phpunit
'''


