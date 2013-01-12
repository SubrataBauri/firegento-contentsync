<?php

/**
 * This file is part of the FIREGENTO project.
 * 
 * Copyright (c) 2013 mzentrale | eCommerce - eBusiness
 * 
 * FireGento_ContentSync is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License version 3 as
 * published by the Free Software Foundation.
 * 
 * This script is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * 
 * PHP version 5
 * 
 * @category  FireGento
 * @package   FireGento_ContentSync
 * @author    FireGento Team <team@firegento.com>
 * @copyright 2013 FireGento Team (http://www.firegento.de). All rights served.
 * @license   http://opensource.org/licenses/gpl-3.0 GNU General Public License, version 3 (GPLv3)
 * @version   $Id:$
 * @since     0.1.0
 */

/**
 * Content Sync Hash Helper
 * 
 * @category  FireGento
 * @package   FireGento_ContentSync
 * @author    FireGento Team <team@firegento.com>
 */
class FireGento_ContentSync_Helper_Hash extends Mage_Core_Helper_Abstract
{

    /**
     * 
     * @return array
     */
    protected function _getFieldBlacklist()
    {
        return array(
            'contentsync_hash',
            'added_at',
            'modified_at',
            'creation_time',
            'update_time',
        );
    }

    /**
     * Calculate object hash
     * 
     * @param Varien_Object $object
     * @param string $algo
     * @return string
     */
    public function calculateObjectHash(Varien_Object $object, $algo = 'sha1')
    {
        $hashData = array();
        foreach ($object->getData() as $key => $value) {
            if (!in_array($key, $this->_getFieldBlacklist())) {
                $hashData[$key] = $value;
            }
        }
        ksort($hashData);
        return hash($algo, serialize($hashData));
    }
}
