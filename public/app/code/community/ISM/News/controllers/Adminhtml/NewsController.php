<?php

class ISM_News_Adminhtml_NewsController extends Mage_Adminhtml_Controller_Action
{
    private function newOrEditAction(){
        $id = (int) $this->getRequest()->getParam('id');
        Mage::register('current_news', Mage::getModel('news/news')->load($id));

        $this->loadLayout()->_setActiveMenu('news');
        $this->_addContent($this->getLayout()->createBlock('news/adminhtml_news_edit'));
        $this->renderLayout();
    }
    public function indexAction()
    {
        $this->loadLayout()->_setActiveMenu('news');
        $this->_addContent($this->getLayout()->createBlock('news/adminhtml_news'));
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->newOrEditAction();
    }

    public function editAction()
    {
        $this->newOrEditAction();
    }

    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            try {
                $model = Mage::getModel('news/news');
                $model->setData($data)->setId($this->getRequest()->getParam('id'));
                if(!$model->getCreated()){
                    $model->setCreated(now());
                }
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('News was saved successfully'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array(
                    'id' => $this->getRequest()->getParam('id')
                ));
            }
            return;
        }
        Mage::getSingleton('adminhtml/session')->addError($this->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                Mage::getModel('news/news')->setId($id)->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('News was deleted successfully'));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $id));
            }
        }
        $this->_redirect('*/*/');
    }
}