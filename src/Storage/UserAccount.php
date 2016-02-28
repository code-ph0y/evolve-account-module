<?php
namespace AccountModule\Storage;

use AccountModule\Storage\Base as BaseStorage;
use AccountModule\Entity\UserAccount as UserAccountEntity;

class UserAccount extends BaseStorage
{
    protected $meta_data = array(
        'conn'      => 'main',
        'table'     => 'user_account',
        'primary'   => 'id',
        'fetchMode' => \PDO::FETCH_ASSOC
    );

    /**
     * Get a blank user account enitity
     *
     * @return mixed
     */
    public function getBlankEntity()
    {
        return new UserAccountEntity();
    }

    /**
     * Make a user account entity
     *
     * @param  $user_data
     * @return mixed
     */
    public function makeEntity($user_data)
    {
        return new UserAccountEntity($user_data);
    }

    /**
     * Get a user account entity by its id
     *
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function getById($id)
    {
        $row = $this->ds->createQueryBuilder()
            ->select('ua.*')
            ->from($this->meta_data['table'], 'ua')
            ->where('ua.id = :id')->setParameter(':id', $id)
            ->execute()
            ->fetch($this->meta_data['fetchMode']);

        if ($row === false) {
            throw new \Exception('Unable to obtain user account row from id: ' . $id);
        }

        return new UserAccountEntity($row);
    }

    /**
     * Get a user account entity by their user id
     *
     * @param $user_id
     * @return mixed
     * @throws \Exception
     */
    public function getByUserId($user_id)
    {
        $row = $this->ds->createQueryBuilder()
            ->select('ua.*')
            ->from($this->meta_data['table'], 'ua')
            ->where('ua.user_id = :user_id')->setParameter(':user_id', $user_id)
            ->execute()
            ->fetch($this->meta_data['fetchMode']);

        if ($row === false) {
            throw new \Exception('Unable to obtain user account row from user id: ' . $user_id);
        }

        return new UserAccountEntity($row);
    }

    /**
     * Get all user account entities
     *
     * @return mixed
     */
    public function getAll()
    {
        $rows = $this->ds->createQueryBuilder()
            ->select("ua.*")
            ->from($this->meta_data['table'], 'ua')
            ->execute()
            ->fetchAll($this->meta_data['fetchMode']);

        $entities = $this->rowsToEntities($rows);

        return $entities;
    }

    /**
     * Delete a user account by its id
     *
     * @param  string $id
     * @return mixed
     */
    public function deleteById($id)
    {
        return $this->delete(array('id' => $id));
    }

    /**
     * Create a user account record
     *
     * @param  array $user_account_data
     * @return integer
     */
    public function create(array $user_account_data)
    {
        $this->ds->insert(
            $this->meta_data['table'],
            $user_account_data
        );
        return $this->ds->lastInsertId();
    }

    /**
     * Update a user record
     *
     * @param  integer $id
     * @param  array $user_account_data
     * @return integer
     */
    public function update($id, array $user_account_data)
    {
        return $this->ds->update(
            $this->meta_data['table'],
            $user_account_data,
            array($this->meta_data['primary'] => $id)
        );
    }

    /**
     * Change array to entities
     *
     * @param  array $rows
     * @return mixed
     */
    public function rowsToEntities($rows)
    {
        $ent = array();
        foreach ($rows as $r) {
            $ent[] = new UserAccountEntity($r);
        }
        return $ent;
    }
}
