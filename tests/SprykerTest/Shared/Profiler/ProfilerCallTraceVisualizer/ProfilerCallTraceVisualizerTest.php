<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Shared\Profiler\ProfilerCallTraceVisualizer;

use Codeception\Test\Unit;

/**
 * Auto-generated group annotations
 *
 * @group SprykerTest
 * @group Shared
 * @group Profiler
 * @group ProfilerCallTraceVisualizer
 * @group ProfilerCallTraceVisualizerTest
 * Add your own group annotations below this line
 */
class ProfilerCallTraceVisualizerTest extends Unit
{
    /**
     * @return void
     */
    public function testVisualizerReturnValidProfilerData(): void
    {
        // Arrange
        $xhprofTrace = $this->tester->haveXhprofProfilerCallTrace();
        $profilerVisualizer = $this->tester->createXhprofVisualizer();

        // Act
        $profilerData = $profilerVisualizer->visualizeProfilerCallTrace($xhprofTrace);

        // Assert
        $this->tester->assertGeneratedProfilerDataValid($profilerData);
    }

    /**
     * @return void
     */
    public function testVisualizerReturnValidProfilerDataWithMinExecutionNodeTime(): void
    {
        // Arrange
        $minNodeExecutionWallTimeInMicroSeconds = 40000;
        $xhprofTrace = $this->tester->haveXhprofProfilerCallTrace();
        $profilerVisualizer = $this->tester->createXhprofVisualizer($minNodeExecutionWallTimeInMicroSeconds);

        // Act
        $profilerData = $profilerVisualizer->visualizeProfilerCallTrace($xhprofTrace);

        // Assert
        $this->tester->assertGeneratedProfilerDataHasOnlySlowerNodes($profilerData);
    }

    /**
     * The root `main()` edge carries the request's own total wall time, so a threshold higher
     * than that total (as opposed to higher than an individual child node's time) must not drop
     * the root itself -- doing so leaves the graph without a "Request" node to dump.
     *
     * @return void
     */
    public function testVisualizerReturnValidProfilerDataWhenRootExecutionTimeIsBelowThreshold(): void
    {
        // Arrange
        $xhprofTrace = $this->tester->haveXhprofProfilerCallTrace();
        $minNodeExecutionWallTimeInMicroSeconds = $xhprofTrace['main()']['wt'] + 1;
        $profilerVisualizer = $this->tester->createXhprofVisualizer($minNodeExecutionWallTimeInMicroSeconds);

        // Act
        $profilerData = $profilerVisualizer->visualizeProfilerCallTrace($xhprofTrace);

        // Assert
        $this->assertStringContainsString('Request', $profilerData->getContent());
    }
}
