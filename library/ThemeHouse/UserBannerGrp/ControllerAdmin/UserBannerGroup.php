<?php

class ThemeHouse_UserBannerGrp_ControllerAdmin_UserBannerGroup extends XenForo_ControllerAdmin_Abstract
{

    /**
     *
     * @return XenForo_ControllerResponse_Abstract
     */
    public function actionIndex()
    {
        $userBannerGroupModel = $this->_getUserBannerGroupModel();
        
        $viewParams = array(
            'userBannerGroups' => $this->_getUserBannerGroupModel()->getUserBannerGroups()
        );
        
        return $this->responseView('ThemeHouse_UserBannerGrp_ViewAdmin_UserBannerGroup_List',
            'th_user_banner_group_list_userbannergroups', $viewParams);
    }

    /**
     *
     * @return XenForo_ControllerResponse_Abstract
     */
    protected function _getUserBannerGroupAddEditResponse(array $userBannerGroup)
    {
        $userBannerGroupModel = $this->_getUserBannerGroupModel();
        
        $viewParams = array(
            'userBannerGroup' => $userBannerGroup
        );
        
        return $this->responseView('ThemeHouse_UserBannerGrp_ViewAdmin_UserBannerGroup_Edit',
            'th_user_banner_group_edit_userbannergroups', $viewParams);
    }

    /**
     *
     * @return XenForo_ControllerResponse_Abstract
     */
    public function actionAdd()
    {
        $userBannerGroup = array();
        
        return $this->_getUserBannerGroupAddEditResponse($userBannerGroup);
    }

    /**
     *
     * @return XenForo_ControllerResponse_Abstract
     */
    public function actionEdit()
    {
        $userBannerGroupId = $this->_input->filterSingle('user_banner_group_id', XenForo_Input::UINT);
        $userBannerGroup = $this->_getUserBannerGroupOrError($userBannerGroupId);
        
        return $this->_getUserBannerGroupAddEditResponse($userBannerGroup);
    }

    /**
     *
     * @return XenForo_ControllerResponse_Abstract
     */
    public function actionSave()
    {
        $this->_assertPostOnly();
        
        $userBannerGroupId = $this->_input->filterSingle('user_banner_group_id', XenForo_Input::UINT);
        $dwData = $this->_input->filter(
            array(
                'title' => XenForo_Input::STRING,
                'display_multiple' => XenForo_Input::BOOLEAN,
                'display_style_priority' => XenForo_Input::UINT,
                'banner_css_class' => XenForo_Input::STRING
            ));
        
        $dw = XenForo_DataWriter::create('ThemeHouse_UserBannerGrp_DataWriter_UserBannerGroup');
        if ($userBannerGroupId) {
            $dw->setExistingData($userBannerGroupId);
        }
        $dw->bulkSet($dwData);
        $dw->save();
        
        $userBannerGroupId = $dw->get('user_banner_group_id');
        
        return $this->responseRedirect(XenForo_ControllerResponse_Redirect::SUCCESS, 
            XenForo_Link::buildAdminLink('user-banner-groups') . $this->getLastHash($userBannerGroupId));
    }

    /**
     *
     * @return XenForo_ControllerResponse_Abstract
     */
    public function actionDelete()
    {
        if ($this->isConfirmedPost()) {
            return $this->_deleteData('ThemeHouse_UserBannerGrp_DataWriter_UserBannerGroup', 'user_banner_group_id',
                XenForo_Link::buildAdminLink('user-banner-groups'));
        } else {
            $userBannerGroupId = $this->_input->filterSingle('user_banner_group_id', XenForo_Input::UINT);
            $userBannerGroup = $this->_getUserBannerGroupOrError($userBannerGroupId);
            
            $viewParams = array(
                'userBannerGroup' => $userBannerGroup
            );
            
            return $this->responseView('ThemeHouse_UserBannerGrp_ViewAdmin_UserBannerGroup_Delete',
                'th_user_banner_group_delete_userbannergroups', $viewParams);
        }
    }

    /**
     *
     * @return array
     */
    protected function _getUserBannerGroupOrError($userBannerGroupId)
    {
        return $this->getRecordOrError($userBannerGroupId, $this->_getUserBannerGroupModel(), 'getUserBannerGroupById', 
            'th_user_banner_group_not_found_userbannergroups');
    }

    /**
     *
     * @return ThemeHouse_UserBannerGrp_Model_UserBannerGroup
     */
    protected function _getUserBannerGroupModel()
    {
        return $this->getModelFromCache('ThemeHouse_UserBannerGrp_Model_UserBannerGroup');
    }
}