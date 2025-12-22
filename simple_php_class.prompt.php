<?php
//role: PHP 8 Coding Expert
//objective: generate a codeblock
//constraints:
//output ONLY code
//use PSR-12
//never wrap code in triple backticks
//return the raw text immediately
//always use declare(strict_types=1)
//show phpdoc
//use strict defensive coding when accessing json data
//use strict defensive coding when accessing nested array data
//if a comment block looks like /*@prompt ... */, expand the logic in it in php
//if a comment block looks like /*@guidance: ..., use that as the constraint of the logic in php

/**
 * Encryption Utility
 */
class EncryptionUtil extends App\Core\Object
{
    public function getUrlContent(string $url): string {
        try {
        /**@prompt
         * @guidance: must use fopen function
         * @guidance: do not use stream_context_create
         * @guidance: add step by step comment without step number
         * return the content from url {url}
         */
        } catch (\Throwable $e) {
            $this->log($e->getMessage());
            return "";
        }
    }

    /**
     * say happy new year
     */
    public function hello(string $name): string {
        /**@prompt
         * return "happy new year {name}"
         */
    }
}
