<?php
//
// DESCRIPTION
//
class Phonebook_Db_Table extends Zend_Db_Table {
    public function getAll($params = array(), $options = array())
    {
        $select = $this->select();

        if (!empty($params)) {
            foreach ($params as $index => $value) {
                if (!empty($value) || $value == '0') {
                    $select->where($index . ' = ?', $value);
                }
            }
        }
        if (!empty($options['limit']) || !empty($options)) {
            $limit = !empty($options['limit']) ? $options['limit'] : 0;
            $offset = !empty($options['offset']) ? $options['offset'] : 0;

            $select->limit($limit, $offset);
        }
        if (!empty($options['order'])) {
            $select->order($options['order']);
        }

        $result = $this->fetchAll($select);

        if ($result->count() > 0) {
            return $result;
        }
    }
}