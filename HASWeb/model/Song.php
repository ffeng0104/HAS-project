<?php
/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.23.0-f5592a4 modeling language!*/

class Song
{

  //------------------------
  // MEMBER VARIABLES
  //------------------------

  //Song Attributes
  private $songTitle;
  private $songDuration;
  private $songPositionAlbum;

  //Song Associations
  private $locations;
  private $albums;
  private $playlists;
  private $artists;

  //------------------------
  // CONSTRUCTOR
  //------------------------

  public function __construct($aSongTitle, $aSongDuration, $aSongPositionAlbum)
  {
    $this->songTitle = $aSongTitle;
    $this->songDuration = $aSongDuration;
    $this->songPositionAlbum = $aSongPositionAlbum;
    $this->locations = array();
    $this->albums = array();
    $this->playlists = array();
    $this->artists = array();
  }

  //------------------------
  // INTERFACE
  //------------------------

  public function setSongTitle($aSongTitle)
  {
    $wasSet = false;
    $this->songTitle = $aSongTitle;
    $wasSet = true;
    return $wasSet;
  }

  public function setSongDuration($aSongDuration)
  {
    $wasSet = false;
    $this->songDuration = $aSongDuration;
    $wasSet = true;
    return $wasSet;
  }

  public function setSongPositionAlbum($aSongPositionAlbum)
  {
    $wasSet = false;
    $this->songPositionAlbum = $aSongPositionAlbum;
    $wasSet = true;
    return $wasSet;
  }

  public function getSongTitle()
  {
    return $this->songTitle;
  }

  public function getSongDuration()
  {
    return $this->songDuration;
  }

  public function getSongPositionAlbum()
  {
    return $this->songPositionAlbum;
  }

  public function getLocation_index($index)
  {
    $aLocation = $this->locations[$index];
    return $aLocation;
  }

  public function getLocations()
  {
    $newLocations = $this->locations;
    return $newLocations;
  }

  public function numberOfLocations()
  {
    $number = count($this->locations);
    return $number;
  }

  public function hasLocations()
  {
    $has = $this->numberOfLocations() > 0;
    return $has;
  }

  public function indexOfLocation($aLocation)
  {
    $wasFound = false;
    $index = 0;
    foreach($this->locations as $location)
    {
      if ($location->equals($aLocation))
      {
        $wasFound = true;
        break;
      }
      $index += 1;
    }
    $index = $wasFound ? $index : -1;
    return $index;
  }

  public function getAlbum_index($index)
  {
    $aAlbum = $this->albums[$index];
    return $aAlbum;
  }

  public function getAlbums()
  {
    $newAlbums = $this->albums;
    return $newAlbums;
  }

  public function numberOfAlbums()
  {
    $number = count($this->albums);
    return $number;
  }

  public function hasAlbums()
  {
    $has = $this->numberOfAlbums() > 0;
    return $has;
  }

  public function indexOfAlbum($aAlbum)
  {
    $wasFound = false;
    $index = 0;
    foreach($this->albums as $album)
    {
      if ($album->equals($aAlbum))
      {
        $wasFound = true;
        break;
      }
      $index += 1;
    }
    $index = $wasFound ? $index : -1;
    return $index;
  }

  public function getPlaylist_index($index)
  {
    $aPlaylist = $this->playlists[$index];
    return $aPlaylist;
  }

  public function getPlaylists()
  {
    $newPlaylists = $this->playlists;
    return $newPlaylists;
  }

  public function numberOfPlaylists()
  {
    $number = count($this->playlists);
    return $number;
  }

  public function hasPlaylists()
  {
    $has = $this->numberOfPlaylists() > 0;
    return $has;
  }

  public function indexOfPlaylist($aPlaylist)
  {
    $wasFound = false;
    $index = 0;
    foreach($this->playlists as $playlist)
    {
      if ($playlist->equals($aPlaylist))
      {
        $wasFound = true;
        break;
      }
      $index += 1;
    }
    $index = $wasFound ? $index : -1;
    return $index;
  }

  public function getArtist_index($index)
  {
    $aArtist = $this->artists[$index];
    return $aArtist;
  }

  public function getArtists()
  {
    $newArtists = $this->artists;
    return $newArtists;
  }

  public function numberOfArtists()
  {
    $number = count($this->artists);
    return $number;
  }

  public function hasArtists()
  {
    $has = $this->numberOfArtists() > 0;
    return $has;
  }

  public function indexOfArtist($aArtist)
  {
    $wasFound = false;
    $index = 0;
    foreach($this->artists as $artist)
    {
      if ($artist->equals($aArtist))
      {
        $wasFound = true;
        break;
      }
      $index += 1;
    }
    $index = $wasFound ? $index : -1;
    return $index;
  }

  public static function minimumNumberOfLocations()
  {
    return 0;
  }

  public function addLocationVia($aLocationName, $aVolume, $aMute, $aAlbum, $aPlaylist)
  {
    return new Location($aLocationName, $aVolume, $aMute, $aAlbum, $this, $aPlaylist);
  }

  public function addLocation($aLocation)
  {
    $wasAdded = false;
    if ($this->indexOfLocation($aLocation) !== -1) { return false; }
    $existingSong = $aLocation->getSong();
    $isNewSong = $existingSong != null && $this !== $existingSong;
    if ($isNewSong)
    {
      $aLocation->setSong($this);
    }
    else
    {
      $this->locations[] = $aLocation;
    }
    $wasAdded = true;
    return $wasAdded;
  }

  public function removeLocation($aLocation)
  {
    $wasRemoved = false;
    //Unable to remove aLocation, as it must always have a song
    if ($this !== $aLocation->getSong())
    {
      unset($this->locations[$this->indexOfLocation($aLocation)]);
      $this->locations = array_values($this->locations);
      $wasRemoved = true;
    }
    return $wasRemoved;
  }

  public function addLocationAt($aLocation, $index)
  {  
    $wasAdded = false;
    if($this->addLocation($aLocation))
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfLocations()) { $index = $this->numberOfLocations() - 1; }
      array_splice($this->locations, $this->indexOfLocation($aLocation), 1);
      array_splice($this->locations, $index, 0, array($aLocation));
      $wasAdded = true;
    }
    return $wasAdded;
  }

  public function addOrMoveLocationAt($aLocation, $index)
  {
    $wasAdded = false;
    if($this->indexOfLocation($aLocation) !== -1)
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfLocations()) { $index = $this->numberOfLocations() - 1; }
      array_splice($this->locations, $this->indexOfLocation($aLocation), 1);
      array_splice($this->locations, $index, 0, array($aLocation));
      $wasAdded = true;
    } 
    else 
    {
      $wasAdded = $this->addLocationAt($aLocation, $index);
    }
    return $wasAdded;
  }

  public static function minimumNumberOfAlbums()
  {
    return 0;
  }

  public function addAlbum($aAlbum)
  {
    $wasAdded = false;
    if ($this->indexOfAlbum($aAlbum) !== -1) { return false; }
    $this->albums[] = $aAlbum;
    if ($aAlbum->indexOfSong($this) != -1)
    {
      $wasAdded = true;
    }
    else
    {
      $wasAdded = $aAlbum->addSong($this);
      if (!$wasAdded)
      {
        array_pop($this->albums);
      }
    }
    return $wasAdded;
  }

  public function removeAlbum($aAlbum)
  {
    $wasRemoved = false;
    if ($this->indexOfAlbum($aAlbum) == -1)
    {
      return $wasRemoved;
    }

    $oldIndex = $this->indexOfAlbum($aAlbum);
    unset($this->albums[$oldIndex]);
    if ($aAlbum->indexOfSong($this) == -1)
    {
      $wasRemoved = true;
    }
    else
    {
      $wasRemoved = $aAlbum->removeSong($this);
      if (!$wasRemoved)
      {
        $this->albums[$oldIndex] = $aAlbum;
        ksort($this->albums);
      }
    }
    $this->albums = array_values($this->albums);
    return $wasRemoved;
  }

  public function addAlbumAt($aAlbum, $index)
  {  
    $wasAdded = false;
    if($this->addAlbum($aAlbum))
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfAlbums()) { $index = $this->numberOfAlbums() - 1; }
      array_splice($this->albums, $this->indexOfAlbum($aAlbum), 1);
      array_splice($this->albums, $index, 0, array($aAlbum));
      $wasAdded = true;
    }
    return $wasAdded;
  }

  public function addOrMoveAlbumAt($aAlbum, $index)
  {
    $wasAdded = false;
    if($this->indexOfAlbum($aAlbum) !== -1)
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfAlbums()) { $index = $this->numberOfAlbums() - 1; }
      array_splice($this->albums, $this->indexOfAlbum($aAlbum), 1);
      array_splice($this->albums, $index, 0, array($aAlbum));
      $wasAdded = true;
    } 
    else 
    {
      $wasAdded = $this->addAlbumAt($aAlbum, $index);
    }
    return $wasAdded;
  }

  public static function minimumNumberOfPlaylists()
  {
    return 0;
  }

  public function addPlaylist($aPlaylist)
  {
    $wasAdded = false;
    if ($this->indexOfPlaylist($aPlaylist) !== -1) { return false; }
    $this->playlists[] = $aPlaylist;
    if ($aPlaylist->indexOfSong($this) != -1)
    {
      $wasAdded = true;
    }
    else
    {
      $wasAdded = $aPlaylist->addSong($this);
      if (!$wasAdded)
      {
        array_pop($this->playlists);
      }
    }
    return $wasAdded;
  }

  public function removePlaylist($aPlaylist)
  {
    $wasRemoved = false;
    if ($this->indexOfPlaylist($aPlaylist) == -1)
    {
      return $wasRemoved;
    }

    $oldIndex = $this->indexOfPlaylist($aPlaylist);
    unset($this->playlists[$oldIndex]);
    if ($aPlaylist->indexOfSong($this) == -1)
    {
      $wasRemoved = true;
    }
    else
    {
      $wasRemoved = $aPlaylist->removeSong($this);
      if (!$wasRemoved)
      {
        $this->playlists[$oldIndex] = $aPlaylist;
        ksort($this->playlists);
      }
    }
    $this->playlists = array_values($this->playlists);
    return $wasRemoved;
  }

  public function addPlaylistAt($aPlaylist, $index)
  {  
    $wasAdded = false;
    if($this->addPlaylist($aPlaylist))
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfPlaylists()) { $index = $this->numberOfPlaylists() - 1; }
      array_splice($this->playlists, $this->indexOfPlaylist($aPlaylist), 1);
      array_splice($this->playlists, $index, 0, array($aPlaylist));
      $wasAdded = true;
    }
    return $wasAdded;
  }

  public function addOrMovePlaylistAt($aPlaylist, $index)
  {
    $wasAdded = false;
    if($this->indexOfPlaylist($aPlaylist) !== -1)
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfPlaylists()) { $index = $this->numberOfPlaylists() - 1; }
      array_splice($this->playlists, $this->indexOfPlaylist($aPlaylist), 1);
      array_splice($this->playlists, $index, 0, array($aPlaylist));
      $wasAdded = true;
    } 
    else 
    {
      $wasAdded = $this->addPlaylistAt($aPlaylist, $index);
    }
    return $wasAdded;
  }

  public static function minimumNumberOfArtists()
  {
    return 0;
  }

  public function addArtist($aArtist)
  {
    $wasAdded = false;
    if ($this->indexOfArtist($aArtist) !== -1) { return false; }
    $this->artists[] = $aArtist;
    if ($aArtist->indexOfSong($this) != -1)
    {
      $wasAdded = true;
    }
    else
    {
      $wasAdded = $aArtist->addSong($this);
      if (!$wasAdded)
      {
        array_pop($this->artists);
      }
    }
    return $wasAdded;
  }

  public function removeArtist($aArtist)
  {
    $wasRemoved = false;
    if ($this->indexOfArtist($aArtist) == -1)
    {
      return $wasRemoved;
    }

    $oldIndex = $this->indexOfArtist($aArtist);
    unset($this->artists[$oldIndex]);
    if ($aArtist->indexOfSong($this) == -1)
    {
      $wasRemoved = true;
    }
    else
    {
      $wasRemoved = $aArtist->removeSong($this);
      if (!$wasRemoved)
      {
        $this->artists[$oldIndex] = $aArtist;
        ksort($this->artists);
      }
    }
    $this->artists = array_values($this->artists);
    return $wasRemoved;
  }

  public function addArtistAt($aArtist, $index)
  {  
    $wasAdded = false;
    if($this->addArtist($aArtist))
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfArtists()) { $index = $this->numberOfArtists() - 1; }
      array_splice($this->artists, $this->indexOfArtist($aArtist), 1);
      array_splice($this->artists, $index, 0, array($aArtist));
      $wasAdded = true;
    }
    return $wasAdded;
  }

  public function addOrMoveArtistAt($aArtist, $index)
  {
    $wasAdded = false;
    if($this->indexOfArtist($aArtist) !== -1)
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfArtists()) { $index = $this->numberOfArtists() - 1; }
      array_splice($this->artists, $this->indexOfArtist($aArtist), 1);
      array_splice($this->artists, $index, 0, array($aArtist));
      $wasAdded = true;
    } 
    else 
    {
      $wasAdded = $this->addArtistAt($aArtist, $index);
    }
    return $wasAdded;
  }

  public function equals($compareTo)
  {
    return $this == $compareTo;
  }

  public function delete()
  {
    foreach ($this->locations as $aLocation)
    {
      $aLocation->delete();
    }
    $copyOfAlbums = $this->albums;
    $this->albums = array();
    foreach ($copyOfAlbums as $aAlbum)
    {
      $aAlbum->removeSong($this);
    }
    $copyOfPlaylists = $this->playlists;
    $this->playlists = array();
    foreach ($copyOfPlaylists as $aPlaylist)
    {
      $aPlaylist->removeSong($this);
    }
    $copyOfArtists = $this->artists;
    $this->artists = array();
    foreach ($copyOfArtists as $aArtist)
    {
      $aArtist->removeSong($this);
    }
  }

}
?>