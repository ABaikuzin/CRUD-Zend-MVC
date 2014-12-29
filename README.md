Online CD Manager
=================

Introduction
------------
This is a example CRUD MVC application to manage CD using the ZF2.

![Screenshot](http://github.com/ABaikuzin/CRUD-Zend-MVC/blob/master/screen.png)

Database
---------
``` 
CREATE DATABASE `zend_cd`
    CHARACTER SET 'latin1'
    COLLATE 'latin1_swedish_ci';

CREATE TABLE `cdmanager` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) COLLATE latin1_swedish_ci DEFAULT NULL,
  `year` CHAR(4) COLLATE latin1_swedish_ci DEFAULT NULL,
  `note` VARCHAR(255) COLLATE latin1_swedish_ci DEFAULT NULL,
  `created` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated` TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY USING BTREE (`id`) COMMENT ''
)ENGINE=MyISAM
AUTO_INCREMENT=13 AVG_ROW_LENGTH=142 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

INSERT INTO `cdmanager` (`id`, `name`, `year`, `note`, `created`, `updated`) VALUES

  (2,'Wanted on Voyage','2013','Genre: Rock/Pop\nArtist: George Ezra\n1. Blame It on Me\n2. Budapest\n3. Cassy O''\n4. Barcelona\n5. Listen to the Man\n6. Leaving It Up to You\n7. Did You Hear the Rain?\n8. Drawing Board\n9. Stand by Your Gun\n10. Breakaway\n11. Over the Creek\n12. Spectacular Rival ','2014-12-22 23:31:20','2014-12-23 05:14:03'),
  (3,'Never Been Better - Olly Murs','2014','Genre: Rock/Pop\nArtist: Olly Murs\n','2014-12-22 23:31:23','2014-12-23 04:04:46'),
  (5,'In The Lonely Hour by Sam Smith','2014','Genre: Dance\nArtist: Sam Smith','2014-12-22 23:31:43','2014-12-23 03:52:39'),
  (10,'Four - One Direction','2015','Genre: Rock/Pop\nArtist: One Direction','2014-12-23 10:02:59','2014-12-23 05:03:00'),
  (12,'McBusted','N/A','N/A','2014-12-23 10:08:25','2014-12-23 05:08:26');
COMMIT;
``` 
