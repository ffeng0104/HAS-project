/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.23.0-ebfd285 modeling language!*/

package model;

import java.sql.Date;
import java.util.*;

// line 10 "model.ump"
// line 52 "model.ump"
public class Album
{

  //------------------------
  // MEMBER VARIABLES
  //------------------------

  //Album Attributes
  private String albumGenre;
  private String releaseDate;
  private String nameAlbum;

  //Album Associations
  private List<Location> locations;
  private List<Song> songs;

  //------------------------
  // CONSTRUCTOR
  //------------------------

  public Album(String aAlbumGenre, Date releaseDate, String aNameAlbum)
  {
    albumGenre = aAlbumGenre;
    releaseDate = releaseDate;
    nameAlbum = aNameAlbum;
    locations = new ArrayList<Location>();
    songs = new ArrayList<Song>();
  }

  //------------------------
  // INTERFACE
  //------------------------

  public boolean setAlbumGenre(String aAlbumGenre)
  {
    boolean wasSet = false;
    albumGenre = aAlbumGenre;
    wasSet = true;
    return wasSet;
  }

  public boolean setReleaseDate(String aReleaseDate)
  {
    boolean wasSet = false;
    releaseDate = aReleaseDate;
    wasSet = true;
    return wasSet;
  }

  public boolean setNameAlbum(String aNameAlbum)
  {
    boolean wasSet = false;
    nameAlbum = aNameAlbum;
    wasSet = true;
    return wasSet;
  }

  public String getAlbumGenre()
  {
    return albumGenre;
  }

  public String getReleaseDate()
  {
    return releaseDate;
  }

  public String getNameAlbum()
  {
    return nameAlbum;
  }

  public Location getLocation(int index)
  {
    Location aLocation = locations.get(index);
    return aLocation;
  }

  public List<Location> getLocations()
  {
    List<Location> newLocations = Collections.unmodifiableList(locations);
    return newLocations;
  }

  public int numberOfLocations()
  {
    int number = locations.size();
    return number;
  }

  public boolean hasLocations()
  {
    boolean has = locations.size() > 0;
    return has;
  }

  public int indexOfLocation(Location aLocation)
  {
    int index = locations.indexOf(aLocation);
    return index;
  }

  public Song getSong(int index)
  {
    Song aSong = songs.get(index);
    return aSong;
  }

  public List<Song> getSongs()
  {
    List<Song> newSongs = Collections.unmodifiableList(songs);
    return newSongs;
  }

  public int numberOfSongs()
  {
    int number = songs.size();
    return number;
  }

  public boolean hasSongs()
  {
    boolean has = songs.size() > 0;
    return has;
  }

  public int indexOfSong(Song aSong)
  {
    int index = songs.indexOf(aSong);
    return index;
  }

  public static int minimumNumberOfLocations()
  {
    return 0;
  }

  public Location addLocation(String aLocationName, float aVolume, boolean aMute, Song aSong, Playlist aPlaylist)
  {
    return new Location(aLocationName, aVolume, aMute, this, aSong, aPlaylist);
  }

  public boolean addLocation(Location aLocation)
  {
    boolean wasAdded = false;
    if (locations.contains(aLocation)) { return false; }
    Album existingAlbum = aLocation.getAlbum();
    boolean isNewAlbum = existingAlbum != null && !this.equals(existingAlbum);
    if (isNewAlbum)
    {
      aLocation.setAlbum(this);
    }
    else
    {
      locations.add(aLocation);
    }
    wasAdded = true;
    return wasAdded;
  }

  public boolean removeLocation(Location aLocation)
  {
    boolean wasRemoved = false;
    //Unable to remove aLocation, as it must always have a album
    if (!this.equals(aLocation.getAlbum()))
    {
      locations.remove(aLocation);
      wasRemoved = true;
    }
    return wasRemoved;
  }

  public boolean addLocationAt(Location aLocation, int index)
  {  
    boolean wasAdded = false;
    if(addLocation(aLocation))
    {
      if(index < 0 ) { index = 0; }
      if(index > numberOfLocations()) { index = numberOfLocations() - 1; }
      locations.remove(aLocation);
      locations.add(index, aLocation);
      wasAdded = true;
    }
    return wasAdded;
  }

  public boolean addOrMoveLocationAt(Location aLocation, int index)
  {
    boolean wasAdded = false;
    if(locations.contains(aLocation))
    {
      if(index < 0 ) { index = 0; }
      if(index > numberOfLocations()) { index = numberOfLocations() - 1; }
      locations.remove(aLocation);
      locations.add(index, aLocation);
      wasAdded = true;
    } 
    else 
    {
      wasAdded = addLocationAt(aLocation, index);
    }
    return wasAdded;
  }

  public static int minimumNumberOfSongs()
  {
    return 0;
  }

  public boolean addSong(Song aSong)
  {
    boolean wasAdded = false;
    if (songs.contains(aSong)) { return false; }
    songs.add(aSong);
    if (aSong.indexOfAlbum(this) != -1)
    {
      wasAdded = true;
    }
    else
    {
      wasAdded = aSong.addAlbum(this);
      if (!wasAdded)
      {
        songs.remove(aSong);
      }
    }
    return wasAdded;
  }

  public boolean removeSong(Song aSong)
  {
    boolean wasRemoved = false;
    if (!songs.contains(aSong))
    {
      return wasRemoved;
    }

    int oldIndex = songs.indexOf(aSong);
    songs.remove(oldIndex);
    if (aSong.indexOfAlbum(this) == -1)
    {
      wasRemoved = true;
    }
    else
    {
      wasRemoved = aSong.removeAlbum(this);
      if (!wasRemoved)
      {
        songs.add(oldIndex,aSong);
      }
    }
    return wasRemoved;
  }

  public boolean addSongAt(Song aSong, int index)
  {  
    boolean wasAdded = false;
    if(addSong(aSong))
    {
      if(index < 0 ) { index = 0; }
      if(index > numberOfSongs()) { index = numberOfSongs() - 1; }
      songs.remove(aSong);
      songs.add(index, aSong);
      wasAdded = true;
    }
    return wasAdded;
  }

  public boolean addOrMoveSongAt(Song aSong, int index)
  {
    boolean wasAdded = false;
    if(songs.contains(aSong))
    {
      if(index < 0 ) { index = 0; }
      if(index > numberOfSongs()) { index = numberOfSongs() - 1; }
      songs.remove(aSong);
      songs.add(index, aSong);
      wasAdded = true;
    } 
    else 
    {
      wasAdded = addSongAt(aSong, index);
    }
    return wasAdded;
  }

  public void delete()
  {
    for(int i=locations.size(); i > 0; i--)
    {
      Location aLocation = locations.get(i - 1);
      aLocation.delete();
    }
    ArrayList<Song> copyOfSongs = new ArrayList<Song>(songs);
    songs.clear();
    for(Song aSong : copyOfSongs)
    {
      aSong.removeAlbum(this);
    }
  }


  public String toString()
  {
	  String outputString = "";
    return super.toString() + "["+
            "albumGenre" + ":" + getAlbumGenre()+ "," +
            "releaseDate" + ":" + getReleaseDate()+ "," +
            "nameAlbum" + ":" + getNameAlbum()+ "]"
     + outputString;
  }
}