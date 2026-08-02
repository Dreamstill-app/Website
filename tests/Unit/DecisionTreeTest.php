<?php

namespace Tests\Unit;

use App\Services\Sorting\DecisionTree;
use Tests\TestCase;

/**
 * Spec conformance: docs/decision-tree.md v1.0.
 */
class DecisionTreeTest extends TestCase
{
    private DecisionTree $tree;

    protected function setUp(): void
    {
        parent::setUp();
        $this->tree = new DecisionTree;
    }

    public function test_no_damage_scores_four_and_resells(): void
    {
        $result = $this->tree->decide([]);

        $this->assertSame(4, $result['condition_score']);
        $this->assertSame('resell', $result['decision']);
        $this->assertNotEmpty($result['reasons']);
    }

    public function test_single_small_tear_scores_two_and_repairs(): void
    {
        $result = $this->tree->decide([
            ['type' => 'tear', 'severity' => null, 'source' => 'user', 'size_over_threshold' => false],
        ]);

        $this->assertSame(2, $result['condition_score']);
        $this->assertSame('repair', $result['decision']);
    }

    public function test_oversized_tear_treated_as_severe_recycles(): void
    {
        $result = $this->tree->decide([
            ['type' => 'tear', 'severity' => null, 'source' => 'user', 'size_over_threshold' => true],
        ]);

        $this->assertSame(1, $result['condition_score']);
        $this->assertSame('recycle', $result['decision']);
    }

    public function test_more_than_two_tears_recycles(): void
    {
        $damages = array_fill(0, 3, ['type' => 'tear', 'severity' => null, 'source' => 'user', 'size_over_threshold' => false]);

        $result = $this->tree->decide($damages);

        $this->assertSame(1, $result['condition_score']);
        $this->assertSame('recycle', $result['decision']);
    }

    public function test_minor_class_a_damage_scores_three_and_donates(): void
    {
        $result = $this->tree->decide([
            ['type' => 'stain', 'severity' => 1, 'source' => 'user'],
        ]);

        $this->assertSame(3, $result['condition_score']);
        $this->assertSame('donate', $result['decision']);
    }

    public function test_severe_class_a_damage_recycles(): void
    {
        $result = $this->tree->decide([
            ['type' => 'stain', 'severity' => 3, 'source' => 'user'],
        ]);

        $this->assertSame(1, $result['condition_score']);
        $this->assertSame('recycle', $result['decision']);
    }

    public function test_three_distinct_class_a_types_recycle(): void
    {
        $result = $this->tree->decide([
            ['type' => 'stain', 'severity' => 1, 'source' => 'user'],
            ['type' => 'pilling', 'severity' => 1, 'source' => 'user'],
            ['type' => 'faded_colour', 'severity' => 1, 'source' => 'user'],
        ]);

        $this->assertSame(1, $result['condition_score']);
        $this->assertSame('recycle', $result['decision']);
    }

    public function test_moderate_class_a_without_repairables_donates(): void
    {
        // Moderate pure class-A (non-cosmetic) → score 2 but no repairable
        // defects → donate, per spec refinement.
        $result = $this->tree->decide([
            ['type' => 'stain', 'severity' => 2, 'source' => 'user'],
        ]);

        $this->assertSame(2, $result['condition_score']);
        $this->assertSame('donate', $result['decision']);
    }

    public function test_moderate_cosmetic_pilling_still_donates_at_three(): void
    {
        $result = $this->tree->decide([
            ['type' => 'pilling', 'severity' => 2, 'source' => 'user'],
        ]);

        $this->assertSame(3, $result['condition_score']);
        $this->assertSame('donate', $result['decision']);
    }

    public function test_luxury_style_at_score_three_resells(): void
    {
        $result = $this->tree->decide(
            [['type' => 'stain', 'severity' => 1, 'source' => 'user']],
            ['style' => 'luxury'],
        );

        $this->assertSame(3, $result['condition_score']);
        $this->assertSame('resell', $result['decision']);
    }

    public function test_quality_signal_downgrades_one_step(): void
    {
        $result = $this->tree->decide([], [], ['heavy wear visible']);

        $this->assertSame(3, $result['condition_score']);
        $this->assertSame('donate', $result['decision']);
    }

    public function test_price_threshold_reroutes_cheap_resell_to_donate(): void
    {
        $reasons = [];

        $decision = $this->tree->applyPriceThreshold('resell', 12, $reasons);

        $this->assertSame('donate', $decision);
        $this->assertNotEmpty($reasons);
    }
}
