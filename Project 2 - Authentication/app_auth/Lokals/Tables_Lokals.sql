SET time_zone = "+00:00";


CREATE DATABASE IF NOT EXISTS Lokals;
USE Lokals;

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users`(
   `userId`       INTEGER   NOT NULL AUTO_INCREMENT PRIMARY KEY 
  ,`password_`      VARCHAR(128) NOT NULL
  ,`email`        VARCHAR(128) NOT NULL UNIQUE
  ,`name_`          VARCHAR(19) NOT NULL
  ,`cellphone`     INTEGER  NOT NULL
  ,`country`       VARCHAR(8) NOT NULL
  ,`host`          BIT  NOT NULL
);

INSERT INTO `users`(`userId`,`password_`,`email`,`name_`,`cellphone`,`country`,`host`) VALUES (1,'TL7RY9fmECg0Krl','claudioramos12@hotmail.com','Cláudia Ramos',9827981,'Portugal',1);
INSERT INTO `users`(`userId`,`password_`,`email`,`name_`,`cellphone`,`country`,`host`) VALUES (2,'iD2NsGPJ1Hn3vSy','dis@hotmail.com','Daniel Silva',9828075,'Portugal',1);
INSERT INTO `users`(`userId`,`password_`,`email`,`name_`,`cellphone`,`country`,`host`) VALUES (3,'PbQbpf0LHDbmaDq','blopes21@gmail.com','Brigite Lopes',9828078,'Portugal',1);
INSERT INTO `users`(`userId`,`password_`,`email`,`name_`,`cellphone`,`country`,`host`) VALUES (4,'ahpTZVpf9rZztOA','amaral12@yahoo.com','Sílvio Amaral',9828109,'Portugal',1);
INSERT INTO `users`(`userId`,`password_`,`email`,`name_`,`cellphone`,`country`,`host`) VALUES (5,'iLw0UwltcrR1eML','tigasPereira@yahoo.com','Tiago Pereira',9828142,'Portugal',1);
INSERT INTO `users`(`userId`,`password_`,`email`,`name_`,`cellphone`,`country`,`host`) VALUES (6,'lbBwDdYvNH4M_vM','manuelcosta@yahoo.com','Manuel Costa',9828145,'Portugal',1);
INSERT INTO `users`(`userId`,`password_`,`email`,`name_`,`cellphone`,`country`,`host`) VALUES (7,'hP7IDFQl5aV_7df','saracosta123@yahoo.com','Sara Costa',9828150,'Portugal',1);
INSERT INTO `users`(`userId`,`password_`,`email`,`name_`,`cellphone`,`country`,`host`) VALUES (8,'bFhc6B6FBOO3Aws','joaoreis@hotmail.com','João Reis',9828199,'Portugal',1);
INSERT INTO `users`(`userId`,`password_`,`email`,`name_`,`cellphone`,`country`,`host`) VALUES (9,'97AaqNyLX62o2AJ','eva@gmail.com','Eva Pomposo',9828207,'Portugal',1);
INSERT INTO `users`(`userId`,`password_`,`email`,`name_`,`cellphone`,`country`,`host`) VALUES (10,'A_miqAfjVlX01Bq','if123@hotmail.com','Inês Freitas',9828218,'Portugal',1);
INSERT INTO `users`(`userId`,`password_`,`email`,`name_`,`cellphone`,`country`,`host`) VALUES (11,'vU3oVYLpacGUvwv','jvedor@gmail.com','Joana Vedor',9828228,'Portugal',1);
INSERT INTO `users`(`userId`,`password_`,`email`,`name_`,`cellphone`,`country`,`host`) VALUES (12,'I4RvKAP_KQUd0fw','didioliveira@gmail.com','Diogo Oliveira',9828239,'Portugal',1);
INSERT INTO `users`(`userId`,`password_`,`email`,`name_`,`cellphone`,`country`,`host`) VALUES (13,'qZEzSkIcg3y5G_d','hugobarros@hotmail.com','Hugo Barros',9828244,'Portugal',1);
INSERT INTO `users`(`userId`,`password_`,`email`,`name_`,`cellphone`,`country`,`host`) VALUES (14,'rJpnZorSfe1eckL','teresilva@gmail.com','Teresa Silva',9828247,'Portugal',1);
INSERT INTO `users`(`userId`,`password_`,`email`,`name_`,`cellphone`,`country`,`host`) VALUES (15,'wsbChnfxd3s0voI','Cielo.Predovic20@yahoo.com','Cielo Predovic',9828267,'USA',0);
INSERT INTO `users`(`userId`,`password_`,`email`,`name_`,`cellphone`,`country`,`host`) VALUES (16,'XbAWioJg6aPDFAQ','Carolanne.Batz90@gmail.com','Carolanne Batz',9828272,'USA',0);
INSERT INTO `users`(`userId`,`password_`,`email`,`name_`,`cellphone`,`country`,`host`) VALUES (17,'mFEgsH5GWcePwng','Jacey_McLaughlin84@yahoo.com','Jacey McLaughlin',9828276,'USA',0);
INSERT INTO `users`(`userId`,`password_`,`email`,`name_`,`cellphone`,`country`,`host`) VALUES (18,'mo6pb6m_R2_owL8','Nels_Stokes@gmail.com','Nels Stokes',9828277,'USA',0);
INSERT INTO `users`(`userId`,`password_`,`email`,`name_`,`cellphone`,`country`,`host`) VALUES (19,'Ghh6kqBoU4bfjMg','Justus_Ferry@yahoo.com','Justus Ferry',9828279,'USA',0);
INSERT INTO `users`(`userId`,`password_`,`email`,`name_`,`cellphone`,`country`,`host`) VALUES (20,'BR5328TTDUIfhDK','Katarina_Predovic12@gmail.com','Katarina Predovic',9828290,'USA',0);
INSERT INTO `users`(`userId`,`password_`,`email`,`name_`,`cellphone`,`country`,`host`) VALUES (21,'13ACX2MkEE9oaah','Florencio_Shanahan@gmail.com','Florencio Shanahan',9828301,'USA',0);
INSERT INTO `users`(`userId`,`password_`,`email`,`name_`,`cellphone`,`country`,`host`) VALUES (22,'yL49uyTZ0VQHApn','Antonette74@yahoo.com','Antonette Baumbach',9828320,'USA',0);
INSERT INTO `users`(`userId`,`password_`,`email`,`name_`,`cellphone`,`country`,`host`) VALUES (23,'T6H07XU2ZrZhi65','Dejuan.Lynch66@yahoo.com','Dejuan Lynch',9828321,'USA',0);
INSERT INTO `users`(`userId`,`password_`,`email`,`name_`,`cellphone`,`country`,`host`) VALUES (24,'DuAg3RdS8x_VJcJ','Alverta68@hotmail.com','Alverta Barton',9828322,'USA',0);
INSERT INTO `users`(`userId`,`password_`,`email`,`name_`,`cellphone`,`country`,`host`) VALUES (25,'xdREyCzCwZENtPp','Johann_Stroman@hotmail.com','Johann Stroman',9828327,'USA',0);
INSERT INTO `users`(`userId`,`password_`,`email`,`name_`,`cellphone`,`country`,`host`) VALUES (26,'H6PrL2DVesD4m1w','Chase_Marks@hotmail.com','Chase Marks',9828331,'USA',0);
INSERT INTO `users`(`userId`,`password_`,`email`,`name_`,`cellphone`,`country`,`host`) VALUES (27,'qfGR93xWJxwFpwa','Derick.Waters@hotmail.com','Derick Waters',9828333,'USA',0);
INSERT INTO `users`(`userId`,`password_`,`email`,`name_`,`cellphone`,`country`,`host`) VALUES (28,'g578b_xexh9TFBA','Demond8@gmail.com','Demond Purdy',9828339,'USA',0);
INSERT INTO `users`(`userId`,`password_`,`email`,`name_`,`cellphone`,`country`,`host`) VALUES (29,'XyYFad6sxbDZgtP','Westley_Murray@yahoo.com','Westley Murray',9828356,'USA',0);
INSERT INTO `users`(`userId`,`password_`,`email`,`name_`,`cellphone`,`country`,`host`) VALUES (30,'fRhAPNaz8DkQsJs','Augustus59@hotmail.com','Augustus Cremin',9828397,'USA',0);
INSERT INTO `users`(`userId`,`password_`,`email`,`name_`,`cellphone`,`country`,`host`) VALUES (31,'QgSmhsfcI5iVV5F','Francesca_Wuckert@gmail.com','Francesca Wuckert',9828413,'USA',0);
INSERT INTO `users`(`userId`,`password_`,`email`,`name_`,`cellphone`,`country`,`host`) VALUES (32,'1e4597b9d45e3eb4cc2e0b26cd6e6c05','cheese@burger.com','Arthur Romains',1345,'Andorra',0);
INSERT INTO `users`(`userId`,`password_`,`email`,`name_`,`cellphone`,`country`,`host`) VALUES (33,'1ea87b5f0f0aedab6ddb118c167efd6d','user@gmail.com','Nuno Fahlatings',1337,'Portugal',0);


DROP TABLE IF EXISTS `apartments`;
CREATE TABLE IF NOT EXISTS `apartments`(
   `ap_id`                 INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY 
  ,`hostID`                INTEGER  NOT NULL
  ,`neighbourhood_cleansed` VARCHAR(18) NOT NULL
  ,`city`                   VARCHAR(17) NOT NULL
  ,`zipcode`                INTEGER  NOT NULL
  ,`accommodates`           INTEGER  NOT NULL
  ,`price_per_night`        VARCHAR(10)  NOT NULL
  ,`description_`            VARCHAR(113) NOT NULL
  ,`image_`                  VARCHAR(133) NULL,
  FOREIGN KEY(`hostID`)	REFERENCES		users(`userID`)
);
INSERT INTO `apartments`(`ap_id`,`hostID`,`neighbourhood_cleansed`,`city`,`zipcode`,`accommodates`,`price_per_night`,`description_`,`image_`) VALUES (1,1,'Santa Joana','Aveiro',3810, 4,'$130','Cozy appartment in Sta. Joana, Aveiro, with great conditions.','imagens_db/ap1.jpg');
INSERT INTO `apartments`(`ap_id`,`hostID`,`neighbourhood_cleansed`,`city`,`zipcode`,`accommodates`,`price_per_night`,`description_`,`image_`) VALUES (2,2,'São Bernardo','Aveiro',3810,2,'$59','Confortable room in S. Bernardo, Aveiro.','imagens_db/ap2.jpg');
INSERT INTO `apartments`(`ap_id`,`hostID`,`neighbourhood_cleansed`,`city`,`zipcode`,`accommodates`,`price_per_night`,`description_`,`image_`) VALUES (3,3,'Vera Cruz','Aveiro',3810,4,'$95','We will make you feel like you''re at home in this amazing well centered Aveiro apartment.','imagens_db/ap3.jpg');
INSERT INTO `apartments`(`ap_id`,`hostID`,`neighbourhood_cleansed`,`city`,`zipcode`,`accommodates`,`price_per_night`,`description_`,`image_`) VALUES (4,4,'Arcos','Anadia',3810,2,'$100','Great house with two rooms located in the centre of Anadia City, great to spend some family time.','imagens_db/ap4.jpg');
INSERT INTO `apartments`(`ap_id`,`hostID`,`neighbourhood_cleansed`,`city`,`zipcode`,`accommodates`,`price_per_night`,`description_`,`image_`) VALUES (5,5,'Mogofores','Anadia',3810,6,'$250','Cool apartment located in the surroundings of Anadia.','imagens_db/ap5.jpg');
INSERT INTO `apartments`(`ap_id`,`hostID`,`neighbourhood_cleansed`,`city`,`zipcode`,`accommodates`,`price_per_night`,`description_`,`image_`) VALUES (6,6,'Perafita','Matosinhos',4000, 4,'$140','Cozy room in Perafita, located in the surroundings of Matosinhos city.','imagens_db/ap6.jpg');
INSERT INTO `apartments`(`ap_id`,`hostID`,`neighbourhood_cleansed`,`city`,`zipcode`,`accommodates`,`price_per_night`,`description_`,`image_`) VALUES (7,7,'Ribeira','Porto',4000,2,'$115','Well estimated room in an amazing apartment near by Oporto''s Ribeira.','imagens_db/ap5porto.jpg');
INSERT INTO `apartments`(`ap_id`,`hostID`,`neighbourhood_cleansed`,`city`,`zipcode`,`accommodates`,`price_per_night`,`description_`,`image_`) VALUES (8,8,'Faria Guimarães','Porto',4000,2,'$80','Enjoy your stay in Faria Guimarães, near Oporto''s centre in this great house room.','imagens_db/ap7.jpg');

CREATE TABLE IF NOT EXISTS  `booking` (
   `booking_id`   INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY 
  ,`fk_user_id`      INTEGER  NOT NULL
  ,`ap_id`        INTEGER  NOT NULL
  ,`booking_date` VARCHAR(30)  NOT NULL
  ,`n_days`       INTEGER  NOT NULL
  ,`checkout_date` VARCHAR(30) NOT NULL
  ,`n_people`     INTEGER  NOT NULL
  ,`email`        VARCHAR(30) NOT NULL
  ,`name`         VARCHAR(50) NOT NULL
  ,`card_number`  VARCHAR(16)
  ,`expiry_date`  VARCHAR(5)
  ,`cvv`          INTEGER
  ,FOREIGN KEY(`fk_user_id`) REFERENCES	users(`userID`)
);
INSERT INTO `booking`(`booking_id`,`fk_user_id`,`ap_id`,`booking_date`,`n_days`,`checkout_date`,`n_people`,`email`,`name`,`card_number`,`expiry_date`,`cvv`) VALUES (1,15,10,'06/11/2020',1,'07/11/2020',2,'Cielo.Predovic20@yahoo.com','Cielo Predovic','6666888844442222','03/22',345);
INSERT INTO `booking`(`booking_id`,`fk_user_id`,`ap_id`,`booking_date`,`n_days`,`checkout_date`,`n_people`,`email`,`name`,`card_number`,`expiry_date`,`cvv`) VALUES (2,16,14,'31/10/2021',1,'01/11/2021',2,'Carolanne.Batz90@gmail.com','Carolanne Batz','8362092658347836','08/24',165);
INSERT INTO `booking`(`booking_id`,`fk_user_id`,`ap_id`,`booking_date`,`n_days`,`checkout_date`,`n_people`,`email`,`name`,`card_number`,`expiry_date`,`cvv`) VALUES (3,17,3,'24/04/2021',1,'25/04/2021',2,'Jacey_McLaughlin84@yahoo.com','Jacey McLaughlin','7283672840192837','05/23',826);
INSERT INTO `booking`(`booking_id`,`fk_user_id`,`ap_id`,`booking_date`,`n_days`,`checkout_date`,`n_people`,`email`,`name`,`card_number`,`expiry_date`,`cvv`) VALUES (4,18,7,'09/03/2021',1,'10/03/2021',2,'Nels_Stokes@gmail.com','Nels Stokes','6543927384720195','03/25',891);
INSERT INTO `booking`(`booking_id`,`fk_user_id`,`ap_id`,`booking_date`,`n_days`,`checkout_date`,`n_people`,`email`,`name`,`card_number`,`expiry_date`,`cvv`) VALUES (5,19,8,'20/08/2021',1,'21/08/2021',1,'Justus_Ferry@yahoo.com','Justus Ferry','6374829016452846','11/24',213);
INSERT INTO `booking`(`booking_id`,`fk_user_id`,`ap_id`,`booking_date`,`n_days`,`checkout_date`,`n_people`,`email`,`name`,`card_number`,`expiry_date`,`cvv`) VALUES (6,20,6,'31/05/2021',1,'01/06/2021',2,'Katarina_Predovic12@gmail.com','Katarina Predovic','6273849261029376','12/25',442);
INSERT INTO `booking`(`booking_id`,`fk_user_id`,`ap_id`,`booking_date`,`n_days`,`checkout_date`,`n_people`,`email`,`name`,`card_number`,`expiry_date`,`cvv`) VALUES (7,21,10,'31/10/2021',2,'02/11/2021',2,'Florencio_Shanahan@gmail.com','Florencio Shanahan','8263017283654928','01/22',298);
INSERT INTO `booking`(`booking_id`,`fk_user_id`,`ap_id`,`booking_date`,`n_days`,`checkout_date`,`n_people`,`email`,`name`,`card_number`,`expiry_date`,`cvv`) VALUES (8,22,11,'13/03/2021',3,'16/03/2021',2,'Antonette74@yahoo.com','Antonette Baumbach','8789645283726308','1/28',741);
INSERT INTO `booking`(`booking_id`,`fk_user_id`,`ap_id`,`booking_date`,`n_days`,`checkout_date`,`n_people`,`email`,`name`,`card_number`,`expiry_date`,`cvv`) VALUES (9,23,12,'12/09/2021',1,'13/09/2021',2,'Dejuan.Lynch66@yahoo.com','Dejuan Lynch','8277455283726308','2/29',874);
INSERT INTO `booking`(`booking_id`,`fk_user_id`,`ap_id`,`booking_date`,`n_days`,`checkout_date`,`n_people`,`email`,`name`,`card_number`,`expiry_date`,`cvv`) VALUES (10,24,1,'07/10/2021',1,'08/10/2021',3,'Alverta68@hotmail.com','Alverta Barton','8273645283726308','08/23',628);
INSERT INTO `booking`(`booking_id`,`fk_user_id`,`ap_id`,`booking_date`,`n_days`,`checkout_date`,`n_people`,`email`,`name`,`card_number`,`expiry_date`,`cvv`) VALUES (11,25,9,'03/08/2021',1,'04/08/2021',1,'Johann_Stroman@hotmail.com','Johann Stroman','9827462819273602','10/24',874);
INSERT INTO `booking`(`booking_id`,`fk_user_id`,`ap_id`,`booking_date`,`n_days`,`checkout_date`,`n_people`,`email`,`name`,`card_number`,`expiry_date`,`cvv`) VALUES (12,26,14,'15/10/2021',1,'16/10/2021',2,'Chase_Marks@hotmail.com','Chase Marks','9283628374019274','05/25',754);
INSERT INTO `booking`(`booking_id`,`fk_user_id`,`ap_id`,`booking_date`,`n_days`,`checkout_date`,`n_people`,`email`,`name`,`card_number`,`expiry_date`,`cvv`) VALUES (13,27,2,'15/12/2020',2,'17/12/2020',2,'Derick.Waters@hotmail.com','Derick Waters','9741628374019274','12/25',714);
INSERT INTO `booking`(`booking_id`,`fk_user_id`,`ap_id`,`booking_date`,`n_days`,`checkout_date`,`n_people`,`email`,`name`,`card_number`,`expiry_date`,`cvv`) VALUES (14,28,5,'11/05/2021',1,'12/05/2021',2,'Demond8@gmail.com','Demond Purdy','2918374028374921','02/23',333);




CREATE TABLE IF NOT EXISTS `review` (
   `review_id`    INTEGER  NOT NULL AUTO_INCREMENT PRIMARY KEY 
  ,`user_id_fk`   INTEGER  NOT NULL
  ,`ap_id_fk`     INTEGER  NOT NULL
  ,`review_score` INTEGER  NOT NULL
  ,`comment`      VARCHAR(200) NOT NULL
  ,FOREIGN KEY(`user_id_fk`) REFERENCES	users(`userID`)
  ,FOREIGN KEY(`ap_id_fk`) REFERENCES	apartments(`ap_id`)
);


INSERT INTO `review`(`review_id`,`user_id_fk`,`ap_id_fk`,`review_score`,`comment`) VALUES (1,15,1,10,'A great stay, thank you!');
INSERT INTO `review`(`review_id`,`user_id_fk`,`ap_id_fk`,`review_score`,`comment`) VALUES (2,16,8,10,'The location was great, very nice!');
INSERT INTO `review`(`review_id`,`user_id_fk`,`ap_id_fk`,`review_score`,`comment`) VALUES (3,17,3,9,'Really clean, loved it!');
INSERT INTO `review`(`review_id`,`user_id_fk`,`ap_id_fk`,`review_score`,`comment`) VALUES (4,18,7,10,'So clean, so cozy!');
INSERT INTO `review`(`review_id`,`user_id_fk`,`ap_id_fk`,`review_score`,`comment`) VALUES (5,19,8,8,'A bit far from the center, but it was okay overall.');
INSERT INTO `review`(`review_id`,`user_id_fk`,`ap_id_fk`,`review_score`,`comment`) VALUES (6,20,6,9,'Recommend to everyone');
INSERT INTO `review`(`review_id`,`user_id_fk`,`ap_id_fk`,`review_score`,`comment`) VALUES (7,22,4,9,'The host was lovely, really felt like home.');
INSERT INTO `review`(`review_id`,`user_id_fk`,`ap_id_fk`,`review_score`,`comment`) VALUES (8,23,5,9,'Amazing and so cozy, loved my stay!');
