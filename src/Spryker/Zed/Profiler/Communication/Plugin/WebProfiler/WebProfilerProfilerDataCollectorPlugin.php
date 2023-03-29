<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Profiler\Communication\Plugin\WebProfiler;

use Spryker\Service\Container\ContainerInterface;
use Spryker\Shared\WebProfilerExtension\Dependency\Plugin\WebProfilerDataCollectorPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Symfony\Component\HttpKernel\DataCollector\DataCollectorInterface;

/**
 * @method \Spryker\Zed\Profiler\Communication\ProfilerCommunicationFactory getFactory()
 * @method \Spryker\Zed\Profiler\ProfilerConfig getConfig()
 */
class WebProfilerProfilerDataCollectorPlugin extends AbstractPlugin implements WebProfilerDataCollectorPluginInterface
{
    /**
     * @var string
     */
    protected const DATA_COLLECTOR_NAME = 'profiler';

    /**
     * @var string
     */
    protected const DATA_TEMPLATE_NAME = '@Profiler/profiler';

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getName(): string
    {
        return static::DATA_COLLECTOR_NAME;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getTemplateName(): string
    {
        return static::DATA_TEMPLATE_NAME;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Spryker\Service\Container\ContainerInterface $container
     *
     * @return \Symfony\Component\HttpKernel\DataCollector\DataCollectorInterface
     */
    public function getDataCollector(ContainerInterface $container): DataCollectorInterface
    {
        return $this->getFactory()->createProfilerDataCollector();
    }
}
