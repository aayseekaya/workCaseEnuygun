<?php

namespace App\Classes;

use App\Interfaces\ProviderAdaptorInterface;

class IssueList
{
    private $providerAdaptor;

    public function __construct(ProviderAdaptorInterface $providerAdaptor)
    {
        $this->providerAdaptor = $providerAdaptor;
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->providerAdaptor->getIssueList();
    }
}
