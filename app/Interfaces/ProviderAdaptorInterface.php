<?php

namespace App\Interfaces;

interface ProviderAdaptorInterface
{
    public function getIssueList();
    public function modify(array $datalist);
}
