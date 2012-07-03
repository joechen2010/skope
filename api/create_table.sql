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
	gender VARCHAR(50),
	relationship_status VARCHAR(50),
	home_town VARCHAR(50),
	work_job_title VARCHAR(50),
	work_company VARCHAR(50),
	education_study VARCHAR(50),
	education_college VARCHAR(50),
	is_gender_public boolean,
	is_date_of_birth_public boolean,
	description VARCHAR(255),
	profile_picture_url VARCHAR(50),
	status VARCHAR(50),
	interests VARCHAR(50),
	location VARCHAR(50),
	location_timestamp  VARCHAR(50),
	is_first_time boolean,
	fb_profile_picture_url VARCHAR(50),
	favorites VARCHAR(250),
	create_timestamp date,
	PRIMARY KEY (id),
	INDEX idx_path_user_name (name ASC)
) ENGINE=InnoDB
;

CREATE TABLE GPSINFO
(
  
  userid BIGINT,               
  name varchar(50),           
  mobile varchar(50),              
  address varchar(200),               
  timestamp timestamp,         
  city varchar(50),           
  street varchar(200),          
  latitude varchar(20),         
  longitude varchar(20),
  INDEX idx_gps_userid (userid ASC)
) ENGINE=InnoDB
;











