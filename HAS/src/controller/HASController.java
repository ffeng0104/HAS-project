package controller;

import java.sql.Date;

import persistence.PersistenceXStream;
import model.Album;
import model.Library;


public class HASController {

public HASController(){
		
	}
	
	public void createAlbum(String albumGenre, Date releaseDate,String nameAlbum)throws InvalidInputException{
		
		String error ="";
		if(nameAlbum ==null||nameAlbum.trim().length() == 0)
			error = error +"Album name cannot be empty! ";
		if(releaseDate == null)
			error = error +"Release date cannot be empty! ";
		if(albumGenre == null)
			error = error+ "Albun Genre cannot be empty! ";
		
		if(error.length()>0)
			throw new InvalidInputException(error);
		Album A = new Album(albumGenre,releaseDate,nameAlbum);
		Library library = Library.getInstance();
		library.addAlbum(A);
		PersistenceXStream.saveToXMLwithXStream(library);
	}
	
	
}

