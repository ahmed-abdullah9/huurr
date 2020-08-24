<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Job as job;
use App\Proposal;
use Carbon\Carbon;
use App\Category;
use Session, DB;
use Illuminate\Support\Facades\Crypt;
class HelperController extends Controller
{
	public static function maybe_unserialize( $original ) {
	        if ( self::is_serialized( $original ) ) 
	                return @unserialize( $original );
	        return $original;
	}
	public static function is_serialized( $data, $strict = true ) {
	        if ( ! is_string( $data ) ) {
	                return false;
	        }
	        $data = trim( $data );
	        if ( 'N;' == $data ) {
	                return true;
	        }
	        if ( strlen( $data ) < 4 ) {
	                return false;
	        }
	        if ( ':' !== $data[1] ) {
	                return false;
	        }
	        if ( $strict ) {
	                $lastc = substr( $data, -1 );
	                if ( ';' !== $lastc && '}' !== $lastc ) {
	                        return false;
	                }
	        } else {
	                $semicolon = strpos( $data, ';' );
	                $brace     = strpos( $data, '}' );
	                if ( false === $semicolon && false === $brace )
	                        return false;
	                if ( false !== $semicolon && $semicolon < 3 )
	                        return false;
	                if ( false !== $brace && $brace < 4 )
	                        return false;
	        }
	        $token = $data[0];
	        switch ( $token ) {
	                case 's' :
	                        if ( $strict ) {
	                                if ( '"' !== substr( $data, -2, 1 ) ) {
	                                        return false;
	                                }
	                        } elseif ( false === strpos( $data, '"' ) ) {
	                                return false;
	                        }
	                case 'a' :
	                case 'O' :
	                        return (bool) preg_match( "/^{$token}:[0-9]+:/s", $data );
	                case 'b' :
	                case 'i' :
	                case 'd' :
	                        $end = $strict ? '$' : '';
	                        return (bool) preg_match( "/^{$token}:[0-9.E-]+;$end/", $data );
	        }
	        return false;
	}
	
	public static function maybe_serialize( $data ) {
	        if ( is_array( $data ) || is_object( $data ) )
	                return serialize( $data );

	        if ( self::is_serialized( $data, false ) )
                return serialize( $data );
	
        return $data;
	}
}
