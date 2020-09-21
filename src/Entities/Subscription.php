<?php

namespace App\Entities;

use Carbon\Carbon;

class Subscription
{
	/**
	 * The statuses a subscription can have.
	 *
	 * @var int
	 */
	const STATUS_ACTIVE = 1;
	const STATUS_CANCELLED = 2;

	/**
	 * The allowed statuses.
	 *
	 * @var array
	 */
	const STATUSES_ALLOWED = [
		self::STATUS_ACTIVE => 'Active',
		self::STATUS_CANCELLED => 'Cancelled',
	];

	/**
	 * The plans a subscription can have.
	 *
	 * @var int
	 */
	const PLAN_WEEKLY = 1;
	const PLAN_FORTNIGHTLY = 2;

	/**
	 * The allowed plans.
	 *
	 * @var array
	 */
	const PLANS_ALLOWED = [
		self::PLAN_WEEKLY => 'Weekly',
		self::PLAN_FORTNIGHTLY => 'Fortnightly',
	];

	/**
	 * The subscription status.
	 *
	 * @var int
	 */
	protected $status;

	/**
	 * The subscription plan.
	 *
	 * @var int
	 */
	protected $plan;

	/**
	 * The next delivery date for this subscription.
	 *
	 * @var \Carbon\Carbon|null
	 */
	protected $nextDeliveryDate;

	/**
	 * Set Subscription Status
	 *
	 * @param $subscriptionStatus
	 */
	public function setStatus($subscriptionStatus)
	{
		$this->status = self::STATUSES_ALLOWED[$subscriptionStatus];
		return $this;
	}

	/**
	 * Return Subscription Status
	 *
	 * @return string
	 */
	public function getStatus()
	{
		return $this->status;
	}

	/**
	 * Set Subscription Plan
	 *
	 * @param $subscriptionPlan
	 */
	public function setPlan($subscriptionPlan)
	{
		$this->plan = self::PLANS_ALLOWED[$subscriptionPlan];
		return $this;
	}

	/**
	 * Return Subscription Plan
	 *
	 * @return string
	 */
	public function getPlan()
	{
		return $this->plan;
	}

	/**
	 * Set Next Delivery Date
	 *
	 * @param \Carbon\Carbon $nextDeliveryDate
	 */
	public function setNextDeliveryDate(Carbon $nextDeliveryDate)
	{
		$this->nextDeliveryDate = $nextDeliveryDate;
		return $this;
	}

	/**
	 * Return Next Delivery Date
	 *
	 * @return \Carbon\Carbon|null
	 */
	public function getNextDeliveryDate()
	{
		return $this->nextDeliveryDate;
	}
}