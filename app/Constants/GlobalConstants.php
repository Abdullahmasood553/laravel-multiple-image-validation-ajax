<?php

namespace App\Constants;



class GlobalConstants 
{
    const USER_IMAGE = "users";
    const ALL = 'All';
    const PRICE_RANGE = [
                         '50-1k'         => '50-1000',
                         '1k-5k'         => '1000-5000',
                         '5k-10k'        => '5000-10000',
                         '10k-20k'       => '10000-100000',
                         'More than 20k' => '100000-more'
                        ];

    const LIST_COUNTRIES = ["Pakistan", "Saudia Arabia", "Qatar", "Oman", "Turkey", "USA"];
    const DEPARTMENT = ["Software", "Hardware", "Electrical", "Mechanical"];    
    const SOCIAL_MEDIA_INSTAGRAM = "instagram";
    const SOCIAL_MEDIA_SNAPCHAT = "snapchat";
    const SOCIAL_MEDIA_TIKTOK = "tiktok";                

    
    const LIST_SOCIAL_MEDIA = [self::SOCIAL_MEDIA_INSTAGRAM, self::SOCIAL_MEDIA_SNAPCHAT, self::SOCIAL_MEDIA_TIKTOK];

}
