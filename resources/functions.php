<?php

use App\Models\Page;

/*
|--------------------------------------------------------
| Generate ID
|--------------------------------------------------------
| Generates a random ID for a page model
|
*/
function generatePageID() {
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
    $userId = $user->id;
    $pagesCount = Page::where('user_id', $userId)->count();

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