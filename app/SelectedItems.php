<?php
    
    namespace App;
    
    use Illuminate\Database\Eloquent\Model;
    use DB;
    
    class SelectedItems extends Model {
        protected $table = 'selected_items';
        protected $fillable = [ 'item_id', ];
        
        /**
         * ----------
         * @param $info
         * @param $item_id
         * @return mixed
         * upsert item
         * ----------
         */
        
        public function upsert ( $info, $item_id ) {
            $find = SelectedItems ::where ( 'item_id', $item_id ) -> first ();
            
            if ( !$find ) {
                $item = SelectedItems ::create ( $info );
                return $item -> id;
            }
            else {
                DB ::delete ( "Delete from im_selected_items where item_id=$item_id" );
                return false;
            }
        }
        
    }
