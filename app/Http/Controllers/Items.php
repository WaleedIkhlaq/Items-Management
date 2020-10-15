<?php
    
    namespace App\Http\Controllers;
    
    use Illuminate\Http\Request;
    use App\Item;
    use App\SelectedItems;
    
    class Items extends Controller {
        
        private $itemModel;
        private $selectedItemModel;
        
        /**
         * ---------------------
         * Items constructor.
         * loads modal instance
         * ---------------------
         */
        
        public function __construct () {
            $this -> itemModel = new Item();
            $this -> selectedItemModel = new SelectedItems();
        }
        
        /**
         * ---------------------
         * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
         * loads index page
         * passes page title
         * ---------------------
         */
        
        public function index () {
            $data[ 'title' ] = 'Items Management';
            $data[ 'items' ] = $this -> itemModel -> get_items_not_selected ();
            $data[ 'selectedItems' ] = $this -> itemModel -> get_selected_items ();
            return view ( 'index', $data );
        }
        
        /**
         * ---------------------
         * @param Request $data
         * @return \Illuminate\Http\RedirectResponse
         * @throws \Illuminate\Validation\ValidationException
         * validate the request type
         * call relevent function
         * ---------------------
         */
        
        public function add_items ( Request $data ) {
            
            $this -> validate ( $data, [
                'title' => 'required|min:1|unique:items',
            ] );

            $info = array (
                'title' => $data[ 'title' ],
            );

            $id = $this -> itemModel -> add ( $info );

            if ( $id > 0 )
                return redirect () -> back () -> with ( 'message', 'Success! Item has been added.' );
            else
                return redirect () -> back () -> withErrors ( 'error', 'Oops! Something went wrong.' ) -> withInput ();
            
        }
        
        /**
         * ---------------------
         * @param Request $data
         * @return \Illuminate\Http\RedirectResponse
         * @throws \Illuminate\Validation\ValidationException
         * validate the request type
         * call relevent function
         * ---------------------
         */
        
        public function upsert_items ( Request $data ) {
            
            $this -> validate ( $data, [
                'item' => 'required',
            ] );

            $info = array (
                'item_id' => $data[ 'item' ],
            );

            $id = $this -> selectedItemModel -> upsert ( $info, $data[ 'item' ] );

            if ( $id > 0 )
                return redirect () -> back () -> with ( 'message', 'Success! Item has been added to selected list.' );
            else
                return redirect () -> back () -> withErrors ( 'error', 'Success! Item moved back.' ) -> withInput ();
            
        }
        
    }
