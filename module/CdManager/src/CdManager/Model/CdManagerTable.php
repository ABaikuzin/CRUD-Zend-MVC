<?php
namespace CdManager\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;

class CdManagerTable extends AbstractTableGateway {

    protected $table = 'CdManager';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }

    public function fetchAll() {
        $resultSet = $this->select(function (Select $select) {
                    $select->order('created ASC');
                });
        $entities = array();
        foreach ($resultSet as $row) {
            $entity = new Entity\CD();
            $entity->setId($row->id)
                    ->setName($row->name)
                    ->setYear($row->year)
                    ->setNote($row->note)
                    ->setCreated($row->created)
                    ->setUpdated($row->updated);
            $entities[] = $entity;
        }
        return $entities;
    }

    public function getCD($id) {
        $row = $this->select(array('id' => (int) $id))->current();
        if (!$row)
            return false;

        $cd = new Entity\CD(array(
                    'id' => $row->id,
                    'name' => $row->name,
                    'year' => $row->year,
                    'note' => $row->note,
                    'created' => $row->created,
                    'updated' => $row->updated,
                ));
        return $cd;
    }

    public function saveCD(Entity\CD $cd) {
        $data = array(
            'name' => $cd->getName(),
            'year' => $cd->getYear(),
            'note' => $cd->getNote(),
            'created' => $cd->getCreated(),
            'updated' => $cd->getUpdated(),
        );

        $id = (int) $cd->getId();

        if ($id == 0) {
            $data['created'] = date("Y-m-d H:i:s");
            if (!$this->insert($data))
                return false;
            return $this->getLastInsertValue();
        }
        elseif ($this->getCD($id)) {
            if (!$this->update($data, array('id' => $id)))
                return false;
            return $id;
        }
        else
            return false;
    }

    public function removeCD($id) {
        return $this->delete(array('id' => (int) $id));
    }

}