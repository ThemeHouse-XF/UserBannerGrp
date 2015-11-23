<?php

/**
 *
 * @see XenForo_ControllerAdmin_UserGroup
 */
class ThemeHouse_UserBannerGrp_Extend_XenForo_ControllerAdmin_UserGroup extends XFCP_ThemeHouse_UserBannerGrp_Extend_XenForo_ControllerAdmin_UserGroup
{
    
    protected function _getUserGroupAddEditResponse(array $userGroup)
    {
        $response = parent::_getUserGroupAddEditResponse($userGroup);
        
        if ($response instanceof XenForo_ControllerResponse_View) {
            /* @var $userBannerGroupModel ThemeHouse_UserBannerGrp_Model_UserBannerGroup */
            $userBannerGroupModel = $this->getModelFromCache('ThemeHouse_UserBannerGrp_Model_UserBannerGroup');
            
            $response->params['userBannerGroups'] = $userBannerGroupModel->getUserBannerGroups();
        }
        
        return $response;
    }
    
    public function actionSave()
    {
        $GLOBALS['XenForo_ControllerAdmin_UserGroup'] = $this;
        
        return parent::actionSave();
    }
}