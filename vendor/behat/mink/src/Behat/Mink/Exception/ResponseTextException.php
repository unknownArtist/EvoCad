<?php

namespace Behat\Mink\Exception;

/*
 * This file is part of the Behat\Mink.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Mink response's text exception.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
class ResponseTextException extends ExpectationException
{
    /**
     * Returns exception message with additional context info.
     *
     * @return string
     */
    public function __toString()
    {
        try {
            $pageText = $this->pipeString($this->trimString($this->getSession()->getPage()->getText()) . "\n");
            $string   = sprintf("%s\n\n%s%s", $this->getMessage(), $this->getResponseInfo(), $pageText);
        } catch (\Exception $e) {
            return $this->getMessage();
        }

        return $string;
    }
}
