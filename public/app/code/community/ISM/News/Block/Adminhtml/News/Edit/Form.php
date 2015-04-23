<?php

class ISM_News_Block_Adminhtml_News_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm()
    {
        $helper = Mage::helper('ismnews');
        $model = Mage::registry('current_news');

        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', array(
                'id' => $this->getRequest()->getParam('id')
            )),
            'method' => 'post',
            'enctype' => 'multipart/form-data'
        ));

        $this->setForm($form);

        $fieldset = $form->addFieldset('news_form', array('legend' => $helper->__('News Information')));

        $fieldset->addField('title', 'text', array(
            'label' => $helper->__('Title'),
            'required' => true,
            'name' => 'title',
        ));

        $fieldset->addField('content', 'editor', array(
            'name'      => 'content',
            'label'     => $helper->__('Content'),
            'title'     => $helper->__('Content'),
            'required'  => true,
            'config'    => Mage::getSingleton('cms/wysiwyg_config')->getConfig()
        ));

        $fieldset->addField('announce', 'editor', array(
            'name'      => 'announce',
            'label'     => $helper->__('Content'),
            'title'     => $helper->__('Content'),
            'required'  => false
        ));

        $fieldset->addField('publish_date', 'date', array(
            'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'label' => $helper->__('Publish date'),
            'name' => 'publish_date',
            'required'  => true
        ));

        $fieldset->addField('publish', 'date', array(
            'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'label' => $helper->__('Publish date'),
            'name' => 'publish_date',
            'required'  => true
        ));

        $form->setUseContainer(true);

//        if($data = Mage::getSingleton('adminhtml/session')->getFormData()){
//            $form->setValues($data);
//        } else {
//            $form->setValues($model->getData());
//        }

        return parent::_prepareForm();
    }

}