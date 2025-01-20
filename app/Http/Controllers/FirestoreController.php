<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Cloud\Firestore\FirestoreClient;

class FirestoreController extends Controller {
    protected static $db;

    protected static function firestoreDatabaseInstance() {
        $db = new FirestoreClient( [
            'projectId'=> 'cahaya-mulya-abadi'
        ] );

        return $db;
    }

    public function __construct() {
        static::$db = self::firestoreDatabaseInstance();

    }

    public function index() {
        $docRef = self::$db->collection( 'users' );
        $snapshot = $docRef->documents();
        $users = [];
        foreach ( $snapshot as $user ) {
            if ( $user->exists() ) {
                $users[] = $user->data();
            }
        }
        dd( $users );
        return json_encode( $users );

    }
}
