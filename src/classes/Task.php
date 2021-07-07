<?php

namespace taskforce\classes;

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
    private string $status;

    /**
     * @var int|null
     */
    private ?int $customer_id;

    /**
     * @var int
     */
    private int $contactor_id;

    /**
     * Task constructor.
     * @param int $contactor_id
     * @param int|null $customer_id
     * @param string $status
     */
    public function __construct (int $contactor_id, int $customer_id = null, string $status = self::STATUS_NEW)
    {
        $this->contactor_id = $contactor_id;
        $this->customer_id = $customer_id;
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return int|null
     */
    public function getCustomerId(): ?int
    {
        return $this->customer_id;
    }

    /**
     * @param int|null $customer_id
     */
    public function setCustomerId(?int $customer_id): void
    {
        $this->customer_id = $customer_id;
    }

    /**
     * @return int
     */
    public function getContactorId(): int
    {
        return $this->contactor_id;
    }

    /**
     * @param int $contactor_id
     */
    public function setContactorId(int $contactor_id): void
    {
        $this->contactor_id = $contactor_id;
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
     * @param string|null $status
     * @return string[]
     */
    public function getAvailableActions(string $status = null): ?array
    {
        $computed_status = $status ?? $this->status;
        return self::ACTIONS_BY_STATUS[$computed_status] ?? [];
    }
}
