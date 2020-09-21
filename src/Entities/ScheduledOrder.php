<?php

namespace App\Entities;

use Carbon\Carbon;

class ScheduledOrder
{
	/**
	 * The delivery date of this scheduled order.
	 *
	 * @var \Carbon\Carbon
	 */
	protected $deliveryDate;

	/**
	 * Is this delivery marked as a holiday that will be skipped.
	 *
	 * @var bool
	 */
	protected $holiday = false;

	/**
	 * Is this scheduled order an opt in order that is not part of the normal subscription's plan cycle.
	 *
	 * @var bool
	 */
	protected $optIn = false;

	/**
	 * Is this scheduled order part of the subscriptions normal plan cycle.
	 *
	 * @var bool
	 */
	protected $interval = true;

	/**
	 * ScheduledOrder constructor.
	 *
	 * @param \Carbon\Carbon $deliveryDate
	 * @param \App\Entities\bool $isInterval
	 */
	public function __construct(Carbon $deliveryDate, bool $isInterval)
	{
		$this->deliveryDate = $deliveryDate;
		$this->interval = $isInterval;
	}

	/**
	 * Return interval status
	 *
	 * @return bool|bool
	 */
	public function isInterval()
	{
		if ($this->interval) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Set Holiday
	 *
	 * @param \App\Entities\bool $holiday
	 */
	public function setHoliday(bool $isHoliday)
	{
		$this->holiday = $isHoliday;
		return $this;
	}

	/**
	 * Return Holiday Status
	 *
	 * @return bool
	 */
	public function isHoliday()
	{
		if (!$this->isInterval()) {
			return false;
		} else {
			return $this->holiday;
		}
	}

	/**
	 * Return Delivery Date
	 *
	 * @return \Carbon\Carbon
	 */
	public function getDeliveryDate()
	{
		return $this->deliveryDate;
	}

	/**
	 * Set Opt In
	 *
	 * @param \App\Entities\bool $isOptIn
	 */
	public function setOptIn(bool $isOptIn)
	{
		$this->optIn = $isOptIn;
		return $this;
	}

	/**
	 * Return Opt In
	 *
	 * @return bool
	 */
	public function getOptIn()
	{
		return $this->optIn;
	}

	/**
	 * Return Opt In
	 *
	 * @return bool
	 */
	public function isOptIn()
	{
		if ($this->isInterval()) {
			if ($this->getOptIn()) {
				return false;
			}
		} else {
			return $this->optIn;
		}
	}
}