<?php
/* @var $installer Mage_Sales_Model_Mysql4_Setup */
$installer = $this;
$catalogProduct = 'catalog_product';
$attribute_code = 'ism_newstoremembers_price';
$installer->addAttribute($catalogProduct, $attribute_code, array(
    'input' => 'text',
    'label' => 'NewstoreMember Price',
    'backend' => '',
    'frontend_class' => 'validate-number',
    'visible' => 1,
    'required' => 0,
    'user_defined' => 1,
    'searchable' => 0,
    'filterable' => 0,
    'sort_order' => 30,
    'comparable' => 0,
    'visible_on_front' => 0,
    'visible_in_advanced_search' => 0,
    'is_html_allowed_on_front' => 0,
    'is_configurable' => 1,
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,));

$group_name = 'prices';
$attribute_set_name = 'default';

//-------------- add attribute to set and group
$attribute_set_id = $installer->getAttributeSetId($catalogProduct, $attribute_set_name);
$attribute_group_id = $installer->getAttributeGroupId($catalogProduct, $attribute_set_id, $group_name);
$attribute_id = $installer->getAttributeId($catalogProduct, $attribute_code);

$installer->addAttributeToSet($catalogProduct, $attribute_set_id, $attribute_group_id, $attribute_id);
$installer->endSetup();

$group = Mage::getModel('customer/group')->setData(
    array('customer_group_code' => 'NewstoreMembers Group', 'tax_class_id' => 3))
    ->save();

$groups_value = array();

$groups_value['newstoremember_group']['fields']['newstoremember_field_group']['value'] = $group->getId();
Mage::getModel('adminhtml/config_data')
    ->setSection('newstoremember')
    ->setWebsite(null)
    ->setStore(null)
    ->setGroups($groups_value)
    ->save();