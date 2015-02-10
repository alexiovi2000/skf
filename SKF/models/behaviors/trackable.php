<?php
/**
 * Trackable Behavior
 * This behavior is based on Matt Curry Trackable Behaviour (http://www.pseudocoder.com/)
 * @author Massimiliano Bertinetti (mbertim@gmail.com)
 * @link http://www.swap-hq.com
 * @filesource http://www.swap-hq.com/trackable
 * @version 1.0.0
 * @lastmodified 2010-01-22
 */

class TrackableBehavior extends ModelBehavior {

    function BeforeSave(&$model) {
        $currentuser = Configure::read('User');

        if (empty($model->data[$model->alias]['id'])) {
            $model->data[$model->alias]['created_by'] = $currentuser['User']['id'];
        }

        $model->data[$model->alias]['modified_by'] = $currentuser['User']['id'];

        return true;
    }

    
}
?>
