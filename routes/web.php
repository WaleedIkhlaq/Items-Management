<?php
    
    use Illuminate\Support\Facades\Route;
    
    Route ::get ( '/', 'Items@index');
    Route ::post ( '/add_items', 'Items@add_items');
    Route ::post ( '/upsert_items', 'Items@upsert_items');
