<?php
    class EquipmentModel extends DB {
        public function getInfoEquipments($user = []) {
            $arr = $this->selectAllTable("thietbi");
            if (!empty($arr)) {
                foreach ($arr as $key => $item) {
                    if (!empty($item['linkimg_TB'])) {
                        $arr[$key]['linkimg_TB'] = _WEB_ROOT . '/public/assets/images/equipments/' . $item['linkimg_TB'];
                    }
                }
            }
            return $arr;
        }
    }