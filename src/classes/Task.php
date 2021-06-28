<?php

namespace TaskForce\classes;

class Task
{
    // status constants
    const STATUS_NEW = 'new';
    const STATUS_CANCEL = 'cancel';
    const STATUS_ACTIVE = 'active';
    const STATUS_DONE = 'done';
    const STATUS_FAIL = 'fail';

    // action constants
    const ACTION_CANCEL = 'action_cancel';
    const ACTION_START = 'action_start';
    const ACTION_DONE = 'action_done';
    const ACTION_FAIL = 'action_fail';

    // mapped statuses
    const MAPPED_STATUSES = [
        self::STATUS_NEW => 'Новое',
        self::STATUS_CANCEL => 'Отменено',
        self::STATUS_ACTIVE => 'В работе',
        self::STATUS_DONE => 'Выполнено',
        self::STATUS_FAIL => 'Провалено'
    ];

    // mapped actions
    const MAPPED_ACTIONS = [
        self::ACTION_CANCEL => 'Отменить',
        self::ACTION_DONE => 'Выполнено',
        self::ACTION_START => 'Откликнуться',
        self::ACTION_FAIL => 'Отказаться'
    ];

    // mapped status by action
    const STATUS_BY_ACTION = [
        self::ACTION_START => self::STATUS_ACTIVE,
        self::ACTION_CANCEL => self::STATUS_CANCEL,
        self::ACTION_DONE => self::STATUS_DONE,
        self::ACTION_FAIL => self::STATUS_FAIL
    ];

    // mapped actions by status
    const ACTIONS_BY_STATUS = [
        self::STATUS_NEW => [self::ACTION_CANCEL, self::ACTION_START],
        self::STATUS_ACTIVE => [self::ACTION_DONE, self::ACTION_FAIL]
    ];

    /**
     * @var string
     */
    public string $status;

    /**
     * @var string
     */
    protected string $customer_id;

    /**
     * @var string
     */
    protected string $contactor_id;

    /**
     * Task constructor.
     * @param string $customer_id
     * @param string $contactor_id
     */
    public function __construct (string $customer_id, string $contactor_id)
    {
        $this->customer_id = $customer_id;
        $this->contactor_id = $contactor_id;
        $this->status = self::STATUS_NEW;
    }

    /**
     * @return string[]
     */
    public function getStatusesMap(): array
    {
        return self::MAPPED_STATUSES;
    }

    /**
     * @return string[]
     */
    public function getActionsMap(): array
    {
        return self::MAPPED_ACTIONS;
    }

    /**
     * @param string $action
     * @return string|null
     */
    public function getNextStatus(string $action): ?string
    {
        return self::STATUS_BY_ACTION[$action] ?? null;
    }

    /**
     * @param string $status
     * @return string[]|null
     */
    public function getAvailableActions(string $status): ?array
    {
        return self::ACTIONS_BY_STATUS[$status] ?? null;
    }
}
