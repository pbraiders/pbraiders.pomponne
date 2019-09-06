<?php

declare(strict_types=1);

namespace Pbraiders\Service\RouteProvider;

interface RouteProviderInterface extends ContainerAwareInterface
{
    /**
     * Use the register method to register items with the container via the
     * protected $this->leagueContainer property or the `getLeagueContainer` method
     * from the ContainerAwareTrait.
     *
     * @return void
     */
    public function register();
}
