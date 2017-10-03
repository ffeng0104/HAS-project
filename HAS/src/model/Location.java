/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.23.0-ebfd285 modeling language!*/

package model;

// line 40 "model.ump"
// line 72 "model.ump"
public class Location
{

  //------------------------
  // MEMBER VARIABLES
  //------------------------

  //Location Attributes
  private String locationName;
  private float volume;
  private boolean mute;

  //Location Associations
  private Album album;
  private Song song;
  private Playlist playlist;

  //------------------------
  // CONSTRUCTOR
  //------------------------

  public Location(String aLocationName, float aVolume, boolean aMute, Album aAlbum, Song aSong, Playlist aPlaylist)
  {
    locationName = aLocationName;
    volume = aVolume;
    mute = aMute;
    boolean didAddAlbum = setAlbum(aAlbum);
    if (!didAddAlbum)
    {
      throw new RuntimeException("Unable to create location due to album");
    }
    boolean didAddSong = setSong(aSong);
    if (!didAddSong)
    {
      throw new RuntimeException("Unable to create location due to song");
    }
    boolean didAddPlaylist = setPlaylist(aPlaylist);
    if (!didAddPlaylist)
    {
      throw new RuntimeException("Unable to create location due to playlist");
    }
  }

  //------------------------
  // INTERFACE
  //------------------------

  public boolean setLocationName(String aLocationName)
  {
    boolean wasSet = false;
    locationName = aLocationName;
    wasSet = true;
    return wasSet;
  }

  public boolean setVolume(float aVolume)
  {
    boolean wasSet = false;
    volume = aVolume;
    wasSet = true;
    return wasSet;
  }

  public boolean setMute(boolean aMute)
  {
    boolean wasSet = false;
    mute = aMute;
    wasSet = true;
    return wasSet;
  }

  public String getLocationName()
  {
    return locationName;
  }

  public float getVolume()
  {
    return volume;
  }

  public boolean getMute()
  {
    return mute;
  }

  public Album getAlbum()
  {
    return album;
  }

  public Song getSong()
  {
    return song;
  }

  public Playlist getPlaylist()
  {
    return playlist;
  }

  public boolean setAlbum(Album aAlbum)
  {
    boolean wasSet = false;
    if (aAlbum == null)
    {
      return wasSet;
    }

    Album existingAlbum = album;
    album = aAlbum;
    if (existingAlbum != null && !existingAlbum.equals(aAlbum))
    {
      existingAlbum.removeLocation(this);
    }
    album.addLocation(this);
    wasSet = true;
    return wasSet;
  }

  public boolean setSong(Song aSong)
  {
    boolean wasSet = false;
    if (aSong == null)
    {
      return wasSet;
    }

    Song existingSong = song;
    song = aSong;
    if (existingSong != null && !existingSong.equals(aSong))
    {
      existingSong.removeLocation(this);
    }
    song.addLocation(this);
    wasSet = true;
    return wasSet;
  }

  public boolean setPlaylist(Playlist aPlaylist)
  {
    boolean wasSet = false;
    if (aPlaylist == null)
    {
      return wasSet;
    }

    Playlist existingPlaylist = playlist;
    playlist = aPlaylist;
    if (existingPlaylist != null && !existingPlaylist.equals(aPlaylist))
    {
      existingPlaylist.removeLocation(this);
    }
    playlist.addLocation(this);
    wasSet = true;
    return wasSet;
  }

  public void delete()
  {
    Album placeholderAlbum = album;
    this.album = null;
    placeholderAlbum.removeLocation(this);
    Song placeholderSong = song;
    this.song = null;
    placeholderSong.removeLocation(this);
    Playlist placeholderPlaylist = playlist;
    this.playlist = null;
    placeholderPlaylist.removeLocation(this);
  }


  public String toString()
  {
	  String outputString = "";
    return super.toString() + "["+
            "locationName" + ":" + getLocationName()+ "," +
            "volume" + ":" + getVolume()+ "," +
            "mute" + ":" + getMute()+ "]" + System.getProperties().getProperty("line.separator") +
            "  " + "album = "+(getAlbum()!=null?Integer.toHexString(System.identityHashCode(getAlbum())):"null") + System.getProperties().getProperty("line.separator") +
            "  " + "song = "+(getSong()!=null?Integer.toHexString(System.identityHashCode(getSong())):"null") + System.getProperties().getProperty("line.separator") +
            "  " + "playlist = "+(getPlaylist()!=null?Integer.toHexString(System.identityHashCode(getPlaylist())):"null")
     + outputString;
  }
}