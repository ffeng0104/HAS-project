<!DOCTYPE html>
<html>
<head>
  <title>Home Audio System</title>
</head>
	<body>
	<h2 style="text-align:center">Home Audio System</h2>
		<form action="" method="post">
            <label>Add a song: </label><input type="text" name="song_name">
			<span class="error"></span>
			<br><input type="submit" value="Add Song" name="add_song_button"/>
		</form>
	    <br>
		<form action="" method="post">
            <label>Add playlist: </label><input type="text" name="playlist_name">
            <label>Add songs: </label><input type="text" name="playlist_song">
			<span class="error"></span>
			<br><input type="submit" value="Add Playlist" name="add_playlist_button"/>
		</form>
		<br>
		<form action="" method="post">
            <label>Album name: </label><input type="text" name="album_name">
            <label>Album genre: </label><input type="text" name="album_genre">
            <label>Release date:</label><input type="text" name="release_date">
            <label>Artist:</label><input type="text" name="artist">
            <label>Add songs:</label><input type="text" name="album_song">
			<span class="error"></span>
			<br><input type="submit" value="Add Album" name="add_album_button"/>
		</form>
		<br>
		<form action="" method="post">
            <label>Add location: </label><input type="text" name="location_name">
            <label>Set location volume: </label><input type="text" name="location_volume">
			<span class="error"></span>
			<br><input type="submit" value="Add Location" name="add_location_button"/>
		</form>
		<br>
        <br>

		<?php
			//Read from the XML file
			$doc = new DOMDocument(); 
			$doc->load( 'data.xml' );
			//Save things to xml file
			$HASWEB = $doc->getElementsByTagName("HASWEB"); 
				foreach ($HASWEB as $HWEB){

					//saves songs to xml file
					$song_name = @$_POST['song_name'];//Gets the song name through post
					
					$playlist_name = @$_POST['playlist_name'];
					$playlist_song = @$_POST['playlist_song'];
			  		
			  		$album_name = @$_POST['album_name'];
			  		$album_genre = @$_POST['album_genre'];
			  		$release_date = @$_POST['release_date'];
			  		$artist = @$_POST['artist'];
			  		$album_song = @$_POST['album_song'];
			  		
			  		$location_name = @$_POST['location_name'];
			  		$location_volume = @$_POST['location_volume'];

			  		//Checks if the song button was the one that was pressed
					if (isset($_POST['add_song_button'])){
						if(strlen($song_name) > 0){
							$new_song = $doc->createElement( "song" ); //Creates a new song element in the xml file
							$name = $doc->createElement( "name" ); //Creates a new name element in the xml file
				 			$name->appendChild($doc->createTextNode($song_name)); //Creates a text node called $song_name as a child of the name element
				 			$new_song->appendChild($name); //Adds the name element as a child of the song element
				  			$HWEB->appendChild($new_song); //adds the song element to the document
				  			$doc->appendChild($HWEB); //Adds the element to the over-arching element
				  		} else {echo '<font color="red">*Please enter a song name. </font><br>';}
			  		} 
			  		if(isset($_POST['add_playlist_button'])){
			  			if ( strlen($playlist_name) > 0 && strlen($playlist_song)>0){
			  				$new_playlist = $doc->createElement( "playlist" ); //Creates a new song element in the xml file
			  				$name = $doc->createElement( "name" ); //Creates a new name element in the xml file
			  				$name->appendChild(
			  						$doc->createTextNode($playlist_name)); //Creates a text node called $song_name as a child of the name element
			  				$new_playlist->appendChild($name); //Adds the name element as a child of the song element
			  				$new_playlistsong = $doc->createElement("playlistsong");
			  				$new_playlistsong->appendChild($doc->createTextNode($playlist_song));
			  				$new_playlist->appendChild($new_playlistsong);
			  				$HWEB->appendChild($new_playlist); //adds the song element to the document
			  				$doc->appendChild($HWEB);
			  			} 
			  			if(strlen($playlist_name)<=0 ){
			  				echo '<font color="red">*Please enter a playlist name. </font><br>';
			  			}
			  			if(strlen($playlist_song)<=0){
			  				echo '<font color="red">*Please enter the song name. </font><br>';
			  			}
			  		}
			  		if(isset($_POST['add_album_button'])){
			  			if ( strlen($album_name) > 0 && strlen($album_genre)>0 && strlen($album_song)>0 && strlen($release_date)>0 && strlen($artist)>0){
			  				$new_album = $doc->createElement( "album" ); //Creates a new song element in the xml file
			  				$name = $doc->createElement( "name" ); //Creates a new name element in the xml file
			  				$name->appendChild(
			  						$doc->createTextNode($album_name)); //Creates a text node called $song_name as a child of the name element
			  				$new_album->appendChild($name); //Adds the name element as a child of the song element
			  				$new_genre = $doc->createElement("genre");
			  				$new_genre->appendChild($doc->createTextNode($album_genre));
			  				$new_album->appendChild($new_genre);
			  				
			  				$new_date = $doc->createElement("date");
			  				$new_date->appendChild($doc->createTextNode($release_date));
			  				$new_album->appendChild($new_date);
			  				
			  				$new_artist = $doc->createElement("artist");
			  				$new_artist->appendChild($doc->createTextNode($artist));
			  				$new_album->appendChild($new_artist);
			  				
			  				$new_albumsong = $doc->createElement("albumsong");
			  				$new_albumsong->appendChild($doc->createTextNode($album_song));
			  				$new_album->appendChild($new_albumsong);
			  				
			  				$HWEB->appendChild($new_album); //adds the song element to the document
			  				$doc->appendChild($HWEB);
			  			}
			  			if(strlen($album_name)<=0 ){
			  				echo '<font color="red">*Please enter an album name. </font><br>';
			  			}
			  			if(strlen($album_genre)<=0){
			  				echo '<font color="red">*Please enter the album genre. </font><br>';
			  			}
			  			if(strlen($release_date)<=0){
			  				echo '<font color="red">*Please enter the release date. </font><br>';
			  			}
			  			if(strlen($artist)<=0){
			  				echo '<font color="red">*Please enter the artist. </font><br>';
			  			}
			  			if(strlen($album_song)<=0){
			  				echo '<font color="red">*Please enter the song name. </font><br>';
			  			}
			  		}
					//Checks if the location button was the one that was pressed
			  		if(isset($_POST['add_location_button'])){
			  			if(is_numeric($location_volume)){
			  			if ( strlen($location_name) > 0 && strlen($location_volume)>0){
				  			$new_location = $doc->createElement( "location" ); //Creates a new song element in the xml file
							$name = $doc->createElement( "name" ); //Creates a new name element in the xml file
				 			$name->appendChild( 
								$doc->createTextNode($location_name)); //Creates a text node called $song_name as a child of the name element
				 			$new_location->appendChild($name); //Adds the name element as a child of the song element
				  			$new_volume = $doc->createElement("volume");
				  			$new_volume->appendChild(
				  				$doc->createTextNode($location_volume));
				  			$new_location->appendChild($new_volume);
				  			$HWEB->appendChild($new_location); //adds the song element to the document
				  			$doc->appendChild($HWEB);
				  		}
				  		if(strlen($location_name)<=0 ){
				  			echo '<font color="red">*Please enter a location name. </font><br>';
				  		}
			  			}
			  			else if ((is_numeric($location_volume))==false){
				  			echo '<font color="red">*Please set volume correctly. (only accept integer) </font><br>';
				  		}
				  		else if(strlen($location_name)<=0 ){
				  			echo '<font color="red">*Please enter a location name. </font><br>';
				  		}
			  		}
				  		

		  			$doc->save("data.xml");

		  			//After saving new data to the xml file, adds each new song element to a new select box
					
		  			
		  			echo '<form action = "" method="post">';
			  	    echo'<label> Pick a song: </label><select name="songs_select">';
						$doc = new DOMDocument(); 
						$doc->load( 'data.xml' );
						$HASWEB = $doc->getElementsByTagName("HASWEB"); 
						foreach ($HASWEB as $HWEB){
							$songs = $doc->getElementsByTagName("song"); 
								foreach($songs as $song) { 

								$names = $song->getElementsByTagName("name"); 
								$name = $names->item(0)->nodeValue;
									echo "<option value=$name> $name </option>";							
							}
						}
					echo '</select>';
					//Then adds playlist data to select box
					echo '<label> Pick a playlist: </label><select name="playlist_select">';
					$doc = new DOMDocument();
					$doc->load( 'data.xml' );
					$HASWEB = $doc->getElementsByTagName("HASWEB");
					foreach ($HASWEB as $HWEB){
						$playlists = $doc->getElementsByTagName("playlist");
						foreach($playlists as $playlist) {
					
							$pnames = $playlist->getElementsByTagName("name");
							$pname = $pnames->item(0)->nodeValue;
							echo "<option value=$pname> $pname </option>";
						}
						}
						echo '</select>';
						echo'<label> Pick an album: </label><select name="album_select">';
						$doc = new DOMDocument();
						$doc->load( 'data.xml' );
						$HASWEB = $doc->getElementsByTagName("HASWEB");
						foreach ($HASWEB as $HWEB){
							$albums = $doc->getElementsByTagName("album");
							foreach($albums as $album) {
						
								$anames = $album->getElementsByTagName("name");
								$aname = $anames->item(0)->nodeValue;
								echo "<option value=$aname> $aname </option>";
							}
							}
							echo '</select>';
							echo'<label> Choose a location: </label><select name="location_select">';
							$doc = new DOMDocument();
							$doc->load( 'data.xml' );
							$HASWEB = $doc->getElementsByTagName("HASWEB");
							foreach ($HASWEB as $HWEB){
								$locations = $doc->getElementsByTagName("location");
								foreach($locations as $location) {
							
									$lnames = $location->getElementsByTagName("name");
									$lname = $lnames->item(0)->nodeValue;
									echo "<option value=$lname> $lname </option>";
								}
								}
						echo '</select><input type="submit" name="submit" value="Play!"></input></form>';
					

					//Plays songs
					$selected_song_name = @$_POST['songs_select'];//Gets the selected song name through post	
					$selected_playlist_name = @$_POST['playlist_select'];
					$selected_album_name = @$_POST['album_select'];
					$selected_location_name = @$_POST['location_select'];
															
					//checks if the location name is empty

					//Gets the volume at that location
					$volume = "";
					$HASWEB = $doc->getElementsByTagName("HASWEB"); 
						foreach ($HASWEB as $HWEB){
							$locations = $doc->getElementsByTagName("location"); 
								foreach($locations as $location) { 

								$volumes = $location->getElementsByTagName("volume"); 
								$volume = $volumes->item(0)->nodeValue;
					
									echo "<option value=$volume> $volume </option>";
								
							}
						}

			       if (isset($_POST['submit'])){
					if((strlen($selected_location_name) <= 0)){
						echo '<br><font color="red">*Please select the location. </font>' ;
					}
					if (strlen($selected_song_name) <= 0 && (strlen($selected_album_name) <= 0 && strlen($selected_playlist_name) <= 0 && strlen($selected_location_name) <= 0)){
						echo '<br><font color="red">*Please pick song/album/playlist and location. </font>'  ;
					}else if (strlen($selected_song_name) <= 0 && (strlen($selected_album_name) <= 0 && strlen($selected_playlist_name) <= 0)) {
						echo  '<br><font color="red">*Please select song/album/playlist. </font>'  ;}
					else if (strlen($selected_song_name) > 0 && (strlen($selected_album_name) > 0 && strlen($selected_playlist_name) > 0)) {
						echo  '<br><font color="red">*Please only select an album OR a playlist OR a song. </font>'  ;
					}else if (strlen($selected_album_name) > 0 && strlen($selected_playlist_name) > 0) {
						echo '<br><font color="red">*Please only select an album OR a playlist. </font>' ;
					}else if (strlen($selected_album_name) > 0 && strlen($selected_song_name) > 0) {
						echo '<br><font color="red">*Please only select an album OR a song. </font>';
					}else if (strlen($selected_playlist_name) > 0 && strlen($selected_song_name) > 0) {
						echo'<br><font color="red">*Please only select a playlist OR a song. </font>';
					}else if (((strlen($selected_location_name)<=0) && (strlen($selected_song_name) > 0 || strlen($selected_album_name) > 0 || strlen($selected_playlist_name) > 0))){
						echo ' ';
					} else {
					//	$output="";						
						if (strlen($selected_song_name) > 0){ 
							$output = $selected_song_name;
						}
						else if (strlen($selected_playlist_name) > 0){ 
							$output = $selected_playlist_name;
						}
					    if (strlen($selected_album_name) > 0){ 
					    	$output = $selected_album_name;
					    }
					    
					    $location_name = $selected_location_name;
					    
					 	echo "<p><h3>Now $output is playing at location $location_name with volume $volume.</h3></p>";
						
					}
				}
				}
				
?>
</body>
</html>
