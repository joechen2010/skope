CREATE TABLE path_user
(
	id BIGINT NOT NULL,
	name VARCHAR(50),
	password VARCHAR(50) NOT NULL,
	date_of_birth VARCHAR(50),
	email VARCHAR(50),
	mobile VARCHAR(50),
	first_name VARCHAR(50),
	last_name VARCHAR(50),
	gender VARCHAR(50) default 'ÄÐ',
	relationship_status VARCHAR(50),
	home_town VARCHAR(50),
	work_job_title VARCHAR(50),
	work_company VARCHAR(50),
	education_study VARCHAR(50),
	education_college VARCHAR(50),
	is_gender_public boolean default true,
	is_date_of_birth_public boolean default true,
	description VARCHAR(255),
	profile_picture_url VARCHAR(50),
	thumbnail_url VARCHAR(50),
	status VARCHAR(50),
	interests VARCHAR(200),
	location VARCHAR(50),
	location_timestamp  VARCHAR(50),
	is_first_time boolean,
	fb_profile_picture_url VARCHAR(50),
	favorites VARCHAR(250),
	create_timestamp timestamp DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id),
	INDEX idx_path_user_name (name ASC)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci
;

CREATE TABLE GPSINFO
(
  userid BIGINT,               
  name varchar(50),           
  mobile varchar(50),              
  address varchar(200),               
  timestamp timestamp DEFAULT CURRENT_TIMESTAMP,         
  city varchar(50),           
  street varchar(200),          
  latitude varchar(20),         
  longitude varchar(20),
  INDEX idx_gps_userid (userid ASC)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci
;


CREATE TABLE chat_message
(
  id BIGINT,               
  user_from_id BIGINT,           
  message varchar(250),
  isRead boolean default false,
  mark_as_read boolean default false,
  timestamp timestamp DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_message_id (id ASC)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci
;

CREATE TABLE favorites
(
  id BIGINT AUTO_INCREMENT PRIMARY KEY,
  userid BIGINT,               
  favoriteId BIGINT,           
  timestamp timestamp DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_favorites_id (id ASC)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci
;

CREATE TABLE user_photo
(
  id BIGINT AUTO_INCREMENT PRIMARY KEY,
  userid BIGINT,               
  username varchar(50),       
  photo_url varchar(50),    
  thumbnail_url  varchar(50),   
  location   varchar(50), 
  location_timestamp timestamp DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_favorites_id (id ASC)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci
;






