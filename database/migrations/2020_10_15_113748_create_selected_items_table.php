<?php
    
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;
    
    class CreateSelectedItemsTable extends Migration {
        
        /**
         * ---------------------
         * Run the migrations.
         * @return void
         * ---------------------
         */
        
        public function up () {
            Schema ::create ( 'selected_items', function ( Blueprint $table ) {
                $table -> id ();
                $table -> integer ( 'item_id' );
                $table -> timestamps ();
            } );
        }
        
        /**
         * ---------------------
         * Reverse the migrations.
         * @return void
         * ---------------------
         */
        
        public function down () {
            Schema ::dropIfExists ( 'selected_items' );
        }
    }
