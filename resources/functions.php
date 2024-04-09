<?php

/**
 * Generates a random ID for a page model
 */
function generatePageID() {
    return substr(strrev(microtime(true) * 10000), 0, 5);
}