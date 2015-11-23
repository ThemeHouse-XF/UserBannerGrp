<?php

class ThemeHouse_UserBannerGrp_Listener_LoadClass extends ThemeHouse_Listener_LoadClass
{

    protected function _getExtendedClasses()
    {
        return array(
            'ThemeHouse_UserBannerGrp' => array(
                'controller' => array(
                    'XenForo_ControllerAdmin_UserGroup'
                ),
                'datawriter' => array(
                    'XenForo_DataWriter_UserGroup'
                ),
                'model' => array(
                    'XenForo_Model_UserGroup'
                ),
            ),
        );
    }

    public static function loadClassController($class, array &$extend)
    {
        $extend = self::createAndRun('ThemeHouse_UserBannerGrp_Listener_LoadClass', $class, $extend, 'controller');
    }

    public static function loadClassDataWriter($class, array &$extend)
    {
        $extend = self::createAndRun('ThemeHouse_UserBannerGrp_Listener_LoadClass', $class, $extend, 'datawriter');
    }

    public static function loadClassModel($class, array &$extend)
    {
        $extend = self::createAndRun('ThemeHouse_UserBannerGrp_Listener_LoadClass', $class, $extend, 'model');
    }
}