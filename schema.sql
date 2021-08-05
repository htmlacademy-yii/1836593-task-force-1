CREATE DATABASE TASK_FORCE
    DEFAULT CHARACTER SET utf8mb4
    DEFAULT COLLATE utf8_general_ci;

USE TASK_FORCE;


CREATE TABLE user (
  id int PRIMARY KEY AUTO_INCREMENT,
  email varchar(255) UNIQUE NOT NULL,
  password varchar(255) NOT NULL,
  city_id int NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE user_info (
  id int PRIMARY KEY AUTO_INCREMENT,
  user_id int NOT NULL,
  name varchar(255) NOT NULL,
  surname varchar(255) NOT NULL,
  city_id int NOT NULL,
  edited_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  date_birth date NOT NULL,
  role_id int NOT NULL,
  rating float DEFAULT 0,
  phone char(11) NOT NULL,
  telegram varchar(255) NOT NULL,
  skype varchar(255) NOT NULL
);

CREATE TABLE city (
  id int PRIMARY KEY AUTO_INCREMENT,
  name varchar(255) NOT NULL
);

CREATE TABLE task (
  id int PRIMARY KEY AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  description varchar(255) NOT NULL,
  status varchar(255) NOT NULL,
  action varchar(255) NOT NULL,
  price int NOT NULL,
  category_id int NOT NULL,
  author_id int NOT NULL,
  executor_id int NOT NULL,
  city_id int NOT NULL,
  latitude float DEFAULT 0,
  longitude float DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  finished_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE attachment (
  id int PRIMARY KEY AUTO_INCREMENT,
  task_id int NOT NULL,
  url varchar(255) NOT NULL
);

CREATE TABLE category (
  id int PRIMARY KEY AUTO_INCREMENT,
  name varchar(255) NOT NULL
);

CREATE TABLE user_category (
  id int PRIMARY KEY AUTO_INCREMENT,
  user_id int NOT NULL,
  category_id int NOT NULL,
  name varchar(255) NOT NULL
);

CREATE TABLE message (
  id int PRIMARY KEY AUTO_INCREMENT,
  text varchar(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  user_id int NOT NULL,
  task_id int NOT NULL
);

CREATE TABLE review (
  id int PRIMARY KEY AUTO_INCREMENT,
  user_id int NOT NULL,
  title varchar(255) NOT NULL,
  description varchar(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  rating int NOT NULL,
  task_id int NOT NULL
);

CREATE TABLE portfolio_photo (
  id int PRIMARY KEY AUTO_INCREMENT,
  user_id int NOT NULL,
  title varchar(255) NOT NULL,
  description varchar(255) NOT NULL,
  url varchar(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  rating int NOT NULL
);

CREATE TABLE notification (
  id int PRIMARY KEY AUTO_INCREMENT,
  user_id int NOT NULL,
  title varchar(255) NOT NULL,
  is_view bit NOT NULL,
  url varchar(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  type varchar(255) NOT NULL,
  task_id int NOT NULL
);

CREATE TABLE favorite_list (
  id int PRIMARY KEY AUTO_INCREMENT,
  user_selected_id int NOT NULL,
  user_who_select_id int NOT NULL
);

CREATE TABLE user_visit (
  id int PRIMARY KEY AUTO_INCREMENT,
  user_visitor_id int NOT NULL,
  user_guest_id int NOT NULL
);

CREATE TABLE site_settings (
  id int PRIMARY KEY AUTO_INCREMENT,
  user_id int NOT NULL,
  new_message boolean DEFAULT true,
  actions_in_task boolean DEFAULT true,
  show_contacts_client boolean DEFAULT true,
  show_profile boolean DEFAULT false
);

CREATE TABLE response (
  id int PRIMARY KEY AUTO_INCREMENT,
  user_id int NOT NULL,
  price int NOT NULL,
  comment varchar(255) NOT NULL,
  responded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  task_id int NOT NULL,
  status varchar(255) NOT NULL
);

ALTER TABLE user ADD FOREIGN KEY (city_id) REFERENCES city (id);

ALTER TABLE user_info ADD FOREIGN KEY (user_id) REFERENCES user (id);

ALTER TABLE user_info ADD FOREIGN KEY (city_id) REFERENCES city (id);

ALTER TABLE task ADD FOREIGN KEY (category_id) REFERENCES category (id);

ALTER TABLE task ADD FOREIGN KEY (author_id) REFERENCES user (id);

ALTER TABLE task ADD FOREIGN KEY (executor_id) REFERENCES user (id);

ALTER TABLE task ADD FOREIGN KEY (city_id) REFERENCES city (id);

ALTER TABLE attachment ADD FOREIGN KEY (task_id) REFERENCES task (id);

ALTER TABLE user_category ADD FOREIGN KEY (user_id) REFERENCES user_info (user_id);

ALTER TABLE user_category ADD FOREIGN KEY (category_id) REFERENCES category (id);

ALTER TABLE message ADD FOREIGN KEY (user_id) REFERENCES user (id);

ALTER TABLE message ADD FOREIGN KEY (task_id) REFERENCES task (id);

ALTER TABLE review ADD FOREIGN KEY (user_id) REFERENCES user (id);

ALTER TABLE review ADD FOREIGN KEY (task_id) REFERENCES task (id);

ALTER TABLE portfolio_photo ADD FOREIGN KEY (user_id) REFERENCES user (id);

ALTER TABLE notification ADD FOREIGN KEY (user_id) REFERENCES user (id);

ALTER TABLE notification ADD FOREIGN KEY (task_id) REFERENCES task (id);

ALTER TABLE favorite_list ADD FOREIGN KEY (user_selected_id) REFERENCES user (id);

ALTER TABLE favorite_list ADD FOREIGN KEY (user_who_select_id) REFERENCES user (id);

ALTER TABLE user_visit ADD FOREIGN KEY (user_visitor_id) REFERENCES user (id);

ALTER TABLE user_visit ADD FOREIGN KEY (user_guest_id) REFERENCES user (id);

ALTER TABLE site_settings ADD FOREIGN KEY (user_id) REFERENCES user (id);

ALTER TABLE response ADD FOREIGN KEY (user_id) REFERENCES user (id);

ALTER TABLE response ADD FOREIGN KEY (task_id) REFERENCES task (id);
