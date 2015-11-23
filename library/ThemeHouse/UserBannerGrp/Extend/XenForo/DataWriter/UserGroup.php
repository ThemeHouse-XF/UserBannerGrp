<?php

/**
 *
 * @see XenForo_DataWriter_UserGroup
 */
class ThemeHouse_UserBannerGrp_Extend_XenForo_DataWriter_UserGroup extends XFCP_ThemeHouse_UserBannerGrp_Extend_XenForo_DataWriter_UserGroup
{

    /**
     *
     * @see XenForo_DataWriter_UserGroup::_getFields()
     */
    protected function _getFields()
    {
        $fields = parent::_getFields();
        
        $fields['xf_user_group']['user_banner_group_id_th'] = array(
            'type' => self::TYPE_UINT,
            'default' => 0
        );
        
        return $fields;
    }

    /**
     *
     * @see XenForo_DataWriter_UserGroup::_preSave()
     */
    protected function _preSave()
    {
        if (isset($GLOBALS['XenForo_ControllerAdmin_UserGroup'])) {
            /* @var $controller XenForo_ControllerAdmin_UserGroup */
            $controller = $GLOBALS['XenForo_ControllerAdmin_UserGroup'];
            
            $input = $controller->getInput()->filter(
                array(
                    'user_banner_group_id' => XenForo_Input::UINT,
                    'user_banner_group_id_shown' => XenForo_Input::BOOLEAN
                ));
            
            if ($input['user_banner_group_id_shown']) {
                $this->set('user_banner_group_id_th', $input['user_banner_group_id']);
            }
        }
        
        parent::_preSave();
    }

    /**
     *
     * @see XenForo_DataWriter_UserGroup::_postSave()
     */
    protected function _postSave()
    {
        parent::_postSave();
        
        if ($this->isChanged('banner_css_class') || $this->isChanged('banner_text') ||
             $this->isChanged('display_style_priority')) {
            // user banner cache already rebuilt
        } elseif ($this->isChanged('user_banner_group_id_th')) {
            $this->_getUserGroupModel()->rebuildUserBannerCache();
        }
    }
}