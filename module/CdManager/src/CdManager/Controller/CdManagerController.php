<?php
namespace CdManager\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CdManagerController extends AbstractActionController {

    protected $_CdManagerTable;

    public function indexAction() {
        return new ViewModel(array(
                    'CdManager' => $this->getCdManagerTable()->fetchAll(),
                ));
    }

    public function addAction() {
        $request = $this->getRequest();
        $response = $this->getResponse();
        if ($request->isPost()) {
            $new_cd = new \CdManager\Model\Entity\CD();
            if (!$cd_id = $this->getCdManagerTable()->saveCD($new_cd))
                $response->setContent(\Zend\Json\Json::encode(array('response' => false)));
            else {
                $response->setContent(\Zend\Json\Json::encode(array('response' => true, 'new_cd_id' => $cd_id)));
            }
        }
        return $response;
    }

    public function removeAction() {
        $request = $this->getRequest();
        $response = $this->getResponse();
        if ($request->isPost()) {
            $post_data = $request->getPost();
            $cd_id = $post_data['id'];
            if (!$this->getCdManagerTable()->removeCD($cd_id))
                $response->setContent(\Zend\Json\Json::encode(array('response' => false)));
            else {
                $response->setContent(\Zend\Json\Json::encode(array('response' => true)));
            }
        }
        return $response;
    }

    public function updateAction() {
        // update post
        $request = $this->getRequest();
        $response = $this->getResponse();
        if ($request->isPost()) {
            $post_data = $request->getPost();
            list($cd_column, $cd_id)=explode('-', $post_data['id']);
            $cd_content = $post_data['content'];
            $cd = $this->getCdManagerTable()->getCD($cd_id, $cd_column);
            $node='set'.ucfirst($cd_column);
            $cd->$node($cd_content);
            if (!$this->getCdManagerTable()->saveCD($cd))
                $response->setContent(\Zend\Json\Json::encode(array('response' => false)));
            else {
                $response->setContent(\Zend\Json\Json::encode(array('response' => true)));
            }
        }
        return $response;
    }

    public function getCdManagerTable() {
        if (!$this->_CdManagerTable) {
            $sm = $this->getServiceLocator();
            $this->_CdManagerTable = $sm->get('CdManager\Model\CdManagerTable');
        }
        return $this->_CdManagerTable;
    }

}