package persistence;

import static org.junit.Assert.*;

import java.io.File;
import java.sql.Date;
import java.util.Calendar;

import model.Album;
import model.Library;

import org.junit.After;
import org.junit.Before;
import org.junit.Test;


public class TestPersistence {
	@Before
	public void setUp() throws Exception {
		Library lib = Library.getInstance();
		
		//craete albums
		Calendar c = Calendar.getInstance();
		c.set(2015,Calendar.SEPTEMBER,15,8,30,0);
		Date releaseDate = new Date(c.getTimeInMillis());
		
		Album al = new Album("Jazz", releaseDate, "AAA");
	

		lib.addAlbum(al);
	
	}
	@After
	public void tearDown() throws Exception {
		Library lib = Library.getInstance();
		lib.delete();
		
	}
	@Test
	public void test() {
		//save model
		Library lib = Library.getInstance();
		PersistenceXStream.setFileName("test"+File.separator+"persistence"+File.separator+"data.xml");
		PersistenceXStream.setAlias("album",Album.class);
		PersistenceXStream.setAlias("library",Library.class);
		if (!PersistenceXStream.saveToXMLwithXStream(lib)){
			fail("couldn't save file");
		}
		//clear the model in memory
		lib.delete();
		assertEquals(0,lib.getAlbums().size());
		
		//load model
		lib = (Library) PersistenceXStream.loadFromXMLwithXStream();
		if (lib == null){
			fail("couldn't load file");
		}
		
		
		//check Album
		assertEquals(1,lib.getAlbums().size());
		assertEquals("AAA",lib.getAlbum(0).getNameAlbum());
		assertEquals("Jazz",lib.getAlbum(0).getAlbumGenre());
		
	}
}