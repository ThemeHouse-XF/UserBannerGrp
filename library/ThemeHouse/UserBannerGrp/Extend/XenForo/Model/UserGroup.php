<?php

/**
 *
 * @see XenForo_Model_UserGroup
 */
class ThemeHouse_UserBannerGrp_Extend_XenForo_Model_UserGroup extends XFCP_ThemeHouse_UserBannerGrp_Extend_XenForo_Model_UserGroup
{

    /**
     *
     * @see XenForo_Model_UserGroup::rebuildUserBannerCache()
     */
    public function rebuildUserBannerCache()
    {
        $cache = parent::rebuildUserBannerCache();
        
        $userBannerGroupModel = $this->getModelFromCache('ThemeHouse_UserBannerGrp_Model_UserBannerGroup');
        $userBannerGroups = $userBannerGroupModel->getUserBannerGroups();
        
        $userGroups = $this->getAllUserGroups();
        
        $updateCache = false;
        foreach ($userGroups as $userGroupId => $userGroup) {
            if (!empty($cache[$userGroupId]) && !empty($userGroup['user_banner_group_id_th']) &&
                 isset($userBannerGroups[$userGroup['user_banner_group_id_th']])) {
                $userBannerGroupId = $userGroup['user_banner_group_id_th'];
                $cache[$userGroupId]['user_banner_group_id'] = $userBannerGroupId;
                $updateCache = true;
            }
        }
        
        if ($updateCache) {
            $this->_getDataRegistryModel()->set('userBanners', $cache);
        }
        
        $userBannerGroupModel->rebuildUserBannerGroupCache();
        
        return $cache;
    }
}