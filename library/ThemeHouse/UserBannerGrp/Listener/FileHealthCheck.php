<?php

class ThemeHouse_UserBannerGrp_Listener_FileHealthCheck
{

    public static function fileHealthCheck(XenForo_ControllerAdmin_Abstract $controller, array &$hashes)
    {
        $hashes = array_merge($hashes,
            array(
                'library/ThemeHouse/UserBannerGrp/ControllerAdmin/UserBannerGroup.php' => 'c617acfccfc29cb1c0e9a7a6f20d0043',
                'library/ThemeHouse/UserBannerGrp/DataWriter/UserBannerGroup.php' => 'b529f72836385240b87979980a496dfe',
                'library/ThemeHouse/UserBannerGrp/Extend/XenForo/ControllerAdmin/UserGroup.php' => '455d3f5b51ac3e67dbe40255ebfb6a30',
                'library/ThemeHouse/UserBannerGrp/Extend/XenForo/DataWriter/UserGroup.php' => 'cb903a6cf7b5e0c7aaa4d588bb0ec327',
                'library/ThemeHouse/UserBannerGrp/Extend/XenForo/Model/UserGroup.php' => '8ff3279b5312b09fc3a774ab1428c273',
                'library/ThemeHouse/UserBannerGrp/Install/Controller.php' => '6bb3f80e8c9b3794f7bacca9a02e72c7',
                'library/ThemeHouse/UserBannerGrp/Listener/InitDependencies.php' => '40d89b07593c4d0b3a702918cedbb502',
                'library/ThemeHouse/UserBannerGrp/Listener/LoadClass.php' => '0b32036dd8b1ce915fb6891e8dc661c7',
                'library/ThemeHouse/UserBannerGrp/Model/UserBannerGroup.php' => '0105176ab9c0d877f445d807d864e61d',
                'library/ThemeHouse/UserBannerGrp/Route/PrefixAdmin/UserBannerGroups.php' => '24c1c0f10b050fab649d1d7c202a4f2a',
                'library/ThemeHouse/UserBannerGrp/Template/Helper/Core.php' => '29cad3c88cd6046309387ca3821a13af',
                'library/ThemeHouse/Install.php' => '18f1441e00e3742460174ab197bec0b7',
                'library/ThemeHouse/Install/20151109.php' => '2e3f16d685652ea2fa82ba11b69204f4',
                'library/ThemeHouse/Deferred.php' => 'ebab3e432fe2f42520de0e36f7f45d88',
                'library/ThemeHouse/Deferred/20150106.php' => 'a311d9aa6f9a0412eeba878417ba7ede',
                'library/ThemeHouse/Listener/ControllerPreDispatch.php' => 'fdebb2d5347398d3974a6f27eb11a3cd',
                'library/ThemeHouse/Listener/ControllerPreDispatch/20150911.php' => 'f2aadc0bd188ad127e363f417b4d23a9',
                'library/ThemeHouse/Listener/InitDependencies.php' => '8f59aaa8ffe56231c4aa47cf2c65f2b0',
                'library/ThemeHouse/Listener/InitDependencies/20150212.php' => 'f04c9dc8fa289895c06c1bcba5d27293',
                'library/ThemeHouse/Listener/LoadClass.php' => '5cad77e1862641ddc2dd693b1aa68a50',
                'library/ThemeHouse/Listener/LoadClass/20150518.php' => 'f4d0d30ba5e5dc51cda07141c39939e3',
            ));
    }
}