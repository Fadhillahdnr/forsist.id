<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('admin-dashboard', function () {
    return true;
});
