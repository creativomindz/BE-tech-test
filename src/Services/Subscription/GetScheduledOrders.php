<?php

namespace App\Services\Subscription;

use App\Entities\Subscription;
use App\Entities\ScheduledOrder;

class GetScheduledOrders
{
	/**
	 * Handle generating the array of scheduled orders for the given number of weeks and subscription.
	 *
	 * @param \App\Entities\Subscription $subscription
	 * @param int $forNumberOfWeeks
	 *
	 * @return array
	 */
	public function handle(Subscription $subscription, $forNumberOfWeeks = 6)
	{
		$scheduledOrders = [];
		$isInterval = true;
		$date = $subscription->getNextDeliveryDate();
		$subscriptionStatus = $subscription->getStatus();
		$subscriptionPlan = $subscription->getPlan();

		for ($i = 0; $i < $forNumberOfWeeks; $i++) {
			$scheduledOrder = null;
			// Next Delivery Date
			if ($i > 0) {
				// Next Delivery Date based on PLAN
				$date = (new \Carbon\Carbon($date))->addWeek(1);
				if ($subscriptionPlan == $subscription::PLANS_ALLOWED[$subscription::PLAN_FORTNIGHTLY]) {
					if ($i % 2 == 0) {
						$isInterval = true;
					} else {
						$isInterval = false;
					}
				}
			}

			// Interval based on Subscription Status
			if ($subscriptionStatus == $subscription::STATUSES_ALLOWED[$subscription::STATUS_ACTIVE]) {
				$isHoliday = false;
				$scheduledOrder = new ScheduledOrder($date, $isInterval);
				$scheduledOrder->setHoliday($isHoliday);
				$scheduledOrders[$i] = $scheduledOrder;
			}
		}

		return $scheduledOrders;
	}
}