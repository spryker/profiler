<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Shared\Profiler\ProfilerData;

interface ProfilerDataStorageSingleInstancePoolInterface
{
    /**
     * @return \Spryker\Shared\Profiler\ProfilerData\ProfilerDataStorageInterface
     */
    public function getProfilerDataStorage(): ProfilerDataStorageInterface;
}
