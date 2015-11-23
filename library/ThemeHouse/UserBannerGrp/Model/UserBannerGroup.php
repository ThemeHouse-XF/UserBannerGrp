<?php

class ThemeHouse_UserBannerGrp_Model_UserBannerGroup extends XenForo_Model
{

    public function getUserBannerGroupById($userBannerGroupId)
    {
        return $this->_getDb()->fetchRow(
            '
            SELECT *
            FROM xf_user_banner_group_th
            WHERE user_banner_group_id = ?
        ', $userBannerGroupId);
    }

    public function getUserBannerGroups(array $conditions = array(), array $fetchOptions = array())
    {
        $limitOptions = $this->prepareLimitFetchOptions($fetchOptions);
        
        return $this->fetchAllKeyed(
            $this->limitQueryResults('
            SELECT *
            FROM xf_user_banner_group_th
            ORDER BY display_style_priority DESC
        ', $limitOptions['limit'], $limitOptions['offset']), 
            'user_banner_group_id');
    }
    
    public function rebuildUserBannerGroupCache()
    {
        $userBannerGroups = $this->getUserBannerGroups();
        
        if ($userBannerGroups) {
            XenForo_Application::setSimpleCacheData('th_userBannerGroups', $userBannerGroups);
        } elseif (XenForo_Application::getSimpleCacheData('th_userBannerGroups')) {
            XenForo_Application::setSimpleCacheData('th_userBannerGroups', false);
        }
                
        return $userBannerGroups;
    }
}