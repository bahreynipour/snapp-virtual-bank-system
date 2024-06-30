<?php

namespace App\Services\SmsService\Concerns;

use App\Services\SmsService\TemplateBuilder;

trait HasLookup {

    protected TemplateBuilder $template;

    public function template(TemplateBuilder $template): static
    {
        $this->template = $template;

        return $this;
    }

}
