<?php

namespace Dinvoice\Listeners\Updates\v3;

use Dinvoice\Listeners\Updates\Listener;
use Dinvoice\Events\UpdateFinished;
use Dinvoice\Models\Setting;
use Dinvoice\Models\Currency;
use Artisan;

class Version311 extends Listener
{
    const VERSION = '3.1.1';

    /**
     * Handle the event.
     *
     * @param UpdateFinished $event
     * @return void
     */
    public function handle(UpdateFinished $event)
    {
        if ($this->isListenerFired($event)) {
            return;
        }

        Artisan::call('migrate', ['--force' => true]);

        // Update dinvoice app version
        Setting::setSetting('version', static::VERSION);
    }
}
