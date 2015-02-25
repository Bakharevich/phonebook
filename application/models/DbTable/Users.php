<?php
class Model_DbTable_Users extends Phonebook_Db_Table {
    protected $_name = 'users';
    protected $_primary = 'user_id';

    public function getUserByEmail($email)
    {
        $select = $this->select()
                       ->where('email = ?', $email);

        $result = $this->fetchAll($select);

        echo "<pre>"; print_r($result);

        if (count($result) > 0) {
            return $result;
        }
    }
}