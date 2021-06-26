<?php

use TaskForce\classes\Task;

$task = new Task('1', '2');

assert($task->getNextStatus(Task::ACTION_CANCEL) == Task::STATUS_CANCEL, 'cancel action');;
