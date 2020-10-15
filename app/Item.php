<?php
    
    namespace App;
    
    use Illuminate\Database\Eloquent\Model;
    
    class Item extends Model {
        
        protected $table = 'items';
        protected $fillable = [ 'title', ];
        
        /**
         * ----------
         * @param $info
         * @return mixed
         * add item
         * ----------
         */
        
        public function add ( $info ) {
            $item = Item ::create ( $info );
            return $item -> id;
        }
    
        /**
         * ----------
         * @return mixed
         * get all items except selected
         * ----------
         */
        
        public function get_items_not_selected() {
            $selectedItems = SelectedItems ::pluck ( 'item_id' ) -> all ();
            return Item ::whereNotIn ( 'id', $selectedItems ) -> select ('*') -> get ();
        }
    
        /**
         * ----------
         * @return mixed
         * get all selected items
         * ----------
         */
        
        public function get_selected_items() {
            $selectedItems = SelectedItems ::pluck ( 'item_id' ) -> all ();
            return Item ::whereIn ( 'id', $selectedItems ) -> select ('*') -> get ();
        }
        
    }
