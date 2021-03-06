<?php
/**
 * Contain Project
 *
 * This source file is subject to the BSD license bundled with
 * this package in the LICENSE.txt file. It is also available
 * on the world-wide-web at http://www.opensource.org/licenses/bsd-license.php.
 * If you are unable to receive a copy of the license or have
 * questions concerning the terms, please send an email to
 * me@andrewkandels.com.
 *
 * @category    akandels
 * @package     contain
 * @author      Andrew Kandels (me@andrewkandels.com)
 * @copyright   Copyright (c) 2013 Andrew P. Kandels (http://andrewkandels.com)
 * @license     http://www.opensource.org/licenses/bsd-license.php BSD License
 * @link        http://andrewkandels.com/contain
 */

namespace Contain\Entity\Property\Type;

use Contain\Exception;
use MongoId;

/**
 * (Object) MongoId Type
 *
 * @category    akandels
 * @package     contain
 * @copyright   Copyright (c) 2013 Andrew P. Kandels (http://andrewkandels.com)
 * @license     http://www.opensource.org/licenses/bsd-license.php BSD License
 */
class MongoIdType extends StringType
{
    /**
     * Parse a given input into a suitable value for the current data type.
     *
     * @param   mixed               Value to be set
     * @return  integer             Internal value
     * @throws  Contain\Exception\InvalidArgumentException
     */
    public function parse($value = null)
    {
        if (!$value) {
            return $this->getUnsetValue();
        }

        if ($value instanceof MongoId) {
            return $value;
        }

        if (is_string($value)) {
            return new MongoId($value);
        }

        throw new Exception\InvalidArgumentException('$value should be an instance of '
            . 'MongoId or a string'
        );
    }

    /**
     * Returns the internal value represented as an integer value
     * for purposes of debugging or export.
     *
     * @param   mixed       Internal value
     * @return  false|null|string
     * @throws  Contain\Exception\InvalidArgumentException
     */
    public function export($value)
    {
        if ($parsed = $this->parse($value)) {
            return (string) $parsed;
        }

        return $parsed;
    }

    /**
     * The value to compare the internal value to which translates to empty or null.
     *
     * @return  mixed
     */
    public function getEmptyValue()
    {
        return new \MongoId();
    }

    /**
     * The value to compare the internal value to which translates to not being
     * set during hydration.
     *
     * @return  mixed
     */
    public function getUnsetValue()
    {
        return new \MongoId();
    }
}
