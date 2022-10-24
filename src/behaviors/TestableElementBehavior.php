<?php

namespace markhuot\craftpest\behaviors;

use yii\base\Behavior;

/**
 * # Elements
 * 
 * Elements, like entries, and be tested in Craft via the following assertions.
 * 
 * @property \craft\base\Element $owner
 */
class TestableElementBehavior extends Behavior
{
    /**
     * Asserts that the element is valid (contains no errors from validation).
     * 
     * Note: since validation errors throw Exceptions in Pest, by default, you must
     * silence those exceptions to continue the test.
     * 
     * ```php
     * Entry::factory()
     *   ->create()
     *   ->assertValid()
     * ```
     */
    function assertValid(array $keys = [])
    {
        test()->assertCount(0, $this->owner->errors);
    }

    /**
     * Asserts that the element is invalid (contains errors from validation).
     * 
     * ```php
     * Entry::factory()
     *   ->muteValidationErrors()
     *   ->create(['title' => null])
     *   ->assertInvalid();
     * ```
     */
    function assertInvalid(array $keys = [])
    {
        test()->assertGreaterThanOrEqual(1, count($this->owner->errors));
    }
}