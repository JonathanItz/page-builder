<?php

use App\Models\Page;

/*
|--------------------------------------------------------
| Generate ID
|--------------------------------------------------------
| Generates a random ID for a page model
|
*/
function generateID() {
    return substr(strrev(microtime(true) * 10000), 0, 5);
}

/*
|--------------------------------------------------------
| Max number of pages
|--------------------------------------------------------
| Check if the user has reached the maximum number
| of pages we allow
|
*/
function userHasReachedMaxPages(int $maxPages = 5): bool {
    $user = auth()->user();
    $pagesCount = $user->pages()->count();

    if($pagesCount >= $maxPages) {
        return true;
    }

    return false;
}

/*
|--------------------------------------------------------
| Days left in trial
|--------------------------------------------------------
| Returns an integer if there are days left.
| Returns false if there is no trial left.
|
*/
function getDaysLeftInTrial(): bool|int {
    $user = auth()->user();
    $daysLeft = 0;

    if($user->onTrial()) {
        $daysLeft = ceil(now()->diffInDays($user->trial_ends_at, true));
        return $daysLeft;
    }

    return false;
}

/*
|--------------------------------------------------------
| Days left in trial
|--------------------------------------------------------
| Returns an integer if there are days left.
| Returns false if there is no trial left.
|
*/
function hasAccess(): bool {
    $user = auth()->user();

    if($user->onTrial() || $user->subscribed()) {
        return true;
    }

    return false;
}

/*
|--------------------------------------------------------
| Generate black or white hex code for color
|--------------------------------------------------------
| Look at hex code and find out if we
| need to user black or white for text
|
*/
function getContrastColor($hexColor) {
        // hexColor RGB
        $R1 = hexdec(substr($hexColor, 1, 2));
        $G1 = hexdec(substr($hexColor, 3, 2));
        $B1 = hexdec(substr($hexColor, 5, 2));

        // Black RGB
        $blackColor = "#000000";
        $R2BlackColor = hexdec(substr($blackColor, 1, 2));
        $G2BlackColor = hexdec(substr($blackColor, 3, 2));
        $B2BlackColor = hexdec(substr($blackColor, 5, 2));

        // Calc contrast ratio
         $L1 = 0.2126 * pow($R1 / 255, 2.2) +
               0.7152 * pow($G1 / 255, 2.2) +
               0.0722 * pow($B1 / 255, 2.2);

        $L2 = 0.2126 * pow($R2BlackColor / 255, 2.2) +
              0.7152 * pow($G2BlackColor / 255, 2.2) +
              0.0722 * pow($B2BlackColor / 255, 2.2);

        $contrastRatio = 0;
        if ($L1 > $L2) {
            $contrastRatio = (int)(($L1 + 0.05) / ($L2 + 0.05));
        } else {
            $contrastRatio = (int)(($L2 + 0.05) / ($L1 + 0.05));
        }

        // If contrast is more than 5, return black color
        if ($contrastRatio > 7) {
            return '#000000';
        } else { 
            // if not, return white color.
            return '#FFFFFF';
        }
}