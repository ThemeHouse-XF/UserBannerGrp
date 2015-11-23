<?php

class ThemeHouse_UserBannerGrp_Template_Helper_Core extends XenForo_Template_Helper_Core
{

    /**
     * Helper to get the user banner for the specified user.
     *
     * @param array $user
     * @param boolean $allowCustomTitle Allows the user title to come from the
     * custom title
     * @param boolean $disableStacking If true, stacking is always disabled
     * (highest priority title used)
     *
     * @return string
     */
    public static function helperUserBanner($user, $extraClass = '', $disableStacking = false)
    {
        $opt = XenForo_Application::getOptions()->userBanners;
        
        if (!$opt['displayMultiple'] || $disableStacking) {
            return XenForo_Template_Helper_Core::callHelper('th_userbanner_userbannergroups',
                array(
                    $user,
                    $extraClass,
                    $disableStacking
                ));
        }
        
        if (!is_array($user) || !array_key_exists('user_group_id', $user) ||
             !array_key_exists('secondary_group_ids', $user)) {
            return '';
        }
        
        if (empty($user['user_id'])) {
            $user['user_group_id'] = XenForo_Model_User::$defaultGuestGroupId;
            $user['secondary_group_ids'] = '';
        }
        
        $banners = array();
        $opt = XenForo_Application::getOptions()->userBanners;
        
        $memberGroupIds = array(
            $user['user_group_id']
        );
        if (!empty($user['secondary_group_ids'])) {
            $memberGroupIds = array_merge($memberGroupIds, explode(',', $user['secondary_group_ids']));
        }
        
        $userBannerGroups = XenForo_Application::getSimpleCacheData('th_userBannerGroups');
        
        $bannerGroups = array();
        foreach (self::$_userBanners as $groupId => $banner) {
            if (!in_array($groupId, $memberGroupIds)) {
                continue;
            }
            
            $bannerGroupId = $banner['user_banner_group_id'];
            
            if ($bannerGroupId && !isset($userBannerGroups[$bannerGroupId])) {
                continue;
            }
            
            $bannerText = '<em class="' . $banner['class'] . ' ' . $extraClass . ' ' . $userBannerGroups[$bannerGroupId]['banner_css_class'] .
                 '" itemprop="title"><span class="before"></span><strong>' . $banner['text'] .
                 '</strong><span class="after"></span></em>';
            
            if (!$bannerGroupId || !$userBannerGroups[$bannerGroupId]['display_style_priority']) {
                if (!$bannerGroupId || $userBannerGroups[$bannerGroupId]['display_multiple'] ||
                     empty($userBannerGroups[$bannerGroupId]['banners'])) {
                    $banners[$groupId] = $bannerText;
                }
            }
            
            $userBannerGroups[$bannerGroupId]['banners'][] = $bannerText;
        }
        
        foreach ($userBannerGroups as $userBannerGroupId => $userBannerGroup) {
            if (!$userBannerGroup['display_style_priority']) {
                continue;
            }
            if (empty($userBannerGroup['banners'])) {
                continue;
            }
            if ($userBannerGroup['display_multiple']) {
                $bannerGroups[$userBannerGroupId] = implode("\n", $userBannerGroup['banners']);
            } else {
                $bannerGroups[$userBannerGroupId] = reset($userBannerGroup['banners']);
            }
        }
        
        if ($bannerGroups) {
            $banners = array(
                'groups' => implode("\n", $bannerGroups)
            ) + $banners;
        }
        
        if (!empty($user['is_staff']) && !empty($opt['showStaff'])) {
            $p = new XenForo_Phrase('staff_member');
            $banners = array(
                'staff' => '<em class="userBanner bannerStaff ' . $extraClass .
                     '" itemprop="title"><span class="before"></span><strong>' . $p .
                     '</strong><span class="after"></span></em>'
            ) + $banners;
        }
        
        if (!$banners) {
            return '';
        }
        
        if ($opt['displayMultiple'] && !$disableStacking) {
            return implode("\n", $banners);
        } else 
            if ($opt['showStaffAndOther'] && isset($banners['staff']) && count($banners) >= 2) {
                $staffBanner = $banners['staff'];
                unset($banners['staff']);
                return $staffBanner . "\n" . reset($banners);
            } else {
                return reset($banners);
            }
    }
}