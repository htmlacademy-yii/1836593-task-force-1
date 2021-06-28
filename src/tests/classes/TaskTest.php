<?php

namespace TaskForce\tests\classes;

use PHPUnit\Framework\TestCase;
use TaskForce\classes\Task;

class TaskTest extends TestCase
{
    private Task $task;

    protected function setUp(): void
    {
        $this->task = new Task('1', '2');
    }

    public function testGetStatus()
    {
        $this->assertEquals(Task::STATUS_NEW, $this->task->status);
    }

    public function testGetAvailableActions()
    {
        $this->assertEqualsCanonicalizing([Task::ACTION_START, Task::ACTION_CANCEL], $this->task->getAvailableActions(Task::STATUS_NEW));
    }

    public function testGetNextStatus()
    {
        $this->assertEquals(Task::STATUS_ACTIVE, $this->task->getNextStatus(Task::ACTION_START));
    }

    public function testGetStatusesMap()
    {
        $this->assertEqualsCanonicalizing(Task::MAPPED_STATUSES, $this->task->getStatusesMap());
    }

    public function testGetActionsMap()
    {
        $this->assertEqualsCanonicalizing(Task::MAPPED_ACTIONS, $this->task->getActionsMap());
    }
}
