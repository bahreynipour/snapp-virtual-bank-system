<?php

namespace App\Services\SmsService\Concerns;

trait HasBasicAuth{

    protected function getUserName()
    {
        return $this->getConfig('username');
    }

    protected function getPassword()
    {
        return $this->getConfig('password');
    }

}
