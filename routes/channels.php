<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.Admin.{id}', function ($admin, $id) {
    return auth('admin')->check() && (int) auth('admin')->id() === (int) $id;
});

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return auth('web')->check() && (int) auth('web')->id() === (int) $id;
});
