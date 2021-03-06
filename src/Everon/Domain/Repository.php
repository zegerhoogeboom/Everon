<?php
/**
 * This file is part of the Everon framework.
 *
 * (c) Oliwier Ptak <oliwierptak@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Everon\Domain;

use Everon\DataMapper\Interfaces\Criteria;
use Everon\Dependency;
use Everon\Domain\Interfaces;
use Everon\Interfaces\Collection;
use Everon\Interfaces\DataMapper;
use Everon\Helper;

abstract class Repository implements Interfaces\Repository
{
    use \Everon\Domain\Dependency\Injection\DomainManager;
    use Dependency\Injection\Factory;
    
    /**
     * @var DataMapper
     */
    protected $Mapper = null;
    
    protected $name = null;

    /**
     * @var Collection
     */
    protected $RelationCollection = null;

    /**
     * @param Interfaces\Entity $Entity
     * @param Criteria $Criteria
     * @return mixed
     */
    abstract public function buildEntityRelations(Interfaces\Entity $Entity, Criteria $Criteria);


    /**
     * @param $name
     * @param DataMapper $Mapper
     */
    public function __construct($name, DataMapper $Mapper)
    {
        $this->name = $name;
        $this->Mapper = $Mapper;
    }
    
    protected function buildRelations(Interfaces\Entity $Entity, Criteria $RelationCriteria=null)
    {
        $RelationCriteria = $RelationCriteria ?: (new \Everon\DataMapper\Criteria())->limit(20)->offset(0);
        $this->buildEntityRelations($Entity, $RelationCriteria);
    }
    
    /**
     * @inheritdoc
     */
    public function getMapper()
    {
        return $this->Mapper;
    }

    /**
     * @inheritdoc
     */
    public function setMapper(DataMapper $Mapper)
    {
        $this->Mapper = $Mapper;
    }
    
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function buildFromArray(array $data)
    {
        $Entity = $this->buildEntity($data);
        return $Entity;
    }
   
    /**
     * @inheritdoc
     */
    public function persistFromArray(array $data, $user_id)
    {
        $Entity = $this->buildFromArray($data);
        $this->persist($Entity, $user_id);
        return $Entity;
    }
      
    protected function buildEntity(array $data, Criteria $RelationCriteria=null)
    {
        $Entity = $this->getFactory()->buildDomainEntity($this->getName(), $this->getMapper()->getTable()->getPk(), $data);
        $this->buildRelations($Entity, $RelationCriteria);
        return $Entity;
    } 
    
    public function validateEntityData(Interfaces\Entity $Entity)
    {
        $data = $Entity->toArray();
        return $this->getMapper()->getTable()->validateData($data, $Entity->isNew() === false);
    }
    
    /**
     * @param $id
     * @param Criteria $RelationCriteria
     * @return Interfaces\Entity|null
     */
    public function getEntityById($id, Criteria $RelationCriteria=null)
    {
        $Criteria = (new \Everon\DataMapper\Criteria())->where([
            $this->getMapper()->getTable()->getPk() => $id
        ]);
        return $this->getOneByCriteria($Criteria, $RelationCriteria);
    }

    /**
     * @inheritdoc
     */
    public function getOneByCriteria(Criteria $Criteria, Criteria $RelationCriteria=null)
    {
        $Criteria->limit(1);
        $Criteria->offset(0);
        $data = $this->getMapper()->fetchOneByCriteria($Criteria);
        if (empty($data)) {
            return null;
        }

        return $this->buildEntity($data, $RelationCriteria);
    }

    /**
     * @param Criteria $Criteria
     * @param Criteria $RelationCriteria
     * @return array|null
     */
    public function getByCriteria(Criteria $Criteria, Criteria $RelationCriteria=null)
    {
        $data = $this->getMapper()->fetchAll($Criteria);
        if (empty($data)) {
            return null;
        }
        
        $result = [];
        foreach ($data as $item) {
            $result[] = $this->buildEntity($item, $RelationCriteria);
        }
        
        return $result;
    }

    /**
     * @inheritdoc
     */
    public function persist(Interfaces\Entity $Entity, $user_id)
    {
        $data = $Entity->toArray();
        if ($Entity->isNew()) {
            $data = $this->getMapper()->add($data, $user_id);
        }
        else {
            $this->getMapper()->save($data, $user_id);
        }

        $Entity->persist($data);
    }

    /**
     * @inheritdoc
     */
    public function remove(Interfaces\Entity $Entity, $user_id)
    {
        $this->getMapper()->delete($Entity->getId(), $user_id);
        $Entity->delete();
    }
}