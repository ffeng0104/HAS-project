<?php
require_once 'controller/InputValidator.php';
require_once 'model/Album.php';
require_once 'model/Artist.php';
require_once 'model/Library.php';
require_once 'model/Location.php';
require_once 'model/Playlist.php';
require_once 'model/Song.php';
require_once 'persistence/PersistenceHAS.php';

class Controller
{
	public function __construct(){
		
	}
	
	public function addSong($nameSong){
		$ok=0;
		$error="";
		$names = InputValidator::validate_input($nameSong);

	
		if($names == null || strlen($names) == 0){
			$error .= "@1Song name cannot be empty! ";
			$ok=1;
		}
	
		if($ok==1){
			throw new Exception(trim($error));
		}
	
		if($ok==0)
		{
			echo $ok;
	
			$pm = new PersistenceHAS();
			$rm = $pm->loadDataFromStore();
				
			$song = new Song($names);
			$rm->addSong($song);
				
			$pm->writeDataToStore($rm);
	
		}	
	}
	
	public function addAlbum($albumGenre, $releaseDate, $nameAlbum,$artistAlbum){
		$ok=0;
        $error="";
        $name = InputValidator::validate_input($nameAlbum);
        $date = InputValidator::validate_input($releaseDate);
        $genre = InputValidator::validate_input($albumGenre);
        $artist = InputValidator::validate_input($artistAlbum);
    //    $song = InputValidator::validate_input($songAlbum);
      
		if($genre == null || strlen($genre) == 0){
				$error .= "@1Album genre cannot be empty! ";
			$ok=1;	
			}
			
		if($name == null || strlen($name) == 0){
				$error .= "@3Album name cannot be empty! ";
				$ok=1;
			}
			
		if($artist == null || strlen($artist) == 0){
				$error .= "@4Artist cannot be empty! ";
				$ok=1;
			}
			
        $rdate=date('Y-m-d', strtotime($releaseDate));
	
        if($date ==null || strlen($date)!=10 ){
        	$error.="@2Release date must be specified correctly (YYYY-MM-DD)! ";
        	$ok =1;
        }
        
        if($ok==1){
		      throw new Exception(trim($error));
          }
          
        if($ok==0)
        {
          echo $ok;
  
          $pm = new PersistenceHAS();
			$rm = $pm->loadDataFromStore();
			
			$album = new Album($genre, $rdate, $name, $artist);
			$rm->addAlbum($album);
			
			$pm->writeDataToStore($rm);  
            
            
            
        }
        
        
	}
	
	public function addLocation($nameLocation){
		$ok=0;
		$error="";
		$loc = InputValidator::validate_input($nameLocation);
	
	
		if($loc == null || strlen($loc) == 0){
			$error .= "@1Location cannot be empty! ";
			$ok=1;
		}
	
		if($ok==1){
			throw new Exception(trim($error));
		}
	
		if($ok==0)
		{
			echo $ok;
	
			$pm = new PersistenceHAS();
			$rm = $pm->loadDataFromStore();
	
			$location = new Location($loc);
			$rm->addLocation($location);
	
			$pm->writeDataToStore($rm);
	
		}
	}
	
	public function load_song()
	{
		$pm = new PersistenceHAS();
		$rm = $pm->loadDataFromStore();
		
		$mysong = "";
		foreach ($rm->getSongs() as $song){
				
			$mysong.="<option>".$song->getName()."</option>";
		return $mysong;
	}
	}
	
	public function load_location()
	{
		$pm = new PersistenceHAS();
		$rm = $pm->loadDataFromStore();
	
		$myloc = "";
		foreach ($rm->getLocations() as $location){
	
			$myloc.="<option>".$location->getName()."</option>";
			return $myloc;
		}
	}
	
    public function load_album()
    {
       $pm = new PersistenceHAS();
		$rm = $pm->loadDataFromStore();
		$myalbum = "";
		foreach ($rm->getAlbums() as $album){
			
            $myalbum.="<option>".$album->getName()."</option>";
		}
        return $myalbum;
  }

  public function play($aLocation, $aAlbum, $aSong){
  	$pm = new PersistenceHAS();
  	$rm = $pm->loadDataFromStore();
  
  	$mylocation = NULL;
  	foreach ($rm->getLocations() as $location){
  		if(strcmp($location->getName(), $aLocation) == 0){
  			$mylocation = $location;
  			break;
  		}
  	}
  	$myalbum = NULL;
  	foreach ($rm->getAlbums() as $album){
  		if(strcmp($album->getName(), $aAlbum) == 0){
  			$myalbum = $album;
  			break;
  		}
  	}
  	$mysong = NULL;
  	foreach ($rm->getSongs() as $song){
  		if (strcmp($song->getName(), $aSong) == 0){
  			$mysong = $song;
  			break;
  		}
  	}
  
  	$error = "";
  	if($mylocation != NULL && $myalbum != NULL && $mysong != NULL) {
  		$myplay = new Play($mylocation, $myalbum, $mysong);
  		$rm->addPlay($myplay);
  		$pm->writeDataToStore($rm);
  	} else{
  		if($mylocation == NULL){
  			$error .= "@1Location";
  			if ($aLocation != NULL){
  				$error .= $aLocation;
  			}
  			$error .= " not found! ";
  		}
  		if($myalbum == NULL){
  			$error .= "@2Album";
  			if ($aAlbum != NULL){
  				$error .= $aAlbum;
  			}
  			$error .= " not found! ";
  		}
  			
  		if ($mysong == NULL){
  			$error .= "@4Song ";
  			if ($aSong != NULL){
  				$error .= $aSong;
  			}
  			$error .= " not found!";
  		}
  		throw new Exception(trim($error));
  	}
  }
  }

    
?>