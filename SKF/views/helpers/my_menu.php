<?php
/**
 * Menu Helper class file.
 *
 * Extend html helper
 */

class MyMenuHelper extends HtmlHelper{

	var $helpers = array('Html');


    function main_menu($items = array(), $class = null, $user_logged_role_id = 0){

        $output = '';

        if(is_array($items)){

            foreach($items as $label => $item) {

                $output_tmp = '';

                if (
                    (isset($item['enabled_roles']) && in_array($user_logged_role_id, $item['enabled_roles']) )
                    ||
                    (isset($item['enabled_roles']) && count($item['enabled_roles']) == 0)
                    ||
                    !isset($item['enabled_roles'])
                ) {
                    if ((isset($item['visible']) && $item['visible']) || !isset($item['visible'])) {

                // TODO: gestire corettamente i parametri x i link del menu
                        $params_tmp = array();
                        $target = (isset($item['target']) && $item['target']) ? $item['target'] : '#';
                        $label = (isset($item['label'])) ? $item['label'] : $label;

                        $class_link = ($class != null)? array('class' => $class) : null;
                        $class_link = (isset($item['items']) && sizeof($item['items']) > 0) ? $class_link : '';

                        $output .= '<li';
                        if(!empty($item['active'])){
                                $output .= ' class="selected"';
                        }
                        $output .= '>';

// TODO: veriifcare gestione traduzioni menu
                        $output .= $this->link(__($label,true), $target, $class_link, null, false);
//                                $output .= $this->link(__d('menu_description', $label, true), $target, $class_link, null, false);
// TODO: veriifcare gestione traduzioni menu

                        if(isset($item['items']) && sizeof($item['items']) > 0) {
                // genero sottomenu solo se ho voci visibili
                            $output_tmp = $this->main_menu($item['items'], $class, $user_logged_role_id);
                            if ($output_tmp) {
                                $output .= '<ul>';
                                $output .= $output_tmp;
                                $output .= '</ul>';
                            }
                        }
                        $output .= '</li>';
                    }
                }
            }
        }
        return $output;
    }




    /**
     *Generate Section Menu
     *
     * @param array $items contain main menu items
     * @return string $output section menu html
     */

/*
    function section_menu($items = array()){
            $output = "";
            if(is_array($items)){
                    foreach($items as $label => $item){
                            $target = (isset($item['target'])) ? $item['target'] : '#';
                            $label = (isset($item['label'])) ? $item['label'] : $label;
                            $output .= '<li>';
// TODO: veriifcare gestione traduzioni menu
                            $output .= $this->link(__($label, true), $target, null, null, false);
//                            $output .= $this->link(__d('menu_description', $label, true), $target, null, null, false);
// TODO: veriifcare gestione traduzioni menu
                            if(isset($item['items']) && sizeof($item['items']) > 0){
                                    $output .= '<ul>';
                                    $output .= $this->section_menu($item['items']);
                                    $output .= '</ul>';
                            }
                            $output .= '</li>';
                    }
            }
            return $output;
    }
*/

    /**
     *Generate Footer Menu
     *
     * @param array $items contain main menu items
     * @return string $output section menu html
     */
/*
    function footer_menu($items = array(), $class = null, $user_logged_role_id = 0){
            $output = array();

            if(is_array($items)) {
                foreach($items as $label => $item) {

                        if (
                            (isset($item['enabled_roles']) && in_array($user_logged_role_id, $item['enabled_roles']) )
                            ||
                            (isset($item['enabled_roles']) && count($item['enabled_roles']) == 0)
                            ||
                            !isset($item['enabled_roles'])
                        ) {

                        if ((isset($item['visible']) && $item['visible']) || !isset($item['visible'])) {
                            $target = (isset($item['target'])) ? $item['target'] : '#';
                            $label = (isset($item['label'])) ? $item['label'] : $label;
// TODO: veriifcare gestione traduzioni menu
                            $output[] = $this->link(__($label, true), $target, null, null, false);
//                            $output[] = $this->link(__d('menu_description', $label, true), $target, null, null, false);
// TODO: veriifcare gestione traduzioni menu


                        }
                    }

                }
            }
            return implode(' | ',$output);
    }
*/
}
?>