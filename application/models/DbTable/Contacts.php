<?php
class Model_DbTable_Contacts extends Phonebook_Db_Table {
    protected $_name = 'contacts';
    protected $_primary = 'contact_id';

    public function getContactsByUserId($userId, $search = '', $options = array())
    {
        $select = $this->select()
                       ->where('user_id = ?', $userId);

        // search
        if (!empty($search)) {
            $select->where('name LIKE ?', '%' . $search . '%');
            $select->orWhere('phone LIKE ?', '%' . $search . '%');
            $select->orWhere('notes LIKE ?', '%' . $search . '%');
            $select->orWhere('created_at LIKE ?', '%' . $search . '%');
        }

        // limit
        if (!empty($options['limit']) || !empty($options)) {
            $limit = !empty($options['limit']) ? $options['limit'] : 0;
            $offset = !empty($options['offset']) ? $options['offset'] : 0;

            $select->limit($limit, $offset);
        }

        // order
        if (!empty($options['order'])) {
            $select->order($options['order']);
        }
        else {
            $select->order('contact_id DESC');
        }

        $result = $this->fetchAll($select);

        return $result;
    }

    public function getContactById($contactId)
    {
        $select = $this->select()
                       ->where('contact_id = ?', $contactId);

        $result = $this->fetchRow($select);

        if (count($result) > 0) {
            return $result;
        }
    }

    public function setContact($contactId, $params = array())
    {
        $select = $this->select()->where('contact_id = ?', $contactId);

        $row = $this->fetchRow($select);

        if (!empty($row->contact_id)) {
            $this->update($params, array("contact_id = ?" => $contactId));

            return true;
        }
        else {
            return false;
        }
    }

    public function deleteContact($contactId)
    {
        $this->delete(array('contact_id = ?' => $contactId));
    }
}