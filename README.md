# PHP Worker

The PHP Worker sends JSON wrapped data via UDP packets to a given server at a defined interval.

## Installation

    $ pear channel-discover pearhub.org
	$ pear install pearhub/healthety

## Usage

	require 'Healthety.php';

	$load_average = new WorkerSettings();
	$load_average->template('system')
				 ->name('load_average')
			  	 ->interval(1)
			  	 ->value('w | head -n1 | cut -f4 -d":" | cut -f2 -d" "');

	$memory = new WorkerSettings();
	$memory->template('system')
		   ->name('memory')
		   ->interval(1)
		   ->value('top -l 1 -n 0 -F -i 100 | grep "PhysMem" | cut -f4 -d"," | cut -d"M" -f1 | sed "s/ //g"');

	$healthety = new Healthety('127.0.0.1', '41234');
	$healthety->spawnWorker($load_average)
			  ->spawnWorker($memory)
			  ->run();