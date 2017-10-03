<?php
/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.23.0-f5592a4 modeling language!*/

class Artist
{

  //------------------------
  // MEMBER VARIABLES
  //------------------------

  //Artist Attributes
  private $artistName;

  //Artist Associations
  private $songs;

  //------------------------
  // CONSTRUCTOR
  //------------------------

  public function __construct($aArtistName)
  {
    $this->artistName = $aArtistName;
    $this->songs = array();
  }

  //------------------------
  // INTERFACE
  //------------------------

  public function setArtistName($aArtistName)
  {
    $wasSet = false;
    $this->artistName = $aArtistName;
    $wasSet = true;
    return $wasSet;
  }

  public function getArtistName()
  {
    return $this->artistName;
  }

  public function getSong_index($index)
  {
    $aSong = $this->songs[$index];
    return $aSong;
  }

  public function getSongs()
  {
    $newSongs = $this->songs;
    return $newSongs;
  }

  public function numberOfSongs()
  {
    $number = count($this->songs);
    return $number;
  }

  public function hasSongs()
  {
    $has = $this->numberOfSongs() > 0;
    return $has;
  }

  public function indexOfSong($aSong)
  {
    $wasFound = false;
    $index = 0;
    foreach($this->songs as $song)
    {
      if ($song->equals($aSong))
      {
        $wasFound = true;
        break;
      }
      $index += 1;
    }
    $index = $wasFound ? $index : -1;
    return $index;
  }

  public static function minimumNumberOfSongs()
  {
    return 0;
  }

  public function addSong($aSong)
  {
    $wasAdded = false;
    if ($this->indexOfSong($aSong) !== -1) { return false; }
    $this->songs[] = $aSong;
    if ($aSong->indexOfArtist($this) != -1)
    {
      $wasAdded = true;
    }
    else
    {
      $wasAdded = $aSong->addArtist($this);
      if (!$wasAdded)
      {
        array_pop($this->songs);
      }
    }
    return $wasAdded;
  }

  public function removeSong($aSong)
  {
    $wasRemoved = false;
    if ($this->indexOfSong($aSong) == -1)
    {
      return $wasRemoved;
    }

    $oldIndex = $this->indexOfSong($aSong);
    unset($this->songs[$oldIndex]);
    if ($aSong->indexOfArtist($this) == -1)
    {
      $wasRemoved = true;
    }
    else
    {
      $wasRemoved = $aSong->removeArtist($this);
      if (!$wasRemoved)
      {
        $this->songs[$oldIndex] = $aSong;
        ksort($this->songs);
      }
    }
    $this->songs = array_values($this->songs);
    return $wasRemoved;
  }

  public function addSongAt($aSong, $index)
  {  
    $wasAdded = false;
    if($this->addSong($aSong))
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfSongs()) { $index = $this->numberOfSongs() - 1; }
      array_splice($this->songs, $this->indexOfSong($aSong), 1);
      array_splice($this->songs, $index, 0, array($aSong));
      $wasAdded = true;
    }
    return $wasAdded;
  }

  public function addOrMoveSongAt($aSong, $index)
  {
    $wasAdded = false;
    if($this->indexOfSong($aSong) !== -1)
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfSongs()) { $index = $this->numberOfSongs() - 1; }
      array_splice($this->songs, $this->indexOfSong($aSong), 1);
      array_splice($this->songs, $index, 0, array($aSong));
      $wasAdded = true;
    } 
    else 
    {
      $wasAdded = $this->addSongAt($aSong, $index);
    }
    return $wasAdded;
  }

  public function equals($compareTo)
  {
    return $this == $compareTo;
  }

  public function delete()
  {
    $copyOfSongs = $this->songs;
    $this->songs = array();
    foreach ($copyOfSongs as $aSong)
    {
      $aSong->removeArtist($this);
    }
  }

}
?>