<?php
/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.23.0-f5592a4 modeling language!*/

class Location
{

  //------------------------
  // MEMBER VARIABLES
  //------------------------

  //Location Attributes
  private $locationName;
  private $volume;
  private $mute;

  //Location Associations
  private $album;
  private $song;
  private $playlist;

  //------------------------
  // CONSTRUCTOR
  //------------------------

  public function __construct($aLocationName, $aVolume, $aMute, $aAlbum, $aSong, $aPlaylist)
  {
    $this->locationName = $aLocationName;
    $this->volume = $aVolume;
    $this->mute = $aMute;
    $didAddAlbum = $this->setAlbum($aAlbum);
    if (!$didAddAlbum)
    {
      throw new Exception("Unable to create location due to album");
    }
    $didAddSong = $this->setSong($aSong);
    if (!$didAddSong)
    {
      throw new Exception("Unable to create location due to song");
    }
    $didAddPlaylist = $this->setPlaylist($aPlaylist);
    if (!$didAddPlaylist)
    {
      throw new Exception("Unable to create location due to playlist");
    }
  }

  //------------------------
  // INTERFACE
  //------------------------

  public function setLocationName($aLocationName)
  {
    $wasSet = false;
    $this->locationName = $aLocationName;
    $wasSet = true;
    return $wasSet;
  }

  public function setVolume($aVolume)
  {
    $wasSet = false;
    $this->volume = $aVolume;
    $wasSet = true;
    return $wasSet;
  }

  public function setMute($aMute)
  {
    $wasSet = false;
    $this->mute = $aMute;
    $wasSet = true;
    return $wasSet;
  }

  public function getLocationName()
  {
    return $this->locationName;
  }

  public function getVolume()
  {
    return $this->volume;
  }

  public function getMute()
  {
    return $this->mute;
  }

  public function getAlbum()
  {
    return $this->album;
  }

  public function getSong()
  {
    return $this->song;
  }

  public function getPlaylist()
  {
    return $this->playlist;
  }

  public function setAlbum($aAlbum)
  {
    $wasSet = false;
    if ($aAlbum == null)
    {
      return $wasSet;
    }
    
    $existingAlbum = $this->album;
    $this->album = $aAlbum;
    if ($existingAlbum != null && $existingAlbum != $aAlbum)
    {
      $existingAlbum->removeLocation($this);
    }
    $this->album->addLocation($this);
    $wasSet = true;
    return $wasSet;
  }

  public function setSong($aSong)
  {
    $wasSet = false;
    if ($aSong == null)
    {
      return $wasSet;
    }
    
    $existingSong = $this->song;
    $this->song = $aSong;
    if ($existingSong != null && $existingSong != $aSong)
    {
      $existingSong->removeLocation($this);
    }
    $this->song->addLocation($this);
    $wasSet = true;
    return $wasSet;
  }

  public function setPlaylist($aPlaylist)
  {
    $wasSet = false;
    if ($aPlaylist == null)
    {
      return $wasSet;
    }
    
    $existingPlaylist = $this->playlist;
    $this->playlist = $aPlaylist;
    if ($existingPlaylist != null && $existingPlaylist != $aPlaylist)
    {
      $existingPlaylist->removeLocation($this);
    }
    $this->playlist->addLocation($this);
    $wasSet = true;
    return $wasSet;
  }

  public function equals($compareTo)
  {
    return $this == $compareTo;
  }

  public function delete()
  {
    $placeholderAlbum = $this->album;
    $this->album = null;
    $placeholderAlbum->removeLocation($this);
    $placeholderSong = $this->song;
    $this->song = null;
    $placeholderSong->removeLocation($this);
    $placeholderPlaylist = $this->playlist;
    $this->playlist = null;
    $placeholderPlaylist->removeLocation($this);
  }

}
?>