<?php

namespace taskforce\tests\classes;

use PHPUnit\Framework\TestCase;
use taskforce\classes\Task;

class TaskTest extends TestCase
{
    private Task $new_task;
    private Task $active_task;
    private Task $done_task;
    private Task $cancel_task;
    private Task $fail_task;

    protected function setUp(): void
    {
        $this->new_task = new Task(1, null, Task::STATUS_NEW);
        $this->active_task = new Task(1, null, Task::STATUS_ACTIVE);
        $this->done_task = new Task(1, null, Task::STATUS_DONE);
        $this->cancel_task = new Task(1, null, Task::STATUS_CANCEL);
        $this->fail_task = new Task(1, null, Task::STATUS_FAIL);
    }

    public function testGetStatus()
    {
        $this->assertEquals(Task::STATUS_NEW, $this->new_task->getStatus());
        $this->assertEquals(Task::STATUS_ACTIVE, $this->active_task->getStatus());
        $this->assertEquals(Task::STATUS_DONE, $this->done_task->getStatus());
        $this->assertEquals(Task::STATUS_CANCEL, $this->cancel_task->getStatus());
        $this->assertEquals(Task::STATUS_FAIL, $this->fail_task->getStatus());
    }

    public function testGetAvailableActions()
    {
        $this->assertEqualsCanonicalizing([Task::ACTION_START, Task::ACTION_CANCEL], $this->new_task->getAvailableActions());
        $this->assertEqualsCanonicalizing([Task::ACTION_DONE, Task::ACTION_FAIL], $this->active_task->getAvailableActions());
        $this->assertEqualsCanonicalizing([], $this->done_task->getAvailableActions());
        $this->assertEqualsCanonicalizing([], $this->cancel_task->getAvailableActions());
        $this->assertEqualsCanonicalizing([], $this->fail_task->getAvailableActions());
    }

    public function testGetNextStatus()
    {
        $this->assertEquals(Task::STATUS_ACTIVE, $this->new_task->getNextStatus(Task::ACTION_START));
        $this->assertEquals(Task::STATUS_DONE, $this->new_task->getNextStatus(Task::ACTION_DONE));
        $this->assertEquals(Task::STATUS_CANCEL, $this->new_task->getNextStatus(Task::ACTION_CANCEL));
        $this->assertEquals(Task::STATUS_FAIL, $this->new_task->getNextStatus(Task::ACTION_FAIL));
    }

    public function testGetStatusesMap()
    {
        $this->assertEqualsCanonicalizing(Task::MAPPED_STATUSES, $this->new_task->getStatusesMap());
    }

    public function testGetActionsMap()
    {
        $this->assertEqualsCanonicalizing(Task::MAPPED_ACTIONS, $this->new_task->getActionsMap());
    }
}
