<?php

use App\Models\Setting;

if (!function_exists('setting')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function setting($key,$default=null)
    {
        return Setting::getBykey($key,$default);
    }
}
