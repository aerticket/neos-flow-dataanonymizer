<?php


namespace Aerticket\DataAnonymizer\Domain;


use Neos\Flow\Persistence\QueryInterface;

interface Anonymizable
{
    /**
     * Executes custom anonymization of an object
     *
     * @return void
     */
    public function anonymize(): void;

    /**
     * Returns whether the given entity already is anonymized.
     *
     * This method is not used in automated anonymization but can be used e.g. in your anonymize
     * implementation or other user-land code handling this entity.
     *
     * @return bool
     */
    public function isAnonymized(): bool;

    /**
     * Create the constraints to use in a query to determine whether the entity is anonymized, e.g.
     * by checking for a certain property or by testing if a field _contains_ a value.
     *
     * The result should be an array of constraints to be fed into a logicalAnd, e.g.
     * ```
     * [
     *   $query->equals('name', 'Anon'),
     *   $query->or([
     *     $query->like('data', '%anon@example.com%'),
     *     $query->like('data', '%anon2@example.com%'),
     *   ]),
     * ]
     * ```
     *
     * @param QueryInterface $query
     * @return array
     */
    public static function createAnonymizationStateConstraints(QueryInterface $query): array;
}
