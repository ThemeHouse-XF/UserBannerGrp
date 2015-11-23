<?php

class ThemeHouse_UserBannerGrp_Listener_InitDependencies extends ThemeHouse_Listener_InitDependencies
{

    protected function _run()
    {
        $this->addHelperCallbacks(
            array(
                'th_userbanner_userbannergroups' => XenForo_Template_Helper_Core::$helperCallbacks['userbanner'],
                'userbanner' => array(
                    'ThemeHouse_UserBannerGrp_Template_Helper_Core',
                    'helperUserBanner'
                )
            ));
    }
    
    public static function initDependencies(XenForo_Dependencies_Abstract $dependencies, array $data)
    {
        $initDependencies = new ThemeHouse_UserBannerGrp_Listener_InitDependencies($dependencies, $data);
        $initDependencies->run();
    }
}