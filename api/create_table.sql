CREATE TABLE path_user
(
	id BIGINT NOT NULL,
	name VARCHAR(50),
	password VARCHAR(50) NOT NULL,
	date_of_birth VARCHAR(50),
	email VARCHAR(50) NOT NULL,
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
	PRIMARY KEY (id),
	INDEX idx_path_user_name (name ASC)
) ENGINE=InnoDB
;
