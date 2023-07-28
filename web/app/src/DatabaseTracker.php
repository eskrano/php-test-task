<?php

namespace App;


class DatabaseTracker implements TrackerInterface
{
    /**
     * @param string $url
     * @param string $ip
     * @param string $userAgent
     * @return void
     * @throws \Exception
     */
    public function track(string $url, string $ip, string $userAgent): void
    {
        try {

            foreach ([ $url, $ip, $userAgent ] as $value) {
                if (empty($value)) {
                    throw new \Exception("Tracker(DatabaseTracker) error: empty value");
                }
            } // validate for non-empty

            $stmt = DBWrapperSimple::getInstance()
                ->prepare("
                    INSERT INTO WebViews (ip_address, user_agent, page_url, views_count, view_date) 
                    VALUES (?, ?, ?, 1, NOW())
                    ON DUPLICATE KEY UPDATE views_count = views_count + 1, view_date = NOW();
                ");
            $stmt->execute([$ip, $userAgent, $url]);
        } catch (\Throwable $e) {
            // maybe log the error but now will raise back to the caller

            throw new \Exception(sprintf("Tracker(DatabaseTracker) error: %s ", $e->getMessage()), $e->getCode(), $e->getPrevious());
        }
    }
}