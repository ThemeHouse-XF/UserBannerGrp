<?php

class ThemeHouse_UserBannerGrp_Install_Controller extends ThemeHouse_Install
{

    protected $_resourceManagerUrl = 'https://xenforo.com/community/resources/user-banner-groups.4216/';
    
    protected $_minVersionId = 1020000;
    
    protected $_minVersionString = '1.2.0';
    
    protected function _getTables()
    {
        return array(
            'xf_user_banner_group_th' => array(
                'user_banner_group_id' => 'int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
                'title' => 'varchar(255) NOT NULL',
                'display_multiple' => 'tinyint UNSIGNED NOT NULL DEFAULT 0',
                'display_style_priority' => 'int UNSIGNED NOT NULL DEFAULT 0',
                'banner_css_class' => 'varchar(75) NOT NULL'
            )
        );
    }

    protected function _getTableChanges()
    {
        return array(
            'xf_user_group' => array(
                'user_banner_group_id_th' => 'int UNSIGNED NOT NULL DEFAULT 0'
            )
        );
    }


    protected function _postInstall()
    {
        $addOn = $this->getModelFromCache('XenForo_Model_AddOn')->getAddOnById('YoYo_');
        if ($addOn) {
            $db->query("
                INSERT INTO xf_user_banner_group_th (user_banner_group_id, title, display_multiple, display_style_priority, banner_css_class)
                    SELECT user_banner_group_id, title, display_multiple, display_style_priority, banner_css_class
                        FROM xf_user_banner_group_waindigo"); 
            $db->query("
                UPDATE xf_user_group
                    SET user_banner_group_id_th=user_banner_group_id_waindigo");
        }
    }
}