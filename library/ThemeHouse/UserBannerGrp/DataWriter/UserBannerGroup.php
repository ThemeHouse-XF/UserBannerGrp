<?php

class ThemeHouse_UserBannerGrp_DataWriter_UserBannerGroup extends XenForo_DataWriter
{

    /**
     * Gets the fields that are defined for the table.
     * See parent for explanation.
     *
     * @return array
     */
    protected function _getFields()
    {
        return array(
            'xf_user_banner_group_th' => array(
                'user_banner_group_id' => array(
                    'type' => self::TYPE_UINT,
                    'autoIncrement' => true
                ),
                'title' => array(
                    'type' => self::TYPE_STRING,
                    'required' => true
                ),
                'display_multiple' => array(
                    'type' => self::TYPE_BOOLEAN,
                    'default' => 0
                ),
                'display_style_priority' => array(
                    'type' => self::TYPE_UINT,
                    'default' => 0
                ),
                'banner_css_class' => array(
                    'type' => self::TYPE_STRING,
                    'default' => ''
                )
            )
        );
    }

    /**
     * Gets the actual existing data out of data that was passed in.
     * See parent for explanation.
     *
     * @param mixed
     *
     * @return array|false
     */
    protected function _getExistingData($data)
    {
        if (!$userBannerGroupId = $this->_getExistingPrimaryKey($data, 'user_banner_group_id')) {
            return false;
        }

        $userBannerGroup = $this->_getUserBannerGroupModel()->getUserBannerGroupById($userBannerGroupId);
        if (!$userBannerGroup) {
            return false;
        }

        return $this->getTablesDataFromArray($userBannerGroup);
    }

    /**
     * Gets SQL condition to update the existing record.
     *
     * @return string
     */
    protected function _getUpdateCondition($tableName)
    {
        return 'user_banner_group_id = ' . $this->_db->quote($this->getExisting('user_banner_group_id'));
    }
    
    protected function _postSave()
    {
        $this->_getUserBannerGroupModel()->rebuildUserBannerGroupCache();
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